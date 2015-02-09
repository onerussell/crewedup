<?php
    require '_top.php';
    $gSmarty -> assign('mod', 'profile');
#*************************************************************
# Main part
#*************************************************************
       
try
{         
    include_once CLASS_PATH . 'View/Acc/Pagging.php'; 
    include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
    include_once CLASS_PATH . 'Model/Main/Calendar.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Calendar_Events.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Comments.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Resume.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Award.php';    
  
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

    $gSmarty -> assign_by_ref('ui', $ui);
    
    if (!empty($_REQUEST['public']))
    {
        $gSmarty -> assign('is_public', 1);
    }
    
    /** Get Blog in right menu */               
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
    
    
    /** Get Calendar in left menu */ 
    $pdate    =  (!isset($_REQUEST['pdate']) || 10 < strlen($_REQUEST['pdate'])) ? date("j_n_Y") : $_REQUEST['pdate'];
    $pdate    =  Calendar :: PrepDate($pdate);
    $cdi =& Calendar :: Show( $pdate );
    
    if (!empty($cdi['days']))
    {
        $gSmarty -> assign('prev_next', MakePrevNextDate( $pdate['year'].'-'.$pdate['mon'].'-'.$pdate['mday']) );
        $dt_start = MakeDate( $cdi['days'][0][0][1], '_');
        $dt_end   = MakeDate( $cdi['days'][count($cdi['days'])-1][count($cdi['days'][count($cdi['days'])-1])-1][1], '_');
        $gSmarty -> assign_by_ref('cdi', $cdi);
        
        /** Get Events For Calendar */
        $gCEvent =& new Model_Main_Calendar_Events($gDb, array('events' => TB . 'calendar_events'));
        $gSmarty -> assign_by_ref('cevents', $gCEvent -> GetEventsList( $uid, $dt_start, $dt_end, 1));
        //deb($gCEvent -> GetEventsList( $uid, $dt_start, $dt_end, 1));
    }
    
    /** Last added contacts in right menu */
    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));
    
    /** some gears in right menu */
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
    
    /** breadcrumb */
    if ($is_user)
    {
        $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
        $menu_act         = 2;
    }
    else
    {
        switch ($ui['status'])
        {
            case 1:
                $prof = (!empty($ui['prof1']) ? $ui['prof1'] : (!empty($ui['prof2']) ? $ui['prof2'] : $ui['prof3']));
                $bc['All Members'] = PATH_ROOT.'crew.php';
                if ($prof) 
                {
                    $bc[$prof] = PATH_ROOT.'crew.php?tag='.$prof;
                }
                if (empty($gSystemLogin))
                {
                    $gSmarty -> assign('bcwl', array('Crew Members Registration', PATH_ROOT.'reg/?rt=1'));
                }
                $menu_act = 51;
            break;

            case 2:
                $bc['All Members'] = PATH_ROOT.'employers.php';
                if ($ui['prof1'])
                {
                    $bc[1 == $ui['prof1'] ? 'Production company' : 'Rental House'] = (1 == $ui['prof1'] ? 'employers.php?cat=1' : 'employers.php?cat=2');
                }
                if (empty($gSystemLogin))
                {
                    $gSmarty -> assign('bcwl', array('Employers Registration', PATH_ROOT.'reg/?rt=2'));
                }
                $menu_act          = 41;               
            break;    
        }
        $bc['Profile']     = PATH_ROOT.'profile'.$uid;
            
    }
    
    
    switch ($act)
    {
        /**************************************** 
                 Resume
        ****************************************/
        case 'credits':
        case 'resume':
            if ('resume' == $act)
            {
                $bc['Live Resume'] = PATH_ROOT . 'profile'.$uid.'/resume'; 
            }
            else
            {
                $bc['Company Credits'] = PATH_ROOT . 'profile'.$uid.'/credits'; 
            }
            $gResume =& new Model_Main_Resume($gDb, array('resume' => TB . 'resume', 'users' => TB . 'users'));
            $gAward  =& new Model_Main_Award($gDb, array('award' => TB . 'awards'));
            
            $what = (!empty($_REQUEST['what'])) ? $_REQUEST['what'] : ''; 
            $st  = '<p><br><a><b><i><a><img>';

            /** Resume Actions */
            switch($what)
            {
                /** Add or Edit Resume entry */
                case 'add':
                    if (!$is_user)
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=resume' );
                    }
                    
                    if ($id)
                    {
                        $fi =& $gResume -> Get($id);
                        
                        if ( empty($fi) || $fi['uid'] != UID )
                        {
                            uni_redirect( PATH_ROOT . 'msg.php?mod=resume' );
                        }
                        $gSmarty -> assign_by_ref('fi', $fi);
                        $gSmarty -> assign('id', $id);
                        
                        if (!empty($_REQUEST['delimg']))
                        {
                            if ( $gResume -> DelImage( $id ) )
                            {
                                uni_redirect( PATH_ROOT . 'profile.php?act=resume&what=add&uid='.$uid.'&id='.$id);
                            }
                        }
                        if (!empty($_REQUEST['delimg2']))
                        {
                            if ( $gResume -> DelImage( $id, 2 ) )
                            {
                                uni_redirect( PATH_ROOT . 'profile.php?act=resume&what=add&uid='.$uid.'&id='.$id);
                            }
                        }
                    }
                                                 
                    if (!empty($_POST['fm']))
                    {
                        $fm =& $_POST['fm'];

                        if (empty($fm['title']))         
                        {
                            $errs[] = 'Please specify movie/show title';
                        }
                        
                        if (empty($fm['company']))         
                        {
                            $errs[] = 'Please specify production company name';
                        }
                        
                        $fn  = '';
                        $fn2 = '';
                        require_once CLASS_PATH . 'Ctrl/Image/Image_Transform.php';
                        require_once CLASS_PATH . 'Ctrl/Image/Image_Transform_Driver_GD.php';
                        
                        if (!empty($_FILES['fm']['tmp_name']['image']))
                        {
                     
                            $iz  = getimagesize($_FILES['fm']['tmp_name']['image']);
                            $ext = strtolower(strrchr($_FILES['fm']['name']['image'], "."));
                       
                            if (!in_array($ext, array('.jpg', '.jpeg', '.gif', '.png')))
                            {
                                $errs[] = 'You can upload only jpg, gif & png files';
                            }
                            elseif (empty($iz))
                            {
                                $errs[] = 'You can upload only jpg, gif & png files';
                            }
                            else
                            {
                                $fs = filesize($_FILES['fm']['tmp_name']['image']);
                                if( 2048000 < $fs)
                                {
                                    $errs[] = 'File is too big. Max file size is 2Mb';
                                }
                                else
                                {
                                    $fn = MakeOrig($_FILES['fm']['name']['image'], DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : ''), 1);
                                    /** Upload image throw crop */
                                    i_crop_copy(600, 450, 
                                                    $_FILES['fm']['tmp_name']['image'],
                                                    DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn, 
                                                    2);
                                    i_crop_copy(86, 43,
                                                    DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                    DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                    2);              
                                }
                            }
                        }
                        
                        
                        if (!empty($_FILES['fm']['tmp_name']['image2']))
                        {
                     
                            $iz  = getimagesize($_FILES['fm']['tmp_name']['image2']);
                            $ext = strtolower(strrchr($_FILES['fm']['name']['image2'], "."));
                       
                            if (!in_array($ext, array('.jpg', '.jpeg', '.gif', '.png')))
                            {
                                $errs[] = 'You can upload only jpg, gif & png files';
                            }
                            elseif (empty($iz))
                            {
                                $errs[] = 'You can upload only jpg, gif & png files';
                            }
                            else
                            {
                                $fs = filesize($_FILES['fm']['tmp_name']['image2']);
                                if( 2048000 < $fs)
                                {
                                    $errs[] = 'File is too big. Max file size is 2Mb';
                                }
                                else
                                {
                                    $fn2 = MakeOrig($_FILES['fm']['name']['image2'], DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : ''), 1);
                                    /** Upload image throw crop */
                                    i_crop_copy(600, 450, 
                                                    $_FILES['fm']['tmp_name']['image2'],
                                                    DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2, 
                                                    2);
                                    i_crop_copy(86, 43,
                                                    DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2,
                                                    DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2,
                                                    2);              
                                }
                            }
                        }                        

                        if (empty($errs))
                        {
                            $sdate = $fm['year'].'-'.$fm['month'].'-0';
                            $ar = array(
                                       UID,
                                       strip_tags($fm['title'], $st),
                                       strip_tags($fm['prof'], $st),
                                       $sdate,
                                       strip_tags($fm['story'], $st),
                                       strip_tags($fm['company'])         
                                       );
                            $iid = $gResume -> Edit($ar, $id, $fn, $fn2);

                            /** start wire */
                            if (!$id)
                            {
                                include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php';
                                $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
                                $gWire -> Edit(
                                             array( 
                                                   UID,
                                                   0, 
                                                   (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                                   7,
                                                   'added a new '.(1 == $ui['status'] ? 'resume' : 'company credits').' entry',
                                                   'profile'.UID.'resume/?id='.$iid
                                                  )
                                              );
                            }      
                            uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume/?res=ok' );
                        }
                        $gSmarty -> assign_by_ref('errs', $errs);
                        $gSmarty -> assign_by_ref('fm', $fm);
                    }
                    elseif ($id)
                    {
                        /** Edit */
                        if (!empty($fi))
                        {
                            $fm = array( 'title' => $fi['title'], 'story' => $fi['story'], 'month' => $fi['month'], 'year' => $fi['year'], 'company' => $fi['company'], 'prof' => $fi['prof'] ); 
                            $gSmarty -> assign_by_ref('fm', $fm);
                        }             
                    }
                    else
                    {
                        $fm = array( 'month' => date("n"), 'year' => date("Y"));
                        $gSmarty -> assign_by_ref('fm', $fm);
                    }
                    include_once '_prof_ar.php';
                    $gSmarty -> assign_by_ref( 'prof', $prof );
					$gSmarty -> assign('ma', array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')); 
                    $ya = array();
                    for ($i = date("Y"); $i >= 1950; $i--)
                    {
                        $ya[] = $i;
                    }
                    $gSmarty -> assign('ya', $ya);
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_add.html'));
                break;

                case 'addaward':
                /** Add or Edit Award entry */
                    if (!$is_user)
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=resume' );
                    }
                    
                    if ($id)
                    {
                        $fi =& $gAward -> Get($id);
                  
                        if ( empty($fi) || $fi['uid'] != UID )
                        {
                            uni_redirect( PATH_ROOT . 'msg.php?mod=resume' );
                        }
                        $gSmarty -> assign_by_ref('fi', $fi);
                        $gSmarty -> assign('id', $id);              
                    }
                                                 
                    if (!empty($_POST['fm']))
                    {
                        $fm =& $_POST['fm'];

                        if (empty($fm['title']))         
                        {
                            $errs[] = 'Please specify title';
                        }
                        if (empty($fm['link']))         
                        {
                            $errs[] = 'Please specify link';
                        }
                        if (empty($errs))
                        {
                            $fm['link']  = ( 0 >= strpos('_'.$fm['link'], 'http://') ? 'http://' : '' ) . $fm['link'];
                            $ar = array(
                                       UID,
                                       strip_tags($fm['title'], $st),
                                       strip_tags($fm['link'], $st)
                                       );
                            $id = $gAward -> Edit($ar, $id);
                            uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume/?res=awok' );
                        }
                        $gSmarty -> assign_by_ref('errs', $errs);
                        $gSmarty -> assign_by_ref('fm', $fm);
                    }
                    elseif ($id)
                    {
                        /** Edit */
                        if (!empty($fi))
                        {
                            $fm = array( 'title' => $fi['title'], 'link' => $fi['link'] ); 
                            $gSmarty -> assign_by_ref('fm', $fm);
                        }             
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_add_award.html'));
                break;   
                
                /** Delete resume entry */
                case 'del':
                    if (!$is_user)
                    {
                        uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume' );
                    }
                    
                    if ($id)
                    {
                        $fi =& $gResume -> Get($id);
                        
                        if ( $fi['uid'] != UID )
                        {
                            uni_redirect( PATH_ROOT . 'msg.php?mod=resume' );
                        }
                        $gSmarty -> assign_by_ref('fm', $fi);
                        $gSmarty -> assign('id', $id);
                    }  

                    if (!empty($_REQUEST['do']))
                    {
                        $gResume -> Del( $id );
                        uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume' );   
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_del.html'));    
                break;
                
                /** Delete award entry */
                case 'delaward':
                    if (!$is_user)
                    {
                        uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume' );
                    }
                    
                    if ($id)
                    {
                        $fi =& $gAward -> Get($id);
                        
                        if ( empty($fi) || $fi['uid'] != UID )
                        {
                            uni_redirect( PATH_ROOT . 'msg.php?mod=resume' );
                        }
                        $gSmarty -> assign_by_ref('fm', $fi);
                        $gSmarty -> assign('id', $id);
                    }  

                    if (!empty($_REQUEST['do']))
                    {
                        $gAward -> Del( $id );
                        uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume' );   
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_del_award.html'));    
                break;

                case 'forward':
                    
                    if ( empty($gSystemLogin) )
                    {
                        uni_redirect( PATH_ROOT . 'profile.php' ); 
                    }
            
                    if (!empty($_REQUEST['send']))
                    {
                        $gSmarty -> assign('send', 1);    
                    }
            
                    if (!empty($_POST['fm']['email']))
                    {
                        $errs = array();
                        if (!verify_email($_POST['fm']['email']))
                        {
                            $errs[] = 'Please specify correct e-mail';
                        }
                
                        if (empty($errs))
                        {
                            $gSmarty -> assign('DOMEN', DOMEN);
                            include CLASS_PATH.'Ctrl/Mail/libmail.php';
                            $m = new Mail;
                            $m -> From( SUPPORT_EMAIL );
                            $m -> Subject('Forward '.(1 == $ui['status'] ? 'resume' : 'rentals').' from '.SUPPORT_SITENAME);
                            $m -> Priority(3);

                            $pl =& $gResume -> GetList($uid);
                            $gSmarty -> assign_by_ref('pl', $pl); 
                            $descr  = $gSmarty -> fetch('mails/forward_resume.html');
                    
                            $m -> Body( $descr);
                            $m -> To( $_POST['fm']['email'] );
                            $m -> Send();
                            uni_redirect( PATH_ROOT . 'profile'.$uid.'/'. (1 == $ui['status'] ? 'resume' : 'credits').'?what=forward&send=ok');
                        }
                        $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                        $gSmarty -> assign_by_ref('errs', $errs);
                    } 
            
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_forward.html'));                
                break;    
                
                
                default:
                    
                    $gSmarty -> assign('ma', array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')); 
                    
                    if ($id)
                    {
                        $ri =& $gResume -> Get($id);
                        if (empty($ri))
                        {
                            uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume');
                        }
                        $gSmarty -> assign_by_ref('fm', $ri);
                        $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_one.html'));
                        
                    }
                    else
                    {
                        $gSmarty -> assign('rl', $gResume -> GetList( $uid ) );
                        $gSmarty -> assign('al', $gAward -> GetList( $uid ) );
                        
                        if (!empty($_REQUEST['print']))
                        {
                            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume_print.html'));   
                        }
                        else
                        {
                            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/resume/_resume.html'));    
                        }    
                    }
                    
            }
            
        break;

        /**************************************** 
                 Forward
        ****************************************/        
        case 'forward':
            if ( $is_user )
            {
                uni_redirect( PATH_ROOT . 'profile.php' ); 
            }
            
            if (!empty($_REQUEST['send']))
            {
                $gSmarty -> assign('send', 1);    
            }
            
            if (!empty($_POST['fm']['email']))
            {
                $errs = array();
                if (!verify_email($_POST['fm']['email']))
                {
                    $errs[] = 'Please specify correct e-mail';
                }
                
                if (empty($errs))
                {
                    $gSmarty -> assign('DOMEN', DOMEN);
                    include CLASS_PATH.'Ctrl/Mail/libmail.php';
                    $m = new Mail;
                    $m -> From( SUPPORT_EMAIL );
                    $m -> Subject('Forward profile from '.SUPPORT_SITENAME);
                    $m -> Priority(3);

                    $descr  = $gSmarty -> fetch('mails/forward.html');
                    
                    $m -> Body( $descr);
                    $m -> To( $_POST['fm']['email'] );
                    $m -> Send();
                    uni_redirect('profile'.$uid.'?act=forward&send=ok');
                }
                $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                $gSmarty -> assign_by_ref('errs', $errs);
            }
            
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/forward/_forward.html'));                
        break;
        /**************************************** 
                 Comments
        ****************************************/
        case 'comments':

            $bc[ (1 == $ui['status']) ? 'Comments/Recommendations' : 'Recommendations'] = PATH_ROOT . 'profile'.$uid.'/comments'; 
            $gCom =& new Model_Main_Comments($gDb, array('comments' => TB . 'comments', 'users' => TB . 'users'));
 
            $wh   = (!empty($_REQUEST['wh']) && 'r' == $_REQUEST['wh']) ? 'r' : ( (!empty($_REQUEST['wh']) && 'a' == $_REQUEST['wh']) ? 'a' : '' );
            $what = (!empty($_REQUEST['what'])) ? $_REQUEST['what'] : ''; 
            $gSmarty -> assign('wh', $wh);
            $st  = '<p><br><a><b><i><a><img>';
            
            /** comment actions */
            switch($what)
            {
                /** Add || Edit Comment */
                case 'add':
                    /** Only for OTHER users - not for page owners */
                    if ($is_user)
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments'.($wh ? '&wh='.$wh : '') );
                    }
                    
                    if ($id)
                    {
                        $fi =& $gCom -> Get($id);
                        if ( $fi['author'] != UID )
                        {
                            uni_redirect( PATH_ROOT . 'msg.php?mod=comments'.($wh ? '&wh='.$wh : '') );
                        }
                        $gSmarty -> assign('id', $id);
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
                                       $uid,
                                       UID,
                                       (!$wh ? 0 : 1),
                                       strip_tags($fm['story'], $st)
                                       );
                            $id = $gCom -> Edit($ar, $id);
                            uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.'&res=ok'.($wh ? '&wh='.$wh : '') );
                        }
                        $gSmarty -> assign_by_ref('errs', $errs);
                        $gSmarty -> assign_by_ref('fm', $fm);
                    }
                    elseif ($id)
                    {
                        /** Edit */
                        if (!empty($fi))
                        {
                            $fm = array( 'story' => $fi['story'] ); 
                            $gSmarty -> assign_by_ref('fm', $fm);
                        }             
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/comments/_comments.html'));
                break;
            
                
                /** Delete Commentary */
                case 'del':
                    
                    if(empty($id))
                    {
                        uni_redirect( PATH_ROOT . 'msg.php?mod=comments&uid='.$uid.($wh ? '&wh='.$wh : '') );  
                    }
                    $gSmarty -> assign('id', $id);
                    
                    /** Check rights */
                    $ci =& $gCom -> Get($id);
                    if (empty($ci) || $ci['uid'] != UID)
                    {
                        $is_user = 0;        
                    }
                    
                    if (empty($ci) || ( !$is_user && $ci['author'] != UID ))
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.($wh ? '&wh='.$wh : '') ); 
                    }

                    /** Do action */
                    if (!empty($_REQUEST['conf']))
                    {
                        $gCom -> Del($id);
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&del=ok&uid='.$uid.($wh ? '&wh='.$wh : ''));
                    }
                    $ci['ai'] = $gUser -> Get( $ci['author'] );
                    $gSmarty -> assign_by_ref('fm', $ci);
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/comments/_comments_del.html'));                    
                break;                

                
                /** Add || Edit Reply to comment */
                case 'addreply':

                    if ($is_user && !empty($_POST['fm']['cid']) && !empty($_POST['fm']['story']))
                    {
                        $ci =& $gCom -> Get( $_POST['fm']['cid'] );
                        if (empty($ci) || $ci['uid'] != UID)
                        {
                            uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.($wh ? '&wh='.$wh : '') );    
                        }
                        $gCom -> AddReply($_POST['fm']['cid'], $_POST['fm']['story']);
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.'&page='.$page.($wh ? '&wh='.$wh : '') );
                    }
                    else
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.($wh ? '&wh='.$wh : '') );
                    }
                break;    
                
                /** Delete Reply */
                case 'delreply':
                    
                    if ($is_user && $id)
                    {
                        $ci =& $gCom -> Get( $id );
                        if (empty($ci) || $ci['uid'] != UID)
                        {
                            uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.($wh ? '&wh='.$wh : '') );    
                        }                    
                        $gCom -> DelReply( $id ); 
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.'&page='.$page.($wh ? '&wh='.$wh : '') );   
                    }
                    else
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?act=comments&uid='.$uid.($wh ? '&wh='.$wh : '') );
                    }
                break;
                    
                    
                default:
                    
                    $whx = !$wh ? 0 : ( 'r' == $wh ? 1 : -1 ); 
                    $gSmarty -> assign('page', $page);
                    $pcnt    =  10;
                    $rcnt    =  $gCom -> GetCount($uid, $whx);
                    $gMpage   =   new Pagging($pcnt,
                                              $rcnt,
                                              $page,
                                              PATH_ROOT . 'profile.php?act=comments&amp;uid='.$uid);
                    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $gMpage -> GetRange();
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                    $pl =& $gCom -> GetList($uid, $whx, $range[0], $pcnt);
                    $gSmarty -> assign_by_ref('pl', $pl); 
                    $gSmarty -> assign('plc', count($pl)); 
                    $gSmarty -> assign('pagging',  $gMpage   -> Make());     
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/comments/_comments.html'));
            }
            
            
        break;        

        /**************************************** 
                 Wire
        ****************************************/        
        case 'wire':
            if (!$is_user)
            {
                uni_redirect( PATH_ROOT . 'profile.php' );
            }
            $bc['The Wire'] = PATH_ROOT.'profile'.$uid.'/wire';
            
            $pt = (!empty($_REQUEST['pt']) && is_numeric($_REQUEST['pt']) && 1 <= $_REQUEST['pt'] && 7 >= $_REQUEST['pt']) ? $_REQUEST['pt'] : 0;
            $gSmarty -> assign('pt', $pt);
            
            include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
            $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
            
            $gSmarty -> assign('page', $page);
            $pcnt    =  20;
            $rcnt    =  $gWire -> GetCountAdi( $uid, $pt );
            $gMpage  =   new Pagging($pcnt,
                                     $rcnt,
                                     $page,
                                     PATH_ROOT . 'profile'.$uid.'/wire');
            $gSmarty -> assign('rcnt', $rcnt);
            $range   =& $gMpage -> GetRange();
            $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
            $pl      =& $gWire -> GetListAdi($uid, $range[0], $pcnt, $pt);
            $gSmarty -> assign_by_ref('pl', $pl); 
            $gSmarty -> assign('plc', count($pl)); 
            $gSmarty -> assign('pagging',  $gMpage   -> Make());  
      
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/wire/_wire.html'));
        break;
            
        /**************************************** 
                  User Calendar
        ****************************************/
        case 'calendar':
            $gSmarty -> assign('mwd', 'calendar');   
            $bc['The Calendar'] = PATH_ROOT.'profile'.$uid.'/?act=calendar';
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/calendar/_calendar.html'));
        break;        
        
        /**************************************** 
                  User Block 
        ****************************************/        
        case 'chgblock':
            if (!empty($gSystemLogin) && !$is_user)
            {
                $gUser -> UpdBlockUser( UID, $uid );
            }
            uni_redirect( PATH_ROOT . 'profile'.$uid );
        break; 
           
        /**************************************** 
                  Default - User Profile
        ****************************************/
        default: 
            switch($ui['status'])
            {
                
               /**************************************** 
                            Crew Member 
                ****************************************/
                case 1:
                    /** get some comments */
                    $gCom =& new Model_Main_Comments($gDb, array('comments' => TB . 'comments', 'users' => TB . 'users'));
                    $gSmarty -> assign_by_ref('coml', $gCom -> GetList( $uid, 0, 0, 0) );
                    
                    /** get resume */
                    /*
                    $gResume =& new Model_Main_Resume($gDb, array('resume' => TB . 'resume', 'users' => TB . 'users'));
                    $gSmarty -> assign('ma', array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')); 
                    $gSmarty -> assign('rl', $gResume -> GetList( $uid, 0, 6 ) );
                    */
                    /*
                    $gAward  =& new Model_Main_Award($gDb, array('award' => TB . 'awards'));
                    $gSmarty -> assign_by_ref('al', $gAward -> GetList( $uid ));
                    */
                    /*
                    include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                    $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                    deb( $gWire -> GetList( $uid ) ); 
                    */
                    
                    
                    if (defined('UID') && $uid != UID)
                    {
                        $gSmarty -> assign('cf', $gUser -> CheckFriend(UID, $uid)); 
                        $gSmarty -> assign('bf', $gUser -> CheckBlockUser( UID, $uid) );
                    }
                    $gSmarty -> assign('mwd', 'profile');
                    if (!$is_user)
                    {
                        $gUser -> UpdView( $uid );
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/member/_profile.html'));
                break;
                
                /**************************************** 
                              Employer 
                 ****************************************/
                case 2:
                    /** get some recommendations */
                    $gCom =& new Model_Main_Comments($gDb, array('comments' => TB . 'comments', 'users' => TB . 'users'));
                    $gSmarty -> assign_by_ref('coml', $gCom -> GetList( $uid, 0, 0, 0) );
                    
                    if (defined('UID') && $uid != UID)
                    {
                        $gSmarty -> assign('cf', $gUser -> CheckFriend(UID, $uid)); 
                        $gSmarty -> assign('bf', $gUser -> CheckBlockUser( UID, $uid) );
                    }
                    $gSmarty -> assign('mwd', 'profile');
                    if (!$is_user)
                    {
                        $ui['view_cnt'] ++;
                        $gUser -> UpdView( $uid );
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/employer/_profile.html'));
                break;    
                
                /**************************************** 
                              Who is it? Admin? 
                 ****************************************/                
                default:
                    exit();    
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
	
    if (!empty($_REQUEST['print']))
	{
	    $gSmarty -> display('print.html');
	}
	else
	{
	    $gSmarty -> display('main.html');
    }
#*************************************************************
# End part
#*************************************************************
    require '_bottom.php';
?>