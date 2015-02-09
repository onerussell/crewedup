<?php /* Smarty version 2.6.11, created on 2010-12-11 05:35:27
         compiled from mods/Maintenance/History.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_paginal_viewing', 'mods/Maintenance/History.html', 40, false),)), $this); ?>
<?php echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" height="3"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 's.gif" height="3" width="1" alt="" border="0" /></td></tr><tr><td colspan="2" height="450" align="left" valign="top" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="5"></td></tr><tr><td><br />';  if ($this->_tpl_vars['action'] == 'view' && $this->_tpl_vars['what'] == 'list'):  echo '<h2><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'menu/history.gif" border="0" height="16" alt="Event viewer" />&nbsp;Event viewer</h2><a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=delete&what=all&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pvstart=';  echo $this->_tpl_vars['pvstart'];  echo '" onClick="return confirmLink(this, \'';  echo $this->_config[0]['vars']['confirm'];  echo ' delete all events?\');" ><img border="0" src="';  echo $this->_tpl_vars['imgDir'];  echo '12.gif" alt="" width="10" height="10" />&nbsp;<b>Delete all events</b></a><br /><br /><table cellSpacing="2" cellPadding="0" border="0" width="100%" bgcolor="#FFFFFF"><tr bgcolor="#DDDEDF" align="center" vAlign="middle" height="20"><td>&nbsp;<b>Date</b>&nbsp;</td><td>&nbsp;<b>Action type</b>&nbsp;</td><td>&nbsp;<b>What</b>&nbsp;</td><td>&nbsp;<b>User</b>&nbsp;</td><td>&nbsp;<b>IP</b>&nbsp;</td><td><b>&nbsp;Actions&nbsp;</b></td></tr>';  unset($this->_sections['iif']);
$this->_sections['iif']['name'] = 'iif';
$this->_sections['iif']['loop'] = is_array($_loop=$this->_tpl_vars['HA']['rows']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo '<tr align="center" vAlign="middle" height="35" bgcolor="#ECEEF1"><td>&nbsp;';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['date_f'];  echo '&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['action'];  echo '&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['what'];  echo '&nbsp;</td><td>&nbsp;<b>';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['login'];  echo '</b>&nbsp;</td><td>&nbsp;';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['ip'];  echo '&nbsp;</td><td width="70"><a href="';  echo $this->_tpl_vars['curScriptName'];  echo '?action=delete&what=record&id=';  echo $this->_tpl_vars['HA']['rows'][$this->_sections['iif']['index']]['id'];  echo '&start_date=';  echo $this->_tpl_vars['start_date'];  echo '&end_date=';  echo $this->_tpl_vars['end_date'];  echo '&pstart=';  echo $this->_tpl_vars['pstart'];  echo '" onClick="return confirmLink(this, \'';  echo $this->_config[0]['vars']['confirm'];  echo ' delete this record?\');" ><img alt="Delete" src="';  echo $this->_tpl_vars['imgDir'];  echo 'b_drop.png" border="0" width="16" height="16" /></a></td></tr>';  endfor; endif;  echo '</table><div align="right">';  echo smarty_function_html_paginal_viewing(array('m_arr' => $this->_tpl_vars['HA']['gp'],'base_url' => ($this->_tpl_vars['curScriptName'])."?action=view&what=list&start_date=".($this->_tpl_vars['start_date'])."&end_date=".($this->_tpl_vars['end_date'])), $this); echo '</div>';  endif;  echo '</td></tr></table></td><td width="250"></td></tr></table></td></tr></table>'; ?>