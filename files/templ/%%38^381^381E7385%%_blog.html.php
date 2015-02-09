<?php /* Smarty version 2.6.11, created on 2010-05-24 13:51:21
         compiled from mods/member/blog/_blog.html */ ?>
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
title/blog.gif" alt="Blog" /></p><br />
                
                <?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?>    
                    <p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['ui']['uid']; ?>
&amp;what=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Plus" />Post a new entry</a></p>
				<?php endif; ?>
                
                <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>  
				<div class="info-box02">
                    <div class="comments-close"><?php if ($this->_tpl_vars['is_user']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
&amp;what=del&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
					<p class="color_grey"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><br  /><?php echo $this->_tpl_vars['i']['pdate']; ?>
 | <?php echo $this->_tpl_vars['i']['ptime']; ?>
</p>
					<p><?php echo $this->_tpl_vars['i']['story']; ?>
</p>
					<div class="clear" style="height: 12px;"><!-- --></div>
					<p><?php if ($this->_tpl_vars['is_user']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
&amp;what=add&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
" class="f11">Edit</a> | <?php endif; ?><a class="f11" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php if ($this->_tpl_vars['i']['com_cnt']):  echo $this->_tpl_vars['i']['com_cnt']; ?>
 comment<?php if ($this->_tpl_vars['i']['com_cnt']): ?>s<?php endif;  else: ?>No comments<?php endif; ?></a></p>
				</div>
                <div class="comments-sep">&nbsp;</div>
                <?php endforeach; else: ?>
                <div class="info-box02">
                   Blog is empty
                </div>
                <?php endif; unset($_from); ?>
				
				
				<div class="clear" style="height:5px;">&nbsp;</div>
                <?php echo $this->_tpl_vars['pagging']; ?>

                
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