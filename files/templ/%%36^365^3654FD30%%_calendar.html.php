<?php /* Smarty version 2.6.11, created on 2010-05-24 13:37:33
         compiled from mods/member/calendar/_calendar.html */ ?>

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
title/calendar.gif" alt="#" /></p><br />

				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="calendar-month-celect">
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=calendar&amp;pdate=<?php echo $this->_tpl_vars['prev_next']['0']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
calendar_month_arrow2.gif" alt="Prev" /></a>
						<a class="month-text" href="javascript: void(0);"><?php echo $this->_tpl_vars['cdi']['mmonth']; ?>
 <?php echo $this->_tpl_vars['cdi']['year']; ?>
</a>
						<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?act=calendar&amp;pdate=<?php echo $this->_tpl_vars['prev_next']['1']; ?>
&amp;uid=<?php echo $this->_tpl_vars['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
calendar_month_arrow1.gif" alt="Next" /></a>
					</div>
                    <div id="drop"><!-- --></div>
					<table class="calendar-big">
						<tr>
							<th>Sun</th>
							<th>Mon</th>
							<th>Tue</th>
							<th>Wed</th>
							<th>Thu</th>
							<th>Fri</th>
							<th>Sat</th>
						</tr>
                        <?php $_from = $this->_tpl_vars['cdi']['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
						<tr>
							<?php $_from = $this->_tpl_vars['i']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['i2']):
?>
                            <?php $this->assign('ov', $this->_tpl_vars['i2']['1']); ?>
                             <td><a href="javascript: <?php if ($this->_tpl_vars['is_user']): ?>SelColor('<?php echo $this->_tpl_vars['i2']['1']; ?>
');<?php else: ?>void(0);<?php endif; ?>" id="<?php echo $this->_tpl_vars['i2']['1']; ?>
"<?php if (1 == $this->_tpl_vars['cevents'][$this->_tpl_vars['ov']]['status']): ?> class="green"<?php elseif (2 == $this->_tpl_vars['cevents'][$this->_tpl_vars['ov']]['status']): ?> class="red"<?php endif; ?>><?php echo $this->_tpl_vars['i2']['0']; ?>
</a></td>
					    	<?php endforeach; endif; unset($_from); ?>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                                                 <!-- class="green" class="red" -->
					</table>
				<p><b>Select Color</b></p>
				<div class="select-color">
					<p><?php if ($this->_tpl_vars['is_user']): ?><a href="javascript: SetColor(1);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
green_cub.gif" alt="Green" /></a><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
green_cub.gif" alt="Green" /><?php endif; ?><br /><font style="font-size:9px;margin-left:-1px;">Available</font></p>
					<p><?php if ($this->_tpl_vars['is_user']): ?><a href="javascript: SetColor(2);"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
red_cub.gif" alt="Red" /></a><?php else: ?><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
red_cub.gif" alt="Red" /><?php endif; ?><br /><font style="font-size:9px; margin-left:4px;">Booked</font></p>
				</div>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_banner02.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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