<?php /* Smarty version 2.6.11, created on 2011-01-07 12:57:31
         compiled from mods/member/blog/_blog_del.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/blog/_blog_del.html', 24, false),)), $this); ?>
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
				
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">
                        <p class="color_grey">Delete blog entry with all commentaries:</p>
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
								
                                <div class="info-box02" align="left">
							        <b><?php echo $this->_tpl_vars['fm']['title']; ?>
</b><br />
                                    <p><?php echo $this->_tpl_vars['fm']['story']; ?>
</p>
						         	<p><span><?php echo $this->_tpl_vars['fm']['pdate']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['fm']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></span> <?php if ($this->_tpl_vars['fm']['person_title']): ?>(<?php echo $this->_tpl_vars['fm']['person_title']; ?>
)<?php endif; ?></p>
					         	</div>						
                                <div class="comments-sep">&nbsp;</div>
                                <div class="clear" style="height:6px;"><!-- --></div>
                                <p align="right"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['id']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;what=del&conf=1"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
delete_b.gif" alt="delete" /></a></p>
						  
					</div>
				<div class="clear">&nbsp;</div>
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