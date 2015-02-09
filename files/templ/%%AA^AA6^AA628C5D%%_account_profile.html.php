<?php /* Smarty version 2.6.11, created on 2010-12-11 23:01:30
         compiled from mods/member/_account_profile.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mods/member/_account_profile.html', 90, false),)), $this); ?>
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
<?php echo '
// <![CDATA[
$().ready(function() {

	function formatItem(row) 
    {
		return row[1];
	}

    function formatResult(row) 
    {
		return row[1].replace(/(<.+?>)/gi, \'\');
	}

    $("#fm_prof1").autocomplete(siteAdr + \'dict.php?action=get_jobs\', 
    {
		width: 270,
		formatItem: formatItem,
    	formatResult: formatResult
	});
    $("#fm_prof2").autocomplete(siteAdr + \'dict.php?action=get_jobs\', 
    {
		width: 270,
		formatItem: formatItem,
    	formatResult: formatResult
	});
    $("#fm_prof3").autocomplete(siteAdr + \'dict.php?action=get_jobs\', 
    {
		width: 270,
		formatItem: formatItem,
    	formatResult: formatResult
	});
});
// ]]>
'; ?>

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

				<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/edit_profile.gif" alt="Edit Profile" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<form class="account-setting-form" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
" id="fmx" enctype="multipart/form-data">
                    <input type="hidden" name="mod" value="bprofile" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
					<div class="clear">&nbsp;</div><br />
					<?php if ($this->_tpl_vars['errs']): ?>
                    <p style="color: red;">
                    <?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                         - <?php echo $this->_tpl_vars['i']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
                    </p>
                    <?php endif; ?>
					<?php if ($this->_tpl_vars['save']): ?>
					    <p style="color: green;">Profile was changed</p>
					<?php endif; ?>
					<table class="pass-t" style="width:640px;">
						<tr>
							<td style="width: 100px;"><label>Photo</label></td><td ><input type="file" name="fm[image]" /> <?php if ($this->_tpl_vars['ui']['image']): ?><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;delphoto=1', 'Do You want to delete the photo?');">Delete Photo</a><?php endif; ?></td>
						</tr>
                        <tr>
							<td><label>Job Title</label></td>
                            <td>
                                <input type="text" value="<?php echo $this->_tpl_vars['fm']['prof1']; ?>
" name="fm[prof1]" style="margin-bottom: 4px;width:270px;" id="fm_prof1" maxlength="30"/>
                                <input type="text" value="<?php echo $this->_tpl_vars['fm']['prof2']; ?>
" name="fm[prof2]" style="margin-bottom: 4px;width:270px;" id="fm_prof2" maxlength="30"/>
                                <input type="text" value="<?php echo $this->_tpl_vars['fm']['prof3']; ?>
" name="fm[prof3]" style="margin-bottom: 4px;width:270px;" id="fm_prof3" maxlength="30"/>
                            </td>
						</tr>
						<tr>
							<td><label>Motto/Quote</label></td><td >
							<script type="text/javascript" src="<?php echo $this->_tpl_vars['siteAdr']; ?>
tmpl/fck/fckeditor.js"></script>
							<script type="text/javascript">
				        	var sBasePath = '<?php echo $this->_tpl_vars['siteAdr']; ?>
tmpl/fck/';
                            var oFCKeditor3 = new FCKeditor( 'fm[title]' ) ;
                            oFCKeditor3.BasePath	  = sBasePath ;
                            oFCKeditor3.ToolbarSet = 'Basic2' ;
                            oFCKeditor3.Height	  = '60px';
                            oFCKeditor3.Value	  = '<?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
' ;
                            oFCKeditor3.Create() ;
                            </script>
							
						    </td>
						</tr>
						<tr>
							<td><label>About me</label></td><td>
				        	<script type="text/javascript">
                            var oFCKeditor = new FCKeditor( 'fm[about_me]' ) ;
                            oFCKeditor.BasePath	  = sBasePath ;
                            oFCKeditor.ToolbarSet = 'Basic2' ;
                            oFCKeditor.Height	  = '120px';
                            oFCKeditor.Value	  = '<?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['about_me'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
' ;
                            oFCKeditor.Create() ;
                            </script>
							
							</td>
						</tr>
						<tr>
							<td><label>Interests</label></td><td>
				        	<script type="text/javascript">
                            var oFCKeditor2 = new FCKeditor( 'fm[interests]' ) ;
                            oFCKeditor2.BasePath	  = sBasePath ;
                            oFCKeditor2.ToolbarSet = 'Basic2' ;
                            oFCKeditor2.Height	  = '120px';
                            oFCKeditor2.Value	  = '<?php echo ((is_array($_tmp=$this->_tpl_vars['fm']['interests'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
' ;
                            oFCKeditor2.Create() ;
                            </script>
                            
							
						</td>
						</tr>
                    </table>
						<p class="tools"><a href="javascript: Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['uid']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="Cancel" /></a><a href="javascript: _v('fmx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="Save" /></a></p>
					</form>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
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