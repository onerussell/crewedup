<?php /* Smarty version 2.6.11, created on 2010-05-23 11:32:04
         compiled from mods/jobs/_one.html */ ?>
	
<div class="content">
	<table id="main-table">
		<tr>
			<td class="left">

				<table>
					<tr>
						<td width="210"><p class="top-title"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
title/jobs.gif" alt="Jobs" /></p></td>
						<td></td>
					</tr>
				</table>	
                
                <?php if ($this->_tpl_vars['is_user'] && 2 == $this->_tpl_vars['UserInfo']['status']): ?>    
                    <p class="gear-add"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
gear_add_ico.gif" alt="Plus" /><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?mod=add">Post new job</a></p>
				    <div id="drop"><!-- --></div>
                <?php endif; ?>   
                
                <div class="grey-box-top">&nbsp;</div>
				<div class="grey-box-bg">

					<div class="comments-close"><?php if ($this->_tpl_vars['system_login'] && $this->_tpl_vars['fi']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;mod=del"><img src="<?php echo $this->_tpl_vars['imgDir']; ?>
crestik.gif" alt="Delete" /></a><?php endif; ?></div>
                    <p class="color_blue"><font style="font-size:18px"><?php echo $this->_tpl_vars['fi']['job_title']; ?>
</font><br  />Start Date: <?php echo $this->_tpl_vars['fi']['sd'];  if ($this->_tpl_vars['fi']['cid']): ?><br  />Category: <?php echo $this->_tpl_vars['fi']['cid'];  endif;  if ($this->_tpl_vars['fi']['show_proj'] && $this->_tpl_vars['fi']['project_title']): ?><br  />Project: <?php echo $this->_tpl_vars['fi']['project_title'];  endif; ?><br />Company: <?php if ($this->_tpl_vars['fi']['isRSS'] == 'NOT'): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
profile<?php echo $this->_tpl_vars['fi']['uid']; ?>
" style="font-size: 12px;"><?php echo $this->_tpl_vars['ui']['company']; ?>
</a><?php else:  echo $this->_tpl_vars['fi']['rssCompany'];  endif; ?> - <?php if ($this->_tpl_vars['fi']['therssCompany'] == 'MTV'): ?><form name="job" action="http://jobhuntweb.viacom.com/jobhunt/main/displayjob1.asp" method="post">
<input type="hidden" id="jobid" name="jobid" value="<?php echo $this->_tpl_vars['fi']['theJobURL']; ?>
"><input type="submit" value="Apply for this job">
</form><?php else: ?><form name="job" action="<?php echo $this->_tpl_vars['fi']['theJobURL']; ?>
" method="post">
<input type="submit" value="Apply for this job">
</form><?php endif; ?></p>
					<div class="clear"><!-- --></div>
                    <br /><p><?php echo $this->_tpl_vars['fi']['descr']; ?>
</p>
                    <div style="width: 100%; height:1px;"><!-- --></div>
                    <div id="drop"><!-- --></div> 
                    <br />
                    <p>
					<?php if ($this->_tpl_vars['system_login']):  if ($this->_tpl_vars['fi']['uid'] == $this->_tpl_vars['UserInfo']['uid']): ?><a href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php?id=<?php echo $this->_tpl_vars['fi']['id']; ?>
&amp;mod=add" class="f11">Edit</a> | <?php endif;  endif; ?>
                    <a class="f11" href="<?php echo $this->_tpl_vars['siteAdr']; ?>
jobs.php">Back to Jobs</a>
                    </p>        		
                </div>
                <div class="grey-box-bottom">&nbsp;</div>
			</td>
		</tr>
	</table>
</div>