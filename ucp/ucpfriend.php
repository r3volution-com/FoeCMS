<?php include("../config.php");
	include("../common.php");
	if (isset($_GET["f"]) && $_GET["f"] != 0 && CheckLogin()) {
		$user_row2 = fetchUser($_GET["f"]);
		if ($user_row2["id"] != $USER_ID) {
			$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE (user_send='".$user_row2["id"]."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$user_row2["id"]."')") or die(mysql_error());
			$row = mysql_num_rows($res);
			if ($row == 0) {
				mysql_query("INSERT INTO ".$MYSQL_PREFIX."friend (user_send, user_receive) VALUES ('".$user_row["id"]."','".$user_row2["id"]."');") or die(mysql_error());
			} else {
				$row = mysql_fetch_array($res);
				if ($row["alive"] != 0 && $row["alive"] != 2) {
					mysql_query("UPDATE ".$MYSQL_PREFIX."friend SET alive=2 WHERE (user_send='".$user_row2["id"]."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$user_row2["id"]."')") or die(mysql_error());
				} else {
					mysql_query("UPDATE ".$MYSQL_PREFIX."friend SET alive=1 WHERE (user_send='".$user_row2["id"]."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$user_row2["id"]."')") or die(mysql_error());
				}
			}
			die("<script>location.href='./ucpfriend.php?u=".$_GET["f"]."'</script>");
		} else {
			die("<script>location.href='../msg.php?e=uset_alreadyfriend'</script>");
		}
	} else if (isset($_GET["nf"]) && $_GET["nf"] != 0 && CheckLogin()) {
		$user_row2 = fetchUser($_GET["nf"]);
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE (user_send='".$user_row2["id"]."' AND user_receive='".$user_row["id"]."') OR (user_send='".$user_row["id"]."' AND user_receive='".$user_row2["id"]."')") or die(mysql_error());
		$row = mysql_num_rows($res);
		if ($row > 0) {
			$row = mysql_fetch_array($res);
			mysql_query("UPDATE ".$MYSQL_PREFIX."friend SET alive=0 WHERE (user_send='".$user_row2["id"]."' OR user_receive='".$user_row2["id"]."') AND (user_send='".$user_row["id"]."' OR user_receive='".$user_row["id"]."')") or die(mysql_error());
		} else {
			die("<script>location.href='../msg.php?e=uset_notfriend'</script>");
		}	
	} else if (checkLogin()) {
		if (isset($_GET["u"])) $user_row = fetchUser($_GET["u"]); 
		if ($user_row["id"]) $res = pagination("SELECT * FROM ".$MYSQL_PREFIX."friend WHERE (user_send='".$user_row["id"]."' OR user_receive='".$user_row["id"]."') AND alive=2 ORDER BY alive", getConfig("item_per_page"));
		else die("<script>location.href='../msg.php?e=user_notfound'</script>");
		include($STYLE_HTML."header.php");
		include($STYLE_HTML."ucpfriend_style.php");
		include($STYLE_HTML."footer.php");
	} else {
		if (!checkLogin(true)) goToLogin();
	}
?>
