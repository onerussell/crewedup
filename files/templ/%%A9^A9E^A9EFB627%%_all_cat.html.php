<?php /* Smarty version 2.6.11, created on 2010-05-02 07:27:26
         compiled from mods/member/_all_cat.html */ ?>
<div class="content">
	<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/all_crew_members.gif" alt="#" /></p>
	<br />
	<table id="main-table">
		<tr>
			<?php $this->assign('ix', 0); ?>
            <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
            <?php if (($this->_foreach['n']['iteration']-1) % $this->_tpl_vars['cat_c'] == 0): ?>
            <td<?php if (! ($this->_foreach['n']['iteration']-1)): ?> class="leftbar"<?php else: ?> class="rightbar"<?php endif; ?>>
            <?php endif; ?>
				<p class="grey-line<?php if ($this->_tpl_vars['ix'] > 0): ?>-no<?php $this->assign('ix', 0);  else:  $this->assign('ix', 1);  endif; ?>"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['cat']; ?>
</a><?php echo $this->_tpl_vars['i']['users_cnt']; ?>
</p>
            <?php $this->assign('ov', ($this->_foreach['n']['iteration']-1)+1); ?>
            <?php if ($this->_tpl_vars['ov'] % $this->_tpl_vars['cat_c'] == 0 || ($this->_foreach['n']['iteration'] == $this->_foreach['n']['total'])): ?>    
			<?php $this->assign('ix', 0); ?>
            </td>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
		</tr>
	</table>
</div>