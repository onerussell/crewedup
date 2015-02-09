<?php
    define('INC_PATH',''); // path for 'require' and 'include'
    define('CLASS_PATH', INC_PATH.'includes/classes/');
    #ini_set('include_path','.;/usr/local/php5/PEAR;/home/gauto.xx/www/includes/libs/PEAR');
    

	
// =========================================================================
// Base PHP Configuration
// Include base configuration
    require INC_PATH.'includes/config/main.php';
    if (file_exists(BPATH . 'files/config/generated.php'))
    {
        require BPATH . 'files/config/generated.php'; 
    }

	define('DEF_LANGUAGE', 'en');
	//define('PATH_ROOT_ADMIN', PATH_ROOT . 'siteadmin/');
    
// Include base functions
    require INC_PATH.'includes/libs/main.php';

	
    $beginScriptTime = get_mt_time();


    set_magic_quotes_runtime(0);
    error_reporting(ERROR_LEVEL);
    ini_set('display_startup_errors', ERROR_DISPLAY);
    ini_set('display_errors'        , ERROR_DISPLAY);

// Session config and initialization
    session_save_path(BPATH.'files/sessions/admin');
    session_name(SESSION_NAME.'_a');

if (SESSION_ID_IN_URL)
{
    ini_set('session.use_trans_sid'   ,'1');
    ini_set('session.use_only_cookies','0');
}
else
{
    ini_set('session.use_trans_sid'   ,'0');
    ini_set('session.use_only_cookies','1');
}

define('CURRENT_URL', getenv('REQUEST_URI'));
define('CURRENT_SCP', getenv('SCRIPT_NAME'));

