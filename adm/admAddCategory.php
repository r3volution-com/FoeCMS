<?php include("../include/store.inc.php");
if (isset($inadm)) {
	if(isset($_POST["name"]) && $_POST["name"] != "") {
		$name = preg_replace("/[^a-z0-9_]/", '', strtolower($_POST["name"]));
		mysql_query("INSERT INTO ".$MYSQL_PREFIX."category (parent_category_id, url, name) VALUES ('".$_POST["cat"]."','".$name."','".$_POST["name"]."')") or die(mysql_error());
		echo "<script>alert('done!'); location.href='./index.php'</script>";
	} else { ?>
<b><?php echo _l("acp_addcategory"); ?></b> <br />
<form action="index.php?r=8" method="POST" enctype="multipart/form-data"> 
<table>
	<tr>
		<td><?php echo _l("category_name"); ?>:</td><td><input name="name" type="text" /></td>
	</tr>
	<tr>
		<td><?php echo _l("category_parent"); ?>:</td><td><select name="cat"><option value="0"><?php echo _l("category_noparent"); ?></option>
<?php
$res = getCategoryList(-1); 
while ($row = mysql_fetch_array($res)) {
	if (!$row["parent_category_id"]) echo '<option value="'.$row["category_id"].'">'.$row["name"].'</option>';
	else echo '<option value="'.$row["category_id"].'">->'.$row["name"].'</option>';
}
?></select>
</table>
<input type="submit" value="Send">
</form>
<?php } } else die("<script>location.href='../index.php';</script>"); ?>