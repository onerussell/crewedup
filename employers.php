<?php
/**
 * Employers module
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */
    require '_top.php';
    require_once CLASS_PATH . 'View/Acc/Pagging.php';
    
    require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
    $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
    
    
    $gSmarty -> assign('mod', 'employers'); 
    $menu_act         = 4;     
#*************************************************************
# Main part
#*************************************************************
    $bc['All Employers']   = PATH_ROOT.'employers.php';        
                
try
{         
    switch ($action)
    {
        default:
            
            $state = (!empty($_REQUEST['state']) && 2 == strlen($_REQUEST['state'])) ? $_REQUEST['state'] : '';
            $city  = (!empty($_REQUEST['city'])) ? $_REQUEST['city'] : '';
            $cat   = (!empty($_REQUEST['cat'])) ? strip_tags( $_REQUEST['cat'] ) : '';
            
            if (!empty($_REQUEST['is_state']))
                $city = '';    
            
            /** states */
            if (!empty($_SESSION['usere']['statea']))
                $gSmarty -> assign_by_ref('statea', $_SESSION['usere']['statea']);
            else 
            {
                $_SESSION['usere']['statea'] =& $gUser -> GetUserStates( 2 );
                $gSmarty -> assign_by_ref('statea', $_SESSION['usere']['statea']);
            }
            /** cities */

            if (empty($state))
            {
                if (!empty($_SESSION['usere']['cities']))
                    $gSmarty -> assign_by_ref('cities', $_SESSION['usere']['cities']);
                else 
                {
                    $_SESSION['usere']['cities'] =& $gUser -> GetUserCities('', 2);
                    $gSmarty -> assign_by_ref('cities', $_SESSION['usere']['cities']);
                }           
            }
            else
                $gSmarty -> assign_by_ref('cities', $gUser -> GetUserCities($state, 2));

            $gSmarty -> assign('state', $state);
            $gSmarty -> assign('city', $city);
            $gSmarty -> assign('cat', $cat);
                                
            $gSmarty -> assign('page', $page);
            $pcnt     =  20;
            $rcnt     =  $gUser -> Count( 2, 1, $state, $city, $cat );
            $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'employers.php?i=1'.($state ? '&amp;state='.$state : '').($city ? '&amp;city='.$city : '').($cat ? '&amp;cat='.$cat : ''));
            $gSmarty -> assign('rcnt', $rcnt);
            $range   =& $gMpage -> GetRange();
            $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
            $pl =& $gUser -> GetUserList( 1 , 2, 'company', $range[0], $pcnt, 0, $state, $city, $cat);
            
            for ($i = 0; $i < count($pl); $i++)
            {
                $pl[$i]['jobs']     =& $gJobs -> GetLowJobList($pl[$i]['uid'], 0, 4);
            }

            $gSmarty -> assign_by_ref('pl', $pl); 
            $gSmarty -> assign('plc', count($pl)); 
            $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
            
            require_once CLASS_PATH.'Model/Geografy/Main.class.php';
            $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
            $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));

            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/employer/_all.html'));        
            
    }
}
catch (Exception $exc)
{
    sc_error($exc);
}
    
    #Display template
    $gSmarty -> assign('menu_act', $menu_act);
    $gSmarty -> assign_by_ref('bc', $bc);   
    $gSmarty -> display('main.html');

#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>