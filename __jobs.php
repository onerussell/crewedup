<?php 
/*
 * Jobs
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */
    require '_top.php';
    //$gSmarty -> assign('mod', 'profile');
    
    // *************************************************************
    // Main part
    // *************************************************************
      
try {
	    
   require_once CLASS_PATH . 'View/Acc/Pagging.php'; 
   require_once 'includes/xmljobs.class.php';
   
   
	$bc['All Jobs']   = PATH_ROOT.'jobs.php';
	$gSmarty->assign('menu_act' , 3);
	$gSmarty->assign('bc', $bc );
	
	
	//switch ($act)
	//{
	//	case prefs:
	if (isset($_GET['act']) && $_GET['act'] == prefs)
			{
			$fromage = isset($_GET['fromage']) ? urlencode($_GET['fromage']) : '30';
			$distance = isset($_GET['distance']) ? urlencode($_GET['distance']) : '25';
			$perpage = isset($_GET['perpage']) ? urlencode($_GET['perpage']) : '15';
			$target = isset($_GET['target']) ? urlencode($_GET['target']) : urlencode('_self');
			$year = time()*60*60*24*365; // $year = 365 days
			setcookie(fromage, $fromage, $year);
			setcookie(distance, $distance, $year);
			setcookie(perpage, $perpage, $year);
			setcookie(target, $target, $year);
			$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/prefs.html'));
		}
	/*foreach ($_COOKIE as $key => $val)
		echo "$key => $val<br />";
		*/
	$what = isset($_GET['what']) && !empty($_GET['what']) ? urlencode($_GET['what']) : 'TV';
	$where = isset($_GET['where']) && !empty($_GET['where']) ? urlencode($_GET['where']) : 'Los+Angeles+CA' ;
	$page = isset($_GET['page']) && !empty($_GET['page']) ? urlencode($_GET['page']) : '1';
	$sortby = isset($_GET['sortby']) ? urlencode($_GET['sortby']) : '' ;
	$sort = isset($_GET['sort']) ? urlencode($_GET['sort']) : '' ;
	
	$distance = isset($_COOKIE['distance']) ? $_COOKIE['distance'] : '25';
	$fromage = isset($_COOKIE['fromage']) ? $_COOKIE['fromage'] : '30';
	$perpage = isset($_COOKIE['perpage']) ? $_COOKIE['perpage'] : '15';
	$sort_by = isset($_COOKIE['sort_by']) ? urlencode($_COOKIE['sort_by']) : urlencode('relevance');
		
	$gSmarty->assign('title', "$what in $where");
	
			
	$xmlData = new XMLJobs();
	$xmlData->Init($what,$where,$distance,$fromage,$sort_by);
	//$xmlData->$userip = urlencode($_SERVER['REMOTE_ADDR']);
	//$xmlData->$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
	
	$data = $xmlData->FetchPage($what,$where,$page,$sortby,$sort);
	$gSmarty->assign('data', $data);
	$var = $xmlData->arrcnt;
	
	if ( $var/$perpage > 1)
		if ($var%$perpage == 0)
		{
			$tp = $var/$perpage;
		}
		else
		{
			$tp = ($var/$perpage) + 1;
		}
	else 
	{
		$tp = 1;
	}
	$gSmarty->assign('what', $what);
	$gSmarty->assign('where', $where);
	
	$gSmarty->assign('_where', urldecode($where));

	if (!empty($sortby)) 
		{
			$gSmarty ->assign('sortby', $sortby);
			$gSmarty->assign('sort', $sort);
		}

		
	$gSmarty->assign('page', $page);
	if (count($xmlData->companies)>15)
		$gSmarty->assign('companies',array_slice($xmlData->companies, 0, 15));
	else $gSmarty->assign('companies', $xmlData->companies);
	
	if (count($xmlData->titles)>15)
		$gSmarty->assign('titles', array_slice($xmlData->titles, 0, 15));
	else $gSmarty->assign('titles', $xmlData->titles);
	
	if (count($xmlData->locations)>15)
		$gSmarty->assign('locations', array_slice($xmlData->locations, 0, 15));
	else $gSmarty->assign('locations', $xmlData->locations);
	
	
	$gSmarty->assign('tp', $tp);
	
	$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/jobs.html'));
	
	}
	
catch (Exception $exc)
{
    sc_error($exc);
}
    if (!empty($_REQUEST['print']))
	    $gSmarty -> display('print.html');
	else
	    $gSmarty -> display('main.html');
#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>
