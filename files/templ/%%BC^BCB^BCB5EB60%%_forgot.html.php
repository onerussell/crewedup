<?php /* Smarty version 2.6.11, created on 2010-05-02 20:55:15
         compiled from mods/reg/_forgot.html */ ?>
<div class="content">
	<div class="crew-members-reg">
    
		<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/forgot.gif" alt="Forgot your password?" style="margin-left:90px;" /></p>
        	
        <?php if ($this->_tpl_vars['forgoterr']): ?>
        <font color="#990000">
	    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['forgoterr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
        <?php if ($this->_tpl_vars['forgoterr'][$this->_sections['i']['index']] == 2): ?>
  	       - Please enter e-mail<br />
        <?php elseif ($this->_tpl_vars['forgoterr'][$this->_sections['i']['index']] == 3): ?>
	       - Error e-mail.<br />  
        <?php endif; ?>
        <?php endfor; endif; ?>	
	    </font>
	    <br />
        <?php endif; ?>
        <?php if ($this->_tpl_vars['send']): ?>
        <font color="#990000">
	    Your password has been sent.
	    </font>
	    <br /><br />
        <?php endif; ?>
            <form name="fmx" method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
index.php">
            <input type="hidden" name="mod" value="forgot" />
                        <table class="pass-t">
						<tr>
							<td><label>E-mail</label></td><td ><input type="text" name="UserInfo[email]" value="" size="40" /></td>
						</tr>
                        <tr>
							<td>&nbsp;</td>
							<td><p style="padding:15px 50px"><a href="javascript: document.fmx.submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
go_big_b.gif" alt="Go" /></a></p></td>
						</tr>
                        </table>
            </form>            
                        
  </div>
</div>
