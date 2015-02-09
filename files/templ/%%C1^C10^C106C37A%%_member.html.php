<?php /* Smarty version 2.6.11, created on 2010-05-24 13:48:06
         compiled from mods/reg/_member.html */ ?>
<div class="content">
	<div class="crew-members-reg">
		    <p style="margin-left: 40px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/crew_members_registration.gif" alt="Crew Member Registration" /></p>
			<form class="crew_members_reg-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php" id="fmx">
            <input type="hidden" name="mod" value="reg" />
            <input type="hidden" name="rt" value="1" />
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
                    <table class="pass-t">
						<tr>
							<td><label>First Name</label></td><td ><input type="text" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Last Name</label></td><td><input type="text" name="fm[lname]" value="<?php echo $this->_tpl_vars['fm']['lname']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Email Address</label></td><td><input type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Password</label></td><td><input type="password" name="fm[pass]" value="<?php if (! $this->_tpl_vars['pass_err']):  echo $this->_tpl_vars['fm']['pass'];  endif; ?>" size="30" /></td>
						</tr>
						<tr>
							<td><label>Confirm Password</label></td><td><input type="password" name="fm[pass2]" value="<?php if (! $this->_tpl_vars['pass_err']):  echo $this->_tpl_vars['fm']['pass2'];  endif; ?>" size="30" /></td>
						</tr>
						<tr>
							<td><label>Street Address</label></td><td><input type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
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
							<td><label>Gender</label></td>
							<td>
								<select name="fm[gender]">
									<option value="0">Select gender</option>
									<option value="1"<?php if (1 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Male</option>
									<option value="2"<?php if (2 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Female</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="checkbox" name="fm[confirm]" value="1"<?php if ($this->_tpl_vars['fm']['confirm']): ?> checked="checked"<?php endif; ?> />&nbsp;&nbsp;By checking this box you agree to the Crewed Up <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=terms" target="_blank">Terms of Services</a> and <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=privacy" target="_blank">Privacy Policy</a>. </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><p style="padding:15px 50px"><a href="javascript: _v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
go_big_b.gif" alt="Go" /></a></p></td>
						</tr>
											
					</table>
					</form>

	</div>
</div>