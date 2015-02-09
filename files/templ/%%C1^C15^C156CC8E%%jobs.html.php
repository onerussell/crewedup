<?php /* Smarty version 2.6.11, created on 2011-02-17 11:24:21
         compiled from mods/jobs/jobs.html */ ?>
<script type="text/javascript" src="http://www.indeed.com/ads/apiresults.js">
var page = 1;
</script>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['stlDir']; ?>
jobs.css">


<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" >	

	



<table width="760" border=0>
    <tr id=head height=50><td>

	<table>
	    <tr><td><img src="/includes/templates/images/title/all_jobs.gif" alt="All Jobs" style="padding-left: 50px;"/></td>
	    <td><a href="http://www.indeed.com/p/postjob.php?pid=8253132128796554" rel="nofollow" rel="nofollow"><p style='font-size: 24px;padding-top: 8px;'>Post new job</p></a>
	    </td></tr>
	</table>

    </td></tr>

    <tr><td>
	<table width=760 height=50 border=0>
	<tr height=10><td width=150></td><td width=460></td><td width=150><a href="includes/templates/mods/jobs/prefs.html" class="lightwindow">Preferences</a></td></tr>
	<tr height=30><td></td><td><form  method="get" action="jobs.php">
		<b>What</b>:<input type="text" name="q" size=20 maxlength=512 id="what_form" value="<?php echo $this->_tpl_vars['what']; ?>
">
		<b>Where</b>:<input type="text" name="l" size=20 maxlength=512 id="where_form" value="<?php echo $this->_tpl_vars['where']; ?>
">
		<input type="submit" value="Search">	</form></td><td></td></tr>
	<tr height=10><td></td><td></td><td></td></tr></table>
    </td></tr>

<tr><td><table border=0><tr><td width=200>
<div class="jobfilter">
	<ul style="display: block; margin-left: 0px;">
	
		<a href="javascript: void(0);" onmousedown=ChgView(1) style="color: black;">
			<p style="font-size: 16px; color: black;">Companies</p>
		</a>
		<ul id="1" class="jobfilter" style="display: none; padding-left: 0px;">&nbsp;</ul>
		</ul>	
	
	<ul style="display: block; margin-left: 0px;">

	
		<a href="javascript: void(0);" onmousedown=ChgView(2) style="color: black;">
			<p style="font-size: 16px; color: black;">Titles</p>
		</a>
		<ul id="2" class="jobfilter" style="display: none; padding-left: 0px;">&nbsp;</ul>
		</ul>
		
	<ul style="display: block; margin-left: 0px;">

	
		<a href="javascript: void(0);" onmousedown=ChgView(3) style="color: black;">
			<p style="font-size: 16px; color: black;">Locations</p>
		</a>
		<ul id="3" class="jobfilter" style="display: none; padding-left: 0px;">&nbsp;</ul>
	</ul>
</div>
</td>
<td>
    <div id="4" style="width: 550; border: 0px solid; solid: #000">
	&nbsp; 
    </div>
</td></tr>
<tr><td></td><td><table width=760 border=0><tr><td width=330></td><td id="pagenum"></td><td width=330></td></tr></table>
</td></tr>									    
</table>
</table>




<div style="border: 1px solid; display: none" id="debug">&nbsp;</div>
<span id=indeed_at><a href="http://www.indeed.com/">jobs</a> by <a
href="http://www.indeed.com/" title="Job Search"><img
src="http://www.indeed.com/p/jobsearch.gif" style="border: 0;
vertical-align: middle;" alt="Indeed job search"></a></span>
</div>