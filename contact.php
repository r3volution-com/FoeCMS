<?php 
include("common.php");
if (isset ($_POST['enviar'])) {
	$headers .= "From: ".$_POST['email'];
	if ( mail (getConfig("contact_email"), $_POST['topic'], _l("contact_name").": ".$_POST['name']."\n "._l("mp_message").": ".stripcslashes ($_POST['message']), $headers )) 
		echo _l("contact_succesful");
	else echo _l("contact_fail"); 
}
include ($STYLE_HTML."header.php");
include ($STYLE_HTML."contact_style.php");
include ($STYLE_HTML."footer.php");
?>
