<div id="logo"></div>
<?php $last_user = getLastUser(); ?>
<div align="center" id="inbox">
<form action="login.php<?php if (isset($_GET["r"]) && $_GET["r"]) echo "?r=".$_GET["r"]; ?>" method="POST"> 
<b><?php echo _l("user_name").": "; ?></b><br><input name="name" type="text" /><br /><br />
<b><?php echo _l("user_pass").": "; ?></b><br><input name="pass" type="password" /><br /><br />
<input name="remcookie" type="checkbox" /> <b><?php echo _l("cms_sessionremember"); ?></b><br />
<input type="submit" id="button" value="<?php echo _l("user_login"); ?>" />
</form>
<?php echo putLangFlags(getFlags(), "", ""); ?><br/>
<?php if(canRegister() >= 0) { ?><a href="register.php" style='text-decoration:none;color:black;'><?php echo _l("user_register"); ?> | </a><?php } ?><a href="recpass.php" style='text-decoration:none;color:black;'><?php echo _l("user_recpass"); ?></a></b>
<br>
<?php echo sprintf(_l("cms_lastuser"), "<b>".$last_user["id"]."</b>", "<b>".$last_user["username"]."</b>");?></div>