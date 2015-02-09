<?php
/**
 * Statica Pages Module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1
 * @since      11.01.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

require 'top.php';

load_gz_compress($gSmarty);
    $gSmarty -> config_load(DEF_LANGUAGE.'/spages.conf');

    #Init
    include 'includes/classes/Model/Main/Spages.php';
    $spage = new Spages($gDb, TB.'spagescat', TB.'spages', 'spages.php');

    #Vars
    $action = (isset($_REQUEST['action']))    ? $_REQUEST['action']    :  '';
    $gSmarty -> assign('action', $action);

    $id     = (isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))    ? $_REQUEST['id']    :  0;
    $gSmarty -> assign('id', $id);

    $ctg    = (isset($_REQUEST['ctg']))    ? $_REQUEST['ctg']    :  0;
    $gSmarty -> assign('ctg', $ctg);

    #Main part
    try
    {


        switch ($action)
        {
            #edit pages
            case 'change':

                if ($id > 0)
                {
                    $def = $spage -> GetPageInfo($id);
                    $gSmarty -> assign_by_ref('editArr', $def);
                    $gSmarty -> assign('id', $_REQUEST['id']);
                }
                $def['action'] = $action;
                $def['ctg']    = $ctg;

                #add elements to form
                $form = new HTML_QuickForm('eform', 'post');
                $form -> addElement('submit', 'btnSubmit', 'Submit');
                if ($id > 0)
                   $form -> addElement('hidden', 'id');
                $form -> addElement('hidden', 'action');
                $form -> addElement('hidden', 'ctg');
                $form -> addElement('text', 'sortid',  $gSmarty -> _config[0]['vars']['sort'], array('size'=>15, 'maxlength'=>5));
                $form -> addElement('text', 'pagename',  $gSmarty -> _config[0]['vars']['pagename'], array('size' => 20, 'maxlength' => 15));
                $form -> addElement('text', 'name',      $gSmarty -> _config[0]['vars']['name'], array('size' => 80, 'maxlength' => 255));

                #prepare Fckeditor

                include(FCK_CLASSPATH);

                if (isset($_REQUEST['pagetext']))
                {
                    $def['pagetext'] = $_REQUEST['pagetext'];
                }

                if (isset($def['pagetext']))
                {
                    $pagetext = $def['pagetext'];
                }
                else
                {
                    $pagetext = '';
                }

                # create Fck editor instance
                $editor = new FCKEditor('pagetext');
                $editor -> ToolbarSet = 'Basic1';
                $editor -> BasePath = FCK_BASEPATH;
                $editor -> Width = 600;
                $editor -> Height = 450;
                $editor -> Value = $pagetext;
                $fdescr = $editor -> CreateHtml();

                $form -> AddElement('static', '', $gSmarty -> _config[0]['vars']['pagetext'], $fdescr);

                #Keywords
                $form -> addElement('textarea', 'keyw',   $gSmarty -> _config[0]['vars']['pagekeyw'].' :',   'style="WIDTH: 300px;  HEIGHT: 118px;"');

                #Set default values
                $form -> setDefaults($def);

                #form rules
                #$form -> addRule('name', $gSmarty -> _config[0]['vars']['name'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
                $form -> addRule('pagename', $gSmarty -> _config[0]['vars']['pagename'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
                $form -> applyFilter('name', 'trim');
                $form -> applyFilter('pagename', 'trim');
                #validate
                $valid  = $form -> validate();

                if ($form -> _flagSubmitted && $valid)
                {
                    $uniq =& $spage -> CheckUniq($form -> _submitValues['pagename'], $id);
                    if ($uniq  == 0)
                        $form -> _errors['pagename'] = $gSmarty -> _config[0]['vars']['pageuniq'];
                }

                if ($valid && $uniq  == 1)
                {
                   $form -> freeze();

                   $ar = array($form -> _submitValues['ctg'],
                               $form -> _submitValues['pagename'],
                               $form -> _submitValues['name'],
                               $form -> _submitValues['pagetext'],
                               $form -> _submitValues['keyw'],
                               $form -> _submitValues['sortid'],);
                   if (isset($form -> _submitValues['id']))
                      $spage -> AddPage($ar, $form -> _submitValues['id']);
                   else
                      $spage -> AddPage($ar);
                   header("location:".CURRENT_SCP.'?ctg='.$ctg);
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

            #delete pages
            case 'delpage':
                if ($id > 0 && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $spage -> DelPage($_REQUEST['id']);
                    header("location:".CURRENT_SCP.'?ctg='.$ctg);
                }
                elseif ($id > 0)
                {
                    $gSmarty -> assign( 'inf', $spage -> GetPageInfo($id) );
                }
            break;

            #change pafe activity
            case 'active':
                if ($id > 0)
                    $spage -> ActivePage($id);
            break;


            #edit categories
            case 'edit':

                if (isset($_REQUEST['cid']))
                {
                    $def = $spage -> GetCatInfo($_REQUEST['cid']);
                    $gSmarty -> assign_by_ref('editArr', $def);
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
                               $form -> _submitValues['parent']
                               );
                   if (isset($form -> _submitValues['cid']))
                       $spage -> AddCat($ar, $form -> _submitValues['cid']);
                   else
                       $spage -> AddCat($ar);

                   #delete menu file
                   if (file_exists(BPATH.'menu/nav.js'))
                       unlink(BPATH.'menu/nav.js');

                   header("location:".CURRENT_SCP.'?ctg='.$ctg);
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
                    $spage -> DelCat($_REQUEST['cid']);
                    #delete menu file
                    if (file_exists(BPATH.'menu/nav.js'))
                        unlink(BPATH.'menu/nav.js');

                    header("location:".CURRENT_SCP.'?ctg='.$ctg);
                }
                elseif (isset($_REQUEST['cid']))
                {
                    $gSmarty -> assign( 'inf', $spage -> GetCatInfo($_REQUEST['cid']) );
                }
            break;

            #change categories activity
            case 'cactive':
                if (isset($_REQUEST['cid']))
                {
                    #delete menu file
                    if (file_exists(BPATH.'menu/nav.js'))
                        unlink(BPATH.'menu/nav.js');

                    $spage -> ActiveCat($_REQUEST['cid']);
                }
            break;

            #default output
            default:

        }


        #List output
        if ($action <> 'change')
        {
            $gSmarty  -> assign( 'category', $spage -> GetCatList($ctg, 0) );
            $gSmarty  -> assign('list', $spage -> GetPageList($ctg));
        }

        if ($id > 0)
        {
            $pi  = $spage -> GetPageInfo($id);
            $ctg = $pi['cid'];
            $gSmarty -> assign('ctg', $ctg);
        }

        if ($ctg > 0)
            $gSmarty -> assign('cinf', $spage -> GetCatInfo($ctg));


        $bc = $spage -> GetCatBrC($ctg);
        $gSmarty -> assign('bc', $bc);
        $gSmarty -> assign('cbc', count($bc));


    }
    catch (Exception $e)
    {
        echo $e -> getMessage();
        exit;
    }
    #display and close
    $mc = $gSmarty -> fetch('mods/Info/Spages.html');
    $gSmarty -> assign_by_ref('main_content', $mc);
    $gSmarty -> display('main_template.html');
    require 'bottom.php';
?>