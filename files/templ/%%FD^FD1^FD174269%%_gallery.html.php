<?php /* Smarty version 2.6.11, created on 2010-05-24 23:42:12
         compiled from mods/employer/gallery/_gallery.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/employer/gallery/_gallery.html', 21, false),)), $this); ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
				<table>
					<tr>
						<td width="130"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/photos.gif" alt="Photos" /></p></td>
						<td><?php if ($this->_tpl_vars['is_user']): ?><p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?what=add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Add" />Upload new photo</a></p><?php endif; ?></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<table class="photos-t">
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
                        <?php if ($this->_sections['i']['index'] % 3 == 0): ?>
                        <tr>
                        <?php endif; ?>
							<td><a href="<?php echo $this->_tpl_vars['iPath'];  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['image']; ?>
" class="lightwindow page-options" rel="Photos[gallery]" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" caption="<?php echo ((is_array($_tmp=$this->_tpl_vars['pl'][$this->_sections['i']['index']]['story'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" author="" caption=""><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['title']; ?>
" /></a>
							<p><b><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['title']; ?>
</b></p>
							<p><?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['story']; ?>
<br />
							<span>Uploaded on <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['pdate']; ?>
 <?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['ptime']; ?>
</span>
                            <?php if ($this->_tpl_vars['is_user']): ?><br /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?what=add&amp;id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
">Edit</a> | <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gallery.php?what=del&amp;id=<?php echo $this->_tpl_vars['pl'][$this->_sections['i']['index']]['id']; ?>
">Delete</a><?php endif; ?>
							</p>
							</td>
						<?php if ($this->_sections['i']['index_next'] % 3 == 0 || $this->_sections['i']['last']): ?>	
						</tr>
                        <?php endif; ?>
                        <?php endfor; else: ?>
                        <tr><td><p>Images not found</p></td></tr> 
                        <?php endif; ?>	
					</table>				
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
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>