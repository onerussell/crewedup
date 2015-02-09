<?php
require_once dirname(__FILE__).'/siteadmin/includes/config/main.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CrewedUp</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=PATH_ROOT?>includes/templates/css/styles.css" rel="stylesheet" type="text/css" />
<link href="<?=PATH_ROOT?>includes/templates/css/forms.css" rel="stylesheet" type="text/css" />
<link href="<?=PATH_ROOT?>includes/templates/css/curve.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"> 
    var siteAdr = '<?=PATH_ROOT?>';
</script>
<script type="text/javascript" src="<?=PATH_ROOT?>includes/templates/js/base.js"></script>
<script type="text/javascript" src="<?=PATH_ROOT?>includes/templates/js/JsHttpRequest.js"></script>
 
<!--[if gte IE 5.5000]>
<script type="text/javascript" src="<?=PATH_ROOT?>includes/templates/js/png.js"></script>
<![endif]-->
</head>
<body>
<div class="main-cont">
<span id="search_res"><!-- --></span>
 
<!-- Header -->
<div id="header">
	<div class="logo"><a href="<?=PATH_ROOT?>" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/logo.gif" alt="CrewedUp.com" /></a></div>
</div>
<!-- /Header -->
<!-- Menu -->
<div class="menu-main">
	<ul>
		<li><p><a href="<?=PATH_ROOT?>" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu01.png" alt="Home Page" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>profile.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>profile.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu02.png" alt="My CrewedUp" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>jobs.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>jobs.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu03.png" alt="Jobs" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>employers.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>employers.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu04.png" alt="Employers" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>crew.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>crew.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu05.png" alt="Crew Members" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>gear.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>gear.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu06.png" alt="Gear" /></a></p></li>
		<li onclick="Go('<?=PATH_ROOT?>film2tv.php');" style="cursor: hand;"><p><a href="<?=PATH_ROOT?>film2tv.php" rel="nofollow"><img src="<?=PATH_ROOT?>includes/templates/images/menu08.png" alt="Films2Tv.com" style="margin-top:1px;" /></a></p></li>
	</ul>
	<div class="search">
		<form method="post" action="<?=PATH_ROOT?>search.php">
			<input class="searchtxt" id="sstr" name="sstr" type="text" value="Search site" onclick="if ('Search site' == this.value) this.value = '';" onkeyup="ShowDelay(_v('sstr').value, 'sstr', 'search_res', '0', 'search_wait' ); return false;" /><input class="search-b" type="submit" value="" />
		</form>
	</div>
    </div><!-- /Menu -->
<!-- Content -->
<div class="content">
	<div class="info-box">
		<div class="clear">&nbsp;</div>
		<p>
		    <b>Page not found</b>
		</p>
		
	</div>
</div>
 
<!-- /Content -->
<!-- Footer -->
<!-- Footer -->
<div id="footer">
	<p><a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=about" rel="nofollow">About Us</a>|<a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=contactus" rel="nofollow">Contact Us</a>|<a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=privacy" rel="nofollow">Privacy Policy</a>|<a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=terms" rel="nofollow">Terms</a>|<a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=promo" rel="nofollow">Promotion</a>|<a href="<?=PATH_ROOT?>index.php?mod=page&amp;pn=advert" rel="nofollow">Advertise</a></p>
	<p>&copy; 2009 Crewed Up. All Rights Reserved.<br /><a style="font-size:11px; margin:0; text-decoration:none" href="http://engine37.com" rel="nofollow">Powered by engine37</a></p>
</div><!-- /Footer -->
 
</div>
</body>
</html>