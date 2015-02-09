<?php
/**
 * History class
 * 
 * @package    Engine37  catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37  Team
 * @link       http://Engine37 .com
 */


require 'top.php';

#----------- Init----------------

load_gz_compress($gSmarty);        // Gzip compression

$main_content = '';

#-----------Init Vars------------
$action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : 'view'; // - action -
$what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : 'list'; // - object for action -
$pStart     = (isset($_REQUEST['pstart']))     ? intval($_REQUEST['pstart'])  :  0;     // - page displaciment -
$start_date = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date']      : -1;     // - database column for ordering -
$end_date   = (isset($_REQUEST['end_date']))   ? $_REQUEST['end_date']        : -1;     // - ordering direction

$gSmarty -> assign('action'    , $action);
$gSmarty -> assign('what'      , $what);
$gSmarty -> assign('pstart'    , $pStart);
$gSmarty -> assign('start_date', $start_date);
$gSmarty -> assign('end_date'  , $end_date);

$_REQUEST['log_id'] = (isset($_REQUEST['log_id'])) ? intval($_REQUEST['log_id']) : 0;

switch ($action)
{
    case 'view':
        if ($what == 'list')
        {
            $HA =& $gHist->GetAll($pStart, $start_date, $end_date);
            $gSmarty->assign_by_ref('HA', $HA);
            $main_content .= $gSmarty->fetch('mods/Maintenance/History.html');
        }
    
        break;
    case 'delete':
        if ($what == 'record') // delete specified record
        {
            $gHist -> DeleteRecord($_REQUEST['log_id']);
            a_redirect($start_date,$end_date,$pStart);
        }
        else if ($what == 'all')
        {
            $gHist -> DeleteAll();
            a_redirect($start_date, $end_date, $pStart);
        }
        break;
    
    default:
        a_redirect($start_date, $end_date, $pStart);
        break;
}

// ------------------------------------------------------------------------

// < Compile templates >
    $gSmarty  -> assign_by_ref('main_content', $main_content);
    $gSmarty  -> display('main_template.html'); 
    require 'bottom.php';


function a_redirect($startDate, $endDate, $pStart)
{
    uni_redirect(CURRENT_SCP.'?action=view&what=list&start_date='.$startDate.'&end_date='.$endDate.'&pstart='.$pStart);
}

?>