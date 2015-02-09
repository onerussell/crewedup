<?php /* Smarty version 2.6.11, created on 2010-12-14 22:15:19
         compiled from mods/employer/resume/_award_box.html */ ?>
<?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (! ($this->_foreach['n']['iteration'] <= 1)): ?>, <?php endif; ?><a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><?php endforeach; else: ?>No Affiliations/Awards<?php endif; unset($_from); ?>