<?php
if (isset($inadm)) {
	include("../include/store.inc.php");
	if (isset($_GET["d"])) {
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".$_GET["d"]);
		if (isset($row["id"])) {
			$row2 = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$row["category_id"]);
		
			$urlimage = $ROOT."storecontent/image/".$row2["url"]."/".$row["url"];
			$urlfile = $ROOT."storecontent/download/".$row2["url"]."/".$row["url"];
			$extimage = getext($urlimage);
			$extfile = getext($urlfile);
			$urlimage=$urlimage.$extimage;
			$urlfile=$urlfile.$extfile;
		
			unlink($urlimage); 
			unlink($urlfile); 
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."report WHERE item_id=".mysql_real_escape_string($_GET["d"])) or die (mysql_error());
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."comment WHERE item_id=".mysql_real_escape_string($_GET["d"])) or die (mysql_error());
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."item WHERE id=".mysql_real_escape_string($_GET["d"])) or die (mysql_error());
			echo "<script>alert('done!');location.href='./index.php'</script>";
		} else die ("<script>location.href='./index.php'</script>");
	}
	if (isset($_POST["id"]) && $_POST["id"]) {
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".$_POST["id"]);
		
		$name = preg_replace("/[^a-z0-9]/", '', strtolower($_POST["name"]));
		$row2 = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$row["category_id"]);
		$oldurlimage = $ROOT."storecontent/image/".$row2["url"]."/".$row["url"];
		$oldurlfile = $ROOT."storecontent/download/".$row2["url"]."/".$row["url"];
		$oldextimage = getext($oldurlimage);
		$oldextfile = getext($oldurlfile);
		$oldurlimage=$oldurlimage.$oldextimage;
		$oldurlfile=$oldurlfile.$oldextfile;
		
		$newurlimage = $ROOT."storecontent/image/".$row2["url"]."/".$name.$oldextimage;
		$newurlfile = $ROOT."storecontent/download/".$row2["url"]."/".$name.$oldextfile;
		
		if ($_POST["name"] != $row["name"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."item SET name='".$_POST["name"]."' WHERE id='".$_POST["id"]."'") or die(mysql_error());
			mysql_query("UPDATE ".$MYSQL_PREFIX."item SET url='".$name."' WHERE id='".$_POST["id"]."'") or die(mysql_error());
			rename($oldurlimage, $newurlimage);
			rename($oldurlfile, $newurlfile);
		}
		
		if ($_POST["desc"] != $row["description"]) mysql_query("UPDATE ".$MYSQL_PREFIX."item SET description='".$_POST["desc"]."' WHERE id='".$_POST["id"]."'") or die(mysql_error());
		
		if ($_POST["cat"]) mysql_query("UPDATE ".$MYSQL_PREFIX."item SET category_id='".$_POST["cat"]."' WHERE id='".$_POST["id"]."'") or die(mysql_error());
		
		
		if ($_FILES['image']['name']) {
			unlink($oldurlimage); 
			$dirI = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$_POST["cat"]);
			$ext = getExtension(basename($_FILES['image']['name']));
			$image = $target."image/".$dirI["url"]."/".$name.".".$ext; 
			if (!file_exists($target."image/".$dirI["url"])) {
				mkdir($target."image/".$dirI["url"], 0777, true);
			} 
			move_uploaded_file($_FILES['image']['tmp_name'], $image);
		}
		
		if ($_FILES['file']['name']) {
			unlink($oldurlfile); 
			$dirF = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$_POST["cat"]);
			$ext = getExtension(basename($_FILES['file']['name']));
			$file = $target."download/".$dirF["url"]."/".$name.".".$ext; 
			if (!file_exists($target."download/".$dirF["url"])) {
				mkdir($target."download/".$dirF["url"], 0777, true);
			} 
			move_uploaded_file($_FILES['file']['tmp_name'], $file);
		}
		
		echo "<script>alert('done!');location.href='./index.php'</script>";
	 } else {
?>
<b><?php echo _l("acp_edititem"); ?></b> <br />
<?php 
	$res = pagination("SELECT * FROM ".$MYSQL_PREFIX."item", getConfig("item_per_page"));
while ($row = mysql_fetch_array($res["query_result"])) { ?>
<?php echo $row["id"]." - ".$row["name"]."<a href='index.php?r=".$_GET["r"]."&d=".$row["id"]."'> <b>X</b></a><br>"; ?>
<form action="index.php?r=3" method="POST" ENCTYPE="multipart/form-data" > 
<input name="id" type="hidden" value="<?php echo $row["id"]; ?>" />
<table>
	<tr>
		<td><?php echo _l("item_name"); ?>: <input name="name" type="text" value="<?php echo $row["name"]; ?>" /></td>
		<td><?php echo _l("item_description"); ?>: <input name="desc" type="text" value="<?php echo $row["description"]; ?>" /></td>
		<td><?php echo _l("item_category"); ?>: <select name="cat"><?php
$rese = getCategoryList(); 
while ($rowe = mysql_fetch_array($rese)) {
	if ($rowe["category_id"] == $row["category_id"]) $selected='selected="selected"';
	if (!$rowe["parent_category_id"]) echo '<option '.$selected.' value="'.$rowe["category_id"].'">'.$rowe["name"].'</option>';
	else echo '<option '.$selected.' value="'.$rowe["category_id"].'">->'.$rowe["name"].'</option>';
}
?></select></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo _l("item_image"); ?>:<input name="image" type="file" /><?php if (!file_exists(geturl(getcat($row['category_id']), $row['url'],"image"))) echo "No image found: ".geturl(getcat($row['category_id']), $row['url'],"image"); ?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo _l("item_file"); ?>:<input name="file" type="file" /><?php if (!file_exists(geturl(getcat($row['category_id']), $row['url']))) echo "No file found: ".geturl(getcat($row['category_id']), $row['url']); ?></td>
	</tr>
</table>
<input type="submit">
</form>
<br>
<?php } if (!mysql_num_rows($res["query_result"])) echo "0 results";
	echo "<br />".$res["select_page"];  ?>
<?php  } } else die("<script>location.href='../index.php';</script>"); ?>
