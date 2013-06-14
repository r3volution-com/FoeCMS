<?php
include("../include/store.inc.php");
if (isset($inadm)) {
	if (isset($_GET["d"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."category WHERE category_id=".$_GET["d"]);
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
	if (isset($_POST["id"]) && $_POST["id"]) {
		if ($_POST["name"] != $row["name"]) {
			$name = preg_replace("/[^a-z0-9_]/", '', strtolower($_POST["name"]));
			mysql_query("UPDATE ".$MYSQL_PREFIX."category SET name='".$_POST["name"]."' WHERE category_id='".$_POST["id"]."'") or die(mysql_error());
			mysql_query("UPDATE ".$MYSQL_PREFIX."category SET url='".$name."' WHERE category_id='".$_POST["id"]."'") or die(mysql_error());
		}
		if ($_POST["cat"] != $row["category_id"]) mysql_query("UPDATE ".$MYSQL_PREFIX."category SET parent_category_id='".$_POST["cat"]."' WHERE category_id='".$_POST["id"]."'") or die(mysql_error());
		echo "<script>alert('done!');location.href='./index.php'</script>";
	 } else {
?>
<b><?php echo _l("acp_editcategory"); ?></b> <br />
<?php 
	$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."category") or die(mysql_error());
	while ($row = mysql_fetch_array($res)) { 
		echo $row["category_id"]." - ".$row["name"]."<a href='index.php?r=".$_GET["r"]."&d=".$row["category_id"]."'> <b>X</b></a><br>"; ?>
		<form action="index.php?r=9" method="POST"> 
			<input name="id" type="hidden" value="<?php echo $row["category_id"]; ?>" />
			<?php echo _l("category_name"); ?>: <input name="name" type="text"  value="<?php echo $row["name"]; ?>"/>
			- <?php echo _l("category_parent"); ?>: <select name="cat"><option value="0"><?php echo _l("category_noparent"); ?></option><?php
			$rese = getCategoryList(-1); 
			while ($rowe = mysql_fetch_array($rese)) {
				if (!$rowe["parent_category_id"]) echo '<option value="'.$rowe["category_id"].'">'.$rowe["name"].'</option>';
				else echo '<option value="'.$rowe["category_id"].'">->'.$rowe["name"].'</option>';
			}
			?></select><input type="submit"/>
		</form>
		<br>
<?php } } } else goToLogin(); ?>
