<?php
/**
 * Faq Module
 *
 * @package    engine37
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2007 engine37 Team
 * @link       http://engine37.com
 */

require 'top.php';


    #Vars
    $action = (isset($_REQUEST['action']))    ? $_REQUEST['action']    :  '';
    $gSmarty -> assign('action', $action);

    #Main part
    try
    {

        switch ($action)
        {
        	case 'get':
                
        		require CLASS_PATH . 'Model/Security/Users.php';
                $mUser = new Users($gDb, array('table' => TB . 'users', 'friend' => TB . 'users_friend', 'members_cat' => TB . 'members_cat'), 20, $gRc4);
        		
   
    
        		$nu        = $mUser -> GetNewsletterUsers(); 
        		$newfile   = '';
        		foreach ($nu as $k => &$v)
        		{
        		    $newfile .= (1==$v['status'] ? str_replace(',', '', $v['name'].' '.$v['lname']) : str_replace(',', '', $v['company'])).', '.$v['email'].''."\n";	
        		}
        		
        		$mime_type = 'application/x-zip';
    			header('Content-Type: ' . $mime_type);
                header('Content-Disposition: inline; filename="' . date("m_d_Y") . '_nls.csv"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                echo $newfile;
                exit;
        	break;
        		
            #default output
            default:
            	
     	
        }


    }
    catch (Exception $e)
    {
        echo $e -> getMessage();
        exit;
    }

    #display and close
    $mc = $gSmarty -> fetch('mods/Info/Mails.html');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    require 'bottom.php';
?>