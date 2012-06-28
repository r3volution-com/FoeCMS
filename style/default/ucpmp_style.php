<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<div id="inboxin" align="center">
<form action="index.php?c=2" method="POST"> 
<h2><?php echo _l("mp_sendto"); ?></h2>
<input id="receiver" name="receiver" type="text" value="<?php if (isset($ump_row["id"]) && $ump_row["id"] != $USER_ID) echo $ump_row["username"]; ?>" /><br /><a href="javascript:OpenPopup()"><?php echo _l("user_selectuser"); ?></a>
<h2><?php echo _l("mp_topic"); ?></h2>
<input name="topic" size="100" maxlength="60" width="100px" type="text" /><br />
<h2><?php echo _l("mp_message"); ?></h2>
<textarea id="message" name="message" class="inputbox" type="text" style="position: relative; width: 100%;"></textarea><br />
<input type="submit" value="Enviar" />
</form>
</div> 