<?php 
if (!function_exists("fetchQuery")) {
	function fetchQuery($query) {
		$res = mysql_query($query) or die(mysql_error()); 
		$row = mysql_fetch_array($res);
		return $row;
	}
}
if (!function_exists("getConfig")) {
	function getConfig($param) {
		global $MYSQL_PREFIX;
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."config WHERE param LIKE '".$param."'");
		return $row["value"];
	}
}
if (!function_exists("setConfig")) {
	function setConfig($param, $value) {
		global $MYSQL_PREFIX;
		mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$value."'WHERE param LIKE '".$param."'") or die (mysql_error());
	}
}
if (!function_exists("fetchUser")) {
	function fetchUser($foe = '') {
		global $MYSQL_PREFIX;
		if (!$foe && isset($_SESSION[getConfig("cookie_prefix")."_userid"])) $foe = $_SESSION[getConfig("cookie_prefix")."_userid"];
		$foe = mysql_real_escape_string($foe);
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."account WHERE id='$foe'");
		return $row;
	}
}
if (!function_exists("setUser")) {
	function setUser($param, $value, $foe = '') {
		global $MYSQL_PREFIX;
		if (!$foe) $foe = $_SESSION[getConfig("cookie_prefix")."_userid"];
		$foe = mysql_real_escape_string($foe);
		$value = mysql_real_escape_string($value);
		mysql_query("UPDATE ".$MYSQL_PREFIX."account SET ".$param."='".$value."' WHERE id='$foe'");
	}
}
if (!function_exists("fetchUserby")) {
	function fetchUserby($by, $foe) {
		global $MYSQL_PREFIX;
		$foe = mysql_real_escape_string($foe);
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."account WHERE ".$by."='$foe'");
		return $row;
	}
}
if (!function_exists("_l")) {
	function _l ($word) {
		global $LANG;
		if (isset($LANG["lang_array"][$word])) return $LANG["lang_array"][$word];
		else {
			global $ROOT;
			include($ROOT."lang/".$LANG["lang_from"]."/".$LANG["lang_from"].".php");
			if (isset($language["lang_array"][$word])) return $language["lang_array"][$word];
			else return $word;
		}
	}
}

if (!function_exists("parseMetacodes")) {
	function parseMetacodes($string, $username = "", $email = "", $url = "", $password = "") {
		$row = fetchUser();
		if ($username) $string = str_replace("{USERNAME}", $username, $string); 
		else $string = str_replace("{USERNAME}", $row["username"], $string); 
		if ($email) $string = str_replace("{EMAIL}", $email, $string); 
		else $string = str_replace("{EMAIL}", $row["email"], $string); 
		if ($password) $string = str_replace("{PASSWORD}", $password, $string); 
		if ($url) $string = str_replace("{URL}", "http://".$_SERVER['HTTP_HOST'].$url, $string); 
		else $string = str_replace("{URL}", "http://".$_SERVER['HTTP_HOST'], $string); 
		$string = str_replace("{WEBNAME}", getConfig("name"), $string); 
		$string = str_replace("{WEBDESC}", getConfig("description"), $string); 
		return $string;
	}
}

if (!function_exists("checkMP")) {
	function checkMP() {
		global $MYSQL_PREFIX;
		$nuevosmp = 0;
		$row = fetchUser();
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."mp WHERE idreceive='".$row["id"]."'") or die(mysql_error());
		while ($row = mysql_fetch_array($res)) {
			if ($row["read"] == 0) $nuevosmp++;
		}
		return $nuevosmp;
	}
}

if (!function_exists("checkAdmin")) {
	function checkAdmin() {
		$row = fetchUser();
		if (checkLogin() && $row["level"] > 0) return 1;
		else return 0;
	}
}
if (!function_exists("checkFile")) {
	function checkFile($file) {
		return file_exists($file);
	}
}
if (!function_exists("checkEmail")) {
	function checkEmail($email){
		$exp = "/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/"; 
		if(preg_match($exp,$email)){ 
			$my_temp_variable=explode("@",$email);
			$my_temp_variable= array_pop($my_temp_variable);
			if(checkdnsrr($my_temp_variable,"MX")) return true; 
			else return false; 
		} else return false;
	} 
} 
/* 
if (!function_exists("cleanTags")) {
	function cleanTags($source, $tags = null) {
		function clean($matched) { //NOT WORKING
			$attribs =
			"javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|".
			"onmousemove|onmouseout|onkeypress|onkeydown|onkeyup|onload|".
			"class|id|style";
 
			$quot = "\"|'|`";
			$stripAttrib = "# ($attribs)s*=s*($quot)(.*?)(\2)#i";
			$clean = stripslashes($matched[0]);
			$clean = preg_replace($stripAttrib, '', $clean);
			return $clean;
		}	  
 
	}
}*/

