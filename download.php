<?php include("common.php");
include("include/store.inc.php");
if (checkLogin(true) && (isset($_GET["f"]) && $_GET["f"])) {
	$row = getItemById($_GET["f"]);
	$url = geturl(getcat($row['category_id']), $row['url'], "download");
	if ($url && file_exists($url)) {
		$ext = getext($url, 1);
		if ($ext == ".php2") $ext = ".php";
		header("Content-disposition: attachment; filename=".$row['url'].$ext);
		header("Content-type: application/octet-stream");
		readfile($url);
		$t_d = $row["times_downloaded"] + 1;
		mysql_query("UPDATE ".$MYSQL_PREFIX."item SET times_downloaded=$t_d WHERE id='".$row["id"]."'");
	} else {
		die ("<script>location.href='msg.php?e=item_baddownload';</script>");
	}
} else {
	die ("<script>location.href='msg.php?e=item_baddownload';</script>");
}
?>