<?php /* Smarty version 2.6.11, created on 2010-05-25 15:16:37
         compiled from mods/employer/comments/_comments.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/comments/_comments.html', 67, false),)), $this); ?>
<script language="javascript" type="text/javascript">
<?php echo '
    function SubmCom() {
	    if (\'\' == _v(\'story\').value) {
		    _v(\'errs\').innerHTML = \'<font style="color:#990000">Error: Please specify message text</font>\';
		}
		else {
		    _v(\'fmx\').submit();
		}
	}
	
    function SubmReply( id ) {
		if (\'\' == _v(\'storyr\').value) {
		    _v(\'errsr\').innerHTML = \'<font style="color:#990000">Error: Please specify message text</font>\';
		}
		else {
		    _v(\'fmxr\').submit();
		}
	}
	
	function HideReply() {
	    if (CurReply) {
		    _v(\'reply_\'+CurReply).innerHTML = \'<p><a class="f11" href="javascript: ShowReply(\\\'\'+CurReply+\'\\\');">Post a reply</a></p>\';
		    CurReply = 0;
		}
	}
	
	var CurReply = 0;
	function ShowReply( id ) {
	    if (id && CurReply != id) {
	        if ( CurReply ) {
			    _v(\'reply_\'+CurReply).innerHTML = \'<p><a class="f11" href="javascript: ShowReply(\\\'\'+CurReply+\'\\\');">Post a reply</a></p>\';
			}
			CurReply = id;
	        _v(\'reply_\'+CurReply).innerHTML = 
			\'<br /><span id="errsr"><!-- --></span>\'+
             \'<form class="comments_re-form" method="post" name="fmxr" id="fmxr" action="';  echo $this->_tpl_vars['siteAdr']; ?>
profile.php<?php echo '">\' +
             \'<input type="hidden" name="act" value="comments" />\' +
             \'<input type="hidden" name="what" value="addreply" />\' +
             \'<input type="hidden" name="uid" value="';  echo $this->_tpl_vars['uid'];  echo '" />\' +
	         \'<input type="hidden" name="fm[cid]" id="cid" value="\'+id+\'" />\' +
			 \'<input type="hidden" name="page" value="';  echo $this->_tpl_vars['page'];  echo '" />\' +
			 \'<textarea name="fm[story]" id="storyr"></textarea>\' + 
          	 \'<p><a href="javascript: HideReply();"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'cancel_b.gif" alt="Cancel" /></a> <a href="javascript: SubmReply();"><img src="';  echo $this->_tpl_vars['imgDir'];  echo 'post_b.gif" alt="Post" /></a></p>\' +        
          	 \'</form>\';
	    }
	}
	'; ?>

</script>

<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/recommendations.jpg" alt="Recommendations" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">
						<p class="comments_re-top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
recomend_b.gif" alt="Recommendations" /></a>                                                   </p>
                      <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?> 
						<div class="info-box02">
							<div class="comments-close"><?php if ($this->_tpl_vars['is_user'] || $this->_tpl_vars['i']['author'] == $this->_tpl_vars['UserInfo']['uid']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;what=del&amp;id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
							<p><?php echo $this->_tpl_vars['i']['story']; ?>
</p>
							<p><span><?php echo $this->_tpl_vars['i']['pdate']; ?>
 <?php echo $this->_tpl_vars['i']['ptime']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['author']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a></span><?php if ($this->_tpl_vars['i']['person_title']): ?> (<?php echo $this->_tpl_vars['i']['person_title']; ?>
)<?php endif; ?></p>
							<div id="drop"><!-- --></div>
                            
                            <?php if ($this->_tpl_vars['i']['reply_text']): ?>
                            <div style="background-color:#EEE; margin: 5px 20px 5px 20px; padding: 5px;">
                               <p><?php echo $this->_tpl_vars['i']['reply_text']; ?>
</p>
                               <p><span><?php echo $this->_tpl_vars['i']['reply_date']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></span><?php if ($this->_tpl_vars['ui']['person_title']): ?> (<?php echo $this->_tpl_vars['ui']['person_title']; ?>
)<?php endif; ?></p>
                            </div> 
                            <?php endif; ?>
                            
                            <?php if ($this->_tpl_vars['is_user']): ?>
                            <?php if ($this->_tpl_vars['i']['reply_text']): ?>
                            <div>
                                <p><a class="f11" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
&amp;id=<?php echo $this->_tpl_vars['i']['id']; ?>
&amp;what=delreply&amp;page=<?php echo $this->_tpl_vars['page']; ?>
">Delete a reply</a></p>
                            </div>
                            <?php else: ?>
                            <div id="reply_<?php echo $this->_tpl_vars['i']['id']; ?>
">
                                <p><a class="f11" href="javascript: ShowReply('<?php echo $this->_tpl_vars['i']['id']; ?>
');">Post a reply</a></p>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
						</div>

						<div class="comments-sep">&nbsp;</div>
                        <?php endforeach; else: ?>
                        <div class="info-box02">
                            No Recommendations
                      </div>    
                        <?php endif; unset($_from); ?>
					</div>
				<div class="clear" style="height:5px;">&nbsp;</div>
				<?php echo $this->_tpl_vars['pagging']; ?>

                </div>
				<div class="grey-box-bottom">&nbsp;</div>
                
                <?php if (IS_AUTH && ! $this->_tpl_vars['is_user']): ?>
				<a name="newc" />
				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/new_recomend_entry.gif" alt="New Comment Entry" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
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
                    
					<form class="write-mail-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php" name="fmx" id="fmx">
                    <input type="hidden" name="act" value="comments" />
                    <input type="hidden" name="what" value="add" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
					<p>Message</p>
					<p><textarea name="fm[story]" id="story" style="height: 170px;"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea></p>
					<p class="tools"><a href="javascript: SubmCom();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /></a></p>
					</form>
				
				</div>
				<div class="grey-box-bottom">&nbsp;</div>                
                <?php endif; ?>
               
                
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_banner02.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
			<td class="right">
			    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>