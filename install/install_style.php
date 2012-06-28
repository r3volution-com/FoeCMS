<html>
<head>
<title>Install FoeCMS</title>
<style>
body {
	background: #bbbbff;
}
#header {
	width: 600px;
	height: 225px;
	margin: auto;
}
#install {
	position: relative;
	margin: auto;
	width: 600px;
	text-align: center;
}
#install table {
	background-image: linear-gradient(bottom, rgb(138,39,31) 15%, rgb(166,67,59) 58%);
	background-image: -o-linear-gradient(bottom, rgb(138,39,31) 15%, rgb(166,67,59) 58%);
	background-image: -moz-linear-gradient(bottom, rgb(138,39,31) 15%, rgb(166,67,59) 58%);
	background-image: -webkit-linear-gradient(bottom, rgb(138,39,31) 15%, rgb(166,67,59) 58%);
	background-image: -ms-linear-gradient(bottom, rgb(138,39,31) 15%, rgb(166,67,59) 58%);
	background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.15, rgb(138,39,31)), color-stop(0.58, rgb(166,67,59)));
	border-radius: 15px;
	margin-top: 30px;
	padding: 10px;
}
</style>
</head>
<body>
<div id="header"><img src="logo.png"/></div>
<div id="install">
<form action="index.php" method="post">
<table align="center">
<tr>
<td colspan="2" align="center"><h2>DB Config</h2></td>
</tr>
<tr>
<td>Host*:</td><td><input type="text" name="host" value="localhost" /></td>
</tr>
<tr>
<td>User*:</td><td><input type="text" name="user" value="root" /></td>
</tr>
<tr>
<td>Pass*:</td><td><input type="password" name="pass" /></td>
</tr>
<tr>
<td>Db*:</td><td><input type="text" name="db" /></td>
</tr>
<tr>
<td>Prefix*:</td><td><input type="text" name="prefix" value="foe_"/></td>
</tr>
</table>
<table align="center">
<tr>
<td colspan="2" align="center"><h2>Admin User</h2></td>
</tr>
<tr>
<td>Username*:</td><td><input type="text" name="username" value="admin" /><td>
</tr>
<tr>
<td>Password*:</td><td><input type="password" name="admpassword" /><td>
</tr>
<tr>
<td>Repeat Password*:</td><td><input type="password" name="repassword" /><td>
</tr>
<tr>
<td>Email*:</td><td><input type="text" name="email" /><td>
</tr>
</table>
<table align="center">
<tr>
<td colspan="2" align="center"><h2>Permissions</h2></td>
</tr>
<tr>
<td>Name for WebPage:</td><td><input type="text" name="webname" value="FoeCMS" /><td>
</tr>
<tr>
<td>Contact Mail:</td><td><input type="text" name="webmail" /><td>
</tr>
<tr>
<td>Cookie Prefix:</td><td><input type="text" name="cookieprefix" /> - Don't write if you don't know how it works<td>
</tr>
<tr>
<td>Guest Access:</td><td><input type="radio" name="guestaccess" value="1"/>Yes - <input type="radio" name="guestaccess" value="0"/>No<td>
</tr>
<tr>
<td>Guest can comment:</td><td><input type="radio" name="guestcomment" value="1"/>Yes - <input type="radio" name="guestcomment" value="0"/>No<td>
</tr>
<tr>
<td>Guest can download:</td><td><input type="radio" name="guestdownload" value="1"/>Yes - <input type="radio" name="guestdownload" value="0"/>No<td>
</tr>
<tr>
<td>Guest can vote:</td><td><input type="radio" name="guestvote" value="1"/>Yes - <input type="radio" name="guestvote" value="0"/>No<td>
</tr>
<tr>
<td>Guest can post:</td><td><input type="radio" name="guestpost" value="1"/>Yes - <input type="radio" name="guestpost" value="0"/>No<td>
</tr>
<tr>
<td>Guest can register:</td><td><input type="radio" name="register" value="1"/>Yes - <input type="radio" name="register" value="0"/>No<td>
</tr>
<tr>
<td>Guest can register WITHOUT invitation:</td><td><input type="radio" name="registerwithoutinv" value="1"/>Yes - <input type="radio" name="registerwithoutinv" value="0"/>No<td>
</tr>
<tr>
<td>User can comment:</td><td><input type="radio" name="usercomment" value="1"/>Yes - <input type="radio" name="usercomment" value="0"/>No<td>
</tr>
<tr>
<td>User can download:</td><td><input type="radio" name="userdownload" value="1"/>Yes - <input type="radio" name="userdownload" value="0"/>No<td>
</tr>
<tr>
<td>User can vote:</td><td><input type="radio" name="uservote" value="1"/>Yes - <input type="radio" name="uservote" value="0"/>No<td>
</tr>
<tr>
<td>User can post:</td><td><input type="radio" name="userpost" value="1"/>Yes - <input type="radio" name="userpost" value="0"/>No<td>
</tr>
<tr>
<td>SEO URL:</td><td><input type="radio" name="seourl" value="1"/>Yes - <input type="radio" name="seourl" value="0"/>No<td>
</tr>
<tr>
<td>Web Access:</td><td><input type="radio" name="webaccess" value="1"/>Yes - <input type="radio" name="webaccess" value="0"/>Only Login - <input type="radio" name="webaccess" value="-1"/>All closed<td>
</tr>
</table>
<table align="center">
<tr>
<td colspan="2" align="center"><input type="submit" value="Install it!!"/></td>
</tr>
</table>
</form>
<b>* is obligatory.</b>
</div>
</body>
</html>
