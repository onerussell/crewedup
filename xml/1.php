<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
#####################################
# CREWEDUP/ INDEED RSS WEB SERVICES 
# 05/12/2009 V.05
#####################################
include_once 'db/crewDB.php';


$result = mysql_list_tables("crewedup_live");
$num_rows = mysql_num_rows($result);
for ($i = 0; $i < $num_rows; $i++) {
    echo "Table: ", mysql_tablename($result, $i), "\n";
}



$result = mysql_query("SELECT uid, job_title, cid, descr, pdate FROM cu_jobs ORDER BY pdate DESC LIMIT 25 ");

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
  echo  $row["uid"], "<br>";
  echo  $row["job_title"], "<br>";
  echo  $row["cid"], "<br>";
  echo  $row["descr"], "<br>";
  echo  $row["pdate"], "<br>";
  echo '<hr/>';
}

echo mysql_errno() . ": " . mysql_error() . "\n";
mysql_free_result($result);

?>