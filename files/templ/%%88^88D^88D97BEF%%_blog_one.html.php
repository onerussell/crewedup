<?php /* Smarty version 2.6.11, created on 2010-05-02 20:49:43
         compiled from mods/member/blog/_blog_one.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/blog/_blog_one.html', 42, false),)), $this); ?>
<script language="javascript" type="text/javascript">
<?php echo '
    function SubmCom()
	{
	    if (\'\' == _v(\'story\').value)
		    _v(\'errs\').innerHTML = \'<font style="color:#990000">Error: Please specify message text</font>\';
		else
		    _v(\'fmx\').submit();
	}
'; ?>

</script>
	
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
                <?php if ($this->_tpl_vars['is_user']): ?>    
                    <p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['ui']['uid']; ?>
&amp;what=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Plus" />Post a new entry</a></p>
				    <div id="drop"><!-- --></div>
                <?php endif; ?>                
				<div class="info-box02" style="padding-left: 20px; width: 95%; float: none;">
					<div class="comments-close"><?php if ($this->_tpl_vars['is_user']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;what=del&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
                    <p class="color_blue"><font style="font-size:18px"><?php echo $this->_tpl_vars['fi']['title']; ?>
</font><br  /><?php echo $this->_tpl_vars['fi']['pdate']; ?>
</p>
					<p><?php echo $this->_tpl_vars['fi']['story']; ?>
</p>
					<div class="clear" style="height: 12px;"><!-- --></div>
					<?php if ($this->_tpl_vars['system_login']): ?><div style="width: 100%; height:1px;"><!-- --></div><p><?php if ($this->_tpl_vars['is_user']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;what=add&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
" class="f11">Edit</a> | <?php endif; ?><a class="f11" href="#reply">Post a reply</a></p><?php endif; ?>
				</div>
				<div id="drop"><!-- --></div>
                
                
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">
						<?php if ($this->_tpl_vars['com']): ?>
                        <?php $_from = $this->_tpl_vars['com']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ka'] => $this->_tpl_vars['ia']):
?>
                        <div class="info-box02">
							<div class="comments-close"><?php if ($this->_tpl_vars['is_user'] || $this->_tpl_vars['ia']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;mid=<?php echo $this->_tpl_vars['ia']['id']; ?>
&amp;what=delcom"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
							<p><?php echo $this->_tpl_vars['ia']['story']; ?>
</p>
							<p><span><?php echo $this->_tpl_vars['ia']['pdate']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['ia']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['ia']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['ia']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></span> <?php if ($this->_tpl_vars['ia']['person_title']): ?>(<?php echo $this->_tpl_vars['ia']['person_title']; ?>
)<?php endif; ?></p>
							<?php if ($this->_tpl_vars['system_login']): ?><div style="width: 100%; height:1px;"><!-- --></div><p><?php if ($this->_tpl_vars['is_user'] || $this->_tpl_vars['ia']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?><a class="f11" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;mid=<?php echo $this->_tpl_vars['ia']['id']; ?>
&amp;what=editcom">Edit</a><?php endif; ?></p><?php endif; ?>
						</div>						
                        <div class="comments-sep">&nbsp;</div>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                      
                        <?php if ($this->_tpl_vars['system_login']): ?>
                        <a name="reply" />
                        <br /><p><b style="color:#a3a2a2">Post a reply</b></p>
                            <p id="errs">
                            <?php if ($this->_tpl_vars['errs']): ?>
                            <font style="color:#990000">
                                <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <?php echo $this->_tpl_vars['i']; ?>
<br />
                                <?php endforeach; endif; unset($_from); ?>
                            </font>
                            <?php endif; ?>
                            </p>
                            <form class="comments_re-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php" id="fmx">
                            <input type="hidden" name="what" value="addcom" />
                            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['fi']['id']; ?>
" />
								<textarea name="fm[story]" id="story"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea>
								<p><a href="javascript: SubmCom();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /></a></p>
							</form>
                        <?php endif; ?>    
					</div>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
                			
				<p><a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['fi']['uid']; ?>
">Back to Blog</a></p>
                
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