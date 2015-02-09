<?php /* Smarty version 2.6.11, created on 2010-05-24 23:01:00
         compiled from mods/member/resume/_box.html */ ?>
                       <?php if ($this->_tpl_vars['rl']): ?>
						<table class="credits-t">
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
                                <td class="first" valign="top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
" /><?php endif; ?></a></td>
								<td valign="top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><b><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
</b></a><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof']): ?><br /><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof'];  endif;  if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['year'] && '0000' != $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year']): ?><br /><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']):  $this->assign('ov', $this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']-1);  echo $this->_tpl_vars['ma'][$this->_tpl_vars['ov']]; ?>
 <?php endif;  echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year'];  endif; ?></td>
                                <td class="middle" valign="top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['company']; ?>
" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
" /><?php endif; ?></a></td>
								<td valign="top"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['company']; ?>
</a></td>                            
                            </tr>
                            <?php endfor; endif; ?>
						</table>
                        <?php else: ?>
                        <table class="credits-t">
                            <tr><td>No Resume</td></tr>
                        </table>
                        <?php endif; ?>