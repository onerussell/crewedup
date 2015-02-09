<?php /* Smarty version 2.6.11, created on 2010-12-11 23:53:46
         compiled from mods/employer/mc/_send.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/mc/_send.html', 14, false),array('modifier', 'truncate', 'mods/employer/mc/_send.html', 31, false),array('modifier', 'strip_tags', 'mods/employer/mc/_send.html', 32, false),)), $this); ?>
﻿<!-- Content -->
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/mail.gif" alt="#" /></p><br />
                
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					
                <?php if ($this->_tpl_vars['bl']): ?>
                     <b><font color="#FF0000">Sorry, You are blocked by <?php if ($this->_tpl_vars['whom']['status'] == 1):  echo ((is_array($_tmp=$this->_tpl_vars['whom']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['whom']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['whom']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></font></b>
                 <?php else: ?>     
                    <form class="write-mail-form" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php" name="SendMessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="do" value="1" />
	                <input type="hidden" name="mod" value="send" />
	                <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['whom']['uid']; ?>
" />
					<p><a class="f11" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=inbox">Inbox</a> <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
compose_message_b.gif" alt="Compose message" /></p>
                    <div class="clear" style="height:2px;"><!-- --></div>
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
                    <p><label>To:</label> <?php if ($this->_tpl_vars['frl']): ?><select name="uid"><?php $_from = $this->_tpl_vars['frl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 [<?php echo ((is_array($_tmp=$this->_tpl_vars['i']['person_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...") : smarty_modifier_truncate($_tmp, 50, "...")); ?>
]<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 [<?php echo $this->_tpl_vars['i']['person_title']; ?>
]<?php endif; ?></option><?php endforeach; endif; unset($_from); ?></select> <?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['whom']['uid']; ?>
" class="f15"><?php if ($this->_tpl_vars['whom']['status'] == 1):  echo ((is_array($_tmp=$this->_tpl_vars['whom']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['whom']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['whom']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><?php if ($this->_tpl_vars['whom']['person_title']): ?> <span class="f15">(<?php echo $this->_tpl_vars['whom']['person_title']; ?>
)</span><?php endif;  endif; ?></p>
					<p><label>Subject:</label> <input type="text" name="mess[subject]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['mess']['subject'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
" style="width:562px;" /></p>
					<p><textarea name="mess[message]"><?php echo ((is_array($_tmp=$this->_tpl_vars['mess']['message'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</textarea></p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=inbox"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="Cancel" /></a><a href="javascript: void(0);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" onclick="document.SendMessagesForm.submit();" /></a></p>
					</form>
				<?php endif; ?>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_banner02.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
			</td>
			<td class="right">
			<!-- Contact Box -->
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	 
			</td>
		</tr>
	</table>
</div>
<!-- /Content -->