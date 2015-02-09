<?php /* Smarty version 2.6.11, created on 2010-06-01 14:16:31
         compiled from mods/search/_list_jobs.html */ ?>
<div class="content">
	<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/search_results.gif" alt="#" /></p>
	<p><?php echo $this->_tpl_vars['jc']; ?>
 result<?php if (1 < $this->_tpl_vars['search_c']): ?>s<?php endif; ?> found for "<span class="color_brown"><?php echo $this->_tpl_vars['sstr']; ?>
</span>"</p><br />
	<table id="main-table">
		<tr>
			<td class="left">
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
                    <?php if ($this->_tpl_vars['jc']): ?>  
					<p><b>Jobs</b></p>
										<p>&nbsp;</p>
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['jcl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['job_title']; ?>
</a> needed at <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?cat=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['cid']; ?>
"><?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['cid']; ?>
</a> in <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?city=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['city']; ?>
&amp;state=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']; ?>
"><?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['city']; ?>
</a>, <?php $this->assign('ov', $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']); ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?state=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']; ?>
"><?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']; ?>
</a> from <?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['start_date']; ?>
</p>
					<?php endfor; endif; ?>
                    <br /><p class="view-all-found"><?php echo $this->_tpl_vars['pagging']; ?>
</p>
					<?php endif; ?>
                    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Show All Search Results</a>
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>

			</td>
			<td class="right">
			<!-- Search Box -->
				<p class="right-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
search_ico.gif" alt="" />Search Categories</p>
				<ul class="guide">
					<li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">All Categories</a></li>
					<?php if ($this->_tpl_vars['mc']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Crew Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['ec']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=employers&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Employers</a></li><?php endif; ?>
                    <li>Jobs</li>
                    <?php if ($this->_tpl_vars['gc']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=gear&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Gear</a></li><?php endif; ?>   
				</ul>
			</td>
		</tr>
	</table>
</div>
<!-- /Content -->