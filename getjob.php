<?php 
   	
	require_once 'includes/xmljobs.class.php';
   	require_once 'siteadmin/includes/classes/Ctrl/Ajax/JsHttpRequest.php';
   
   
	
	
	$JsHttpRequest =& new JsHttpRequest('utf-8');
	$act = $_REQUEST['act'];
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
	$fromage = isset($_COOKIE['fromage']) ? $_COOKIE['fromage'] : '30';
	$distance = isset($_COOKIE['radius']) ? $_COOKIE['radius'] : '25';
	$perpage = isset($_COOKIE['limit']) ? $_COOKIE['limit'] : '15';
	$target = isset($_COOKIE['target']) ? $_COOKIE['target'] : '_self';
	$year = mktime()*60*60*24*365; // $year = 365 days*/
	
	echo '$_COOKIE["fromage"]'.$_COOKIE["fromage"].'<br>';
	echo '$_COOKIE["radius"]'.$_COOKIE["radius"].'<br>';
	echo '$_COOKIE["limit"]'.$_COOKIE["limit"].'<br>';
	echo '$_COOKIE["target"]'.$_COOKIE["target"].'<br>';
 switch ($act)
	{
		case "1": //search
			{
				$what = urlencode($_REQUEST['what']);
				$where = urlencode($_REQUEST['where']);
				//$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? urlencode($_REQUEST['page']) : '1';
				//$sortby = isset($_REQUEST['sortby']) ? urlencode($_REQUEST['sortby']) : '' ;
				//$sort = isset($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : '' ;

				
				 $xmlData = new XMLJobs();
				 $xmlData->Init($what,$where,$distance,$fromage);
				 $data = $xmlData->FetchPage($perpage);
				//$xmlData->$userip = urlencode($_SERVER['REMOTE_ADDR']);
				//$xmlData->$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
				 // $data = $xmlData->FetchPage($what,$where,$page,$sortby,$sort);
				//$gSmarty->assign('data', $data);
				 $var = $xmlData->arrcnt;

				if ( $var/$perpage > 1)
					{
						if ($var%$perpage == 0) 
						{
							$tp = $var/$perpage;
						} else {
							$tp = ($var/$perpage) + 1;
						}
					} else {
						$tp = 1;
					}

				foreach ($data as $jobs)
				$_jobs .= '<form><input type="hidden" id="sortby" value="'.$sortby.'">
				<input type="hidden" id="sort" value="'.$sort.'">
				<input type="hidden" id="num" value="'.$page.'"></form>
				<div class="jobcontent"><a onmousedown="'. $jobs['onmousedown'] .'" href="'
				.'http://www.indeed.com/rc/clk?jk='.$jobs['jobkey']
				//.$jobs['url']
				.'" target="'.$target.'"><p>'.$jobs['title'].'</p></a><br>'
				.$jobs['company'].'<br><div class="jobcontent-snippet">'.$jobs['snippet'].'</div><br>FROM:'.$jobs['source'].' - '.$jobs['age']. ' - <a onmousedown=' .$jobs['onmousedown']. ' href="'
				.'http://www.indeed.com/rc/clk?jk='.$jobs['jobkey']
				//.$jobs['url']
				.'">more</a><br>&nbsp;</div>';
				
				foreach($xmlData->companies as $cmp => $val)
				$_cmp .= '<li class="jobfilter"><a href="javascript: void(0);" onmousedown=\'JobFilter(1,"'.$cmp.'")\'>'.$cmp.' (<b>'.$val.'</b>)</li>';
				
				foreach($xmlData->titles as $cmp => $val)
				$_ttl .= '<li class="jobfilter"><a href="javascript: void(0);" onmousedown=\'JobFilter(2,"'.$cmp.'")\'>'.$cmp.'(<b>'.$val.'</b>)</li>';
				
				foreach($xmlData->locations as $cmp => $val)
				$_loc .= '<li class="jobfilter"><a href="javascript: void(0);" onmousedown=\'JobFilter(3,"'.$cmp.'")\'>'.$cmp.'(<b>'.$val.'</b>)</li>';
				
				if ($page > 1) $_pagenum = '<a href="javascript: void(0);" onmousedown=ChPg("-1")> prev </a>';
				    else $_pagenum = 'prev';
				$_pagenum .= "  $page  ";

				if ($page < $tp) $_pagenum .= '<a href="javascript: void(0);" onmousedown=ChPg("1")> next </a>';
				    else $_pagenum .= 'next';
				
				$_RESULT = array (
				act => $act,
				company => $_cmp,
				title => $_ttl,
				location => $_loc,
				jobs => $_jobs,
				pagenum => $_pagenum);
				echo $tp;
				echo "<pre>";
				echo "<b>QUERY_STRING:</b> ". $_SERVER['QUERY_STRING'] . "\n";
				echo "<b>REQUEST:</b> ". $GLOBALS['_REQUEST'] . "\n";
				break;
			}
		case 2:{/*
			$as_and =	$_REQUEST['as_and'];
    			$as_phr =	$_REQUEST['as_phr'];
    			$as_any = 	$_REQUEST['as_any'];
    			$as_not =	$_REQUEST['as_not'];
    			$as_ttl =	$_REQUEST['as_ttl'];
    			$as_cmp =	$_REQUEST['as_cmp'];
    			$as_jt  =	$_REQUEST['as_jt'];
    			$as_st =	$_REQUEST['as_st'];
    			$as_salary =	$_REQUEST['as_salary'];
    			$as_radius =	$_REQUEST['as_radius'];
    			$where =	$_REQUEST['where'];
    			$as_fromage
    			$as_limit
    			$as_sort			    
*/			    break;} //adv search
		case 3: {

				$what = urlencode($_REQUEST['what']);
				$where = urlencode($_REQUEST['where']);
				$sortby = $_REQUEST['sortby'];
				$sort = urlencode($_REQUEST['sort']);
				
				//$sortby = isset($_REQUEST['sortby']) ? urlencode($_REQUEST['sortby']) : '' ;
				//$sort = isset($_REQUEST['sort']) ? urlencode($_REQUEST['sort']) : '' ;


				 $xmlData = new XMLJobs();
				 $xmlData->Init($what,$where,$distance,$fromage);
				 $data = $xmlData->FetchPage($perpage,$page,$sortby,$sort);
				//$xmlData->$userip = urlencode($_SERVER['REMOTE_ADDR']);
				//$xmlData->$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
				 // $data = $xmlData->FetchPage($what,$where,$page,$sortby,$sort);
				//$gSmarty->assign('data', $data);
				 $var = $xmlData->arrcnt;

				if ( $var/$perpage <= 1)
					{ $tp = 1; }
					elseif ($var%$perpage == 0) {
							$tp = $var/$perpage;
						} else {
							    $tmp = $var%$perpage;
							$tp = (($var-$tmp)/$perpage) + 1;
						}

			    foreach ($data as $jobs)
				$_jobs .= '<form><input type="hidden" id="sortby" value="'.$sortby.'">
				<input type="hidden" id="sort" value="'.urldecode($sort).'">
				<input type="hidden" id="num" value="'.$page.'"></form><div class="jobcontent"><a href="http://www.indeed.com/rc/clk?jk='.$jobs['jobkey'].'" target="'.$target.'"><p>'.$jobs['title'].'</p></a><br>'
				.$jobs['company'].'<br><div class="jobcontent-snippet">'.$jobs['snippet'].'</div><br>FROM:'.$jobs['source'].' - '.$jobs['age']. ' - <a href="http://www.indeed.com/rc/clk?jk='.$jobs['jobkey'].'">more</a><br>&nbsp;</div>';
    if ($page > 1) $_pagenum = '<a href="javascript: void(0);" onmousedown=ChPg("-1")> prev </a>';
				    else $_pagenum = 'prev';
				$_pagenum .= "  $page  ";

				if ($page < $tp) $_pagenum .= '<a href="javascript: void(0);" onmousedown=ChPg("1")> next </a>';
				    else $_pagenum .= 'next';

				$_RESULT = array (
				act => $act,
				company => $_cmp,
				title => $_ttl,
				location => $_loc,
				jobs => $_jobs,
				pagenum => $_pagenum);
				break;}
		case 4: {
		//$year = time()*60*60*24*365;
		$_1 = SetCookie(perpage, $_REQUEST['limit'], $year);
		$_2 = SetCookie(fromage, $_REQUEST['fromage'], $year);
		$_3 = SetCookie(target, $_REQUEST['target'], $year);
		$_4 = SetCookie(distance, $_REQUEST['radius'], $year);
		//if($_1 && $_2 && $_3 && $_4)
		//$_RESULT = array (status => 'OK');
		echo "<pre>OK</pre>";
		break;
		 // page
		
	}
}
				
