<div id="logo"></div><div align="center" id="inbox">
<?php if (isset($user_from)) printf(_l("user_invtext"), $row["to_email"], $user_from["username"]); ?>
<form action="register.php<?php if (isset($_GET["inv"])) echo "?inv=".$_GET["inv"]; ?>" method="POST"> 
<b><?php echo _l("user_name").": "; ?></b><br /><input name="accountname" type="text" onmouseover="document.getElementById('tooltipname').style.display='block'" onmouseout="document.getElementById('tooltipname').style.display='none'"/>
<div class="tooltip" id="tooltipname">  
<?php echo _l("user_tips"); ?> 
<div class="pointer">  
<div class="inner-pointer"></div>  
</div>  
</div> <br />
<b><?php echo _l("user_pass").": "; ?></b><br /><input name="pw" type="password"  onmouseover="document.getElementById('tooltippass').style.display='block'" onmouseout="document.getElementById('tooltippass').style.display='none'"/><br />
<div class="tooltip" id="tooltippass">  
<?php echo _l("user_passtips"); ?> 
<div class="pointer">  
<div class="inner-pointer"></div>  
</div>  
</div> 
<b><?php echo _l("user_repass").": "; ?></b><br /><input name="repw" type="password" /><br />
<b><?php echo _l("user_email").": "; ?></b><br /><input name="email" type="text"  onmouseover="document.getElementById('tooltipemail').style.display='block'" onmouseout="document.getElementById('tooltipemail').style.display='none'"/><br />
<div class="tooltip" id="tooltipemail">  
<?php echo _l("user_emailtips"); ?> 
<div class="pointer">  
<div class="inner-pointer"></div>  
</div>  
</div> 
<b><?php echo _l("user_reemail").": "; ?></b><br /><input name="reemail" type="text" /><br />
<b><?php echo _l("user_secretask").": "; ?></b><br /><input name="secretask" type="text" onmouseover="document.getElementById('tooltipsecretask').style.display='block'" onmouseout="document.getElementById('tooltipsecretask').style.display='none'"/><br />
<div class="tooltip" id="tooltipsecretask">  
<?php echo _l("user_secretasktips"); ?> 
<div class="pointer">  
<div class="inner-pointer"></div>  
</div>  
</div> 
<b><?php echo _l("user_secretanswer").": "; ?></b><br /><input name="secretanswer" type="text"  onmouseover="document.getElementById('tooltipsecretanswer').style.display='block'" onmouseout="document.getElementById('tooltipsecretanswer').style.display='none'"/><br />
<div class="tooltip" id="tooltipsecretanswer">  
<?php echo _l("user_secretanswertips"); ?> 
<div class="pointer">  
<div class="inner-pointer"></div>  
</div>  
</div> 
<input type="submit" value="<?php echo _l("cms_send"); ?>"/>
</form>
</div>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEEEEE');
tooltipObj.setTooltipCornerSize(15);
tooltipObj.initFormFieldTooltip();
</script>