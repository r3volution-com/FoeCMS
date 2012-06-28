<?php include("../include/store.inc.php");
if (isset($inadm)) {
	if(isset($_POST["name"]) && $_POST["name"] != "") {
		$target = $ROOT."storecontent/"; 
		$name = preg_replace("/[^a-z0-9_]/", '', strtolower($_POST["name"]));
		
		$dirI = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$_POST["cat"]);
		$ext = getExtension(basename($_FILES['image']['name']));
		$image = $target."image/".$dirI["url"]."/".$name.".".$ext; 
		if (!file_exists($target."image/".$dirI["url"])) mkdir($target."image/".$dirI["url"], 0777, true);
		move_uploaded_file($_FILES['image']['tmp_name'], $image);
		
		$dirF = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$_POST["cat"]);
		$ext = getExtension(basename($_FILES['file']['name']));
		$file = $target."download/".$dirF["url"]."/".$name.".".$ext; 
		if (!file_exists($target."download/".$dirF["url"])) mkdir($target."download/".$dirF["url"], 0777, true);
		move_uploaded_file($_FILES['file']['tmp_name'], $file);
		
		mysql_query("INSERT INTO ".$MYSQL_PREFIX."item (name, description, url, category_id, aportedby_id) VALUES ('".$_POST["name"]."','".$_POST["desc"]."','".$name."','".$_POST["cat"]."','".$_SESSION[getConfig("cookie_prefix")."_name"]."')") or die(mysql_error());
		echo "<script>alert('done!'); location.href='./index.php'</script>";
	} else { ?>
<b><?php echo _l("acp_additem"); ?></b> <br />
<form action="index.php?r=2" method="POST" enctype="multipart/form-data"> 
<table>
	<tr>
		<td><?php echo _l("item_name"); ?>:</td><td><input name="name" type="text" /></td>
	</tr>
	<tr>
		<td><?php echo _l("item_description"); ?>:</td><td><input name="desc" type="text" /></td>
	</tr>
	<tr>
		<td><?php echo _l("item_category"); ?>:</td><td><select name="cat"><?php
$res = getCategoryList(-1); 
while ($row = mysql_fetch_array($res)) {
	if (!$row["parent_category_id"]) echo '<option value="'.$row["category_id"].'">'.$row["name"].'</option>';
	else echo '<option value="'.$row["category_id"].'">->'.$row["name"].'</option>';
}
?></select></td>
	</tr>
	<tr>
		<td><?php echo _l("item_image"); ?>:</td><td><input name="image" type="file" /></td>
	</tr>
	<tr>
		<td><?php echo _l("item_file"); ?>:</td><td><input name="file" type="file" /></td>
	</tr>
</table>
<input type="submit" value="Send">
</form>
<?php } } else die("<script>location.href='../index.php';</script>"); ?>
