<?php /* Smarty version 2.6.11, created on 2010-12-27 04:52:46
         compiled from mods/jobs/prefs.html */ ?>
<div>
<form action="jobs.php?act=prefs">
		<input type="submit">
	Show Jobs published: <select name="fromage" >
		<option value="">anytime</option>
		<option value="15">within 15 days</option>
		<option value="7">whithin 7 days</option>
		<option value="3">whithin 3 days</option>
		<option value="1">whithin 1 day</option>
		<option value="0">today only</option>
	</select>
	Show Jobs: <select name="distance">
		<option value="5">whithin 5 miles</option>
		<option value="10">whithin 10 miles</option>
		<option value="15">whithin 15 miles</option>
		<option value="25" selected>whithin 25 miles</option>
		<option value="50">whithin 50 miles</option>
		<option value="100">whithin 100 miles</option>
	</select>
	How many <select name="perpage">
		<option value="10">10 jobs</option>
		<option value="15" selected>15 jobs</option>
		<option value="20">20 jobs</option>
		<option value="30">30 jobs</option>
		<option value="50">50 jobs</option>
	</select>
		<input type="checkbox" value="_blank">
		<input type="submit">

</div>