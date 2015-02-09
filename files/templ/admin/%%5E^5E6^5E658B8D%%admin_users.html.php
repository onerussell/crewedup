<?php /* Smarty version 2.6.11, created on 2010-12-26 05:33:19
         compiled from mods/Security/Fe/admin_users.html */ ?>
<br />
<?php if ($this->_tpl_vars['action'] == 'view' && $this->_tpl_vars['what'] == 'list' || $this->_tpl_vars['action'] == 'sstr'): ?>

<table width="100%"><tr><td><h2><img border="0" src="includes/templates/images/menu/list_users.gif" alt="<?php echo $this->_config[0]['vars']['au1']; ?>
" />&nbsp;<?php echo $this->_config[0]['vars']['au1']; ?>
</h2></td>
                 <td valign="center" width="500" align="right">
                 <form target ="_self" action="users.php?action=sstr" method="post" align="right">
                    <input type="text" name="sstr">
                    <input type="submit" value="Search user">
                 </form>
                 </td>
                 </tr></table>


<center>
<table cellSpacing="1" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20">
   <td>&nbsp;<b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=name&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'name' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">Name</a><?php if ($this->_tpl_vars['ordercol'] == 'name'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td>&nbsp;<b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=company&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'company' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">Company</a><?php if ($this->_tpl_vars['ordercol'] == 'company'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td>&nbsp;<b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=status&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'status' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">Type</a><?php if ($this->_tpl_vars['ordercol'] == 'status'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td><b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=email&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'email' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">E-mail</a><?php if ($this->_tpl_vars['ordercol'] == 'email'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td width="90"><b>&nbsp;<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=featured&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'featured' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>">Featured</a><?php if ($this->_tpl_vars['ordercol'] == 'featured'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td><b>User active</b></td>
   <td colspan="3"><b>&nbsp;<?php echo $this->_config[0]['vars']['au6']; ?>
&nbsp;</b></td>
</tr>
<?php unset($this->_sections['iif']);
$this->_sections['iif']['name'] = 'iif';
$this->_sections['iif']['loop'] = is_array($_loop=$this->_tpl_vars['UA']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iif']['show'] = true;
$this->_sections['iif']['max'] = $this->_sections['iif']['loop'];
$this->_sections['iif']['step'] = 1;
$this->_sections['iif']['start'] = $this->_sections['iif']['step'] > 0 ? 0 : $this->_sections['iif']['loop']-1;
if ($this->_sections['iif']['show']) {
    $this->_sections['iif']['total'] = $this->_sections['iif']['loop'];
    if ($this->_sections['iif']['total'] == 0)
        $this->_sections['iif']['show'] = false;
} else
    $this->_sections['iif']['total'] = 0;
if ($this->_sections['iif']['show']):

            for ($this->_sections['iif']['index'] = $this->_sections['iif']['start'], $this->_sections['iif']['iteration'] = 1;
                 $this->_sections['iif']['iteration'] <= $this->_sections['iif']['total'];
                 $this->_sections['iif']['index'] += $this->_sections['iif']['step'], $this->_sections['iif']['iteration']++):
$this->_sections['iif']['rownum'] = $this->_sections['iif']['iteration'];
$this->_sections['iif']['index_prev'] = $this->_sections['iif']['index'] - $this->_sections['iif']['step'];
$this->_sections['iif']['index_next'] = $this->_sections['iif']['index'] + $this->_sections['iif']['step'];
$this->_sections['iif']['first']      = ($this->_sections['iif']['iteration'] == 1);
$this->_sections['iif']['last']       = ($this->_sections['iif']['iteration'] == $this->_sections['iif']['total']);
?>
<tr bgcolor="#ECEEF1" align="center" vAlign="middle">
    <td>&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['lname']; ?>
</a>&nbsp;</td>
    <td>&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
" target="_blank"><?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['company']; ?>
</a>&nbsp;</td>
    
    <td>&nbsp;<?php if (1 == $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['status']): ?><font color="#FF0000">Member</font><?php else: ?>Employer<?php endif; ?></td>
    <td>&nbsp;<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['email']; ?>
</td>
	<td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&action=chgfeatured&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
&val=<?php if ($this->_tpl_vars['UA'][$this->_sections['iif']['index']]['featured']): ?>0<?php else: ?>1<?php endif; ?>"><b><?php if ($this->_tpl_vars['UA'][$this->_sections['iif']['index']]['featured']): ?><font color="#009900">Yes</font><?php else: ?><font color="#CC0000">No</font><?php endif; ?></b></a></td>
    <td>
        <?php if ($this->_tpl_vars['UA'][$this->_sections['iif']['index']]['active'] == 0): ?>
        <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
"><img src="includes/templates/images/status_green_l.gif " border="0" alt="<?php echo $this->_config[0]['vars']['mactive']; ?>
"></a>
        &nbsp;<img src="includes/templates/images/status_red.gif" alt="<?php echo $this->_config[0]['vars']['nactive']; ?>
">
        <?php else: ?>
        <img src="includes/templates/images/status_green.gif " border="0" alt="<?php echo $this->_config[0]['vars']['active']; ?>
">&nbsp;
        <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
"><img src="includes/templates/images/status_red_l.gif" border="0" alt="<?php echo $this->_config[0]['vars']['mnactive']; ?>
"></a>
        <?php endif; ?>
    </td>
    <td><?php if ($this->_tpl_vars['UA'][$this->_sections['iif']['index']]['active']): ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=signin&amp;uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
" target="_blank">SignIn</a><?php else: ?>&nbsp;<?php endif; ?></td>
    <td width="30"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&what=user&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
"><img src="includes/templates/images/b_edit.png" alt="Edit" border="0" /></a></td>
    <td width="30"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=delete&what=user&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
" onClick="return confirmLink(this, 'You really want to delete this user?');" title="<?php echo $this->_config[0]['vars']['au19']; ?>
" ><img src="includes/templates/images/b_drop.png" border="0" width="16" height="16" /></a></td>
</tr>
<?php endfor; endif; ?>
            
            <?php if ($this->_tpl_vars['pages'] > 1): ?>
                 <tr bgcolor="#FFFFFF"><td colSpan="8" align="right">&nbsp;</td></tr>
                 <tr bgcolor="#FFFFFF">
                    <td colSpan="8" align="right"><?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&status_sel=<?php echo $this->_tpl_vars['status_sel']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
">&lt;&lt;&lt;</a><?php endif; ?>&nbsp;
            Page <select name="pvstart" style="font-size:9px" onChange="self.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&status_sel=<?php echo $this->_tpl_vars['status_sel']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc'];  echo $this->_tpl_vars['SIDA']; ?>
&pvstart='+ this.options[this.selectedIndex].value">
            <?php unset($this->_sections['pg']);
$this->_sections['pg']['name'] = 'pg';
$this->_sections['pg']['loop'] = is_array($_loop=$this->_tpl_vars['pgArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pg']['show'] = true;
$this->_sections['pg']['max'] = $this->_sections['pg']['loop'];
$this->_sections['pg']['step'] = 1;
$this->_sections['pg']['start'] = $this->_sections['pg']['step'] > 0 ? 0 : $this->_sections['pg']['loop']-1;
if ($this->_sections['pg']['show']) {
    $this->_sections['pg']['total'] = $this->_sections['pg']['loop'];
    if ($this->_sections['pg']['total'] == 0)
        $this->_sections['pg']['show'] = false;
} else
    $this->_sections['pg']['total'] = 0;
if ($this->_sections['pg']['show']):

            for ($this->_sections['pg']['index'] = $this->_sections['pg']['start'], $this->_sections['pg']['iteration'] = 1;
                 $this->_sections['pg']['iteration'] <= $this->_sections['pg']['total'];
                 $this->_sections['pg']['index'] += $this->_sections['pg']['step'], $this->_sections['pg']['iteration']++):
$this->_sections['pg']['rownum'] = $this->_sections['pg']['iteration'];
$this->_sections['pg']['index_prev'] = $this->_sections['pg']['index'] - $this->_sections['pg']['step'];
$this->_sections['pg']['index_next'] = $this->_sections['pg']['index'] + $this->_sections['pg']['step'];
$this->_sections['pg']['first']      = ($this->_sections['pg']['iteration'] == 1);
$this->_sections['pg']['last']       = ($this->_sections['pg']['iteration'] == $this->_sections['pg']['total']);
?>
            <option value="<?php echo $this->_tpl_vars['pgArr'][$this->_sections['pg']['index']]; ?>
" <?php if ($this->_tpl_vars['pgArr'][$this->_sections['pg']['index']] == $this->_tpl_vars['pvstart']): ?>selected="selected"<?php endif; ?>><?php echo $this->_sections['pg']['rownum']; ?>
</option>
            <?php endfor; endif; ?>
            </select> from <?php echo $this->_tpl_vars['pages']; ?>

<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?>&nbsp;<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&status_sel=<?php echo $this->_tpl_vars['status_sel']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
">&gt;&gt;&gt;</a><?php endif; ?></td>
       </tr>
<?php endif; ?>
</table>
<br />
</center>
<?php elseif (( $this->_tpl_vars['action'] == 'add' || $this->_tpl_vars['action'] == 'change' ) && $this->_tpl_vars['what'] == 'user'): ?>
                <center>
                <h2><?php echo $this->_config[0]['vars']['au1']; ?>
 | <?php if ($this->_tpl_vars['action'] == 'add'):  echo $this->_config[0]['vars']['au17'];  elseif ($this->_tpl_vars['action'] == 'change'):  echo $this->_config[0]['vars']['au18'];  endif; ?></h2>
                <?php if ($this->_tpl_vars['errs']): ?>
				    <font color="#990000">
					<b>Errors:</b><br />
					<?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					    - <?php echo $this->_tpl_vars['item']; ?>
<br />
					<?php endforeach; endif; unset($_from); ?>
					</font>
					<br />
				<?php endif; ?>  
							 <?php if ($this->_tpl_vars['UserLastError'] != ''): ?><p><b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b></p><?php endif; ?>
                             <form action="users.php" method="post" name="<?php if ($this->_tpl_vars['action'] == 'add'): ?>AddUserForm<?php elseif ($this->_tpl_vars['action'] == 'change'): ?>ChangeUserForm<?php endif; ?>" enctype="application/x-www-form-urlencoded" >
                             <input type="hidden" name="do"  value="1" />

                             <?php if (! empty ( $this->_tpl_vars['fm']['uid'] )): ?>
                             <input type="hidden" name="uid"       value="<?php echo $this->_tpl_vars['fm']['uid']; ?>
" />
                             <?php endif; ?>
                             <input type="hidden" name="action"    value="<?php echo $this->_tpl_vars['action']; ?>
"       />
                             <input type="hidden" name="what"      value="<?php echo $this->_tpl_vars['what']; ?>
"         />
                             <input type="hidden" name="ordercol"  value="<?php echo $this->_tpl_vars['ordercol']; ?>
"     />
                             <input type="hidden" name="orderdesc" value="<?php echo $this->_tpl_vars['orderdesc']; ?>
"    />
                             <input type="hidden" name="pvstart"   value="<?php echo $this->_tpl_vars['pvstart']; ?>
"      />
                             <table height="50%" cellSpacing="1" cellPadding="3" border="0" bgColor="#FFFFFF" >
                             
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Status</td>
                                 <td><b><?php if (1 == $this->_tpl_vars['fm']['status']): ?>Member<?php elseif (2 == $this->_tpl_vars['fm']['status']): ?>Employer<?php endif; ?></b></td>
                             </tr>
                             
                             <?php if (1 == $this->_tpl_vars['fm']['status']): ?>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>First Name</td>
                                 <td><input type="text" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Last Name</td>
                                 <td><input type="text" name="fm[lname]" value="<?php echo $this->_tpl_vars['fm']['lname']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Company</td>
                                 <td><input type="text" name="fm[company]" value="<?php echo $this->_tpl_vars['fm']['company']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Email Address</td>
                                 <td><input type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" id="email" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Phone</td>
                                 <td><input type="text" name="fm[phone]" value="<?php echo $this->_tpl_vars['fm']['phone']; ?>
" id="phone" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Street Address</td>
                                 <td><input type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Apartment/Suite</td>
                                 <td><input type="text" name="fm[suite]" value="<?php echo $this->_tpl_vars['fm']['suite']; ?>
" size="15" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>City</td>
                                 <td><input type="text" name="fm[city]" value="<?php echo $this->_tpl_vars['fm']['city']; ?>
" size="25" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>State</td>
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
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>ZIP</td>
                                 <td><input type="text" name="fm[zip]" value="<?php echo $this->_tpl_vars['fm']['zip']; ?>
" size="15" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Birthday</td>
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
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Gender</td>
                                 <td>
                                 <select name="fm[gender]">
									<option value="0">Select gender</option>
									<option value="1"<?php if (1 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Male</option>
									<option value="2"<?php if (2 == $this->_tpl_vars['fm']['gender']): ?> selected="selected"<?php endif; ?>>Female</option>
								</select>
                                 </td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>New password</td>
                                 <td><input type="password" name="fm[pass]" value="" size="30" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Confirm New Password</td>
                                 <td><input type="password" name="fm[pass2]" value="" size="30" /></td>
                             </tr>
                             <?php elseif (2 == $this->_tpl_vars['fm']['status']): ?>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Company Name</td>
                                 <td><input type="text" name="fm[company]" value="<?php echo $this->_tpl_vars['fm']['company']; ?>
" size="40" /></td>
                             </tr> 
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Email Address</td>
                                 <td><input type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" id="email" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Street Address</td>
                                 <td><input type="text" name="fm[address]" value="<?php echo $this->_tpl_vars['fm']['address']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Suite/Stage</td>
                                 <td><input type="text" name="fm[suite]" value="<?php echo $this->_tpl_vars['fm']['suite']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>City</td>
                                 <td><input type="text" name="fm[city]" value="<?php echo $this->_tpl_vars['fm']['city']; ?>
" size="25" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>State</td>
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
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>ZIP</td>
                                 <td><input type="text" name="fm[zip]" value="<?php echo $this->_tpl_vars['fm']['zip']; ?>
" size="15" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Phone Number</td>
                                 <td><input type="text" name="fm[phone]" value="<?php echo $this->_tpl_vars['fm']['phone']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Fax Number</td>
                                 <td><input type="text" name="fm[fax]" value="<?php echo $this->_tpl_vars['fm']['fax']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Contact Person within Company</td>
                                 <td><input type="text" name="fm[name]" value="<?php echo $this->_tpl_vars['fm']['name']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Contact Person's Title</td>
                                 <td><input type="text" name="fm[cperson_title]" value="<?php echo $this->_tpl_vars['fm']['cperson_title']; ?>
" size="40" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>New Password</td>
                                 <td><input type="password" name="fm[pass]" value="" size="30" /></td>
                             </tr>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle">
                                 <td>Confirm New Password</td>
                                 <td><input type="password" name="fm[pass2]" value="" size="30" /></td>
                             </tr>
                             <?php endif; ?>
                             <tr bgColor="#FFFFFF" align="center" vAlign="middle"> <td colSpan="2"><input type="submit" value="<?php echo $this->_config[0]['vars']['au15']; ?>
" style="width:70px;height:19px;font-size:12px;" /> <input type="submit" name="cancel" value="<?php echo $this->_config[0]['vars']['au16']; ?>
" style="width:70px;height:19px;font-size:12px;" /></td> </tr>
                             </table>
                             </form>

                             </center>
<?php endif; ?>