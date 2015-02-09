<?php /* Smarty version 2.6.11, created on 2010-05-26 18:43:17
         compiled from mods/search/_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mods/search/_list.html', 25, false),)), $this); ?>
<div class="content">
	<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/search_results.gif" alt="#" /></p>
	<p><?php echo $this->_tpl_vars['search_c']; ?>
 result<?php if (1 < $this->_tpl_vars['search_c']): ?>s<?php endif; ?> found for "<span class="color_brown"><?php echo $this->_tpl_vars['sstr']; ?>
</span>"</p><br />
	<table id="main-table">
		<tr>
			<td class="left">
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					
                    <?php if ($this->_tpl_vars['mc']): ?>
                    <p><b>Crew Members</b></p>
										<table class="roster-t">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['mcl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <?php if ($this->_sections['i']['index'] % 3 == 0): ?>
                                <tr>
                                <?php endif; ?>
                                <td class="av1">
								<div class="container02">
									<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
									<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['mcl'][$this->_sections['i']['index']]['image']):  echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['subdir']; ?>
s_<?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
empty.gif<?php endif; ?>" alt="<?php if (1 == $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['company'];  endif; ?>" /></a></div>
									<div class="bl"><div class="blc"></div><div class="brc"></div></div>
								</div>
								</td>
								<td class="av2"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (1 == $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['company'];  endif; ?></a><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['mcl'][$this->_sections['i']['index']]['person_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</td>
                                <?php if ($this->_sections['i']['last'] || $this->_sections['i']['index_next'] % 3 == 0): ?>
                                </tr>
                                <?php endif; ?>
                            <?php endfor; endif; ?>
					</table>
					<?php if (1 < $this->_tpl_vars['mc']): ?><p class="view-all-found"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">View all found Crew Members (<?php echo $this->_tpl_vars['mc']; ?>
) </a></p><?php endif; ?>
                    <?php endif; ?>

                    <?php if ($this->_tpl_vars['ec']): ?>
					<p><b>Employers</b></p>
										<table class="roster-t">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ecl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <?php if ($this->_sections['i']['index'] % 3 == 0): ?>
                                <tr>
                                <?php endif; ?>
                                
                                <td class="av1">
								<div class="container02">
									<div class="tl"><div class="tlc"></div><div class="trc"></div></div>
									<div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['uid']; ?>
"><img src="<?php if ($this->_tpl_vars['ecl'][$this->_sections['i']['index']]['image']):  echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['subdir']; ?>
s_<?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['image'];  else:  echo $this->_tpl_vars['imgDir']; ?>
empty.gif<?php endif; ?>" width="32px;" height="32px;" alt="<?php if (1 == $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['company'];  endif; ?>" /></a></div>
									<div class="bl"><div class="blc"></div><div class="brc"></div></div>
								</div>
								</td>
								<td class="av2"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (1 == $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['company'];  endif; ?></a><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['ecl'][$this->_sections['i']['index']]['person_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</td>
                                
                                
                                <?php if ($this->_sections['i']['last'] || $this->_sections['i']['index_next'] % 3 == 0): ?>
                                </tr>
                                <?php endif; ?>
                        <?php endfor; endif; ?>
					</table>
					<?php if ($this->_tpl_vars['ec'] > 1): ?><p class="view-all-found"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=employers&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">View all found Employers (<?php echo $this->_tpl_vars['ec']; ?>
) </a></p><?php endif; ?>
                    <?php endif; ?>

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
                    <?php if (1 < $this->_tpl_vars['jc']): ?><br /><p class="view-all-found"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=jobs&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">View all found Jobs (<?php echo $this->_tpl_vars['jc']; ?>
) </a></p><?php endif; ?>
					<?php endif; ?>
                    
                    <?php if ($this->_tpl_vars['gc']): ?>
                    <br /><p><b>Gear</b></p>
										<p>&nbsp;</p>

					    <table class="credits-t">
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['gcl']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<tr>
								<td class="first" style="border:0"><?php if ($this->_tpl_vars['gcl'][$this->_sections['i']['index']]['image']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['uid']; ?>
/?id=<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath']; ?>
/<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['image']; ?>
" alt="<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['title']; ?>
" /></a><?php else: ?>&nbsp;<?php endif; ?></td>
								<td style="border:0"><b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['uid']; ?>
/?id=<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['title']; ?>
</a></b><br /></td>
							</tr>
                        <?php endfor; endif; ?>    
						</table>
						<?php if ($this->_tpl_vars['gc']): ?><p class="view-all-found"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=gear&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">View all found Gear (<?php echo $this->_tpl_vars['gc']; ?>
) </a></p><?php endif; ?>
                     <?php endif; ?>   
				<div class="clear">&nbsp;</div>
				</div>
				<div class="grey-box-bottom">&nbsp;</div>

			</td>
			<td class="right">
			<!-- Search Box -->
				<p class="right-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
search_ico.gif" alt="" />Search Categories</p>
				<ul class="guide">
					<li>All Categories</li>
					<?php if ($this->_tpl_vars['mc']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=member&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Crew Members</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['ec']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=employers&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Employers</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['jc']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=jobs&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Jobs</a></li><?php endif; ?>
                    <?php if ($this->_tpl_vars['gc']): ?><li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?mod=gear&amp;sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">Gear</a></li><?php endif; ?>   
				</ul>
			</td>
		</tr>
	</table>
</div>
<!-- /Content -->