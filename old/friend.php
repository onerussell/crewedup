<?php
    include '_top.php';
    $gSmarty -> assign('mod', 'friend');
try
{
    /*
    if (empty($in_site))
    {
        uni_redirect(PATH_ROOT . 'login/');
    }
    */

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

    include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
    
    /** Get Blog in right menu */               
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
     
    /** some gears in right menu */
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));
     
    /** breadcrumb */
    if ($is_user)
    {
        $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
        $bc['Contacts']   = PATH_ROOT . 'friend'.$uid;
        $menu_act         = 2; 
    }
    else
    {
        $menu_act         = (1 == $ui['status']) ? 5 : 4;
        $bc['Profile']    = PATH_ROOT.'profile'.$uid;  
        $bc['Contacts']   = PATH_ROOT.'friend'.$uid;  
    }       
    
	switch ($mod)
    {   
    	case 'add':
    		if (!$is_user)
    		{
    		    uni_redirect(PATH_ROOT.'friend.php');
    		}
    	    $fid = (isset($_REQUEST['fid']) && is_numeric($_REQUEST['fid']) && $_REQUEST['fid']) ? $_REQUEST['fid'] : 0;    		

    		if (!$fid || $fid == UID)
    	    {
    	    	uni_redirect(PATH_ROOT.'friend.php');
    	    }
    	    $uCinfo =& $gUser -> Get($fid);
    	    if (!is_array($uCinfo) || 0 == count($uCinfo))
    	    {
    	    	uni_redirect(PATH_ROOT.'friend.php');
    	    }
    	        	    
    	    if (isset($_POST['add']))
    	    {
    	    	$rf = $gUser -> AddFriend(UID, $fid);
    	    	
    	    	/** send message for aprove */
    	    	require CLASS_PATH.'Model/Main/MC.php';
    	    	$mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, 10);
    	    	$iid = $mc -> Add($fid, UID, 'Contact Request', 'Pending Contact Request', 0, 0, UID);
                $gUser -> EditNewState($fid, 'mess', 1);
    	    	
    	        if ($rf)
    	        {
    	        	$gUser -> EditNewState($fid, 'friend', 1);
    	        	
                    /** start wire */
                    include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                    $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
                    $gWire -> Edit(
                                   array( 
                                         UID,
                                         $fid, 
                                         (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                          5,
                                          'sent you a contact request',
                                          'friend'.$fid
                                         )
                                      );
    	        }
    	    	uni_redirect(PATH_ROOT.'friend.php?fadd=1');
    	    }
    	    $gSmarty -> assign_by_ref('uf', $uCinfo);
    	    
    	    //$bc['Contacts'] = PATH_ROOT.'friend.php'; 
            //$bc['']   = ''; 
            $gSmarty -> assign_by_ref('bc', $bc);
            $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/friend/_add.html'));	
    	break;	
    		
    	case 'del':
            if (!$is_user)
            {
                uni_redirect(PATH_ROOT.'friend.php');
            }
    		$fid = (isset($_REQUEST['fid']) && is_numeric($_REQUEST['fid']) && $_REQUEST['fid']) ? $_REQUEST['fid'] : 0;    		
    	    if ($fid && UID != $fid)    
    	    {
    	    	$gUser -> DelFriend(UID, $fid);
    	    	$gUser -> DelFriend($fid, UID);
    	    	uni_redirect(PATH_ROOT.'friend.php?fdel=1');
    	    }
    	    uni_redirect(PATH_ROOT.'friend.php');
    	break;
    		
    	
    	case 'confirm':
    	case 'ccancel':	
		
    		$fid = (isset($_REQUEST['fid']) && is_numeric($_REQUEST['fid']) && $_REQUEST['fid']) ? $_REQUEST['fid'] : 0;    		
    		if (empty($is_user) || empty($fid) || !$gUser -> CheckInvite(UID, $fid))
    	    {
    	        uni_redirect(PATH_ROOT.'friend.php');
    	    }
    	    switch ($mod)
    	    {
    	    	case 'confirm':
    	    		if (isset($_REQUEST['do']) && $_REQUEST['do'])
    	    		{
    	    			$gUser -> UpdInvite(UID, $fid, 1);
    	    			uni_redirect(PATH_ROOT.'friend.php');
    	    		}
					elseif (isset($_REQUEST['af']) && $_REQUEST['af'])
    	    		{
    	    			$gUser -> AddFriend(UID, $fid);
    	    			$gUser -> UpdInvite($fid, UID, 1);
    	    			$gUser -> EditNewState(UID, 'friend', -1);
    	    			
    	    			/** update mail */
    	    			require CLASS_PATH.'Model/Main/MC.php';
                        $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, 10);
    	    			$mc -> UpdateInviteMail($fid, UID);
    	    			
						uni_redirect(PATH_ROOT.'mc.php');
    	    		}
                    $gSmarty -> assign_by_ref('bc', $bc);
    	    		$uCinfo =& $gUser -> Get($fid);
    	    		$gSmarty -> assign_by_ref('uf', $uCinfo);
    	    	break;
    	    	
    	    	case 'ccancel':
    	    		$gUser -> UpdInvite(UID, $fid, 2);
    	    		$gUser -> EditNewState(UID, 'friend', -1);
    	    		
    	    		/** update mail */
    	    		require CLASS_PATH.'Model/Main/MC.php';
                    $mc =& new MC($gDb, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $user, 10);
                    $mc -> UpdateInviteMail($fid, UID);
    	    		
    	    		uni_redirect(PATH_ROOT.'mc.php');
    	    	break;		
    	    }
    	    $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/friend/_friend_confirm.html'));
    	break;
    	
    	
        default:
        	
        	$uCinfo =& $gUser -> Get($uid);
        	
        	//invites || friends
        	$inv    =  (isset($_REQUEST['inv']) && in_array($_REQUEST['inv'], array(0, 1))) ? $_REQUEST['inv'] : 0; 
        	$gSmarty -> assign('inv', $inv);
        	
        	$gSmarty -> assign_by_ref('ustatus', $ustatus);
        	include_once CLASS_PATH . 'View/Acc/Pagging.php';
             
        	$gSmarty -> assign('page', $page);
        	
            switch ($inv)
            {
            	//invites
            	case 1:
        	        $pcnt    =  10;
                    $rcnt    =  $gUser -> GetUserInvitesCount($uid);
                    $mpage   =   new Pagging($pcnt,
                                             $rcnt,
                                             $page,
                                             PATH_ROOT . 'friend.php?inv=1');
                    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $mpage -> GetRange();
					
					$gSmarty -> assign('from', (($page-1) * $pcnt)+1);
                    $to = (1 == $page) ? $pcnt :  ((($page-1) * $pcnt)+1 + $pcnt); 
                    $gSmarty -> assign('to', $to < $rcnt ? $to : $rcnt); 
					
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                    $pl      =& $gUser -> GetUserInvites($uid, $range[0], $pcnt);
                    $gSmarty -> assign_by_ref('pl', $pl); 
                    $gSmarty -> assign('plc', count($pl)); 
                    $gSmarty -> assign('pagging',  $mpage   -> Make());  

                    if (!empty($is_user))
                    {
                        $gSmarty -> assign('icnt', $gUser -> GetUserInvitesCount($uid));
                    }
                                        
                    //$bc[($uid == UID ? '�����������' : '����������� '.$uCinfo['name'].' '.$uCinfo['lname'])] = PATH_ROOT.'friend.php?uid='.$uid; 
                    $gSmarty -> assign_by_ref('bc', $bc);
                break;
                
                //friends
            	default:
        	        include_once CLASS_PATH . 'Model/Main/Model_Main_Resume.php';
            	    $gResume =& new Model_Main_Resume($gDb, array('resume' => TB . 'resume', 'users' => TB . 'users'));
        	        
            	    $pcnt    =  10;
            	    $la      = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
            	                     'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); 
            	    $letter  = (!empty($_REQUEST['letter']) && in_array(strtoupper($_REQUEST['letter']), $la)) ? strtoupper($_REQUEST['letter']) : '';
            	    $sstr    = (!empty($_REQUEST['sstr'])) ? strip_tags($_REQUEST['sstr']) : '';
            	    $gSmarty -> assign('letter', $letter);
            	    $gSmarty -> assign('sstr', $sstr);
            	    
            	    $rcnt    =  $gUser -> GetUserFriendsCount($uid, 1, $letter, $sstr);
                    $mpage   =   new Pagging($pcnt,
                                             $rcnt,
                                             $page,
                                             PATH_ROOT . 'friend.php?uid='.$uid);
                    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $mpage -> GetRange();
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                    $gSmarty -> assign('from', (($page-1) * $pcnt)+1);
                    $to = (1 == $page) ? $pcnt :  ((($page-1) * $pcnt)+1 + $pcnt); 
                    $gSmarty -> assign('to', $to < $rcnt ? $to : $rcnt); 
                    $pl      =& $gUser -> GetUserFriends($uid, $range[0], $pcnt, 1, $letter, $sstr);
                    for ($i = 0; $i < count($pl); $i++)
                    {
                        $pl[$i]['lproj'] = $gResume -> GetLastResume( $pl[$i]['uid'] );
                    }
                    
                    $gSmarty -> assign_by_ref('pl', $pl); 
                    $gSmarty -> assign('plc', count($pl)); 
                    $gSmarty -> assign('pagging',  $mpage   -> Make());  
                    
                    include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                    $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                    $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));
                    
                    if (!empty($is_user))
                    {
                        $gSmarty -> assign('icnt', $gUser -> GetUserInvitesCount($uid));
                    }
                    //$bc[($uid == UID ? '��� ������' : '������ '.$uCinfo['name'].' '.$uCinfo['lname'])] = PATH_ROOT.'friend.php?uid='.$uid; 
                    $gSmarty -> assign_by_ref('la', $la);
                    $gSmarty -> assign_by_ref('bc', $bc);
                break;                
            }       
            if (!empty($gSystemLogin) && $uid == UID)
            { 
                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/friend/_friend_res.html'));	        	 
            }
            else
            {
                $gSmarty -> assign('_content', $gSmarty -> fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/friend/_friend_res_out.html'));
            }
    }
    
    $gSmarty -> assign('menu_act', $menu_act);
    $gSmarty -> assign_by_ref('bc', $bc);   
    $gSmarty -> display('main.html'); 
    
}
catch (Exception $exc)
{
    sc_error($exc);
}    

#*************************************************************
# End part
#*************************************************************
    $gDb -> disconnect();
?>