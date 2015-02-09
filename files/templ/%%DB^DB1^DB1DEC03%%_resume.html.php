<?php /* Smarty version 2.6.11, created on 2010-05-24 13:44:20
         compiled from mods/member/resume/_resume.html */ ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<table>
					<tr>
						<td width="210"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/live_resume.gif" alt="Live Resume" /></p></td>
						<td><?php if ($this->_tpl_vars['is_user']): ?><p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=resume&amp;what=add&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Add" />Post a new entry</a></p><?php endif; ?></td>
					</tr>
				</table>	

                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/resume/_resume_base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_banner02.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
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