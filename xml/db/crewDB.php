<?php
#error_reporting(0);
################################
# DYNAMIC CONNECT TO DB V.2
# 05/12/2009 
###############################

$local="localhost";
$username="crewedup_live";
$password="XFS5metNDZ86FQWz";
$database="crewedup_live";

mysql_connect($local,$username,$password);
mysql_select_db($database) or die( "no connection");
//$charset = mysql_client_encoding();
?>