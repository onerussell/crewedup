<?php /* Smarty version 2.6.11, created on 2010-05-26 20:29:03
         compiled from mods/member/mc/_read.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/mc/_read.html', 4, false),array('modifier', 'date_format', 'mods/member/mc/_read.html', 4, false),array('modifier', 'lower', 'mods/member/mc/_read.html', 4, false),array('modifier', 'ucfirst', 'mods/member/mc/_read.html', 4, false),array('modifier', 'strip_tags', 'mods/member/mc/_read.html', 7, false),)), $this); ?>
﻿                        <table class="mail-t">
							<tr>
								<?php if ($this->_tpl_vars['ui']['uid'] == $this->_tpl_vars['message']['toid']): ?><td class="first" style="background: none;"><?php if ($this->_tpl_vars['message']['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['message']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['message']['subdir']; ?>
s_<?php echo $this->_tpl_vars['message']['image']; ?>
" alt="<?php if (1 == $this->_tpl_vars['message']['status']):  echo $this->_tpl_vars['message']['name']; ?>
 <?php echo $this->_tpl_vars['message']['lname'];  else:  echo $this->_tpl_vars['message']['company'];  endif; ?>" /></a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['message']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="No Photo" /></a><?php endif; ?></td><?php endif; ?>
								<td><?php if ($this->_tpl_vars['ui']['uid'] != $this->_tpl_vars['message']['toid']): ?><b>To:</b><?php endif; ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['message']['uid']; ?>
" class="f12 color_green"><?php if (1 == $this->_tpl_vars['message']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['message']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['message']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><span><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['message']['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y %I:%M %p") : smarty_modifier_date_format($_tmp, "%m/%d/%Y %I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span> 
                                <b><?php if ($this->_tpl_vars['ui']['uid'] == $this->_tpl_vars['message']['toid']): ?>[Inbox]<?php else: ?>[Sent Message]<?php endif; ?></b><br />
								<b>Subject:</b> <?php echo $this->_tpl_vars['message']['subject']; ?>
<br />
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['message'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
<br />
                                
								</td>
							</tr>
							<tr>
							<td colspan="2" class="nav-mail">
								<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=delete&id=<?php echo $this->_tpl_vars['message']['id']; ?>
" onClick="if (!confirmLink(this, 'Are you sure you want to delete this message?')) return false;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
delete_b.gif" alt="Delete" /></a><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&amp;action=<?php echo $this->_tpl_vars['action']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close_b.gif" alt="Close" /></a><?php if ($this->_tpl_vars['action'] == 'inbox'): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=reply&id=<?php echo $this->_tpl_vars['message']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
reply_b.gif" alt="Reply" /></a><?php endif; ?></p>
							</td>
						</tr>
						</table>