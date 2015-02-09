<?php
/**
 * Server info
 *
 * @package   Engine37 Cat 1.0
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2003-2006 Engine37 Team
 * @link       http://Engine37.com
 */
require 'top.php';
load_gz_compress($gSmarty);

$main_content = $gSmarty->fetch('mods/Tools/ServerInfo.html');

$gSmarty->assign_by_ref('main_content', $main_content);
$gSmarty->display('main_template.html');

require 'bottom.php';
?>