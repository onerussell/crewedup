<?php /* Smarty version 2.6.11, created on 2010-05-25 00:51:50
         compiled from mods/member/comments/_box.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'mods/member/comments/_box.html', 2, false),array('modifier', 'truncate', 'mods/member/comments/_box.html', 2, false),array('modifier', 'wordwrap', 'mods/member/comments/_box.html', 3, false),)), $this); ?>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['coml']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['story'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
<br />
							<span><?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['pdate']; ?>
 <?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['ptime']; ?>
</span><span><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['uid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['coml'][$this->_sections['i']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
</a></span><?php if ($this->_tpl_vars['coml'][$this->_sections['i']['index']]['person_title']): ?> (<?php echo $this->_tpl_vars['coml'][$this->_sections['i']['index']]['person_title']; ?>
)<?php endif; ?></p>
							<?php if (! $this->_sections['i']['last']): ?>
                            <div class="clear" style="height:10px;"><!-- --></div>
                            <?php endif; ?>
                            <?php endfor; else: ?>
                            No comments
                            <?php endif; ?>
							<div class="clear" style="height:5px;"><!-- --></div>
                            <?php if (IS_AUTH && ( ! $this->_tpl_vars['is_user'] || $this->_tpl_vars['is_public'] )):  if ('r' == $this->_tpl_vars['wh']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['euid']; ?>
/comments?wh=r#newc">Post Recommendation</a><?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['euid']; ?>
/comments#newc">Post Comment</a><?php endif; ?>  | 
                    
                    <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php" name="fmtx" id="fmtx">
                    <input type="hidden" name="act" value="comments" />
                    <input type="hidden" name="what" value="add" />
                    <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['euid']; ?>
" />
                    <input type="hidden" name="wh" value="<?php echo $this->_tpl_vars['wh']; ?>
" />
					<?php if ('r' == $this->_tpl_vars['wh']): ?><b>New Recommendation</b><?php else: ?><b>New Comment</b><?php endif; ?><br />
					<p><textarea name="fm[story]" id="story" style="height: 60px; width: 470px;"><?php echo $this->_tpl_vars['fm']['story']; ?>
</textarea></p>
					<p class="tools"><a href="javascript: _v('fmtx').submit();"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
post_b.gif" alt="Post" /></a></p>
					</form> 
                    <?php endif; ?>
                      