<?php include("common.php");
include("include/store.inc.php");
if(!checkLogin(true)) goToLogin();
if (isset($_GET["fs"]) && $_GET["fs"]) {
	$res=mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE name LIKE '%".utf8_decode(mysql_real_escape_string($_GET['fs']))."%'");
	if (isset($_REQUEST['json'])) {
		header("Content-Type: application/json" );
		echo "{\"results\": [";
		$arr = array();
		while ($row=mysql_fetch_array($res)) {
			$arr[] = "{\"id\": \"".$row['id']."\", \"value\": \"".$row['name']."\", \"info\": \"\"}";
		}
		echo implode(", ", $arr);
		die("]}");
	} else {
		header("Content-Type: text/xml");
		echo '<?xml version="1.0" encoding="ISO-8859-1"?>
		<results>';
		while ($row=mysql_fetch_array($res)) {
			if ($row["name"]) echo '<rs id="'.$row['id'].'" info="">'.$row['name'].'</rs>';
		}
		die("</results>");	
	}
}
if ($_POST) {
	if ($_POST["name"]) {
		$u_res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."account WHERE username LIKE '%".$_POST["name"]."%'");
		$i_res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE name LIKE '%".$_POST["name"]."%'");
		$n_users = mysql_num_rows($u_res);
		$n_items = mysql_num_rows($i_res);
	} else if ($_POST["author"]) {
		$u_row = fetchUserBy("username", $_POST["author"]);
		$i_res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."item WHERE aportedby_id='".$u_row["id"]."'");
		$n_items = mysql_num_rows($i_res);
	} else if ($_POST["email"]) {
		$u_res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."account WHERE email='".$_POST["email"]."'");
		$n_users = mysql_num_rows($u_res);
	}
}
include($STYLE_HTML."header.php");
include($STYLE_HTML."search_style.php");
include($STYLE_HTML."footer.php");
?>