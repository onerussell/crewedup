<?php /* Smarty version 2.6.11, created on 2010-07-03 16:20:57
         compiled from mods/member/resume/_resume_add_award.html */ ?>
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
						<td width="310"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/affilations.gif" alt="Affiliations/Awards" /></p></td>
						<td></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					
                    <?php if ($this->_tpl_vars['errs']): ?>
                    <p><font style="color:#990000">
                    <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <?php echo $this->_tpl_vars['i']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
                    </font></p>
                    <?php endif; ?>
					<form class="write-mail-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php" name="fmx" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="act" value="resume" />
                    <input type="hidden" name="what" value="addaward" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
                    <?php if ($this->_tpl_vars['id']): ?>
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <?php endif; ?>
                    
                    <p><label style="color:#333;"><?php if (! $this->_tpl_vars['id']): ?>Post a new<?php else: ?>Edit<?php endif; ?> entry</label></p>                  
					<p><label>Title:</label> <input type="text" value="<?php echo $this->_tpl_vars['fm']['title']; ?>
" name="fm[title]" size="78" /></p>
					<p><label>Link:</label> <input type="text" name="fm[link]" size="78" value="<?php echo $this->_tpl_vars['fm']['link']; ?>
" /></p>
					<p class="tools"><?php if (! $this->_tpl_vars['id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=resume&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <?php endif; ?><a href="javascript:_v('fmx').submit();"><?php if ($this->_tpl_vars['id']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /><?php endif; ?></a><?php if ($this->_tpl_vars['id']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?what=delaward&amp;id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
remove_b.gif" alt="Remove" /></a><?php endif; ?> </p>
					</form>
			
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