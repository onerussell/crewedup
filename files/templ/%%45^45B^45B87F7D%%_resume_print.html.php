<?php /* Smarty version 2.6.11, created on 2010-05-24 13:49:51
         compiled from mods/member/resume/_resume_print.html */ ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box_print.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
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
                                <td class="first" style="background: none;"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
" /></a><?php endif; ?></td>
								<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><b><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['title']; ?>
</b></a><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof']): ?><br /><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['prof'];  endif;  if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['year'] && '0000' != $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year']): ?><br /><span><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']):  $this->assign('ov', $this->_tpl_vars['rl'][$this->_sections['i']['index']]['month']-1);  echo $this->_tpl_vars['ma'][$this->_tpl_vars['ov']]; ?>
 <?php endif;  echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['year']; ?>
</span><?php endif; ?></td>
                        
                                <td class="first" style="background: none;"><?php if ($this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['image2']; ?>
" alt="<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['company']; ?>
" /></a><?php endif; ?></td>
					            <td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?id=<?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['rl'][$this->_sections['i']['index']]['company']; ?>
</a></td>				
                            </tr>
                            <?php endfor; endif; ?>
				   </table>
				   
				   <div align="center">Live Resume courtesy of CrewedUp.com</div>      
			</td>
		</tr>
	</table>
</div>