if (!function_exists("pagination")) {
function pagination($query, $item_per_page = 20, $url_var = "pg") {
	//examino la página a mostrar y el inicio del registro a mostrar 
	if (isset($_GET[$url_var])) $pagina = $_GET[$url_var]; 
	if (!isset($pagina)) { 
		$inicio = 0; 
		$pagina=1; 
	} else $inicio = ($pagina - 1) * $item_per_page; 
	
	// La idea es pasar también en los enlaces las variables hayan llegado por url.
	$enlace = $_SERVER['PHP_SELF'];
	$query_string = "?";
 
	//Si no se definió qué variables propagar, se propagará todo el $_GET menos la variable pg (por compatibilidad con versiones anteriores)
	if (isset($_GET[$url_var])) unset($_GET[$url_var]); // Eliminamos esa variable del $_GET
	$propagar = array_keys($_GET);

	// Este foreach está tomado de la Clase Paginado de webstudio
	foreach($propagar as $var){
		if(isset($GLOBALS[$var])) $query_string.= $var."=".$GLOBALS[$var]."&"; // Si la variable es global al script
		elseif(isset($_REQUEST[$var])) $query_string.= $var."=".$_REQUEST[$var]."&"; // Si no es global (o register globals está en OFF)
	}

	// Añadimos el query string a la url.
	$enlace .= $query_string;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$item_actual = ($pagina-1)*$item_per_page;
	$res = mysql_query($query); 
	$num_total_registros = mysql_num_rows($res); 
	$res = mysql_query($query." LIMIT ".$item_actual.", ".$item_per_page); 
	//calculo el total de páginas 
	$total_paginas = ceil($num_total_registros / $item_per_page); 
	$s_paginas = "";
	//muestro los distintos índices de las páginas, si es que hay varias páginas 
	if ($total_paginas > 1){ 
		if ($pagina > 1) {
			$previus_page = $pagina-1;
			$s_paginas .= " <a href='".$enlace.$url_var."=1'>"._l("cms_first")."</a> ";
			$s_paginas .= " <a href='".$enlace.$url_var."=".$previus_page."'>"._l("cms_previous")."</a> ";
		}
		for ($i=1;$i<=$total_paginas;$i++){ 
			//si muestro el índice de la página actual, no coloco enlace 
			if ($pagina == $i) $s_paginas .= $pagina." ";
			//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
			else $s_paginas .= "<a href='".$enlace.$url_var."=".$i."'>".$i."</a> ";
		}
		if ($pagina != $total_paginas) {
			$next_page = $pagina+1;
			$s_paginas .= " <a href='".$enlace.$url_var."=".$next_page."'>"._l("cms_next")."</a> ";
			$s_paginas .= " <a href='".$enlace.$url_var."=".$total_paginas."'>"._l("cms_last")."</a> ";
		}
	}
	
	$resultado = array(
	"query_result" => $res,
	"n_items" => $num_total_registros,
	"n_pages" => $total_paginas,
	"items_per_page" => $item_per_page,
	"act_page" => $pagina,
	"select_page" => $s_paginas
	);
	
	return $resultado;
}
}
if (!function_exists("post_pagination")) {
function post_pagination($res_query, $item_por_pagina = 20, $url_var = "pg") {
	//examino la página a mostrar y el inicio del registro a mostrar 
	if (isset($_GET[$url_var])) $pagina = $_GET[$url_var]; 
	if (!isset($pagina)) { 
		$inicio = 0; 
		$pagina=1; 
	} else $inicio = ($pagina - 1) * $item_por_pagina; 
	
	// La idea es pasar también en los enlaces las variables hayan llegado por url.
	$enlace = $_SERVER['PHP_SELF'];
	$query_string = "?";
	//Si no se definió qué variables propagar, se propagará todo el $_GET menos la variable pg (por compatibilidad con versiones anteriores)
	if (isset($_GET[$url_var])) unset($_GET[$url_var]); // Eliminamos esa variable del $_GET
	$propagar = array_keys($_GET);

	// Este foreach está tomado de la Clase Paginado de webstudio
	foreach($propagar as $var){
		if(isset($GET[$var])) $query_string.= $var."=".$GET[$var]."&"; // Si la variable es global al script
		elseif(isset($_REQUEST[$var])) $query_string.= $var."=".$_REQUEST[$var]."&"; // Si no es global (o register globals está en OFF)
	}

	// Añadimos el query string a la url.
	$enlace .= $query_string;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$num_total_registros = mysql_num_rows($res_query); 
	while ($row[] = mysql_fetch_array($res_query));
	$array[] = "";
	for ($i=0; $i < $item_por_pagina && isset($row[$inicio+$i]); $i++) $array[$i] = $row[$inicio+$i];
	//calculo el total de páginas 
	$total_paginas = ceil($num_total_registros / $item_por_pagina); 
	$s_paginas = "";
	//muestro los distintos índices de las páginas, si es que hay varias páginas 
	if ($total_paginas > 1){ 
		if ($pagina > 1) {
			$previus_page = $pagina-1;
			$s_paginas .= " <a href='".$enlace.$url_var."=1'>"._l("cms_first")."</a> ";
			$s_paginas .= " <a href='".$enlace.$url_var."=".$previus_page."'>"._l("cms_previous")."</a> ";
		}
		for ($i=1;$i<=$total_paginas;$i++){ 
			//si muestro el índice de la página actual, no coloco enlace 
			if ($pagina == $i) $s_paginas .= $pagina." ";
			//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
			else $s_paginas .= "<a href='".$enlace.$url_var."=".$i."'>".$i."</a> ";
		}
		if ($pagina != $total_paginas) {
			$next_page = $pagina+1;
			$s_paginas .= " <a href='".$enlace.$url_var."=".$next_page."'>"._l("cms_next")."</a> ";
			$s_paginas .= " <a href='".$enlace.$url_var."=".$total_paginas."'>"._l("cms_last")."</a> ";
		}
	}
	
	$resultado = array(
	"fetch_array" => $array,
	"n_items" => $num_total_registros,
	"n_pages" => $total_paginas,
	"items_per_page" => $item_por_pagina,
	"act_page" => $pagina,
	"select_page" => $s_paginas
	);
	
	return $resultado;
}
}

