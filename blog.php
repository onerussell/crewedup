<?php
/**
 * User Blog
 * 
 */ 
    require '_top.php';
    $gSmarty -> assign('mod', 'profile');
    $gSmarty -> assign('act', 'blog');
try
{         
    require_once CLASS_PATH . 'View/Acc/Pagging.php'; 
    require_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 

    
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));

    if ($id)
    {
                        
        $fi =& $gBlog -> Get($id);    
        if (!empty($fi))
        {
            $uid = $fi['uid'];
        }
    }
    
    if ( empty($uid) )
    {
        uni_redirect( PATH_ROOT . '?mod=login');
    }
    

    if ( $is_user && UID == $uid )
    {    	    
        $ui =& $uinfo;  
    }
    else
    {
        $ui =& $gUser -> Get( $uid );
        if (empty($ui))
        {
            uni_redirect( PATH_ROOT . '?mod=login');
        }          
    }
	$gSmarty -> assign('uid', $uid);
    $gSmarty -> assign_by_ref('ui', $ui);
   
    /** some gears in right menu */
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));

    /** Last added contacts in right menu */
    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));
    
	
    /** breadcrumb */
    if ($is_user)
    {
        $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
        $menu_act         = 2; 
    }
    else
    {
        $bc['Profile']    = PATH_ROOT.'profile'.$uid;
        $menu_act         = ( 2 == $ui['status'] ? 4 : 5 );     
    }
    $bc['Blog'] = PATH_ROOT . 'blog'.$uid;
    
    
    if (!empty($_REQUEST['public']))
    {
        $gSmarty -> assign('is_public', 1);
    }
    
    $st  = '<p><br><a><b><i><a><img><span><p>';
            
    switch ($what)
    {
        /** Add message to Blog && Edit message */
        case 'add':

            if (!$is_user)
            {
                uni_redirect( PATH_ROOT . 'msg.php?mod=blog&uid='.$uid );
            }        
            
            if ($id)
            {
                $fi =& $gBlog -> Get($id);
            }
                    
            if (!empty($_POST['fm']))
            {
                $fm   = $_POST['fm'];
                $errs = array();
                if (empty($fm['title']))         
                {
                    $errs[] = 'Please specify title';
                }
                        
                if (empty($fm['story']))         
                {
                    $errs[] = 'Please specify message text';
                }
                        
                if (empty($errs))
                {
                    $ar = array(
                               $uid,
                               strip_tags($fm['title'], $st),
                               strip_tags($fm['story'], $st)
                               );
       
                    $iid = $gBlog -> Edit($ar, $id);
                    if (!$id)
                    {
                        /** start wire */
                        require_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                        $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
                        $gWire -> Edit(
                                         array( 
                                               UID,
                                               0, 
                                               (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                               1,
                                               'added a new blog entry',
                                               'blog.php?id='.$iid,
                                               $iid
                                               )
                                      );
                    }
                    uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid.'&res=ok' );
                }
                $gSmarty -> assign_by_ref('errs', $errs);
                $gSmarty -> assign_by_ref('fm', $fm);
            }
            elseif ($id)
            {
                /** Edit */
                if (!empty($fi))
                {
                    $fm = array( 'title' => $fi['title'], 'story' => $fi['story'] ); 
                    $gSmarty -> assign_by_ref('fm', $fm);
                }             
            }
            $gSmarty -> assign('id', $id);
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog_new.html'));
        
        break;

        
        /** Delete Blog Entry */
        case 'del':
                    
            if(empty($id))
            {
                uni_redirect( PATH_ROOT . 'msg.php?mod=blog&uid='.$uid );  
            }
            $gSmarty -> assign('id', $id);
                    
            $ci =& $gBlog -> Get($id);
            
            if ($ci['uid'] != UID)
            {
                $is_user = 0;        
            }
            
            if (empty($ci) || !$is_user)
            {
                 uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid.'&id='.$id ); 
            }
            
            if (!empty($_REQUEST['conf']))
            {
                $gBlog -> Del($id);
                uni_redirect( PATH_ROOT . 'blog.php?del=ok&uid='.$uid);
            }
            $gSmarty -> assign_by_ref('fm', $ci);
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog_del.html'));                    
        break;    

        
        /** Edit Comment */
        case 'editcom':
                    
            $mid = (!empty($_REQUEST['mid']) && is_numeric($_REQUEST['mid'])) ? $_REQUEST['mid'] : 0;
            if(empty($id) || empty($mid))
            {
                uni_redirect( PATH_ROOT . 'msg.php?mod=blog&uid='.$uid );  
            }
            $gSmarty -> assign('mid', $mid);
            $gSmarty -> assign('id', $id);

            /** Check rights */
            $cm =& $gBlog -> Get( $id );
            if (empty($cm))
            {
                uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid );     
            }
            if ($cm['uid'] != UID)
            {
                $is_user = 0;
            }
            
            $ci =& $gBlog -> GetCom($mid);
            if (empty($ci) || (!$is_user && UID != $ci['uid']))
            {
                uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid.'&id='.$id ); 
            }            
            
            /** do action */        
            if (!empty($_POST['fm']))
            {
                $fm   = $_POST['fm'];
                $errs = array();
                if (empty($fm['story']))
                {
                    $errs = 'Please specify message text';
                }
                        
                if (empty($errs))
                {
                    $ar = array( $id, $ci['uid'], '', $fm['story'] );
                    $gBlog -> EditCom($ar, $mid);
                    uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid.'&id='.$id );
                } 
                $gSmarty -> assign_by_ref('errs', $errs);
                $gSmarty -> assign_by_ref('fm', $fm);   
            }
            else
            {
                $gSmarty -> assign_by_ref('fm', $ci);
            }
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog_edit_com.html'));
        break;
                
                
        /** Delete Comment */
        case 'delcom':
                    
            $mid = (!empty($_REQUEST['mid']) && is_numeric($_REQUEST['mid'])) ? $_REQUEST['mid'] : 0;
            
            if(empty($id) || empty($mid))
            {
                uni_redirect( PATH_ROOT . 'msg.php?mod=blog' );  
            }
            $gSmarty -> assign('mid', $mid);
            $gSmarty -> assign('id', $id);
           
            /** Check rights */
            $cm =& $gBlog -> Get($id);
            if (empty($cm))
            {
                uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid );     
            }
            if ($cm['uid'] != UID)
            {
                $is_user = 0;
            }
            
            $ci =& $gBlog -> GetCom($mid);
            if (empty($ci) || (!$is_user && UID != $ci['uid']))
            {
                uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid.'&id='.$id ); 
            }
            
            /** do action */
            if (!empty($_REQUEST['conf']))
            {
            	$gBlog -> DelCom($mid);
            	uni_redirect( PATH_ROOT . 'blog.php?id='.$id.'&comdel=ok&uid='.$uid);
            }
            $gSmarty -> assign_by_ref('fm', $ci);
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog_del_com.html'));                    
        break;    
                    
        /** Show rss */
        case 'rss':
            if ($uid)
            {
                $pl =& $gBlog -> GetList($uid, 0, 10);
                $gSmarty -> assign_by_ref('pl', $pl);
                require_once CLASS_PATH . 'Model/Main/RSS.php';
                $gRss  =& new Rss( 'CrewedUp '.(1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']).' blog' );
                $gRss -> ShowHeader();
                
                for ($i = 0; $i < count($pl); $i++)
                {
                    $gRss -> ShowItem( 
                                 $pl[$i]['title'],
                                 $pl[$i]['mt'],
                                 'http://'.DOMEN.PATH_ROOT.'blog.php?id='.$pl[$i]['id'],
                                 str_truncate($pl[$i]['story'], 400)
                                 );
                }
                
                $gRss -> ShowFooter();
                require '_bottom.php'; 
                exit();     
            }
        break;         
        
        
        /** Add Comment */
        case 'addcom':
                    
             if(empty($id))
             {
                 uni_redirect( PATH_ROOT . 'blog.php?uid='.$uid );  
             }
                          
             if (!empty($_POST['fm']))
             {
                 $fm   = $_POST['fm'];
                 $errs = array();
                        
                 if (empty($fm['story']))         
                 {
                     $errs[] = 'Please specify message text';
                 }
                        
                 if (empty($errs))
                 {
                     $ar = array(
                                 $id,
                                 UID,
                                 '',
                                 strip_tags($fm['story'], $st)
                                 );           
                     $iid = $gBlog -> EditCom($ar);
                     /** start wire */
                     require_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                     $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
                     $gWire -> Edit(
                                    array( 
                                          UID,
                                          $uid, 
                                          (1 == $uinfo['status'] ? $uinfo['name'].' '.$uinfo['lname'] : $uinfo['company']),
                                           11,
                                           'commented your blog',
                                           'blog.php?id='.$id,
                                           $iid
                                          )
                                   );

                     uni_redirect( PATH_ROOT . 'blog.php?id='.$id.'&res=okcom' );
                 }
                 $gSmarty -> assign_by_ref('errs', $errs);
             }
             $gSmarty -> assign('id', $id);  
   
             
        /** Show errors - no break */
        default:
                    
            if ($id)
            {
                        
                $fi =& $gBlog -> Get($id);
                    
                if (empty($fi))
                {
                    uni_redirect( PATH_ROOT . 'profile.php?uid='.$uid );
                }

                if (!defined('UID') || $fi['uid'] != UID)
                {
                    $gSmarty -> assign('is_user', 0);
                }
                
                $gSmarty -> assign_by_ref('com', $gBlog -> GetComList(0, $id, 0, 0, 'pdate'));
                $gSmarty -> assign_by_ref('fi', $fi);
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog_one.html'));
            }
            else
            {

                $gSmarty -> assign('page', $page);
                $pcnt    =  10;
                $rcnt    =  $gBlog -> GetCount($uid);
                $gMpage   =   new Pagging($pcnt,
                                          $rcnt,
                                          $page,
                                          PATH_ROOT . 'blog.php?uid='.$uid);
                $gSmarty -> assign('rcnt', $rcnt);
                $range   =& $gMpage -> GetRange();
                $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                $pl =& $gBlog -> GetList($uid, $range[0], $pcnt);
                $gSmarty -> assign_by_ref('pl', $pl); //deb($pl);
                $gSmarty -> assign('plc', count($pl)); 
                $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/blog/_blog.html'));
            }   
             
    }/** end mod case */         
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