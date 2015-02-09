<?php
/**
 * Configuration file
 * 
 * @package    CrewedUp
 * @version    1.0
 * @since      24.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

// --------------------------------------------------------------------------------------------------

// < Access to database >
define('DB_TYPE'          , 'mysql');            // allow 'mysql','mssql','pgsql' etc. (compatible with PEAR)
define('DB_MYSQL_VER'     , 4.1);                // MySQL Version
define('DB_HOST'          , 'localhost');        // mysql-server name
define('DB_USER'          , 'crewedup_db1');    // existing user of database
define('DB_PASS'          , 'QKC!=LR.O@e-'); // and its password
define('DB_NAME'          , 'crewedup_db1');    // name of database
define('TB'               , 'cu_');              // prefix for all tables for this database
// </ Access to database >

// --------------------------------------------------------------------------------------------------

// < Web-server parameters >

define('DOMEN'            , 'crewedup.com');
define('PATH_ROOT'        , '/');  // Site root path
define('BPATH'            , rtrim($_SERVER['DOCUMENT_ROOT'],'/').PATH_ROOT);
define('DIR_NAME_DATA'    , 'files/upload');         // Image directory name
define('DIR_WS_DATA'      , BPATH.DIR_NAME_DATA);    // Dir with uploaded images

// </ Web-server parameters >

// --------------------------------------------------------------------------------------------------

// < Script parameters >

define('GZ_COMPRESS'      , true);
define('DEF_CHARSET'      , 'utf-8');
define('SUPPORT_SITENAME' , 'CrewedUp');
define('ADMIN_EMAIL'      , 'info@crewedup.com');
define('SUPPORT_EMAIL'    , 'info@crewedup.com');
define('ADMIN_LOGIN'      , 'admin');
define('FATAL_ERROR_DISP' , 1);
define('PATH_ROOT_ADMIN'  , PATH_ROOT . 'siteadmin/');

define('ENCODING_PHP'     , 'UTF-8');
define('RESULTS_COUNTER'  , 20);
define('ERROR_LEVEL'      , 2047);       // PHP error reporting level
define('ERROR_DISPLAY'    , 1);          // display errors

define('DIR_NAME_IMAGE'   , 'files/images');       // Image directory name
define('DIR_WS_IMAGE'     , BPATH.DIR_NAME_IMAGE); // Dir with upload images
define('DIR_NAME_IMAGECACHE'  , 'ic');   // Image cache directory name
define('DIR_NAME_IMAGE_SUBDIR', '');     // Subdir for new image dirrectory


define('DIR_NAME_RESIZE'  , '/resize');  // Image cache directory name
define('DIR_NAME_RESIZE2' , '/resize2'); // Image cache directory name

define('SESSION_NAME'     , 'cat3id');   // Default session name
define('SESSION_ID_IN_URL', false);      // Use session id in url

define('SSL_ONLY'         , false);      // SSL Only
                                         // for check use function 'crypt'
define('SALT_LENGTH'      , 9);          // used in functions 'uni_id', 'uni_id2'
                                         // default charset

define('CRYPT_KEY'        , md5('Friends'));
define('FCK_PATH'         , 'includes/FCKeditor/');    // FCKeditor path
define('FCK_CLASSPATH'    , FCK_PATH.'fckeditor.php'); // FCKeditor class
define('FCK_BASEPATH'     , PATH_ROOT_ADMIN.FCK_PATH); // FCKeditor BasePath

define('TIME_OFFSET'      , 0);
define('SMARTY_ERROR_REPORTING', 0);
define('SMARTY_DEBUG'     , 0);
define('IMG_DRIVER'       , 'GD');

define('SEARCH_TYPE'      , 'AND');
// </ Script parameters >

// --------------------------------------------------------------------------------------------------

?>