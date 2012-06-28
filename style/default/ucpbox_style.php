<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<div id="inboxin" align="center">
<h2><?php echo _l("mp_inbox"); ?></h2>
<table border="0" width="90%" id="bordertable">
<tr>
		<th style="position: relative; width:70%;"><?php echo _l("mp_topic"); ?></th>
        <th style="position: relative; width:25%;"><?php echo _l("mp_emitter"); ?></th>
		<th style="position: relative; width:5%;"><?php echo _l("mp_status"); ?></th>
		<th style="position: relative; width:5%;"><?php echo _l("mp_date"); ?></th>
    </tr>
<?php putInboxList($resIn); ?>
</table>
<?php echo $resIn["select_page"]; ?>
<h2><?php echo _l("mp_outbox"); ?></h2>
<table border="0" width="90%" id="bordertable">
<tr>
		<th style="position: relative; width:70%;"><?php echo _l("mp_topic"); ?></th>
        <th style="position: relative; width:30%;"><?php echo _l("mp_receiver"); ?></th>
		<th style="position: relative; width:5%;"><?php echo _l("mp_date"); ?></th>
    </tr>
<?php putOutboxList($resOut); ?>
</table>
<?php echo $resOut["select_page"]; ?>
<br />
</div> 