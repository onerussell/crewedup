<?php /* Smarty version 2.6.11, created on 2010-06-27 16:07:50
         compiled from mods/member/_account_notify.html */ ?>
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
title/account_settings.gif" alt="" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<form class="account-setting-form" method="post" action="<?php echo @PATH_ROOT; ?>
" id="NotifyForm" >
                    <input type="hidden" name="do"  value="1"      />
                    <input type="hidden" name="mod" value="notify" />
					<p><a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
?mod=profile&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
">Personal Information</a><a href="javascript://"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
notifications_b.gif" alt="" /></a></p>
					<div class="clear">&nbsp;</div><br />
						<p>Notify me:</p>
						<ul>
							<li><input class="radio-input" name="NI[type]" type="radio" value="0" <?php if (! $this->_tpl_vars['NI']['type']): ?>checked="1"<?php endif; ?> /><label>as events occur</label></li>
							<li><input class="radio-input" name="NI[type]" type="radio" value="1" <?php if ($this->_tpl_vars['NI']['type']): ?>checked="1"<?php endif; ?> /><label>as a summary each day</label></li>
						</ul>
						<p>Notify me by mail when:</p>
						<ul>
							<li><input type="checkbox" name="NI[announcement]"    id="NI[announcement]"    <?php if ($this->_tpl_vars['NI']['announcement']): ?>checked="1"<?php endif; ?> /><label    for="NI[announcement]"     >Crewed Up makes an announcement</label></li>
							<li><input type="checkbox" name="NI[message]"         id="NI[message]"         <?php if ($this->_tpl_vars['NI']['message']): ?>checked="1"<?php endif; ?> /><label         for="NI[message]"          >Someone writes me a message</label></li>
							<li><input type="checkbox" name="NI[comment]"         id="NI[comment]"         <?php if ($this->_tpl_vars['NI']['comment']): ?>checked="1"<?php endif; ?> /><label         for="NI[comment]"          >Someone writes me a comment/recommendation</label></li>
							<li><input type="checkbox" name="NI[contact_request]" id="NI[contact_request]" <?php if ($this->_tpl_vars['NI']['contact_request']): ?>checked="1"<?php endif; ?> /><label for="NI[contact_request]"  >Someone sends me a contact request</label></li>
							<li><input type="checkbox" name="NI[blocks_me]"       id="NI[blocks_me]"       <?php if ($this->_tpl_vars['NI']['blocks_me']): ?>checked="1"<?php endif; ?> /><label       for="NI[blocks_me]"        >Someone blocks me</label></li>
							<li><input type="checkbox" name="NI[new_job]"         id="NI[new_job]"         <?php if ($this->_tpl_vars['NI']['new_job']): ?>checked="1"<?php endif; ?> /><label         for="NI[new_job]"          >Someone posts a new job (selected feeds)</label></li>
							<li><input type="checkbox" name="NI[new_gear]"        id="NI[new_gear]"        <?php if ($this->_tpl_vars['NI']['new_gear']): ?>checked="1"<?php endif; ?> /><label        for="NI[new_gear]"         >Someone posts new gear (selected feeds)</label></li>
							<li><input type="checkbox" name="NI[live_resume]"     id="NI[live_resume]"     <?php if ($this->_tpl_vars['NI']['live_resume']): ?>checked="1"<?php endif; ?> /><label     for="NI[live_resume]"      >Contact updates their Live Resume</label></li>
							<li><input type="checkbox" name="NI[blog_entry]"      id="NI[blog_entry]"      <?php if ($this->_tpl_vars['NI']['blog_entry']): ?>checked="1"<?php endif; ?> /><label      for="NI[blog_entry]"       >Contact posts a new blog entry</label></li>
						</ul>
						<p class="tools"><a href="/?mod=notify&uid=7"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" /></a><a href="javascript:_v('NotifyForm').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="" /></a></p>
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