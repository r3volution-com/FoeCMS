<?php 
include("common.php");
if (!checkLogin(true)) goToLogin();
$pagi_res = pagination("SELECT * FROM ".$MYSQL_PREFIX."account", 100);
include($STYLE_HTML."header.php");
include($STYLE_HTML."memberlist_style.php");
include($STYLE_HTML."footer.php");
?>