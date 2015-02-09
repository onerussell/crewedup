<?php /* Smarty version 2.6.11, created on 2010-05-24 13:15:30
         compiled from mods/page/_page.html */ ?>
<div class="content">
	<div class="info-box">
		<p class="top-title">
		<?php if ('about' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/about_us.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('advert' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/advertise.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('promo' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/promotion.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('contactus' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/contact_us.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('privacy' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/privacy_policy.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('terms' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/terms_of_use.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php elseif ('help' == $this->_tpl_vars['pi']['pagename']): ?>
		    <img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/help.gif" alt="<?php echo $this->_tpl_vars['pi']['name']; ?>
" />
		<?php else: ?>
		    <h1 style="color:#555;font-size: 25px;"><?php echo $this->_tpl_vars['pi']['name']; ?>
</h1>
		<?php endif; ?>
		</p>
		<div class="clear">&nbsp;</div>
		<p>
		    <?php echo $this->_tpl_vars['pi']['pagetext']; ?>

		</p>
		
	</div>
</div>