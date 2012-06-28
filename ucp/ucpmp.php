<?php  
	include("../common.php");
if (isset($_GET["u"])) {
	$ump_row = fetchUser($_GET["u"]);
	include($STYLE_HTML."header.php"); 
	include($STYLE_HTML."ucpmp_style.php");
	include($STYLE_HTML."footer.php");
} else {
	echo "<script>location.href='index.php';</script>";
}
?>
