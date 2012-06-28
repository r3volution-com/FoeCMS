<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="inboxin"><b><?php echo _l("acp_additem"); ?></b> <br />
<form action="item.php<?php if (isset($_GET["ei"]) && $_GET["ei"] ) echo "?ei=".$_GET["ei"]; ?>" method="POST" enctype="multipart/form-data"> 
<table align="center" style="margin-left:auto;margin-right:auto;">
	<tr>
		<td><?php echo _l("item_name"); ?>:</td><td><input name="name" type="text" value="<?php if (isset($item_row["name"])) echo $item_row["name"]; ?>"/></td>
	</tr>
	<tr>
		<td><?php echo _l("item_description"); ?>:</td><td><textarea name="desc" type="text" style="position: relative; width: 100%;"><?php if (isset($item_row["description"])) echo $item_row["description"]; ?></textarea></td>
	</tr>
	<tr>
		<td><?php echo _l("item_category"); ?>:</td><td><select name="cat">
		<?php
			putCategorySelectList();
		?></select></td>
	</tr>
	<tr>
		<td><?php echo _l("item_image"); ?>:</td><td><input name="image" type="file" accept="image/*" /></td>
	</tr>
	<tr>
		<td><?php echo _l("item_file"); ?>:</td><td><input name="file" type="file" /></td>
	</tr>
</table>
<input type="submit" value="<?php echo _l("cms_send"); ?>">
</form>
</div>