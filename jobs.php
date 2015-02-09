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

   $what_ = isset($_GET['q']) ? urlencode($_GET['q']) : "TV";
    $where_ = isset($_GET['l']) ? urlencode($_GET['l']) : "Los+Angeles+CA";
	    
   require_once CLASS_PATH . 'View/Acc/Pagging.php';
   $bc['All Jobs']   = PATH_ROOT.'jobs.php';
   $gSmarty->assign('menu_act' , 3);
   $gSmarty->assign('bc', $bc );
   $gSmarty->assign('what', urldecode($what_));
   $gSmarty->assign('where', urldecode($where_));
   $gSmarty->assign('onload', "JobSearch(1)");
	
	$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/jobs.html'));
	
	}
	
catch (Exception $exc)
{
    sc_error($exc);
}
	    $gSmarty -> display('main.html');
#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>
