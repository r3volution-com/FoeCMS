<?php
if (isset($inadm)) {
	if (isset($_GET["al"])) {
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."lang WHERE lang='".mysql_real_escape_string($_GET["all"])."'");
		if (!mysql_num_rows($res) && file_exists($ROOT."lang/".$_GET["al"]."/".$_GET["al"].".php")) mysql_query("INSERT INTO ".$MYSQL_PREFIX."lang (lang) VALUES ('".mysql_real_escape_string($_GET["al"])."');")or die (mysql_error());
		echo "Editado";
	} else if (isset($_GET["dl"])) {
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."lang WHERE lang='".mysql_real_escape_string($_GET["dl"])."'");
		if (mysql_num_rows($res) && file_exists($ROOT."lang/".$_GET["dl"]."/".$_GET["dl"].".php")) mysql_query("DELETE FROM ".$MYSQL_PREFIX."lang WHERE lang='".mysql_real_escape_string($_GET["dl"])."'")or die (mysql_error());
		echo "Editado";
	} else  { ?>
		<b><?php echo _l("acp_addlang"); ?></b> <br />
		<?php
		if ($handle = opendir($ROOT."lang")) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && is_dir($ROOT."lang/".$entry))  {
					if (file_exists($ROOT."lang/".$entry."/".$entry.".php")) {
						$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."lang WHERE lang='".$entry."'");
						if (mysql_num_rows($res)) $existe = '<a href="index.php?r=16&dl='.$entry.'"><b>Borrar</b></a>';
						else $existe = '<a href="index.php?r=16&al='.$entry.'"><b>Instalar</b></a>';
						echo $entry." - ".$existe."<br>";
					}
				}
			}
			closedir($handle);
		}else echo "Error no existe el directorio lang";
	}
}
?>