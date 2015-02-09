<?php /* Smarty version 2.6.11, created on 2010-04-30 15:44:24
         compiled from _menu.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '_menu.html', 26, false),array('modifier', 'truncate', '_menu.html', 26, false),)), $this); ?>
<div class="menu<?php if ('reg' == $this->_tpl_vars['mod'] || 'page' == $this->_tpl_vars['mod'] || $this->_tpl_vars['index']): ?>-main<?php endif; ?>">
	<ul>
		<li><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu01<?php if ($this->_tpl_vars['index']): ?>_a<?php endif; ?>.png" alt="Home Page" /></a></p></li>
		<li<?php if (2 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu02.png" alt="My CrewedUp" /></a></p></li>
		<li<?php if (3 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu03.png" alt="Jobs" /></a></p></li>
		<li<?php if (4 == $this->_tpl_vars['menu_act'] || 41 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu04.png" alt="Employers" /></a></p></li>
		<li<?php if (5 == $this->_tpl_vars['menu_act'] || 51 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu05.png" alt="Crew Members" /></a></p></li>
		<li<?php if (6 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu06.png" alt="Gear" /></a></p></li>
		<li<?php if (7 == $this->_tpl_vars['menu_act']): ?> class="act"<?php endif; ?> onclick="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
film2tv.php');" style="cursor: hand;"><p><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
film2tv.php"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
menu08.png" alt="Films2Tv.com" style="margin-top:1px;" /></a></p></li>
	</ul>
	<div class="search">
		<form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
search.php">
			<input class="searchtxt" id="sstr" name="sstr" type="text" value="<?php if ($this->_tpl_vars['sstr']):  echo $this->_tpl_vars['sstr'];  else: ?>Search site<?php endif; ?>" onclick="if ('Search site' == this.value) this.value = '';" onkeyup="ShowDelay(_v('sstr').value, 'sstr', 'search_res', '<?php if ($this->_tpl_vars['index']): ?>1<?php else: ?>0<?php endif; ?>', 'search_wait' ); return false;" /><input class="search-b" type="submit" value="" />
		</form>
	</div>
    <?php if ($this->_tpl_vars['bc']): ?>
	<div style="padding-left:<?php if (2 == $this->_tpl_vars['menu_act']): ?>90<?php elseif (3 == $this->_tpl_vars['menu_act']): ?>180<?php elseif (4 == $this->_tpl_vars['menu_act']): ?>255<?php elseif (41 == $this->_tpl_vars['menu_act']): ?>185<?php elseif (5 == $this->_tpl_vars['menu_act']): ?>370<?php elseif ('51' == $this->_tpl_vars['menu_act']): ?>305<?php elseif (6 == $this->_tpl_vars['menu_act']): ?>500<?php else: ?>40<?php endif; ?>px">
	<div id="drop">
		<ul>
			<?php if ($this->_tpl_vars['bcwl']): ?>
            <li class="pos03 white_tab"><a href="<?php echo $this->_tpl_vars['bcwl']['1']; ?>
"><?php echo $this->_tpl_vars['bcwl']['0']; ?>
</a></li>
            <?php endif; ?>
            
            <?php $_from = $this->_tpl_vars['bc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['n']['iteration']++;
?>
            <?php if (($this->_foreach['n']['iteration'] <= 1)): ?>
            <li class="pos0<?php echo $this->_foreach['n']['iteration']; ?>
 green_tab"><a href="<?php if ($this->_tpl_vars['i']):  echo $this->_tpl_vars['i'];  else: ?>javascript: void(0);<?php endif; ?>"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 37, "...") : smarty_modifier_truncate($_tmp, 37, "...")); ?>
</a></li>	
            <?php elseif (! ($this->_foreach['n']['iteration'] == $this->_foreach['n']['total'])): ?>
            <li class="pos0<?php echo $this->_foreach['n']['iteration']; ?>
 green_tab"><a href="<?php if ($this->_tpl_vars['i']):  echo $this->_tpl_vars['i'];  else: ?>javascript: void(0);<?php endif; ?>"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 37, "...") : smarty_modifier_truncate($_tmp, 37, "...")); ?>
</a></li>
            <?php else: ?>
			<li class="pos0<?php echo $this->_foreach['n']['iteration']; ?>
 grey_tab"><a href="<?php if ($this->_tpl_vars['i']):  echo $this->_tpl_vars['i'];  else: ?>javascript: void(0);<?php endif; ?>"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 37, "...") : smarty_modifier_truncate($_tmp, 37, "...")); ?>
</a></li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
			
            <?php if ($this->_tpl_vars['bcw']): ?>
            <li class="pos0<?php echo $this->_foreach['n']['total']; ?>
 white_tab"><a href="<?php echo $this->_tpl_vars['bcw']['1']; ?>
"><?php echo $this->_tpl_vars['bcw']['0']; ?>
</a></li>
            <?php endif; ?>
            
			<?php if ('jobs' == $this->_tpl_vars['mwd']): ?>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.js"></script>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.bgiframe.js"></script>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.ajaxQueue.js"></script>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['jsDir']; ?>
jquery.autocomplete.js"></script>

            <script type="text/javascript">
            <?php echo '
            // <![CDATA[
                $().ready(function() {

                	function findValueCallback(event, data, formatted) 
                    {
                        Go(siteAdr + \'jobs.php?is_state=1&state=\'+_v(\'state\').value+\'&city=\'+_v(\'city\').value+\'&cat=\'+_v(\'cat\').value);
                	}
                
                	function formatItem(row) 
                    {
                		return row[1];
                	}

                    function formatResult(row) 
                    {
                		return row[1].replace(/(<.+?>)/gi, \'\');
                	}
                
                    $("#cat").autocomplete(siteAdr + \'dict.php?action=get_jobs\', 
                    {
                        delay:       200,
                        cacheLength: 10,
                    	minChars:    3,
                		width: 270,
                		formatItem: formatItem,
                    	formatResult: formatResult
                	});
                	
                    $("#cat").result(findValueCallback).next().click(function()
                    {
                		$(this).prev().search();
                	});
                });
            // ]]>
            '; ?>

            </script>
            <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
jquery.autocomplete.css" />

                <li style="margin-left: 20px;"><select style="font-size: 13px;width:100px;" name="state" id="state" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?is_state=1&state='+_v('state').value+'&city='+_v('city').value+'&cat='+_v('cat').value);" ><option value="0">State</option><?php $_from = $this->_tpl_vars['statea']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['state']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['i']]; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:150px;" name="city" id="city" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?state='+_v('state').value+'&city='+_v('city').value+'&cat='+_v('cat').value);" ><option value="0">City</option><?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['city']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><input type="text" style="font-size: 13px;width:200px;" name="cat" id="cat" value="Category" onfocus="if ('Category' == this.value) this.value='';" onblur="if ('' == this.value) this.value='Category';" />

                </li>
            <?php elseif ('gear' == $this->_tpl_vars['mwd']): ?>
                <?php if ($this->_tpl_vars['ctg']): ?>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:100px;" name="state" id="state" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&is_state=1&state='+_v('state').value+'&city='+_v('city').value);"><option value="0">State</option><?php $_from = $this->_tpl_vars['statea']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['state']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['i']]; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:150px;" name="city"  id="city" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
gear.php?ctg=<?php echo $this->_tpl_vars['ctg']; ?>
&state='+_v('state').value+'&city='+_v('city').value);"><option value="0">City</option><?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['city']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>               
                <?php endif; ?>                                                                       
            <?php elseif ('employers' == $this->_tpl_vars['mwd']): ?>                                                    
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:100px;" name="state" id="state" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php?is_state=1&state='+_v('state').value+'&city='+_v('city').value+'&cat='+_v('cat').value);"><option value="0">State</option><?php $_from = $this->_tpl_vars['statea']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['state']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['i']]; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:150px;" name="city"  id="city" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php?state='+_v('state').value+'&city='+_v('city').value+'&cat='+_v('cat').value);"><option value="0">City</option><?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['city']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:200px;" name="cat"   id="cat" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
employers.php?state='+_v('state').value+'&city='+_v('city').value+'&cat='+_v('cat').value);"><option value="0">Type</option><option value="1"<?php if (1 == $this->_tpl_vars['cat']): ?> selected="1"<?php endif; ?>>production company</option><option value="2"<?php if (2 == $this->_tpl_vars['cat']): ?> selected="1"<?php endif; ?>>rental house</option></select></li>               
            <?php elseif ('crew' == $this->_tpl_vars['mwd'] && ! $this->_tpl_vars['cat_c']): ?>                                              
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:100px;" name="state" id="state" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
&is_state=1&state='+_v('state').value+'&city='+_v('city').value);"><option value="0">State</option><?php $_from = $this->_tpl_vars['statea']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['state']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['states'][$this->_tpl_vars['i']]; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
                <li style="margin-left: 20px;"><select style="font-size: 13px;width:150px;" name="city"  id="city" onchange="Go('<?php echo $this->_tpl_vars['siteAdr']; ?>
crew.php?cat=<?php echo $this->_tpl_vars['cat']; ?>
&state='+_v('state').value+'&city='+_v('city').value);"><option value="0">City</option><?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?><option value="<?php echo $this->_tpl_vars['i']; ?>
"<?php if ($this->_tpl_vars['i'] == $this->_tpl_vars['city']): ?> selected="1"<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></li>
			<?php endif; ?>
		</ul>
	</div>
	</div>    
    <?php endif; ?>
</div>