<?php 
include("common.php");
if (checkLogin()) die("<script>location.href='index.php'</script>");

if (isset($_POST["name"]) && $_POST["pass"]) { //Comprueba si esta en la pantalla de login o se esta logueando
	$row = fetchUserby("username", $_POST["name"]);
	if (isset($_GET["r"])) $ret = "&r=".$_GET["r"];
	else $ret = "&r=login.php";
	if (!isset($row["username"])) { header("Location: msg.php?e=user_namenotfound".$ret); die();} //Comprueba que realmente haya devuelto que lo que debia
	if ($row["pass_sha"] != sha1($_POST['pass'])) { header("Location: msg.php?e=user_passnotmatch".$ret); die(); } //Comprueba que realmente haya devuelto que lo que debia
	if ($row["level"] < 0) { header("Location: msg.php?e=user_accountbanned"); die();}
	
	if (getConfig("web_access") || $row["level"] == 2) {
		if (isset($_POST["remcookie"]) && $_POST["remcookie"] == "on") {
			setcookie(getConfig("cookie_prefix")."_userid", $row["id"], time() + 86400);
			$_SESSION[getConfig("cookie_prefix")."_userid"] = $row["id"];
		} else {
			$_SESSION[getConfig("cookie_prefix")."_userid"] = $row["id"];
		}
		$ret = "";
		if (isset($_GET["r"])) $ret = "&r=".$_GET["r"];
		die("<script>location.href='./msg.php?e=user_logsuccess".$ret."'</script>");
	} else die("<script>location.href='./msg.php?e=cms_loginclosed".$ret."'</script>");
} else { 
	include($STYLE_HTML."header.php");
	include($STYLE_HTML."login_style.php");
	include($STYLE_HTML."footer.php");
} ?>