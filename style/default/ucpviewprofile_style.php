<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<div id="inboxin" align="center">
<table id="bordertable" border="0" cellpadding="0" cellspacing="0" width="100%"> 
	<tr>
		<td width="160px" rowspan="3"><img style="border-radius: 15px; -moz-border-radius: 15px;" src="<?php if ($user_row["avatar"]) echo $user_row['avatar']; else echo $STYLE_IMAGE."default.png";?>" width="160px" height="88px" border="0"/></a></th>
		<td><?php echo "<b>"._l("user_name").":</b> ".$user_row['username']; ?> - <?php echo "<b>".$user_row['visitor_number']."</b> "._l("user_visitornumber"); ?></td>
		<td width="160px" rowspan="3"><?php echo _l("user_reputation").": ".$user_row["reputation"]; ?> <a href="ucpviewprofile.php?u=<?php echo $user_row['id']; ?>&r=1"><img src="<?php echo $STYLE_IMAGE; ?>repplus.png" /></a> - <a href="ucpviewprofile.php?u=<?php echo $user_row['id']; ?>&r=0"><img src="<?php echo $STYLE_IMAGE; ?>repminus.png" /></a></td>
	</tr>
	<?php if($user_row["id"] != $_SESSION[getConfig("cookie_prefix")."_userid"] && canSeeProfile($user_row["id"])) { ?>
	<tr>
		<td><a id="littlebutton" href="ucpmp.php?u=<?php echo $user_row['id']; ?>"><?php echo _l("mp_send"); ?></a></td>
	</tr>
	<?php } ?>
	<tr>
		<td><?php if($user_row["id"] != $_SESSION[getConfig("cookie_prefix")."_userid"]) { ?><a id="littlebutton" href="ucpfriend.php?f=<?php echo $user_row['id']; ?>"><?php echo _l("user_befriend"); ?></a><?php } ?><?php if(canSeeFriends($user_row["id"])) { ?><a  id="littlebutton" href="ucpfriend.php?u=<?php echo $user_row["id"]; ?>"><?php echo _l("user_seefriends"); ?></a><?php } ?></td>
	</tr>
	<?php if($user_row["id"] == $_SESSION[getConfig("cookie_prefix")."_userid"] || canSeeProfile($user_row["id"])) { ?>
	<?php if ($user_row["firm"]) {?><tr>
		<td colspan="3"><?php echo _l("user_firm").":<br/>".$user_row["firm"]; ?></td>
	</tr><?php }?>
	<?php if ($user_row["birth_date"] != "0000-00-00" || $user_row["sex"] || $user_row["website"]) {?><tr>
		<td><?php echo _l("user_birthdate").":<br/>".$user_row["birth_date"]; ?></td>
		<td><?php echo _l("user_sex").":<br/>"; if ($user_row["sex"] == 0) echo _l('user_nosex'); else if ($user_row["sex"] == 1) echo _l("user_man"); else echo _l('user_woman'); ?></td>
		<td><?php echo _l("user_website").":<br/>".$user_row["website"]; ?></td>
	</tr><?php } } ?>
</table>
<?php if($user_row["id"] == $_SESSION[getConfig("cookie_prefix")."_userid"] || canSeeProfile($user_row["id"])) { ?>
	<?php if ($res_item["n_items"]) { ?>
		<a href="#" onclick="if (document.getElementById('profile_items').style.display == 'none') document.getElementById('profile_items').style.display = 'block'; else document.getElementById('profile_items').style.display = 'none';"><h1 align="center"><?php echo _l("user_seeaporteditems"); ?></h1></a>
		<div id="profile_items" <?php if ($res_item["act_page"] <= 1) echo 'style="display: none;"'; ?>>
		<?php putUserItemList($res_item);
		echo $res_item["select_page"]; ?>
		</div>
	<?php } ?>
	
	<?php if ($res_comment["n_items"]) { ?>
		<a href="#" onclick="if (document.getElementById('profile_comments').style.display == 'none') document.getElementById('profile_comments').style.display = 'block'; else document.getElementById('profile_comments').style.display = 'none';"><h1 align="center"><?php echo _l("user_seepostedcomments"); ?></h1></a>
		<div id="profile_comments" <?php if ($res_comment["act_page"] <= 1) echo 'style="display: none;"'; ?>>
		<?php putUserCommentList($res_comment);
		echo $res_comment["select_page"];?>
		</div>
	<?php }
} ?>
</div>