<?php /* Smarty version 2.6.11, created on 2010-12-11 22:57:41
         compiled from mods/member/_profile.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/_profile.html', 91, false),array('modifier', 'strip_tags', 'mods/member/_profile.html', 179, false),array('modifier', 'truncate', 'mods/member/_profile.html', 179, false),)), $this); ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="grey-box-left">
						<div class="container05" style="margin:0">
							<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
							<div class="ml"><?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><?php endif; ?><img src="<?php if ($this->_tpl_vars['ui']['image']):  echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['ui']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo<?php if (! ( $this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public'] )): ?>2<?php endif; ?>.gif<?php endif; ?>" alt="Photo" /><?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?></a><?php endif; ?></div>
							<div class="bl"><div class="blc"></div><div class="brc"></div></div>
						</div> 					
						<p class="upload-logo2"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
see_ico.gif" alt="See" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
">See All Photos</a></p>
						<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?>
                        <p class="upload-logo2"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
upload_photo_ico.gif" alt="Upload Photo" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;what=add">Upload Photo</a></p>
                        <?php endif; ?>
                        
                        <?php if ($this->_tpl_vars['system_login']): ?>
						<div class="swhite-box-top">
							<div class="swhite-box-bottom">
								<?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?>
                                <ul class="smenu">
									
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
message2_ico.gif" alt="Send Message" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=send&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Send Message</a></li>

                                    <?php if (! $this->_tpl_vars['cf']): ?>
                                        <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add_me_ico.gif" alt="Add Me" /><a class="color_green" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=add&amp;fid=<?php echo $this->_tpl_vars['uid']; ?>
">Add Me</a></li>
	                                <?php else: ?>
		                                <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del_ico.gif" alt="Delete Me" /><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=del&amp;fid=<?php echo $this->_tpl_vars['uid']; ?>
', 'Are you sure you want to delete this User from your contacts\' list?');">Delete Me</a></li>
	                                <?php endif; ?>
    
                         			<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
block_me_ico.gif" alt="Block Me" /><a class="color_red" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
?act=chgblock"><?php if ($this->_tpl_vars['bf']): ?>Unblock Me<?php else: ?>Block Me<?php endif; ?></a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
forward2_ico.gif" alt="Forward" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
?act=forward">Forward</a></li>
                                    <?php if ($this->_tpl_vars['is_public']): ?>
                                    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
view_ico.gif" alt="Edit view" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
">Edit View</a></li>
                                    <?php endif; ?>
								</ul>
                                <?php else: ?>
                                <ul class="smenu">
                  <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
mail_ico.gif" alt="Mail" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php">Mail</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
edit_ico.gif" alt="Edit profile" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Edit Profile</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
view_ico.gif" alt="Public view" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;public=1">Public View</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
wire_ico.gif" alt="The Wire" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire">The Wire</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
blog_ico.gif" alt="Blog" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['uid']; ?>
">Blog</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico12.gif" alt="Gear" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
">Gear</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ac_setting_ico.gif" alt="Settings" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=profile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Account Settings</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete" heigth="24" width="24"/><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;act=userdel">Delete User</a></li>
								</ul>
                                <?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
                        
						<div class="mini-calentar">
							<p class="month-celect"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?pdate=<?php echo $this->_tpl_vars['prev_next']['0']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
calendar_month_arrow_green1.gif" alt="Prev" /></a><?php echo $this->_tpl_vars['cdi']['mmonth']; ?>
 <?php echo $this->_tpl_vars['cdi']['year']; ?>
<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?pdate=<?php echo $this->_tpl_vars['prev_next']['1']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
calendar_month_arrow_green2.gif" alt="Next" /></a></p>	
							<table class="calendar-small">
							<tr>
								<th>Sun</th>
								<th>Mon</th>
								<th>Tue</th>
								<th>Wed</th>
								<th>Thu</th>
								<th>Fri</th>
								<th>Sat</th>
							</tr>
                            
                            <?php $_from = $this->_tpl_vars['cdi']['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                            <tr>
                                <?php $_from = $this->_tpl_vars['i']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                                <?php $this->assign('ov', $this->_tpl_vars['i2']['1']); ?>
                                    <td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=calendar&amp;pdate=<?php echo $this->_tpl_vars['i2']['1']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"<?php if (1 == $this->_tpl_vars['cevents'][$this->_tpl_vars['ov']]['status']): ?> class="green"<?php elseif (2 == $this->_tpl_vars['cevents'][$this->_tpl_vars['ov']]['status']): ?> class="red"<?php endif; ?>><?php echo $this->_tpl_vars['i2']['0']; ?>
</a></td>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?>
                            <!-- class="green" class="red" -->
						</table>
						
						<div class="select-color2">
							<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
green_cub2.gif" alt="Available" />Available</p>
							<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
red_cub2.gif" alt="Booked" />Booked</p>
						</div>
					    </div>	
					</div>
                    
					<div class="grey-box-right">
						<?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?>
                         <span style="float:right; color:#999999;"><?php if ($this->_tpl_vars['ui']['view_cnt']): ?>Profile views: <?php echo $this->_tpl_vars['ui']['view_cnt']; ?>
<br /><?php endif;  if ($this->_tpl_vars['ui']['dt']): ?>Member Since: <?php echo $this->_tpl_vars['ui']['dt']; ?>
<br /><?php endif;  if ($this->_tpl_vars['ui']['llogin']): ?>Last Login: <?php echo $this->_tpl_vars['ui']['llogin'];  endif; ?></span>
                        <?php endif; ?>
                        
                        <div style="float:left; width: 350px;">
                            <h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</h1>
						    <p><b><?php echo $this->_tpl_vars['ui']['person_title']; ?>
</b></p> 
						</div>
                        
                        <?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?>
                            <div class="cl" style="width: 100%; clear: both;"><!-- --></div>
                            <p>&nbsp;</p>
						    <p><span class="color_brown"><?php echo $this->_tpl_vars['ui']['title']; ?>
</span></p>
						    <p>&nbsp;</p>
						    <p><?php if ($this->_tpl_vars['ui']['age'] && ! $this->_tpl_vars['ui']['no_age']): ?><b><?php echo $this->_tpl_vars['ui']['age']; ?>
</b> y.o.,<?php endif; ?> <?php if ($this->_tpl_vars['ui']['city']):  echo $this->_tpl_vars['ui']['city']; ?>
, <?php endif;  echo $this->_tpl_vars['ui']['state']; ?>
</p>
						    <p>&nbsp;</p>
						
                            <?php if ($this->_tpl_vars['ui']['about_me']): ?>
                            <div class="mini-title">
							    <p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico13.gif" alt="About me" /><b>About Me</b></p>
						    </div>	
						    <p class="clr"><?php echo $this->_tpl_vars['ui']['about_me']; ?>
</p>
                            <?php endif; ?>
                        
                            <?php if ($this->_tpl_vars['ui']['interests']): ?>
						    <div class="mini-title">
							    <p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico14.gif" alt="Interests" /><b>Interests</b></p>
						    </div>							
                            <p class="clr"><?php echo $this->_tpl_vars['ui']['interests']; ?>
</p>
						    <p>&nbsp;</p>
						    <?php endif; ?>
                        <?php else: ?>
                            <div class="mini-title">
							    <p style="width: 150px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
wire2_ico.gif" alt="The Wire" /><a href="javascript: ShowWire('<?php echo $this->_tpl_vars['uid']; ?>
');" id="wire_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideWire();" id="wire_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>The Wire</b> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
rss.php?mod=wire" target="_blank"><b>News</b></a></p>
							    <div class="mini-nav">
								    <div>
									    <ul>
										    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire">View</a></li>
									    </ul>
								    </div>
							    </div>
					    	</div>
						    <span id="wire_box"><!-- --></span>
						    <script type="text/javascript">
                            // <![CDATA[
                            ShowWire('<?php echo $this->_tpl_vars['uid']; ?>
');
                            // ]]>
						    </script>
                        <?php endif; ?>
                        
						<div class="mini-title">
							<p style="width: 124px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico04_.gif" alt="Resume" /><a href="javascript: ShowResume('<?php echo $this->_tpl_vars['uid']; ?>
');" id="resume_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideResume();" id="resume_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>Live Resume</b></p>
							
                            <div class="mini-nav">
								<div>
									<ul>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume">View</a></li>
										<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?what=add">Post</a></li><?php endif; ?>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_print_ico.gif" alt="Print" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume?print=1" target="_blank">Print</a></li>
                                        <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_fr_ico.gif" alt="Forward" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume?what=forward">Forward</a></li>
									</ul>
								</div>
							</div>
                            
						</div>	
                        <span id="resume_box"><!-- --></span>
						
                        
						<div class="mini-title">
							<p style="width: 170px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico07.gif" alt="Awards" /><a href="javascript: ShowAward('<?php echo $this->_tpl_vars['uid']; ?>
');" id="award_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideAward();" id="award_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>Affiliations/Awards </b></p>
                            <?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?>
                            <div class="mini-nav">
								    <div>
									    <ul>
										    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume">View</a></li>
										    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume?what=addaward">Post</a></li>
									    </ul>
								    </div>
							 </div>
                             <?php endif; ?>
                             <div class="clear"><!-- --></div>
                             <span id="award_box"><!-- --></span>                             
						</div>	

						<div class="info-box02">
							<span style="float:left;"><a href="javascript: void(0);" id="b_com_a"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
comments_b.gif" alt="Comments" /></a><a href="javascript: ShowComment('<?php echo $this->_tpl_vars['uid']; ?>
', '');" id="b_com" style="display: none;"><img style="float:none;margin:0;" src="<?php echo $this->_tpl_vars['imgDir']; ?>
comments_b2.gif" alt="Comments" /></a></span>
                            <span style="float:left;"><a href="javascript: void(0);" id="b_rec_a" style="display:none;"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
recommendation_b.gif" alt="Recommendation" /></a><a href="javascript: ShowComment('<?php echo $this->_tpl_vars['uid']; ?>
', 'r');" id="b_rec"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
recommendation_b2.gif" alt="Recommendation" /></a></span>
                            <span style="float:left;"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/comments?wh=a"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
all_b2.gif" alt="All" /></a></span>
                            
							
                            <div class="clear" style="height: 5px;"><!-- --></div>
                            <span id="comment_box">
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['coml']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                            <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['story'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
<br />
							<span><?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['pdate']; ?>
 <?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['ptime']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['author']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></span><?php if ($this->_tpl_vars['coml'][$this->_sections['i']['index']]['person_title']): ?> (<?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['person_title']; ?>
)<?php endif; ?></p>
							<?php if (! $this->_sections['i']['last']): ?>
                            <div class="clear" style="height:10px;"><!-- --></div>
                            <?php endif; ?>
                            <?php endfor; else: ?>
                            No comments
                            <?php endif; ?>
                            <div class="clear" style="height:5px;"><!-- --></div>
                            <?php if (IS_AUTH && ( ! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public'] )): ?>
                            <?php if ('r' == $this->_tpl_vars['wh']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/comments?wh=r#newc">Post Recommendation</a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/comments#newc">Post Comment</a><?php endif; ?>  | 
                            
                            <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php" name="fmtx" id="fmtx">
                            <input type="hidden" name="act" value="comments" />
                            <input type="hidden" name="what" value="add" />
                            <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
                            <input type="hidden" name="wh" value="<?php echo $this->_tpl_vars['wh']; ?>
" />
					        <?php if ('r' == $this->_tpl_vars['wh']): ?><b>New Recommendation</b><?php else: ?><b>New Comment</b><?php endif; ?><br />
					        <p><textarea name="fm[story]" id="story" style="height: 60px; width: 470px;"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea></p>
					        <div style="float:right;"><a href="javascript: _v('fmtx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /></a></div>
					        </form> 
                            <?php endif; ?>
                            
                            </span>
						</div>
						
					
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