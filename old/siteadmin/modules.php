<?php
/**
 * Admin panel Users Module
 *
 * @package    Engine37 catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37 Team
 * @link       http://Engine37.com
 */
 
    require 'top.php' ;
    load_gz_compress($gSmarty);    
    $gSmarty -> config_load(DEF_LANGUAGE.'/modules.conf');
    
    $action     = (isset($_REQUEST['action']))    ? $_REQUEST['action']          : ''; 
    $id         = (isset($_REQUEST['id']))    ? $_REQUEST['id']          : 0;     

try
{    
    switch ($action)
    {  
        case 'edit':

            $ar = $_REQUEST;
            if ($id > 0)
            {      
                $ar['name']    = $_REQUEST['name'.$_REQUEST['id']];
                $ar['sortid']  = $_REQUEST['sortid'.$_REQUEST['id']];
                $ar['fname']   = $_REQUEST['fname'.$_REQUEST['id']];            
            }

            $mods -> Edit($ar);  
            header("location:".CURRENT_SCP);
        break;
        
        case 'update':
            $list = $mods -> GetList();
            for ($i = 0; $i < count($list); $i++)
            {
                $ar['id']      = $list[$i]['id'];
                $ar['name']    = $_REQUEST['name'.$ar['id']];
                $ar['sortid']  = $_REQUEST['sortid'.$ar['id']];
                $ar['fname']   = $_REQUEST['fname'.$ar['id']];  
                $mods -> Edit($ar);                  
            }
            header("location:".CURRENT_SCP);        
        break;
        
        case 'active':
            $mods -> ChgAct($_REQUEST['id']);
            header("location:".CURRENT_SCP);          
        break;
        
        case 'del':
            $mods -> Del($_REQUEST['id']);
            header("location:".CURRENT_SCP);
        break;
        default: 
            $gSmarty -> assign('list', $mods -> GetList());        
         
    }#Action
    
}
catch (Exception $exc)
{
    sc_error($exc);
}       
    
    $mc = $gSmarty -> fetch('mods/Security/Be/modules.html');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.html');
    include 'bottom.php'; 
?>