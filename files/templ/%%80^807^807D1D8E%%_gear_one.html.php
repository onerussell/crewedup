<?php /* Smarty version 2.6.11, created on 2010-05-24 16:33:41
         compiled from mods/member/gear/_gear_one.html */ ?>
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
title/gear.gif" alt="Gear" /></p></td>
						<td></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
                    <div class="comments_re">
					    <div style="float: left; padding-right: 4px;"><?php if ($this->_tpl_vars['fm']['image']): ?><a href="<?php echo $this->_tpl_vars['iPath']; ?>
/<?php echo $this->_tpl_vars['fm']['image']; ?>
" class="lightwindow page-options" title="<?php echo $this->_tpl_vars['fm']['title']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fm']['image']; ?>
" alt="" /></a><?php endif; ?></div> 
                        <div style="float: left;" class="color_blue"><font style="font-size:18px"><?php echo $this->_tpl_vars['fm']['title']; ?>
</font><font style="color:#999;"><?php if ($this->_tpl_vars['fm']['cat']): ?><br />Category: <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['fm']['cat']['id']; ?>
"><?php echo $this->_tpl_vars['fm']['cat']['title']; ?>
</a><?php endif; ?></font></div>
                        <div class="clear"><!-- --></div>
                        <br />
                    <p><?php echo $this->_tpl_vars['fm']['story']; ?>
</p>
                    <br /><?php if ($this->_tpl_vars['is_user']): ?>
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['fm']['uid']; ?>
/?id=<?php echo $this->_tpl_vars['fm']['id']; ?>
&amp;mod=add">Edit</a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['fm']['uid']; ?>
/?id=<?php echo $this->_tpl_vars['fm']['id']; ?>
&amp;mod=del">Delete</a> | 
                    <?php endif; ?>
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/">Back to gear listing</a> 
				    </div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
				
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