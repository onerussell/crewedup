<?php
/**
 * Film2Tv controller
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */

    require '_top.php';
    
    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/film2tv/_coming.html'));
    $gSmarty -> display('main.html'); 
    $gDb -> disconnect();
    exit();
    
    require_once CLASS_PATH . 'Model/Main/Model_Film2Tv.php'; 
    $gFm =& new Model_Main_Film2Tv( $gDb );
    
    $gSmarty -> assign('mod', 'film2tv');
    $gSmarty -> assign('menu_act', 7);
    if ( $is_user && UID == $uid )
    {           
        $ui =& $uinfo;  
        $gSmarty -> assign_by_ref('ui', $ui);      
    }
    elseif (!empty($uid))
    {
        $ui =& $gUser -> Get( $uid );   
        $gSmarty -> assign_by_ref('ui', $ui);           
    } 
   
	$ctg = (int)_v('ctg');
    $id  = (int)_v('id');
	
try
{	
    if (!$ctg && !$id)
    {
    	/** first page */
    	$pl  = $gFm -> GetCatList();
        $gSmarty -> assign_by_ref('pl', $pl);
        for ($i = 0; $i < count($pl); $i++)
        {
        	$pl[$i]['cnt'] = $gFm -> GetItemsCount( $pl[$i]['id'] );
        }
        $gSmarty -> assign_by_ref('plc', ceil( count($pl) / 2 ));
        
    	$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/film2tv/_main.html'));
    }
    elseif ( $ctg && !$id)
    {
    	/** films list */
    	$ci = $gFm -> GetCat($ctg);
    	if (empty($ci))
    	{
    		uni_redirect( PATH_ROOT . 'film2tv.php' );
    	}
    	$gSmarty -> assign_by_ref('ci', $ci);
    	include_once CLASS_PATH . 'View/Acc/Pagging.php';
    	$pcnt    =  10;
        $rcnt    =  $gFm -> GetItemsCount( $ctg );
        $mpage   =   new Pagging($pcnt,
                                  $rcnt,
                                  $page,
                                  PATH_ROOT . 'film2tv.php?ctg='.$ctg);
        $gSmarty -> assign('rcnt', $rcnt);
        $range   =& $mpage -> GetRange();
                    
        $gSmarty -> assign('from', (($page-1) * $pcnt)+1);
        $to = (1 == $page) ? $pcnt :  ((($page-1) * $pcnt)+1 + $pcnt); 
        $gSmarty -> assign('to', $to < $rcnt ? $to : $rcnt); 
                    
        $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
        $pl      =& $gFm -> GetItemsList( $ctg, $range[0], $pcnt);
        $gSmarty -> assign_by_ref('pl', $pl); 
        $gSmarty -> assign('plc', count($pl)); 
        $gSmarty -> assign('pagging',  $mpage   -> Make());  
    	
    	$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/film2tv/_list.html'));
    	 
    }
	elseif ($id)
	{
		/** item */
	    $pi = $gFm -> GetItem( $id );
	    if (empty($pi))
	    {
	    	uni_redirect( PATH_ROOT . 'film2tv.php' );
	    }
	    $ci = $gFm -> GetCat($pi['cid']);
	    
	    $gSmarty -> assign_by_ref('ci', $ci);
	    $gSmarty -> assign_by_ref('pi', $pi);
        $gSmarty -> assign_by_ref( 'ep', $gFm -> GetEpisodes( $pi['id'] ) );
		$gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/film2tv/_show.html'));
	}



    $gSmarty -> display('main.html'); 
    
}
catch (Exception $exc)
{
    sc_error($exc);
}    

require '_bottom.php';
	
?>