<?php include($STYLE_HTML."toolbar_nav.php"); ?>
<?php include($STYLE_HTML."toolbar_ucp.php"); ?>
<article class="tabs">
	<section id="tab1">
		<h2><a href="index.php?c=1"><?php echo _l("user_basicconfig"); ?></a></h2>
		<form action="index.php?c=1" method="POST" enctype="multipart/form-data">
			<table border="0" align="center" style="text-align: center;">
			<tr>
				<td colspan="2"><?php echo _l("user_email").": "; ?><br><input name="email" type="text" value="<?php echo $user_row["email"]; ?>" /><br/><br/></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo _l("user_oldpass").": "; ?><br /><input name="oldpw" type="password" /></td>
			</tr>
				<td><?php echo _l("user_newpass").": "; ?><br /><input name="newpw" type="password" /></td>
				<td><?php echo _l("user_renewpass").": "; ?><br /><input name="renewpw" type="password" /><br/><br/></td>
			</tr>
			<tr>
				<td><?php echo _l("user_secretask").": "; ?><br /><input name="secretask" type="text" value="<?php echo $user_row["secret_ask"]; ?>" /></td>
				<td><?php echo _l("user_secretanswer").": "; ?><br /><input name="secretanswer" type="password" /><br/><br/></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" id="button" value="OK" /></td>
			</tr>
			</table>
		</form>
	</section>
	<section id="tab2">
		<h2><a href="index.php?c=1#tab2"><?php echo _l("user_otherconfig"); ?></a></h2>
		<div id="tab2"><form action="index.php?c=1" method="POST" enctype="multipart/form-data">
			<table border="0" align="center" style="text-align: center;">
			<tr>
				<td><?php echo _l("user_avatar").": "; ?></td>
			</tr>
			<tr>
					<td><input type="file" name="avatarf" accept="image/*" /></td><br/>
			</tr>
			<tr>
				<td>URL: <input name="avataru" id="avatar" type="text" value="<?php echo $user_row["avatar"]; ?>" onblur="document.getElementById('image').src=document.getElementById('avatar').value;  document.getElementById('image').style.display='block';" onchange="document.getElementById('image').src=document.getElementById('avatar').value;  document.getElementById('image').style.display='block';" />
			</tr>
			<tr><td colspan="2">
				<div id="image" style="display: <?php if ($user_row["avatar"]) echo "block"; else echo "none"; ?>;">
					<img src="<?php echo $user_row["avatar"]; ?>" width="160" height="88" />
				</div>
			</td></tr>
			<tr>
				<td colspan="2"><?php echo _l("user_style").": "; ?><select name="style"><?php putStyleList(); ?></select></td>
			</tr>
			<tr>
				<td><?php echo _l("user_firm").": "; ?></td>
			</tr>
			<tr>
					<td><textarea name="firm" style="width: 100%;"><?php echo $user_row["firm"];?></textarea></td>
			</tr>
			<tr>
				<td><?php echo _l("user_sex").": "; ?></td>
			</tr>
			<tr>
					<td><input name="sex" type="radio" value="0" <?php if($user_row["sex"] == 0) echo 'checked="checked"';  ?>/><?php echo _l("user_nosex")." - "; ?><input name="sex" type="radio" value="1" <?php if($user_row["sex"] == 1) echo 'checked="checked"';  ?>/><?php echo _l("user_man")." - "; ?><input name="sex" type="radio" value="2" <?php if($user_row["sex"] == 2) echo 'checked="checked"';  ?>/><?php echo _l("user_woman"); ?></td>
			</tr>
			<tr>
				<td><?php echo _l("user_website").": "; ?></td>
			</tr>
			<tr>
					<td><input name="website" type="text" value="<?php echo $user_row["website"];?>"/></td>
			</tr>
			<tr>
				<td><?php echo _l("user_birthdate").": "; ?></td>
			</tr>
			<tr>
					<td><input name="birthdate" type="date" value="<?php echo $user_row["birth_date"];?>"/></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" id="button" value="OK" /></td>
			</tr>
			</table>
		</form>
	</section>
</article>