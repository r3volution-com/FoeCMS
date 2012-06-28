<?php 
	include("../common.php");
	if (!checkLogin()) goToLogin();
	if (isset($_GET["c"])) {
		$cat = $_GET["c"];
	} else {
		$cat = 0;
	}
	include($STYLE_HTML."header.php"); 
	if ($cat == 0) {
		$res_item = pagination("SELECT * FROM ".$MYSQL_PREFIX."item WHERE aportedby_id='".$user_row["id"]."'", getConfig("item_per_page"), "pgi");
		$res_comment = pagination("SELECT * FROM ".$MYSQL_PREFIX."comment WHERE user_id='".$user_row["id"]."'", getConfig("item_per_page"), "pgc");
		include($STYLE_HTML."ucpviewprofile_style.php");
	} else if ($cat == 1) {
		if (isset($_POST["email"]) && $_POST["email"] != "" && $_POST["email"] != $user_row["email"]) {
			$row = fetchUserby("email", $_POST["email"]);
			$newemail = mysql_real_escape_string($_POST["email"]);
			if ($newemail != $row["email"]) {
				setUser("email", $newemail);
				die ("<script>location.href='../msg.php?e=user_emailchanged&r='+location.href;</script>");
			} else {
				die ("<script>location.href='../msg.php?e=user_bademail&r='+location.href;</script>");
			}
		} else if (isset($_POST["oldpw"]) && isset($_POST["newpw"]) && isset($_POST["renewpw"]) && $_POST["oldpw"] != "" && $_POST["newpw"] != "" && $_POST["renewpw"] != "") {
			$actpw = $user_row["pass_sha"];
			$oldpw = sha1(mysql_real_escape_string($_POST["oldpw"]));
			$newpw = mysql_real_escape_string($_POST["newpw"]);
			if ($actpw == $oldpw && $newpw == $_POST["renewpw"]) {
				setUser("pass_sha", sha1($newpw));
				die ("<script>location.href='../msg.php?e=user_passchanged&r='+location.href;</script>");
			} else {
				die ("<script>location.href='../msg.php?e=user_badpass&r='+location.href;</script>");
			}
		} else if (isset($_POST["secretask"]) && isset($_POST["secretanswer"]) && $_POST["secretask"] != "" && $_POST["secretanswer"] != "" && $_POST["secretask"] != $user_row["secret_ask"] && $_POST["secretanswer"] != $user_row["secret_answer_sha"]) {
			$sask = $_POST["secretask"];
			$sanswer = $_POST["secretanswer"];
			$secret_ask = mysql_real_escape_string($sask);
			$secret_answer = mysql_real_escape_string(sha1($sanswer));
			$old_secret_ask = $user_row["secret_ask"];
			$old_secret_answer = $user_row["secret_answer_sha"];
			if ($secret_ask != $old_secret_ask) {
				setUser("secret_ask", $secret_ask);
				setUser("secret_answer_sha", $secret_answer);
				die ("<script>location.href='../msg.php?e=user_secretaskchanged&r='+location.href;</script>");
			} else {
				die ("<script>location.href='../msg.php?e=user_badsecretask&r='+location.href;</script>");
			}
		} else if ((isset($_FILES['avatarf']['name']) && $_FILES['avatarf']['name']) || (isset($_POST["avataru"]) && $_POST["avataru"] != $user_row["avatar"])) {
			if ($_FILES['avatarf']['name']) {
				if ($user_row["avatar"] && !strstr($user_row["avatar"], 'http://')) unlink($user_row["avatar"]); 
				if (!file_exists($ROOT."storecontent/image/avatar")) mkdir($ROOT."storecontent/image/avatar", 0777, true);
				$extI = getExtension($_FILES['avatarf']['name']);
				if ($extI == "png" || $extI == "jpg" || $extI == "jpeg" || $extI == "bmp" || $extI == "gif") {
					$filer = $ROOT."storecontent/image/avatar/".basename($_FILES['avatarf']['name']); 
					$file = $ROOT_HTML."storecontent/image/avatar/".basename($_FILES['avatarf']['name']); 
					move_uploaded_file($_FILES['avatarf']['tmp_name'], $filer);
				} else $file = "";
			} else if ($_POST["avataru"] && strstr($_POST["avataru"], 'http://')) {
				$file = $_POST["avataru"];
			}
			setUser("avatar", $file);
			die ("<script>location.href='../msg.php?e=user_avatarchanged&r='+location.href;</script>");
		} 
		if (isset($_POST["style"]) && $_POST["style"] != $user_row["style_id"]) setUser("style_id", $_POST["style"]);
		if (isset($_POST["sex"]) && $_POST["sex"] != $user_row["sex"]) setUser("sex", $_POST["sex"]);
		if (isset($_POST["firm"]) && $_POST["firm"] != $user_row["firm"]) setUser("firm", $_POST["firm"]);
		if (isset($_POST["website"]) && $_POST["website"] != $user_row["website"]) setUser("website", $_POST["website"]);
		include($STYLE_HTML."ucpedit_style.php");
	} else if ($cat == 2) {
		if (isset($_POST["receiver"])) {
			$row = fetchUserby("username", $_POST["receiver"]);
			if ($row["id"] && ($row["id"] != $user_row["id"])) {
				mysql_query("INSERT INTO ".$MYSQL_PREFIX."mp (idsend, idreceive, topic, message) VALUES ('".$user_row["id"]."','".$row["id"]."', '".cleanTags($_POST["topic"])."', '".cleanTags($_POST["message"])."');") or die(mysql_error());
				$headers = "From: ".getConfig("contact_mail");
				if (!getConfig("mail_mp")) $emailtext = parseMetacodes(_l("mp_emailtext"), $row["username"], $row["email"], "http://".$_SERVER['HTTP_HOST']."/ucp/index.php?c=2");
				else  $emailtext = parseMetacodes(getConfig("mail_mp"), $row["username"], $row["email"], "http://".$_SERVER['HTTP_HOST']."/ucp/index.php?c=2");
				mail($row['email'], _l("mp_email"), $emailtext, $headers);
				die ("<script>location.href='../msg.php?e=mp_success&r='+location.href;</script>");
			} else {
				die ("<script>location.href='../msg.php?e=mp_error&r='+location.href;</script>");
			}
		} else {
			include($STYLE_HTML."ucpmp_style.php");
		}
	} else if ($cat == 3) {
		$idYo = $user_row["id"];
		$resIn = pagination("SELECT * FROM ".$MYSQL_PREFIX."mp WHERE idreceive='$idYo'", getConfig("item_per_page"), "pgin");
		$resOut = pagination("SELECT * FROM ".$MYSQL_PREFIX."mp WHERE idsend='$idYo'", getConfig("item_per_page"), "pgout");
		include($STYLE_HTML."ucpbox_style.php");
	} else if ($cat == 4) {
		$res = pagination("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE ((user_send='".$user_row["id"]."' OR user_receive='".$user_row["id"]."') AND alive=2) OR (user_receive='".$user_row["id"]."' AND alive=1) ORDER BY alive", getConfig("item_per_page"));
		include($STYLE_HTML."ucpfriend_style.php");
	} else if ($cat == 5) {
		if (isset($_POST["email"]) && checkEmail($_POST["email"])) {
			$to_email = mysql_real_escape_string($_POST["email"]);
			$row4 = fetchUserBy('email', $to_email);
			if ($row4["email"] == $to_email) die("oops");
			$session_inv = sha1($user_row["id"].$to_email.time());
			mysql_query("INSERT INTO ".$MYSQL_PREFIX."invitation (`from_user`, `to_email`, `inv_session`, `active`) VALUES ('".$user_row["id"]."', '".$to_email."', '".$session_inv."', '1');");
			$current_inv = $user_row["invitation"] - 1;
			mysql_query("UPDATE ".$MYSQL_PREFIX."account SET invitation=$current_inv WHERE id='".$user_row["id"]."'") or die(mysql_error());
			$headers = "From: ".getConfig("contact_mail");
			if (!getConfig("mail_invitation")) $emailtext = parseMetacodes(_l("user_emailinvitation"), "", $to_email, "http://".$_SERVER['HTTP_HOST']."/ucp/index.php?c=3");
			else  $emailtext = parseMetacodes(getConfig("mail_invitation"), "", $to_email, "http://".$_SERVER['HTTP_HOST']."/ucp/index.php?c=3");
			mail($to_email, _l("mp_email"), $emailtext, $headers);
		}
		if (isset($session_inv)) die(_l("user_invitationsended").': <a href="../register.php?inv='.$session_inv.'">http://'.$_SERVER['HTTP_HOST'].'/register.php?inv='.$session_inv.'</a>');
		$res_inv = pagination("SELECT * FROM ".$MYSQL_PREFIX."invitation WHERE from_user=".$user_row["id"], getConfig("item_per_page"));
		include ($STYLE_HTML."ucpsendinvitation_style.php");
	} 
include($STYLE_HTML."footer.php");
?>
