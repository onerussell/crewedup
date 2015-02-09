<?php /* Smarty version 2.6.11, created on 2010-11-01 14:59:58
         compiled from admin_auth.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin_auth.html', 2, false),)), $this); ?>
<html>
<head><title><?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - Back-Office - Authentication</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=<?php echo $this->_tpl_vars['charset']; ?>
" /> 
<link rel="SHORTCUT ICON" href="<?php echo $this->_tpl_vars['siteAdm']; ?>
favicon.ico" />
<style>
<!--
<?php echo '
html {
    height: 100%;
}

body {
  background-color:#ffffff;
  margin:0;
  padding:0;
  height:auto !important;
  height:100%;
  min-height:100%;
  font: 11px verdana; 
}

input {
    border: 1px solid black; font: 8pt verdana;
}
select {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
textarea {
    border-right: #006699 1px outset; border-top: #006699 1px outset; font: 8pt verdana; border-left: #006699 1px outset; border-bottom: #006699 1px outset
}
a {
    color: #4f76b3; text-decoration: none
}
a:hover {
    color: #4f76b3; text-decoration: none
}
a:active {
    color: #4f76b3; text-decoration: none
}
a:visited {
    color: #4f76b3; text-decoration: none
}
td {
    font: 11px verdana
}
'; ?>

// -->
</style>
</head>
<body>
<table style="height:100%; width:100%;" border="0" cellSpacing="0" cellPadding="0">
<tr><td align="center" vAlign="middle"><img src="../tmpl/images/logo.gif" border="0" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['supportSiteName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<br /><br />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="AuthForm">
<table cellSpacing="1" cellPadding="6" align="center" bgColor="#c0c0c0" border="0">
  <tr bgColor="#ffffff" align="right">
    <td width="100">Username:</td>
    <td align="left" width="150"><input maxLength="21" name="system_login" value="<?php echo $this->_tpl_vars['systemLogin']; ?>
" style="width:150px;" /></td></tr>
  <tr bgColor="#ffffff" align="right">
    <td>Password:</td>
    <td align="left"><input type="password" maxLength="21" name="system_pass" value="" style="width:150px;" /></td></tr>
  <tr bgColor="#ffffff">
    <td align="center" colSpan="2"><?php if ($this->_tpl_vars['authMessage']): ?>
<br /><font color="red">
<?php echo $this->_tpl_vars['authMessage']; ?>

<br /><br />
</font>
<?php endif; ?>
<br /><input type="submit" value=" login " /><br /><br /></td></tr></table></form>
<p>Copyright &#169; 2007-2009 <a href="http://engine37.com" target="_blank"><b>Engine37</b></a></p>
<br /><br /></td></tr></table>

<script type="text/javascript">
//<![CDATA[
    if (!document.AuthForm.elements['system_login'].value)
        document.AuthForm.elements['system_login'].focus();
    else
        document.AuthForm.elements['system_pass'].focus();
//]]>    
</script>
</body></html>