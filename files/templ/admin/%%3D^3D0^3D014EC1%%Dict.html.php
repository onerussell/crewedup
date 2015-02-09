<?php /* Smarty version 2.6.11, created on 2010-12-10 11:23:35
         compiled from mods/Info/Dict.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_paginal_viewing', 'mods/Info/Dict.html', 133, false),)), $this); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2" height="3"><img height="3" border="0"></td>
    </tr>

    <tr>
                <td colspan="2" height="450" align="left" valign="top">
            <br />

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                    <h2><?php echo $this->_config[0]['vars']['spage']; ?>
</h2>
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
                         &gt; <a href="<?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['bc'][$this->_sections['i']['index']]['name']; ?>
</a>
                    <?php endfor; endif; ?>
                    <br />
                    <br />
                    <br />
                   <?php if ('change' == $this->_tpl_vars['action']): ?>
   
                   <?php if ('ok' == $_GET['result']): ?><font color="green"><b>Value successfully updated</b></font><br /><br /><?php endif; ?>

                   <b><?php echo $this->_config[0]['vars']['action']; ?>
: <?php if ($this->_tpl_vars['id'] == 0 || $this->_tpl_vars['id'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> <?php echo $this->_config[0]['vars']['spageo']; ?>
</b>

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
                      <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'checkbox'): ?>
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
                         <td><input type="submit" name="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" />&nbsp;&nbsp;or&nbsp;&nbsp;</td>
                         <td><input type="button" name="cancel" value="Return to elements list" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
';" /></td>
                     </tr>
                     </table>
                     </form>
					 <?php elseif ($this->_tpl_vars['action'] == 'edit'): ?>

                      <b><?php echo $this->_config[0]['vars']['action']; ?>
: <?php if ($this->_tpl_vars['cid'] == 0 || $this->_tpl_vars['cid'] == ''):  echo $this->_config[0]['vars']['add'];  else:  echo $this->_config[0]['vars']['edit'];  endif; ?> <?php echo $this->_config[0]['vars']['category']; ?>
</b>

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
                          <?php if ($this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'text' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'textarea' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'static' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'file' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'select' || $this->_tpl_vars['fdata']['elements'][$this->_sections['i']['index']]['type'] == 'checkbox'): ?>
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
                            <td><input type="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" />&nbsp;&nbsp;</td>
                            <td><input type="button" name="cancel" value="<?php echo $this->_config[0]['vars']['cancel']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
';" /></td>
                          </tr>
                      </table>
                      </form>
					  
                  <?php elseif ('new_elements_moderation' == $this->_tpl_vars['action']): ?>
                            <a href="dict.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
12_.gif" alt="" border="0" /></a> <a href="dict.php">Return</a><br /><br /> 
                            <form action="dict.php" method="post">
                            
                            <input type="hidden" name="action" value="change_elements_status" />
                            
                            <input type="submit" value="Apply changes" />&nbsp;&nbsp;<input type="reset" value="Reset" /><br /><br />

                            <table border="0" cellspacing="2" cellpadding="3" bgcolor="#FFFFFF">
                               <tr bgcolor="#DDDEDF" height="20" >
                                <td align="center" ><b>Dictionary</b></td>
                                <td align="center" ><b>New value</b></td>
                                <td align="center" ><b>Status</b></td>
                               </tr>

                               <?php unset($this->_sections['iic']);
$this->_sections['iic']['name'] = 'iic';
$this->_sections['iic']['loop'] = is_array($_loop=$this->_tpl_vars['NA']['rows']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iic']['show'] = true;
$this->_sections['iic']['max'] = $this->_sections['iic']['loop'];
$this->_sections['iic']['step'] = 1;
$this->_sections['iic']['start'] = $this->_sections['iic']['step'] > 0 ? 0 : $this->_sections['iic']['loop']-1;
if ($this->_sections['iic']['show']) {
    $this->_sections['iic']['total'] = $this->_sections['iic']['loop'];
    if ($this->_sections['iic']['total'] == 0)
        $this->_sections['iic']['show'] = false;
} else
    $this->_sections['iic']['total'] = 0;
if ($this->_sections['iic']['show']):

            for ($this->_sections['iic']['index'] = $this->_sections['iic']['start'], $this->_sections['iic']['iteration'] = 1;
                 $this->_sections['iic']['iteration'] <= $this->_sections['iic']['total'];
                 $this->_sections['iic']['index'] += $this->_sections['iic']['step'], $this->_sections['iic']['iteration']++):
$this->_sections['iic']['rownum'] = $this->_sections['iic']['iteration'];
$this->_sections['iic']['index_prev'] = $this->_sections['iic']['index'] - $this->_sections['iic']['step'];
$this->_sections['iic']['index_next'] = $this->_sections['iic']['index'] + $this->_sections['iic']['step'];
$this->_sections['iic']['first']      = ($this->_sections['iic']['iteration'] == 1);
$this->_sections['iic']['last']       = ($this->_sections['iic']['iteration'] == $this->_sections['iic']['total']);
?>
                               <tr bgcolor="<?php if ($this->_sections['iic']['rownum'] % 2): ?>#ECEEF1<?php else: ?>#FFFFFF<?php endif; ?>" align="center"  height="20">
                                <td><?php echo $this->_tpl_vars['NA']['rows'][$this->_sections['iic']['index']]['c_name']; ?>
</td>
                                <td><a href="dict.php?action=change&id=<?php echo $this->_tpl_vars['NA']['rows'][$this->_sections['iic']['index']]['id']; ?>
" target="_blank" ><?php echo $this->_tpl_vars['NA']['rows'][$this->_sections['iic']['index']]['name']; ?>
</a></td>
                                <td>
                                    <select name="status[<?php echo $this->_tpl_vars['NA']['rows'][$this->_sections['iic']['index']]['id']; ?>
]" >
                                        <option value="0"  class="md" >allow</option>
                                        <option value="-1" class="dl" >delete</option>
                                    </select>
                                </td>
                               </tr>
                               <?php endfor; endif; ?>
                            </table>

                            <input type="submit" value="Apply changes" />&nbsp;&nbsp;<input type="reset" value="Reset" /><br /><br />
                            </form>
                            <div align="left"><?php echo smarty_function_html_paginal_viewing(array('m_arr' => $this->_tpl_vars['NA']['gp'],'base_url' => "dict.php?action=new_elements_moderation"), $this);?>
</div>
                    <?php else: ?>

                    <form action="dict.php"><a href="dict.php?action=new_elements_moderation"><img border="0" src="<?php echo $this->_tpl_vars['imgDir']; ?>
12.gif" alt="" /> New elements moderation</a> | <input type="text" name="srh" value="<?php if ($this->_tpl_vars['srh']):  echo $this->_tpl_vars['srh'];  else: ?>Search<?php endif; ?>" onfocus="if ('Search' == this.value) this.value='';" onblur="if ('' == this.value) this.value='Search';" /></form><br /><br />

                                        <table width="100%"  border="0" cellspacing="1" cellpadding="0">
					
                    <?php if (! $this->_tpl_vars['srh']): ?>
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
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&action=delcat&cid=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a></td>
                    </tr>
					<tr>
				        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    <?php endfor; endif; ?>
					<?php endif; ?>

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
                        <td width="15" style="height: 17px;" class="tdx"><?php echo $this->_sections['i']['rownum']+$this->_tpl_vars['page']*100-100; ?>
&nbsp;</td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="26"><img src="includes/templates/images/preview.gif" border="0"></td>
                                    <?php if ($this->_tpl_vars['srh']): ?><td width="80"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['cid']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cat_name']; ?>
</a></td><?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['srh']): ?> &rarr; <?php endif; ?><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cid']; ?>
"><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['name']; ?>
</a></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                       <?php if ($this->_tpl_vars['list'][$this->_sections['i']['index']]['active'] == 0): ?>
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cid']; ?>
"><img src="includes/templates/images/status_green_l.gif " border="0" alt="<?php echo $this->_config[0]['vars']['mactive']; ?>
"></a>
                           &nbsp;<img src="includes/templates/images/status_red.gif" alt="<?php echo $this->_config[0]['vars']['nactive']; ?>
">
                       <?php else: ?>
                           <img src="includes/templates/images/status_green.gif " border="0" alt="<?php echo $this->_config[0]['vars']['active']; ?>
">&nbsp;
                           <a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=active&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cid']; ?>
"><img src="includes/templates/images/status_red_l.gif" border="0" alt="<?php echo $this->_config[0]['vars']['mnactive']; ?>
"></a>
                       <?php endif; ?>
                       </td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cid']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']; ?>
"><IMG src="includes/templates/images/b_edit.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['edit']; ?>
" /></a></td>
                       <td width="35"><a href="<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=delpage&id=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['id']; ?>
&ctg=<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]['cid']; ?>
&amp;page=<?php echo $this->_tpl_vars['page']; ?>
"><IMG src="includes/templates/images/b_drop.png" border="0" width="16" height="16" title="<?php echo $this->_config[0]['vars']['delete']; ?>
" /></a></td>
                    </tr>
					<tr>
				        <td colspan="6" height="1px" bgcolor="#CCCCCC"></td>
				    </tr>	
                    <?php endfor; endif; ?>
                    <tr><td colspan="6"><div style="height:3px; width: 100%;"><!-- --></div><?php echo $this->_tpl_vars['pagging']; ?>
</td></tr>
                   </table>
				      <?php if ($this->_tpl_vars['cinf']['parent'] <> ''): ?>
                      <br /> <br />
                      <input type="button" name="bup" value="<?php echo $this->_config[0]['vars']['ontop']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['cinf']['parent']; ?>
';" />
				      <?php endif; ?>     
				  <?php endif; ?>

        </td>
        
        <td width="4"><img width="4" height="0" alt="" src="<?php echo $this->_tpl_vars['imgDir']; ?>
s.gif" /></td>

                <td width="250" valign="top">

            <?php if ($this->_tpl_vars['action'] == 'delpage'): ?>
                <br /><br />
                                <b><?php echo $this->_config[0]['vars']['delpage']; ?>
</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" ?
                <br /><br />
                <input type="button" name="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?id=<?php echo $this->_tpl_vars['inf']['id']; ?>
&action=delpage&do=1&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
';" />
                                &nbsp;&nbsp;
                 <input type="button" name="cancel" value="<?php echo $this->_config[0]['vars']['cancel']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
';" />
            
			 <?php endif; ?>
             
            
			<?php if ($this->_tpl_vars['action'] == 'delcat'): ?>
                <br /><br />
                               <b><?php echo $this->_config[0]['vars']['delcat']; ?>
</b> "<?php echo $this->_tpl_vars['inf']['name']; ?>
" <?php echo $this->_config[0]['vars']['delwith']; ?>
?
                <br /><br />
               <input type="button" name="submit" value="<?php echo $this->_config[0]['vars']['submit']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&cid=<?php echo $this->_tpl_vars['inf']['cid']; ?>
&action=delcat&do=1';" />
                &nbsp;&nbsp;<input type="button" name="cancel" value="<?php echo $this->_config[0]['vars']['cancel']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
';" />
			<?php endif; ?>
			<?php if ($this->_tpl_vars['action'] == ''): ?>
			<?php if ($this->_tpl_vars['ctg'] > 0): ?>
            <input type="button" name="addcat" value="<?php echo $this->_config[0]['vars']['add']; ?>
 <?php echo $this->_config[0]['vars']['spageo']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=change&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
';" />
			<?php endif; ?>

			<br /><br />
			    <?php if (( $this->_tpl_vars['ctg'] == 0 )): ?>
                 <input type="button" name="addcat" value="<?php echo $this->_config[0]['vars']['add']; ?>
 <?php echo $this->_config[0]['vars']['category']; ?>
" onClick="document.location='<?php echo $this->_tpl_vars['curScriptName']; ?>
?action=edit&ctg=<?php echo $this->_tpl_vars['ctg']; ?>
';" />
			    <?php endif; ?>

           <?php endif; ?>
        </td>
    </tr>
</table>
    </tr>
</table>