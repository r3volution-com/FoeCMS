<?php if (file_exists("../config.php")) header("location: ../index.php");
if (!function_exists("importDb")) {
	function importDb($file, $prefix){
		$file_c = file_get_contents($file);
		if ($prefix != "foe_") $file_c = str_replace("foe_",$prefix,$file_c);
		$query = explode(';', $file_c);
		for ($i = 0; $query[$i]; $i++) {
			if (isset($query[$i-1])) mysql_query($query[$i-1]) or die("Line: ".$query[$i-1].". Error: ".mysql_error()); // Asumo un objeto conexión que ejecuta consultas
		}
	}
}
if (!function_exists("checkSEO")) {
	function checkSEO(){	
		if (function_exists('apache_get_modules')) {
			$modules = apache_get_modules();
			$mod_rewrite = in_array('mod_rewrite', $modules);
		} else $mod_rewrite =  getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
		return $mod_rewrite;
	}
}
if ((isset($_POST["host"]) && $_POST["host"]) && (isset($_POST["username"]) && $_POST["username"])) {
$path = getcwd();
$path=str_replace("\\",'/',$path);
$path = substr(substr($path,0,-1), 0, strrpos($path,"/"));

$html_path = substr(substr($_SERVER["REQUEST_URI"],0,-1), 0, strrpos($_SERVER["REQUEST_URI"],"/"));
$html_path = substr(substr($html_path,0,-1), 0, strrpos($html_path,"/"));

$fp = fopen("../config.php","w+");
fwrite($fp, '<?php
$HOST = "'.$_POST["host"].'";
$USER = "'.$_POST["user"].'";
$PASS = "'.$_POST["pass"].'";
$DB = "'.$_POST["db"].'";

global $ROOT;
$ROOT = "'.$path.'/";
global $ROOT_HTML;
$ROOT_HTML = "'.$html_path.'/";

global $INCLUDE;
$INCLUDE = $ROOT."include/";
$INCLUDE_HTML = $ROOT_HTML."include/";

global $MYSQL_PREFIX;
$MYSQL_PREFIX = "'.$_POST["prefix"].'";
?>' . PHP_EOL);
fclose($fp);
if (file_exists("../config.php")){
	$link = mysql_connect($_POST["host"], $_POST["user"], $_POST["pass"]) or die("Error al conectar a la DB");
	mysql_select_db($_POST["db"], $link) or die("Error al elegir la db"); 
	importDb("foecms_db.sql", $_POST["prefix"]);
	mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$path."' WHERE param LIKE 'php_root'") or die (mysql_error());
	mysql_query("INSERT INTO ".$_POST["prefix"]."account (username, pass_sha, email, level) VALUES ('".mysql_real_escape_string($_POST["username"])."','".mysql_real_escape_string(sha1($_POST["admpassword"]))."', '".mysql_real_escape_string($_POST["email"])."', '2');") or die(mysql_error());
	if (isset($_POST["webname"]) && $_POST["webname"]) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["webname"]."' WHERE param LIKE 'name'") or die (mysql_error());
	if (isset($_POST["webmail"]) && $_POST["webmail"]) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["webmail"]."' WHERE param LIKE 'contact_mail'") or die (mysql_error());
	if (isset($_POST["cookieprefix"]) && $_POST["cookieprefix"]) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["cookieprefix"]."' WHERE param LIKE 'cookie_prefix'") or die (mysql_error());
	
	if (isset($_POST["guestaccess"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["guestaccess"]."' WHERE param LIKE 'guest_access'") or die (mysql_error());
	if (isset($_POST["guestcomment"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["guestcomment"]."' WHERE param LIKE 'guest_comment'") or die (mysql_error());
	if (isset($_POST["guestdownload"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["guestdownload"]."' WHERE param LIKE 'guest_download'") or die (mysql_error());
	if (isset($_POST["guestvote"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["guestvote"]."'WHERE param LIKE 'guest_vote'") or die (mysql_error());
	if (isset($_POST["guestpost"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["guestpost"]."' WHERE param LIKE 'guest_post'") or die (mysql_error());
	if (isset($_POST["register"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["register"]."' WHERE param LIKE 'guest_register'") or die (mysql_error());
	if (isset($_POST["registerwithoutinv"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["registerwithoutinv"]."' WHERE param LIKE 'guest_register_without_inv'") or die (mysql_error());
	
	if (isset($_POST["usercomment"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["usercomment"]."' WHERE param LIKE 'user_comment'") or die (mysql_error());
	if (isset($_POST["userdownload"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["userdownload"]."' WHERE param LIKE 'user_download'") or die (mysql_error());
	if (isset($_POST["uservote"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["uservote"]."' WHERE param LIKE 'user_vote'") or die (mysql_error());
	if (isset($_POST["userpost"])) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["userpost"]."' WHERE param LIKE 'user_post'") or die (mysql_error());
	
	if (isset($_POST["seourl"]) && checkSEO()) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["seourl"]."' WHERE param LIKE 'seo_url'") or die (mysql_error());
	if (isset($_POST["webaccess"]) && checkSEO()) mysql_query("UPDATE ".$_POST["prefix"]."config SET value='".$_POST["webaccess"]."' WHERE param LIKE 'web_access'") or die (mysql_error());

		if (((isset($_POST["seourl"]) && $_POST["seourl"]) || (isset($_POST["webaccess"]) && !$_POST["webaccess"])) && checkSEO()) {
		$fp = fopen("../.htaccess","w");
		fwrite($fp, 'Options Indexes FollowSymLinks
		RewriteEngine On
		RewriteBase /
		');
		if ((isset($_POST["seourl"]) && $_POST["seourl"]) && checkSEO()) {
			fwrite($fp, '
			RewriteRule ^store/(.+)/*$ store.php?c=$1
			RewriteRule ^item/(.+)/*$ viewitem.php?i=$1
			RewriteRule ^profile/(.+)/*$ ucp/ucpviewprofile.php?u=$1
			RewriteRule ^comment/(.+)/*$ comment.php?i=$1
			');
		}
		if ((isset($_POST["webaccess"]) && $_POST["webaccess"] == -1) && checkSEO()) {
			fwrite($fp, '
			RewriteCond %{REQUEST_URI} !mantenimiento.html
			RewriteCond %{REQUEST_URI} !adm/*
			RewriteCond %{REQUEST_URI} !include/
			RewriteCond %{REQUEST_URI} !include/*
			RewriteCond %{REQUEST_URI} !lang/
			RewriteCond %{REQUEST_URI} !lang/*
			RewriteRule $ mantenimiento.html [R=302,L]');
			$fap = fopen("../mantenimiento.html","w+");
			if ($_POST["webaccesstext"]) $mantenimiento = $_POST["webaccesstext"];
			else $mantenimiento = _l("cms_webclosed");
			fwrite($fap, $mantenimiento);
			fclose($fap);
		}
		fclose($fp);
	} 
	echo "<script>alert('Done! Successfully installed.'); location.href='../';</script>";	
} else {
	echo "<script>alert('Error al crear el archivo de configuracion, revise los permisos.'); location.href='./';</script>";	
}
} else {
include("install_style.php");
}
?>
