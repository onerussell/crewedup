<?php /* Smarty version 2.6.11, created on 2010-06-03 07:14:13
         compiled from mods/member/wire/_wire.html */ ?>
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
title/wire.gif" alt="The Wire" /></p><br />
				
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="wire">
						<p><?php if (! $this->_tpl_vars['pt']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
all_b.gif" alt="All" /></a><?php else: ?><a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire">All</a><?php endif; ?>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=3"><?php if (3 == $this->_tpl_vars['pt']): ?><b>Messages</b><?php else: ?>Messages<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=5"><?php if (5 == $this->_tpl_vars['pt']): ?><b>Contacts Request</b><?php else: ?>Contacts Request<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=1"><?php if (1 == $this->_tpl_vars['pt']): ?><b>Blog entries</b><?php else: ?>Blog entries<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=2"><?php if (2 == $this->_tpl_vars['pt']): ?><b>Photos in Gallery</b><?php else: ?>Photos in Gallery<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=7"><?php if (7 == $this->_tpl_vars['pt']): ?><b>Resume</b><?php else: ?>Resume<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=4"><?php if (4 == $this->_tpl_vars['pt']): ?><b>Gear</b><?php else: ?>Gear<?php endif; ?></a>
                           <a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['uid']; ?>
/wire?pt=6"><?php if (6 == $this->_tpl_vars['pt']): ?><b>Jobs</b><?php else: ?>Jobs<?php endif; ?></a>
                           |<a class="f12" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
rss.php?mod=wire" target="_blank">News</a></p>
    					<br />
						<table class="wire-t">             >
							<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                            <tr>
								<td class="first">
                                <?php if ($this->_tpl_vars['i']['image']): ?>
                                    <div class="container02">
						                <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
							            <div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['i']['subdir']; ?>
s_<?php echo $this->_tpl_vars['i']['image']; ?>
" alt="<?php echo $this->_tpl_vars['i']['fname']; ?>
" /></a></div>
							            <div class="bl"><div class="blc"></div><div class="brc"></div></div>
					                </div>
                                <?php else: ?>
                                    <div class="container02">
                                        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="<?php echo $this->_tpl_vars['i']['fname']; ?>
" /></a>
                                    </div>
                                <?php endif; ?>
                                </td>
								<td><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
" class="color_green"><?php echo $this->_tpl_vars['i']['fname']; ?>
</a> <a href="<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><span><?php echo $this->_tpl_vars['i']['pdate']; ?>
</span></p></td>
    							<td class="end"><a href="<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['i']['link']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir'];  if (10 == $this->_tpl_vars['i']['ptype'] || 11 == $this->_tpl_vars['i']['ptype']): ?>quest.gif<?php else: ?>ico<?php if (1 == $this->_tpl_vars['i']['ptype'] || 7 == $this->_tpl_vars['i']['ptype']): ?>06<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>04<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>02<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>12<?php elseif (5 == $this->_tpl_vars['i']['ptype'] || 9 == $this->_tpl_vars['i']['ptype']): ?>05<?php elseif (6 == $this->_tpl_vars['i']['ptype']): ?>01<?php endif; ?>_.gif<?php endif; ?>" alt="" /></a></td>
							</tr>
                            <?php endforeach; else: ?>
                            <tr>
								<td colspan="3">
                                    No items
                                </td>
                            </tr
							<?php endif; unset($_from); ?>
    						<tr>
    							<td colspan="3" class="nav-wire" align="right">
                                    <?php echo $this->_tpl_vars['pagging']; ?>

		      					</td>
    						</tr>
                            </table>	
					</div>				
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