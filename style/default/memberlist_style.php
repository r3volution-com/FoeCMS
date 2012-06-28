<?php if (isset($_GET["t"])) include($STYLE_HTML."toolbar.php"); ?>
<div id="inboxusers" style="margin:20px; margin-top:5px; -webkit-column-count: 3; -webkit-column-rule: 1px solid #000; -webkit-column-gap: 2em; text-shadow: 3 1px 1px rgba(0, 0, 0, 0.828282);color:#00ADEE">
<?php putMemberList($pagi_res); ?>
</div>
<div id="pages" align="center" style="text-decoration:none" ><?php echo "<br />".$pagi_res["select_page"];  ?></div>