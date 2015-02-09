<?php /* Smarty version 2.6.11, created on 2010-05-24 13:41:18
         compiled from mods/member/friend/_friend_res_out.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/friend/_friend_res_out.html', 32, false),array('modifier', 'truncate', 'mods/member/friend/_friend_res_out.html', 35, false),)), $this); ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<table>
					<tr>
						<td width="190"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/contacts.gif" alt="#" /></p></td>
						<td><h1>(<?php echo $this->_tpl_vars['rcnt']; ?>
)</h1></td>
					</tr>
				</table>
				<br />

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
					
					<table class="user-contacts-t">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <tr>
        <?php endif; ?>
			<td class="bt">
			<div class="tt">
			
            <div class="container04">
				<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
				<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['image']):  echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo2.gif<?php endif; ?>" alt="Photo" width="79px" /></a></div>
				<div class="bl"><div class="blc"></div><div class="brc"></div></div>
			</div>
            
			<p><a class="f18" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (1 == $this->_tpl_vars['pl'][$this->_sections['i']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a></p>
			<p><b><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['person_title']; ?>
</b></p>
			<p><?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['age']): ?><b><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['age']; ?>
</b> y.o.,<?php endif; ?> <?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['city']):  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['city']; ?>
, <?php endif; ?> <?php $this->assign('ov', $this->_tpl_vars['pl'][$this->_sections['i']['index']]['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
&amp;state=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['state']; ?>
"><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['ov']]; ?>
</a></p>
			<?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['lproj']['title']): ?><p>Latest work: <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['lproj']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['lproj']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
</a></p><?php endif; ?>
            <?php if ($this->_tpl_vars['system_login'] && $this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']): ?>
             <div class="clear" style="padding:0; margin-top: 0px;"><!-- --></div>
             <table width="100%" style="margin-top: -10px;">
               <tr>
                   <td> <div style="margin-left: 5px;">
                   <?php if (! $this->_tpl_vars['pl'][$this->_sections['i']['index']]['is_friend']): ?>
                    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add2_ico.gif" alt="Add to Contacts" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=add&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
">Add to contacts</a>
                   <?php else: ?>
                    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete from contacts" /><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=del&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
', 'Are you sure you want to delete this User from your friends\' list?');">Delete from contacts</a>
                   <?php endif; ?></div>
                   </td>
                   <td>
                   <?php if (2 == $this->_tpl_vars['UserInfo']['status']): ?>
                    <div style="margin-left: 5px;">
                    <?php if (! $this->_tpl_vars['pl'][$this->_sections['i']['index']]['is_roster']): ?>
                        <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add2_ico.gif" alt="Add to Roster" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
roster.php?mod=add&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
">Add to roster</a>
                    <?php else: ?>
                        <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete from roster" /><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
roster.php?mod=del&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
', 'Are you sure you want to delete this User from your company roster?');">Delete from roster</a>
                    <?php endif; ?>
                    </div>   
                   <?php endif; ?>
                   </td>
               </tr>
            </table>
			<?php endif; ?>
            </div>
			</td>
        <?php if ($this->_sections['i']['index_next'] % 2 == 0): ?>
        </tr>
        <?php if (! $this->_sections['i']['last']): ?>
		<tr>
			<td class="g-sep" colspan="2">&nbsp;</td>
		</tr>
        <?php endif; ?>        
        <?php endif; ?>
        <?php endfor; else: ?>
        <tr>
           <td colspan="2">Users not found</td>
        </tr>   
        <?php endif; ?>

						<tr>
							<td class="nav-usercontacts">
								<?php if ($this->_tpl_vars['rcnt']): ?>Showing <?php echo $this->_tpl_vars['from']; ?>
 to <?php echo $this->_tpl_vars['to']; ?>
 of <?php echo $this->_tpl_vars['rcnt']; ?>
 contacts<?php endif; ?>
							</td>
							<td class="nav-usercontacts" align="right">
								<?php echo $this->_tpl_vars['pagging']; ?>

							</td>
						</tr>
					</table>


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