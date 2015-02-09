<?php /* Smarty version 2.6.11, created on 2010-12-11 23:53:28
         compiled from mods/employer/_profile.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/employer/_profile.html', 58, false),array('modifier', 'strip_tags', 'mods/employer/_profile.html', 171, false),array('modifier', 'truncate', 'mods/employer/_profile.html', 171, false),)), $this); ?>
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
upload_logo_ico.gif" alt="Upload Photo" />&nbsp;<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Upload Logo/Photo</a></p>
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
ac_setting_ico.gif" alt="Account Setting" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=profile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Account Setting</a></li>
									<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete" heigth="24" width="24"/><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;act=userdel">Delete User</a></li>
								</ul>
                                <?php endif; ?>
							</div>
						</div>
        				<?php endif; ?>		
					</div>
					<div class="grey-box-right">
						<h1><?php echo ((is_array($_tmp=$this->_tpl_vars['ui']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</h1>
						<p><b><?php echo $this->_tpl_vars['ui']['person_title']; ?>
</b></p>
						
                        <?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?>
						<p>&nbsp;</p>
						<?php if ($this->_tpl_vars['ui']['public_mail']): ?><p><b>Email:&nbsp;</b><a href="mailto:<?php echo $this->_tpl_vars['ui']['public_mail']; ?>
"><?php echo $this->_tpl_vars['ui']['public_mail']; ?>
</a></p><?php endif; ?>
						<?php if ($this->_tpl_vars['ui']['phone']): ?><p><b>Telephone:&nbsp;</b><span class="color_brown"><?php echo $this->_tpl_vars['ui']['phone']; ?>
</span></p><?php endif; ?>
						<p>&nbsp;</p>
												<ul class="list02">
							<li><b>Address:</b></li>
														<li><?php echo $this->_tpl_vars['ui']['address']; ?>
</li>
							<li><?php echo $this->_tpl_vars['ui']['city']; ?>
, <?php echo $this->_tpl_vars['ui']['state']; ?>
 <?php echo $this->_tpl_vars['ui']['zip']; ?>
</li>
						</ul>
						<p>&nbsp;</p>
						<?php if ($this->_tpl_vars['ui']['about_me']): ?>
                        <p class="clr"><b>About Us:</b></p>
						<p><?php echo $this->_tpl_vars['ui']['about_me']; ?>
</p>
						<?php endif; ?>
						<p>&nbsp;</p>                        
                        
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
small_view_ico.gif" alt="#" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire">View</a></li>
																			</ul>
								</div>
							</div>
						</div>
						<span id="wire_box"><!-- --></span>
						<?php endif; ?>
                        
                        <?php if (1 == $this->_tpl_vars['ui']['prof1']): ?>
						<div class="mini-title">
							<p style="width: 164px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico03.gif" alt="Company Credits" /><a href="javascript: ShowCredits('<?php echo $this->_tpl_vars['uid']; ?>
');" id="credits_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideCredits();" id="credits_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>Company Credits</b></p>
							<div class="mini-nav">
								<div>
									<ul>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/credits">View</a></li>
										<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/credits/?what=add">Post</a></li><?php endif; ?>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_print_ico.gif" alt="Print" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume?print=1" target="_blank">Print</a></li>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_fr_ico.gif" alt="Forward" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/credits?what=forward">Forward</a></li>
									</ul>
								</div>
							</div>
						</div>
                        <span id="credits_box"><!-- --></span>
						<?php endif; ?>
                        
                        <?php if (2 == $this->_tpl_vars['ui']['prof1']): ?>
                        <div class="mini-title">
							<p style="width: 164px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico08.gif" alt="Rentals" /><a href="javascript: ShowRentals('<?php echo $this->_tpl_vars['uid']; ?>
');" id="rentals_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideRentals();" id="rentals_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>Available Rentals</b></p>
                            
							<div class="mini-nav">
								<div>
									<ul>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
rental<?php echo $this->_tpl_vars['uid']; ?>
">View</a></li>
										<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?mod=add&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Post</a></li><?php endif; ?>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_fr_ico.gif" alt="Forward" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
rental<?php echo $this->_tpl_vars['uid']; ?>
?mod=forward">Forward</a></li>
									</ul>
								</div>
							</div>
						</div>
                        <span id="rentals_box"><!-- --></span>
						<?php endif; ?>                       
                        
						<div class="mini-title">
                            <p style="width: 164px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico04.gif" alt="Company Roster" /><a href="javascript: ShowRoster('<?php echo $this->_tpl_vars['uid']; ?>
');" id="roster_up"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up2.gif" alt="Down" /></a><a href="javascript: HideRoster();" id="roster_down" style="display:none;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down2.gif" alt="Up" /></a><b>Company Roster</b></p>
							<div class="mini-nav">
								<div>
									<ul>
										<li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_view_ico.gif" alt="View" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
roster<?php echo $this->_tpl_vars['uid']; ?>
">View</a></li>
										<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?><li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php">Add members</a></li><?php endif; ?>
									</ul>
								</div>
							</div>  
						</div>
                       <span id="roster_box"><!-- --></span>
						
						
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
/credits">View</a></li>
										    <li><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
small_edit_ico.gif" alt="Post" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/credits?what=addaward">Post</a></li>
									    </ul>
								    </div>
							 </div>  
                             <?php endif; ?>                         
                             <div class="clear"><!-- --></div>
                             <span id="award_box"><!-- --></span>                             
						</div>
                        
                        
						<div class="info-box02">
							<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/comments"><img style="float:none;margin:0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
recommendation_b.gif" alt="Recommendation" /></a>
							
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
                            No recommendations
                            <?php endif; ?>
                            <div class="clear" style="height:5px;"><!-- --></div>
                            <?php if (IS_AUTH && ( ! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public'] )): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/comments#newc">Post Recommendation</a>

                            <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php" name="fmtx" id="fmtx">
                            <input type="hidden" name="act" value="comments" />
                            <input type="hidden" name="what" value="add" />
                            <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
					        <b>New Recommendation</b><br />
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
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>