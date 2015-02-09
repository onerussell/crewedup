<?php /* Smarty version 2.6.11, created on 2010-05-24 23:01:09
         compiled from _search_block.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '_search_block.html', 11, false),)), $this); ?>
<div class="search-drop" style="<?php if ($this->_tpl_vars['blt']): ?>margin-top: 100px;<?php endif; ?> margin-left: 532px;">
	<div>
		<?php if (! $this->_tpl_vars['search_c']): ?>
        <br /><p>Items not found</p><br />
        <?php endif; ?>
    
        <?php if ($this->_tpl_vars['mc']): ?>
        <p>Crew Members
		<ul>
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
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (1 == $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['mcl'][$this->_sections['i']['index']]['company'];  endif; ?></a><?php echo ((is_array($_tmp=$this->_tpl_vars['mcl'][$this->_sections['i']['index']]['person_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</li>
			<?php endfor; endif; ?>
		</ul>
        <?php endif; ?>
		</p>
        <?php if ($this->_tpl_vars['ec']): ?>
		<p>Employers
		<ul>
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
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['uid']; ?>
"><?php if (1 == $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['status']):  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['lname'];  else:  echo $this->_tpl_vars['ecl'][$this->_sections['i']['index']]['company'];  endif; ?></a><?php echo ((is_array($_tmp=$this->_tpl_vars['ecl'][$this->_sections['i']['index']]['person_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</li>
            <?php endfor; endif; ?>
		</ul>
		</p>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['jc']): ?>  
		<p>Jobs
		<ul>
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
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['job_title']; ?>
</a> at <?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['cid']; ?>
 in <?php echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['city']; ?>
, <?php $this->assign('ov', $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']);  echo $this->_tpl_vars['jcl'][$this->_sections['i']['index']]['state']; ?>
</li>
			<?php endfor; endif; ?>
		</ul>
		</p>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['gc']): ?>
		<p>Gear
		<ul>
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
            <li><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['uid']; ?>
/?id=<?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['gcl'][$this->_sections['i']['index']]['title']; ?>
</a></li>
			<?php endfor; endif; ?>
		</ul>
		</p>
        <?php endif; ?>
	</div>
    
	<p class="view-results"><?php if ($this->_tpl_vars['search_c']): ?><span style="float:left"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php?sstr=<?php echo $this->_tpl_vars['sstr']; ?>
">View all results (<?php echo $this->_tpl_vars['search_c']; ?>
) </a></span><?php endif; ?><span style="float:right"><a href="javascript: void(0);" onclick="_v('search_res').style.display='none'; return false;">Close Box</a></span></p>
</div>