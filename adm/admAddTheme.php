<?php
if (isset($inadm)) {
	if (isset($_GET["at"])) {
		$name = file_get_contents($ROOT."style/".$_GET["at"]."/info.txt");
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."style WHERE url='".mysql_real_escape_string($_GET["at"])."'");
		if (!mysql_num_rows($res)) mysql_query("INSERT INTO ".$MYSQL_PREFIX."style (name, url) VALUES ('$name', '".mysql_real_escape_string($_GET["at"])."');")or die (mysql_error());
		echo "<script>location.href='index.php'</script>";
	} else if (isset($_GET["dt"])) {
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."style WHERE url='".mysql_real_escape_string($_GET["dt"])."'");
		$row = mysql_fetch_array($res);
		if (mysql_num_rows($res)) {
			if ($row["id"] != getConfig("default_style")) mysql_query("DELETE FROM ".$MYSQL_PREFIX."style WHERE url='".mysql_real_escape_string($_GET["dt"])."'")or die (mysql_error());
			else echo "<script>alert('"._l("cms_styledeleteerror")."')</script>";
		}
		echo "<script>location.href='index.php'</script>";
	} else  { ?>
		<b><?php echo _l("acp_addtheme"); ?></b> <br />
		<?php
		if ($handle = opendir($ROOT."style")) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && is_dir($ROOT."style/".$entry))  {
					if (file_exists($ROOT."style/".$entry."/info.txt")) {
						$name = file_get_contents($ROOT."style/".$entry."/info.txt");
						$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."style WHERE url='".$entry."'");
						if (mysql_num_rows($res)) $existe = '<a href="index.php?r=15&dt='.$entry.'"><b>'._l("cms_delete").'</b></a>';
						else $existe = '<a href="index.php?r=15&at='.$entry.'"><b>'._l("cms_install").'</b></a>';
						echo $name." - ".$existe."<br>";
					}
				}
			}
			closedir($handle);
		}else echo _l("cms_dirnotfound")." lang";
	}
}
?>