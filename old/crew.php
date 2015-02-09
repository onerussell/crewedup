<?php
    require '_top.php';
    include_once CLASS_PATH . 'View/Acc/Pagging.php';
    $gSmarty -> assign('mod', 'crew');
    $gSmarty -> assign('mwd', 'crew');
    $menu_act         = 5;   
    $bc['All Members']   = PATH_ROOT.'crew.php';     
#*************************************************************
# Main part
#*************************************************************
    
                
try
{         
    switch ($action)
    {
    	
    	
        default:
            $ca  = $gUser -> GetMembersCat( 1 );
            $cat = (!empty($_REQUEST['cat']) && is_numeric($_REQUEST['cat']) && !empty($ca[$_REQUEST['cat']])) ? $_REQUEST['cat'] : '';
        	
            if (!empty($_REQUEST['tag']))
            {
                $tag = strtolower( trim( strip_tags($_REQUEST['tag']) ) );
                $cat = $gUser -> GetMemberCatByName($tag);
            }
            
            if ($cat)
        	{
                $bc[$ca[$cat]['cat']] = '';
                $gSmarty -> assign('cat', $cat);
                
        	    $state = (!empty($_REQUEST['state']) && 2 == strlen($_REQUEST['state'])) ? $_REQUEST['state'] : '';
                $city  = (!empty($_REQUEST['city'])) ? $_REQUEST['city'] : '';
                
                if (!empty($_REQUEST['is_state']))
                {
                    $city = '';    
                }
            
                /** states */
                if (!empty($_SESSION['userm']['statea']))
                {
                    $gSmarty -> assign_by_ref('statea', $_SESSION['userm']['statea']);
                }
                else 
                {
                    $_SESSION['userm']['statea'] =& $gUser -> GetUserStates( 1 );
                    $gSmarty -> assign_by_ref('statea', $_SESSION['usere']['statea']);
                }
                
                /** cities */
                if (empty($state))
                {
                    if (!empty($_SESSION['userm']['cities']))
                    {
                        $gSmarty -> assign_by_ref('cities', $_SESSION['userm']['cities']);
                    }
                    else 
                    {
                        $_SESSION['userm']['cities'] =& $gUser -> GetUserCities('', 1);
                        $gSmarty -> assign_by_ref('cities', $_SESSION['userm']['cities']);
                    }           
                }
                else
                {
                    $gSmarty -> assign_by_ref('cities', $gUser -> GetUserCities($state, 1));
                }
                $gSmarty -> assign('state', $state);
                $gSmarty -> assign('city', $city);
        	    
                $gSmarty -> assign( 'ci', $ca[$cat] );
                $la      = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
                                     'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); 
                $letter  = (!empty($_REQUEST['letter']) && in_array(strtoupper($_REQUEST['letter']), $la)) ? strtoupper($_REQUEST['letter']) : '';
                $gSmarty -> assign('letter', $letter);
                $gSmarty -> assign_by_ref('la', $la);

                $gSmarty -> assign('page', $page);
                $pcnt     =  20;
                $rcnt     =  $gUser -> Count( 1, 1, $state, $city, $ca[$cat]['cat'], $letter );
          
                $gMpage   =   new Pagging($pcnt,
                                          $rcnt,
                                          $page,
                                          PATH_ROOT . 'crew.php?cat='.$cat.($state ? '&amp;state='.$state : '').($city ? '&amp;city='.$city : ''));
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gUser -> GetUserList( 1 , 1, '', $range[0], $pcnt, 0, $state, $city, $ca[$cat]['cat'], $letter );
                
                if (defined('UID'))
                {
                    if (2 == $uinfo['status'])
                    {
                        /** include roster class */
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Roster.php';
                        $gRoster =& new Model_Main_Roster($gDb, array('roster' => TB.'roster', 'users' => TB.'users'));
                    }   
                    
                    for ($i = 0; $i < count($pl); $i++)
                    {
                        /** friends */
                        $pl[$i]['is_friend'] = $gUser -> CheckFriend(UID, $pl[$i]['uid']); 
                        
                        /** roster */
                        if (2 == $uinfo['status'])
                        {
                            $pl[$i]['is_roster'] = $gRoster -> Check( UID, $pl[$i]['uid'] );
                        }
                    }    
                }

                $gSmarty -> assign_by_ref('pl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
            
                include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
            
        	    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/member/_all.html'));    
        	}
        	else
        	{
        	    $gSmarty -> assign_by_ref('cat', $ca);
        	    $gSmarty -> assign('cat_c', ceil(count($ca)/2));
        	    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/member/_all_cat.html'));   
        	}
    }
}
catch (Exception $exc)
{
    sc_error($exc);
}
    $gSmarty -> assign('menu_act', $menu_act);
    $gSmarty -> assign_by_ref('bc', $bc); 
    #Display template
    $gSmarty -> display('main.html');

#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>