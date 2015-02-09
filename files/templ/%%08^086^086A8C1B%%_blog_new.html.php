<?php /* Smarty version 2.6.11, created on 2010-06-03 14:59:56
         compiled from mods/member/blog/_blog_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/member/blog/_blog_new.html', 36, false),)), $this); ?>
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
title/<?php if ($this->_tpl_vars['id']): ?>edit_blog_entry<?php else: ?>new_blog_entry<?php endif; ?>.gif" alt="New Blog Entry" /></p><br />

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
blog.php" name="fmx" id="fmx">
                    <input type="hidden" name="what" value="add" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
                    <?php if ($this->_tpl_vars['id']): ?>
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <?php endif; ?>
                    
                    
					<p><label>Subject:</label> <input type="text" value="<?php echo $this->_tpl_vars['fm']['title']; ?>
" name="fm[title]" size="88" /></p>
					<p>Message</p>
					<p>
                     <script type="text/javascript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
tmpl/fck/fckeditor.js"></script>
					 <script type="text/javascript">
                     var sBasePath = '<?php echo $this->_tpl_vars['siteAdr']; ?>
tmpl/fck/';
                     var oFCKeditor = new FCKeditor( 'fm[story]' ) ;
                     oFCKeditor.BasePath	  = sBasePath ;
                     oFCKeditor.ToolbarSet = 'Basic' ;
                     FCKeditor.Height	  = 500;
                     oFCKeditor.Value	  = '<?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['story'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
' ;
                     oFCKeditor.Create() ;
                     </script>
                    </p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="javascript:_v('fmx').submit();"><?php if ($this->_tpl_vars['id']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /><?php endif; ?></a></p>
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