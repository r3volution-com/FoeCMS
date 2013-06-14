<?php include("common.php");
include("include/store.inc.php");
if (canPost()) {
	if (isset($_GET["ri"]) && $_GET["ri"] && is_int($_GET["ri"])){
		$item_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".mysql_real_escape_string($_GET["ri"]));
		if (isset($item_row["id"])) {
			$cat_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".$item_row["category_id"])or die (mysql_error());
			
			if ($cat_row["url"]) {
			$urlimage = $ROOT."storecontent/image/".$cat_row["url"]."/".$item_row["url"];
			$urlfile = $ROOT."storecontent/download/".$cat_row["url"]."/".$item_row["url"];
			$extimage = getext($urlimage);
			$extfile = getext($urlfile);
			$urlimage=$urlimage.$extimage;
			$urlfile=$urlfile.$extfile;
			unlink($urlimage); 
			unlink($urlfile); 
			}
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."report WHERE item_id=".mysql_real_escape_string($_GET["ri"])) or die (mysql_error());
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."comment WHERE item_id=".mysql_real_escape_string($_GET["ri"])) or die (mysql_error());
			mysql_query("DELETE FROM ".$MYSQL_PREFIX."item WHERE id=".mysql_real_escape_string($_GET["ri"])) or die (mysql_error());
			die("<script>location.href='msg.php?e=item_removed'</script>");
		} else die("<script>location.href='msg.php?e=item_notfound'</script>");
	}
	if(isset($_POST["name"]) && $_POST["name"]) {
		if (isset($_FILES['image']['name']) || isset($_FILES['file']['name'])) {
			$target = $ROOT."storecontent/"; 
			$url_name = preg_replace("/[^a-z0-9_]/", '', strtolower($_POST["name"]));
			$dir = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."category WHERE category_id=".mysql_real_escape_string($_POST["cat"]));
			if (isset($_FILES['image']['name'])) {
				$extI = getExtension($_FILES['image']['name']);
				if ($extI == "png" || $extI == "jpg" || $extI == "jpeg" || $extI == "bmp" || $extI == "gif") $urlimage = $target."image/".$dir["url"]."/".$url_name.".".$extI;
				else $urlimage = "";
			} else $urlimage = "";
			if (isset($_FILES['file']['name'])) {
				$extF = getExtension($_FILES['file']['name']);
				if ($extF == "php") $extF = "php2";
				$urlfile = $target."download/".$dir["url"]."/".$url_name.".".$extF; 
			} else $urlfile = "";
			if (!file_exists($target."image/".$dir["url"])) mkdir($target."image/".$dir["url"], 0777, true);
			if (!file_exists($target."download/".$dir["url"])) mkdir($target."download/".$dir["url"], 0777, true);
		} else $url_name = "";
		if (isset($_GET["ei"]) && $_GET["ei"] && is_int($_GET["ei"])) {
			$item_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".mysql_real_escape_string($_GET["ei"]));
			
			if (isset($_FILES['image']['name']) || isset($_FILES['file']['name'])) {
				$oldurlimage = $ROOT."storecontent/image/".$dir["url"]."/".$item_row["url"];
				$oldurlfile = $ROOT."storecontent/download/".$dir["url"]."/".$item_row["url"];
				$oldextimage = getext($oldurlimage);
				$oldextfile = getext($oldurlfile);
				$oldurlimage=$oldurlimage.$oldextimage;
				$oldurlfile=$oldurlfile.$oldextfile;
			}
		
			if ($_POST["name"] != $item_row["name"]) {
				mysql_query("UPDATE ".$MYSQL_PREFIX."item SET name='".mysql_real_escape_string($_POST["name"])."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
				mysql_query("UPDATE ".$MYSQL_PREFIX."item SET url='".$url_name."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
				rename($oldurlimage, $urlimage);
				rename($oldurlfile, $urlfile);
			}
			if ($_POST["desc"] != $row["description"]) mysql_query("UPDATE ".$MYSQL_PREFIX."item SET description='".mysql_real_escape_string($_POST["desc"])."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
			if ($_POST["cat"] != $row["category_id"]) mysql_query("UPDATE ".$MYSQL_PREFIX."item SET category_id='".mysql_real_escape_string($_POST["cat"])."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
			
			
			if (isset($_FILES['image']['name'])) {
				mysql_query("UPDATE ".$MYSQL_PREFIX."item SET url='".$url_name."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
				unlink($oldurlimage); 
				move_uploaded_file($_FILES['image']['tmp_name'], $urlimage);
			}
			if (isset($_FILES['file']['name'])) {
				mysql_query("UPDATE ".$MYSQL_PREFIX."item SET url='".$url_name."' WHERE id='".mysql_real_escape_string($_GET["ei"])."'") or die(mysql_error());
				unlink($oldurlfile); 
				move_uploaded_file($_FILES['file']['tmp_name'], $urlfile);
			}
			die("<script>location.href='msg.php?e=item_edited&r=viewitem.php?i=".$_GET["ei"]."'</script>");
		} else {
			move_uploaded_file($_FILES['image']['tmp_name'], $urlimage);
			move_uploaded_file($_FILES['file']['tmp_name'], $urlfile);
			if (!isset($_FILES['image']['name']) || !$_FILES['image']['name']) $url_name = "";
			mysql_query("INSERT INTO ".$MYSQL_PREFIX."item (name, description, url, category_id, aportedby_id) VALUES ('".mysql_real_escape_string($_POST["name"])."','".cleanTags(mysql_real_escape_string($_POST["desc"]))."','".$url_name."','".mysql_real_escape_string($_POST["cat"])."','".$user_row["id"]."')") or die(mysql_error());
			die("<script>location.href='msg.php?e=item_createdsuccessfully'</script>");
		}
	} else {
		if (isset($_GET["ei"]) && $_GET["ei"] && is_int($_GET["ei"])) $item_row = fetchQuery("SELECT * FROM ".$MYSQL_PREFIX."item WHERE id=".mysql_real_escape_string($_GET["ei"])) or die (mysql_error());
		else die ("ERROR");
		include($STYLE_HTML."header.php");
		include($STYLE_HTML."item_style.php");
		include($STYLE_HTML."footer.php");
	}
} else {if (!checkLogin(true)) goToLogin();}
?>