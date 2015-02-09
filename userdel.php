<?php
/**
 * Film2Tv controller
 *
 * @package   CrewedUp
 * @version   1.0
 * @since     14.05.2009
 * @copyright 2007-2009 Engine37
 * @link      http://engine37.com
 */

    require '_top.php';

    $gSmarty -> assign_by_ref('_content', $gSmarty -> Fetch('mods/userdel/_userdel.html'));
    $gSmarty -> display('main.html');
    $gDb -> disconnect();
    exit();