// =========================================================================
// Administration panel work only through SSL
if (SSL_ONLY && ( !isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']) )
{
    uni_redirect(CURRENT_URL, 3);
}
// =========================================================================

// PEAR and Database initialization

require 'PEAR.php';
require 'HTML/QuickForm.php';
require 'HTML/QuickForm/Renderer/ArraySmarty.php';
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');

require 'DB.php';
$gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME); // select db type
$gDb -> setFetchMode(DB_FETCHMODE_ASSOC);

	
// =========================================================================
// Smarty initialization
    require CLASS_PATH.'View/Smarty/Smarty.class.php';
    $gSmarty                    =& new Smarty();
    $gSmarty -> compile_check   = true;
    #$gSmarty -> debugging       = (1 == SMARTY_DEBUG) ? true : false;
    #$gSmarty -> error_reporting = SMARTY_ERROR_REPORTING;
    $gSmarty -> template_dir  = INC_PATH.'includes/templates';
    $gSmarty -> compile_dir   = BPATH.'files/templ/admin/';
    $gSmarty -> config_dir    = INC_PATH.'includes/langs';
    $gSmarty -> plugins_dir   = array(
                                 'plugins',
                                 'includes/templates/plugins'
                                 );   
//load main language config file
    $gSmarty -> config_load(DEF_LANGUAGE.'/main.lang.conf','Authentication');

// =========================================================================
// Base Program variables
// 'siteAdr', 'redirectLocation' etc. is not variable or array elements names
// That is templates constants.
$gSmarty -> assign('siteAdr'          , PATH_ROOT); // Base web-path
$gSmarty -> assign('siteAdmin'        , PATH_ROOT_ADMIN.'includes/');
$gSmarty -> assign('imgDir'           , PATH_ROOT_ADMIN.'includes/templates/images/');
$gSmarty -> assign('jsDir'            , PATH_ROOT_ADMIN.'includes/templates/js/');
$gSmarty -> assign('stlDir'           , PATH_ROOT_ADMIN.'includes/templates/styles/');
$gSmarty -> assign('menuDir'          , PATH_ROOT.'files/data/');
$gSmarty -> assign('redirectLocation' , CURRENT_URL);
$gSmarty -> assign('curScriptName'    , CURRENT_SCP);
$gSmarty -> assign('charset'          , DEF_CHARSET);
$gSmarty -> assign('supportSiteName'  , SUPPORT_SITENAME);
$gSmarty -> assign('supportEmail'     , SUPPORT_EMAIL);

try
   {
    // ----------------------------------------------------------------
   
    // < base object >
    $glObj = array(
                   'db'     => &$gDb,
                   'smarty' => &$gSmarty
                  );
      
    // -----------------------------------------------------------------
    
    // <  init pagging class  >
    require INC_PATH.'includes/classes/View/Acc/SimplePagging.class.php';
    $gPage = new View_Acc_SimplePagging($glObj, RESULTS_COUNTER, 'pstart' );
    $glObj['page'] =& $gPage;
   
    // -----------------------------------------------------------------
    // < init history class >
    require INC_PATH.'includes/classes/Model/Maintenance/History.class.php';
    $gHist = new Model_Maintenance_History($glObj, TB.'history', RESULTS_COUNTER, TIME_OFFSET);
    $glObj['hist'] =& $gHist;
     
    // --------------------------------------------------------------------
   
    // < Admin modules - include Users class >
    session_start();  // Start session
    
    require INC_PATH.'includes/classes/Model/Security/Be/Admin_Users.php';
    $gUser = new Admin_Users($gDb, TB . 'admin_users', 20);
    
    if (!empty($_REQUEST['logout']))
    {
        $gUser -> Logout();
        uni_redirect(PATH_ROOT_ADMIN);
    }

    $check_auth = $gUser -> CheckLogin(CURRENT_SCP);

    if ($check_auth >= 2)
    {
        if (empty($_POST['redirectLocation']))
            $_POST['redirectLocation'] = CURRENT_URL;
       
        sc_exit(false);
       
        if ($check_auth == 2)
            $gUser -> AuthForm('', $_POST['redirectLocation']);
        else
            $gUser -> AuthForm($gSmarty -> get_config_vars('errlogpas'), $_POST['redirectLocation']);
        exit();
    }
    else
    {
        $gSystemLogin   = $_SESSION['system_login'];
        $gSystemStatus  = $_SESSION['system_status'];
        $gSystemModules = $_SESSION['system_modules'];
        define('UI_USERNAME', $gSystemLogin);
    }
    $gSmarty -> assign('system_login'  , $gSystemLogin);
    $gSmarty -> assign('system_status' , $gSystemStatus);
    $gSmarty -> assign('system_modules', $gSystemModules);

    if ($check_auth == 1)	
    {    
        if (empty($_POST['redirectLocation']))
        {
            $_POST['redirectLocation'] = CURRENT_URL;
        }    
    	uni_redirect($_POST['redirectLocation']);
    }	
// Admin modules
    include 'includes/classes/Model/Security/Be/Modules.php';
    $mods = new Modules($gDb, TB.'modules', $gHist);   

    $gmodules = array( 
                      array('name' => $gSmarty -> get_config_vars('mgroup1'), 
                            'img'  => 'content.gif', 
                            'vals' => $mods -> GetCheckList(0, 20, 1, $gSystemStatus, $gSystemModules)),  
                      array('name' => $gSmarty -> get_config_vars('mgroup2'), 
                            'img'  => 'commerce.gif', 
                            'vals' => $mods -> GetCheckList(20, 40, 1, $gSystemStatus, $gSystemModules)),    
                      array('name' => $gSmarty -> get_config_vars('mgroup3'), 
                            'img'  => 'tools.gif', 
                            'vals' => $mods -> GetCheckList(40, 60, 1, $gSystemStatus, $gSystemModules)),    
                      array('name' => $gSmarty -> get_config_vars('mgroup4'), 
                            'img'  => 'maintenance.gif',      
                            'vals' => $mods -> GetCheckList(60, 80, 1, $gSystemStatus, $gSystemModules)),    
                      );
    $gSmarty -> assign('gmodules', $gmodules);                  
    $ml = $mods -> GetList(0,0,1);
    for ($i = 0; $i < count($ml); $i++)
    {
        $modules[]      = $ml[$i]['fname'].'.php'; 
        $modulesNames[] = $ml[$i]['name'];  
    }
             
    $cnt = count($modules);
    $modules_ = array();
    for ($i = 0; $i < $cnt; $i++)
    {
        $modules_[] = ';'.$modules[$i].';';
    }
	if ($check_auth == 1)	
    {    
        $st = $mods -> GetMnuText($gmodules);
        $fl = fopen(BPATH . 'files/data/'.$gSystemLogin.'.xml', 'w');
        fputs($fl, $st);
        fclose($fl);
    }
    $gSmarty -> assign_by_ref('modules' , $modules);
    $gSmarty -> assign_by_ref('modulesNames' , $modulesNames);
    $gSmarty -> assign_by_ref('modules_', $modules_);    
   
    
//Additional params
    if (defined('SID') && 0 < strlen(SID))
    {
        $gSmarty -> assign('SIDQ','?'.SID);
        $gSmarty -> assign('SIDA','&'.SID);
    }

    $last_info =& $gHist -> GetLastAccess($gSystemLogin, 'admin auth');
    $gSmarty -> assign('lastIP'  , $last_info['ip']);
    $gSmarty -> assign('lastDate', $last_info['date']);
   
}
catch (Exception $exc)
{
    sc_error($exc);
}

// =========================================================================
// Other library loading
require_once CLASS_PATH.'Ctrl/Storage/Main.class.php';
require_once CLASS_PATH.'Ctrl/Image/Image_Transform.php';
require_once CLASS_PATH.'Ctrl/Image/Image_Transform_Driver_'.IMG_DRIVER.'.php';

?>