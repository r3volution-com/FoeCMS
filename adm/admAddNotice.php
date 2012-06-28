<?php 
if (isset($inadm)) {
	if(isset($_POST["text"])) {
		$entry = "INSERT INTO ".$MYSQL_PREFIX."frontpage_news (text) VALUES ('".$_POST["text"]."')";
		mysql_query($entry) or die(mysql_error());
		echo "<script>alert('done!');location.href='./index.php'</script>";
	} ?>
<b><?php echo _l("acp_addnotice"); ?></b> <br />
<form action="index.php?r=6" method="POST" ENCTYPE="multipart/form-data" > 
<?php echo _l("acp_noticetext"); ?>: <input name="text" type="text" /><br />
<input type="submit">
</form>
<?php } else die("<script>location.href='../index.php';</script>");?>