/*
				$GLOBALS['_RESULT'] = array(
				jobs => $data,
				companies => $xmlData->companies,
				locations => $xmlData->locations,
				titles=> $xmlData->titles,
				page => $page
				);
				//$GLOBALS['_RESULT'] = "result";

echo "<pre>";
?>
<b>QUERY_STRING:</b> <?=$_SERVER['QUERY_STRING'] . "\n"?>
<b>Uploaded files:</b> <?=print_r($_FILES, 1)?>
<?php
echo "</pre>";
// This includes a PHP fatal error! It will go to the debug stream,
// frontend may intercept this and act a reaction.
if ($_REQUEST['str'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}

			//}
/*
			
			
		case "prefs":
			{	
				//	Get params
				$fromage = $_REQUEST['fromage'];
				$distance = $_REQUEST['distance'];
				$perpage = $_REQUEST['perpage'];
				$target = $_REQUEST['target'];
				
				//	Save to cookies
				SetCookie(fromage, $fromage, $year);
				SetCookie(distance, $distance, $year);
				SetCookie(perpage, $perpage, $year);
				SetCookie(target, $target, $year);
				
			}
	}
	
//}

okie(perpage, $perpage, $year);
				SetCookie(target, $target, $year);
				
			}
	}
	*/
//}
?>