<?php /* Smarty version 2.6.11, created on 2010-12-10 11:23:48
         compiled from mods/Security/Be/modules.html */ ?>
<br />

<h2><img border="0" src="includes/templates/images/menu/rs.gif" alt="" />&nbsp;<?php echo $this->_config[0]['vars']['mo1']; ?>
</h2>
<br />

<center>
<form name="fb" method="post">
    <input type="hidden" name="action" id="action" value="update" />
    <input type="hidden" name="id" id="id" value="0" />

<table cellSpacing="1" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20">
   <td width="70px">&nbsp;<b><?php echo $this->_config[0]['vars']['mo2']; ?>
</b>&nbsp;</td>
   <td>&nbsp;<b><?php echo $this->_config[0]['vars']['mo3']; ?>
</b>&nbsp;</td>
   <td>&nbsp;<b><?php echo $this->_config[0]['vars']['mo4']; ?>
</b>&nbsp;</td>
   <td width="90"><b><?php echo $this->_config[0]['vars']['mo5']; ?>
</b>&nbsp;</td>
   <td colSpan="2"><b>&nbsp;<?php echo $this->_config[0]['vars']['mo6']; ?>
&nbsp;</b></td>
</tr>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<tr bgcolor="#ECEEF1" align="center" vAlign="middle">
    <td>&nbsp;<input type="text" name="sortid<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sortid']; ?>
" style="width:30px" />&nbsp;</td>
    <td>&nbsp;<input type="text" name="fname<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="width:100px" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['fname']; ?>
" onKeyPress="filter(event,3,'_-',1)"/><b>.php</b>&nbsp;</td>
    <td>&nbsp;<input type="text" name="name<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" style="width:180px" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
" />&nbsp;</td>
    <td align="center"><nobr><?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['active'] == 0): ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
"><img src="includes/templates/images/status_green_l.gif " border="0"></a>&nbsp;<img src="includes/templates/images/status_red.gif ">
                     <?php else: ?><img src="includes/templates/images/status_green.gif " border="0">&nbsp;<a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
"><img src="includes/templates/images/status_red_l.gif" border="0"></a>
					<?php endif; ?></nobr></td>
    <td width="30"><a href="#" onClick="document.getElementById('id').value='<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
'; document.getElementById('action').value='edit'; document.fb.submit(); return false;" title="<?php echo $this->_config[0]['vars']['mo11']; ?>
"><img src="includes/templates/images/b_save.png" border="0" width="16" height="16" /></a></td>
    <td width="30"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=del&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
" onClick="return confirmLink(this, '<?php echo $this->_config[0]['vars']['mo10']; ?>
');" title="<?php echo $this->_config[0]['vars']['mo9']; ?>
" ><img src="includes/templates/images/b_drop.png" border="0" width="16" height="16" /></a></td>
</tr>
<?php endfor; endif; ?>
    <td colspan="5" align="left"><input type="submit" value="<?php echo $this->_config[0]['vars']['mo11']; ?>
" /></td>
</table>
</form>
<br />
    <form name="fa" method="post">
    <input type="hidden" name="action" value="edit" />
    <table>
    <tr bgcolor="#ECEEF1" align="center" vAlign="middle">
        <td>&nbsp;<b><?php echo $this->_config[0]['vars']['mo7']; ?>
</b>&nbsp;</td>
        <td>&nbsp;<?php echo $this->_config[0]['vars']['mo3']; ?>
: <input type="text" name="fname" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['fname']; ?>
" style="width:100px" onKeyPress="filter(event,3,'_-',1)" /><b>.php</b>&nbsp;</td>
        <td>&nbsp;<?php echo $this->_config[0]['vars']['mo4']; ?>
: <input type="text" name="name" value="<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
" style="width:100px" />&nbsp;</td>
        <td>&nbsp;<input type="submit" value="<?php echo $this->_config[0]['vars']['mo8']; ?>
" /></td>
    </table>
    </form>
</center>