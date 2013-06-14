<?php 
include("common.php"); 
include("include/store.inc.php");
if (!checkLogin(true)) goToLogin();
if (isset($_GET["c"]) && $_GET["c"] != NULL) $cat = $_GET["c"];
else $cat = 0;
include($STYLE_HTML."header.php");
include($STYLE_HTML."store_style.php");
include($STYLE_HTML."footer.php");
?>