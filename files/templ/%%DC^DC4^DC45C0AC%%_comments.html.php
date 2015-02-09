<?php /* Smarty version 2.6.11, created on 2010-05-24 12:45:00
         compiled from mods/member/comments/_comments.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/comments/_comments.html', 83, false),)), $this); ?>
<script language="javascript" type="text/javascript">
<?php echo '
    function SubmCom()
	{
	    if (\'\' == _v(\'story\').value)
		{
		    _v(\'errs\').innerHTML = \'<font style="color:#990000">Error: Please specify message text</font>\';
		}
		else
		{
		    _v(\'fmx\').submit();
		}
	}
	
    function SubmReply( id )
	{
		if (\'\' == _v(\'storyr\').value)
		{
		    _v(\'errsr\').innerHTML = \'<font style="color:#990000">Error: Please specify message text</font>\';
		}
		else
		{
		    _v(\'fmxr\').submit();
		}
	}
	
	function HideReply()
	{
	    if (CurReply)
		{
		    _v(\'reply_\'+CurReply).innerHTML = \'<p><a class="f11" href="javascript: ShowReply(\\\'\'+CurReply+\'\\\');">Post a reply</a></p>\';
		    CurReply = 0;
		}
	}
	
	var CurReply = 0;
	function ShowReply( id )
	{
	    if (id && CurReply != id)
		{
	        if ( CurReply )
			{
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
             \'<input type="hidden" name="wh" value="';  echo $this->_tpl_vars['wh'];  echo '" />\' +
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
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/comments_recommendations.gif" alt="Comments &amp; Recommendations" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">
						<p class="comments_re-top">
                        <span style="float:left;"><?php if (! $this->_tpl_vars['wh']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
comments_b.gif" alt="Comments" /></a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0;" src="<?php echo $this->_tpl_vars['imgDir']; ?>
comments_b2.gif" alt="Comments" /></a><?php endif; ?></span>
                        <span style="float:left;"><?php if ('r' == $this->_tpl_vars['wh']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;wh=r&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
recommendation_b.gif" alt="Recommendation" /></a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;wh=r&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
recommendation_b2.gif" alt="Recommendation" /></a><?php endif; ?></span>
                        <span style="float:left;"><?php if ('a' != $this->_tpl_vars['wh']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;wh=a&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
all_b2.gif" alt="All" /></a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;wh=a&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
all_b.gif" alt="All" /></a><?php endif; ?></span>
                        </p>
                        <?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?> 
						<div class="info-box02">
							<div class="comments-close"><?php if ($this->_tpl_vars['is_user'] || $this->_tpl_vars['i']['author'] == $this->_tpl_vars['UserInfo']['uid']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=comments&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;what=del&amp;id=<?php echo $this->_tpl_vars['i']['id'];  if ($this->_tpl_vars['wh']): ?>&amp;wh=<?php echo $this->_tpl_vars['wh'];  endif; ?>"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
							<p><?php echo $this->_tpl_vars['i']['story']; ?>
</p>
							<p><span><?php echo $this->_tpl_vars['i']['pdate']; ?>
 <?php echo $this->_tpl_vars['i']['ptime']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['i']['author']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a></span><?php if ($this->_tpl_vars['i']['person_title']): ?> (<?php echo $this->_tpl_vars['i']['person_title']; ?>
)<?php endif;  if ('a' == $this->_tpl_vars['wh']): ?> [<?php if (! $this->_tpl_vars['i']['ctype']): ?>Commentary<?php else: ?>Recommendation<?php endif; ?>]<?php endif; ?></p>
							<div id="drop"><!-- --></div>
                            
                            <?php if ($this->_tpl_vars['i']['reply_text']): ?>
                            <div style="background-color:#EEE; margin: 5px 20px 5px 20px; padding: 5px;">
                               <p><?php echo $this->_tpl_vars['i']['reply_text']; ?>
</p>
                               <p><span><?php echo $this->_tpl_vars['i']['reply_date']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
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
                            No <?php if (! $this->_tpl_vars['wh']): ?>Comments<?php else: ?>Recommendations<?php endif; ?>
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
title/new_<?php if ('r' == $this->_tpl_vars['wh']): ?>recomend<?php else: ?>comments<?php endif; ?>_entry.gif" alt="New Comment Entry" /></p><br />

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
                    <input type="hidden" name="wh" value="<?php echo $this->_tpl_vars['wh']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>