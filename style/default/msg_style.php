<div id="logo"></div><div align="center" id="inbox">
	<?php echo $error_message; ?><br>
	<a href="<?php echo $url; ?>" ><?php echo _l("cms_returnif"); ?></a>
</div>
<?php if (!isset($_GET["nr"])) { ?><script>
		setTimeout("location.href='<?php echo $url; ?>'", 5000);
</script><?php } ?>