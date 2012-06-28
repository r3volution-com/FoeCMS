<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<br><br><div id="inboxin">
<a id="button" href="ucpmp.php?u=<?php echo $raw["id"]; ?>"><?php echo _l("mp_reply"); ?></a>
<table border="0" width="90%" id="bordertable">
    <tr>
		<td style="position: relative; width:20%;"><?php if ($_GET["type"] == 1) { echo _l("mp_emitter"); } else { echo _l("mp_receiver"); } ?></td>
        <td><?php echo $raw["username"]; ?></td>
    </tr>
	<tr>
		<td style="position: relative; width:20%;"><?php echo _l("mp_topic"); ?></td>
        <td><?php echo $row['topic']; ?></td>
    </tr>
	<tr>
		<td style="visibility:hidden;"> </td>
        <td style="position: relative; width:100%;"><?php echo $row['message']; ?></td>
    </tr>
</table></div>