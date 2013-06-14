<?php 
include("../common.php");
if (checkLogin() && $_GET["u"] == $_SESSION[getConfig("cookie_prefix")."_userid"]) header("location: index.php");
if (isset($_GET["u"]) && is_int($_GET["u"]) && checkLogin()) {
	$user_row = fetchUser($_GET["u"]);
	if (isset($user_row["id"])) {
		$user_row["visitor_number"]++;
		if ($user_row["id"] != $_SESSION[getConfig("cookie_prefix")."_userid"]) mysql_query("UPDATE ".$MYSQL_PREFIX."account SET visitor_number=".$user_row["visitor_number"]."+1 WHERE id='".mysql_real_escape_string($_GET["u"])."'") or die(mysql_error());
		if (isset($_GET["r"]) && $user_row["id"] != $_SESSION[getConfig("cookie_prefix")."_userid"]) {
			$repact = $user_row["reputation"];
			if ($_GET["r"] == 1) {
				$repnew = $repact+1;
				mysql_query("UPDATE ".$MYSQL_PREFIX."account SET reputation='".$repnew."' WHERE id='".mysql_real_escape_string($_GET["u"])."'") or die(mysql_error());
			} else {
				$repnew = $repact-1;
				mysql_query("UPDATE ".$MYSQL_PREFIX."account SET reputation='".$repnew."' WHERE id='".mysql_real_escape_string($_GET["u"])."'") or die(mysql_error());
			}
			echo "<script>location.href='./ucpviewprofile.php?u=".$_GET["u"]."'</script>";
		} else {
			$res_item = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE aportedby_id='".$user_row["id"]."'") or die(mysql_error());
			$res_comment = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."comment WHERE user_id='".$user_row["id"]."'") or die(mysql_error());
			$ext = 1;
			include($STYLE_HTML."header.php");
			include($STYLE_HTML."ucpviewprofile_style.php");
			include($STYLE_HTML."footer.php");
		}
	} else die("<script>location.href='../index.php'</script>");
} else if (!checkLogin()) goToLogin();
?>