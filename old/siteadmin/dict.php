<?php
/**
 * Dictionary Module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1
 * @since      11.01.2006
 * @copyright  2004-2008 engine37
 * @link       http://engine37.com
 */

require 'top.php';
load_gz_compress($gSmarty);


    $gSmarty -> config_load(DEF_LANGUAGE.'/dict.conf');
    #Init
    include CLASS_PATH.'Model/Main/Model_Main_Dict.php';
    $dict =& new Model_Main_Dict($gDb, TB.'dictcat', TB.'dict', null);

    #Vars
    $action = (isset($_REQUEST['action']))    ? $_REQUEST['action']    :  '';
    $gSmarty -> assign('action', $action);

    $id     = (isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))    ? $_REQUEST['id']    :  0;
    $gSmarty -> assign('id', $id);

    $ctg    = (isset($_REQUEST['ctg']))    ? $_REQUEST['ctg']    :  0;
    $gSmarty -> assign('ctg', $ctg);

    $page = (!empty($_REQUEST['page']) && 0 < $_REQUEST['page']) ?  $_REQUEST['page'] : 1; 
    $gSmarty -> assign('page', $page);
                
    #Main part
	
        switch ($action)
        {
            #edit dictionaries
            case 'change':

                if ($id > 0)
                {
                    $def = $dict -> GetDictInfo($id);
                    $gSmarty -> assign('id', $_REQUEST['id']);
                }
                $def['action'] = $action;
                $def['ctg']    = $ctg;

                #add elements to form
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
                
                #Set default values
                $form -> setDefaults($def);

                #form rules
                $form -> applyFilter('name', 'trim');

                #validate
                $valid  = $form -> validate();

                if ($valid)
                {
                   $form -> freeze();

                   $ar = array($form -> _submitValues['ctg'],
                               $form -> _submitValues['name'],
                               $form -> _submitValues['sortid']);
                   if (isset($form -> _submitValues['id']))
                      $dict -> AddDict($ar, $form -> _submitValues['id']);
                   else
                      $dict -> AddDict($ar);
                   uni_redirect(CURRENT_SCP.'?ctg='.$ctg.'&page='.$page);
                }
                else
                {
                 # print_r($form);
                #render for smarty
                    $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                    $form    -> accept($renderer);
                    $gSmarty -> assign('fdata', $form -> toArray());
                }
            break;

            #delete dictionary
            case 'delpage':
                if ($id > 0 && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $dict -> DelDict($_REQUEST['id']);
                    uni_redirect(CURRENT_SCP.'?ctg='.$ctg.'&page='.$page);
                }
                elseif ($id > 0)
                {
                    $gSmarty -> assign( 'inf', $dict -> GetDictInfo($id) );
                }
            break;

            #change pafe activity
            case 'active':
                if ($id > 0)
                    $dict -> ActiveDict($id);
            break;


            #edit categories
            case 'edit':

                if (isset($_REQUEST['cid']))
                {
                    $def = $dict -> GetCatInfo($_REQUEST['cid']);
                    $gSmarty -> assign('cid', $_REQUEST['cid']);
                }
                $def['action'] = $action;
                $def['parent'] = $ctg;
                $def['ctg']    = $ctg;

                #add elements to form
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

                #form rules
                $form -> addRule('name', $gSmarty -> _config[0]['vars']['name'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
                $form -> applyFilter('name', 'trim');

                #validate
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
                #render for smarty
                    $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                    $form -> accept($renderer);
                    $gSmarty -> assign('fdata', $form -> toArray());
                }
            break;

            #delete categories
            case 'delcat':
                if (isset($_REQUEST['cid']) && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $dict -> DelCat($_REQUEST['cid']);
                    uni_redirect(CURRENT_SCP.'?ctg='.$ctg);
                }
                elseif (isset($_REQUEST['cid']))
                {
                    $gSmarty -> assign( 'inf', $dict -> GetCatInfo($_REQUEST['cid']) );
                }
            break;

            #change categories activity
            case 'cactive':
                if (isset($_REQUEST['cid']))
                {
                    $dict -> ActiveCat($_REQUEST['cid']);
                }
            break;

            #default output
            default:

        }

        #List output
        if ($action <> 'change')
        {
            $gSmarty  -> assign( 'category', $dict -> GetCatList($ctg, 0) );
            
            
            include_once CLASS_PATH . 'View/Acc/Pagging.php';

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
            $gSmarty -> assign_by_ref('list', $pl); 
            $gSmarty -> assign('plc', count($pl)); 
            $gSmarty -> assign('pagging',  $gMpage   -> Make()); 
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


    #display and close
    $mc = $gSmarty -> fetch('mods/Info/Dict.html');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    require 'bottom.php';
?>