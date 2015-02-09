<?php /* Smarty version 2.6.11, created on 2010-12-26 15:21:16
         compiled from mods/employer/_all.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/_all.html', 13, false),)), $this); ?>
<div class="content">
	<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/employers.gif" alt="#" /></p>
	<br />
	<table class="employers-t">
		<tr>
			<th width="165">Company</th>
			<th width="185">Location</th>
			<th width="165">Category</th>
			
		</tr>
        <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
		<tr<?php if (($this->_foreach['n']['iteration']-1) % 2 == 0): ?> class="grey"<?php endif; ?>>
			<td class="first"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></td>
			<td><?php if ($this->_tpl_vars['i']['city']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php?state=<?php echo $this->_tpl_vars['i']['state']; ?>
&amp;city=<?php echo $this->_tpl_vars['i']['city'];  if ($this->_tpl_vars['cat']): ?>&amp;cat=<?php echo $this->_tpl_vars['cat'];  endif; ?>"><?php echo $this->_tpl_vars['i']['city']; ?>
,</a><?php endif;  $this->assign('ov', $this->_tpl_vars['i']['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php?state=<?php echo $this->_tpl_vars['i']['state'];  if ($this->_tpl_vars['cat']): ?>&amp;cat=<?php echo $this->_tpl_vars['cat'];  endif; ?>"><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['ov']]; ?>
</a></td>
			<td class="end"><?php echo $this->_tpl_vars['i']['person_title']; ?>
</td>
					</tr>
        <?php endforeach; endif; unset($_from); ?>

		<tr>
			<td class="nav-employer" colspan="2"></td>
			<td class="nav-employer" colspan="2" align="right"><?php echo $this->_tpl_vars['pagging']; ?>
</td>
		</tr>
	</table>
</div>