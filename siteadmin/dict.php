<?php
/**
 * Dictionary Module
 *
 * @package    CrewedUp
 * @version    0.1
 * @since      11.01.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

    require 'top.php';
    load_gz_compress($gSmarty);

    $gSmarty -> config_load(DEF_LANGUAGE.'/dict.conf');
    // Init
    require CLASS_PATH.'Model/Main/Model_Main_Dict.php';
    $dict =& new Model_Main_Dict($gDb, null, null, $gHist);

    // Vars
    $action = _v('action');
    $gSmarty -> assign('action', $action);

    $id     = (int)_v('id');
    $gSmarty -> assign('id', $id);

    $ctg    = (int)_v('ctg');
    $gSmarty -> assign('ctg', $ctg);

    $page = (int)_v('page', 1); 
    $gSmarty -> assign('page', $page);
                
    // Main part
	
    switch ($action)
    {
        case 'change_elements_status':
            $dict -> Moderate(_vp('status'));
            uni_redirect('dict.php?action=new_elements_moderation');
            break;

        case 'new_elements_moderation':
            $NA =& $dict -> GetNewElements(_vg('pstart'));
            $gSmarty -> assign_by_ref('NA', $NA);
            break;

        // edit dictionaries
        case 'change':
            if (0 < $id)
            {
                $def = $dict -> GetDictInfo($id);
                $ctg = $def['cid'];
            }

            $def['action'] = $action;
            $def['ctg']    = $ctg;
            
            // add elements to form
            $form = new HTML_QuickForm('eform', 'post');
            $form -> addElement('submit', 'btnSubmit', 'Submit');
            if ($id > 0)
               $form -> addElement('hidden', 'id');
            else
               $def['smore'] = 1;
             
            $form -> addElement('hidden', 'action');
            $form -> addElement('hidden', 'page', $page);
            $form -> addElement('hidden', 'ctg');
            $form -> addElement('text', 'sortid',  $gSmarty -> _config[0]['vars']['sort'], array('size'=>15, 'maxlength'=>5));
            $form -> addElement('text', 'name',      $gSmarty -> _config[0]['vars']['name'], array('size' => 80, 'maxlength' => 255));
            
            if (in_array($def['ctg'], array(DICT_FILMS, DICT_SHOWS)))
            {
                $form -> addElement('hidden', 'path', DIR_WS_IMAGE);
               
                if (isset($def['add_field']) && trim($def['add_field']) <> '')
                    $form -> addElement('static','', '', '<a href="'.PATH_ROOT.DIR_NAME_IMAGE.'/'.$def['add_field'].'" target="_blank"><img src="'.PATH_ROOT.DIR_NAME_IMAGE.'/'.DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '').'/'.$def['add_field'].'" title="'.$def['add_field'].'" alt="'.$def['add_field'].'" border="0" /></a><br /> [<a href="dict.php?ctg='.$ctg.'&action=change&id='.$id.'&delimg=1"  onclick="return confirm(\'Are you sure ?\');">'.$gSmarty -> _config[0]['vars']['delete'].' logo</a>]');

                $file =& $form -> addElement('file', 'add_field', 'Project Logo');
               
                if (isset($def['add_field2']) && trim($def['add_field2']) <> '')
                    $form -> addElement('static','', '', '<a href="'.PATH_ROOT.DIR_NAME_IMAGE.'/'.$def['add_field2'].'" target="_blank"><img src="'.PATH_ROOT.DIR_NAME_IMAGE.'/'.DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '').'/'.$def['add_field2'].'" title="'.$def['add_field2'].'" alt="'.$def['add_field2'].'" border="0" /></a><br /> [<a href="dict.php?ctg='.$ctg.'&action=change&id='.$id.'&delimg=2"  onclick="return confirm(\'Are you sure ?\');">'.$gSmarty -> _config[0]['vars']['delete'].' logo</a>]');

                $file2 =& $form -> addElement('file', 'add_field2', 'Network or Distributor Logo ');
               
            }
            // Set default values
            $form -> setDefaults($def);
            
            // form rules
            $form -> applyFilter('name', 'trim');
            
            // delete image
            $del_img = _vg('delimg');
            if (0 < $id && in_array($del_img, array(1,2)))
            {
                if (1 == $del_img) $del_img = '';

                $t =& $dict -> DelImage($id, $del_img);
                uni_redirect('dict.php?ctg='.$ctg.'&action=change&id='.$id);
            }
            
            // validate
            $valid  = $form -> validate();
            
            if ($valid)
            {
                $form -> freeze();
            
                $fn  = '';
                $fn2 = '';

                if (in_array($def['ctg'], array(DICT_FILMS, DICT_SHOWS)))
                {
                    require_once CLASS_PATH . 'Ctrl/Image/Image_Transform.php';
                    require_once CLASS_PATH . 'Ctrl/Image/Image_Transform_Driver_GD.php';
                    
                    if ($file -> isUploadedFile())
                    {
                        $iz  = getimagesize($_FILES['add_field']['tmp_name']);
                        $ext = strtolower(strrchr($_FILES['add_field']['name'], "."));
                        
                        if (in_array($ext, array('.jpg', '.jpeg', '.gif', '.png'))
                            && !empty($iz))
                        {
                            $fs = filesize($_FILES['add_field']['tmp_name']);
                            if( 2048000 >= $fs)
                            {
                                $fn = MakeOrig($_FILES['add_field']['name'], DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : ''), 1);
                                /** Upload image throw crop */
                                i_crop_copy(600, 450, 
                                                $_FILES['add_field']['tmp_name'],
                                                DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn, 
                                                2);
                                i_crop_copy(86, 43,
                                                DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn,
                                                2);              
                       
                            }
                        }
                    }

                    if ($file2 -> isUploadedFile())
                    {
                        $iz  = getimagesize($_FILES['add_field2']['tmp_name']);
                        $ext = strtolower(strrchr($_FILES['add_field2']['name'], "."));
                        
                        if (in_array($ext, array('.jpg', '.jpeg', '.gif', '.png'))
                            && !empty($iz))
                        {
                            $fs = filesize($_FILES['add_field2']['tmp_name']);
                            if( 2048000 >= $fs)
                            {
                                $fn2 = MakeOrig($_FILES['add_field2']['name'], DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : ''), 1);
                                /** Upload image throw crop */
                                i_crop_copy(600, 450, 
                                                $_FILES['add_field2']['tmp_name'],
                                                DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2, 
                                                2);
                                i_crop_copy(86, 43,
                                                DIR_WS_IMAGE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2,
                                                DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE . ('' != DIR_NAME_IMAGE_SUBDIR ? '/'. DIR_NAME_IMAGE_SUBDIR : '') .'/'.  $fn2,
                                                2);              
                       
                            }
                        }
                    }
                }

                $ar = array($form -> _submitValues['ctg'],
                            $form -> _submitValues['name'],
                            $form -> _submitValues['sortid']);
                if (isset($form -> _submitValues['id']))
                   $id = $dict -> AddDict($ar, $form -> _submitValues['id'], $fn, $fn2);
                else
                   $id = $dict -> AddDict($ar, 0, $fn);
                uni_redirect(CURRENT_SCP.'?ctg='.$ctg.'&page='.$page.'&id='.$id.'&action=change&result=ok');
            }
            else
            {
                // render for smarty
                $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                $form    -> accept($renderer);
                $gSmarty -> assign('fdata', $form -> toArray());
            }
        break;

        // delete dictionary
        case 'delpage':
            if ($id > 0 && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
            {
                $dict -> DelDict($_REQUEST['id']);
                uni_redirect(CURRENT_SCP.'?ctg='.$ctg.'&page='.$page);
            }
            elseif ($id > 0)
                $gSmarty -> assign( 'inf', $dict -> GetDictInfo($id) );
        break;

        // change pafe activity
        case 'active':
            if ($id > 0)
                $dict -> ActiveDict($id);
        break;


        // edit categories
        case 'edit':

            if (isset($_REQUEST['cid']))
            {
                $def = $dict -> GetCatInfo($_REQUEST['cid']);
                $gSmarty -> assign('cid', $_REQUEST['cid']);
            }
            $def['action'] = $action;
            $def['parent'] = $ctg;
            $def['ctg']    = $ctg;

            // add elements to form
            $form = new HTML_QuickForm('eform', 'post');
            $form -> addElement('submit', 'btnSubmit', 'Submit');
            if (isset($_REQUEST['cid']))
               $form -> addElement('hidden', 'cid');
            $form -> addElement('hidden', 'ctg');
            $form -> addElement('hidden', 'action');
            $form -> addElement('hidden', 'parent');
            $form -> addElement('text', 'sortid',  $gSmarty -> _config[0]['vars']['sort'], array('size'=>15, 'maxlength'=>5));
            $form -> addElement('text', 'name',    $gSmarty -> _config[0]['vars']['catname'], array('size'=>80, 'maxlength'=>255));
            $form -> addElement('text', 'dictname',    $gSmarty -> _config[0]['vars']['dictname'], array('size'=>80, 'maxlength'=>255));

            $form -> setDefaults($def);

            // form rules
            $form -> addRule('name', $gSmarty -> _config[0]['vars']['name'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
            $form -> applyFilter('name', 'trim');

            // validate
            if ($form -> validate())
            {
               $form -> freeze();
               $ar = array($form -> _submitValues['name'],
                           $form -> _submitValues['sortid'],
                           $form -> _submitValues['parent'],
                           $form -> _submitValues['dictname']
                           );
               if (isset($form -> _submitValues['cid']))
                   $dict -> AddCat($ar, $form -> _submitValues['cid']);
               else
                   $dict -> AddCat($ar);

               uni_redirect(CURRENT_SCP.'?ctg='.$ctg);
            }
            else
            {
            // render for smarty
                $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                $form -> accept($renderer);
                $gSmarty -> assign('fdata', $form -> toArray());
            }
        break;

        // delete categories
        case 'delcat':
            if (isset($_REQUEST['cid']) && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
            {
                $dict -> DelCat($_REQUEST['cid']);
                uni_redirect(CURRENT_SCP.'?ctg='.$ctg);
            }
            elseif (isset($_REQUEST['cid']))
                $gSmarty -> assign( 'inf', $dict -> GetCatInfo($_REQUEST['cid']) );
        break;

        // change categories activity
        case 'cactive':
            if (isset($_REQUEST['cid']))
            {
                $dict -> ActiveCat($_REQUEST['cid']);
            }
        break;

        // default output
        default:

    }

    // List output
    if ('change' != $action)
    {
        $gSmarty  -> assign( 'category', $dict -> GetCatList($ctg, 0) );
        
        $srh = base_chk3(_vg('srh'), ' \'+=');

        if (2 >= strlen($srh))
        {
            require_once CLASS_PATH . 'View/Acc/Pagging.php';
           
            $pcnt    =  100;
            $rcnt    =  $dict -> GetDictCount($ctg);
            $gMpage   =   new Pagging($pcnt,
                                      $rcnt,
                                      $page,
                                      'dict.php'.($ctg ? '?ctg='.$ctg : ''));
            $gSmarty -> assign('rcnt', $rcnt);
            $range   =& $gMpage -> GetRange();
            $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
            $pl =& $dict -> GetDictList($ctg, 0, '', 0, $range[0], $pcnt);
            $gSmarty -> assign('plc', count($pl)); 
            $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
        }
        else
        {
            $gSmarty -> assign('srh', $srh);
            $pl =& $dict -> SearchDict($srh);
        }

        $gSmarty -> assign_by_ref('list', $pl); 
    }

    if ($id > 0)
    {
        $pi  = $dict -> GetDictInfo($id);
        $ctg = $pi['cid'];
        $gSmarty -> assign('ctg', $ctg);
    }

    if ($ctg > 0)
        $gSmarty -> assign('cinf', $dict -> GetCatInfo($ctg));


    $bc = $dict -> GetCatBrC($ctg);
    $gSmarty -> assign('bc', $bc);
    $gSmarty -> assign('cbc', count($bc));


    // display and close
    $mc = $gSmarty -> fetch('mods/Info/Dict.html');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    require 'bottom.php';
?>