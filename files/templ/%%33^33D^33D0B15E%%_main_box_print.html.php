<?php /* Smarty version 2.6.11, created on 2010-05-24 13:49:51
         compiled from mods/member/_main_box_print.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/_main_box_print.html', 3, false),)), $this); ?>
                
                    <div class="my-profile" align="center">
						<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</h1>
						<?php if ($this->_tpl_vars['ui']['person_title']): ?><p><b><?php echo $this->_tpl_vars['ui']['person_title']; ?>
</b></p><?php endif; ?>
						<p>Email: <?php echo $this->_tpl_vars['ui']['email'];  if ($this->_tpl_vars['ui']['phone']): ?>, Phone: <?php echo $this->_tpl_vars['ui']['phone'];  endif; ?></p>
					</div>