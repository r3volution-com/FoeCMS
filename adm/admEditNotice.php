<?php 
if (isset($inadm)) {
	if (isset($_GET["d"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."frontpage_news WHERE id=".$_GET["d"]);
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
	if (isset($_POST["e"])) {
		if (isset($_POST["text"])) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."frontpage_news SET text='".$_POST["text"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		}
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
?>
<b><?php echo _l("acp_editnotice"); ?></b> <br />
<?php $res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."frontpage_news") or die(mysql_error());
while ($row = mysql_fetch_array($res)) { ?>
<?php echo $row["id"]." - "."<a href='index.php?r=".$_GET["r"]."&d=".$row["id"]."'> X </a><br>"; ?>
<form action="index.php?r=7" method="POST" ENCTYPE="multipart/form-data" > 
<input name="e" type="hidden" value="<?php echo $row["id"]; ?>" />
<?php echo _l("acp_noticetext"); ?>: <input name="text" type="text" value="<?php echo $row["text"]; ?>"/>
<input type="submit">
</form>
<br>
<?php } 
 } else die("<script>location.href='../index.php';</script>"); ?>
