<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<div id="inboxin" align="center">
	<?php if ((isset($_GET["u"]) && canSeeFriends($_GET["u"])) || isset($cat)) {
	while ($row = mysql_fetch_array($res["query_result"])) {
	if ($row["user_send"] != $user_row["id"]) $u_row = fetchUser($row["user_send"]); 
	if ($row["user_receive"] != $user_row["id"]) $u_row = fetchUser($row["user_receive"]); 
	if ($u_row["id"] != $user_row["id"]) {
	if ($row["alive"] == 2) {
	?>
<table id="bordertable" border="0" width="100%"> 
	<tr>
		<td width="160px" rowspan="3"><img style="border-radius: 15px; -moz-border-radius: 15px;" src="<?php if ($u_row["avatar"] != "") echo $u_row['avatar']; else echo $STYLE_IMAGE."default.png";?>" width="160px" height="88px" border="0"/></a></th>
		<td><?php echo "<b>"._l("user_name").":</b> ".$u_row['username']; ?></td>
		<td width="160px" rowspan="3"><?php echo _l("user_reputation").": ".$u_row["reputation"]; ?> <a href="ucpviewprofile.php?u=<?php echo $u_row['id']; ?>&r=1"><img src="<?php echo $STYLE_IMAGE; ?>repplus.png" /></a> - <a href="ucpviewprofile.php?u=<?php echo $u_row['id']; ?>&r=0"><img src="<?php echo $STYLE_IMAGE; ?>repminus.png" /></a></td>
	</tr>
	<tr >
		<td><a href="ucpmp.php?u=<?php echo $u_row['id']; ?>"><?php echo _l("mp_send"); ?></a></td>
	</tr>
	<tr >
		<td><a href="ucpfriend.php?nf=<?php echo $u_row['id']; ?>"><?php echo _l("user_notbefriend"); ?></a></td>
	</tr>
</table>
	<?php } else { ?>
<table id="bordertable" border="0" width="100%"> 
	<tr>
		<td width="160px"><img style="border-radius: 15px; -moz-border-radius: 15px;" src="<?php if ($u_row["avatar"] != "") echo $u_row['avatar']; else echo $STYLE_IMAGE."default.png";?>" width="160px" height="88px" border="0"/></a></th>
		<td><?php echo "<b>"._l("user_name").":</b> ".$u_row['username']; ?></td>
		<td><a href="ucpfriend.php?f=<?php echo $u_row['id']; ?>"><?php if (!isset($_GET["u"])) echo _l("user_acceptfriend"); else _l("user_befriend"); ?></a></td>
	</tr>
</table>
	<?php } } }echo $res["select_page"];  } else die("<script>location.href='../msg.php?e=ucp_notfriend'</script>"); ?>
</div> 