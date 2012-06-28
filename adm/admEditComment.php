<?php
if (isset($inadm)) {
	include("../include/store.inc.php");
	if (isset($_GET["d"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."comment WHERE id=".$_GET["d"]);
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
	if (isset($_POST["id"]) && $_POST["id"]) {
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."comment WHERE id=".$_POST["id"]);
		
		if ($_POST["comment"] != $row["comment"]) mysql_query("UPDATE ".$MYSQL_PREFIX."comment SET comment='".$_POST["comment"]."' WHERE id='".$_POST["id"]."'") or die(mysql_error());
		
		echo "<script>alert('done!');location.href='./index.php'</script>";
	 } else {
?>
<b><?php echo _l("cms_comments"); ?></b> <br />
<?php 
	$res = pagination("SELECT * FROM ".$MYSQL_PREFIX."comment", getConfig("item_per_page"));
while ($row = mysql_fetch_array($res["query_result"])) { 
$user_row = fetchUser($row["user_id"]);
$item_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".$row["item_id"]);
?>
<?php echo $row["id"]." - ".$item_row["name"]."<a href='index.php?r=".$_GET["r"]."&d=".$row["id"]."'> <b>X</b></a><br>"; ?>
<form action="index.php?r=10" method="POST" ENCTYPE="multipart/form-data" > 
<input name="id" type="hidden" value="<?php echo $row["id"]; ?>" />
<table>
	<tr>
		<td><?php echo _l("item_name"); ?>: <input type="text" disabled="disabled" value="<?php echo $item_row["name"]; ?>" /></td>
		<td><?php echo _l("user_name"); ?>: <input type="text" disabled="disabled" value="<?php echo $user_row["username"]; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo _l("item_comment"); ?>: <textarea name="comment" type="text"><?php echo $row["comment"]; ?></textarea></td>
	</tr>
</table>
<input type="submit">
</form>
<br>
<?php } if (!mysql_num_rows($res["query_result"])) echo "0 results";
	echo "<br />".$res["select_page"];  ?>
<?php  } } else die("<script>location.href='../index.php';</script>"); ?>
