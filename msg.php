<?php
include("common.php");
if (isset($_GET["e"]) && $_GET["e"] != NULL) {
	$error_message = _l($_GET["e"]);
	if (isset($_GET["r"]) && $_GET["r"] != NULL) $url = $_GET["r"];
	else $url = $ROOT_HTML."index.php";
	include($STYLE_HTML."header.php");
	include($STYLE_HTML."msg_style.php");
	include($STYLE_HTML."footer.php");
} else echo "<script>location.href='".$ROOT_HTML."index.php';</script>";
?>