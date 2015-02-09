<?php /* Smarty version 2.6.11, created on 2010-05-02 21:00:09
         compiled from mods/gear/_all.html */ ?>
<div class="content">
	<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/all_gear.gif" alt="All Gear" /></p>
	<br />
	<table id="main-table">
		<tr>
			<td class="leftbar">
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_sections['i']['index'] == $this->_tpl_vars['gcnt']): ?>
			<td class="rightbar">
			<?php endif; ?>
				<p class="grey-line<?php if ($this->_sections['i']['index'] % 2 != 0): ?>-no<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['gl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['gl'][$this->_sections['i']['index']]['title']; ?>
</a><?php echo $this->_tpl_vars['gl'][$this->_sections['i']['index']]['cnt']; ?>
</p>
			<?php if ($this->_sections['i']['index_next'] == $this->_tpl_vars['gcnt'] || $this->_sections['i']['last']): ?>
			</td>
            <?php endif; ?>
			<?php endfor; endif; ?>
		</tr>
	</table>
</div>