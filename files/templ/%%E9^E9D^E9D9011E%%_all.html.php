<?php /* Smarty version 2.6.11, created on 2010-05-24 13:13:30
         compiled from mods/member/_all.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/_all.html', 59, false),)), $this); ?>
<div class="content">
	    <h1 style="color:#000;font-size:2.4em;font-weight:normal;"><div style="float: left;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/uico.gif" alt="" /></div><div style="float:left; margin-top: 8px;"><?php echo $this->_tpl_vars['ci']['cat']; ?>
</div></h1>
	<div class="clear"><!-- --></div><br />
    <p class="contacts-top">
        <?php if (! $this->_tpl_vars['letter']): ?>All<?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
">All</a><?php endif; ?>
		<?php $_from = $this->_tpl_vars['la']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
&amp;letter=<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['letter'] == $this->_tpl_vars['i']): ?> style="background-color:#CCC; padding: 3px;"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</a> <?php endforeach; endif; unset($_from); ?>
		</p>
		<br />

	<table class="view-box-t">
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
"><?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></p>
			<p><b><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['person_title']; ?>
</b></p>
			<p><?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['age'] && ! $this->_tpl_vars['pl'][$this->_sections['i']['index']]['no_age']): ?><b><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['age']; ?>
</b> y.o.,<?php endif; ?> <?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['city']):  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['city']; ?>
, <?php endif; ?> <?php $this->assign('ov', $this->_tpl_vars['pl'][$this->_sections['i']['index']]['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
&amp;state=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['state']; ?>
"><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['ov']]; ?>
</a></p>
						<?php if ($this->_tpl_vars['system_login'] && $this->_tpl_vars['UserInfo']['uid'] != $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']): ?>
                <p class="u-tools">
                <?php if (! $this->_tpl_vars['pl'][$this->_sections['i']['index']]['is_friend']): ?>
                    <span style="float:left; width: 155px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add2_ico.gif" alt="Add to Contacts" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=add&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
">Add to contacts</a></span>
                <?php else: ?>
                    <span style="float:left; width: 155px;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete from contacts" /><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=del&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
', 'Are you sure?');">Delete from contacts</a></span>
                <?php endif; ?>
                
                <?php if (2 == $this->_tpl_vars['UserInfo']['status']): ?>
                    <?php if (! $this->_tpl_vars['pl'][$this->_sections['i']['index']]['is_roster']): ?>
                        <span style="float:left"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
add2_ico.gif" alt="Add to Roster" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
roster.php?mod=add&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
">Add to roster</a></span>
                    <?php else: ?>
                        <span style="float:left"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
del3_ico.gif" alt="Delete from roster" /><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
roster.php?mod=del&amp;fid=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['uid']; ?>
', 'Are you sure?');">Delete from roster</a></span>
                    <?php endif; ?>   
                <?php endif; ?>
                </p>
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
			<td class="nav-viewbox">
							</td>
			<td class="nav-viewbox" align="right" style="font-size: 16px;"><?php echo $this->_tpl_vars['pagging']; ?>
</td>
		</tr>
	</table>
</div>