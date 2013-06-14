<?php include("common.php");
include("include/store.inc.php");
if (!checkLogin(true)) goToLogin();
if (isset($_GET["i"]) && is_int($_GET["i"])) {
	$item_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id='".$_GET["i"]."'");
	if (isset($item_row["id"])) {
		if (isset($_GET["p"]) && $_GET["p"] <= 5 && canVote()) {
			$ret = setPuntuacion($_GET["p"], $_GET["i"]);
			if ($_POST['peticion']) echo json_encode(getPuntuacion($_POST['i']));
			if ($ret == false) die("<script>location.href='".$ROOT_HTML."msg.php?e=item_alreadyvoted';</script>");
			echo "<script>location.href='viewitem.php?i=".$_GET["i"]."'</script>";
		}
	} else die("<script>location.href='".$ROOT_HTML."msg.php?e=item_notfound';</script>"); 
	$uitem_row = fetchUser($item_row["aportedby_id"]);
	include($STYLE_HTML."header.php");
	include($STYLE_HTML."viewitem_style.php");
	include($STYLE_HTML."footer.php");
} else die("<script>location.href='".$ROOT_HTML."msg.php?e=item_notfound';</script>");  ?>
