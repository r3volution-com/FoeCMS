<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<div id="barra">
<?php 
$array = getParentCategoryList($item_row["category_id"]); 
for ($i = 0; isset($array[$i]); $i++) echo $array[$i];
?></div>
<div id="content">
<?php if (canComment()) { ?><div align="left" style="float:left"><a href="<?php echo $ROOT_HTML; ?>comment.php?i=<?php echo $item_row["id"];?>" id="littlebutton"><?php echo _l("cms_doComment"); ?></a></div><?php }?>
<div align="right" style="float:right">
<a id="littlebutton" style="color:red" href="<?php echo $ROOT_HTML; ?>report.php?i=<?php echo $item_row["id"];?>" title="<?php echo _l("item_reportitem"); ?>">!</a>
<?php if ($uitem_row["id"] == $USER_ID) { ?> <a id="littlebutton" href="<?php echo $ROOT_HTML; ?>item.php?ei=<?php echo $item_row["id"];?>"><?php echo _l("item_edititem"); ?></a>
<a id="littlebutton" href="<?php echo $ROOT_HTML; ?>item.php?ri=<?php echo $item_row["id"];?>"><?php echo _l("item_removeitem"); ?></a>
<?php } ?></div>
	<table id="bordertable" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<th width="160px" rowspan="3"><?php echo getItemImage($item_row, 1); ?></th>
				<td><b><?php echo _l("item_name").':</b> '.getItemName($item_row, true); ?></td>
				<td width="150px" rowspan="3"><b><?php echo _l("item_timesdownloaded").":</b> ".$item_row["times_downloaded"]; ?><br/><br/><b><?php echo _l("comment_number").":</b> ".getNumComments($row["id"]); ?></td>
			</tr>
			<tr>
				<td><?php echo "<b>"._l("item_aportedby").":</b> ".$uitem_row["username"]; ?></td>
			</tr>
			<tr>
				<td><?php echo "<b>"._l("item_description").":</b> ".$item_row['description']; ?></td>
			</tr>
		</table>
		<?php if (canComment()) { ?>
	<HR size="5" width="100%" align="center">
	<h2><?php echo _l("comment_list"); ?></h2>
<?php $result = putCommentList($_GET["i"]); echo $result["select_page"]; ?>
<HR size="1" width="100%" align="center">
	<form style="text-align:center;" action="<?php echo $ROOT_HTML; ?>comment.php?i=<?php echo $_GET["i"]; ?>" method="POST"> 
		<h2><?php echo _l("comment_doComment"); ?></h2>
		<div style="position:relative; margin-left: auto; margin-right: auto; width: 100%;"><textarea name="comment" class="inputbox" cols="100" rows="10" type="text" style="position:relative; margin-left: auto; margin-right: auto; width: 100%;"></textarea></div>
		<input type="submit" value="<?php echo _l("cms_send"); ?>" />
	</form>
	<?php } ?>
</div> 
<?php if (canVote()) { ?>
<div id="wrapper">
	<div id="<?php echo $row['id']; ?>" class="puntuacion">		
		<div class="estrella estrella_izq"><a title="0.5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=0.5" style="width: 100%">0.5</a></div>
		<div class="estrella estrella_der"><a title="1/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=1" style="width: 100%">1</a></div>
		<div class="estrella estrella_izq"><a title="1.5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=1.5" style="width: 100%">1.5</a></div>
		<div class="estrella estrella_der"><a title="2/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=2" style="width: 100%">2</a></div>
		<div class="estrella estrella_izq"><a title="2.5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=2.5" style="width: 100%">2.5</a></div>
		<div class="estrella estrella_der"><a title="3/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=3" style="width: 100%">3</a></div>
		<div class="estrella estrella_izq"><a title="3.5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=3.5" style="width: 100%">3.5</a></div>
		<div class="estrella estrella_der"><a title="4/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=4" style="width: 100%">4</a></div>
		<div class="estrella estrella_izq"><a title="4.5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=4.5" style="width: 100%">4.5</a></div>
		<div class="estrella estrella_der"><a title="5/5" href="<?php echo $ROOT_HTML; ?>viewitem.php?i=<?php echo $_GET["i"]; ?>&p=5" style="width: 100%">5</a></div>
	</div> 
	<div id="num_votos">
		Votos: <?php echo $item_row["votes"]; ?>
	</div> 
</div><?php } ?>
	<script type="text/javascript" language="Javascript" src="<?php echo $STYLE_JS; ?>puntuacion.js"></script>
	<script type="text/javascript" language="Javascript">
		$('#<?php echo $row['id']; ?>').sistemaPuntuacion(<?php echo $item_row["points"]; ?>);
	</script>