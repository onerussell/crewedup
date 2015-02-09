<?php /* Smarty version 2.6.11, created on 2011-01-07 19:18:01
         compiled from mods/member/gallery/_gallery_del.html */ ?>
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
title/delphoto.gif" alt="Delete photo" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<form class="write-mail-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="what" value="del" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <input type="hidden" name="do" value="1" />
                    <p><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['fi']['image']; ?>
" alt="" /><br /><br /></p>
					<p><b><?php echo $this->_tpl_vars['fi']['title']; ?>
</b></p>
					<p><?php echo $this->_tpl_vars['fi']['story']; ?>

                    <br /><span style="color:#CCCCCC">Uploaded on <?php echo $this->_tpl_vars['fi']['pdate']; ?>
 <?php echo $this->_tpl_vars['fi']['ptime']; ?>
</span></p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="javascript:_v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
delete_b.gif" alt="delete" /></a></p>
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