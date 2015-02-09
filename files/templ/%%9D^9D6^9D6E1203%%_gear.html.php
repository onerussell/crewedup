<?php /* Smarty version 2.6.11, created on 2010-05-24 13:47:51
         compiled from mods/member/gear/_gear.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'mods/member/gear/_gear.html', 20, false),array('modifier', 'truncate', 'mods/member/gear/_gear.html', 20, false),)), $this); ?>
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
						<td width="140"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/gear.gif" alt="" /></p></td>
						<td><?php if ($this->_tpl_vars['is_user']): ?><p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?mod=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Gear" />Post new gear</a></p><?php endif; ?></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					    <table class="gear-t">
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
                            <tr>
								<td class="first"><?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['title']; ?>
" /></a><?php else: ?>&nbsp;<?php endif; ?></td>
								<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['title']; ?>
</a> <?php if ($this->_tpl_vars['pl'][$this->_sections['i']['index']]['cid']):  $this->assign('ov', $this->_tpl_vars['pl'][$this->_sections['i']['index']]['cid']); ?>(<?php echo $this->_tpl_vars['catl'][$this->_tpl_vars['ov']]; ?>
)<?php endif; ?><br />
								<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['story'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>

								</td>
								<td class="end" style="width: 115px;"><?php if ($this->_tpl_vars['is_user']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
&amp;mod=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
pencil.gif" alt="Edit" /></a><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
&amp;mod=del"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><a href="<?php if ($this->_sections['i']['first']): ?>javascript: void(0);<?php else:  echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?mod=updsort&amp;id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
&amp;act=-1<?php if (1 < $this->_tpl_vars['page']): ?>&amp;page=<?php echo $this->_tpl_vars['page'];  endif;  endif; ?>"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_up<?php if ($this->_sections['i']['first']): ?>x<?php endif; ?>.gif" alt="Up" /></a><a href="<?php if ($this->_sections['i']['last']): ?>javascript: void(0);<?php else:  echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?mod=updsort&amp;id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
&amp;act=1<?php if (1 < $this->_tpl_vars['page']): ?>&amp;page=<?php echo $this->_tpl_vars['page'];  endif;  endif; ?>"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
arrow_down<?php if ($this->_sections['i']['last']): ?>x<?php endif; ?>.gif" alt="Down" /></a><?php endif; ?></td>
							</tr>
                            <?php endfor; else: ?>
                            <tr>
                                <td>Gears not found</td>
                            </tr>    
                            <?php endif; ?>
							
						</table>
						<div class="clear" style="height:5px;">&nbsp;</div>
                        <?php echo $this->_tpl_vars['pagging']; ?>

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