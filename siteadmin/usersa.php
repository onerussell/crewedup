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
 
    $gSmarty -> config_load(DEF_LANGUAGE.'/admin_users.conf');     
    // ------------------------------------------------------------------------
    // Input parameters check and assign to smarty object
    $action     = (isset($_REQUEST['action']))    ? $_REQUEST['action']          : 'view';   // - action -
    $what       = (isset($_REQUEST['what']))      ? $_REQUEST['what']            : 'list';   // - object for action -
    $pvstart    = (isset($_REQUEST['pvstart']))   ? intval($_REQUEST['pvstart']) : 0;        // - page displaciment -
    $ordercol   = (isset($_REQUEST['ordercol']))  ? $_REQUEST['ordercol']        : 'login';  // - database column for ordering -
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
  
try
{
    switch ($action)
    {
        case 'change':
            if ($what == 'user') // change user info
            {
                $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                if ($do == 1)
                {
                    $UserInfo = $_POST['UserInfo'];
                    if (isset($_REQUEST['cancel']))
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    else
                    {
                        if (!empty($UserInfo['modulesx']))
                            $UserInfo['modules'] = ';'.join(';', $UserInfo['modulesx']).';';
                         else
                            $UserInfo['modules'] = '';
                        $gUser->Change($uid, $UserInfo);
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    }
                }
                else
                {
                    $UserInfo = $gUser->Get($uid);
                }
  
                $UserInfo['uid'] = $uid;
  
                $gSmarty -> assign_by_ref('UserInfo', $UserInfo);
            }
            else if ($what == 'status') // change user status
            {
                $gUser -> ChangeStatus($uid, $_REQUEST['status']);
                a_redirect($ordercol, $orderdesc, $pvstart);
            }
  
        break;
  
        case 'add':
            if ($what == 'user') // add new user
            {
                $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                if ($do == 1)
                {
                    if (isset($_REQUEST['cancel']))
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    else
                    {
                        if (!empty($_POST['UserInfo']['modulesx']))
                            $_POST['UserInfo']['modules'] = ';'.join(';', $_POST['UserInfo']['modulesx']).';';
                        else
                            $_POST['UserInfo']['modules'] = '';

                        $gUser -> Add($_POST['UserInfo']);
                        $gSmarty -> assign_by_ref('UserInfo',$_POST['UserInfo']);
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    } 
                }
                else
                {
                    $gSmarty -> assign_by_ref('UserInfo' , $UserInfo);
                }

            }
        break;

        case 'view':
            if ($what == 'list') // users list
            {
                if ($code > 0)
                    $gSmarty -> assign('UserLastError', $code);

                $UA =& $gUser->GetAll($pvstart, $ordercol, $orderdesc);

                $gSmarty -> assign_by_ref('UA', $UA);

                // Generate data for paginal viewing
                if ($gUser -> ResOnPage > 0)
                {
                    $cnt   = $gUser -> Count();
                    $pages = ceil($cnt / $gUser -> ResOnPage);
                    $gSmarty -> assign_by_ref('pages', $pages);
                    $pgArr = array();
                    for ($i = 0; $i < $pages; $i++)
                    {
                        $pgArr[] = $i * $gUser -> ResOnPage;
                    }
                    $gSmarty -> assign_by_ref('pgArr', $pgArr);
                    $gSmarty -> assign('curPage'     , floor($pvstart / $gUser -> ResOnPage));
                    $gSmarty -> assign('ResOnPage'   , $gUser -> ResOnPage);
                }
                else
                   $gSmarty -> assign('pages',1);
  
            }

        break;
        
        case 'delete':
            if ($what == 'user') // delete specified user only (his orders is not deleted)
            {
                $gUser -> Delete($uid);
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
    $mc = $gSmarty -> fetch('mods/Security/Be/admin_users.html');  
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    include 'bottom.php';

    function a_redirect($orderCol, $orderDesc, $pvStart, $code = 0)
    {
        $code    = intval($code);
        $pvStart = intval($pvStart);
        uni_redirect('usersa.php?action=view&what=list&ordercol='.$orderCol.'&orderdesc='.$orderDesc.'&pvstart='.$pvStart.'&code='.$code);
    }
?>