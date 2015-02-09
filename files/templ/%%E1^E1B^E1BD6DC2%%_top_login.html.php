<?php /* Smarty version 2.6.11, created on 2010-04-30 15:44:24
         compiled from _top_login.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', '_top_login.html', 18, false),)), $this); ?>
<div class="top-login">
		<?php if (! $this->_tpl_vars['system_login']): ?>
		<form method="post" name="flogin" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php">
        <input type="hidden" name="mod" value="login" />
		<div>
		<img class="va" src="<?php echo $this->_tpl_vars['imgDir']; ?>
lock_ico.gif" alt="" />
		<label class="va">E-mail</label> <input class="txt va" type="text" name="system_login" value="<?php echo $this->_tpl_vars['systemLogin']; ?>
" />
		<label class="va">Password</label> <input class="txt va" type="password" name="system_pass" value="" />
		<input class="go-b" type="submit" value="" />
		</div>
		<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=reg">Register here</a>|<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=forgot">Forgot your password?</a>
		<input type="checkbox" name="remember" value="1" /> Remember me |<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=help">Help</a>
		</p>
 		</form>
		<?php else: ?>
		<div>
		<img class="addtl2" src="<?php echo $this->_tpl_vars['imgDir']; ?>
lock_ico.gif" alt="" />
		<label><b>Welcome</b> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
"><?php if (2 == $this->_tpl_vars['UserInfo']['status']):  echo $this->_tpl_vars['UserInfo']['company'];  else:  echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['UserInfo']['lname'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp));  endif; ?></a> [<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['UserInfo']['uid']; ?>
"><?php echo $this->_tpl_vars['UserInfo']['email']; ?>
</a>]</label>
		</div>
		<p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?logout=1">Sign Out</a> |<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php?mod=page&amp;pn=help">Help</a>
		</p>
		<?php endif; ?>
	</div>