<?php include("functions.style.php"); 
if (isset($user_row["id"])) $nuevosmp = checkMP(); ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo getConfig("name"); ?></title>
<meta name="title" content="<?php echo getConfig("name"); ?>">
<meta name="DC.Title" content="<?php echo getConfig("name"); ?>">
<meta http-equiv="title" content="<?php echo getConfig("name"); ?>">
<meta name="keywords" content="<?php echo getConfig("keywords"); ?>">
<meta http-equiv="keywords" content="<?php echo getConfig("keywords"); ?>">
<meta name="description" content="<?php echo getConfig("description"); ?>">
<meta http-equiv="description" content="<?php echo getConfig("description"); ?>">
<meta http-equiv="DC.Description" content="<?php echo getConfig("description"); ?>">
<meta name="author" content="FOECMS">
<meta name="DC.Creator" content="FOECMS">
<meta name="vw96.objectype" content="Document">
<meta name="resource-type" content="Document">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="distribution" content="all">
<meta name="robots" content="all">
<meta name="revisit" content="15 days">
<link rel="shortcut icon" href="<?php echo $ROOT_HTML; ?>favicon.ico"/>

<link rel="stylesheet" type="text/css" href="<?php echo $STYLE_CSS; ?>cssheader.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $STYLE_CSS; ?>menus.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $STYLE_CSS; ?>puntuacion.css" />
<link  type="text/css" rel="stylesheet" href="<?php echo $STYLE_CSS; ?>autosuggest_inquisitor.css">
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.4.2");</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $STYLE_JS; ?>tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo $STYLE_JS; ?>jsheader.js"></script>
<script type="text/javascript" src="<?php echo $STYLE_JS; ?>puntuacion.js"></script>
<script type="text/javascript" src="<?php echo $STYLE_JS; ?>bsn.AutoSuggest_2.1.3.js"></script>

<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
function autosuggest(){
	var options = {
	script: "search.php?",
	varname: "fs",
	json:false,
	maxresults:10,
    timeout:9999,
	noresults:'No se puede encontrar el item indicado' 
	};
	var as = new bsn.AutoSuggest('searchinput',  options);
}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17321654-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>
<body onload="autosuggest();">