<?php 
if (isset($inadm) && $inadm == 2) {
	if (isset($_GET["d"])) {
		mysql_query("DELETE FROM ".$MYSQL_PREFIX."account WHERE id=".$_GET["d"]);
		echo "Item Borrado";
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
	if (isset($_POST["e"]) && $_POST["e"] != 1) {
		$row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."account WHERE id=".$_POST["e"]);
		if (isset($_POST["name"]) && $_POST["name"] != $row["username"]) 
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET username='".$_POST["name"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["email"]) && $_POST["email"] != $row["email"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET email='".$_POST["email"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["password"]) && $_POST["password"] && $_POST["password"] == $_POST["repassword"] ) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET pass_sha='".sha1($_POST["password"])."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["secretask"]) && $_POST["secretask"] != $row["secret_ask"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET secret_ask='".$_POST["secretask"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["secretanwser"]) && $_POST["secretanswer"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET secret_answer_sha='".sha1($_POST["secretanswer"])."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["level"]) && $_POST["level"] != $row["level"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET level='".$_POST["level"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["avatar"]) && $_POST["avatar"] != $row["avatar"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET avatar='".$_POST["avatar"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["sex"]) && $_POST["sex"] != $row["sex"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET sex='".$_POST["sex"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["website"]) && $_POST["website"] != $row["website"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET website='".$_POST["website"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		if (isset($_POST["invitation"]) && $_POST["invitation"] != $row["invitation"]) {
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET invitation='".$_POST["invitation"]."' WHERE id='".$_POST["e"]."'") or die(mysql_error());
		echo "<script>alert('done!');location.href='./index.php'</script>";
	}
?>
<b><?php echo _l("acp_edituser"); ?></b> <br />
<?php echo _l("cms_search"); ?>: <form action="index.php?r=5" method="POST"><input type="text" align="center" name="user" /> <input type="submit"/></form>
<?php $sql = "SELECT * FROM ".$MYSQL_PREFIX."account";
	if (isset($_POST["user"]) && $_POST["user"]) $sql .= " WHERE username='".$_POST["user"]."'";
	$res = pagination($sql, 50);
	while ($row = mysql_fetch_array($res["query_result"])) { 
		echo $row["id"]." - ".$row["username"]."<a href='index.php?r=".$_GET["r"]."&d=".$row["id"]."'> X </a><br>"; ?>
		<form action="index.php?r=5" method="POST">
			<input type="hidden" name="e" value="<?php echo $row["id"]; ?>" />
			<?php echo _l("user_name"); ?>: <input name="name" type="text" value="<?php echo $row["username"]; ?>" /> 
			- <?php echo _l("user_email"); ?>: <input name="email" type="text" value="<?php echo $row["email"]; ?>" /> 
			- <?php echo _l("user_pass"); ?>: <input name="password" type="password" /> 
			- <?php echo _l("user_repass"); ?>: <input name="repassword" type="password" /> <br>
			<?php echo _l("user_secretask"); ?>: <input name="secretask" type="text" value="<?php echo $row["secret_ask"]; ?>" /> 
			- <?php echo _l("user_secretanswer"); ?>: <input name="secretanwer" type="text" /><br>
			<?php echo _l("user_level"); ?>: <select name="level"><option value="0" <?php if($row["level"] == 0) echo 'selected="selected"'; ?>><?php echo _l("user_leveluser"); ?></option><option value="-1" <?php if($row["level"] == -1) echo 'selected="selected"'; ?>><?php echo _l("user_banned"); ?></option><option value="1" <?php if($row["level"] == 1) echo 'selected="selected"'; ?>><?php echo _l("user_mod"); ?></option><option value="2" <?php if($row["level"] == 2) echo 'selected="selected"'; ?>><?php echo _l("user_admin"); ?></option></select>
			- <?php echo _l("user_avatar"); ?>: <input name="avatar" type="text" value="<?php echo $row["avatar"]; ?>" /> 
			- <?php echo _l("user_sex"); ?>: <select name="sex"><option value="0" <?php if($row["sex"] == 0) echo 'selected="selected"';  ?>><?php echo _l("user_nosex"); ?></option><option value="1" <?php if($row["sex"] == 1) echo 'selected="selected"';  ?>><?php echo _l("user_man"); ?></option><option value="2" <?php if($row["sex"] == 2) echo 'selected="selected"';  ?>><?php echo _l("user_woman"); ?></option></select>
			- <?php echo _l("user_website"); ?>: <input name="website" type="text" value="<?php echo $row["website"]; ?>" />
			- <?php echo _l("user_invitationnumber"); ?>: <input name="invitation" type="text" value="<?php echo $row["invitation"]; ?>" /> 
			<input type="submit">
		</form><br>
<?php } if (!mysql_num_rows($res["query_result"])) echo "0 results";
	echo "<br />".$res["select_page"]; 
} else die("<script>location.href='index.php';</script>"); ?>
