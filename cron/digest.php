<?php
chdir('..');
/**
 * Notifications digest
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */

    require '_top.php';
    try
    {         
        require_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 
        $gWire =& new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));
        $gWire -> SendDigest();
    }
    catch (Exception $exc)
    {
        sc_error($exc);
    }

    require '_bottom.php';
?>
ok