<?php  include("common.php");
include("include/store.inc.php");
if (!checkLogin(true)) goToLogin();
if (isset($_GET["rc"]) && $_GET["rc"] && is_int($_GET["rc"])){
	mysql_query("DELETE FROM ".$MYSQL_PREFIX."comment WHERE id=".mysql_real_escape_string($_GET["rc"]));
	die("<script>location.href='msg.php?e=comment_removed'</script>");
}
if ((isset($_GET["i"]) && $_GET["i"] && is_int($_GET["i"])) || (isset($_GET["ec"]) && $_GET["ec"] && is_int($_GET["ec"]))) {
	if (isset($_POST["comment"]) && canComment()) {
		$comment = mysql_real_escape_string($_POST["comment"]);
		if (checkLogin()) $name = $USER_ID;
		else $name = 0;
		if (isset($_GET["ec"]) && $_GET["ec"] && is_int($_GET["ec"])) { 
			$i = $_GET["ec"]; 
			mysql_query("UPDATE ".$MYSQL_PREFIX."comment SET comment='".cleanTags($comment)."' WHERE id=".mysql_real_escape_string($_GET["ec"]));
		}else {
			$i = $_GET["i"]; 
			mysql_query("INSERT INTO `".$MYSQL_PREFIX."comment` (`user_id`, `item_id`, `comment`) VALUES (".$name.", ".mysql_real_escape_string($_GET["i"]).", '".cleanTags($comment)."');");
		}
		die("<script>location.href='msg.php?e=comment_created&r=viewitem.php?i=".$i."'</script>");
	} else {
		if (isset($_GET["ec"]) && $_GET["ec"]) $crow = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."comment WHERE id=".mysql_real_escape_string($_GET["ec"]));
		include($STYLE_HTML."header.php");
		include($STYLE_HTML."comment_style.php");
		include($STYLE_HTML."footer.php");
	}
} else die("Error");
?>