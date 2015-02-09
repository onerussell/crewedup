<?php
require 'top.php';


load_gz_compress($gSmarty);

$main_content = $gSmarty->fetch('index.html');
$gSmarty->assign_by_ref('main_content', $main_content);
$gSmarty->display('main_template.html');
require 'bottom.php';
?>
