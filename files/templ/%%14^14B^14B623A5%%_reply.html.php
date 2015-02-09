<?php /* Smarty version 2.6.11, created on 2010-09-12 14:21:55
         compiled from mods/member/mc/_reply.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/mc/_reply.html', 4, false),array('modifier', 'date_format', 'mods/member/mc/_reply.html', 4, false),array('modifier', 'lower', 'mods/member/mc/_reply.html', 4, false),array('modifier', 'ucfirst', 'mods/member/mc/_reply.html', 4, false),array('modifier', 'strip_tags', 'mods/member/mc/_reply.html', 7, false),)), $this); ?>
﻿                        <table class="mail-t">
							<tr>
								<?php if ($this->_tpl_vars['ui']['uid'] == $this->_tpl_vars['message']['toid']): ?><td class="first"><?php if ($this->_tpl_vars['message']['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
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
						</table>
                        
                    <?php if ($this->_tpl_vars['bl']): ?>
                        <br /><b><font color="#FF0000">Sorry, You are blocked by <?php if (1 == $this->_tpl_vars['message']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['message']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['message']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></font></b>
                    <?php else: ?>
                    <form class="write-mail-form" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php" name="ReplyMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="mod"            value="mc" />
                    <input type="hidden" name="id"             value="<?php echo $this->_tpl_vars['message']['id']; ?>
" />
                    <input type="hidden" name="action"         value="<?php echo $this->_tpl_vars['action']; ?>
" />
                    <input type="hidden" name="add_action"     value="reply" />
                    <input type="hidden" name="do"             value="1" />
                    <input type="hidden" name="pvstart"        value="<?php echo $this->_tpl_vars['pvstart']; ?>
" />
                    <input type="hidden" name="order"          value="<?php echo $this->_tpl_vars['order']; ?>
" />	
                    <p><label style="text-decoration:underline;">Post Reply</label></p> 
                    <?php if ($this->_tpl_vars['errs']): ?>
                        <br /> 
			            <font color="#990000">
			         	<?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
			                <?php echo $this->_tpl_vars['item']; ?>
<br />
			         	<?php endforeach; endif; unset($_from); ?>
			            </font>      	
	                    
                    <?php endif; ?>
                	<p><label>Subject:</label> <input type="text" name="mess[subject]" value="Re: <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['subject'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
" style="width:562px;" /></p>
					<p><textarea name="mess[message]" style="height:200px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['mess']['message'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</textarea></p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=<?php echo $this->_tpl_vars['mod']; ?>
&amp;action=<?php echo $this->_tpl_vars['action']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="Cancel" /></a><a href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" onclick="document.ReplyMessagesForm.submit();" /></a></p>
					</form>
                    <?php endif; ?>