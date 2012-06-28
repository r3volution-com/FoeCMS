<?php if (!function_exists("getcat")) {
	function getcat($cat) {
		global $MYSQL_PREFIX;
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=$cat") or die(mysql_error());
		$raw = mysql_fetch_array($res);
		return $raw["url"];
	}
}
if (!function_exists("getext")) {
	function getext($url, $r_ext = 0) {
		if (!$r_ext) $urlitem_glob = glob($url.".*");
		else $urlitem_glob = glob($url);
		if (isset($urlitem_glob[0])) {
			$urlitem_glob = pathinfo($urlitem_glob[0]);
			if ($urlitem_glob["extension"]) {
				$extensionitem = ".".$urlitem_glob["extension"];
			} else $extensionitem = "";
		} else $extensionitem = "";
		return $extensionitem;
	}
}
if (!function_exists("geturl")) {
	function geturl($dir, $url, $type="download", $root_html = 0) {
		global $ROOT;
		global $ROOT_HTML;
		$urlitem = "storecontent/".$type."/".$dir."/".$url;
		$urlitem .= getext($ROOT.$urlitem);
		if($root_html) $urlitem = $ROOT_HTML.$urlitem.getext($urlitem);
		else $urlitem = $ROOT.$urlitem.getext($urlitem);
		return $urlitem;
	}
}

if (!function_exists("getNews")) {
	function getNewsFrontPage() {
		global $MYSQL_PREFIX;
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."frontpage_news ORDER BY id DESC LIMIT 5") or die(mysql_error()); 
		return $res;
	}
}
if (!function_exists("getFrontPage")) {
	function getFrontPage() {
		global $MYSQL_PREFIX;
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item ORDER BY id DESC") or die(mysql_error()); 
		return $res;
	}
}
if (!function_exists("getItemById")) {
	function getItemById($id) {
		global $MYSQL_PREFIX;
		$id = mysql_real_escape_string($id);
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id='$id'") or die(mysql_error()); 
		$row = mysql_fetch_array($res);
		return $row;
	}
}
if (!function_exists("getItems")) {
	function getItems($cat) {
		global $MYSQL_PREFIX;
		$cat = mysql_real_escape_string($cat);
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE category_id=$cat ORDER BY id DESC") or die(mysql_error()); 
		if (!mysql_num_rows($res)) $res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE category_id=ANY (SELECT category_id FROM ".$MYSQL_PREFIX."category WHERE parent_category_id=$cat) ORDER BY id DESC") or die(mysql_error()); 
		return $res;
	}
}
if (!function_exists("getCategoryBy")) {
	function getCategoryBy($cat) {
		global $MYSQL_PREFIX;
		$cat = mysql_real_escape_string($cat);
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=$cat") or die(mysql_error());
		$raw = mysql_fetch_array($res);
		return $raw;
	}
}
if (!function_exists("getCategoryList")) {
	function getCategoryList($parent = 0) {
		global $MYSQL_PREFIX;
		if ($parent < 0) $res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."category") or die(mysql_error()); 
		else $res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."category WHERE parent_category_id='$parent'") or die(mysql_error()); 
		return $res;
	}
}	
if (!function_exists("getCommentsData")) {
	function getCommentsData($data) {
		global $MYSQL_PREFIX;
		$data = mysql_real_escape_string($data);
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."comment WHERE item_id='".$data."'") or die(mysql_error());
		return $res;
	}
}
if (!function_exists("getNumComments")) {
	function getNumComments($item_id) {
		global $MYSQL_PREFIX;
		$item_id = mysql_real_escape_string($item_id);
		$res = mysql_query("SELECT COUNT(*) FROM ".$MYSQL_PREFIX."comment WHERE item_id='".$item_id."'") or die(mysql_error());
		$row = mysql_fetch_row($res);
		$row = $row[0];
		return $row;
	}
}
if (!function_exists("canComment")) {
	function canComment() {
		if (getConfig("guest_comment") == 1) return 1;
		else {
			if (getConfig("user_comment") == 1) {
				if (checkLogin()) return 1;
				else return 0;
			} else return 0;
		}
	}
}
if (!function_exists("canPost")) {
	function canPost() {
		if (getConfig("guest_post") == 1) return 1;
		else {
			if (getConfig("user_post") == 1) {
				if (checkLogin()) return 1;
				else return 0;
			} else return 0;
		}
	}
}
if (!function_exists("canVote")) {
	function canVote() {
		if (getConfig("guest_vote") == 1) return 1;
		else {
			if (getConfig("user_vote") == 1) {
				if (checkLogin()) return 1;
				else return 0;
			} else return 0;
		}
	}
}
?>