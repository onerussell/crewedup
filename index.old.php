<?php
require '_top.php';

#*************************************************************
# Main part
#*************************************************************


try
{
    switch ($mod)
    {
        #**********************************
        #           Registration Page
        #**********************************
        case 'reg':
             
            $rt = (!empty($_REQUEST['rt']) && (1 == $_REQUEST['rt'] || 2 == $_REQUEST['rt'])) ? $_REQUEST['rt'] : 0;

            switch ($rt)
            {
                /** Crew members registration */
                case 1:
                    
                    $bc['Crew Members Registration'] = PATH_ROOT.'reg?rt=1';
                    $gSmarty -> assign_by_ref('bc', $bc);
                    $gSmarty -> assign('bcw', array('All Members', PATH_ROOT.'crew.php'));
                    $gSmarty -> assign('menu_act', 51);
                    
                    
                    if (isset($_POST['fm']) && 0 < count($_POST['fm']))
                    {
                        $fm = $_POST['fm'];
                        try
                        {
                            $fm['status'] = $rt;
                            $errx         = array();
                            if (empty($fm['email']))
                            {
                                $errx[] = 6;
                            }
                            elseif (!verify_email($fm['email']))
                            {
                                $errx[] = 7;
                            }
                            elseif (64 < strlen($fm['email']))
                            {
                                $errx[] = 8;
                            }
                            elseif ($gUser -> CheckEmail($fm['email']))
                            {
                                $errx[] = 9;
                            }

                            if (empty($fm['name']))
                            {
                                $errx[] = 10;
                            }
                            elseif (2 > strlen($fm['name']))
                            {
                                $errx[] = 11;
                            }
                            elseif (100 < strlen($fm['name']))
                            {
                                $errx[] = 12;
                            }

                            if (empty($fm['lname']))
                            {
                                $errx[] = 13;
                            }
                            elseif (2 > strlen($fm['lname']))
                            {
                                $errx[] = 14;
                            }
                            elseif (100 < strlen($fm['lname']))
                            {
                                $errx[] = 15;
                            }
                             
                            if (empty($fm['pass']) || empty($fm['pass2']) || strlen($fm['pass']) < 4)
                            {
                                $errx[] = 16;
                            }
                            elseif (20 < strlen($fm['pass']))
                            {
                                $errx[] = 17;
                            }
                            elseif ($fm['pass'] != $fm['pass2'])
                            {
                                $errx[] = 18;
                            }
                             
                            if (empty($fm['state']))
                            {
                                $errx[] = 20;
                            }

                            if (empty($fm['gender']))
                            {
                                $errx[] = 21;
                            }

                            if (empty($fm['confirm']))
                            {
                                $errx[] = 22;
                            }

                            if (!empty($errx))
                            {
                                throw new UsersException($errx);
                            }
                            $id = $gUser -> Add($fm);
                            uni_redirect(PATH_ROOT);
                        }
                        catch (UsersException $cexc)
                        {
                            $errc = unserialize($cexc -> getMessage());
                            for ($i = 0; $i < count($errc); $i++)
                            {
                                if (16 <= $errc[$i] && 18 >= $errc[$i])
                                {
                                    $pass_err = 1;
                                }
                                $errs[] = $gSmarty -> get_config_vars('reg'.$errc[$i]);
                            }

                            if (isset($pass_err))
                            {
                                $gSmarty -> assign('pass_err', $pass_err);
                            }
                            $gSmarty -> assign_by_ref('errs', $errs);
                            $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                        }
                    }
                    for ($i = 1; $i <= 31; $i++)
                    {
                        $days[$i] = ($i < 10 ? '0' : '').$i;
                    }
                    for ($i = 1; $i <= 12; $i++)
                    {
                        $months[$i] = ($i < 10 ? '0' : '').$i;
                    }
                    for ($i = date("Y")-17; $i >= date("Y")-99; $i--)
                    {
                        $years[$i] = $i;
                    }

                    include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                    $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                    $gSmarty -> assign_by_ref('days', $days);
                    $gSmarty -> assign_by_ref('months', $months);
                    $gSmarty -> assign_by_ref('years', $years);
                    $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDiv('US'));
                    $gSmarty -> assign('mod', 'crew');
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/reg/_member.html'));
                    break;
                     
                    /** Employers registration */
                case 2:
                    
                    $bc['Employers Registration'] = PATH_ROOT.'reg?rt=2';
                    $gSmarty -> assign_by_ref('bc', $bc);
                    $gSmarty -> assign('bcw', array('All Employers', PATH_ROOT.'employers.php'));
                    $gSmarty -> assign('menu_act', 41);
                    
                    if (isset($_POST['fm']) && 0 < count($_POST['fm']))
                    {
                        $fm = $_POST['fm'];
                        try
                        {
                            $fm['status'] = $rt;
                            $errx         = array();

                            if (empty($fm['company']))
                            {
                                $errx[] = 23;
                            }
                            elseif (2 > strlen($fm['company']))
                            {
                                $errx[] = 24;
                            }
                            elseif (100 < strlen($fm['company']))
                            {
                                $errx[] = 25;
                            }

                            if (empty($fm['email']))
                            {
                                $errx[] = 6;
                            }
                            elseif (!verify_email($fm['email']))
                            {
                                $errx[] = 7;
                            }
                            elseif (64 < strlen($fm['email']))
                            {
                                $errx[] = 8;
                            }
                            elseif ($gUser -> CheckEmail($fm['email']))
                            {
                                $errx[] = 9;
                            }

                            if (empty($fm['name']))
                            {
                                $errx[] = 26;
                            }
                            elseif (2 > strlen($fm['name']))
                            {
                                $errx[] = 27;
                            }
                            elseif (100 < strlen($fm['name']))
                            {
                                $errx[] = 28;
                            }

                             
                            if (empty($fm['pass']) || empty($fm['pass2']) || strlen($fm['pass']) < 4)
                            {
                                $errx[] = 16;
                            }
                            elseif (20 < strlen($fm['pass']))
                            {
                                $errx[] = 17;
                            }
                            elseif ($fm['pass'] != $fm['pass2'])
                            {
                                $errx[] = 18;
                            }
                             
                            if (empty($fm['state']))
                            {
                                $errx[] = 20;
                            }

                            if (empty($fm['confirm']))
                            {
                                $errx[] = 22;
                            }

                            if (!empty($errx))
                            {
                                throw new UsersException($errx);
                            }

                            $fm['person_title'] = (!empty($fm['prof1']) && 1 == $fm['prof1']) ? 'production company' : 'rental house';

                            $id = $gUser -> Add($fm);
                            uni_redirect(PATH_ROOT);
                        }
                        catch (UsersException $cexc)
                        {
                            $errc = unserialize($cexc -> getMessage());
                            for ($i = 0; $i < count($errc); $i++)
                            {
                                if (16 <= $errc[$i] && 18 >= $errc[$i])
                                {
                                    $pass_err = 1;
                                }
                                $errs[] = $gSmarty -> get_config_vars('reg'.$errc[$i]);
                            }

                            if (isset($pass_err))
                            {
                                $gSmarty -> assign('pass_err', $pass_err);
                            }
                            $gSmarty -> assign_by_ref('errs', $errs);
                            $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                        }
                    }

                    include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                    $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                    $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDiv('US'));

                    $gSmarty -> assign('mod', 'employers');
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/reg/_employer.html'));
                    break;

                default:
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/reg/_reg.html'));
            }

            break;
             
             
            #***********************************
            #  Login Page
            #***********************************
                case 'login':
                    if (!empty($gSystemLogin))
                    {
                        uni_redirect(PATH_ROOT . 'profile.php');
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/reg/_signin.html'));
                    break;
                     
                    #***********************************
                    #  Restore password
                    #***********************************
                case 'forgot':

                    if (isset($_POST['UserInfo']) && 0 < count($_POST['UserInfo']))
                    {
                        $forgoterr = array();

                        if(
                        !isset($_POST['UserInfo']['email']) ||
                        !$gUser -> EmailValidate($_POST['UserInfo']['email'])
                        )
                        {
                            $forgoterr[] = 2;
                        }

                        if (0 == count($forgoterr))
                        {
                            $u = $gUser -> Get( $gUser -> GetByEmail($_POST['UserInfo']['email']) );
                            if (!isset($u['email']) || $u['email'] != trim($_POST['UserInfo']['email']))
                            {
                                $forgoterr[] = 3;
                            }
                            else
                            {
                                $newPass = $gUser -> RestorePassword($u['uid'], $u['email']);
                                $gSmarty -> assign('newPass', $newPass);
                                $gSmarty -> assign('email',   $u['email']);
                                $gSmarty -> assign('SUPPORT_SITENAME', SUPPORT_SITENAME);

                                include CLASS_PATH.'Ctrl/Mail/libmail.php';
                                $m = new Mail;
                                $m -> From( SUPPORT_EMAIL );
                                $m -> Subject('Password restore system '.SUPPORT_SITENAME);
                                $m -> Priority(3);

                                $descr  = $gSmarty -> fetch('mails/newpass.html');
                                #deb($descr);
                                $m -> Body( $descr);
                                $m -> To( $u['email'] );
                                $m -> Send();

                                #all ok
                                uni_redirect(PATH_ROOT."index.php?mod=forgot&send=ok", 1);
                            }
                        }

                        $gSmarty -> assign_by_ref('forgoterr', $forgoterr);
                        $gSmarty -> assign_by_ref('UserInfo',$_POST['UserInfo']);
                    }
                    if (isset($_REQUEST['send']) && 'ok' == $_REQUEST['send'])
                    {
                        $gSmarty -> assign('send', 1);
                    }
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/reg/_forgot.html'));
                    break;

                    #***********************************
                    #          Edit Account Settings
                    #***********************************
                case 'profile':
                    if (empty($gSystemLogin))
                    {
                        uni_redirect( PATH_ROOT . '?mod=login');
                    }
                    if ($is_user)
                    {
                        $ui = $gUser -> Get($uid);
                    }
                    else
                    {
                        uni_redirect( PATH_ROOT . 'profile.php?uid='.$uid );
                    }
                    $gSmarty -> assign_by_ref('ui', $ui);

                    /** Get Blog in left menu */
                    include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
                    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
                    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));

                    /** Last added contacts in right menu */
                    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));

                    /** some gears in right menu */
                    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));



                    /** Edit Member Profile */
                    if (!empty($_REQUEST['save']))
                    {
                        $gSmarty -> assign('save', 1);
                    }

                    switch ($ui['status'])
                    {
                        /** Member */
                        case 1:

                            if (!empty($_POST['fm']))
                            {
                                $fm = $_POST['fm'];

                                try
                                {
                                    $errx         = array();
                                    if (empty($fm['email']))
                                    {
                                        $errx[] = 6;
                                    }
                                    elseif (!verify_email($fm['email']))
                                    {
                                        $errx[] = 7;
                                    }
                                    elseif (64 < strlen($fm['email']))
                                    {
                                        $errx[] = 8;
                                    }
                                    elseif ($gUser -> CheckEmail($fm['email'], $uid))
                                    {
                                        $errx[] = 9;
                                    }
                                    /*
                                     elseif ($fm['email'] != $ui['email'] && empty($fm['opass']))
                                     {
                                     $errx[] = 31;
                                     $_POST['fm']['showpass'] = 1;
                                     }
                                     */
                                    if (empty($fm['name']))
                                    {
                                        $errx[] = 10;
                                    }
                                    elseif (2 > strlen($fm['name']))
                                    {
                                        $errx[] = 11;
                                    }
                                    elseif (100 < strlen($fm['name']))
                                    {
                                        $errx[] = 12;
                                    }

                                    if (empty($fm['lname']))
                                    {
                                        $errx[] = 13;
                                    }
                                    elseif (2 > strlen($fm['lname']))
                                    {
                                        $errx[] = 14;
                                    }
                                    elseif (100 < strlen($fm['lname']))
                                    {
                                        $errx[] = 15;
                                    }

                                    if (!empty($fm['pass']) || !empty($fm['pass2']))
                                    {
                                        /*
                                         if (empty($fm['opass']))
                                         {
                                         $errx[] = 30;
                                         }
                                         elseif ( crypt($fm['opass'], $ui['pass']) != $ui['pass'] )
                                         {
                                         $errx[] = 29;
                                         }
                                         else
                                         */
                                        if (empty($fm['pass']) || empty($fm['pass2']) || strlen($fm['pass']) < 4)
                                        {
                                            $errx[] = 16;
                                        }
                                        elseif (20 < strlen($fm['pass']))
                                        {
                                            $errx[] = 17;
                                        }
                                        elseif ($fm['pass'] != $fm['pass2'])
                                        {
                                            $errx[] = 18;
                                        }
                                    }

                                    if (empty($fm['state']))
                                    {
                                        $errx[] = 20;
                                    }

                                    if (empty($fm['gender']))
                                    {
                                        $errx[] = 21;
                                    }


                                    if (!empty($errx))
                                    {
                                        throw new UsersException($errx);
                                    }
                                    $fm['status'] = $ui['status'];
                                    $gUser -> Change($uid, $fm);

                                    if (!empty($fm['pass']) || $fm['email'] != $ui['email'])
                                    {
                                        /** relogin user */

                                        $gUser -> Logout();
                                        $_POST['system_login'] = $fm['email'];
                                         
                                        $ui    = $gUser -> Get( $uid );
                                        $gRc4 -> decrypt( $ui['pass'] );
                                        $_POST['system_pass']  = $ui['pass'];
                                        $gUser -> CheckLogin(CURRENT_SCP, 1);
                                    }
                                    uni_redirect(PATH_ROOT . '?mod=profile&uid='.$uid.'&save=1');
                                }
                                catch (UsersException $cexc)
                                {
                                    $errc = unserialize($cexc -> getMessage());
                                    for ($i = 0; $i < count($errc); $i++)
                                    {
                                        if (16 <= $errc[$i] && 18 >= $errc[$i])
                                        {
                                            $pass_err = 1;
                                        }
                                        $errs[] = $gSmarty -> get_config_vars('reg'.$errc[$i]);
                                    }

                                    if (isset($pass_err))
                                    {
                                        $gSmarty -> assign('pass_err', $pass_err);
                                    }
                                    $gSmarty -> assign_by_ref('errs', $errs);
                                    $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                                }
                            }
                            else
                            {
                                $gSmarty -> assign_by_ref('fm', $ui);
                            }

                            for ($i = 1; $i <= 31; $i++)
                            {
                                $days[$i] = ($i < 10 ? '0' : '').$i;
                            }
                            for ($i = 1; $i <= 12; $i++)
                            {
                                $months[$i] = ($i < 10 ? '0' : '').$i;
                            }
                            for ($i = date("Y")-17; $i >= date("Y")-99; $i--)
                            {
                                $years[$i] = $i;
                            }

                            include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                            $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                            $gSmarty -> assign_by_ref('days', $days);
                            $gSmarty -> assign_by_ref('months', $months);
                            $gSmarty -> assign_by_ref('years', $years);
                            $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDiv('US'));

                            break;

                            /** Employer */
                        case 2:

                            if (!empty($_POST['fm']))
                            {
                                $fm = $_POST['fm'];
                                try
                                {
                                    $errx         = array();

                                    if (empty($fm['company']))
                                    {
                                        $errx[] = 23;
                                    }
                                    elseif (2 > strlen($fm['company']))
                                    {
                                        $errx[] = 24;
                                    }
                                    elseif (100 < strlen($fm['company']))
                                    {
                                        $errx[] = 25;
                                    }

                                    if (empty($fm['email']))
                                    {
                                        $errx[] = 6;
                                    }
                                    elseif (!verify_email($fm['email']))
                                    {
                                        $errx[] = 7;
                                    }
                                    elseif (64 < strlen($fm['email']))
                                    {
                                        $errx[] = 8;
                                    }
                                    elseif ($gUser -> CheckEmail($fm['email'], $uid))
                                    {
                                        $errx[] = 9;
                                    }

                                    if (empty($fm['name']))
                                    {
                                        $errx[] = 26;
                                    }
                                    elseif (2 > strlen($fm['name']))
                                    {
                                        $errx[] = 27;
                                    }
                                    elseif (100 < strlen($fm['name']))
                                    {
                                        $errx[] = 28;
                                    }

                                     
                                    if (!empty($fm['pass']) || !empty($fm['pass2']))
                                    {
                                        /*
                                         if (empty($fm['opass']))
                                         {
                                         $errx[] = 30;
                                         }
                                         elseif ( crypt($fm['opass'], $ui['pass']) != $ui['pass'] )
                                         {
                                         $errx[] = 29;
                                         }
                                         else
                                         */
                                        if (empty($fm['pass']) || empty($fm['pass2']) || strlen($fm['pass']) < 4)
                                        {
                                            $errx[] = 16;
                                        }
                                        elseif (20 < strlen($fm['pass']))
                                        {
                                            $errx[] = 17;
                                        }
                                        elseif ($fm['pass'] != $fm['pass2'])
                                        {
                                            $errx[] = 18;
                                        }
                                    }
                                     
                                    if (empty($fm['state']))
                                    {
                                        $errx[] = 20;
                                    }

                                    if (!empty($errx))
                                    {
                                        throw new UsersException($errx);
                                    }

                                    $fm['status'] = $ui['status'];
                                    $gUser -> Change($uid, $fm);

                                    if (!empty($fm['pass']) || $fm['email'] != $ui['email'])
                                    {
                                        /** relogin user */

                                        $gUser -> Logout();
                                        $_POST['system_login'] = $fm['email'];

                                        $ui    = $gUser -> Get( $uid );
                                        $gRc4 -> decrypt( $ui['pass'] );
                                        $_POST['system_pass']  = $ui['pass'];
                                        $gUser -> CheckLogin(CURRENT_SCP, 1);
                                    }
                                    uni_redirect(PATH_ROOT . '?mod=profile&uid='.$uid.'&save=1');
                                }
                                catch (UsersException $cexc)
                                {
                                    $errc = unserialize($cexc -> getMessage());
                                    for ($i = 0; $i < count($errc); $i++)
                                    {
                                        if (16 <= $errc[$i] && 18 >= $errc[$i])
                                        {
                                            $pass_err = 1;
                                        }
                                        $errs[] = $gSmarty -> get_config_vars('reg'.$errc[$i]);
                                    }

                                    if (isset($pass_err))
                                    {
                                        $gSmarty -> assign('pass_err', $pass_err);
                                    }
                                    $gSmarty -> assign_by_ref('errs', $errs);
                                    $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                                }
                            }
                            else
                            {
                                $gSmarty -> assign_by_ref('fm', $ui);
                            }
                            include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                            $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                            $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDiv('US'));
                            break;
                    }

                    $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
                    $bc['Account Settings'] = PATH_ROOT.'?mod=profile&uid='.$uid;
                    $gSmarty -> assign_by_ref('bc', $bc);
                    $gSmarty -> assign('menu_act', 2);
                    
                    
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/_account_settings.html'));
                    break;

                    #***********************************
                    #          Edit notification
                    #***********************************
                           case 'notify':
                            if (!IS_AUTH)
                                uni_redirect(PATH_ROOT.'?mod=login');
                            
                            $ui = $gUser -> Get(UID);
                            $gSmarty -> assign_by_ref('ui', $ui);
                            
                            if (1 == _vp('do'))
                            {
                                $gUser -> UpdateNotifySettings(UID, _vp('NI'));
                                uni_redirect(PATH_ROOT.'?mod=notify');
                            }
                            else
                                $NI = $gUser -> GetNotifySettings(UID);
                            $gSmarty -> assign_by_ref('NI', $NI);
		          	
                            /** Get Blog in left menu */
                            require_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
                            $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
                            $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
                            
                            /** Last added contacts in right menu */
                            $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));
                            
                             /** some gears in right menu */
                            require_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                            $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                            $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
                            
                            $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
                            $bc['Account Settings'] = PATH_ROOT.'?mod=profile&uid='.$uid;
                            $gSmarty -> assign_by_ref('bc', $bc);
                            $gSmarty -> assign('menu_act', 2);                            
                            
                            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/_account_notify.html'));
                            break;

                            #***********************************
                            #          Edit Profile (About me, Interests etc.)
                            #***********************************
                        case 'bprofile':

                            if (empty($gSystemLogin))
                            {
                                uni_redirect( PATH_ROOT . '?mod=login');
                            }
                            if ($is_user)
                            {
                                $ui = $gUser -> Get($uid);
                            }
                            else
                            {
                                uni_redirect( PATH_ROOT . 'profile.php?uid='.$uid );
                            }
                            
                            $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
                            $menu_act         = 2;
                            $bc['Edit Profile'] = PATH_ROOT.'?mod=bprofile&uid='.$uid;
                            $gSmarty -> assign_by_ref('bc', $bc); 
                            $gSmarty -> assign('menu_act', $menu_act);
                            
                            $gSmarty -> assign_by_ref('ui', $ui);

                            if (!empty($_REQUEST['save']))
                            {
                                $gSmarty -> assign('save', 1);
                            }

                            if (!empty($_REQUEST['delphoto']))
                            {
                                $gUser -> DelPhoto( $uid );
                                uni_redirect( PATH_ROOT . '?mod=bprofile&uid='.$uid.'&save=1' );
                            }

                            if (!empty($_POST['fm']))
                            {
                                $errs = array();
                                $fm   = $_POST['fm'];

                                $fn = '';
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
                                            require_once CLASS_PATH . 'Ctrl/Image/Image_Transform.php';
                                            require_once CLASS_PATH . 'Ctrl/Image/Image_Transform_Driver_GD.php';
                                            i_crop_copy(600, 450,
                                            $_FILES['fm']['tmp_name']['image'],
                                            DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                            2);
                                            i_crop_copy(150, 150,
                                            DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                            DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                            1);
                                            i_crop_copy(32, 32,
                                            DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                            DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/s_'.  $fn,
                                            1);
                                        }
                                    }

                                }

                                if (empty($errs))
                                {
                                    if (1 == $ui['status'])
                                    {
                                        $gUser -> EditMembersCat( $ui['prof1'], -1);
                                        $gUser -> EditMembersCat( $ui['prof2'], -1);
                                        $gUser -> EditMembersCat( $ui['prof3'], -1);
                                        
                                        $pt =  $fm['prof1'];
                                        $pt .= (!empty($fm['prof2'])) ? ( ($pt ? ', ' : '') . $fm['prof2'] ) : '';
                                        $pt .= (!empty($fm['prof3'])) ? ( ($pt ? ', ' : '') . $fm['prof3'] ) : '';
                                        $fm['person_title'] = $pt; 
                                        
                                        $gUser -> EditMembersCat( $fm['prof1'], 1);
                                        $gUser -> EditMembersCat( $fm['prof2'], 1);
                                        $gUser -> EditMembersCat( $fm['prof3'], 1);                                         
                                    }
                                    else
                                    {
                                        $fm['person_title'] = (!empty($fm['prof1']) && 1 == $fm['prof1']) ? 'production company' : 'rental house';
                                    }
                                    
                                    if (!empty($fm['public_mail']))
                                    {
                                        if (!verify_email($fm['public_mail']))
                                        {    
                                            $fm['public_mail'] = '';
                                        }
                                    }
                                    
                                    $gUser -> SaveProfile($uid, $fm, $fn);
                                    uni_redirect( PATH_ROOT . '?mod=bprofile&uid='.$uid.'&save=1' );
                                }
                                $gSmarty -> assign_by_ref('errs', $errs);
                                $gSmarty -> assign_by_ref('fm', $fm);

                            }
                            else
                            {
                                $gSmarty -> assign_by_ref('fm', $ui);
                            }


                            include_once '_prof_ar.php';
                            $gSmarty -> assign_by_ref( 'prof', $prof );
                            $gSmarty -> assign_by_ref( 'comp_prof', $comp_prof);

                            /** Get Blog in left menu */
                            include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
                            $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
                            $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));

                            /** Last added contacts in right menu */
                            $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));

                             /** some gears in right menu */
                            include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php';
                            $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
                            $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
                            
                            /** Show Profile */
                            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/_account_profile.html'));
                            break;
                            #**********************************
                            #           Static Pages
                            #**********************************
                        case 'page':
                            $pa = array('about', 'advert', 'promo', 'contactus', 'privacy', 'terms', 'help');
                             
                            if (!$pn || !in_array($pn, $pa))
                            {
                                $pn = $pa[0];
                            }
                            
                            include CLASS_PATH . 'Model/Main/Spages.php';
                            $gSpage = new Spages($gDb, TB.'spagescat', TB.'spages', 'spages.php');
                            $pi = $gSpage -> GetPageInfo(0, $pn);  
                            if (!empty($pi))
                            {
                                $gSmarty -> assign_by_ref('pi', $pi);
                                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/page/_page.html'));
                            }
                            else
                            {
                                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/page/_'.$pn.'.html'));
                            }
                            break;


                            #******************************************************
                            #            Main page
                            #******************************************************
                        default:
                            $gSmarty -> assign('index', 1);
                            
                            include_once CLASS_PATH . 'Model/Main/Model_Main_Jobs.php'; 
                            $gJobs =& new Model_Main_Jobs( $gDb, array('jobs' => TB.'jobs', 'users' => TB.'users'));
    
                            /** new members */
                            $gSmarty -> assign_by_ref('lu', $gUser -> GetUserList(1, 1, 'u.dt DESC', 0, 4) );
                            
                            /** new jobs */
                            $gSmarty -> assign_by_ref('jl', $gJobs -> GetList(0, 0, 0, 3, '', ''));

                            /** tags */
                            $gSmarty -> assign_by_ref( 'tags', $gUser -> GetMembersCatAsTags( 30 ) );
                            
                            /** recent blog */
                            include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
                            $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
                            $gSmarty -> assign_by_ref( 'blogs', $gBlog -> GetRecentList(0, 5, 'pdate DESC') );
                            
                            /** featured users */
                            $gSmarty -> assign_by_ref('fl', $gUser -> GetUserList(1, -1, '', 0, 5, 0, '', '', 0, '', 1) );
                            
							/** text block */
							include CLASS_PATH . 'Model/Main/Spages.php';
                            $gSpage = new Spages($gDb, TB.'spagescat', TB.'spages', 'spages.php');
	                        $gSmarty -> assign('homepage', $gSpage -> GetPageInfo(0, 'homepage'));  
                            /** display */
                            $gSmarty -> display('index.html');
                            require '_bottom.php';
                            exit();
                            break;
    }
     
}
catch (Exception $exc)
{
    sc_error($exc);
}

#Display template
$gSmarty -> display('main.html');

#*************************************************************
# End part
#*************************************************************
require '_bottom.php';
?>