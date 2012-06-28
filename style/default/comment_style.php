<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="content">
<?php if (canComment()) { ?>
	<h2><?php echo _l("cms_comments"); ?></h2>
	<form style="text-align:center;" action="comment.php<?php if (isset($_GET["i"]) && $_GET["i"]) echo "?i=".$_GET["i"]; else if (isset($_GET["ec"]) && $_GET["ec"]) echo "?ec=".$_GET["ec"]; ?>" method="POST"> 
		<h2><?php echo _l("cms_doComment"); ?></h2>
		<div style="position:relative; margin-left: auto; margin-right: auto; width: 100%;"><textarea name="comment" class="inputbox" cols="100" rows="10" type="text" style="position:relative; margin-left: auto; margin-right: auto; width: 100%;"><?php if (isset($crow["comment"])) echo $crow["comment"]; ?></textarea></div>
		<input type="submit" value="<?php echo _l("cms_send");?>" />
	</form>
<?php }
if (isset($_GET["i"]) && $_GET["i"]) $result = putCommentList($_GET["i"]); echo $result["select_page"]; ?>
</div> 