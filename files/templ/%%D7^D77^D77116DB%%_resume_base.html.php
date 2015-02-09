<?php /* Smarty version 2.6.11, created on 2010-05-27 09:31:20
         compiled from mods/employer/resume/_resume_base.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/employer/resume/_resume_base.html', 6, false),array('modifier', 'wordwrap', 'mods/employer/resume/_resume_base.html', 10, false),)), $this); ?>
    			<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<table class="gear-t">
							<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['rl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <td class="first"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&sstr=<?php echo ((is_array($_tmp=$this->_tpl_vars['rl'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
" /></a><?php endif; ?></td>
     							<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&sstr=<?php echo ((is_array($_tmp=$this->_tpl_vars['rl'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><b><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
</b></a><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof']): ?><br /><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof'];  endif;  if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['year'] && '0000' != $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year']): ?><br /><span><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']):  $this->assign('ov', $this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']-1);  echo $this->_tpl_vars['ma'][$this->_tpl_vars['ov']]; ?>
 <?php endif;  echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year']; ?>
</span><?php endif; ?></td>
                        
                                <td class="first"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&sstr=<?php echo ((is_array($_tmp=$this->_tpl_vars['rl'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['company']; ?>
" /></a><?php endif; ?></td>
					            <td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&sstr=<?php echo ((is_array($_tmp=$this->_tpl_vars['rl'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['rl'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></td>
					
                    			<?php if ($this->_tpl_vars['is_user']): ?><td class="end"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?what=add&amp;id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
pencil.gif" alt="Edit" /></a></td><?php endif; ?>
                            </tr>
                            <?php endfor; endif; ?>
						</table>
						
					</div>
				<div class="grey-box-bottom">&nbsp;</div>
				
				<table>
					<tr>
						<td width="300"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/affilations.gif" alt="" /></p></td>
						<td><p class="gear-add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=resume&amp;what=addaward&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Post new affilations/award</a></p></td>
					</tr>
				</table>
				
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<?php if ($this->_tpl_vars['is_user']): ?>
                    <p>
                    <?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (! ($this->_foreach['n']['iteration'] <= 1)): ?>, <?php endif; ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?what=addaward&amp;id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><?php endforeach; endif; unset($_from); ?>
                                        </p>
                    <?php else: ?>
                    <p><?php $_from = $this->_tpl_vars['al']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
 if (! ($this->_foreach['n']['iteration'] <= 1)): ?>, <?php endif; ?><a href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><?php endforeach; endif; unset($_from); ?></p>	
                    <?php endif; ?>						                    
				</div>
				<div class="grey-box-bottom">&nbsp;</div>