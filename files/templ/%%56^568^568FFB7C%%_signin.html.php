<?php /* Smarty version 2.6.11, created on 2010-05-27 19:37:33
         compiled from mods/reg/_signin.html */ ?>
<div class="content">
	<div class="crew-members-reg">
		<p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/signin.gif" alt="Sign In" /></p>
		                <form class="crew_members_reg-form" name="fml" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php">
                        <input type="hidden" name="mod" value="login" />
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
                        <table class="pass-t">
						<tr>
							<td><label>E-mail</label></td><td ><input type="text" name="system_login" value="<?php echo $this->_tpl_vars['system_login']; ?>
" style="width:270px;"  /></td>
						</tr>
						<tr>
							<td><label>Password</label></td><td><input type="password" name="system_pass" value="" style="width:270px;" /></td>
						</tr>
                        <tr>
							<td>&nbsp;</td>
							<td><p style="padding:15px 50px"><a href="javascript: document.fml.submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
go_big_b.gif" alt="Go" /></a></p></td>
						</tr>
                        </table>
                        </form>
	</div>
</div>
