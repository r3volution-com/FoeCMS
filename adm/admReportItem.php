<?php
include("../include/store.inc.php");
if (isset($inadm)) { 
	if (isset($_GET["dr"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."report WHERE id=".$_GET["dr"]);
		echo "Reporte borrado";
	}
?>
<b><?php echo _l("acp_reportitem"); ?></b> <br />
<?php $res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."report") or die(mysql_error());
while ($row = mysql_fetch_array($res)) { 
	$u_row = fetchUser($row["user_id"]);
	$i_row = getItemById($row["item_id"]); ?>
	<?php echo '<b>Item:</b> <a href="../viewitem.php?i='.$i_row["id"].'">'.$i_row["name"].'</a> - <b>User:</b> '.$u_row["username"].' <a id="littlebutton" href="../item.php?ri='.$i_row["id"].'">'._l("item_remove").'</a><a id="littlebutton" href="../item.php?ei='.$i_row["id"].'">'._l("acp_edititem").'</a><a id="littlebutton" href="index.php?r=14&dr='.$row["id"].'">'._l("acp_deletereport").'</a><br><b>'._l("item_whyreport").':</b> '.$row["text"]; ?>
	<br>
<?php } if (!mysql_num_rows($res)) echo "0 results";
 } else goToLogin();?>
