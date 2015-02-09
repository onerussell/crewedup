<?php

    include '_top.php';
    
    if (!isset($gSystemLogin) || '' == $gSystemLogin)
    {
    	uni_redirect(PATH_ROOT . '?mod=login');
    }
    
    $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
    $bc['Mail']       = PATH_ROOT.'mc.php';
    $menu_act         = 2;

    
    $mod = (!$mod || !in_array($mod, array('send', 'mc'))) ? 'mc' : $mod;

    $friends_c = $gUser -> GetUserFriendsCount( $uid, 1);
    $gSmarty -> assign('friends_c',   $friends_c);
try
{ 
    include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));        
	
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
    
    /** Last added contacts in right menu */
    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));
    $friends_c = $gUser -> GetUserFriendsCount( $uid, 1);
    $gSmarty -> assign('friends_c',   $friends_c);    
  
	$UserInfoId = UID;
	$gSmarty -> assign_by_ref('ui', $uinfo);
    //$bc['Mail']  = PATH_ROOT. 'mc.php';
    $action               = 'inbox';

    switch ($mod)
    {
        #******************************
        #        Message Center
        #******************************
        case 'mc':
          
            require CLASS_PATH.'Model/Main/MC.php';

            //$gSmarty -> config_load('mc.conf');

            $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, 10);

            function a_redirect($code = 0)
            {
                global $action, $pvstart, $order;
                $code = intval($code);
                
                if ($code > 0)
                    uni_redirect(PATH_ROOT.'mc.php?mod=mc&action='.$action.'&pvstart='.$pvstart.'&order='.$order.'&code='.$code);
                else
                    uni_redirect(PATH_ROOT.'mc.php?mod=mc&action='.$action.'&pvstart='.$pvstart.'&order='.$order);
            }

            $action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : 'inbox';

            $add_action = (isset($_REQUEST['add_action'])) ? $_REQUEST['add_action']      : 'view';

            $what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : '';
            $pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) : 0;  // - page displaciment -
            $order      = (isset($_REQUEST['order']))      ? $_REQUEST['order']           : 4;  // - ordering -
            $code       = (isset($_REQUEST['code']))       ? $_REQUEST['code']            : 0;  // - error code -
            $id         = (isset($_REQUEST['id']))         ? $_REQUEST['id']              : 0;  // - item id -

            $gSmarty -> assign('action', $action);
            $gSmarty -> assign('add_action', $add_action);
            $gSmarty -> assign('what'  , $what);
            $gSmarty -> assign('pvstart' , $pvstart);
            $gSmarty -> assign('order' , $order);

            //$bc['��� ������'] = PATH_ROOT;

            //$bc['��������'] = PATH_ROOT.'?mod=mc&action=inbox&pvtstart=0&order=0';

            switch ($action)
            {
                /*case 'mess':
                    $code = (!empty($_REQUEST['code'])) ? $_REQUEST['code'] : 0;
                    $gSmarty -> assign('Message', $gSmarty -> get_config_vars('MCErr_'.$code));
                    break;*/

                case 'settings':
                    //$bc['Settings'] = '';
                    switch ($add_action)
                    {
                        case 'change':
                            try
                            {
                                $user -> UpdateSettings($UserInfoId, @$_POST['Settings']);
                                a_redirect();
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            break;

                        default:
                            try
                            {
                                $settings = $user -> GetSettings($UserInfoId);
                            }
                            catch (UsersException $cexc)
                            {
                                a_redirect($cexc -> getCode());
                            }

                            $gSmarty -> assign_by_ref('settings', $settings);

                            break;
                    }

                break;

                case 'inbox':
                case 'sent':
                case 'deleted':
                    $gSmarty -> assign('code'  , $gSmarty -> get_config_vars('MCErr_'.$code));

                    if ($action == 'inbox')
                    {
                       $type = 0;
                       //$mess_cnt   = $mc -> CountNotReaded($UserInfoId, 0);
                       $mess_cnt   = $mc -> Count($UserInfoId, 0);
                       $bc['Inbox']  = PATH_ROOT.'mc.php';
                    }
                    elseif ($action == 'sent')
                    {
                       //$bc['Send message'] = '';
                       $type = 1;
                       $mess_cnt   = $mc -> Count($UserInfoId, $type);
                       $bc['Sent Messages']  = PATH_ROOT.'mc.php?mod=mc&action=sent';
                    }
                    elseif ($action == 'deleted')
                    {
                       //$bc['Deleted messages'] = '';
                       $type = 2;
                       $mess_cnt   = $mc -> Count($UserInfoId, $type);
                       $bc['Deleted Messages']  = PATH_ROOT.'mc.php?mod=mc&action=sent';
                    }
                    
                    switch ($add_action)
                    {
                        case 'read':
                            try
                            {
                                $message = $mc -> Get($id, $UserInfoId);
                                $mc    -> SetReaded($id, $UserInfoId);  
                                $gUser -> EditNewState(UID, 'mess', -1);
                                $gSmarty -> assign_by_ref('message', $message);
                            }
                            catch (MCException $mce)
                            {
                                a_redirect($mce -> getCode());
                            }
                            break;
                        case 'reply':
                            if ('inbox' == $action)
                            {
                               try
                               {
                                   $message = $mc -> Get($id, $UserInfoId);
                                   $gSmarty -> assign_by_ref('message', $message);

                                   if (empty($message))
                                   {
                                       uni_redirect( PATH_ROOT . 'mc.php');
                                   }
                                   $bl = $gUser -> CheckBlockUser( $message['fromid'], UID );
                                   $gSmarty -> assign('bl', $bl);
                                
                                   
                                   if (!empty($_POST['do']))
                                   {
                                       $errs = array();
                                       if (empty($_POST['mess']['subject']) || 1 > strlen($_POST['mess']['subject']))
                                       {
                                     	   $errs[] = 'Please specify subject';
                                       }
                    
                                       if (empty($_POST['mess']['message']) || 1 > strlen($_POST['mess']['message']))
                                       {
                    	                   $errs[] = 'Please specify message';
                                       }
                                        
                                       if (0 == count($errs))
                                       {
                                   	       $action = 'sent';
                                           $order  = 4;

                                           $iid = $mc -> Add($message['fromid'],$UserInfoId, $_POST['mess']['subject'], $_POST['mess']['message']);
                                           $mc -> SetReaded($id, $UserInfoId);
                                           $gUser -> EditNewState($message['fromid'], 'mess', 1);
                                           
                                           /** start wire */
                                           include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                                           $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                                           $gWire -> Edit(
                                                          array( 
                                                                $UserInfoId,
                                                                $message['fromid'],
                                                                (1 == $uinfo['status'] ? $uinfo['name'].' '.$uinfo['lname'] : $uinfo['company']),
                                                                 3,
                                                                 'wrote you a message',
                                                                 'mc.php?mod=mc&action=inbox&pvstart=0&order=4&add_action=read&id='.$iid
                                                               )
                                                          );
                                           
                                           a_redirect();
                                       }
                                       $gSmarty -> assign('mess', $_POST['mess']);
                                       $gSmarty -> assign('errs', $errs);     
                                   }
                               }
                               catch (MCException $mce)
                               {
                                   a_redirect($mce -> getCode());
                               }
                            }
                            else
                                a_redirect(2);
                            break;
                        case 'delete':
                            try
                            {
                                if ($id > 0)
                                   $mc -> Delete($id, $UserInfoId);
                                elseif (!empty($_POST['check']))
                                {
                                   $checks = $_POST['check'];
                                   while (list($key, $val) = each($checks))
                                         {
                                          $id = intval($key);
                                          $mc -> Delete($id, $UserInfoId);
                                         }
                                }

                                a_redirect();
                            }
                            catch (MCException $mce)
                            {
                            	a_redirect($mce -> getCode());
                            }

                            break;

                        default:
                            $mess =& $mc -> GetAll($UserInfoId, $type, $pvstart, $order);

                            // Generate data for paginal viewing
                            if ($mc -> ResOnPage() > 0 && $pvstart >= -1)
                            {
                                $pages = ceil($mess_cnt / $mc -> ResOnPage());
                                $gSmarty -> assign_by_ref('pages', $pages);
                                $pgArr    = array();
                                $curPage  = floor($pvstart / $mc -> ResOnPage());
                                for ($i = 0; $i < $pages; $i++)
                                {
                                    $pgArr[] = $i * $mc -> ResOnPage();
                                } 
                                $gSmarty -> assign_by_ref('pgArr', $pgArr);
                                $gSmarty -> assign('curPage'     , $curPage);
                                $gSmarty -> assign('ResOnPage'   , $mc -> ResOnPage());
                            }
                            else
                            {
                                $gSmarty -> assign('pages',1);
                            }
                            //deb($mess);
                            $gSmarty -> assign_by_ref('mess', $mess);
                            break;
                    }


                    $gSmarty -> assign_by_ref('mess_cnt', $mess_cnt);
                    break;
            }
            $gSmarty -> assign_by_ref('bc', $bc);
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $uinfo['status'] ? 'employer' : 'member').'/mc/_mc.html'));
        break;
        
        
        #******************************
        #        Send message
        #******************************
        case 'send': // send message
            
           
            require CLASS_PATH.'Model/Main/MC.php';
            $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, 20);

       
            if ($uid == UID && empty($friends_c))
            {
            	uni_redirect(PATH_ROOT.'mc.php');
            }
           
            if ($uid == UID)
            {
                $gSmarty -> assign_by_ref('frl', $gUser -> GetUserFriends($uid, 0, 0, 1, '', '', 'f.pdate DESC') );
            }
            
            $bl = $gUser -> CheckBlockUser( $uid, UID );
            $gSmarty -> assign('bl', $bl);
            
            $uCinfo =& $gUser -> Get($uid);
            if (empty($uCinfo))
            {
                uni_redirect(PATH_ROOT.'mc.php');
            }
            $gSmarty -> assign_by_ref('whom', $uCinfo);

            #$gSmarty -> assign_by_ref('UserInfo', $UserInfo);

            try
            {
                if (!empty($_POST['do']))
                {
                    $errs = array();
                    if (empty($_POST['mess']['subject']) || 1 > strlen($_POST['mess']['subject']))
                    {
                    	$errs[] = 'Please specify subject';
                    }
                    
                    if (empty($_POST['mess']['message']) || 1 > strlen($_POST['mess']['message']))
                    {
                    	$errs[] = 'Please specify message';
                    }
                                      
                    if (0 == count($errs) && empty($bl))
                    {
                	    $iid = $mc -> Add($uid, UID, $_POST['mess']['subject'], $_POST['mess']['message']);
                	    $gUser -> EditNewState($uid, 'mess', 1);
                        
                	    /** start wire */
                        include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                        $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                	    $gWire -> Edit(
                                       array( 
                                             UID,
                                             $uid,
                                             (1 == $uinfo['status'] ? $uinfo['name'].' '.$uinfo['lname'] : $uinfo['company']),
                                             3,
                                             'wrote you a message',
                                             'mc.php?mod=mc&action=inbox&pvstart=0&order=4&add_action=read&id='.$iid
                                             )
                                       );
                	    uni_redirect(PATH_ROOT.'mc.php?mesg=1');
                    } 
                    $gSmarty -> assign('mess', $_POST['mess']);
                    $gSmarty -> assign('errs', $errs);   
                }
            }
            catch (UsersException $cexc)
            {
                a_redirect($cexc -> getCode());
            }
            
            //$bc['Mail']       = PATH_ROOT . 'mc.php';
            //$bc['Send message'] = '';
            $gSmarty -> assign_by_ref('bc', $bc); 
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $uinfo['status'] ? 'employer' : 'member').'/mc/_send.html'));
        break;
                            
        //Default    
        default:
                	
    }
    $gSmarty -> assign('menu_act', $menu_act);
    $gSmarty -> assign_by_ref('bc', $bc);
    $gSmarty -> display('main.html'); 
    
}
catch (Exception $exc)
{
    sc_error($exc);
} 

?>