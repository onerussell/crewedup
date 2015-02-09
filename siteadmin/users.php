<?php
/**
 * Admin panel Users Module
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */
  
    require 'top.php' ;
    load_gz_compress($gSmarty);
    
    # include Users class
    require CLASS_PATH . 'Model/Security/Users.php';
    include_once CLASS_PATH . 'Ctrl/Crypt/Rc4.php';

    $gRc4   = new Crypt_RC4();
    $gRc4  -> setKey(CRYPT_KEY);         
    $user = new Users($gDb, array('table' => TB . 'users', 'friend' => TB . 'users_friend', 'members_cat' => TB . 'members_cat'), 20, $gRc4);
        
    
    $gSmarty -> config_load(DEF_LANGUAGE.'/fe_admin_users.conf');     
    // ------------------------------------------------------------------------
    // Input parameters check and assign to smarty object
    $action     = (isset($_REQUEST['action']))    ? $_REQUEST['action']          : 'view';   // - action -
    $what       = (isset($_REQUEST['what']))      ? $_REQUEST['what']            : 'list';   // - object for action -
    $pvstart    = (isset($_REQUEST['pvstart']))   ? intval($_REQUEST['pvstart']) : 0;        // - page displaciment -
    $ordercol   = (isset($_REQUEST['ordercol']))  ? $_REQUEST['ordercol']        : 'email';  // - database column for ordering -
    $orderdesc  = (isset($_REQUEST['orderdesc'])) ? $_REQUEST['orderdesc']       : 'asc';    // - ordering direction
    $code       = (isset($_REQUEST['code']))      ? intval($_REQUEST['code'])    : 0    ;    // - error code, 0 if no errors
  
    // ------------------------------------------------------------------------
  
    $uid = (isset($_REQUEST['uid'])) ? intval($_REQUEST['uid']) : 0;

    // ------------------------------------------------------------------------
    // Load module configuration and set smarty
    $main_content = '';
    $gSmarty -> assign('action'    , $action);
    $gSmarty -> assign('what'      , $what);
    $gSmarty -> assign('pvstart'   , $pvstart);
    $gSmarty -> assign('ordercol'  , $ordercol);
    $gSmarty -> assign('orderdesc' , $orderdesc);
    $gSmarty -> assign('siteAdr', PATH_ROOT);

