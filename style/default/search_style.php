<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="inboxin" align="center">
	<form action="search.php" method="POST"> 
		<div align="center">
			<b><?php echo _l("cms_searchforname"); ?></b><br><input type="text" align="center" name="name" />
		</div>
		<div style="float: left; margin-left: 200px;">
			<b><?php echo _l("item_searchbyauthor"); ?></b><br><input type="text" align="center" name="author" /><br>
		</div>
		<div style="float: right; margin-right: 200px;"> 
			<b><?php echo _l("user_searchbyemail"); ?></b><br><input type="text" align="center" name="email" />
		</div>
		<div style="clear: both;"><input type="submit" value="<?php echo _l("cms_search"); ?>"/></div>
	</form>
</div>

<div align="center" id="inboxin">
<?php if (isset($n_users) && $n_users) { 
echo _l("user_found");
putSearchUserList($u_res);
} else echo _l("user_notfound"); ?>
</div>

<div id="content">
<?php
if (isset($n_items) && $n_items) { 
echo _l("item_found");
putSearchItemList($i_res);
} else echo _l("item_notfound"); ?>
</div>