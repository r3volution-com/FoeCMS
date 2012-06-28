<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="inboxcon">
<form action="report.php?i=<?php echo $_GET['i']; ?>" method="post" align="center" id="content" style="float:left; margin-left:6px;">

	<b><?php echo _l("user_name").":</b> ".$user_row["username"];?><br>
	<b><?php echo _l("item_name").":</b> ".$i_row["name"];?><br>
	<b><?php echo _l("mp_message");?>: <br><textarea name="text" style="width:100%;"></textarea>
	
	<input type="submit" name="enviar" value="<?php echo _l("mp_send");?>">
</form>
</div>
