<?php /* Smarty version 2.6.11, created on 2010-06-03 07:06:57
         compiled from mods/member/friend/_add.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/friend/_add.html', 29, false),)), $this); ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/add_contacts.gif" alt="Add to Contacts" /></p><br />
				
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">
                    
<form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php" id="fmx">
<input type="hidden" name="mod" value="add" />
<input type="hidden" name="fid" value="<?php echo $this->_tpl_vars['uf']['uid']; ?>
" />
<input type="hidden" name="add" value="1" />
<table>
    <tr>
	    <td style="padding: 4px;">
        
		<?php if ($this->_tpl_vars['uf']['image']): ?>
		    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uf']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['uf']['image']; ?>
" alt="" /></a><br /><br />
		<?php else: ?>
		    		<?php endif; ?>
		</td>
		<td valign="top">
            <br />
			Are you sure you want to add <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uf']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['uf']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['uf']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['uf']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['uf']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a> to your contacts' list?
			<br /><br />
            <a href="javascript: void(0)"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="" onclick="_v('fmx').submit();" /></a>&nbsp;&nbsp;<a href="javascript: void(0)"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php');" /></a>
		</td>
		
	</tr>
</table>
</form>


					</div>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
                				
			      
			</td>
			<td class="right">
			    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>