<?php /* Smarty version 2.6.11, created on 2010-06-03 15:17:54
         compiled from mods/member/gear/_gear_add.html */ ?>
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
						<td width="210"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/gear.gif" alt="Gear" /></p></td>
						<td></td>
					</tr>
				</table>	

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					
                    <?php if ($this->_tpl_vars['errs']): ?>
                    <p><font style="color:#990000">
                    <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <?php echo $this->_tpl_vars['i']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
                    </font></p>
                    <?php endif; ?>
					<form class="write-mail-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
" name="fmx" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="mod" value="add" />
                    <?php if ($this->_tpl_vars['id']): ?>
                    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <?php endif; ?>
                    
                    <p><label style="color:#333;"><?php if (! $this->_tpl_vars['id']): ?>Post new<?php else: ?>Edit<?php endif; ?> gear</label></p>
					<p><label>Title:</label> <input type="text" value="<?php echo $this->_tpl_vars['fm']['title']; ?>
" name="fm[title]" size="78" /></p>
                    <p><label>Category:</label> 
                    <select name="fm[cid]">
                        <option value="0">Please select</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['cats'][$this->_sections['i']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['cats'][$this->_sections['i']['index']]['id'] == $this->_tpl_vars['fm']['cid']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cats'][$this->_sections['i']['index']]['title']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select>
                    </p>

					<p><label>Picture:</label> <input type="file" name="fm[image]" /><?php if ($this->_tpl_vars['fi']['image']): ?><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fi']['image']; ?>
" alt="" /> <a href="javascript: void(0)" onclick="CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
/?mod=add&id=<?php echo $this->_tpl_vars['id']; ?>
&delimg=1', 'Do You want to delete this image?');">Delete image</a><?php endif; ?></p>

					<p>Description:</p>
					<p><textarea name="fm[story]" style="height: 200px;"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea></p>
					<p class="tools"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <a href="javascript:_v('fmx').submit();"><?php if ($this->_tpl_vars['id']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /><?php endif; ?></a></p>
					</form>
			
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