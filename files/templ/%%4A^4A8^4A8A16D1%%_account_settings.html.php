<?php /* Smarty version 2.6.11, created on 2010-06-27 16:04:02
         compiled from mods/member/_account_settings.html */ ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/account_settings.gif" alt="Account Settings" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<form class="account-setting-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" id="fmx">
                    <input type="hidden" name="mod" value="profile" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
					<input type="hidden" name="fm[showpass]" id="showpass" value="0" />
                    <p><a href="javascript://"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
personal_information_b.gif" alt="Personal Information" /></a><a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=notify">Notifications</a></p>
					<div class="clear">&nbsp;</div><br />
					<script language="javascript" type="text/javascript">
                    <?php echo '
					function Shp()
					{
					    _v(\'cp\').style.display = (_v(\'cp\').style.display == \'block\') ? \'none\' : \'block\';
					    _v(\'showpass\').value   = (_v(\'cp\').style.display == \'block\') ? \'1\' : \'0\';
					}
					'; ?>

					</script>
                    
					<?php if ($this->_tpl_vars['errs']): ?>
                    <p style="color: red;">
                    <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                         - <?php echo $this->_tpl_vars['i']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
                    </p>
                    <?php endif; ?>
					<?php if ($this->_tpl_vars['save']): ?>
					    <p style="color: green;">Profile was changed</p>
					<?php endif; ?>
					<table class="pass-t">
						<tr>
							<td style="width: 100px;"><label>First Name</label></td><td ><input type="text" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Last Name</label></td><td><input type="text" name="fm[lname]" value="<?php echo $this->_tpl_vars['fm']['lname']; ?>
" size="40" /></td>
						</tr>
                        <tr>
							<td><label>Company</label></td><td><input type="text" name="fm[company]" value="<?php echo $this->_tpl_vars['fm']['company']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Email Address</label></td><td><input type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" id="email" size="40" /></td>
						</tr>
                        <tr>
							<td><label>Phone</label></td><td><input type="text" name="fm[phone]" value="<?php echo $this->_tpl_vars['fm']['phone']; ?>
" id="phone" size="40" /></td>
						</tr>
                        
						<tr>
							<td>&nbsp;</td><td><a class="f13" href="javascript: Shp();">New Password</a></td>
						</tr>
                    </table>
                    
                    <span style="display:none;" id="cp">
                    <table class="pass-t">     
						<tr>
							<td style="width: 100px;"><label>New Password</label></td><td><input type="password" name="fm[pass]" value="" size="30" /></td>
						</tr>
                        <tr>
							<td style="width: 100px;"><label>Confirm New Password</label></td><td><input type="password" name="fm[pass2]" value="" size="30" /></td>
						</tr>
                    </table>    
                    </span>
                    
                    <table class="pass-t">    
						<tr>
							<td style="width: 100px;"><label>Street Address</label></td><td><input type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
" size="60" /></td>
						</tr>
						<tr>
							<td><label>Apartment/Suite</label></td><td><input type="text" name="fm[suite]" value="<?php echo $this->_tpl_vars['fm']['suite']; ?>
" size="15" /></td>
						</tr>
						<tr>
							<td><label>City</label></td><td><input type="text" name="fm[city]" value="<?php echo $this->_tpl_vars['fm']['city']; ?>
" size="25" /></td>
						</tr>
						<tr>
							<td><label>State</label></td>
							<td>
								<select name="fm[state]">
                                <option value="0">Please select</option>
                                <?php $_from = $this->_tpl_vars['states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
									<option value="<?php echo $this->_tpl_vars['i']['code']; ?>
"<?php if ($this->_tpl_vars['i']['code'] == $this->_tpl_vars['fm']['state']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['name']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>    
								</select>
							</td>
						</tr>
						<tr>
							<td><label>ZIP</label></td><td><input type="text" name="fm[zip]" value="<?php echo $this->_tpl_vars['fm']['zip']; ?>
" size="15" /></td>
						</tr>
						<tr>
							<td><label>Birthday</label></td>
							<td>
								<select name="fm[dob_month]">
									<option value="0">Month</option>
									<?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
									<option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['dob_month']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?> 
								</select>
								<select name="fm[dob_day]">
									<option value="0">Day</option>
									<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
									<option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['dob_day']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
								</select>
								<select name="fm[dob_year]">
                                    <option value="0">Year</option>
									<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
									<option value="<?php echo $this->_tpl_vars['k']; ?>
"<?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['fm']['dob_year']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Keep age confidential</label></td>
							<td>
						        <input type="checkbox" name="fm[no_age]" value="1"<?php if ($this->_tpl_vars['fm']['no_age']): ?> checked="checked"<?php endif; ?> />
						    </td>
						</tr>    
						<tr>
							<td><label>Gender</label></td>
							<td>
								<select name="fm[gender]">
									<option value="0">Select gender</option>
									<option value="1"<?php if (1 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Male</option>
									<option value="2"<?php if (2 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Female</option>
								</select>
							</td>
						</tr>
					</table>
						<p class="tools"><a href="javascript: Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="Cancel" /></a><a href="javascript: _v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /></a></p>
					</form>
                    <?php if ($this->_tpl_vars['fm']['showpass']): ?>
                    <script language="javascript" type="text/javascript">
					Shp();
                    </script>
                    <?php endif; ?>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
			</td>
			<td class="right">
			    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>