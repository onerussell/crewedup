<?php /* Smarty version 2.6.11, created on 2010-05-02 07:27:33
         compiled from mods/jobs/_all.html */ ?>
<!-- Content -->
<div class="content">
		<table>
		<tr>
			<td width="170"><p><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/all_jobs.gif" alt="All Jobs" /></p></td>
			<td><?php if ($this->_tpl_vars['is_user'] && 2 == $this->_tpl_vars['UserInfo']['status']): ?><p class="gear-add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?mod=add">Post new job</a></p><?php endif; ?></td>
		</tr>
	</table>
	<br />
    <?php if ($this->_tpl_vars['is_user'] && 2 == $this->_tpl_vars['UserInfo']['status']): ?>
    <h1 style="color:#000;font-size:1.3em;font-weight:normal;"><?php if ($this->_tpl_vars['is_my']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php">Show All</a><?php else: ?>Show All<?php endif; ?> | <?php if (! $this->_tpl_vars['is_my']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?is_my=1">Show My Jobs</a><?php else: ?>Show My Jobs<?php endif; ?></h1>
    <br /><?php endif; ?>
    <?php if ($this->_tpl_vars['pl']): ?>
	<table class="employers-t">
		<tr>
			<th width="100">Posted</th>
			<th width="185">Job Title</th>
			<th width="130">Company</th>
			<th width="180">Location</th>
			<th width="120">Category</th>
			<th width="100">Start</th>
		</tr>
		<?php $_from = $this->_tpl_vars['pl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
        <tr<?php if (0 == ($this->_foreach['n']['iteration']-1) % 2): ?> class="grey"<?php endif; ?>>
        
        <?php if ($this->_tpl_vars['i']['isRSS'] == 'RSS'): ?>
			<td height="23" class="first"><?php echo $this->_tpl_vars['i']['pdate']; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['job_title']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['rssCompany']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['rssCity']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?cat=<?php echo $this->_tpl_vars['i']['cid'];  if ($this->_tpl_vars['state']): ?>&amp;state=<?php echo $this->_tpl_vars['state'];  endif;  if ($this->_tpl_vars['city']): ?>&amp;city=<?php echo $this->_tpl_vars['city'];  endif; ?>"><?php echo $this->_tpl_vars['i']['cid']; ?>
</a></td>
			<td class="end"><?php echo $this->_tpl_vars['i']['start_date']; ?>
</td>
		</tr>
        <?php else: ?>
			<td height="23" class="first"><?php echo $this->_tpl_vars['i']['pdate']; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['i']['id']; ?>
"><?php echo $this->_tpl_vars['i']['job_title']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['i']['uid']; ?>
"><?php echo $this->_tpl_vars['i']['company']; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?city=<?php echo $this->_tpl_vars['i']['city']; ?>
&amp;state=<?php echo $this->_tpl_vars['i']['state']; ?>
"><?php echo $this->_tpl_vars['i']['city']; ?>
,</a><?php $this->assign('ov', $this->_tpl_vars['i']['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?state=<?php echo $this->_tpl_vars['i']['state']; ?>
"><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['ov']]; ?>
</a></td>
			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?cat=<?php echo $this->_tpl_vars['i']['cid'];  if ($this->_tpl_vars['state']): ?>&amp;state=<?php echo $this->_tpl_vars['state'];  endif;  if ($this->_tpl_vars['city']): ?>&amp;city=<?php echo $this->_tpl_vars['city'];  endif; ?>"><?php echo $this->_tpl_vars['i']['cid']; ?>
</a></td>
			<td class="end"><?php echo $this->_tpl_vars['i']['start_date']; ?>
</td>
		</tr>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class="nav-employer" colspan="3"></td>
			<td class="nav-employer" colspan="3" align="right"><?php echo $this->_tpl_vars['pagging']; ?>
</td>
		</tr>        
	</table>
	<?php else: ?>
	Jobs not found
	<?php endif; ?>
</div>
<!-- /Content -->