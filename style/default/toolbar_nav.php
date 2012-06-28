<ul id="nav">
	<li class="current"><a href="<?php echo $ROOT_HTML; ?>"><img src="<?php echo $STYLE_IMAGE;?>logo.png" width="100px" height="20px"/></a></li>
	<?php if(checkLogin(true)) { ?>
	<?php if(checkLogin()) { ?><li><a href="<?php echo $ROOT_HTML; ?>ucp"><?php echo _l("user_ucp"); ?><?php if ($nuevosmp > 0) echo " (".$nuevosmp.")";?></a>
		<ul>
			<li><a href="<?php echo $ROOT_HTML; ?>ucp/index.php?c=3"><?php if ($nuevosmp > 0) { echo $nuevosmp." "._l("mp_new"); } else { echo _l("mp_view"); } ?></a></li>
			<li><a href="<?php echo $ROOT_HTML; ?>memberlist.php"><?php echo _l("user_memberlist"); ?></a></li>
		</ul>
	</li><?php } ?>
	<li><a href="<?php echo $ROOT_HTML; ?>search.php"><?php echo _l("cms_search"); ?></a></li>
	<?php if (checkLogin() && checkAdmin()) { ?><li><a href="<?php echo $ROOT_HTML; ?>adm"><?php echo _l("cms_acppanel"); ?></a></li><?php } ?>
	<?php if(checkLogin()) { ?>
		<li><a href="<?php echo $ROOT_HTML; ?>index.php?t=1"><?php echo _l("user_logout")." (".$user_row["username"].")"; ?></a></li>
	<?php } else { ?>
		<li><a href="login.php"><?php echo _l("cms_returntologin"); ?></a></li>
	<?php } ?>
	<form style="margin: 0px; padding: 0px; position: absolute; right: 0px;" action="search.php" method="post" id="search">
		<li><input type="text" name="name" id="searchinput" autocomplete="off"/></li>
		<li><input type="image" src="<?php echo $STYLE_IMAGE; ?>lupa.png"/></li>
	</form>
	<?php } else { ?>
		<li class="current"><a href="login.php"><?php echo _l("cms_returntologin"); ?></a></li>
	<?php } ?>
	<?php echo putLangFlags(getFlags(), "<li>", "</li>", '<li><a href="#">+</a>','</li>'); ?>
</ul>