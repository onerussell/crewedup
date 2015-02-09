<?php /* Smarty version 2.6.11, created on 2010-05-25 10:28:07
         compiled from mods/member/wire/_box.html */ ?>
                            <div class="white-box-top">
							    <div class="white-box-bottom">
								    <?php $_from = $this->_tpl_vars['wl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <p><img src="<?php echo $this->_tpl_vars['imgDir'];  if (10 == $this->_tpl_vars['i']['ptype'] || 11 == $this->_tpl_vars['i']['ptype']): ?>quest.gif<?php else: ?>ico<?php if (1 == $this->_tpl_vars['i']['ptype'] || 7 == $this->_tpl_vars['i']['ptype']): ?>06<?php elseif (2 == $this->_tpl_vars['i']['ptype']): ?>04<?php elseif (3 == $this->_tpl_vars['i']['ptype']): ?>02<?php elseif (4 == $this->_tpl_vars['i']['ptype']): ?>12<?php elseif (5 == $this->_tpl_vars['i']['ptype'] || 9 == $this->_tpl_vars['i']['ptype']): ?>05<?php elseif (6 == $this->_tpl_vars['i']['ptype']): ?>01<?php endif; ?>.gif<?php endif; ?>" alt="" /><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['fname']; ?>
</a></span><a href="<?php echo $this->_tpl_vars['siteAdr'];  echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['title']; ?>
</a><span><?php echo $this->_tpl_vars['i']['pdate']; ?>
</span></p>
							    	<div class="sep">&nbsp;</div>
									<?php endforeach; else: ?>
									    No items
									<?php endif; unset($_from); ?>
								</div>
							</div>