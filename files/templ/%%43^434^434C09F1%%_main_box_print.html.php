<?php /* Smarty version 2.6.11, created on 2010-06-01 22:15:21
         compiled from mods/employer/_main_box_print.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/_main_box_print.html', 2, false),)), $this); ?>
                    <div class="my-profile" align="center">
						<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</h1>
						<p><b><?php echo $this->_tpl_vars['ui']['person_title']; ?>
</b></p>
						<p>Email: <?php echo $this->_tpl_vars['ui']['email'];  if ($this->_tpl_vars['ui']['phone']): ?>, Phone: <?php echo $this->_tpl_vars['ui']['phone'];  endif; ?></p>
					</div>