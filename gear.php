<?php
/**
 * Gear
 * 
 */ 

    require '_top.php';
    $gSmarty -> assign('mwd', 'gear');


try
{  
    include_once CLASS_PATH . 'View/Acc/Pagging.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 
	include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));

    if (!empty($uid))
    { 
        /** Get Blog in right menu */               
        $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
        $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
       
        /** Last added contacts in right menu */
        $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));  
    }

    /** breadcrumb */
    	

 
	if (!empty($_REQUEST['uid']) && is_numeric($_REQUEST['uid']))
    {     
	     $gSmarty -> assign('mod', 'profile');
         /*********************************
	             User Gear 
    	 *********************************/
        if ( $is_user && UID == $uid )
        {           
            $ui =& $uinfo;  
        }
        elseif (!empty($uid))
        {
            $ui =& $gUser -> Get( $uid );
            if (empty($ui))
            {
                uni_redirect( PATH_ROOT . '?mod=login');
            }          
        }
        
        if ($is_user && !$ctg)
        {
            $bc['My Profile'] = PATH_ROOT.'profile'.$uid;
            $bc['Gear']       = PATH_ROOT . 'gear'.$uid;
            $menu_act         = 2; 
        }
        else
        {

            $menu_act         = (1 == $ui['status']) ? 5 : 4;
            $bc['Profile']    = PATH_ROOT.'profile'.$uid;  
            $bc['Gear']   = PATH_ROOT.'gear'.$uid;    
        }        
        
        
        $gSmarty -> assign_by_ref('ui', $ui);
        switch ($mod)
        {
            /** Add or Edit Gear entry */
            case 'add':
                
                $st  = '<p><br><a><b><i><a><img>';
                if (!$is_user)
                {
                    uni_redirect( PATH_ROOT . 'gear.php' );
                }
                    
                if ($id)
                {
                    $fi =& $gGear -> Get($id);
                        
                    if ( $fi['uid'] != UID )
                    {
                        uni_redirect( PATH_ROOT . 'msg.php?mod=gear' );
                    }
                    $gSmarty -> assign_by_ref('fi', $fi);
                    $gSmarty -> assign('id', $id);
                       
                    if (!empty($_REQUEST['delimg']))
                    {
                        if ( $gGear -> DelImage( $id ) )
                        {
                            uni_redirect( PATH_ROOT . 'gear'.$uid.'/?mod=add&id='.$id);
                        }
                    }
                        
                }
                                                 
                if (!empty($_POST['fm']))
                {
                    $fm =& $_POST['fm'];

                    if (empty($fm['title']))         
                    {
                        $errs[] = 'Please specify title';
                    }
                    if (empty($fm['cid']))         
                    {
                        $errs[] = 'Please select category';
                    }

                    
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
                                i_crop_copy(78, 78,
                                                DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                2);              
                            }
                        }
                    }

                    if (empty($errs))
                    {
                            $ar = array(
                                       UID,
                                       strip_tags($fm['title'], $st),
                                       strip_tags($fm['story'], $st),
                                       $fm['cid']
                                       );
                            $id = $gGear -> Edit($ar, $id, $fn);
                            /** update count in category */
                            if (!empty($fi) && $fm['cid'] != $fi['cid'])
                            {
                                $gGear -> UpdCnt($fi['cid'], -1);
                                $gGear -> UpdCnt($fm['cid'], 1);
                            }
                            elseif (empty($fi))
                            {
                                $gGear -> UpdCnt($fm['cid'], 1);

                                /** start wire */
                                require_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                                $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
                                $gWire -> Edit(
                                         array( 
                                               UID,
                                               0, 
                                               (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                               4,
                                               'added new gear',
                                               'gear'.UID.'/?id='.$id,
                                               $id
                                               )
                                      );
                            }
                            uni_redirect( PATH_ROOT . 'gear'.$uid.'/?res=ok' );
                    }
                    $gSmarty -> assign_by_ref('errs', $errs);
                    $gSmarty -> assign_by_ref('fm', $fm);        
                }
                elseif ($id)
                {
                    /** Edit */
                    if (!empty($fi))
                    {
                        $fm = array( 'title' => $fi['title'], 'story' => $fi['story'], 'cid' => $fi['cid'] ); 
                        $gSmarty -> assign_by_ref('fm', $fm);
                    }             
                }
                else
                {
                    $fm = array( );
                    $gSmarty -> assign_by_ref('fm', $fm);
                }
                $gSmarty -> assign_by_ref('cats', $gGear -> GetCatList()); 
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gear/_gear_add.html'));
            break;

            /** Delete gear entry */
            case 'del':
                if (!$is_user)
                {
                    uni_redirect( PATH_ROOT . 'profile'.$uid.'/resume' );
                }
                    
                if ($id)
                {
                    $fi =& $gGear -> Get($id);
                       
                    if ( empty($fi) || $fi['uid'] != UID )
                    {
                        uni_redirect( PATH_ROOT . 'msg.php?mod=gear' );
                    }
                    $gSmarty -> assign_by_ref('fm', $fi);
                    $gSmarty -> assign('id', $id);
                }  

                if (!empty($_REQUEST['do']))
                {
                    $gGear -> UpdCnt($fi['cid'], -1);
                    $gGear -> Del( $id, UID );
                    uni_redirect( PATH_ROOT . 'gear'.$uid.'/?del=ok' );   
                }
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gear/_gear_del.html'));    
            break;            
            
            case 'updsort':
                
                if ($id)
                {
                    $act = (isset($_REQUEST['act']) && (-1 == $_REQUEST['act'] || 1 == $_REQUEST['act']) ) ? $_REQUEST['act'] : 1;
                    $gGear -> ItemsSortUpd($uid, $id, $act);
                    uni_redirect(PATH_ROOT.'gear'.$uid.'/?page='.$page);
                }
                
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
                        $m -> Subject('Forward rentals from '.SUPPORT_SITENAME);
                        $m -> Priority(3);

                        $pl =& $gGear -> GetList($uid);
                        $gSmarty -> assign_by_ref('pl', $pl); 
                        $descr  = $gSmarty -> fetch('mails/forward_gear.html');
                    
                        $m -> Body( $descr);
                        $m -> To( $_POST['fm']['email'] );
                        $m -> Send();
                        uni_redirect((1 == $ui['status'] ? 'gear' : 'rental').$uid.'?mod=forward&send=ok');
                    }
                    $gSmarty -> assign_by_ref('fm', $_POST['fm']);
                    $gSmarty -> assign_by_ref('errs', $errs);
                }
            
                $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gear/_forward.html'));                
      
            break;    
            
            default:
                
                if ($id)
                {
                        
                    $fi =& $gGear -> Get($id);
                    
                    if (empty($fi))
                    {
                        uni_redirect( PATH_ROOT . 'gear'.$uid );
                    }
                    $fi['cat'] =& $gGear -> GetCat( $fi['cid'] );
                    $gSmarty -> assign_by_ref('fm', $fi);
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gear/_gear_one.html'));
                }
                else
                {

                    $gSmarty -> assign('page', $page);
                    $pcnt    =  10;
                    $rcnt    =  $gGear -> GetCount($uid);
                    $gMpage   =   new Pagging($pcnt,
                                              $rcnt,
                                              $page,
                                              PATH_ROOT . 'gear'.$uid);
                    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $gMpage -> GetRange();
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                    $pl =& $gGear -> GetList($uid, 0, $range[0], $pcnt);
                    $gSmarty -> assign_by_ref('pl', $pl); 
                    $gSmarty -> assign('plc', count($pl)); 
                    $gSmarty -> assign('pagging',  $gMpage   -> Make());
                    $gSmarty -> assign_by_ref('catl', $gGear -> GetCatListAssoc()); 
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gear/_gear.html'));
                }  
        }    
            
                    
    }    
	else
	{

        $bc['All Gear']   = PATH_ROOT.'gear.php';
        $menu_act         = 6; 

        $gSmarty -> assign('mod', 'gear');
        /*********************************
                 All Gear 
         *********************************/		

		switch ($mod)
		{
	
			default: 
				if ($ctg)
				{
					$ci =& $gGear -> GetCat( $ctg );
					if (empty($ci))
					{
						$ctg = 0;
					}
                    if (!empty($ci['title']))
                    {
                        $bc[$ci['title']] = PATH_ROOT . 'gear.php?ctg='.$ci['id']; 
                    }
                    $gSmarty -> assign_by_ref('ci', $ci);
                    
				}
				if (!$ctg)
				{
				    $gl =& $gGear -> GetCatList();
				    $gSmarty -> assign_by_ref('gl', $gl);
				    $gSmarty -> assign('gcnt', floor(count($gl) / 2));
				    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/gear/_all.html'));
				}
				else
				{
                    $gSmarty -> assign('ctg', $ctg);
				    $state = (!empty($_REQUEST['state']) && 2 == strlen($_REQUEST['state'])) ? $_REQUEST['state'] : '';
                    $city  = (!empty($_REQUEST['city'])) ? $_REQUEST['city'] : '';
                    $model   = (!empty($_REQUEST['model'])) ? strip_tags( $_REQUEST['model'] ) : '';
            
                    if (!empty($_REQUEST['is_state']))
                    {
                        $city = '';    
                    }
            
                    /** states */
                    if (!empty($_SESSION['gear']['statea'][$ctg]))
                    {
                        $gSmarty -> assign_by_ref('statea', $_SESSION['gear']['statea'][$ctg]);
                    }
                    else 
                    {
                        $_SESSION['gear']['statea'][$ctg] =& $gGear -> GetGearStates( $ctg );
                        $gSmarty -> assign_by_ref('statea', $_SESSION['gear']['statea'][$ctg]);
                    }
                    /** cities */
           
                    if (empty($state))
                    {
                        if (!empty($_SESSION['gear']['cities'][$ctg]))
                        {
                            $gSmarty -> assign_by_ref('cities', $_SESSION['gear']['cities'][$ctg]);
                        }
                        else 
                        {
                            $_SESSION['gear']['cities'][$ctg] =& $gGear -> GetGearCities('', $ctg);
                            $gSmarty -> assign_by_ref('cities', $_SESSION['gear']['cities'][$ctg]);
                        }           
                    }
                    else
                    {
                        $gSmarty -> assign_by_ref('cities', $gGear -> GetGearCities($state, $ctg));
                    }
                    $gSmarty -> assign('state', $state);
                    $gSmarty -> assign('city', $city);
                    $gSmarty -> assign('model', $model);
            
				    $gSmarty -> assign('page', $page);
                    $pcnt     =  10;
                    $rcnt     =  $gGear -> GetCount(0, $ctg, $state, $city, $model);
                    $gMpage   =   new Pagging($pcnt,
                                              $rcnt,
                                              $page,
                                              PATH_ROOT . 'gear.php?ctg='.$ctg.($state ? '&amp;state='.$state : '').($city ? '&amp;city='.$city : '').($model ? '&amp;model='.$model : ''));
                    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $gMpage -> GetRange();
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
                    $pl =& $gGear -> GetList(0, $ctg, $range[0], $pcnt, $state, $city, $model, 'g.title');
                    $gSmarty -> assign_by_ref('pl', $pl); 
                    $gSmarty -> assign('plc', count($pl)); 
                    $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
                    
                    include_once CLASS_PATH.'Model/Geografy/Main.class.php';
                    $gGeo =& new Model_Geografy_Main($glObj, array('subdivs' => TB.'countries_subdivisions'));
                    $gSmarty -> assign_by_ref('states', $gGeo -> GetSubDivAssoc('US'));				    
				    
                    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/gear/_list.html'));
				}
		                      
		    break;
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