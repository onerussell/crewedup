<?php
/**
 * Jobs
 * 
 */ 

    require '_top.php';
    $gSmarty -> assign('mwd', 'jobs');


try
{  
    include_once CLASS_PATH . 'View/Acc/Pagging.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
    $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));

    include_once '_prof_ar.php';
    $gSmarty -> assign_by_ref( 'prof', $prof );

    
    /** breadcrumb */
    if (!$id)
    {
        $bc['All Jobs']   = PATH_ROOT.'jobs.php';
        $menu_act         = 3;     
    }
    else
    {
        $menu_act         = 3; 
    }
            
    switch ($mod)
    {
        /** Add Job */   
        case 'add':
            $st  = '<p><br><a><b><i><a><img>';
            if (!$is_user || (!empty($uinfo) && 1 == $uinfo['status']))
            {
                uni_redirect( PATH_ROOT . 'jobs.php' );
            }               
            $gSmarty -> assign_by_ref('ui', $uinfo);                 

            /** Last Blog entry */
            include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
            $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
            $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));        
           
            /** Last Gear entry */    
            include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
            $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
            $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
    
            /** Last added contacts in right menu */
            $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));        
            
            
            if ($id)
            {
                $fi =& $gJobs -> Get($id);
                        
                if ( $fi['uid'] != UID )
                {
                    uni_redirect( PATH_ROOT . 'msg.php?mod=jobs' );
                }
                $gSmarty -> assign_by_ref('fi', $fi);
                $gSmarty -> assign('id', $id);                      
            } 

            if (!empty($_POST['fm']))
            {
                $fm =& $_POST['fm'];

                if (empty($fm['job_title']))         
                {
                    $errs[] = 'Please specify title';
                }

                if (empty($fm['cid']))         
                {
                    $errs[] = 'Please select category';
                }
                if (empty($fm['start_date']))         
                {
                    $errs[] = 'Please specify start date';
                }              
                    
                
                if (empty($errs))
                {                    
                    $sdate = MakeDateA( $fm['start_date'] ); 
                    
                    $ar = array(
                                 UID,
                                 strip_tags($fm['job_title'], $st),
                                 $fm['cid'],
                                 $sdate,
                                 strip_tags($fm['project_title'], $st),
                                 (!empty($fm['show_proj']) ? 1 : 0), 
                                 strip_tags($fm['descr'], $st)
                                 
                                );
                     $iid = $gJobs -> Edit( $ar, $id );
                     if (!$id)
                     {
                         /** start wire */
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                        $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
                        $gWire -> Edit(
                                         array( 
                                               UID,
                                               0, 
                                               (1 == $uinfo['status'] ? $uinfo['name'].' '.$uinfo['lname'] : $uinfo['company']).' ',
                                               6,
                                               'posted a job for an '. strip_tags($fm['job_title'], $st),
                                               'jobs.php?id='.$iid
                                               )
                                      );
                     }
                     
                     uni_redirect( PATH_ROOT . 'jobs.php?res=ok' );
                }
                $gSmarty -> assign_by_ref('errs', $errs);
                $gSmarty -> assign_by_ref('fm', $fm);        
            }
            elseif ($id)
            {
                /** Edit */
                if (!empty($fi))
                {
                    $fm = array( 'job_title ' => $fi['job_title'],  'cid' => $fi['cid'], 
                                 'start_date' => $fi['start_date'], 'project_title' => $fi['project_title'], 
                                 'show_proj' => $fi['show_proj'], 'descr' => $fi['descr'] 
                               ); 
                    $gSmarty -> assign_by_ref('fm', $fm);
                }             
            }
            else
            {    
                $fm = array( 'start_date' => date("m/d/Y") );
                $gSmarty -> assign_by_ref('fm', $fm);
            }            
            

            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/_add.html'));
        break;

        
        /** Delete job entry */
        case 'del':
            if (!$is_user)
            {
                uni_redirect( PATH_ROOT . 'profile'.$uid.'/' );
            }
                    
            if ($id)
            {
                $fi =& $gJobs -> Get($id);
                      
                if ( empty($fi) || $fi['uid'] != UID )
                {
                    uni_redirect( PATH_ROOT . 'msg.php?mod=jobs' );
                }
                $gSmarty -> assign_by_ref('fm', $fi);
                $gSmarty -> assign('id', $id);
            }  

            if (!empty($_REQUEST['do']))
            {
                $gJobs -> Del( $id, UID );
                uni_redirect( PATH_ROOT . 'jobs.php/?del=ok' );   
            }
            $gSmarty -> assign_by_ref('ui', $uinfo);                 

            /** Last Blog entry */
            include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
            $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
            $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));        
           
            /** Last Gear entry */    
            include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
            $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
            $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
    
            /** Last added contacts in right menu */
            $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));        
            
            
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/_del.html'));    
        break;     
                    
        /** Show All Jobs */
        default:

            $state = (!empty($_REQUEST['state']) && 2 == strlen($_REQUEST['state'])) ? $_REQUEST['state'] : '';
            $city  = (!empty($_REQUEST['city'])) ? $_REQUEST['city'] : '';
            $cat   = (!empty($_REQUEST['cat'])) ? $_REQUEST['cat'] : '';
            
            if (!empty($_REQUEST['is_state']))
            {
                $city = '';    
            }
            
            /** states */
            if (!empty($_SESSION['jobs']['statea']))
            {
                $gSmarty -> assign_by_ref('statea', $_SESSION['jobs']['statea']);
            }
            else 
            {
                $_SESSION['jobs']['statea'] =& $gJobs -> GetJobStates();
                $gSmarty -> assign_by_ref('statea', $_SESSION['jobs']['statea']);
            }
            /** cities */

            
            if (empty($state))
            {
                if (!empty($_SESSION['jobs']['cities']))
                {
                    $gSmarty -> assign_by_ref('cities', $_SESSION['jobs']['cities']);
                }
                else 
                {
                    $_SESSION['jobs']['cities'] =& $gJobs -> GetJobCities();
                    $gSmarty -> assign_by_ref('cities', $_SESSION['jobs']['cities']);
                }           
            }
            else
            {
                $gSmarty -> assign_by_ref('cities', $gJobs -> GetJobCities($state));
            }
            $gSmarty -> assign('state', $state);
            $gSmarty -> assign('city', $city);
            $gSmarty -> assign('cat', $cat);
            
            $is_my = (!empty($_REQUEST['is_my'])) ? 1 : 0;
            $gSmarty -> assign('is_my', $is_my);
            
            if ($id)
            {
                $ji =& $gJobs -> Get( $id );
                if (empty($ji))
                {
                    $id = 0;
                }
            }
            
            if (!$id)
            {
                $gSmarty -> assign('page', $page);
                $pcnt    =  20;
                $rcnt    =  $gJobs -> GetCount( (($is_my && $is_user) ? UID : 0), $cat, $state, $city );
                $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      PATH_ROOT . 'jobs.php?i=1'.($state ? '&amp;state='.$state : '').($city ? '&amp;city='.$city : '').($cat ? '&amp;cat='.$cat : '').(($is_my && $is_user) ? '&amp;is_my=1' : ''));
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gJobs -> GetList( (($is_my && $is_user) ? UID : 0) , $cat, $range[0], $pcnt, $state, $city);
                $gSmarty -> assign_by_ref('pl', $pl); 
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
				


                include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/_all.html'));   
            }
            else
            {
                $gSmarty -> assign_by_ref('fi', $ji);
                $gSmarty -> assign_by_ref('ui', $gUser -> Get( $ji['uid'] ));  
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/jobs/_one.html'));             
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