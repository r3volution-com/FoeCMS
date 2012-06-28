<?php 
if (isset($inadm) && $inadm == 2) {
	if (isset($_POST["webname"]) && ($_POST["webname"] != getConfig("name"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webname"]."'WHERE param LIKE 'name'") or die (mysql_error());
	if (isset($_POST["webdesc"]) && ($_POST["webdesc"] != getConfig("description"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webdesc"]."'WHERE param LIKE 'description'") or die (mysql_error());
	if (isset($_POST["webkey"]) && ($_POST["webkey"] != getConfig("keywords"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webkey"]."'WHERE param LIKE 'keywords'") or die (mysql_error());

	if (isset($_POST["ipp"]) && ($_POST["ipp"] != getConfig("item_per_page"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["ipp"]."'WHERE param LIKE 'item_per_page'") or die (mysql_error());
	
	if (isset($_POST["defaultstyle"]) && ($_POST["defaultstyle"] != getConfig("default_style"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["defaultstyle"]."'WHERE param LIKE 'default_style'") or die (mysql_error());
	
	if (isset($_POST["webmail"]) && ($_POST["webmail"] != getConfig("contact_mail"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webmail"]."'WHERE param LIKE 'contact_mail'") or die (mysql_error());
	if (isset($_POST["cookieprefix"]) && ($_POST["cookieprefix"] != getConfig("cookie_prefix"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["cookieprefix"]."'WHERE param LIKE 'cookie_prefix'") or die (mysql_error());
	
	if (isset($_POST["guestaccess"]) && ($_POST["guestaccess"] != getConfig("guest_access"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["guestaccess"]."'WHERE param LIKE 'guest_access'") or die (mysql_error());
	if (isset($_POST["guestcomment"]) && ($_POST["guestcomment"] != getConfig("guest_comment"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["guestcomment"]."'WHERE param LIKE 'guest_comment'") or die (mysql_error());
	if (isset($_POST["guestdownload"]) && ($_POST["guestdownload"] != getConfig("guest_download"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["guestdownload"]."'WHERE param LIKE 'guest_download'") or die (mysql_error());
	if (isset($_POST["guestvote"]) && ($_POST["guestvote"] != getConfig("guest_vote"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["guestvote"]."'WHERE param LIKE 'guest_vote'") or die (mysql_error());
	if (isset($_POST["guestpost"]) && ($_POST["guestpost"] != getConfig("guest_post"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["guestpost"]."'WHERE param LIKE 'guest_post'") or die (mysql_error());
	if (isset($_POST["register"])&& ($_POST["register"] != getConfig("guest_register"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["register"]."'WHERE param LIKE 'guest_register'") or die (mysql_error());
	if (isset($_POST["registerwithoutinv"])&& ($_POST["registerwithoutinv"] != getConfig("guest_register_without_inv"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["registerwithoutinv"]."'WHERE param LIKE 'guest_register_without_inv'") or die (mysql_error());
	
	if (isset($_POST["usercomment"]) && ($_POST["usercomment"] != getConfig("user_comment"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["usercomment"]."'WHERE param LIKE 'user_comment'") or die (mysql_error());
	if (isset($_POST["userdownload"]) && ($_POST["userdownload"] != getConfig("user_download"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["userdownload"]."'WHERE param LIKE 'user_download'") or die (mysql_error());
	if (isset($_POST["uservote"]) && ($_POST["uservote"] != getConfig("user_vote"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["uservote"]."'WHERE param LIKE 'user_vote'") or die (mysql_error());
	if (isset($_POST["userpost"]) && ($_POST["userpost"] != getConfig("user_post"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["userpost"]."'WHERE param LIKE 'user_post'") or die (mysql_error());
	
	if (isset($_POST["notepanel"]) && ($_POST["notepanel"] != getConfig("note_panel"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["notepanel"]."'WHERE param LIKE 'note_panel'") or die (mysql_error());
	if (isset($_POST["regemail"]) && ($_POST["regemail"] != getConfig("mail_register"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["regemail"]."'WHERE param LIKE 'mail_register'") or die (mysql_error());
	if (isset($_POST["recpassemail"]) && ($_POST["recpassemail"] != getConfig("mail_recpass"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["recpassemail"]."'WHERE param LIKE 'mail_recpass'") or die (mysql_error());
	if (isset($_POST["mpemail"]) && ($_POST["mpemail"] != getConfig("mail_mp"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["mpemail"]."'WHERE param LIKE 'mail_mp'") or die (mysql_error());
	if (isset($_POST["invemail"]) && ($_POST["invemail"] != getConfig("mail_invitation"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["invemail"]."'WHERE param LIKE 'mail_invitation'") or die (mysql_error());
	
	if (isset($_POST["seeprofile"]) && ($_POST["seeprofile"] != getConfig("see_profile"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["seeprofile"]."'WHERE param LIKE 'see_profile'") or die (mysql_error());
	if (isset($_POST["seefriends"]) && ($_POST["seefriends"] != getConfig("see_friends"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["seefriends"]."'WHERE param LIKE 'see_friends'") or die (mysql_error());
	
	if (isset($_POST["seourl"]) && ($_POST["seourl"] != getConfig("seo_url"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["seourl"]."'WHERE param LIKE 'seo_url'") or die (mysql_error());
	if (isset($_POST["webaccess"]) && ($_POST["webaccess"] != getConfig("web_access"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webaccess"]."'WHERE param LIKE 'web_access'") or die (mysql_error());
	
	if (isset($_POST["webaccesstext"]) && ($_POST["webaccesstext"] != getConfig("web_access_text"))) mysql_query("UPDATE ".$MYSQL_PREFIX."config SET value='".$_POST["webaccesstext"]."'WHERE param LIKE 'web_access_text'") or die (mysql_error());
	
	
	if (((isset($_POST["seourl"]) && $_POST["seourl"]) || (isset($_POST["webaccess"]) && !$_POST["webaccess"])) && checkSEO()) {
		$fp = fopen("../.htaccess","w");
		fwrite($fp, 'Options Indexes FollowSymLinks
		RewriteEngine On
		RewriteBase /
		');
		if ((isset($_POST["seourl"]) && $_POST["seourl"]) && checkSEO()) {
			fwrite($fp, '
			RewriteRule ^store/(.+)/*$ store.php?c=$1
			RewriteRule ^item/(.+)/*$ viewitem.php?i=$1
			RewriteRule ^profile/(.+)/*$ ucp/ucpviewprofile.php?u=$1
			RewriteRule ^comment/(.+)/*$ comment.php?i=$1
			');
		}
		if ((isset($_POST["webaccess"]) && $_POST["webaccess"] == -1) && checkSEO()) {
			fwrite($fp, '
			RewriteCond %{REQUEST_URI} !mantenimiento.html
			RewriteCond %{REQUEST_URI} !adm/*
			RewriteCond %{REQUEST_URI} !include/
			RewriteCond %{REQUEST_URI} !include/*
			RewriteCond %{REQUEST_URI} !lang/
			RewriteCond %{REQUEST_URI} !lang/*
			RewriteRule $ mantenimiento.html [R=302,L]');
			$fap = fopen("../mantenimiento.html","w+");
			if ($_POST["webaccesstext"]) $mantenimiento = $_POST["webaccesstext"];
			else $mantenimiento = _l("cms_webclosed");
			fwrite($fap, $mantenimiento);
			fclose($fap);
		}
		fclose($fp);
	} 
	
	if (isset($_POST["webname"])) echo "<script>alert('done!');location.href='./index.php'</script>";
	
?>
<b><?php echo _l("acp_editconfig"); ?></b> <br />
<form action="index.php?r=12" method="POST">
	<table align="center">
		<tr>
			<td colspan="2" align="center"><h1><?php echo _l("acp_cmsconfig"); ?></h1></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_webname"); ?>:</td><td><input type="text" name="webname" value="<?php echo getConfig("name"); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_webdesc"); ?>:</td><td><input type="text" name="webdesc" value="<?php echo getConfig("description"); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_webkeywords"); ?>:</td><td><input type="text" name="webkey" value="<?php echo getConfig("keywords"); ?>" /> - <?php echo _l("acp_webkeywordsnote"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_defaultstyle"); ?>:</td><td><select name="defaultstyle"><?php $res = getStyles();
		while ($row = mysql_fetch_array($res)) {
			if ($user_row["style_id"] != $row["id"]) echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			else echo '<option selected="selected" value="'.$row["id"].'">'.$row["name"].'</option>';
		} ?></select></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_contactmail"); ?>:</td><td><input type="text" name="webmail" value="<?php echo getConfig("contact_mail"); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_cookieprefix"); ?>:</td><td><input type="text" name="cookieprefix" value="<?php echo getConfig("cookie_prefix"); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_itemperpage"); ?>:</td><td><input type="text" name="ipp" value="<?php echo getConfig("item_per_page"); ?>" value="10" /></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_notepanel"); ?>:</td><td><textarea name="notepanel"><?php echo getConfig("note_panel"); ?></textarea></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_registeremail"); ?>:*</td><td><textarea name="regemail"><?php echo getConfig("mail_register"); ?></textarea></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_recpassemail"); ?>:*</td><td><textarea name="recpassemail"><?php echo getConfig("mail_recpass"); ?></textarea></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_mpemail"); ?>:*</td><td><textarea name="mpemail"><?php echo getConfig("mail_mp"); ?></textarea>%s -> sended_to</td>
		</tr>
		<tr>
			<td><?php echo _l("acp_invitationemail"); ?>:*</td><td><textarea name="invemail"><?php echo getConfig("mail_invitation"); ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2">*: <?php echo _l("acp_codereplacesemail"); ?></a></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_seourl"); ?>:</td><td><input type="radio" name="seourl" value="1" <?php if (getConfig("seo_url")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="seourl" value="0" <?php if (!getConfig("seo_url")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_webaccess"); ?>:</td><td><input type="radio" name="webaccess" value="-1" <?php if (getConfig("web_access") == -1 ) echo 'checked="checked"'; ?> /><?php echo _l("cms_closeall"); ?> - <input type="radio" name="webaccess" value="0" <?php if (!getConfig("web_access")) echo 'checked="checked"'; ?> /><?php echo _l("cms_closelogin"); ?> - <input type="radio" name="webaccess" value="1" <?php if (getConfig("web_access") == 1) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_webaccesstext"); ?>:</td><td><textarea name="webaccesstext"><?php echo getConfig("web_access_text"); ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h1><?php echo _l("acp_permissionsconfig"); ?></h1></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestaccess"); ?>:</td><td><input type="radio" name="guestaccess" value="1" <?php if (getConfig("guest_access")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="guestaccess" value="0" <?php if (!getConfig("guest_access")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestcomment"); ?>:</td><td><input type="radio" name="guestcomment" value="1" <?php if (getConfig("guest_comment")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="guestcomment" value="0" <?php if (!getConfig("guest_comment")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestdownload"); ?>:</td><td><input type="radio" name="guestdownload" value="1" <?php if (getConfig("guest_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="guestdownload" value="0" <?php if (!getConfig("guest_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestvote"); ?>:</td><td><input type="radio" name="guestvote" value="1" <?php if (getConfig("guest_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="guestvote" value="0" <?php if (!getConfig("guest_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestpost"); ?>:</td><td><input type="radio" name="guestpost" value="1" <?php if (getConfig("guest_post")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="guestpost" value="0" <?php if (!getConfig("guest_post")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestregister"); ?>:</td><td><input type="radio" name="register" value="1" <?php if (getConfig("guest_register")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="register" value="0" <?php if (!getConfig("guest_register")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_guestregisterwithoutinv"); ?></td><td><input type="radio" name="registerwithoutinv" value="1" <?php if (getConfig("guest_register_without_inv")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="registerwithoutinv" value="0" <?php if (!getConfig("guest_register_without_inv")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_usercomment"); ?>:</td><td><input type="radio" name="usercomment" value="1" <?php if (getConfig("user_comment")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="usercomment" value="0" <?php if (!getConfig("user_comment")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_userdownload"); ?>:</td><td><input type="radio" name="userdownload" value="1" <?php if (getConfig("user_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="userdownload" value="0" <?php if (!getConfig("user_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_uservote"); ?>:</td><td><input type="radio" name="uservote" value="1" <?php if (getConfig("user_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="uservote" value="0" <?php if (!getConfig("user_download")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_userpost"); ?>:</td><td><input type="radio" name="userpost" value="1" <?php if (getConfig("user_post")) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="userpost" value="0" <?php if (!getConfig("user_post")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_seeprofile"); ?>:</td><td><input type="radio" name="seeprofile" value="2" <?php if (getConfig("see_profile") == 2 ) echo 'checked="checked"'; ?> /><?php echo _l("cms_onlyfriends"); ?> - <input type="radio" name="seeprofile" value="1" <?php if (getConfig("see_profile") == 1) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="seeprofile" value="0" <?php if (!getConfig("see_profile")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td><?php echo _l("acp_seefriends"); ?>:</td><td><input type="radio" name="seefriends" value="2" <?php if (getConfig("see_profile") == 2 ) echo 'checked="checked"'; ?> /><?php echo _l("cms_onlyfriends"); ?> - <input type="radio" name="seefriends" value="1" <?php if (getConfig("see_friends") == 1) echo 'checked="checked"'; ?> /><?php echo _l("cms_yes"); ?> - <input type="radio" name="seefriends" value="0" <?php if (!getConfig("see_friends")) echo 'checked="checked"'; ?> /><?php echo _l("cms_no"); ?></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit"></td>
		</tr>
	</table>
</form><br>
<?php } else die("<script>location.href='../index.php';</script>"); ?>