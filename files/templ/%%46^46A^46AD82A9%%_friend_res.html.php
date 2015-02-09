<?php /* Smarty version 2.6.11, created on 2010-05-30 01:35:23
         compiled from mods/member/friend/_friend_res.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/friend/_friend_res.html', 42, false),)), $this); ?>
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
title/contacts.gif" alt="Contacts" /></p><br />

                <?php if ($this->_tpl_vars['is_user']): ?>
				                    <?php endif; ?>
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="contacts-box">
						<?php if (! $this->_tpl_vars['inv']): ?>
                        <p class="contacts-top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend<?php echo $this->_tpl_vars['uid']; ?>
"><?php if ($this->_tpl_vars['letter']): ?>All<?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
all_b.gif" alt="All" /><?php endif; ?></a>
						<?php $_from = $this->_tpl_vars['la']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend<?php echo $this->_tpl_vars['uid']; ?>
?letter=<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['letter'] == $this->_tpl_vars['i']): ?> style="background-color:#CCC; padding: 3px;"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</a><?php endforeach; endif; unset($_from); ?>
						</p>
						<form class="contacts-form" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend<?php echo $this->_tpl_vars['uid']; ?>
" id="src">
							<input type="hidden" name="letter" value="<?php echo $this->_tpl_vars['letter']; ?>
" />
                            <label>Search contacts</label>
							<input class="txt" type="text" name="sstr" value="<?php echo $this->_tpl_vars['sstr']; ?>
" style="padding-top: 0px;" />
							<input class="contacts-b" type="submit" value="" onclick="_v('src').submit();" />
						</form>
                        <?php endif; ?>
					<table>
						<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
                        <tr>
							<td class="av"<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?> style="border: none;"<?php endif; ?>>
							<?php if ($this->_tpl_vars['i']['image']): ?>
                                    <div class="container02">
									    <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
									    <div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['i']['subdir']; ?>
s_<?php echo $this->_tpl_vars['i']['image']; ?>
" alt="<?php if (1 == $this->_tpl_vars['i']['status']):  echo $this->_tpl_vars['i']['name']; ?>
 <?php echo $this->_tpl_vars['i']['lname'];  else:  echo $this->_tpl_vars['i']['company'];  endif; ?>" /></a></div>
									    <div class="bl"><div class="blc"></div><div class="brc"></div></div>
								    </div>
                            <?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="No Photo" /></a><?php endif; ?>
							</td>
							<td<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?> style="border: none;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><br /><span><?php echo $this->_tpl_vars['i']['person_title']; ?>
</span></td>
							<td<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?> style="border: none;"<?php endif; ?>><p><?php if ($this->_tpl_vars['is_user'] && 1 == $this->_tpl_vars['i']['active']):  if ($this->_tpl_vars['i']['company'] && 1 == $this->_tpl_vars['i']['status']): ?><b>Company:&nbsp;&nbsp;</b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a><br /><?php endif;  if ($this->_tpl_vars['i']['lproj']['title']): ?><b>Current project:&nbsp;&nbsp;</b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['i']['lproj']['id']; ?>
"><?php echo $this->_tpl_vars['i']['lproj']['title']; ?>
</a><?php endif;  endif; ?></p></td>
							<td style="width: 100px;<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?>border: none;<?php endif; ?>"><p><?php if ($this->_tpl_vars['is_user'] && 1 == $this->_tpl_vars['i']['active']): ?><b>Email:&nbsp;&nbsp;</b><a href="mailto: <?php echo $this->_tpl_vars['i']['email']; ?>
"><?php echo $this->_tpl_vars['i']['email']; ?>
</a><br /><?php if ($this->_tpl_vars['i']['phone']): ?><b>Phone:&nbsp;&nbsp;</b><span><?php echo $this->_tpl_vars['i']['phone']; ?>
</span><br /><?php endif;  if ($this->_tpl_vars['i']['city']): ?><a href="<?php if (1 == $this->_tpl_vars['i']['status']):  echo $this->_tpl_vars['siteAdr']; ?>
crew.php?city=<?php echo $this->_tpl_vars['i']['city']; ?>
&amp;state=<?php echo $this->_tpl_vars['i']['state'];  if ($this->_tpl_vars['i']['prof1']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof1'];  elseif ($this->_tpl_vars['i']['prof2']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof2'];  elseif ($this->_tpl_vars['i']['prof3']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof3'];  endif;  else:  echo $this->_tpl_vars['siteAdr']; ?>
employers.php?city=<?php echo $this->_tpl_vars['i']['city']; ?>
&amp;state=<?php echo $this->_tpl_vars['i']['state'];  endif; ?>"><?php echo $this->_tpl_vars['i']['city']; ?>
</a> <?php endif;  if ($this->_tpl_vars['i']['state']): ?><a href="<?php if (1 == $this->_tpl_vars['i']['status']):  echo $this->_tpl_vars['siteAdr']; ?>
crew.php?state=<?php echo $this->_tpl_vars['i']['state'];  if ($this->_tpl_vars['i']['prof1']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof1'];  elseif ($this->_tpl_vars['i']['prof2']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof2'];  elseif ($this->_tpl_vars['i']['prof3']): ?>&tag=<?php echo $this->_tpl_vars['i']['prof3'];  endif;  else:  echo $this->_tpl_vars['siteAdr']; ?>
employers.php?state=<?php echo $this->_tpl_vars['i']['state'];  endif; ?>"><?php $this->assign('st', $this->_tpl_vars['i']['state']);  echo $this->_tpl_vars['states'][$this->_tpl_vars['st']]; ?>
</a><?php endif;  endif; ?></p></td>
							<td align="right"<?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?> style="border: none;"<?php endif; ?>>
                            	<?php if ($this->_tpl_vars['is_user']): ?>
                                <p><nobr><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=send&amp;uid=<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_left.gif" alt="Send message" /></a>&nbsp;&nbsp;
	                               <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
quest.gif" alt="User contacts" /></a>&nbsp;&nbsp;
	                               <?php if (! $this->_tpl_vars['inv'] && $this->_tpl_vars['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?>
	                                   <?php if ($this->_tpl_vars['i']['active'] != 1): ?>
	                                       <a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?fid=<?php echo $this->_tpl_vars['i']['uid']; ?>
&amp;mod=del', 'Do You want to delete user from contacts?');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close.gif" alt="Delete" /></a>
	                                   <?php else: ?>
	                                       <a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?fid=<?php echo $this->_tpl_vars['i']['uid']; ?>
&amp;mod=del', 'Do You want to delete user from contacts?');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close.gif" alt="Delete" /></a>
	                                   <?php endif; ?>
	                               <?php endif; ?></nobr>
                                </p>
                                <?php endif; ?>
                            </td>
						</tr>
                        <?php if ($this->_tpl_vars['UserInfo']['uid'] == $this->_tpl_vars['uid'] && $this->_tpl_vars['i']['active'] != 1): ?> 
                        <tr>
                            <td colspan="5" style="padding: 0px; margin: 0px;">
	                            <?php if (! $this->_tpl_vars['i']['active']): ?>
	                                <?php if ($this->_tpl_vars['inv']): ?>
	                                <font color="#CC0000">The user has sent inquiry for addition you to the contact list.</font>
	                                <div style="padding-top:5px;"><input type="button" name="addf<?php echo $this->_tpl_vars['i']['uid']; ?>
" value="Approve" class="inp" onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?fid=<?php echo $this->_tpl_vars['i']['uid']; ?>
&mod=confirm')" />&nbsp;&nbsp;<input type="button" name="addf<?php echo $this->_tpl_vars['i']['uid']; ?>
" value="Reject" class="inp" onclick="CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=ccancel&fid=<?php echo $this->_tpl_vars['i']['uid']; ?>
', 'Do You want to reject the invitation?');" /></div>
	                                <?php else: ?>
	                                <font color="#CC0000">Your request is still pending. The User has not yet approved your invitation.</font>
	                                <?php endif; ?>
	                            <?php elseif ($this->_tpl_vars['i']['active'] == 1): ?>

	                            <?php elseif ($this->_tpl_vars['i']['active'] == 2): ?>	
	                            <font color="#CC0000"><b class="bb">Unfortunately, your request has been denied by the User.</b></font>
	                            <?php endif; ?> 
                            </td>
                        </tr> 
                        <?php endif; ?>  
                        <?php endforeach; else: ?>
                        <tr>
							<td colspan="5">
                            Contacts not found
                            </td>
                        </tr>    
                        <?php endif; unset($_from); ?>
						
						<tr>
							<td colspan="3" class="nav-contacts">
								<?php if ($this->_tpl_vars['rcnt']): ?>Showing <?php echo $this->_tpl_vars['from']; ?>
 to <?php echo $this->_tpl_vars['to']; ?>
 of <?php echo $this->_tpl_vars['rcnt']; ?>
 contacts<?php endif; ?>
							</td>
							<td class="nav-contacts" align="right" colspan="2">
								<?php echo $this->_tpl_vars['pagging']; ?>

							</td>
						</tr>
					</table>
					</div>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
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