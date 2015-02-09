<?php
/**
 * User Gallery
 * 
 */ 

    require '_top.php';
    $gSmarty -> assign('mod', 'profile');
	$gSmarty -> assign('mwd', 'gallery');
 
try
{         
    include_once CLASS_PATH . 'View/Acc/Pagging.php'; 
    include_once CLASS_PATH . 'Model/Main/Model_Main_Blog.php';
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gear.php'; 

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
    $bc['Gallery'] = PATH_ROOT . 'gallery'.$uid;    
    
    if (!empty($_REQUEST['public']))
    {
        $gSmarty -> assign('is_public', 1);
    }
    
    include_once CLASS_PATH . 'Model/Main/Model_Main_Gallery.php';
    $gGallery =& new Model_Main_Gallery($glObj, TB.'fe_users', TB.'users_gallery'); 
	$st  = '<p><br><a><b><i><a><img>';

	/** Get Blog in left menu */               
    $gBlog =& new Model_Main_Blog($gDb, array('blog' => TB . 'blog', 'blogcom' => TB . 'blogcom', 'users' => TB . 'users'));
    $gSmarty -> assign_by_ref('lblog', $gBlog -> GetList($uid, 0, 4));
	
    /** Last added contacts in right menu */
    $gSmarty -> assign_by_ref('lfriends', $gUser -> GetUserFriends($uid, 0, 10, 1, '', '', 'f.pdate DESC'));
    
    /** some gears in right menu */
    $gGear =& new Model_Main_Gear( $gDb, array('gear' => TB.'gear', 'gearcat' => TB.'gearcat', 'users' => TB.'users'));
    $gSmarty -> assign_by_ref('lgear', $gGear -> GetList( $uid, 0, 0, 10 ));

  
    switch ($what)
    {
        /** Add image to Gallery && Edit image */
        case 'add': 
             
             if ($id)
             {
                 $fi =& $gGallery -> Get($id, UID);  
                 if (empty($fi))  
                 {
                     uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid);
                 }
                 $gSmarty -> assign_by_ref('fi', $fi);
                 $gSmarty -> assign('id', $id);
             }
                 
        	 if (!empty($_POST['fm']))
        	 {
                 $fm =& $_POST['fm'];

                 

                 if (!$id && empty($_FILES['fm']['tmp_name']['image']))
                 {
                     $errs[] = 'Please select image file';
                 }
                 elseif ( !empty($_FILES['fm']['tmp_name']['image']) )
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
                             i_crop_copy(200, 200,
                                             DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                             DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                             2);              
                         }
                     }
                 }

        	     if (empty($errs))
        	     {
        	         $fm['title'] = (isset($fm['title'])) ? strip_tags($fm['title'], $st) : '';
        	         $fm['story'] = (isset($fm['story'])) ? strip_tags($fm['story'], $st) : '';
        	         
        	         if (!$id)
        	         {
        	             $fm['image'] = $fn;
        	             $iid = $gGallery -> Add($fm, UID);
        	             
        	             /** start wire */
                         include_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
                         $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users')); 
        	             $gWire -> Edit(
                                         array( 
                                               UID,
                                               0,
                                               (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                               2,
                                               'added a new photo to gallery',
                                               'gallery.php?uid='.UID
                                               )
                                      );
        	             
        	             uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid.'&addok=1');
        	         }
        	         else
        	         {
        	             $gGallery -> Update( $fm, $id, UID );  
        	             uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid.'&upd=1');  
        	         }	
        	     }
        	     $gSmarty -> assign_by_ref('errs', $errs);
        	     $gSmarty -> assign_by_ref('fm', $fm);
        	     
        	 }
        	 elseif ($id)
        	 {
        	     $gSmarty -> assign('fm', array('title' => $fi['title'], 'story' => $fi['story']));
        	 }
        	 $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gallery/_gallery_new.html'));
        break;

        /** Delete image */
        case 'del':
             
            if (!$id)
            {
                uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid); 
            }
            if ($id)
            {
                $fi =& $gGallery -> Get($id, UID);  
                if (empty($fi))  
                {
                    uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid);
                }
                $gSmarty -> assign_by_ref('fi', $fi);
                $gSmarty -> assign('id', $id);
            }
            if (!empty($_POST['do']))
            {
                $gGallery -> Del( $id, UID );
                uni_redirect( PATH_ROOT . 'gallery.php?uid='.$uid.'&delok=1');
            }
            
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gallery/_gallery_del.html'));
        break;    
        
        /** Show user gallery */
        default:   
            
            $gSmarty -> assign('page', $page);
	        $pcnt    =  12;
	        $rcnt    =  $gGallery -> GetCnt($uid, 1);
	        $mpage   =   new Pagging($pcnt,
	                                 $rcnt,
	                                 $page,
	                                 PATH_ROOT . 'gallry.php?uid='.$uid);
	        $gSmarty -> assign('rcnt', $rcnt);
	        $range   =& $mpage -> GetRange();
	        $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
	        $pl      =& $gGallery -> GetList($uid, $range[0], $pcnt, 1);

	        $gSmarty -> assign_by_ref('pl', $pl); 
	        $gSmarty -> assign('plc', count($pl)); 
	        $gSmarty -> assign('pagging',  $mpage   -> Make()); 	
            $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/'.(2 == $ui['status'] ? 'employer' : 'member').'/gallery/_gallery.html'));        	
    }/** end mod switch */         
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