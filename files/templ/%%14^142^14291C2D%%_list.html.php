<?php /* Smarty version 2.6.11, created on 2010-05-24 23:02:33
         compiled from mods/gear/_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/gear/_list.html', 30, false),)), $this); ?>
<div class="content">
		<h1 style="color:#000;font-size:2.4em;font-weight:normal;"><div style="float: left;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
box.gif" alt="" /></div><div style="float:left; margin-top: 8px;"><?php echo $this->_tpl_vars['ci']['title']; ?>
</div></h1>
	<div class="clear"><!-- --></div>
    <?php if ($this->_tpl_vars['model']): ?>
    <br /><h1 style="color:#000;font-size:1.3em;font-weight:normal;">Model: <b><?php echo $this->_tpl_vars['model']; ?>
</b> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg'];  if ($this->_tpl_vars['state']): ?>&amp;state=<?php echo $this->_tpl_vars['state'];  endif;  if ($this->_tpl_vars['city']): ?>&amp;city=<?php echo $this->_tpl_vars['city'];  endif; ?>">Show All</a></h1>
    <?php endif; ?>
    <br />
    <?php if ($this->_tpl_vars['pl']): ?>
	<table class="employers-t">
		<tr>
			<th width="165">Company</th>
			<th width="165">Location</th>
			<th width="165">Type</th>
			<th>Model</th>
            <th></th>
		</tr>
        <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
		<tr<?php if (2 == $this->_tpl_vars['i']['status']): ?> class="grey"<?php else: ?> class="green"<?php endif; ?>>
			<td class="first"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&amp;city=<?php echo $this->_tpl_vars['i']['city']; ?>
&amp;state=<?php echo $this->_tpl_vars['i']['state']; ?>
"><?php echo $this->_tpl_vars['i']['city']; ?>
,</a><?php $this->assign('ov', $this->_tpl_vars['i']['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&amp;state=<?php echo $this->_tpl_vars['i']['state']; ?>
"><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['ov']]; ?>
</a></td>
			<td><?php if (1 == $this->_tpl_vars['i']['status']): ?>private owner<?php else: ?>rental service<?php endif; ?></td>
			<td>&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&amp;model=<?php echo $this->_tpl_vars['i']['title'];  if ($this->_tpl_vars['state']): ?>&amp;state=<?php echo $this->_tpl_vars['state'];  endif;  if ($this->_tpl_vars['city']): ?>&amp;city=<?php echo $this->_tpl_vars['city'];  endif; ?>"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['title'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 40) : smarty_modifier_wordwrap($_tmp, 40)); ?>
</a></td>
            <td class="end"><a href="<?php echo $this->_tpl_vars['siteAdr'];  if (2 == $this->_tpl_vars['i']['status']): ?>rental<?php else: ?>gear<?php endif;  echo $this->_tpl_vars['i']['uid']; ?>
/?id=<?php echo $this->_tpl_vars['i']['id']; ?>
">View</a></td>
		</tr>
        <?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class="nav-employer" colspan="2"><?php echo $this->_tpl_vars['pagging']; ?>
</td>
			<td class="nav-employer" colspan="2" align="right"><p></p></td>
		</tr>
	</table>
    <?php else: ?>
        Gears not found<br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php">Back</a>
    <?php endif; ?>
</div>