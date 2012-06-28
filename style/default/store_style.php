<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php 
	$cate = getCategoryBy($cat);
if ($cat == 0) { //PORTADA ?>
<div id="header"><ul>
<?php
putCategoryList();
?>
	</ul><br><hr></div>
	<div id="newsbar" align="center">
		<marquee scrolldelay="100" onmousemove="this.stop()" onmouseout="this.start()">
			<?php putNews(); ?>
		</marquee>
	</div>
	<div id="content" align="center">
		<?php if (checkLogin(true)) putFrontPageList($cat);
		else echo "<b>"._l("cms_onlyregaccess")."</b>"; ?>
	</div>
<?php } else { //CONTENIDO ?>
<div id="barra">
<?php putParentCategoryList($cat); ?></div>
<div id="header"><ul>
<?php putCategoryList($cat) ?>
</ul></div>
<div id="content">
<?php if (canPost()) { ?>
<a id="button" href="<?php echo $ROOT_HTML; ?>item.php"><?php echo _l("user_createitem"); ?></a>
<?php }
$result = putItemList($cat);
echo $result["select_page"]."</div>";
} ?>