<?php 
if (isset($inadm) && $inadm == 2) {
	if(isset($_POST["name"]) && $_POST["name"]) $row2 = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."account WHERE username='".mysql_real_escape_string($_POST["name"])."'"); 
	if(isset($_POST["name"]) && $_POST["name"] != "" && $row2["username"] != $_POST["name"] && $_POST["password"] == $_POST["repassword"]) {
		$entry = "INSERT INTO ".$MYSQL_PREFIX."account (username, pass_sha, email, secret_ask, secret_answer_sha, level) VALUES ('".mysql_real_escape_string($_POST["name"])."','".sha1($_POST["password"])."','".mysql_real_escape_string($_POST["email"])."','".mysql_real_escape_string($_POST["secretask"])."','".sha1($_POST["secretanswer"])."','".mysql_real_escape_string($_POST["level"])."')";
		mysql_query($entry) or die(mysql_error());
		echo "<script>alert('done!');location.href='./index.php'</script>";
	} else {

} ?>
<b><?php echo _l("acp_adduser"); ?></b> <br />
<form action="index.php?r=4" method="POST" ENCTYPE="multipart/form-data" > 
	<table>
	<tr>
		<td><?php echo _l("user_name"); ?>: </td><td><input name="name" type="text" /></td>
	</tr>
	<tr>
		<td><?php echo _l("user_email"); ?>: </td><td><input name="email" type="text" /> </td>
	</tr>
	<tr>
		<td><?php echo _l("user_pass"); ?>: </td><td><input name="password" type="password" /> </td>
	</tr>
	<tr>
		<td><?php echo _l("user_repass"); ?>: </td><td><input name="repassword" type="password" /> </td>
	</tr>
	<tr>
		<td><?php echo _l("user_secretask"); ?>: </td><td><input name="secretask" type="text" /> </td>
	</tr>
	<tr>
		<td><?php echo _l("user_secretanswer"); ?>: </td><td><input name="secretanswer" type="text" /></td>
	</tr>
	<tr>
		<td><?php echo _l("user_level"); ?>: </td><td><select name="level"><option value="0"><?php echo _l("user_leveluser"); ?></option><option value="-1"><?php echo _l("user_banned"); ?></option><option value="1"><?php echo _l("user_mod"); ?></option><option value="2"><?php echo _l("user_admin"); ?></option></select></td>
	</tr>
</table>
<input type="submit">
</form>
<?php } else die("<script>location.href='index.php';</script>"); ?>
