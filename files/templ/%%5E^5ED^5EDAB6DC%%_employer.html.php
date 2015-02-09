<?php /* Smarty version 2.6.11, created on 2010-05-02 20:55:20
         compiled from mods/reg/_employer.html */ ?>
<div class="content">
	<div class="crew-members-reg" style="margin-left:220px">
		<p style="margin-left:100px"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/employers_registration.gif" alt="#" /></p>
			<form class="members_reg-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php" id="fmx">
            <input type="hidden" name="mod" value="reg" />
            <input type="hidden" name="rt" value="2" />
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
							<td><label>Company Name</label></td><td ><input type="text" name="fm[company]" value="<?php echo $this->_tpl_vars['fm']['company']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Company Type</label></td><td ><input type="radio" value="1" name="fm[prof1]"<?php if (! $this->_tpl_vars['fm']['prof1'] || '1' == $this->_tpl_vars['fm']['prof1']): ?> checked="checked"<?php endif; ?> /> production company <input type="radio" value="2" name="fm[prof1]"<?php if ('2' == $this->_tpl_vars['fm']['prof1']): ?> checked="checked"<?php endif; ?> /> rental house</td>
						</tr>
                        
                        <tr>
							<td><label>Street Address</label></td><td><input type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
" size="60" /></td>
						</tr>
						<tr> 
							<td><label>Suite/Stage</label></td><td><input type="text" name="fm[suite]" value="<?php echo $this->_tpl_vars['fm']['suite']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>City</label></td><td><input type="text" name="fm[city]" value="<?php echo $this->_tpl_vars['fm']['city']; ?>
" size="25" /></td>
						</tr>
						<tr>
							<td><label>State</label></td>
							<td>                                <select name="fm[state]">
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
							<td><label>Phone Number</label></td><td><input type="text" name="fm[phone]" value="<?php echo $this->_tpl_vars['fm']['phone']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Fax Number</label></td><td><input type="text" name="fm[fax]" value="<?php echo $this->_tpl_vars['fm']['fax']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Contact&nbsp;Person&nbsp;within&nbsp;Company</label></td><td><input type="text" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" size="40" /></td>
						</tr>
						<tr>
							<td><label>Contact Person's Title</label></td><td><input type="text" name="fm[cperson_title]" value="<?php echo $this->_tpl_vars['fm']['cperson_title']; ?>
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
							<td>&nbsp;</td>
							<td><input type="checkbox" name="fm[confirm]" value="1"<?php if ($this->_tpl_vars['fm']['confirm']): ?> checked="checked"<?php endif; ?> />&nbsp;&nbsp;By checking this box you agree to the Crewed Up <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=terms">Terms of Services</a> and <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=privacy">Privacy&nbsp;Policy</a>. </td>
						</tr>
						<tr>
							<td colspan="2"><p style="padding:15px 150px"><a href="javascript: _v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
go2_big_b.gif" alt="Go" /></a></p></td>
						</tr>
											
					</table>
					</form>
					<p style="width:500px;text-align:center">Crewed Up staff will call to verify your production company status, normally, within 24 hours. <br />
					Your account will be activated once it's verified. </p>
	</div>
</div>