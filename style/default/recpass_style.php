<div id="logo"></div><div align="center" id="inbox">
<?php if (!isset($_GET["stage"])) { ?>
	<form action="recpass.php" method="POST"> 
<b>	<?php echo _l("user_name").": "; ?></b><br /><input name="name" type="text" /> <p id="loading"></p><br />
<b>	<?php echo _l("user_email").": "; ?></b><br /><input name="email" type="text" /> <p id="loading"></p><br />
	<input type="submit" id="button" value="GO!" /></div>
	</form>
<?php } else if ($_GET["stage"] == 2) { ?>
	<form action="recpass.php?stage=2&i=<?php echo $_GET["i"]; ?>" method="POST"> 
	<b><?php echo _l("user_secretask").":</b> ".$secret_ask; ?><br /><br />
	<?php echo _l("user_secretanswer").": "; ?><br /><input name="secretanswer" type="password" /><br /><br /><br />
	<?php echo _l("user_pass").": "; ?><br /><input name="pw" type="password" /><br />
	<?php echo _l("user_repass").": "; ?><br /><input name="repw" type="password" /><br />
	<input type="submit" id="button" value="GO!" />
	</form>
<?php } ?>
</div>