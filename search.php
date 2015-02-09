<?php
/**
 * Search
 * 
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */ 
    require '_top.php'; 
    require_once CLASS_PATH . 'View/Acc/Pagging.php';
       
try
{
	switch ($mod)
    {
    	case 'member':
    		$sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
             
            if ($sstr)
            {           
            	$gSmarty -> assign('page', $page);
                $pcnt    =  20;
                $rcnt    =  $gUser -> SearchUserCount($sstr, 1);
                $gSmarty -> assign('mc', $rcnt); 
                $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'search.php?mod=member&sstr='.$sstr);
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gUser -> SearchUser($sstr, 1, $range[0], $pcnt);
                $gSmarty -> assign_by_ref('mcl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make());  

                /** other */
                require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                $gSmarty -> assign('gc',  $gGear -> GetCount(0, 0, '', '', '', $sstr)); 
                
                require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $gSmarty -> assign('jc',  $gJobs -> GetCount(0, 0, '', '', $sstr)); 
            
                $gSmarty -> assign('ec', $gUser -> SearchUserCount($sstr, 2));
            }	
            
    		$gSmarty -> assign('_content', $gSmarty -> fetch('mods/search/_list_member.html'));     		
    	break;

    	
        case 'employers':
            $sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
             
            if ($sstr)
            {           
                $gSmarty -> assign('page', $page);
                $pcnt    =  20;
                $rcnt    =  $gUser -> SearchUserCount($sstr, 2);
                $gSmarty -> assign('ec', $rcnt);   
                $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'search.php?mod=employers&sstr='.$sstr);
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gUser -> SearchUser($sstr, 2, $range[0], $pcnt);
                $gSmarty -> assign_by_ref('ecl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make());   
                
                /** other */
                require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                $gSmarty -> assign('gc',  $gGear -> GetCount(0, 0, '', '', '', $sstr)); 
                
                require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $gSmarty -> assign('jc',  $gJobs -> GetCount(0, 0, '', '', $sstr)); 
            
                $gSmarty -> assign('mc', $gUser -> SearchUserCount($sstr, 1));   
            }                 
        	$gSmarty -> assign('_content', $gSmarty -> fetch('mods/search/_list_employers.html'));             
        break;

        
        case 'jobs':
            $sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
            
            require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
            $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
            
            if ($sstr)
            {           
                $gSmarty -> assign('page', $page);
                $pcnt    =  20;
                $rcnt    =  $gJobs -> GetCount(0, 0, '', '', $sstr);
                $gSmarty -> assign('jc', $rcnt);   
                $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'search.php?mod=jobs&sstr='.$sstr);
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gJobs -> GetList(0, 0, $range[0], $pcnt, '', '', $sstr);
                $gSmarty -> assign_by_ref('jcl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make()); 

                /** other */
                require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                $gSmarty -> assign('gc',  $gGear -> GetCount(0, 0, '', '', '', $sstr)); 
            
                $gSmarty -> assign('mc', $gUser -> SearchUserCount($sstr, 1));   
                $gSmarty -> assign('ec', $gUser -> SearchUserCount($sstr, 2));  
            }           	
        	
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/search/_list_jobs.html'));             
        break;

        
        case 'gear':
            $sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
                        
            if ($sstr)
            {           
                require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
            	
            	$gSmarty -> assign('page', $page);
                $pcnt    =  20;
                $rcnt    =  $gGear -> GetCount(0, 0, '', '', '', $sstr);
                $gSmarty -> assign('gc', $rcnt);   
                $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'search.php?mod=gear&sstr='.$sstr);
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gGear -> GetList(0, 0, $range[0], $pcnt, '', '', '', '', $sstr);
                $gSmarty -> assign_by_ref('gcl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make());  

                /** other */
                require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $gSmarty -> assign('jc',  $gJobs -> GetCount(0, 0, '', '', $sstr)); 
            
                $gSmarty -> assign('mc', $gUser -> SearchUserCount($sstr, 1));   
                $gSmarty -> assign('ec', $gUser -> SearchUserCount($sstr, 2));
            }              
        	
        	$gSmarty -> assign('_content', $gSmarty -> fetch('mods/search/_list_gear.html'));              
        break;
                
    	default:
        	
        	$sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
            $gSmarty -> assign('sstr', $sstr);
             
            if ($sstr)
            {
                /** search members */
            	$mc = $gUser -> SearchUserCount($sstr, 1);
            	$gSmarty -> assign('mc', $mc);   
            	$gSmarty -> assign('mcl', $gUser -> SearchUser($sstr, 1, 0, 12));    

        	    /** search employers */
            	$ec = $gUser -> SearchUserCount($sstr, 2);
            	$gSmarty -> assign('ec', $ec); 
            	$gSmarty -> assign('ecl', $gUser -> SearchUser($sstr, 2, 0, 12));
                
            	/** search jobs */
            	require_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
            	$jc = $gJobs -> GetCount(0, 0, '', '', $sstr);
            	$gSmarty -> assign('jc', $jc); 
            	$gSmarty -> assign('jcl', $gJobs -> GetList(0, 0, 0, 12, '', '', $sstr));
              
            	require_once CLASS_PATH.'Model/Geografy/Main.class.php';
                $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
                
                /** search gear */
                require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                $gc = $gGear -> GetCount(0, 0, '', '', '', $sstr);
                $gSmarty -> assign('gc', $gc);
                $gSmarty -> assign('gcl', $gGear -> GetList(0, 0, 0, 12, '', '', '', '', $sstr)); 
                
                
            	$gSmarty -> assign('search_c', $mc + $ec + $jc + $gc);
                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/search/_list.html'));              	         	
            }
    }	
	$gSmarty -> display('main.html'); 
}
catch (Exception $exc)
{
    sc_error($exc);
}    
	
require '_bottom.php';
?>