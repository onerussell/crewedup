<?php /* Smarty version 2.6.11, created on 2010-12-14 22:15:01
         compiled from mods/employer/_account_profile.html */ ?>
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_main_box.html", 'smarty_include_vars' => array()));
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
					<table class="pass-t">
                        <tr>
							<td style="width: 100px;"><label>Logo</label></td><td ><input type="file" name="fm[image]" /> <?php if ($this->_tpl_vars['ui']['image']): ?><a href="javascript: CGo('<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=bprofile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
&amp;delphoto=1', 'Do You want to delete the photo?');">Delete Logo</a><?php endif; ?></td>
						</tr>
                        <tr>
							<td><label>Company type</label></td>
                            <td>
                                <input type="radio" value="1" name="fm[prof1]"<?php if (! $this->_tpl_vars['fm']['prof1'] || '1' == $this->_tpl_vars['fm']['prof1']): ?> checked="checked"<?php endif; ?> /> production company <input type="radio" value="2" name="fm[prof1]"<?php if ('2' == $this->_tpl_vars['fm']['prof1']): ?> checked="checked"<?php endif; ?> /> rental house
                            </td>
						</tr>
						<tr>
							<td><label>About Us</label></td><td><textarea name="fm[about_me]" style="width: 400px; height: 120px;"><?php echo $this->_tpl_vars['fm']['about_me']; ?>
</textarea></td>
						</tr>
                        <tr>
							<td><label>Public mail</label></td><td><input name="fm[public_mail]" value="<?php echo $this->_tpl_vars['fm']['public_mail']; ?>
" style="width:400px;" /></td>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/employer/_left_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
			</td>
		</tr>
	</table>
</div>