<?php /* Smarty version 2.6.11, created on 2010-12-10 11:23:58
         compiled from mods/Security/Be/admin_users.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/Security/Be/admin_users.html', 22, false),)), $this); ?>
<br />
<?php if ($this->_tpl_vars['action'] == 'view' && $this->_tpl_vars['what'] == 'list'): ?>

<h2><img border="0" src="includes/templates/images/menu/list_users.gif" alt="<?php echo $this->_config[0]['vars']['au1']; ?>
" />&nbsp;<?php echo $this->_config[0]['vars']['au1']; ?>
</h2>

&nbsp;&nbsp;<img border="0" src="includes/templates/images/12.gif" alt="" width="10" height="10" />&nbsp;<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=add&what=user&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
"><?php echo $this->_config[0]['vars']['au7']; ?>
</a>
<br /><br />

<center>
<table cellSpacing="1" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20">
   <td>&nbsp;<b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=login&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'login' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>"><?php echo $this->_config[0]['vars']['au2']; ?>
</a><?php if ($this->_tpl_vars['ordercol'] == 'login'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td>&nbsp;<b><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=name&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'name' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>"><?php echo $this->_config[0]['vars']['au3']; ?>
</a><?php if ($this->_tpl_vars['ordercol'] == 'name'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td>&nbsp;<b><?php echo $this->_config[0]['vars']['au4']; ?>
</b>&nbsp;</td>
   <td width="90"><b>&nbsp;<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=view&what=list&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=status&orderdesc=<?php if ($this->_tpl_vars['ordercol'] == 'status' && $this->_tpl_vars['orderdesc'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>"><?php echo $this->_config[0]['vars']['au5']; ?>
</a><?php if ($this->_tpl_vars['ordercol'] == 'status'): ?>&nbsp;<img src="includes/templates/images/s_<?php echo $this->_tpl_vars['orderdesc']; ?>
.png" width="11" height="9" alt="" /><?php endif; ?></b>&nbsp;</td>
   <td colSpan="2"><b>&nbsp;<?php echo $this->_config[0]['vars']['au6']; ?>
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
    <td>&nbsp;<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['login']; ?>
&nbsp;</td>
    <td>&nbsp;<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['name']; ?>
&nbsp;</td>
    <td>&nbsp;<small><?php if ('admin' != $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['login']):  echo ((is_array($_tmp=$this->_tpl_vars['UA'][$this->_sections['iif']['index']]['modules_arr'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 50, "<br />", false) : smarty_modifier_wordwrap($_tmp, 50, "<br />", false));  else: ?>all modules<?php endif; ?></small>&nbsp;</td>
    <td>
       <?php if ('admin' != $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['login']): ?>
       <select name="status" style="font-size:10px" onChange="self.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&what=status&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc'];  echo $this->_tpl_vars['SIDA']; ?>
&status='+ this.options[this.selectedIndex].value">
        <option value="0"  <?php if (0 == $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au20']; ?>
</option>
        <option value="1"  <?php if (1 == $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au21']; ?>
</option>
        <option value="2"  <?php if (2 == $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au22']; ?>
</option>
        </select>
       <?php else: ?>
       <small>adminitstrator</small>
       <?php endif; ?>
    </td>

    <td width="30"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&what=user&uid=<?php echo $this->_tpl_vars['UA'][$this->_sections['iif']['index']]['uid']; ?>
&ordercol=<?php echo $this->_tpl_vars['ordercol']; ?>
&orderdesc=<?php echo $this->_tpl_vars['orderdesc']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
" title="<?php echo $this->_config[0]['vars']['au18']; ?>
"><img src="includes/templates/images/b_edit.png" border="0" width="16" height="16" /></a></td>
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
                             <?php if ($this->_tpl_vars['UserLastError'] != ''): ?><p><b><i><font color="red"><?php echo $this->_tpl_vars['UserLastError']; ?>
</font></i></b></p><?php endif; ?>
                             <form action="usersa.php" method="post" name="<?php if ($this->_tpl_vars['action'] == 'add'): ?>AddUserForm<?php elseif ($this->_tpl_vars['action'] == 'change'): ?>ChangeUserForm<?php endif; ?>" enctype="application/x-www-form-urlencoded" >
                             <input type="hidden" name="do"  value="1" />

                             <?php if (! empty ( $this->_tpl_vars['UserInfo']['uid'] )): ?>
                             <input type="hidden" name="uid"       value="<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
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
                             <?php if ('admin' != $this->_tpl_vars['UserInfo']['login']): ?>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au2']; ?>
</td>     <td> <input type="text" name="UserInfo[login]"    value="<?php echo $this->_tpl_vars['UserInfo']['login']; ?>
"     maxlength="30"  style="font-size:12px;width:150px;" onKeyPress="filter(event,2,'01234567890_-',1)" /> </td> </tr>
                             <?php else: ?>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au2']; ?>
</td>     <td> <input type="hidden" name="UserInfo[login]" value="admin" /> <input type="text" value="<?php echo $this->_tpl_vars['UserInfo']['login']; ?>
" style="font-size:12px;width:150px;" disabled="disabled" /> </td> </tr>
                             <?php endif; ?>

                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au8']; ?>
</td>  <td> <input type="password" name="UserInfo[pass]"  value=""                  maxlength="21" style="font-size:12px;width:150px;" onKeyPress="filter(event,3,'_-',1)" /> </td> </tr>
                             <?php if ($this->_tpl_vars['action'] == 'change'): ?>
                             <tr bgcolor="#DDDEDF" align="left" vAlign="middle"> <td colSpan="2"><small><i><?php echo $this->_config[0]['vars']['au9']; ?>
</i></small></td> </tr>
                             <?php endif; ?>
                             <?php if ('admin' == $this->_tpl_vars['UserInfo']['login']): ?>
                             <tr bgColor="#ECEEF1" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au10']; ?>
</td> 
                                                               <td> 
                                     <input type="hidden" value="0" name="UserInfo[status]" />
                                     <select disabled="disabled">
                                      <option>administrator</option>
                                     </select>
                                                               
                                                               </td> </tr>
                             <?php else: ?>
                             <tr bgColor="#ECEEF1"  align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au10']; ?>
</td> 
                                                               <td> 
                                     <select name="UserInfo[status]">
                                      <option value="0"  <?php if (0 == $this->_tpl_vars['UserInfo']['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au20']; ?>
</option>
                                      <option value="1"  <?php if (1 == $this->_tpl_vars['UserInfo']['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au21']; ?>
</option>
                                      <option value="2"  <?php if (2 == $this->_tpl_vars['UserInfo']['status']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_config[0]['vars']['au22']; ?>
</option>
                                     </select>
                                                               
                                                               </td> </tr>

                             <tr bgColor="#ECEEF1" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au11']; ?>
</td> 
                                                               <td> 
                                     <select name="UserInfo[modulesx][]" multiple="multiple" size="10">
                                     <?php unset($this->_sections['iim']);
$this->_sections['iim']['name'] = 'iim';
$this->_sections['iim']['loop'] = is_array($_loop=$this->_tpl_vars['modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iim']['show'] = true;
$this->_sections['iim']['max'] = $this->_sections['iim']['loop'];
$this->_sections['iim']['step'] = 1;
$this->_sections['iim']['start'] = $this->_sections['iim']['step'] > 0 ? 0 : $this->_sections['iim']['loop']-1;
if ($this->_sections['iim']['show']) {
    $this->_sections['iim']['total'] = $this->_sections['iim']['loop'];
    if ($this->_sections['iim']['total'] == 0)
        $this->_sections['iim']['show'] = false;
} else
    $this->_sections['iim']['total'] = 0;
if ($this->_sections['iim']['show']):

            for ($this->_sections['iim']['index'] = $this->_sections['iim']['start'], $this->_sections['iim']['iteration'] = 1;
                 $this->_sections['iim']['iteration'] <= $this->_sections['iim']['total'];
                 $this->_sections['iim']['index'] += $this->_sections['iim']['step'], $this->_sections['iim']['iteration']++):
$this->_sections['iim']['rownum'] = $this->_sections['iim']['iteration'];
$this->_sections['iim']['index_prev'] = $this->_sections['iim']['index'] - $this->_sections['iim']['step'];
$this->_sections['iim']['index_next'] = $this->_sections['iim']['index'] + $this->_sections['iim']['step'];
$this->_sections['iim']['first']      = ($this->_sections['iim']['iteration'] == 1);
$this->_sections['iim']['last']       = ($this->_sections['iim']['iteration'] == $this->_sections['iim']['total']);
?>
                                      <option value="<?php echo $this->_tpl_vars['modules'][$this->_sections['iim']['index']]; ?>
"  <?php if (ereg ( $this->_tpl_vars['modules_'][$this->_sections['iim']['index']] , $this->_tpl_vars['UserInfo']['modules'] )): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['modulesNames'][$this->_sections['iim']['index']]; ?>
</option>
                                     <?php endfor; endif; ?>
                                     </select>
                                     <?php echo $this->_config[0]['vars']['au12']; ?>

                                                               </td> </tr>
                            <?php endif; ?>                                   

                             <tr bgColor="#DDDEDF" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au13']; ?>
</td>  <td> <input type="text" name="UserInfo[name]" value="<?php echo $this->_tpl_vars['UserInfo']['name']; ?>
" maxlength="50" style="font-size:12px;width:150px;" /> </td> </tr>

                             <tr bgColor="#DDDEDF" align="left" vAlign="middle"> <td><?php echo $this->_config[0]['vars']['au14']; ?>
</td>     <td> <input type="text" name="UserInfo[email]" value="<?php echo $this->_tpl_vars['UserInfo']['email']; ?>
" maxlength="96" style="font-size:12px;width:150px;" onKeyPress="filter(event,2,'@.-_0123456789',1)" /> </td> </tr>

                             <tr bgColor="#FFFFFF" align="center" vAlign="middle"> <td colSpan="2"><input type="submit" value="<?php echo $this->_config[0]['vars']['au15']; ?>
" style="width:70px;height:19px;font-size:12px;" /> <input type="submit" name="cancel" value="<?php echo $this->_config[0]['vars']['au16']; ?>
" style="width:70px;height:19px;font-size:12px;" /></td> </tr>
                             </table>
                             </form>

                             </center>
<?php endif; ?>
