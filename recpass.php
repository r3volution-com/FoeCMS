<?php 
include("common.php");
if (!isset($_GET["stage"])) {
	if(isset($_POST["name"]) && $_POST["name"]) {
		$raw = fetchUserby("username", $_POST["name"]);
		if (!isset($_POST["email"]) || !$_POST["email"]) die("<script>location.href='./msg.php?e=user_emptyemail'</script>");
		if ($_POST["name"] != $raw["username"]) die("<script>location.href='./msg.php?e=user_notfound'</script>");
		if ($_POST["email"] != $raw["email"]) die("<script>location.href='./msg.php?e=user_emailnotexists'</script>");
		
		$_SESSION["changepass"] = $raw["id"];
		$headers = "From: ".getConfig("contact_mail");
		if (!getConfig("mail_recpass")) $mailtext = parseMetacodes(_l("user_recpassemail"), $raw["username"], $raw["email"], "/recpass.php?stage=2&i=".$raw["id"]);
		else $mailtext = parseMetacodes(_l("user_recpassemail"), $raw["username"], $raw["email"], $ROOT_HTML."recpass.php?stage=2&i=".$raw["id"]);
		mail($raw['email'], _l("user_recpass"), $mailtext, $headers);
		echo "<script>location.href='./msg.php?e=user_passemailsended'</script>";
	} else {
		include($STYLE_HTML."header.php");
		include($STYLE_HTML."recpass_style.php");
		include($STYLE_HTML."footer.php");
	}
} else if ($_GET["stage"] == 2) {
	if(isset($_SESSION["changepass"]) && $_SESSION["changepass"]) {
		if ($_SESSION["changepass"] != $_GET["i"]) die("<script>location.href='./msg.php?e=user_badrecpassform&c=".$_SESSION["changepass"]."'</script>");
		$row = fetchUser($_SESSION["changepass"]);
		if ($row["secret_ask"] != "") $secret_ask = $row["secret_ask"];
		else {
			if ($row["secret_answer_sha"] != "") $secret_ask = _l("user_nosecretask");
			else $secret_ask = _l("user_nosecretanwser");
		}
		if (isset($_POST["secretanswer"])) {
			if ($row["secret_answer_sha"] != "") {
				if ($_POST["secretanswer"] != "" && $row["secret_answer_sha"] == sha1($_POST["secretanswer"]) && $_POST["pw"] == $_POST["repw"]) {
					$sha_pw = mysql_real_escape_string(sha1($_POST["pw"]));
					$entry = "UPDATE ".$MYSQL_PREFIX."account SET pass_sha='$sha_pw' WHERE id='".$_SESSION["changepass"]."'";
					mysql_query($entry);
					echo "<script>location.href='./msg.php?e=user_passchsuccess'</script>";
				} else {
					echo "<script>location.href='./msg.php?e=user_badsecretanswer'</script>";
				}
			} else {
				if ($_POST["pw"] == $_POST["repw"]) {
					$sha_pw = mysql_real_escape_string(sha1($_POST["pw"]));
					$entry = "UPDATE ".$MYSQL_PREFIX."account SET pass_sha='$sha_pw' WHERE id='".$_SESSION["changepass"]."'";
					mysql_query($entry);
					echo "<script>location.href='./msg.php?e=user_passchsuccess'</script>";
				} else {
					echo "<script>location.href='./msg.php?e=user_badsecretanswer'</script>";
				}
			}
		} else {
			include($STYLE_HTML."header.php");
			include($STYLE_HTML."recpass_style.php");
			include($STYLE_HTML."footer.php");
		}
	} else die("<script>location.href='./msg.php?e=user_badrecpassform&c=".$_SESSION["changepass"]."'</script>");
}
?>
