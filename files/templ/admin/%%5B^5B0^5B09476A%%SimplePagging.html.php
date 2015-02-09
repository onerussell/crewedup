<?php /* Smarty version 2.6.11, created on 2010-12-11 05:34:32
         compiled from mods/Acc/SimplePagging.html */ ?>
<?php if (1 < $this->_tpl_vars['gpArr']['pages']): ?>
   <table border="0" cellSpacing="0" cellPadding="5">
   <tr bgcolor="#FFFFFF">

      <td align="right"><?php if ($this->_tpl_vars['gpArr']['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['gpArr']['baseUrl']; ?>
&pstart=<?php echo $this->_tpl_vars['gpArr']['pStart']-$this->_tpl_vars['gpArr']['ResOnPage']; ?>
">&lt;&lt;&lt;</a><?php endif; ?>&nbsp;
            Page <select name="pstart" style="font-size:9px" onChange="self.location='<?php echo $this->_tpl_vars['gpArr']['baseUrl'];  echo $this->_tpl_vars['SIDA']; ?>
&pstart='+ this.options[this.selectedIndex].value">
            <?php unset($this->_sections['pg']);
$this->_sections['pg']['name'] = 'pg';
$this->_sections['pg']['loop'] = is_array($_loop=$this->_tpl_vars['gpArr']['pgArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <option value="<?php echo $this->_tpl_vars['gpArr']['pgArr'][$this->_sections['pg']['index']]; ?>
" <?php if ($this->_sections['pg']['rownum'] == $this->_tpl_vars['gpArr']['curPage']+1): ?>selected="selected"<?php endif; ?>><?php echo $this->_sections['pg']['rownum']; ?>
</option>
            <?php endfor; endif; ?>
            </select> from <?php echo $this->_tpl_vars['gpArr']['pages']; ?>

        <?php if ($this->_tpl_vars['gpArr']['curPage'] < $this->_tpl_vars['gpArr']['pages']-1): ?>&nbsp;<a href="<?php echo $this->_tpl_vars['gpArr']['baseUrl']; ?>
&pstart=<?php echo $this->_tpl_vars['gpArr']['pStart']+$this->_tpl_vars['gpArr']['ResOnPage']; ?>
">&gt;&gt;&gt;</a><?php endif; ?></td>
   </tr>
   </table>
<?php endif; ?>