<?php  include("../config.php");
include("../common.php");
	if (isset($_GET["user"])) {
		$idmp=$_GET["mp"];
		$iduser=$_GET["user"];
		$type=$_GET["type"];
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."mp WHERE id=$idmp");
		$raw = fetchUser($iduser);
		if ($type == 1) {
			if ($raw["id"] != $iduser) echo "<script>location.href='./index.php?c=4'</script>";
		} else {
			if ($raw["id"] != $iduser) echo "<script>location.href='./index.php?c=4'</script>";
		}
		if ($row["read"] == 0) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."mp SET ".$MYSQL_PREFIX."mp.read='1' WHERE ".$MYSQL_PREFIX."mp.id='$idmp'") or die(mysql_error());
		}
		include($STYLE_HTML."header.php"); 
		include($STYLE_HTML."ucpviewmp_style.php");
		include($STYLE_HTML."footer.php");
	} else {
		echo "<script>location.href='./index.php'</script>";
	} 
?>