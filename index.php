<?php 
include ("common.php");
if (isset($_GET["i"])) {
	setcookie(getConfig("cookie_prefix")."_lang", $_GET['i'], time() + 86400);
	$_SESSION[getConfig("cookie_prefix")."_lang"] = $_GET['i'];
	echo "<script>history.back();</script>";
}
if (isset($_GET["q"])) {
	unset($_SESSION[getConfig("cookie_prefix")."_lang"]);
	echo "<script>location.href='./index.php';</script>";
}
if (isset($_GET["t"]) && $_GET["t"] == 1 && (isset($_SESSION[getConfig("cookie_prefix")."_userid"]) || isset($_COOKIE[getConfig("cookie_prefix")."_userid"]))) { //Desloguear si estas logueado
	unset($_SESSION[getConfig("cookie_prefix")."_userid"]); 
	unset($_COOKIE[getConfig("cookie_prefix")."_userid"]); 
	setcookie (getConfig("cookie_prefix")."_userid", "", time() - 3600);
	echo "<script>location.href='./index.php'</script>"; 
}
if (checkLogin(true)) { //Comprobamos si la sesion esta iniciada
	include("store.php");
} else {
	include("login.php");
}
?>
