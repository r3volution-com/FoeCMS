<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<div id="inboxin" align="center">
<h1><?php echo _l("user_invitationlist"); ?></h1>
<ul style="list-style: none;">
<?php putInvitationList($res_inv); ?>
</ul>
<?php echo $res_inv["select_page"]; ?>
<form action="index.php?c=5" method="POST">
<?php echo _l("user_email").": "; ?><br /><input name="email" type="text" /><br /><br />
<input type="submit" id="button" value="OK" /><br />
</form>
</div>