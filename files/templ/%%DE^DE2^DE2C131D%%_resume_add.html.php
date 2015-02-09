<?php /* Smarty version 2.6.11, created on 2010-06-02 12:05:39
         compiled from mods/member/resume/_resume_add.html */ ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.bgiframe.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.ajaxQueue.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
jquery.autocomplete.css" />

<script type="text/javascript">
// <![CDATA[
var icPath = '<?php echo $this->_tpl_vars['icPath']; ?>
';
<?php echo '
$().ready(function() {

	function formatItem(row) 
    {
		return row[1];
	}

    function formatResult(row) 
    {
		return row[1].replace(/(<.+?>)/gi, \'\');
	}

	$(\'#fm_title\').autocomplete(siteAdr + \'dict.php?action=get_movies\', 
    {
        delay:       200,
        cacheLength: 10,
        minChars:    3,
    	width: 270,
    	formatItem: formatItem,
    	formatResult: formatResult
	});
	
    $(\'#fm_company\').autocomplete(siteAdr + \'dict.php?action=get_companies\', 
    {
        delay:       200,
        cacheLength: 10,
        minChars:    3,
		width: 270,
		formatItem: formatItem,
    	formatResult: formatResult
	});

    $(\'#fm_prof\').autocomplete(siteAdr + \'dict.php?action=get_jobs\', 
    {
        delay:       200,
        cacheLength: 10,
        minChars:    3,
		width: 270,
		formatItem: formatItem,
    	formatResult: formatResult
	});

});

function get_logo(type, val)
{
    var img  = new Image();
    img.src  = imgDir + \'empty_big.gif\';

    var img2 = new Image();
    img2.src = imgDir + \'empty_big.gif\';

    var field = (1 == type ? \'image\' : \'image2\');

    if (2 < val.length && (1 == type ? \'Project Title\' : \'Production Company Name\') != val)
    {
        $.ajax({
    	    cache:    false,
        	mode:     \'abort\',
    		port:     field,
            dataType: \'json\',
    		url:  siteAdr + \'dict.php?action=get_\' + (1 == type ? \'movie\' : \'company\') + \'_logo&q=\' + encodeURIComponent(val),
    		success: function(data) 
            {
                if (data)
                {
                    if (data[0])
                    {
                       var img = new Image();
                       img.src = icPath + \'/\' + data[0];

                       _v(\'fi_\' + field + \'_\').innerHTML       = \'<img src="\' + icPath + \'/\' + data[0] + \'" alt="" />\';
                       _v(\'fm_\' + field).disabled              = true;
                       _v(\'fm_\' + field + \'_bl\').style.display = \'none\';
                    }
                    else
                    {
                       _v(\'fi_\' + field + \'_\').innerHTML       = \'<img src="\' + imgDir + \'empty_big.gif" alt="" />\';
                       _v(\'fm_\' + field).disabled              = false;
                       _v(\'fm_\' + field + \'_bl\').style.display = \'inline\';
                    }

                    if (data[1])
                    {
                       var img2 = new Image();
                       img2.src = icPath + \'/\' + data[1];

                       _v(\'fi_\' + field + \'2_\').innerHTML       = \'<img src="\' + icPath + \'/\' + data[1] + \'" alt="" />\';
                       _v(\'fm_\' + field + \'2\').disabled         = true;
                       _v(\'fm_\' + field + \'2_bl\').style.display = \'none\';
                    }
                    else
                    {
                       _v(\'fi_\' + field + \'2_\').innerHTML       = \'<img src="\' + imgDir + \'empty_big2.gif" alt="" />\';
                       _v(\'fm_\' + field + \'2\').disabled         = false;
                       _v(\'fm_\' + field + \'2_bl\').style.display = \'inline\';
                    }
                }
                else
                {
                   _v(\'fi_\' + field + \'_\').innerHTML        = \'<img src="\' + imgDir + \'empty_big.gif" alt="" />\';
                   _v(\'fm_\' + field).disabled               = false;
                   _v(\'fm_\' + field + \'_bl\').style.display  = \'inline\';

                   _v(\'fi_\' + field + \'2_\').innerHTML       = \'<img src="\' + imgDir + \'empty_big2.gif" alt="" />\';
                   _v(\'fm_\' + field + \'2\').disabled         = false;
                   _v(\'fm_\' + field + \'2_bl\').style.display = \'inline\';
                }
    		}
    	});
    }
    else
    {
        _v(\'fi_\' + field + \'_\').innerHTML       = \'<img src="\' + imgDir + \'empty_big.gif" alt="" />\';
        _v(\'fm_\' + field).disabled              = false;
        _v(\'fm_\' + field + \'_bl\').style.display = \'inline\';

        _v(\'fi_\' + field + \'2_\').innerHTML       = \'<img src="\' + imgDir + \'empty_big2.gif" alt="" />\';
        _v(\'fm_\' + field + \'2\').disabled         = false;
        _v(\'fm_\' + field + \'2_bl\').style.display = \'inline\';
    }
}

'; ?>

// ]]>
</script>

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
title/live_resume.gif" alt="Live Resume" /></p></td>
    					<td><?php if ($this->_tpl_vars['is_user'] && $this->_tpl_vars['id']): ?><p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=resume&amp;what=add&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Add" />Post a new entry</a></p><?php endif; ?></td>
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
profile.php" name="fmx" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="act" value="resume"   />
                    <input type="hidden" name="what" value="add"     />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
"   />
                    <?php if ($this->_tpl_vars['id']): ?>
                        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
                    <?php endif; ?>

                    <p><label style="color:#333;"><?php if (! $this->_tpl_vars['id']): ?>Post a new<?php else: ?>Edit<?php endif; ?> entry</label></p>
					<br />
                    <table style="width:99%;" border="0" >
                    <tr>
                        <td style="width:90px;" align="center" id="fi_image_">
                            <?php if ($this->_tpl_vars['fi']['image']): ?>
                                <img id="fi_image" src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fi']['image']; ?>
" alt="" />                            <?php else: ?>
                                <img id="fi_image" src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty_big.gif" alt="" />
                            <?php endif; ?>
                        </td>

                        <td>
                            <table cellSpacing="2" cellPadding="2" width="100%" border="0" >
                            <tr><td>
                            <input type    = "text" 
                                   class   = "input_srh"
                                   name    = "fm[title]" 
                                   style   = "width:244px;" 
                                   id      = "fm_title" 
                                   onblur  = "get_logo(1, this.value); if ('' == this.value) this.value = 'Project Title';" 
                                   onfocus = "if ('Project Title' == this.value) this.value = '';" 
                                   value   = "<?php if (! $this->_tpl_vars['fm']['title']): ?>Project Title<?php else:  echo $this->_tpl_vars['fm']['title'];  endif; ?>" />
                            </td></tr>
                            <tr><td>
                            
                           <select name="fm[dep_prof]" style="width:100px;" class="input_srh3">
                                <option value="">Department</option>
                                <?php $_from = $this->_tpl_vars['prof']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                           </select>
                           <input type     = "text" 
                                  name     = "fm[prof]"
                                  style    = "width:140px;"
                                  class    = "input_srh" 
                                  id       = "fm_prof" 
                                  onblur   = "if ('' == this.value) this.value = 'Job Title';" 
                                  onfocus  = "if ('Job Title' == this.value) this.value = '';" 
                                  value    = "<?php if (! $this->_tpl_vars['fm']['prof']): ?>Job Title<?php else:  echo $this->_tpl_vars['fm']['prof'];  endif; ?>" />
                            </td></tr>
                            <tr><td>
                           Start <select name="fm[month]" style="margin-left:38px;" class="input_srh3" >
                           <option value="0">Month</option>
                           <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ma']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                           <?php $this->assign('ov', $this->_sections['i']['index']+1); ?>
                           <option value="<?php echo $this->_tpl_vars['ov']; ?>
"<?php if ($this->_tpl_vars['ov'] == $this->_tpl_vars['fm']['month']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['ma'][$this->_sections['i']['index']]; ?>
</option>
                           <?php endfor; endif; ?>
                           </select>
                          
                           <input type="text" name="fm[year]" style="width: 80px;" class="input_srh3" value="<?php if (1000 < $this->_tpl_vars['fm']['year']):  echo $this->_tpl_vars['fm']['year'];  else: ?>Year<?php endif; ?>" onblur="if ('' == this.value) this.value='Year';" onfocus="if ('Year' == this.value) this.value = '';"  onkeypress="filter(event,1,'',1)" /> ex.: 2009

                                                      </select>
                            </td></tr>
                            <tr><td>

                           Finish <select name="fm[month_f]" style="margin-left:34px;" class="input_srh3" >
                           <option value="0">Month</option>
                           <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ma']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                           <?php $this->assign('ov', $this->_sections['i']['index']+1); ?>
                           <option value="<?php echo $this->_tpl_vars['ov']; ?>
"<?php if ($this->_tpl_vars['ov'] == $this->_tpl_vars['fm']['month_f'] || false && ( ! $this->_tpl_vars['fm']['month_f'] && 12 == $this->_tpl_vars['ov'] )): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['ma'][$this->_sections['i']['index']]; ?>
</option>
                           <?php endfor; endif; ?>
                           </select>
                           
                           <input type="text" name="fm[year_f]" style="width: 80px;" class="input_srh3" value="<?php if (1000 < $this->_tpl_vars['fm']['year_f']):  echo $this->_tpl_vars['fm']['year_f'];  else: ?>Year<?php endif; ?>" onblur="if ('' == this.value) this.value='Year';" onfocus="if ('Year' == this.value) this.value = '';" onkeypress="filter(event,1,'',1)" /> ex.: 2019

                                                       </td></tr>

                            <tr>
                                <td>
                                    <div id="fm_image_bl" <?php if ($this->_tpl_vars['fi']['image']): ?>style="display:none;"<?php endif; ?> >Project Logo <input id="fm_image" type="file" name="fm[image]" size="16" style="font-size:12px;" <?php if ($this->_tpl_vars['fi']['image']): ?>disabled="1"<?php endif; ?> /></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                   <select name="fm[prj_type]" class="input_srh3" style="width:115px;">
                                        <option value="0">Project Type</option>
                                        <?php unset($this->_sections['iip']);
$this->_sections['iip']['name'] = 'iip';
$this->_sections['iip']['loop'] = is_array($_loop=$this->_tpl_vars['prj_types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iip']['show'] = true;
$this->_sections['iip']['max'] = $this->_sections['iip']['loop'];
$this->_sections['iip']['step'] = 1;
$this->_sections['iip']['start'] = $this->_sections['iip']['step'] > 0 ? 0 : $this->_sections['iip']['loop']-1;
if ($this->_sections['iip']['show']) {
    $this->_sections['iip']['total'] = $this->_sections['iip']['loop'];
    if ($this->_sections['iip']['total'] == 0)
        $this->_sections['iip']['show'] = false;
} else
    $this->_sections['iip']['total'] = 0;
if ($this->_sections['iip']['show']):

            for ($this->_sections['iip']['index'] = $this->_sections['iip']['start'], $this->_sections['iip']['iteration'] = 1;
                 $this->_sections['iip']['iteration'] <= $this->_sections['iip']['total'];
                 $this->_sections['iip']['index'] += $this->_sections['iip']['step'], $this->_sections['iip']['iteration']++):
$this->_sections['iip']['rownum'] = $this->_sections['iip']['iteration'];
$this->_sections['iip']['index_prev'] = $this->_sections['iip']['index'] - $this->_sections['iip']['step'];
$this->_sections['iip']['index_next'] = $this->_sections['iip']['index'] + $this->_sections['iip']['step'];
$this->_sections['iip']['first']      = ($this->_sections['iip']['iteration'] == 1);
$this->_sections['iip']['last']       = ($this->_sections['iip']['iteration'] == $this->_sections['iip']['total']);
?>
                                            <option value="<?php echo $this->_tpl_vars['prj_types'][$this->_sections['iip']['index']]['id']; ?>
"<?php if ($this->_tpl_vars['prj_types'][$this->_sections['iip']['index']]['id'] == $this->_tpl_vars['fm']['prj_type']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['prj_types'][$this->_sections['iip']['index']]['title']; ?>
</option>
                                        <?php endfor; endif; ?>
                                   </select>
                                   <input type    = "text" 
                                          name    = "fm[prj_episode]"
                                          style   = "width:120px;"
                                          class   = "input_srh" 
                                          id      = "fm_episode" 
                                          onblur  = "if ('' == this.value) this.value = 'Project Episode';" 
                                          onfocus = "if ('Episode/Season' == this.value) this.value = '';" 
                                          value   = "<?php if (! $this->_tpl_vars['fm']['prj_episode']): ?>Episode/Season<?php else:  echo $this->_tpl_vars['fm']['prj_episode'];  endif; ?>" />
                                 </td>
                            </tr>

                            <tr>
                                <td>
                                   <select name="fm[empl_type]" class="input_srh3" style = "width:115px;">
                                        <option value="0">Employee Type</option>
                                        <option value="1"<?php if (1 == $this->_tpl_vars['fm']['empl_type']): ?> selected="1"<?php endif; ?>>full time</option>
                                        <option value="2"<?php if (2 == $this->_tpl_vars['fm']['empl_type']): ?> selected="1"<?php endif; ?>>freelance</option>
                                   </select>
                                 </td>
                            </tr>
                            
                            </table>    

                        </td>

                        <td>
                            <table cellSpacing="0" cellPadding="0" width="100%" >
                            <tr>
                                <td align="center" id="fi_image2_">
                                    <?php if ($this->_tpl_vars['fi']['image2']): ?>
                                        <img id="fi_image2" src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['fi']['image2']; ?>
" alt="" />                                    <?php else: ?>
                                        <img id="fi_image2" src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty_big.gif" alt="" />
                                    <?php endif; ?>
                                </td>
                                <td style="vertical-align:middle;">
                                    &nbsp;&nbsp;<input type     = "text" 
                                           class    = "input_srh"
                                           name     = "fm[company]" 
                                           style    = "width:170px !important;margin-left:5px;" 
                                           id       = "fm_company" 
                                           onblur   = "if ('' == this.value) this.value = 'Production Company Name';" 
                                           onfocus  = "if ('Production Company Name' == this.value) this.value = '';" 
                                           value    = "<?php if (! $this->_tpl_vars['fm']['company']): ?>Production Company Name<?php else:  echo $this->_tpl_vars['fm']['company'];  endif; ?>" />
                                </td>
                            <tr>
                                <td colSpan="2">
                                    <div id="fm_image2_bl" style="margin-top:4px;<?php if ($this->_tpl_vars['fi']['image2']): ?>display:none;<?php endif; ?>" >Network or Distributor Logo <br />
                                        <input id="fm_image2" type="file" name="fm[image2]" size="16" style="font-size:12px;" <?php if ($this->_tpl_vars['fi']['image2']): ?>disabled="1"<?php endif; ?> />
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            </table>
                            
                        </td>
                    </tr>
                    </table>    

    				<p class="tools"><?php if (! $this->_tpl_vars['id']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=resume&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a> <?php endif; ?><a href="javascript:_v('fmx').submit();"><?php if ($this->_tpl_vars['id']): ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /><?php endif; ?></a><?php if ($this->_tpl_vars['id']): ?> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume/?what=del&amp;id=<?php echo $this->_tpl_vars['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
remove_b.gif" alt="Remove" /></a><?php endif; ?></p>

					
                    <script type="text/javascript">
                    // <![CDATA[
                        get_logo(1, _v('fm_title').value);
                        // get_logo(2, _v('fm_company').value);
                    // ]]>
                    </script>
					</form>
			
				</div>
				
				<div class="grey-box-bottom">&nbsp;</div>
				
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/resume/_resume_base.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>				
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