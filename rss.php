<?php

    require '_top.php';
	
    try
    {  
        include_once CLASS_PATH . 'Model/Main/RSS.php';
        
        switch  ($mod)
        {
            case 'jobs':
                
				include_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $ji =& $gJobs -> GetList(0, 0, 0, 10, '', '');
                $gRss  =& new Rss( 'CrewedUp Newest Jobs' );
                $gRss -> ShowHeader();
                for ($i = 0; $i < count($ji); $i++)
                {
                    $gRss -> ShowItem( 
                                 $ji[$i]['job_title'],
                                 $ji[$i]['mt'],
                                 'http://'.DOMEN.PATH_ROOT.'jobs.php?id='.$ji[$i]['id'],
                                 $ji[$i]['descr']
                                 );
                }
                $gRss -> ShowFooter();
            break;    
            
			case 'wire':
			    if (empty($gSystemLogin))
			    {
			        require 'security_mod.php'; 
			    }
			    include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                $wl = $gWire -> GetList( $uid, 0, 10 ) ; 
                $gRss  =& new Rss( 'CrewedUp The Wire' );
                $gRss -> ShowHeader();
                for ($i = 0; $i < count($wl); $i++)
                {
                    $gRss -> ShowItem( 
                                 $wl[$i]['fname'].' - '.$wl[$i]['title'],
                                 $wl[$i]['mt'],
                                 'http://'.DOMEN.PATH_ROOT.$wl[$i]['link'],
                                 $wl[$i]['descr']
                                 );    
                }
                $gRss -> ShowFooter();                    
			break;
			
			case 'users':
                include_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
                $ul =& $gUser -> GetUserList(1, 1, 'u.dt DESC', 0, 10);
                
                $gRss  =& new Rss( 'CrewedUp New Members' );
                $gRss -> ShowHeader();
                //deb($ul);
                for ($i = 0; $i < count($ul); $i++)
                {
                    $gRss -> ShowItem( 
                                 (1 == $ul[$i]['status'] ? $ul[$i]['name'].' '.$ul[$i]['lname'] : $ul[$i]['company']).
                                 ($ul[$i]['person_title'] ? ', '.$ul[$i]['person_title'] : ''),
                                 $ul[$i]['mt'],
                                 'http://'.DOMEN.PATH_ROOT.'profile'.$ul[$i]['uid'],
                                 str_truncate($ul[$i]['about_me'], 400)
                                 );
                }
                $gRss -> ShowFooter();			    
			break;    
			
            default:              
        }
    }
    catch (Exception $exc)
    {
        sc_error($exc);
    }
    require '_bottom.php';        
?>