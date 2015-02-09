<?php /* Smarty version 2.6.11, created on 2011-01-18 17:40:37
         compiled from mails/forward_resume.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Mail from <?php echo $this->_tpl_vars['SUPPORT_SITENAME']; ?>
</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=<?php echo $this->_tpl_vars['charset']; ?>
" /> 
<body>
    User: <a href="http://<?php echo $this->_tpl_vars['DOMEN'];  echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['ui']['uid']; ?>
"><?php if (1 == $this->_tpl_vars['ui']['status']):  echo $this->_tpl_vars['ui']['name']; ?>
 <?php echo $this->_tpl_vars['ui']['lname'];  else:  echo $this->_tpl_vars['ui']['company'];  endif; ?></a>
    <br /><br />
    <b><?php if (1 == $this->_tpl_vars['ui']['status']): ?>Resume:<?php else: ?>Company Credits:<?php endif; ?></b><br />	
	<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
	<a href="http://<?php echo $this->_tpl_vars['DOMEN'];  echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['ui']['uid']; ?>
/<?php if (1 == $this->_tpl_vars['ui']['status']): ?>resume<?php else: ?>credits<?php endif; ?>?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><br />
	<?php endforeach; endif; unset($_from); ?>
	<br />
</body>
</html>