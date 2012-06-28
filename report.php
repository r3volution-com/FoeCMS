<?php
include("common.php");
include("include/store.inc.php");
if (isset ($_GET["i"]) && $_GET["i"]) {
	$i_row = getItemById($_GET["i"]);
	if (isset ($_POST["text"]) && $_POST["text"]) {
		if ($i_row["id"] == $_GET["i"]) {
			mysql_query("INSERT INTO ".$MYSQL_PREFIX."report (user_id, item_id, text) VALUES (".$user_row["id"].", ".mysql_real_escape_string($_GET["i"]).", '".cleanTags(mysql_real_escape_string($_POST["text"]))."')") or die (mysql_error()); 
			die("<script>location.href='./msg.php?e=cms_reportedsuccesfully'</script>");
		} else die("<script>location.href='./msg.php?e=cms_badreport'</script>");
	} else {
		include ($STYLE_HTML."header.php");
		include ($STYLE_HTML."report_style.php");
		include ($STYLE_HTML."footer.php");
	}
} else die("<script>location.href='./msg.php?e=cms_badreport'</script>");
?>