<?php /* Smarty version 2.6.11, created on 2010-06-03 15:08:04
         compiled from mods/member/resume/_resume_del.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'mods/member/resume/_resume_del.html', 20, false),array('modifier', 'truncate', 'mods/member/resume/_resume_del.html', 20, false),)), $this); ?>
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
						<td></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					
                    <p style="font-size: 16px;"><b>Delete Entry</b></p>
                    <div class="info-box02" style="padding-left: 20px; width: 95%;">
					    <p class="color_blue"><?php if ($this->_tpl_vars['fm']['image']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fm']['image']; ?>
" alt="" /><?php endif; ?><font style="font-size:18px"><?php echo $this->_tpl_vars['fm']['title']; ?>
</font><font style="color:#999;"><?php if ($this->_tpl_vars['fm']['prof']): ?><br /><?php echo $this->_tpl_vars['fm']['prof'];  endif;  if ($this->_tpl_vars['fm']['year'] && '0000' != $this->_tpl_vars['fm']['year']):  if ($this->_tpl_vars['fm']['prof']): ?>, <?php else: ?><br /><?php endif;  if ($this->_tpl_vars['fm']['month']):  $this->assign('ov', $this->_tpl_vars['fm']['month']-1);  echo $this->_tpl_vars['ma'][$this->_tpl_vars['ov']]; ?>
 <?php endif;  echo $this->_tpl_vars['fm']['year'];  endif; ?></font></p>
                        <div class="clear"><!-- --></div>
                        <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['fm']['story'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
</p>
                    </div> 
                    <p align="right"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['id']; ?>
&amp;what=del&amp;do=1"><?php if ($this->_tpl_vars['id']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
delete_b.gif" alt="Delete" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /><?php endif; ?></a></p>
				</div>
				
				<div class="grey-box-bottom">&nbsp;</div>

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