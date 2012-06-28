<?php if (isset($user_row)) include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="inboxcon">
<form action="?" method="post" align="center" id="content" style="float:left; margin-left:6px;">
<div id="elem">
	<b><label for="name"><?php echo _l("contact_name");?>: </label></b><br><input type="text" name="nombre" size="50" maxlength="80"> <br>
	<b><label for="email"><?php echo _l("user_email");?>: </label></b><br><input type="text" name="email" size="50" maxlength="60"><br>
	<b><label for="topic"><?php echo _l("mp_topic");?>: </label></b><br><input type="text" name="asunto" size="50" maxlength="60"> <br>
	</div>
	<div id="msg"><b><label for="message"><?php echo _l("mp_message");?>: </label><br><textarea name="message" cols="31" rows="5"></textarea> </div>
	<div id="envio">
	<label for="enviar">
	<input type="submit" name="enviar" value="<?php echo _l("mp_send");?>"></label></div>
</form>
</div>