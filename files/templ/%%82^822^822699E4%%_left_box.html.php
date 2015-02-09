<?php /* Smarty version 2.6.11, created on 2010-05-02 20:49:43
         compiled from mods/member/_left_box.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/_left_box.html', 15, false),)), $this); ?>
                <!-- Contact Box -->
				<?php if ('friend' != $this->_tpl_vars['mod']): ?>
                <p class="right-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
contact_ico.gif" alt="Contacts" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend<?php echo $this->_tpl_vars['uid']; ?>
">Contacts</a></p>
				<?php if ($this->_tpl_vars['lfriends']): ?>
                <p>Latest adds:</p>
				<table class="contact-t">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lfriends']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td class="av1" style="width:10%;">
						<?php if ($this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['image']): ?>
                        <div class="container02">
						    <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
							<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['subdir']; ?>
s_<?php echo $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php if (2 == $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?>" /></a></div>
							<div class="bl"><div class="blc"></div><div class="brc"></div></div>
					    </div>
                        <?php else: ?>
                         <div class="container02">
                             <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="<?php if (2 == $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?>" /></a>
                         </div>
                        <?php endif; ?>
						</td>
						<td class="av2"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (2 == $this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['lfriends'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a></td>
                <?php if ($this->_sections['i']['index_next'] % 2 == 0): ?>
					</tr>
                <?php endif; ?>
                <?php endfor; endif; ?>
				</table>
                <?php else: ?>
                    Contacts not found<br /><br />
                <?php endif; ?>
                <?php endif; ?>
                
                <?php if ('blog' != $this->_tpl_vars['act']): ?> 
				<!-- Blog Box -->
				<p class="right-title2">
				<?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?> 
				    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
toby_ico.gif" alt="Blog" style="float:left;margin-top:-10px" /><?php echo $this->_tpl_vars['ui']['name']; ?>
 <?php echo $this->_tpl_vars['ui']['lname']; ?>
 <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['ui']['uid']; ?>
">Blog</a> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['ui']['uid']; ?>
?what=rss" target="_blank"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
rss2_ico.gif" alt="Rss" /></a>
				<?php else: ?>
				    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
toby_ico.gif" alt="Blog" style="float:left;margin-top:-10px" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['ui']['uid']; ?>
">Blog</a>
				<?php endif; ?>
				</p>
				<?php if ($this->_tpl_vars['lblog']): ?>
                <p>Latest adds:</p>
                <?php endif; ?>
				<div class="blog-box">
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lblog']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php/?id=<?php echo $this->_tpl_vars['lblog'][$this->_sections['i']['index']]['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lblog'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 40) : smarty_modifier_wordwrap($_tmp, 40)); ?>
</a><br />
					<span><?php echo $this->_tpl_vars['lblog'][$this->_sections['i']['index']]['pdate']; ?>
&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['lblog'][$this->_sections['i']['index']]['ptime']; ?>
<br /><?php echo $this->_tpl_vars['lblog'][$this->_sections['i']['index']]['com_cnt']; ?>
 comment<?php if ($this->_tpl_vars['lblog'][$this->_sections['i']['index']]['com_cnt']): ?>s<?php endif; ?></span></p>
                    <?php endfor; endif; ?>
                    
                    <?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?>    
                    <p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?uid=<?php echo $this->_tpl_vars['ui']['uid']; ?>
&amp;what=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Plus" />Post a new entry</a></p>
				    <?php endif; ?>
                </div>
                
                <?php if (! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public']): ?>    
                <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['ui']['uid']; ?>
?what=rss" target="_blank">Subscribe to the blog</a><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico002.gif" alt="Subscribe to the blog" /></p>
				<p>
				  <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog<?php echo $this->_tpl_vars['ui']['uid']; ?>
">Read other blog entries</a><img style="margin-bottom:-5px" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico000.gif" alt="Read other blog entries" />
				  <a href="#">All blogs</a><img style="margin-bottom:-5px" src="<?php echo $this->_tpl_vars['imgDir']; ?>
ico000_.gif" alt="#" />
				</p><br /><br />
                <?php endif; ?>
                <?php endif; ?>
                
                
				<!-- Gear Box -->
				<?php if ('gear' != $this->_tpl_vars['mod'] && 'gear' != $this->_tpl_vars['mwd']): ?>
				<p class="right-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_ico.gif" alt="Gear" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['ui']['uid']; ?>
">Gear</a></p>

				<ul class="gear-list">
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['lgear']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?id=<?php echo $this->_tpl_vars['lgear'][$this->_sections['i']['index']]['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lgear'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 40) : smarty_modifier_wordwrap($_tmp, 40)); ?>
</a></li>
					<?php endfor; endif; ?>
				</ul>
				<?php if ($this->_tpl_vars['lgear_cnt'] > 1): ?>
				<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/">more...</a><br /><br />
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['is_user'] && ! $this->_tpl_vars['is_public']): ?>
                <p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['ui']['uid']; ?>
/?mod=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Plus" />Post new gear</a></p>
                <?php endif; ?> 
                <?php endif; ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_banner01.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>