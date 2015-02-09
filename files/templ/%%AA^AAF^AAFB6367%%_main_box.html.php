<?php /* Smarty version 2.6.11, created on 2010-05-24 23:42:12
         compiled from mods/employer/_main_box.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/_main_box.html', 5, false),)), $this); ?>
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
                        <div class="container05">
						    <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
						    <div class="ml"><?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><?php endif; ?><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo<?php if (! ( $this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public'] )): ?>2<?php endif; ?>.gif<?php endif; ?>" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
" /><?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?></a><?php endif; ?></div>
							<div class="bl"><div class="blc"></div><div class="brc"></div></div>
					    </div>
                                                
                    <div class="my-profile">

						<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</h1>
						<p><b><?php echo $this->_tpl_vars['ui']['person_title']; ?>
</b></p>
						<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
goto_b.gif" alt="To Profile" /><a class="f16" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
">Profile</a></p>
					</div>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>