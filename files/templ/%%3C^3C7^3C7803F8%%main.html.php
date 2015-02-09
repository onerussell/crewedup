<?php /* Smarty version 2.6.11, created on 2010-12-29 17:02:03
         compiled from main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'numprice', 'main.html', 51, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Crewed Up - A community for television and film professionals</title>
    <meta name="description" content="<?php if ($this->_tpl_vars['meta']['descr']):  echo $this->_tpl_vars['meta']['descr'];  else: ?>A community for television and film professionals<?php endif; ?>" />
    <meta name="keywords"    content="<?php if ($this->_tpl_vars['meta']['keyw']):  echo $this->_tpl_vars['meta']['keyw'];  else: ?>community,television,film professionals<?php endif; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
forms.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
curve.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
main.js"></script>



<script type="text/javascript">
// <![CDATA[
    var siteAdr = '<?php echo $this->_tpl_vars['siteAdr']; ?>
';
    var imgDir  = '<?php echo $this->_tpl_vars['imgDir']; ?>
';
// ]]>
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
base.js"></script>
<?php if ('profile' == $this->_tpl_vars['mwd']): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
block.js"></script>
<?php endif; ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
lightwindow.css" />
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
prototype.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
effects.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
lightwindow.js"></script>

	  
<?php if ('calendar' == $this->_tpl_vars['mwd']): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
calendar.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
JsHttpRequest.js"></script>

<!--[if gte IE 5.5000]>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
png.js"></script>
<![endif]-->
</head>
<body onload="<?php echo $this->_tpl_vars['onload']; ?>
">
<div class="main-cont">
<span id="search_res"><!-- --></span>

<!-- Header -->
<div id="header">
	<div class="logo"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
logo.gif" alt="CrewedUp.com" /></a></div>
	<div class="center">
		<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
rss.php?mod=users" target="_blank"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
rss_ico.gif" alt="Rss" /></a>
		<p>
			<span><?php echo ((is_array($_tmp=$this->_tpl_vars['online_users_cnt'])) ? $this->_run_mod_handler('numprice', true, $_tmp) : smarty_modifier_numprice($_tmp)); ?>
</span> People Online<br />
			<b><?php echo ((is_array($_tmp=$this->_tpl_vars['all_users_cnt'])) ? $this->_run_mod_handler('numprice', true, $_tmp) : smarty_modifier_numprice($_tmp)); ?>
</b> Registered Members<br />
			<b><?php echo ((is_array($_tmp=$this->_tpl_vars['new_users_cnt'])) ? $this->_run_mod_handler('numprice', true, $_tmp) : smarty_modifier_numprice($_tmp)); ?>
</b> New Members
		</p>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_top_login.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<!-- /Header -->
<!-- Menu -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_menu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- /Menu -->
<!-- Content -->
<?php echo $this->_tpl_vars['_content']; ?>

<!-- /Content -->
<!-- Footer -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- /Footer -->

</div>
</body>
</html>