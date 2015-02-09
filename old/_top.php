<?php
    #*************************************************************
    # INIT
    #*************************************************************
    $gCnt = 0;
    ini_set('display_errors',false);
    //ini_set('include_path','.;z:/home/rr.local/www/includes/libs/PEAR');

    #Include base functions
    define('INC_PATH', 'siteadmin/');
    define('CLASS_PATH', INC_PATH.'includes/classes/');
    
    require INC_PATH . 'includes/config/main.php';  	
    require INC_PATH . 'includes/libs/main.php';

    set_magic_quotes_runtime(0);
    error_reporting(ERROR_LEVEL);
    ini_set('display_startup_errors', ERROR_DISPLAY);
    ini_set('display_errors'        , ERROR_DISPLAY);

    define('CURRENT_URL'    , getenv('REQUEST_URI'));
    define('CURRENT_SCP'    , getenv('SCRIPT_NAME'));
    define('CURRENT_REFERER', get_referer());

    require_once CLASS_PATH.'Ctrl/Storage/Main.class.php';
    
#******************************************************
#            PEAR and Database initialization
#******************************************************       

    require 'PEAR.php';
    PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');

    require 'DB.php';
    $gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME); // select db type

    //$gDb -> query('SET NAMES utf8');
    $gDb -> setFetchMode(DB_FETCHMODE_ASSOC);
    
#******************************************************
#            Smarty initialization
#******************************************************    

    require CLASS_PATH . 'View/Smarty/Smarty.class.php';
    $gSmarty                  = new Smarty();
    $gSmarty -> compile_check = true;
    $gSmarty -> caching	      = false;
    $gSmarty -> debugging     = false;
    $gSmarty -> template_dir  = 'includes/templates';
    $gSmarty -> cache_dir     = 'files/cache';
    $gSmarty -> compile_dir   = BPATH.'files/templ';
    $gSmarty -> config_dir    = 'includes/conf/';
    $gSmarty -> plugins_dir   = array(
                                     'plugins',
                                     'includes/templates/plugins'
                                     );
    $gSmarty -> config_load('main.conf');

    $glObj = array(
                   'db'     => &$gDb,
                   'smarty' => &$gSmarty
                  );

    # Session config and initialization
    session_save_path('files/sessions');
    session_name(SESSION_NAME);

    if (SESSION_ID_IN_URL)
    {
        ini_set('session.use_trans_sid'   ,'1');
        ini_set('session.use_only_cookies','0');
    }
    else
    {
        ini_set('session.use_trans_sid'   ,'0');
        ini_set('session.use_only_cookies','1');
		ini_set('session.cookie_domain', '.'.DOMEN);
    }
    session_start();  // Start session

#*************************************************************
# Template vars
#*************************************************************   
    $gSmarty -> config_load('main.conf');

    $gSmarty -> assign('curScriptName', CURRENT_SCP);
    $gSmarty -> assign('siteAdr'      , PATH_ROOT);
    
    $gSmarty -> assign('imgDir'           , PATH_ROOT.'tmpl/images/');
    $gSmarty -> assign('stlDir'           , PATH_ROOT.'tmpl/css/');
    $gSmarty -> assign('jsDir'            , PATH_ROOT.'tmpl/js/');
    
    $gSmarty -> assign('charset'      , DEF_CHARSET);
    $gSmarty -> assign('serverName'   , getenv('SERVER_NAME'));
        
#*************************************************************
# Check login and password of administrator
#*************************************************************
    # include Users class
    require CLASS_PATH . 'Model/Security/Users.php';
    include_once CLASS_PATH . 'Ctrl/Crypt/Rc4.php';

    $gRc4   = new Crypt_RC4();
    $gRc4  -> setKey(CRYPT_KEY);         
    $gUser = new Users($gDb, array('table' => TB . 'users', 'friend' => TB . 'users_friend', 'members_cat' => TB . 'members_cat', 'users_block' => TB . 'users_block'), 20, $gRc4);
    if (!empty($_REQUEST['logout']))
    {
        $gUser -> Logout();
        uni_redirect(PATH_ROOT);
    }

    $check_auth = $gUser -> CheckLogin(CURRENT_SCP, 1);
    $is_user    = 0;
    if ($check_auth >= 2)
    {
        if (isset($_POST['system_login']))
        {
            $gSmarty -> assign('check_auth', $check_auth);
        }
    }
    else
    {
        $gSystemLogin   = $_SESSION['system_login'];
        $gSystemStatus  = $_SESSION['system_status'];
        $gSystemModules = $_SESSION['system_modules'];
        $gSmarty        -> assign('system_login'  , $gSystemLogin);
		$gSmarty        -> assign('system_status' , $gSystemStatus);
        $gSmarty        -> assign('system_modules', $gSystemModules);
        define('UID', $gUser -> GetByEmail($gSystemLogin));
        $uinfo          =& $gUser -> Get(UID); 
        $gSmarty        -> assign_by_ref('UserInfo', $uinfo); 
        $uid            = UID;	
        $is_user        = 1;
        $gSmarty -> assign('uid', $uid);
    }

    /** Show other users profile */
    if ( isset($_REQUEST['uid']) && is_numeric($_REQUEST['uid']) && ( !defined('UID') || UID != $_REQUEST['uid'] ) )
    {
        $uid     = $_REQUEST['uid'];
    	$gSmarty -> assign('uid', $uid);
    	$is_user = 0;
    }
    
    $gSmarty -> assign('is_user', $is_user);

    if (isset($gSystemLogin) && $gSystemLogin)
	{ 
        $in_site = 1;
	}
	$gSmarty -> assign('online_users_cnt', $gUser -> GetOnlineUsersCount()); 
	$gSmarty -> assign('all_users_cnt', $gUser -> Count(-1, 1)); 
	$gSmarty -> assign('new_users_cnt', $gUser -> GetNewUsersCount());     
#*************************************************************
# Vars
#*************************************************************

    $id     = (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) ? 0 : $_REQUEST['id'];
    $ctg    = (!isset($_REQUEST['ctg']) || !is_numeric($_REQUEST['ctg'])) ? 0 : $_REQUEST['ctg'];
    $mod    = ( !isset($_REQUEST['mod']) ) ? '' : trim(strtolower($_REQUEST['mod']));
    $action = ( !isset($_REQUEST['action']) ) ? '' : trim(strtolower($_REQUEST['action']));
    $act    = ( !isset($_REQUEST['act']) ) ? '' : trim(strtolower(str_replace('/', '', $_REQUEST['act'])));
    $what   = ( !isset($_REQUEST['what']) ) ? '' : trim(strtolower($_REQUEST['what']));    
    $page   = (isset($_REQUEST['page']) && is_numeric($_REQUEST['page']) && 0 < $_REQUEST['page']) ? $_REQUEST['page'] : 1; 
    $pn     = (!isset($_REQUEST['pn']) || 40 < strlen($_REQUEST['pn'])) ? '' : $_REQUEST['pn'];
    
    $gSmarty -> assign('mod', $mod);
    $gSmarty -> assign('action', $action);  
    $gSmarty -> assign('act', $act);  
    $gSmarty -> assign('page', $page);
    $bc     = array();   

    
    $gSmarty -> assign('iPath', PATH_ROOT . DIR_NAME_IMAGE);
    $gSmarty -> assign('icPath', PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE);  

        
?>