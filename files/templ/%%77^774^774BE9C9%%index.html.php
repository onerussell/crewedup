<?php /* Smarty version 2.6.11, created on 2011-01-11 09:55:16
         compiled from index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'numprice', 'index.html', 32, false),array('modifier', 'wordwrap', 'index.html', 67, false),array('modifier', 'ucfirst', 'index.html', 68, false),array('modifier', 'strip_tags', 'index.html', 128, false),array('modifier', 'truncate', 'index.html', 128, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Crewed Up - A community for television and film professionals</title>
    <meta name="verify-v1" content="RNuYMKNYRshm5tSEFE7NKKTDf/A+WoDLUb4goeGpDmk=" />
    <meta name="description" content="<?php if ($this->_tpl_vars['meta']['descr']):  echo $this->_tpl_vars['meta']['descr'];  else: ?>A community for television and film professionals<?php endif; ?>" />
    <meta name="keywords"    content="<?php if ($this->_tpl_vars['meta']['keyw']):  echo $this->_tpl_vars['meta']['keyw'];  else: ?>community,television,film professionals<?php endif; ?>" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
styles.css?2.0" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
forms.css?2.0" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['stlDir']; ?>
curve.css?2.0" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
    var siteAdr = '<?php echo $this->_tpl_vars['siteAdr']; ?>
';
</script>
<script type="text/javascript"
src="http://www.indeed.com/ads/apiresults.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
JsHttpRequest.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
base.js"></script>
<!--[if gte IE 5.5000]>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
png.js"></script>
<![endif]-->
</head>
<body>
<div class="main-cont">
<span id="search_res"><!-- --></span>
<!-- Header -->
<div id="header">
	<div class="logo-main"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
logo_main.gif" alt="CrewedUp.com" /></div>
	<div class="center-main">
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
<div id="header-main">
	<div class="left"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
header_left.jpg" alt="" /></div>
	<div class="right">
		<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
welcome.gif" alt="Welcome to CrewedUp" /></p>
		<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
slogan.gif" alt="A community for television &amp; film professional" /></p>
		<p style="margin-left:10px"><?php if (! $this->_tpl_vars['system_login']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=reg"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
register_now_b.png" alt="Register Now" /></a><?php endif; ?></p>
	</div>
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
<div class="content">
	<table id="main-table">
		<tr>
			<td class="main">
			<div id="new-members-box">
				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/new_members.gif" alt="" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
see_more_b.gif" alt="See More" /></a>
</p>
				<!-- -->
				<?php $_from = $this->_tpl_vars['lu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
                <div class="info-box01">
					<div class="container03">
						<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
						<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo2.gif<?php endif; ?>" alt="Photo" width="79px" /></a></div>
						<div class="bl"><div class="blc"></div><div class="brc"></div></div>
					</div>
                    <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></p> 
					<p><b><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['person_title'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</b><?php if ($this->_tpl_vars['i']['dt']): ?> <span>Member Since <?php echo $this->_tpl_vars['i']['dt']; ?>
</span><?php endif; ?></p>
					<p><?php echo $this->_tpl_vars['i']['title']; ?>
</p>
				</div>
				<!-- -->
                <?php if (! ($this->_foreach['n']['iteration'] == $this->_foreach['n']['total'])): ?>
				<div class="sep">&nbsp;</div>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
				
			<div class="clear">&nbsp;</div>	
			</div>	
			</td>
			<td class="main">
			<div id="newest-jobs-box">	
				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/newest_jobs.gif" alt="Newest Jobs" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
see_all_jobs_b.gif" alt="All Jobs" /></a></p>
				<!-- -->
				<?php $_from = $this->_tpl_vars['jl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <div class="info-box02">
					<p><a href="http://www.indeed.com/rc/clk?jk=<?php echo $this->_tpl_vars['i']['jobkey']; ?>
" target="_blank" onmousedown="<?php echo $this->_tpl_vars['i']['onclk']; ?>
"><?php echo $this->_tpl_vars['i']['jobtitle']; ?>
</a></p> 
					<p><?php echo $this->_tpl_vars['i']['jobtitle']; ?>
</p>
					<p><?php if ($this->_tpl_vars['i']['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['icPath']; ?>
/s_<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo2.gif<?php endif; ?>" alt="Photo" height="20px;" /></a><?php endif; ?>
					    <span><?php echo $this->_tpl_vars['i']['date']; ?>
</span><span>|</span><span><font style="font-color: green;"><?php echo $this->_tpl_vars['i']['company']; ?>
</font></span>
					</p>
				</div>
                <?php endforeach; endif; unset($_from); ?>
				
			</div>	
			</td>
			<td rowspan="3" class="right">
				<div class="what-news">
					<p style="font-size: 10px; width: 130px;">
					<?php echo $this->_tpl_vars['homepage']['pagetext']; ?>

					</p>
				</div>
                
				<div class="tags">
					<?php $_from = $this->_tpl_vars['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <a class="f<?php echo $this->_tpl_vars['i']; ?>
" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?tag=<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
</a>  
					<?php endforeach; endif; unset($_from); ?>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="empty"><div class="sep">&nbsp;</div></td>
		</tr>
		<tr>
			<td>
			<?php if ($this->_tpl_vars['fl']): ?>
            <div id="featured-members-box">
				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/featured_members.gif" alt="Featured members" /></p>
				<!-- -->
				<?php $_from = $this->_tpl_vars['fl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?> 
                <div class="info-box01">
					<div class="container03">
						<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
						<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['i']['image']):  echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['i']['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
no_photo2.gif<?php endif; ?>" alt="Photo" width="79px" /></a></div>
						<div class="bl"><div class="blc"></div><div class="brc"></div></div>
					</div>					
					<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></p> 
					<p><b><?php echo $this->_tpl_vars['i']['person_title']; ?>
</b><?php if ($this->_tpl_vars['i']['dt']): ?> <span>Member Since <?php echo $this->_tpl_vars['i']['dt']; ?>
</span><?php endif; ?></p>
					<p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...") : smarty_modifier_truncate($_tmp, 80, "...")); ?>
</p>
				</div>
				<!-- -->
				<div class="sep">&nbsp;</div>
				<!-- -->
                <?php endforeach; endif; unset($_from); ?>
			<div class="clear">&nbsp;</div>	
			</div>
            <?php endif; ?>	
			</td>
			<td>
			<div id="recent-blog-entries-box" style="width:380px;">	
				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/recent_blog_entries.gif" alt="Recent Blog Entries" /></p>
				<!-- -->
				<?php $_from = $this->_tpl_vars['blogs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                <div class="info-box03">
					<p><a class="f15" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
blog.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['title'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...") : smarty_modifier_truncate($_tmp, 80, "...")); ?>
</a></p> 
					<p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['i']['story'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
</p>
					
                        <div class="container01" style="float:left">
							<?php if ($this->_tpl_vars['i']['image']): ?>
                            <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
							<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['i']['subdir']; ?>
s_<?php echo $this->_tpl_vars['i']['image']; ?>
" alt="<?php echo $this->_tpl_vars['i']['fname']; ?>
" /></a></div>
							<div class="bl"><div class="blc"></div><div class="brc"></div></div>
                            <?php else: ?>
                            <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="<?php echo $this->_tpl_vars['i']['fname']; ?>
" /></a>
                            <?php endif; ?>
						</div>
                                   
						<span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['i']['status']):  echo ((is_array($_tmp=$this->_tpl_vars['i']['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['i']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['i']['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><br /><?php if ($this->_tpl_vars['i']['com_cnt']):  echo $this->_tpl_vars['i']['com_cnt']; ?>
 comment<?php if ($this->_tpl_vars['i']['com_cnt']): ?>s<?php endif;  else: ?>No comments<?php endif; ?></span><span>|</span><span><?php echo $this->_tpl_vars['i']['pdate']; ?>
</span><span>|</span><span><?php echo $this->_tpl_vars['i']['ptime']; ?>
</span>
				
				</div>
                <?php endforeach; endif; unset($_from); ?>
				
				<!-- -->
			<div class="clear">&nbsp;</div>	
			</div>	
			</td>
		</tr>
	</table>
</div>
<!-- /Content -->
<!-- Footer -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- /Footer -->
</div>
<?php echo '
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7452243-1");
pageTracker._trackPageview();
} catch(err) {}
</script>
'; ?>

</body>
</html>