if (!function_exists("getPuntuacion")) {
function getPuntuacion($id) {
	global $MYSQL_PREFIX;
	$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=$id") or die("Line 4: ".mysql_error());
	$row = mysql_fetch_array($resultado);
	return $row;
}
}
if (!function_exists("setPuntuacion")) {
function setPuntuacion($puntos, $id) {
	global $MYSQL_PREFIX;
	if (isset($_COOKIE['votado:'.$id])) {
		return false;
	} else {
		$puntos = mysql_real_escape_string($puntos);
		mysql_query("UPDATE ".$MYSQL_PREFIX."item SET points=((points*votes)+$puntos)/(votes+1),votes=votes+1 WHERE id=$id") or die(mysql_error());
		return true;
	}
}
}
if (!function_exists("checkSEO")) {
	function checkSEO(){	
		if (function_exists('apache_get_modules')) {
			$modules = apache_get_modules();
			return in_array('mod_rewrite', $modules);
		} else return getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
	}
}
if (!function_exists("getLevel")) {
	function getLevel($user=0) {
		$myuser = fetchUser($user);
		if ($myuser["id"]) return $myuser["level"];
		else return -1;
	}
}
if (!function_exists("checkLogin")) {
	function checkLogin($check_guest_access=false) {
		if (!getConfig("web_access") && getLevel() == 0) die ("<script>location.href='".$ROOT_HTML."index.php?t=1';</script>");
		if (!$check_guest_access) {
			if (isset($_SESSION[getConfig("cookie_prefix")."_userid"])) return 1;
			else {
				if (isset($_COOKIE[getConfig("cookie_prefix")."_userid"])) {
					$_SESSION[getConfig("cookie_prefix")."_userid"] = $_COOKIE[getConfig("cookie_prefix")."_userid"];
					return 1;
				} else return 0;
			}
		} else {
			if (getConfig("guest_access") && getConfig("web_access")) return 1;
			else {
				if (isset($_SESSION[getConfig("cookie_prefix")."_userid"])) return 1;
				else {
					if (isset($_COOKIE[getConfig("cookie_prefix")."_userid"])) {
						$_SESSION[getConfig("cookie_prefix")."_userid"] = $_COOKIE[getConfig("cookie_prefix")."_userid"];
						return 1;
					} else return 0;
				}
			} 
		}
	}
}
if (!function_exists("goToLogin")) {
	function goToLogin($check_guest_access=false) {
		global $ROOT_HTML;
		die("<script>location.href='".$ROOT_HTML."login.php?r='+location.href;</script>");
	}
}
if (!function_exists("canRegister")){
	function canRegister($inv=0) {	
		if (getConfig("guest_register") == 1) {
			if (getConfig("guest_register_without_inv") == 1) return 1;
			else {
				if ($inv) {
					$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."invitation WHERE inv_session LIKE '".mysql_real_escape_string($inv)."'") or die(mysql_error());
					if (mysql_num_rows($res)) return 2;
					else return 0;
				}
				else return 0;
			}
		} else return -1;
	}
}
if (!function_exists("canDownload")){
	function canDownload() {	
		if (getConfig("guest_download") == 1) return 1;
		else {
			if (checkLogin()) return 1;
			else return 0;
		}
	}
}
if (!function_exists("canSeeProfile")){
	function canSeeProfile($u) {	
		global $MYSQL_PREFIX;
		$user_row=fetchUser();
		if (getConfig("see_profile") == 1 ) { if (checkLogin()) return 1; else return 0; }
		else if (getConfig("see_profile") == 2 && checkLogin()) {
			$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE (user_send='".$u."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$u."')") or die(mysql_error());
			if (mysql_num_rows($res) > 0) return 1;
			else return 0;
		} else return 1;
	}
}
if (!function_exists("canSeeFriends")){
	function canSeeFriends($u) {	
		global $MYSQL_PREFIX;
		$user_row=fetchUser();
		if (getConfig("see_friends") == 1) { if(checkLogin()) return 1; else return 0; }
		else if (getConfig("see_friends") == 2 && checkLogin()) {
			$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE (user_send='".$u."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$u."')") or die(mysql_error());
			if (mysql_num_rows($res) > 0) return 1;
			else return 0;
		} else return 1;
	}
}
if (!function_exists("getLastUser")){
	function getLastUser() {
		global $MYSQL_PREFIX;
		return fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."account ORDER BY id DESC");
	}
}
if (!function_exists("getFlags")) { 
	function getFlags() {
		global $MYSQL_PREFIX;
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."lang"); 
		return $res;
	}
}
if (!function_exists("getImageRoot")) {
	function getImageRoot($root, $altroot) {
		if (checkFile($root)) return $root;
		else return $altroot;
	}
}
if (!function_exists("getStyles")) { 
	function getStyles() {
		global $MYSQL_PREFIX;
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."style") or die(mysql_error());
		return $res;
	}
}
if (!function_exists("getStylebyID")) { 
	function getStylebyID($id) {
		global $MYSQL_PREFIX;
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."style WHERE id=$id") or die(mysql_error());
		return $row;
	}
}
if (!function_exists("getExtension")) { 
	function getExtension($url) {
		$ext = pathinfo($url);
		return $ext["extension"];
	}
}

	/* Created by: DeViaNTe [http://www.gcrew.es] */
	/* 
	 * "AT WILL" LICENSED.
	 *		Grab at will, 
	 *		copy at will, 
	 *		modify at will, 
	 *		use at will,
	 *		enjoy at will.
	*/
	
