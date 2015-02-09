<?php
define('MODULE_ID', 'logout');
require 'top.php';
sc_exit(false);
uni_redirect(get_referer());
?>