<?php /* Smarty version 2.6.11, created on 2010-05-26 20:29:03
         compiled from mods/member/mc/_mc.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'wordwrap', 'mods/member/mc/_mc.html', 39, false),array('modifier', 'date_format', 'mods/member/mc/_mc.html', 43, false),array('modifier', 'lower', 'mods/member/mc/_mc.html', 43, false),array('modifier', 'ucfirst', 'mods/member/mc/_mc.html', 43, false),array('modifier', 'strip_tags', 'mods/member/mc/_mc.html', 45, false),array('modifier', 'truncate', 'mods/member/mc/_mc.html', 45, false),array('function', 'math', 'mods/member/mc/_mc.html', 62, false),)), $this); ?>
﻿<!-- Content -->
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/_main_box.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<table>
					<tr>
						<td width="120"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/mail.gif" alt="Mail" /></p></td>
						<td><?php if ($this->_tpl_vars['friends_c']): ?><p class="gear-add"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=send"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Compose message" />Compose message</a></p><?php endif; ?></td>
					</tr>
					
				</table>
				
				<div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">
					<div class="mail_inbox">
						<p><?php if ('inbox' == $this->_tpl_vars['action']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=inbox"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
inbox_b.gif" alt="Inbox" style="margin-right: 0px; margin-left: 0px;" /></a><?php else: ?> <a class="f10" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=inbox">Inbox</a>&nbsp;<?php endif; ?>
                           <?php if ('sent' == $this->_tpl_vars['action']): ?><a class="f10" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=sent"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
sent_b.gif" alt="Sent message" style="margin-right: 0px; margin-left: 0px;" /></a><?php else: ?> <a class="f10" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=sent">Sent messages</a>&nbsp;<?php endif; ?>
                           <?php if ('deleted' == $this->_tpl_vars['action']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=deleted"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
deleted_b.gif" alt="Deleted message" style="margin-right: 0px; margin-left: 0px;" /></a><?php else: ?> <a class="f10" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=deleted">Deleted messages</a>&nbsp;<?php endif; ?></p>
						
                        <?php if ($this->_tpl_vars['action'] == 'inbox' || $this->_tpl_vars['action'] == 'sent' || $this->_tpl_vars['action'] == 'deleted'): ?>
                        <?php if (! $this->_tpl_vars['add_action'] || $this->_tpl_vars['add_action'] == 'view'): ?>
                            <form action="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php" name="MessagesForm" method="post" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="mod"            value="mc" />
                            <input type="hidden" name="id"             value="-1" />
                            <input type="hidden" name="action"         value="<?php echo $this->_tpl_vars['action']; ?>
" />
                            <input type="hidden" name="add_action"     value="delete" />
                            <input type="hidden" name="pvstart"        value="<?php echo $this->_tpl_vars['pvstart']; ?>
" />
                            <input type="hidden" name="order"          value="<?php echo $this->_tpl_vars['order']; ?>
" />
                            <?php if ($this->_tpl_vars['action'] == 'inbox'): ?>
                                <table class="mail-t">
					    		<?php unset($this->_sections['iim']);
$this->_sections['iim']['name'] = 'iim';
$this->_sections['iim']['loop'] = is_array($_loop=$this->_tpl_vars['mess']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iim']['show'] = true;
$this->_sections['iim']['max'] = $this->_sections['iim']['loop'];
$this->_sections['iim']['step'] = 1;
$this->_sections['iim']['start'] = $this->_sections['iim']['step'] > 0 ? 0 : $this->_sections['iim']['loop']-1;
if ($this->_sections['iim']['show']) {
    $this->_sections['iim']['total'] = $this->_sections['iim']['loop'];
    if ($this->_sections['iim']['total'] == 0)
        $this->_sections['iim']['show'] = false;
} else
    $this->_sections['iim']['total'] = 0;
if ($this->_sections['iim']['show']):

            for ($this->_sections['iim']['index'] = $this->_sections['iim']['start'], $this->_sections['iim']['iteration'] = 1;
                 $this->_sections['iim']['iteration'] <= $this->_sections['iim']['total'];
                 $this->_sections['iim']['index'] += $this->_sections['iim']['step'], $this->_sections['iim']['iteration']++):
$this->_sections['iim']['rownum'] = $this->_sections['iim']['iteration'];
$this->_sections['iim']['index_prev'] = $this->_sections['iim']['index'] - $this->_sections['iim']['step'];
$this->_sections['iim']['index_next'] = $this->_sections['iim']['index'] + $this->_sections['iim']['step'];
$this->_sections['iim']['first']      = ($this->_sections['iim']['iteration'] == 1);
$this->_sections['iim']['last']       = ($this->_sections['iim']['iteration'] == $this->_sections['iim']['total']);
?>
                                <tr>
					    			<td class="first">
                                    <?php if ($this->_tpl_vars['mess'][$this->_sections['iim']['index']]['image']): ?>
                                    <div class="container02">
									    <div class="tl"><div class="tlc"></div><div class="trc"></div></div>
									    <div class="ml"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['icPath'];  echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['subdir']; ?>
s_<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['image']; ?>
" alt="<?php if (1 == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?>" /></a></div>
									    <div class="bl"><div class="blc"></div><div class="brc"></div></div>
								    </div>
                                    <?php else: ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
empty.gif" alt="No Photo" /></a><?php endif; ?></td>
					    			<td><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['uid']; ?>
" class="f12 color_green"><?php if (1 == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><span><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y %I:%M %p") : smarty_modifier_date_format($_tmp, "%m/%d/%Y %I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span><br />
					    			<b>Subject:</b> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=read&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" class="f10 color_grey"><?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['subject']; ?>
</a> <?php if ($this->_tpl_vars['action'] == 'inbox' && ! $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['readed']): ?><b style="color:#990000">New message!</b><?php endif; ?><br />
                                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['message'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
<br />
								    <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=read&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
">more</a>
					    			</td>
					    			<td class="end">
                                    <?php if (! $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['is_invite']): ?>
                                        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=reply&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
quest.gif" alt="Answer" /></a><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=delete&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" onClick="if (!confirmLink(this, 'Are you sure you want to delete this message?')) return false;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close.gif" alt="Delete" /></a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=confirm&af=1&fid=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['is_invite']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
approve.gif" alt="Approve" /></a>
                                        <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
friend.php?mod=ccancel&fid=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['is_invite']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
unapprove.gif" alt="Reject" /></a>
                                    <?php endif; ?>
                                    </td>
					    		</tr>
					    		<?php endfor; endif; ?>
                            
					    		<?php if ($this->_tpl_vars['mess']): ?>
                                <tr>
                                    <td colspan="2" class="nav-mail">
						    		    <?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_tpl_vars['pvstart'],'y' => $this->_tpl_vars['ResOnPage'],'assign' => 'sum'), $this);?>

                                        Showing  <?php echo $this->_tpl_vars['pvstart']+1; ?>
 to <?php if ($this->_tpl_vars['sum'] > $this->_tpl_vars['mess_cnt']):  echo $this->_tpl_vars['mess_cnt'];  else:  echo $this->_tpl_vars['sum'];  endif; ?> of <?php echo $this->_tpl_vars['mess_cnt']; ?>
 messages
						    	    </td>
						    	    <td class="nav-mail" align="right">
                                    <?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
">PREV</a><?php else: ?><span>PREV</span><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php $_from = $this->_tpl_vars['pgArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['i']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['pvstart']): ?> style="font-weight: bold; color:#666; text-decoration: none;"<?php endif; ?>><?php echo ($this->_foreach['n']['iteration']-1)+1; ?>
</a><?php endforeach; else: ?><b>1</b><?php endif; unset($_from); ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
">Next</a><?php else: ?><span>Next</span><?php endif; ?>
						    	    </td>
                                </tr>
                                <?php else: ?>
                                   <tr>
                                       <td><p>Contacts not found</p></td>
                                   </tr>
                                <?php endif; ?>
					    	</table>
                            <?php elseif ($this->_tpl_vars['action'] == 'sent' || $this->_tpl_vars['action'] == 'deleted'): ?>
                            <table class="mail-t">
							<?php unset($this->_sections['iim']);
$this->_sections['iim']['name'] = 'iim';
$this->_sections['iim']['loop'] = is_array($_loop=$this->_tpl_vars['mess']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['iim']['show'] = true;
$this->_sections['iim']['max'] = $this->_sections['iim']['loop'];
$this->_sections['iim']['step'] = 1;
$this->_sections['iim']['start'] = $this->_sections['iim']['step'] > 0 ? 0 : $this->_sections['iim']['loop']-1;
if ($this->_sections['iim']['show']) {
    $this->_sections['iim']['total'] = $this->_sections['iim']['loop'];
    if ($this->_sections['iim']['total'] == 0)
        $this->_sections['iim']['show'] = false;
} else
    $this->_sections['iim']['total'] = 0;
if ($this->_sections['iim']['show']):

            for ($this->_sections['iim']['index'] = $this->_sections['iim']['start'], $this->_sections['iim']['iteration'] = 1;
                 $this->_sections['iim']['iteration'] <= $this->_sections['iim']['total'];
                 $this->_sections['iim']['index'] += $this->_sections['iim']['step'], $this->_sections['iim']['iteration']++):
$this->_sections['iim']['rownum'] = $this->_sections['iim']['iteration'];
$this->_sections['iim']['index_prev'] = $this->_sections['iim']['index'] - $this->_sections['iim']['step'];
$this->_sections['iim']['index_next'] = $this->_sections['iim']['index'] + $this->_sections['iim']['step'];
$this->_sections['iim']['first']      = ($this->_sections['iim']['iteration'] == 1);
$this->_sections['iim']['last']       = ($this->_sections['iim']['iteration'] == $this->_sections['iim']['total']);
?>
                            <tr>
								<td style="width:90%"><b><?php if ($this->_tpl_vars['action'] == 'deleted' && $this->_tpl_vars['ui']['uid'] == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['toid']): ?>From<?php else: ?>To<?php endif; ?>:&nbsp;&nbsp;</b><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php?uid=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['uid']; ?>
" class="f12 color_green"><?php if (1 == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['status']):  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['name'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['company'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp) : smarty_modifier_wordwrap($_tmp));  endif; ?></a><span><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['sendtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y %I:%M %p") : smarty_modifier_date_format($_tmp, "%m/%d/%Y %I:%M %p")))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span>
                                <?php if ($this->_tpl_vars['action'] == 'deleted'): ?><b><?php if ($this->_tpl_vars['ui']['uid'] == $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['toid']): ?>[Inbox]<?php else: ?>[Sent Message]<?php endif; ?></b><?php endif; ?>
                                <br />
                                <b>Subject:</b> <a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=read&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" class="f10 color_grey"><?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['subject']; ?>
</a><br />
                                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mess'][$this->_sections['iim']['index']]['message'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "...") : smarty_modifier_truncate($_tmp, 200, "...")); ?>
<br />
								<a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=read&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
">more</a>
								</td>
								<td class="end2"><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
&add_action=delete&id=<?php echo $this->_tpl_vars['mess'][$this->_sections['iim']['index']]['id']; ?>
" onClick="if (!confirmLink(this, 'Are you sure you want to delete this message?')) return false;"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
close.gif" alt="#" /></a></td>
							</tr>
							<?php endfor; endif; ?>
						   	<?php if ($this->_tpl_vars['mess']): ?>
                            <tr>
						    	<td class="nav-mail">
                                    <?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_tpl_vars['pvstart'],'y' => $this->_tpl_vars['ResOnPage'],'assign' => 'sum'), $this);?>

                                    Showing  <?php echo $this->_tpl_vars['pvstart']+1; ?>
 to <?php if ($this->_tpl_vars['sum'] > $this->_tpl_vars['mess_cnt']):  echo $this->_tpl_vars['mess_cnt'];  else:  echo $this->_tpl_vars['sum'];  endif; ?> of <?php echo $this->_tpl_vars['mess_cnt']; ?>
 messages 
                                </td>
							    <td class="nav-mail" align="right">
                                	<?php if ($this->_tpl_vars['curPage'] > 0): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']-$this->_tpl_vars['ResOnPage']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
">PREV</a><?php else: ?><span>PREV</span><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php $_from = $this->_tpl_vars['pgArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['i']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['pvstart']): ?> style="font-weight: bold; color:#666; text-decoration: none;"<?php endif; ?>><?php echo ($this->_foreach['n']['iteration']-1)+1; ?>
</a><?php endforeach; else: ?><b>1</b><?php endif; unset($_from); ?>&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['curPage'] < $this->_tpl_vars['pages']-1): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
mc.php?mod=mc&action=<?php echo $this->_tpl_vars['action']; ?>
&pvstart=<?php echo $this->_tpl_vars['pvstart']+$this->_tpl_vars['ResOnPage']; ?>
&order=<?php echo $this->_tpl_vars['order']; ?>
">Next</a><?php else: ?><span>Next</span><?php endif; ?>							     
							    </td>
						    </tr>
                            <?php else: ?>
                            <tr>
                                <td><p>Contacts not found</p></td>
                            </tr>
                            <?php endif; ?>
						    </table>                        
                            <?php endif; ?>

                        <?php elseif ($this->_tpl_vars['add_action'] == 'read'): ?>
                        
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/mc/_read.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        
                        <?php elseif ($this->_tpl_vars['add_action'] == 'reply' && $this->_tpl_vars['action'] == 'inbox'): ?>
				        
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mods/member/mc/_reply.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        
                        <?php endif; ?>	
                        <?php endif; ?>
                            &nbsp;
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
<!-- /Content -->