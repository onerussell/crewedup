<?php /* Smarty version 2.6.11, created on 2010-11-01 23:02:37
         compiled from mods/Info/Spages.html */ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2" height="3"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
s.gif" height="3" width="1" alt="" border="0" /></td>
    </tr>

    <tr>
                <td colspan="2" height="450" align="left" valign="top">
            <br />

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                    <h2><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu/staticpage.gif" border="0" height="16" alt="<?php echo $this->_config[0]['vars']['spage']; ?>
" />&nbsp;<?php echo $this->_config[0]['vars']['spage'];  if ($this->_tpl_vars['action'] == 'change'): ?> | <?php if ($this->_tpl_vars['id'] == 0 || $this->_tpl_vars['id'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> <?php echo $this->_config[0]['vars']['spageo'];  elseif ($this->_tpl_vars['action'] == 'edit'): ?> | <?php if ($this->_tpl_vars['cid'] == 0 || $this->_tpl_vars['cid'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> <?php echo $this->_config[0]['vars']['category'];  endif; ?></h2>

                    <?php if ($this->_tpl_vars['bc'] || $this->_tpl_vars['cid'] || $this->_tpl_vars['id']): ?>
                    <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
"><?php echo $this->_config[0]['vars']['spage']; ?>
</a>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['bc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                         <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
path.gif" border="0" width="5" height="9" alt="" />
                         <?php if (! $this->_sections['i']['last'] || $this->_tpl_vars['ctg'] != $this->_tpl_vars['bc'][$this->_sections['i']['index']]['cid'] || 'edit' == $this->_tpl_vars['action'] || 'change' == $this->_tpl_vars['action']): ?>
                           <a href="<?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['name']; ?>
</a>
                         <?php else: ?>
                           <b><?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['name']; ?>
</b>
                         <?php endif; ?>
                    <?php endfor; endif; ?>
                    <?php if (( $this->_tpl_vars['cid'] || $this->_tpl_vars['id'] ) && ( 'edit' == $this->_tpl_vars['action'] || 'change' == $this->_tpl_vars['action'] )): ?>
                    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
path.gif" border="0" width="5" height="9" alt="" />&nbsp;<b><?php echo $this->_tpl_vars['editArr']['name']; ?>
</b>
                    <?php endif; ?>
                    <?php endif; ?>
                    <br />
                    <br />
                   <?php if ($this->_tpl_vars['action'] == 'change'): ?>
   
                   <?php if ($this->_tpl_vars['fdata']['javascript']): ?>
                       <?php echo $this->_tpl_vars['fdata']['javascript']; ?>

                   <?php endif; ?>

                      <form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
                      <?php if ($this->_tpl_vars['fdata']['errors']): ?>
                        <?php $_from = $this->_tpl_vars['fdata']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['err']):
?>
                           <p style="color:red"><?php echo $this->_tpl_vars['err']; ?>
</p>
                        <?php endforeach; endif; unset($_from); ?>
                      <?php endif; ?>
                       <table>
                       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select'): ?>
                       <tr>
                           <td><b><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label']; ?>
</b></td>
                       </tr>
                       <tr>
                           <td><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>
</td>
                       </tr>
                      <?php elseif ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'hidden'): ?>
                         <?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>

                      <?php endif; ?>
                      <?php endfor; endif; ?>
                      </table>

                     <table width="200" border="0" cellpadding="0" cellspacing="0">
                     <tr valign="top">
                         <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                         <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a></td>
                     </tr>
                     </table>
                     </form>
					 <?php elseif ($this->_tpl_vars['action'] == 'edit'): ?>

                      <?php if ($this->_tpl_vars['fdata']['javascript']): ?>
                          <?php echo $this->_tpl_vars['fdata']['javascript']; ?>

                      <?php endif; ?>

                      <form <?php echo $this->_tpl_vars['fdata']['attributes']; ?>
>
                      <?php if ($this->_tpl_vars['fdata']['errors']): ?>
                         <?php $_from = $this->_tpl_vars['fdata']['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['err']):
?>
                         <p style="color:red"><?php echo $this->_tpl_vars['err']; ?>
</p>
                         <?php endforeach; endif; unset($_from); ?>
                      <?php endif; ?>
                      <table>
                      <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fdata']['elements']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                          <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select'): ?>
                          <tr>
                              <td><b><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['label']; ?>
</b></td>
                          </tr>
                          <tr>
                              <td><?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>
