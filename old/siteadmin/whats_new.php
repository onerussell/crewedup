<?php
/**
 * What's new in the latest version
 *
 * @package    Engine37 catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37 Team
 * @link       http://Engine37.com
 */

require 'top.php';
load_gz_compress($gSmarty);
$main_content = $gSmarty->fetch('mods/Help/WhatsNew.html');

$gSmarty -> assign_by_ref('main_content', $main_content);
$gSmarty -> display('main_template.html');

require 'bottom.php';
?>