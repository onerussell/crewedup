<?php /* Smarty version 2.6.11, created on 2010-06-03 17:28:03
         compiled from mods/member/resume/_resume_one.html */ ?>
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
                    <div class="comments_re">
					    <div style="float: left; padding-right: 4px;"><?php if ($this->_tpl_vars['fm']['image']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fm']['image']; ?>
" alt="" /><?php endif; ?></div> 
                        <div style="float: left;" class="color_blue"><font style="font-size:18px"><?php echo $this->_tpl_vars['fm']['title']; ?>
</font><font style="color:#999;"><?php if ($this->_tpl_vars['fm']['prof']): ?><br /><?php echo $this->_tpl_vars['fm']['prof'];  endif;  if ($this->_tpl_vars['fm']['year'] && '0000' != $this->_tpl_vars['fm']['year']):  if ($this->_tpl_vars['fm']['prof']): ?>, <?php else: ?><br /><?php endif;  if ($this->_tpl_vars['fm']['month']):  $this->assign('ov', $this->_tpl_vars['fm']['month']-1);  echo $this->_tpl_vars['ma'][$this->_tpl_vars['ov']]; ?>
 <?php endif;  echo $this->_tpl_vars['fm']['year'];  endif; ?></font></div>
                        <div style="float: right;" align="center"><?php if ($this->_tpl_vars['fm']['image2']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fm']['image2']; ?>
" alt="" /><br /><?php endif; ?>&nbsp;<?php echo $this->_tpl_vars['fm']['company']; ?>
</div>
                        <div class="clear"><!-- --></div>
                        <br />
                    <p><?php echo $this->_tpl_vars['fm']['story']; ?>
</p>
                    <br /><?php if ($this->_tpl_vars['fm']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['fm']['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['fm']['id']; ?>
&amp;what=add">Edit</a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['fm']['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['fm']['id']; ?>
&amp;what=del">Delete</a> | 
                    <?php endif; ?>
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['fm']['uid']; ?>
/resume/">Back to resume list</a> 
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