try
{
    switch ($action)
    {
        case 'sstr':
                
                $sstr = (!empty($_REQUEST['sstr'])) ? strip_tags( trim($_REQUEST['sstr']) ) : '';
                $gSmarty -> assign('sstr', $sstr);
                
                if ($sstr)
                {
                    $pcnt    =  20;
                    $UA =& $user -> SearchUser($sstr, 1, 20, $pcnt);
              		/*
                    foreach ($UA as $UA_key => $UA_val)
                    {
                        foreach ($UA_val as $ua_KEY => $ua_VAL)
                            {
                            echo "$UA_key => $ua_KEY => $ua_VAL<br>";
                            }
                        echo"<hr>";
                    }
                    if (0 == sizeof($UA))
                    {
                        echo '<script language="javascript">confirm("No users found with keyword '.$sstr.'");</script>';
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    }*/
                    $gSmarty -> assign_by_ref('UA', $UA);

                // Generate data for paginal viewing
                    /*if ($user -> ResOnPage > 0)
                    {
                        $cnt   = sizeof($UA);
                        $pages = ceil($cnt / $user -> ResOnPage);
                        $gSmarty -> assign_by_ref('pages', $pages);
                        $pgArr = array();
                        for ($i = 0; $i < $pages; $i++)
                        {
                            $pgArr[] = $i * $user -> ResOnPage;
                        }
                        $gSmarty -> assign_by_ref('pgArr', $pgArr);
                        $gSmarty -> assign('curPage'     , floor($pvstart / $user -> ResOnPage));
                        $gSmarty -> assign('ResOnPage'   , $user -> ResOnPage);
                    }
                    else
                     */ $gSmarty -> assign('pages',1);
                    
                    }
                else a_redirect($ordercol, $orderdesc, $pvstart);
                                
            break;
        
        case 'signin':
            
            if ($uid)
            { 
                $cl = $user -> CheckLoginSet( $uid );
                uni_redirect( PATH_ROOT.'?mod=login&cl='.$cl.'&uid='.$uid );
            }
            
        break;    
        
        case 'change':
            if ($what == 'user') // change user info
            {
                $ui = $user -> Get($uid);
                
                $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                if ($do == 1)
                {
                    $fm = $_POST['fm'];
                    if (isset($_REQUEST['cancel']))
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    else
                    {
                        $fm['modules'] = '';
                        try
                        {  
                            $fm['status'] = $ui['status'];
                            
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
                            elseif ($user -> CheckEmail($fm['email'], $uid))
                            {
                                $errx[] = 9;
                            }                            
                            
                            if (!empty($fm['pass']) || !empty($fm['pass2']))
                            {
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
                            
                            $fm['no_age'] = (empty($ui['no_age'])) ? 0 : 1;
                            $user->Change($uid, $fm);
                            a_redirect($ordercol, $orderdesc, $pvstart);
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
                        } 
                    }     
                }
                else
                {
                    $UserInfo =& $ui;
                }
  
                $UserInfo['uid'] = $uid;

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
                                    
                $gSmarty -> assign_by_ref('fm', $UserInfo);
            }
            else if ($what == 'status') // change user status
            {
                $user -> ChangeStatus($uid, $_REQUEST['status']);
                a_redirect($ordercol, $orderdesc, $pvstart);
            }
            $day = array();
            for ($i = 1; $i <= 31; $i++)
            {
                $day[] = $i;
            }
            $month = array();
            for ($i = 1; $i <= 12; $i++)
            {
                $month[] = $i;
            }
            $year = array();
            for ($i = date("Y", mktime()); $i >= date("Y", mktime())-90; $i--)
            {
                $year[] = $i;
            }
            $gSmarty -> assign_by_ref('day', $day);
            $gSmarty -> assign_by_ref('month', $month);
            $gSmarty -> assign_by_ref('year', $year);   
        break;
  


        case 'view':
            
            //switch ($what)
            
            
            if ($what == 'list') // users list
            {
            	if ($code > 0)
                    $gSmarty -> assign('UserLastError', $code);
                  
                $UA =& $user->GetAll($pvstart, $ordercol, $orderdesc);
                /*
                foreach ($UA as $UA_key => $UA_val)
                    {
                        foreach ($UA_val as $ua_KEY => $ua_VAL)
                            {
                            echo "$UA_key => $ua_KEY => $ua_VAL<br>";
                            }
                        echo"<hr>";
                    }
                */
                $gSmarty -> assign_by_ref('UA', $UA);

                // Generate data for paginal viewing
                if ($user -> ResOnPage > 0)
                {
                    $cnt   = $user -> Count();
                    $pages = ceil($cnt / $user -> ResOnPage);
                    $gSmarty -> assign_by_ref('pages', $pages);
                    $pgArr = array();
                    for ($i = 0; $i < $pages; $i++)
                    {
                        $pgArr[] = $i * $user -> ResOnPage;
                    }
                    $gSmarty -> assign_by_ref('pgArr', $pgArr);
                    $gSmarty -> assign('curPage'     , floor($pvstart / $user -> ResOnPage));
                    $gSmarty -> assign('ResOnPage'   , $user -> ResOnPage);
                }
                else
                   $gSmarty -> assign('pages',1);
  
        }
        break;
        
        
        case 'active':
            if ($uid)
            {
                $ui = $user -> Get($uid);
                $user -> ChgField('active', $ui['active'] ? 0 : 1, $uid, 1);
            }
            a_redirect($ordercol, $orderdesc, $pvstart);
        break;    
        
        case 'chgfeatured':
        	if (!empty($_REQUEST['uid']) && is_numeric($_REQUEST['uid']))
        	{
        		$val = (!empty($_REQUEST['val']) && 1 == $_REQUEST['val']) ? $_REQUEST['val'] : 0;
        		$user -> ChgFeatured($_REQUEST['uid'], $val);
        	}
        	a_redirect($ordercol, $orderdesc, $pvstart);
        break;	
        
        case 'delete':
            if ($what == 'user') // delete specified user only (his orders is not deleted)
            {
                $user -> Delete($uid);
                a_redirect($ordercol, $orderdesc, $pvstart);
            }
        break;
    }

}
catch (Exception $exc)
{
    sc_error($exc);
}    
    
    //compile templates-------------------------------------
    $mc = $gSmarty -> fetch('mods/Security/Fe/admin_users.html');  
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    include 'bottom.php';

    function a_redirect($orderCol, $orderDesc, $pvStart, $code = 0)
    {
        $code    = intval($code);
        $pvStart = intval($pvStart);
        uni_redirect('users.php?action=view&what=list&ordercol='.$orderCol.'&orderdesc='.$orderDesc.'&pvstart='.$pvStart.'&code='.$code);
    }

?>