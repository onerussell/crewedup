<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  $doc = new DOMDocument();
  $doc->load( 'test.txt' );
echo "<html><head></head><body>";
echo "updates loaded <br>";

//Insert into Database - Cyfix

$con = mysql_connect("localhost","crewedup_live","XFS5metNDZ86FQWz");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
echo "successfully connected <br>";
mysql_select_db("crewedup_live", $con);


  $forms = $doc->getElementsByTagName( "form" );
  foreach( $forms as $theForm )
  {
  $datesubmit = $theForm->getElementsByTagName( "datesubmit" );
  $datesubmit = $datesubmit->item(0)->nodeValue;
  
  $jobtitle = $theForm->getElementsByTagName( "jobtitle" );
  $jobtitle = $jobtitle->item(0)->nodeValue;
  
  $company = $theForm->getElementsByTagName( "company" );
  $company = $company->item(0)->nodeValue;
  
  $location = $theForm->getElementsByTagName( "location" );
  $location = $location->item(0)->nodeValue;
  
  $category = $theForm->getElementsByTagName( "category" );
  $category = $category->item(0)->nodeValue;

  $description = $theForm->getElementsByTagName( "description" );
  $description = $description->item(0)->nodeValue;

  $startdate = $theForm->getElementsByTagName( "startdate" );
  $startdate = $startdate->item(0)->nodeValue;
  
  $theJobURL = $theForm->getElementsByTagName( "thejoburl" );
  $theJobURL = $theJobURL->item(0)->nodeValue;
  
  $theRSSCompany = $theForm->getElementsByTagName( "thersscompany" );
  $theRSSCompany = $theRSSCompany->item(0)->nodeValue;
  
  
$today = date("Y-m-d");
$stringFound = "FALSE";
$result = mysql_query("SELECT * FROM `cu_jobs` WHERE theJobURL = '".$theJobURL."'");
while($row = mysql_fetch_array($result))
  {
  $stringFound = "TRUE";
  echo $row['job_title'] . " - already exists <br>";
  }
  
if ($stringFound=="FALSE")
{
mysql_query("INSERT INTO cu_jobs (uid, cid, job_title, start_date, project_title, show_proj, descr, pdate, isRSS, URL, rssCity, rssjobType, rssCompany, theJobURL, therssCompany)
VALUES ('776', 'Affiliate Job', '".$jobtitle."', '".$today."', '".$jobtitle."', '0', '".$description."', '".time()."', 'RSS', '".$inUrl."', '".$location."', 'Other', '".$company."', '".$theJobURL."', '".$theRSSCompany."')");
echo $jobtitle." - successfully added<br>";
}
/*
mysql_query("UPDATE `crewedup_live`.`cyfix_RSS` SET `LastItemAdded` = '".$upTitle."' WHERE `cyfix_RSS`.`id` ='".$rssID."' LIMIT 1");
*/



  }
  echo "</body></html>";
  mysql_close($con);
  ?>
