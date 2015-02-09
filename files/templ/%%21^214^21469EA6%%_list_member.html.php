<?php /* Smarty version 2.6.11, created on 2010-06-03 11:49:47
         compiled from mods/search/_list_member.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mods/search/_list_member.html', 25, false),)), $this); ?>
<div class="content">
	<p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/search_results.gif" alt="#" /></p>
	<p><?php echo $this->_tpl_vars['mc']; ?>
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
					<li>Crew Members</li>
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