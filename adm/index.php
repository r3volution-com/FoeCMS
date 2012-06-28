<?php 
include("../common.php");
include($STYLE_HTML."functions.style.php");
	if (checkLogin() && $user_row["level"] > 0) { 
		$inadm = $user_row["level"];
	?>
<html>
<head>
	<title><?php echo getConfig("name"); ?> ADM Panel</title>
	<link rel="shortcut icon" href="<?php echo $ROOT_HTML; ?>favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="cssacp.css" />
<script type="text/javascript" src="<?php echo $STYLE_JS; ?>tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
</head>
<body>
	<div align="center">
		<ul id="nav">
			<li><a href="../index.php"><?php echo _l("acp_returntoindex"); ?></a></li>
			<li><a href="index.php"><?php echo _l("acp_index"); ?></a></li>
			<li><a href="#"><?php echo _l("acp_item"); ?></a>
				<ul>
					<li><a href="index.php?r=2"><?php echo _l("acp_additem"); ?></a></li>
					<li><a href="index.php?r=3"><?php echo _l("acp_edititem"); ?></a></li>
					<li><a href="index.php?r=10"><?php echo _l("acp_editcomment"); ?></a></li>
					<li><a href="index.php?r=14"><?php echo _l("acp_reportitem"); ?></a></li>
					<li><a href="index.php?r=8"><?php echo _l("acp_addcategory"); ?></a></li>
					<li><a href="index.php?r=9"><?php echo _l("acp_editcategory"); ?></a></li>
				</ul>
			</li>
			<?php if ($inadm == 2) { ?>
			<li><a href="#"><?php echo _l("acp_user"); ?></a>
				<ul>
					<li><a href="index.php?r=4"><?php echo _l("acp_adduser"); ?></a></li>
					<li><a href="index.php?r=5"><?php echo _l("acp_edituser"); ?></a></li>
					<li><a href="index.php?r=11"><?php echo _l("acp_editinvitation"); ?></a></li>
				</ul>
			</li><?php } ?>
			<li><a href="#"><?php echo _l("acp_notice"); ?></a>
				<ul>
					<li><a href="index.php?r=6"><?php echo _l("acp_addnotice"); ?></a></li>
					<li><a href="index.php?r=7"><?php echo _l("acp_editnotice"); ?></a></li>
				</ul>
			</li>
			<li><a href="#"><?php echo _l("acp_editconfig"); ?></a>
				<ul>
					<li><a href="index.php?r=12"><?php echo _l("acp_editconfig"); ?></a></li>
					<li><a href="index.php?r=15"><?php echo _l("acp_addtheme"); ?></a></li>
					<li><a href="index.php?r=16"><?php echo _l("acp_addlang"); ?></a></li>
					<li><a href="index.php?r=13"><?php echo _l("acp_masiveemails"); ?></a></li>
				</ul></li>
			<?php putLangFlags(getFlags(), "<li>", "</li>", '<li><a href="#">+</a>','</li>'); ?>
		</ul>
	</div>
	<div id="content" align="center">
<?php if (!isset($_GET["r"])){
		echo '<h2 align="center">'._l("acp_notepanel").'</h2><br />';
		if (getConfig("note_panel")) echo getConfig("note_panel");
		else echo _l("acp_emptynotepanel");
	} else {
		if ($_GET["r"] == 1) include("index.php");
		else if ($_GET["r"] == 2) include("admAddItem.php");
		else if ($_GET["r"] == 3) include("admEditItem.php");
		else if ($_GET["r"] == 4 && $inadm == 2) include("admAddUser.php");
		else if ($_GET["r"] == 5 && $inadm == 2) include("admEditUser.php");
		else if ($_GET["r"] == 6) include("admAddNotice.php");
		else if ($_GET["r"] == 7) include("admEditNotice.php");
		else if ($_GET["r"] == 8) include("admAddCategory.php");
		else if ($_GET["r"] == 9) include("admEditCategory.php");
		else if ($_GET["r"] == 10) include("admEditComment.php");
		else if ($_GET["r"] == 11) include("admEditInvitation.php");
		else if ($_GET["r"] == 12) include("admEditConfig.php");
		else if ($_GET["r"] == 13) include("admMasiveEmails.php");
		else if ($_GET["r"] == 14) include("admReportItem.php");
		else if ($_GET["r"] == 15) include("admAddTheme.php");
		else if ($_GET["r"] == 16) include("admAddLang.php");
		else echo _l("acp_badoption");
	}
} else {
	die("<script>location.href='../index.php';</script>");
} ?>
</div>
</body>
</html>
