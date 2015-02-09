<?php /* Smarty version 2.6.11, created on 2010-07-28 20:33:51
         compiled from mods/member/resume/_forward.html */ ?>
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
title/forward_resume.gif" alt="Forward Resume" /></p><br />
				
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="comments_re">

                    
<form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/resume" id="fmx">
<input type="hidden" name="what" value="forward" />
<table>
    <tr>
	    <td style="width: 100px;"></td>
		<td valign="top">
            <br />
			<br />
            <?php if ($this->_tpl_vars['errs']): ?>
                <br /> 
			    <font color="#990000">
			   	<?php $_from = $this->_tpl_vars['errs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
			         <?php echo $this->_tpl_vars['item']; ?>
<br />
			   	<?php endforeach; endif; unset($_from); ?>
			     </font><br />      	 
            <?php endif; ?>
            <?php if ($this->_tpl_vars['send']): ?>
                <br /><font color="green">Resume was forwarded</font><br /><br />
            <?php endif; ?>
            <b style="font-size: 14px;">Specify e-mail:</b> <input type="text" name="fm[email]" value="<?php echo $this->_tpl_vars['fm']['email']; ?>
" style="width: 280px;" />
            <br /><br /> <br />
            <a href="javascript: void(0)"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
save_b.gif" alt="" onclick="_v('fmx').submit();" /></a>&nbsp;&nbsp;<a href="javascript: void(0)"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
cancel_b.gif" alt="" onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
');" /></a>
		</td>
		
	</tr>
</table>
</form>


					</div>
				<div class="clear">&nbsp;</div>
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