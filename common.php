<?php 
if(!isset($_SESSION)) session_start(); 

if (file_exists("config.php")) {
	$found = 1;
	include_once("config.php");
} else if (file_exists("../config.php")) {
	$found = 1;
	include_once("../config.php");
} else {
	$found = 0;
	if (file_exists("install")) die ("<script>location.href='install';</script>");
	else if (file_exists("../install")) die ("<script>location.href='../install';</script>");
	else die ("FATAL ERROR: install folder not found.");
}
if ($found) {
	include_once ($ROOT."include/functions.php");
	
	$link = mysql_connect($HOST, $USER, $PASS) or die("FATAL ERROR: can't connect to DB");
	mysql_select_db($DB, $link) or die("FATAL ERROR: can't select DB"); 
	
	if (file_exists($ROOT."install") && !strstr($_SERVER['REQUEST_URI'], "msg.php")) die ("<script>location.href='".$ROOT_HTML."msg.php?e=cms_delinstall&r=index.php&nr=1';</script>");
} 

global $ROOT;
global $LANG;
global $LANG_SESSION;
global $STYLE;
global $STYLE_INC;
global $STYLE_HTML;
global $STYLE_CSS;
global $STYLE_JS;
global $STYLE_IMAGE;
global $USER_ID;
global $user_row;

if (isset($_SESSION[getConfig("cookie_prefix")."_lang"])) { 
	$LANG_SESSION = $_SESSION[getConfig("cookie_prefix")."_lang"];
	$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."lang WHERE id='$LANG_SESSION'");
	$lang_code = $row["lang"];
	include_once($ROOT."lang/".$lang_code."/".$lang_code.".php");
	$LANG = $language;
} else {
	setcookie(getConfig("cookie_prefix")."_lang", getConfig("default_lang"), time() + 86400);
	$_SESSION[getConfig("cookie_prefix")."_lang"] = getConfig("default_lang");
	$LANG_SESSION = $_SESSION[getConfig("cookie_prefix")."_lang"];
	$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."lang WHERE id='$LANG_SESSION'");
	$lang_code = $row["lang"];
	include_once($ROOT."lang/".$lang_code."/".$lang_code.".php");
	$LANG = $language;
}

$style_row = getStylebyID(getConfig("default_style"));
$STYLE_INC = $ROOT."style/".$style_row["url"]."/";
$STYLE = $ROOT_HTML."style/".$style_row["url"]."/";
	
if (checkLogin()) {
	$user_row = fetchUser();
	$USER_ID = $user_row["id"];
	if ($user_row["style_id"]) {
		$style_row = getStylebyID($user_row["style_id"]);
		$STYLE_INC = $ROOT."style/".$style_row["url"]."/";
		$STYLE = $ROOT_HTML."style/".$style_row["url"]."/";
	}
} 

$STYLE_HTML = $STYLE_INC;
$STYLE_CSS = $STYLE."css/";
$STYLE_JS = $STYLE."js/";
$STYLE_IMAGE = $STYLE."image/";

?>