if (!function_exists("imagesizes")) {
	function imagesizes($originalWidth,$originalHeight,$maxWidth,$maxHeight) { 
		$modified = true;
		$x_ratio = $maxWidth / $originalWidth;
		$y_ratio = $maxHeight / $originalHeight;
		if (($originalWidth <= $maxWidth) && ($originalHeight <= $maxHeight)) { $newWidth = $originalWidth; $newHeight = $originalHeight; $modified = false; }
		else if ( ceil($x_ratio * $originalHeight) < $maxHeight) { $newHeight = ceil($x_ratio * $originalHeight); $newWidth = $maxWidth; } 
		else { $newWidth = ceil($y_ratio * $originalWidth); $newHeight = $maxHeight; }
		return array("w"=>$newWidth,"h"=>$newHeight,"modified"=>$modified);
	}
}
if (!function_exists("cleanTags")) {
	function cleanTags(	$html,
						$permitted = '<a><br><b><i><em><li><ol><p><strong><u><ul><img><div><span><del>', 
						$maximagewidth = "200",
						$maximageheight="150",
						$errloading = "http://ourweb/notfound.png") {
		error_reporting(E_ERROR | E_PARSE);
		
		$html = strip_tags($html, $permitted);
		
		$dom = new DOMDocument();							// New DOMDocument.
		$dom->loadHTML($html);								// Load from string.	(fixes unclosed tags & other errors, adds body, html...)
		$out = '';											// temp var for storing the html output in string.
		$doc = $dom->documentElement;						// Get the document.
		$fch = $doc->firstChild;							// Get the first child (Normally <html>)
		$children = $fch->childNodes;						// list of children elements of the node.
		
		
		//
		//	FIRST STEP: Remove hacking attempts & not-permitted tags.
		//
		
		foreach ($children as $child) {						// for every element in DOM...
			if (!in_array(strtolower($child->nodeName),$permitted)) { continue; }
			
			// javaScript hack attempt removal.
			$child->removeAttribute("onclick");				// - object on a form is clicked.
			$child->removeAttribute("ondblclick");			// - user double-clicks a form element or a link.
			$child->removeAttribute("onload");				// - browser finishes loading a window or all of the frames within a frameset.
			$child->removeAttribute("onunload");			// - user exits a document.
			$child->removeAttribute("onerror");				// - loading of a document or image causes an error.
			$child->removeAttribute("onabort");				// - The user aborts the loading of an image
			$child->removeAttribute("ondragdrop");			// - user drops an object (e.g. file) onto the browser window.
			$child->removeAttribute("onmove");				// - user or script moves a window or frame.
			$child->removeAttribute("onresize");			// - user or script resizes a window or frame.
			$child->removeAttribute("onkeydown");			// - user depresses a key.
			$child->removeAttribute("onkeyup");				// - user releases a key.
			$child->removeAttribute("onkeypress");			// - user presses or holds down a key.
			$child->removeAttribute("onchange");			// - select, text, or textarea field loses focus and its value has been modified.
			$child->removeAttribute("onselect");			// - user selects some of the text within a text or textarea field.
			$child->removeAttribute("onblur");				// - form element loses focus or when a window or frame loses focus.
			$child->removeAttribute("onfocus");				// - window, frame, frameset or form element receives focus.
			$child->removeAttribute("onmouseover");			// - cursor moves over an object or area.
			$child->removeAttribute("onmousedown");			// - user depresses a mouse button.
			$child->removeAttribute("onmouseup");			// - user releases a mouse button.
			$child->removeAttribute("onmouseout");			// - cursor leaves an area or link.
			$child->removeAttribute("onmousemove");			// - user moves the cursor.
			$child->removeAttribute("onsubmit");			// - user submits a form.
			$child->removeAttribute("onreset");				// - user resets a form.

			// style hack attempt removal. $child->removeAttribute("style");				// - remove inline styles.
		}

		//
		//	SECOND STEP: Image magic.
		//
		$images = $dom->getElementsByTagName("img");		// List of images.
		foreach ($images as $img) {							// For every image...
			if ($img->getAttribute("width")=="" || $img->getAttribute("height")=="") {
				// no width or height info avaiable.
				// possible to-do: 
				//	 a) obtain with CURL, open with PHP, grab the sizes.
				//	 b) set width = maxwidth.
				
				$img->setAttribute("width",$maximagewidth);		// set size
			} else {
				$sizes = imagesizes($img->getAttribute("width"),$img->getAttribute("height"),$maximagewidth,$maximageheight);	// get size.
				$img->setAttribute("width",$sizes["w"]);		// set size
				$img->setAttribute("height",$sizes["h"]);		// set size
				if ($sizes["modified"]) {
					// If image is resized. (Here, we know that the image is super-sized, so, we could
					// add an onclick event, and open image in floating style, for example...
					
					// $img->setAttribute("onclick","alert(this)"); <- for example
				}
			}
			
			// It could be interesting, if we add an on error event, 
			// in case the image failed loading, we could add another 
			// image from our host.
			$img->setAttribute("onerror","this.src = '".$errloading."'");
			
		}
		
		//
		//	THIRD STEP: Grab the super-filtered HTML!
		//
		$children = $fch->childNodes;						// list of children elements of the node. (filtered!)
		foreach ($children as $child) {						// for every element in DOM...
			$out .= $child->ownerDocument->saveXML( $child );
		}
		error_reporting(E_ALL);
		return $out;
	}
}
?>