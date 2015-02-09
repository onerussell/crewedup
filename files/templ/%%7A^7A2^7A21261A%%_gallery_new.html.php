<?php /* Smarty version 2.6.11, created on 2010-08-31 23:42:56
         compiled from mods/member/gallery/_gallery_new.html */ ?>
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
title/<?php if ($this->_tpl_vars['id']): ?>edit_photo<?php else: ?>new_photo<?php endif; ?>.gif" alt="New Blog Entry" /></p><br />

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
gallery.php" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="what" value="add" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
                    <?php if ($this->_tpl_vars['id']): ?>
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <?php endif; ?>
                    
                    <p><?php if (! $this->_tpl_vars['id']): ?><label>Image:</label> <input type="file" name="fm[image]" /> (.jpg, .gif and .png only, max. size 2mb)
                    <?php else: ?><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['fi']['image']; ?>
" alt="" /><br /><br /><?php endif; ?></p>
					<p><label>Title:</label> <input type="text" value="<?php echo $this->_tpl_vars['fm']['title']; ?>
" name="fm[title]" size="88" /></p>
					<p>Description</p>
					<p><textarea name="fm[story]" style="height: 90px;"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea></p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="javascript:_v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir'];  if (! $this->_tpl_vars['id']): ?>post<?php else: ?>save<?php endif; ?>_b.gif" alt="Post" /></a></p>
					</form>
				
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