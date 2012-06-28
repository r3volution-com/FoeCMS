<?php 
if (isset($inadm) && $inadm == 2) {
	if (isset($_GET["d"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."invitation WHERE id=".$_GET["d"]);
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
	
?>
<b><?php echo _l("acp_editinvitation"); ?></b> <br />
<?php $res = pagination("SELECT * FROM ".$MYSQL_PREFIX."invitation", 50);
	while ($row = mysql_fetch_array($res["query_result"])) { 
		$user_row = fetchUser($row["from_id"]);
		echo $row["id"]." - <a href='index.php?r=".$_GET["r"]."&d=".$row["id"]."'> X </a>"; ?>
		<form action="#" method="POST">
			<input type="hidden" name="e" value="<?php echo $row["id"]; ?>" />
			<?php echo _l("user_name"); ?>: <input name="name" disabled="disabled" type="text" value="<?php echo $user_row["username"]; ?>" /> 
			- <?php echo _l("user_email"); ?>: <input name="email" disabled="disabled" type="text" value="<?php echo $row["to_email"]; ?>" /> 
		</form><br>
<?php } if (!mysql_num_rows($res["query_result"])) echo "0 results";
	echo "<br />".$res["select_page"]; 
} else die("<script>location.href='index.php';</script>"); ?>
