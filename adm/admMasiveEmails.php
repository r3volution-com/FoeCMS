<?php 
if (isset($inadm) && $inadm == 2) {
	if (isset ($_POST["topic"])) {
		$headers .= "From: ".getConfig("contact_mail");
		$res = mysql_query("SELECT * FROM ".$MYSQL_PREFIX."account");
		$i = 1;
		while ($raw = mysql_fetch_array($res)) {
			$emailtext=parseMetacodes($_POST["emailtext"], $raw["username"], $raw["email"]);
			mail ($raw["email"], $_POST["topic"], $emailtext, $headers);
			$i++;
			echo $i."<br>";
		}
		echo $i." sended done";
	} else {
?>
<form action="index.php?r=13" method="POST">
	<table align="center">
		<tr>
			<td colspan="2" align="center"><h2><?php echo _l("acp_masiveemails"); ?></h2></td>
		</tr>
		<tr>
			<td><?php echo _l("mp_topic"); ?>:</td><td><input type="text" name="topic" /><td>
		</tr>
		<tr>
			<td><?php echo _l("mp_message"); ?>*:</td><td><textarea name="emailtext"></textarea><td>
		</tr>
		<tr>
			<td colspan="2">*: <?php echo _l("acp_codereplacesemail"); ?></a></td>
		</tr>
	</table>
	<input type="submit">
</form>
<?php } } else die("<script>location.href='../index.php';</script>"); ?>