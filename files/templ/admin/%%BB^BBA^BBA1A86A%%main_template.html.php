<?php /* Smarty version 2.6.11, created on 2010-12-13 02:20:26
         compiled from main_template.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main_template.html', 4, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo $this->_config[0]['vars']['adminpanel']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" /> 

<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteAdmin']; ?>
templates/js/main.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteAdmin']; ?>
templates/js/base.js"></script>

<link type="text/css" href="<?php echo $this->_tpl_vars['siteAdmin']; ?>
templates/styles/main.css" rel="StyleSheet" />
</head>
<body class="bcl">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td bgcolor="#666666" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <td width="100%" bgcolor="#FFFFFF">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="PageHeaderCell">
                         <h1><font color="#FFFFFF">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo $this->_config[0]['vars']['adminpanel']; ?>
</font></h1>
                         &nbsp;<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
icon_user.gif" width="16" height="16" border="0" alt="Current user" style="vertical-align:middle" />&nbsp;<b><font color="#FFFFFF"><?php echo $this->_tpl_vars['system_login']; ?>
</font></b>&nbsp;&nbsp;|&nbsp;<img src="<?php echo $this->_tpl_vars['imgDir']; ?>
exit.gif" width="16" height="16" border="0" alt="Logout" style="vertical-align:middle" />&nbsp;<a href="logout.php"><font color="#FFFFFF">Logout</font></a>
                </td>
            </tr>
            <tr>
                <td class="PageHeaderCell" style="BACKGROUND-COLOR: gainsboro" noWrap>
                </td>       
            </tr>

            <tr>
                <td nowrap style="BACKGROUND-COLOR: white">
                 <table cellspacing="0" cellpadding="0" width="100%" border="0">

                 <tr>
                 <td height="400" valign="top" width="170"> 

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td rowspan="2" width="5"></td>
                            <td height="2"></td></tr>
                          <tr> 
                             <td valign="top" width="200" style="background-color:#f5f5f5;border :1px solid Silver; padding-left:5px;"> 
                            <br />
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gmodules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <?php if ($this->_tpl_vars['gmodules'][$this->_sections['i']['index']]['vals']): ?>
								<b><font color="#666666"><?php echo $this->_tpl_vars['gmodules'][$this->_sections['i']['index']]['name']; ?>
:</font></b><br /> 
                                <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['gmodules'][$this->_sections['i']['index']]['vals']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
                                     &#8226;&nbsp;<a href="<?php echo $this->_tpl_vars['gmodules'][$this->_sections['i']['index']]['vals'][$this->_sections['j']['index']]['fname']; ?>
.php"><?php echo $this->_tpl_vars['gmodules'][$this->_sections['i']['index']]['vals'][$this->_sections['j']['index']]['name']; ?>
</a><br /> 
                                <?php endfor; endif; ?>
                                 <br />
                                 
                                 
								<?php endif; ?>
                            <?php endfor; endif; ?>     
                        </td>
                        
                          </tr>
                        </table>
                    
                     </td>
                 <td width="15"></td>
                 <td valign="top"> 

                <?php echo $this->_tpl_vars['main_content']; ?>


                 </td>
                 </tr>
                 
             
                 </table>   
                 
                           <hr size="1" />
						   <div align="center" style="margin-bottom:4px">
						   
                            <span style="font-size: 8px;">
                            
                 [
                            
                            <?php 
                                global $beginScriptTime;
                                $scriptTime = round((get_mt_time()-$beginScriptTime)*1000)/1000;
                                echo $scriptTime.' sec</small>';
								global $gCnt;
                             ?>
                             ] 
                             
                             <?php if (1 == $this->_tpl_vars['GZ_COMPRESS']): ?>[ GZ-compress <font color="green"><b>enabled</b></font> ]<?php else: ?>[ GZ-compress <font color="red"><b>disabled</b></font> ]<?php endif; ?></span>
                            </div>
                </td>
            </tr>
        </table>

    </td>
</tr>
</table>

</body>
</html>