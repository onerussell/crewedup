<?php
/**
 * Company roster
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */

    require '_top.php';
    $gSmarty -> assign('mod', 'roster');
        
try
{
    if (empty($uid))
        page404();
    
    if ( $is_user && UID == $uid )
        $ui =& $uinfo;  
    else
    {
        $ui =& $gUser -> Get( $uid );
        if (empty($ui))
            uni_redirect( PATH_ROOT . '?mod=login');
    } 
    $gSmarty -> assign_by_ref('ui', $ui);    

    require_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
    
    /** Get Blog in right menu */               
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
     
    /** some gears in right menu */
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
     
    /** Last added contacts in right menu */
    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));

    require_once CLASS_PATH . 'Model/Main/Model_Main_Roster.php';
    $gRoster =& new Model_Main_Roster($gDb, array('roster' => TB.'roster', 'users' => TB.'users'));
    
    
	switch ($mod)
    {   
    	case 'add':
    		$fid = (isset($_REQUEST['fid']) && is_numeric($_REQUEST['fid']) && $_REQUEST['fid']) ? $_REQUEST['fid'] : 0;

    		if (!$fid)
    	    	uni_redirect(PATH_ROOT.'roster.php');

    	    $uCinfo =& $gUser -> Get($fid);

    	    if (!is_array($uCinfo) || 0 == count($uCinfo))
    	    	uni_redirect(PATH_ROOT.'roster.php');
    	        	    
    	    if (isset($_POST['add']))
    	    {
    	    	$rf = $gRoster -> Add(UID, $fid);
    	    	uni_redirect(PATH_ROOT.'roster.php?fadd=1');
    	    }
    	    $gSmarty -> assign_by_ref('uf', $uCinfo);
    	    
            $gSmarty -> assign_by_ref('bc', $bc);
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/employer/roster/_add.html'));	
    	break;	
    		
    	case 'del':
    		$fid = (isset($_REQUEST['fid']) && is_numeric($_REQUEST['fid']) && $_REQUEST['fid']) ? $_REQUEST['fid'] : 0;
    	    if ($fid && UID != $fid)    
    	    {
    	    	$gRoster -> Del(UID, $fid);
    	    	uni_redirect(PATH_ROOT.'roster.php?fdel=1');
    	    }
    	    uni_redirect(PATH_ROOT.'roster.php');
    	break;
    	
        default:
        	
        	$uCinfo =& $gUser -> Get($uid);
        	
            //invites || friends
        	$inv    =  (isset($_REQUEST['inv']) && in_array($_REQUEST['inv'], array(0, 1))) ? $_REQUEST['inv'] : 0; 
        	$gSmarty -> assign('inv', $inv);
        	
        	$gSmarty -> assign_by_ref('ustatus', $ustatus);
        	require_once CLASS_PATH . 'View/Acc/Pagging.php';
             
        	$gSmarty -> assign('page', $page);
        	
           
        	        
            $pcnt    =  10;
            $la      = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
            	                     'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); 
            $letter  = (!empty($_REQUEST['letter']) && in_array(strtoupper($_REQUEST['letter']), $la)) ? strtoupper($_REQUEST['letter']) : '';
            $sstr    = (!empty($_REQUEST['sstr'])) ? strip_tags($_REQUEST['sstr']) : '';
            $gSmarty -> assign('letter', $letter);
            $gSmarty -> assign('sstr', $sstr);
            	    
            $rcnt    =  $gRoster -> GetCount($uid, -1, $letter, $sstr);
            $mpage   =   new Pagging($pcnt,
                                     $rcnt,
                                     $page,
                                     PATH_ROOT . 'friend.php?uid='.$uid);
            $gSmarty -> assign('rcnt', $rcnt);
            $range   =& $mpage -> GetRange();
            $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
            $pl      =& $gRoster -> GetList($uid, $range[0], $pcnt, $letter, $sstr);
            $gSmarty -> assign_by_ref('pl', $pl); 
            $gSmarty -> assign('plc', count($pl)); 
            $gSmarty -> assign('pagging',  $mpage   -> Make());  
                    
            require_once CLASS_PATH.'Model/Geografy/Main.class.php';
            $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
            $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
                    
            $gSmarty -> assign_by_ref('la', $la);
            $gSmarty -> assign_by_ref('bc', $bc);
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/employer/roster/_roster_res.html'));	        	 
    }

    $gSmarty -> display('main.html'); 
    
}
catch (Exception $exc)
{
    sc_error($exc);
}    

#*************************************************************
# End part
#*************************************************************
    $gDb -> disconnect();
?>