</td>
                          </tr>
                          <?php elseif ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'hidden'): ?>
                             <?php echo $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['html']; ?>

                          <?php endif; ?>
                      <?php endfor; endif; ?>
                      </table>

                      <table width="200" border="0" cellpadding="0" cellspacing="0">
                          <tr valign="top">
                            <td><A href="#" onClick="document.eform.submit();return false;"><IMG src="includes/templates/images/b_submit.gif" border="0" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" width="100" height="18" /></A>&nbsp;&nbsp;</td>
                            <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a></td>
                          </tr>
                      </table>
                      </form>
					  
                    <?php else: ?>

                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
					
                                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <td width="15"><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['sortid']; ?>
&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/folder.gif" border="0"></td>
                                    <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['name']; ?>
</a></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                       <?php if ($this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 100 && $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 101 && $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 9): ?>
                       <?php if ($this->_tpl_vars['category'][$this->_sections['i']['index']]['active'] == 0): ?>
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&action=cactive&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><img src="includes/templates/images/status_green_l.gif " border="0" alt="<?php echo $this->_config[0]['vars']['mactive']; ?>
"></a>
                           &nbsp;<img src="includes/templates/images/status_red.gif" alt="<?php echo $this->_config[0]['vars']['nactive']; ?>
">
                       <?php else: ?>
                           <img src="includes/templates/images/status_green.gif " border="0" alt="<?php echo $this->_config[0]['vars']['active']; ?>
">&nbsp;
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&action=cactive&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><img src="includes/templates/images/status_red_l.gif" border="0" alt="<?php echo $this->_config[0]['vars']['mnactive']; ?>
"></a>
                       <?php endif; ?>
                       <?php else: ?>&nbsp;<?php endif; ?>
                       </td>

                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><IMG src="includes/templates/images/b_browse.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['enter']; ?>
" /></a></td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&action=edit&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['edit']; ?>
" /></a></td>
                       <td width="35"><?php if ($this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 100 && $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 101 && $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid'] != 9): ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&action=delcat&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a><?php else: ?>&nbsp;<?php endif; ?></td>
                    </tr>
					<tr>
				        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    <?php endfor; endif; ?>
					
                                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <td width="15"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['sortid']; ?>
&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                    <td><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
 [<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['pagename']; ?>
]</a></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                       <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['active'] == 0): ?>
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/status_green_l.gif " border="0" alt="<?php echo $this->_config[0]['vars']['mactive']; ?>
"></a>
                           &nbsp;<img src="includes/templates/images/status_red.gif" alt="<?php echo $this->_config[0]['vars']['nactive']; ?>
">
                       <?php else: ?>
                           <img src="includes/templates/images/status_green.gif " border="0" alt="<?php echo $this->_config[0]['vars']['active']; ?>
">&nbsp;
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/status_red_l.gif" border="0" alt="<?php echo $this->_config[0]['vars']['mnactive']; ?>
"></a>
                       <?php endif; ?>
                       </td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['edit']; ?>
" /></a></td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=delpage&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a></td>
                    </tr>
					<tr>
				        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    <?php endfor; endif; ?>
                   </table>
				      <?php if ($this->_tpl_vars['cinf']['parent'] <> ''): ?>
                      <br /> <br />
				      <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['cinf']['parent']; ?>
"><img src="includes/templates/images/b_up.gif" border="0" /></a>
				      <?php endif; ?>     
				  <?php endif; ?>

        </td>
        
        <td width="4"><img width="4" height="0"></td>

                <td width="250" valign="top">

            <?php if ($this->_tpl_vars['action'] == 'delpage'): ?>
                <br /><br />
                                <b><?php echo $this->_config[0]['vars']['delpage']; ?>
</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" ?
                <br /><br />
                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?id=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=delpage&do=1&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_submit.gif" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a>
            
			 <?php endif; ?>
             
            
			<?php if ($this->_tpl_vars['action'] == 'delcat'): ?>
                <br /><br />
                               <b><?php echo $this->_config[0]['vars']['delcat']; ?>
</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" <?php echo $this->_config[0]['vars']['delwith']; ?>
?
                <br /><br />
                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&cid=<?php echo $this->_tpl_vars['inf']['cid']; ?>
&action=delcat&do=1"><img src="includes/templates/images/b_submit.gif" alt="<?php echo $this->_config[0]['vars']['submit']; ?>
" border="0"></a>
                                <img width="10" height="0" border="0">
                                <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_cancel.gif" border="0" alt="<?php echo $this->_config[0]['vars']['cancel']; ?>
"></a>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['action'] == ''): ?>
            <a href= "<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_addpage.gif" border="0" /></a>
			<br /><br />
			    
				
			     <a href= "<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=edit&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
"><img src="includes/templates/images/b_addcat.gif" border="0" /></a>
			    
			<?php endif; ?>
        </td>
    </tr>
</table>
    </td>
    </tr>   

</table>