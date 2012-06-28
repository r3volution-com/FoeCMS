<?php 
include("common.php");
if (isset($_GET["inv"]) && $_GET["inv"]) {
	$can_register = canRegister($_GET["inv"]);
} else {
	$can_register = canRegister();
}
if (isset($can_register) && $can_register > 0){
	if (isset($_POST["accountname"]) && isset($_POST["email"])) {
		if ($can_register == 2) {
			$inv_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."invitation WHERE inv_session LIKE '".mysql_real_escape_string($_GET["inv"])."'");
			if (!$inv_row["to_email"]) die("<script>location.href='./msg.php?e=cms_badinvitation&r=login.php'</script>");
		}
		if (!isset($_POST["accountname"]) || !$_POST["accountname"]) die("<script>location.href='./msg.php?e=user_emptynick&r=register.php'</script>");
		$register_row = fetchUserby("username", $_POST["accountname"]);
		if ($register_row["username"]) die("<script>location.href='./msg.php?e=user_nickinuse&r=register.php'</script>");
		if (!preg_match("#^[a-z][da-z_]{2,26}[a-zd]$#i", mysql_real_escape_string($_POST["accountname"]))) die("<script>location.href='./msg.php?e=user_badnick&r=register.php'</script>");
		
		if (!isset($_POST["pw"]) || !$_POST["pw"]) die("<script>location.href='./msg.php?e=user_emptypass&r=register.php'</script>");
		if ($_POST["pw"] != $_POST["repw"]) die("<script>location.href='./msg.php?e=user_badrepeatpass&r=register.php'</script>");
		if (strlen($_POST["pw"]) < 6 || strlen($_POST["pw"]) > 28) die("<script>location.href='./msg.php?e=user_badpass&r=register.php'</script>");
		
		if (!isset($_POST["email"]) || !$_POST["email"]) die("<script>location.href='./msg.php?e=user_emptyemail&r=register.php'</script>");
		$raw = fetchUserby("email", $_POST["email"]);
		if ($raw["email"]) die("<script>location.href='./msg.php?e=user_emailinuse&r=register.php'</script>");
		if (!checkEmail(mysql_real_escape_string($_POST["email"]))) die("<script>location.href='./msg.php?e=user_bademail&r=register.php'</script>");
		if ($_POST["email"] != $_POST["reemail"]) die("<script>location.href='./msg.php?e=user_badrepeatemail&r=register.php'</script>");
		
		if (!isset($_POST["secretask"]) || !$_POST["secretask"]) die("<script>location.href='./msg.php?e=user_emptysecretask&r=register.php'</script>");
		if (!isset($_POST["secretanswer"]) || !$_POST["secretanswer"]) die("<script>location.href='./msg.php?e=user_emptysecretanswer&r=register.php'</script>");
		
		$entry = "INSERT INTO ".$MYSQL_PREFIX."account (username, pass_sha, email, secret_ask, secret_answer_sha) VALUES ('".mysql_real_escape_string($_POST["accountname"])."','".sha1(mysql_real_escape_string($_POST["pw"]))."', '".mysql_real_escape_string($_POST["email"])."', '".cleanTags($_POST["secretask"])."', '".sha1($_POST["secretanswer"])."');";
		mysql_query($entry) or die(mysql_error());
		if ($can_register == 2) mysql_query("UPDATE ".$MYSQL_PREFIX."invitation SET active=0 WHERE inv_session LIKE '".mysql_real_escape_string($_GET["inv"])."';") or die(mysql_error());
		$headers = "From: ".getConfig("contact_mail");
		if (!getConfig("mail_register")) $emailtext=parseMetacodes(_l("cms_wellcomeEmail"), $_POST["accountname"], $_POST["email"], "", $_POST["pw"]);
		else $emailtext=parseMetacodes(getConfig("mail_register"), $_POST["accountname"], $_POST["email"], "", $_POST["pw"]);
		mail($_POST['email'], _l("cms_wellcome"), $emailtext, $headers );
		echo "<script>location.href='./msg.php?e=user_registersuccess&r=login.php'</script>";
	} else {
		include($STYLE_HTML."header.php");
		include($STYLE_HTML."register_style.php");
		include($STYLE_HTML."footer.php");
	}
} else if (isset($can_register) && $can_register<0){
	echo "<script>location.href='./msg.php?e=cms_cantregister&r=login.php'</script>";
} else if (isset($can_register) && $can_register==0){
	echo "<script>location.href='./msg.php?e=user_badinvitation&r=login.php'</script>";
} else {
	echo "<script>location.href='./login.php'</script>";	
} ?>