<?php
#####################################
# CREWEDUP/ INDEED RSS WEB SERVICES 
# 05/12/2009 V.05
#####################################
include_once 'db/crewDB.php';

function job_one($camp1){

//VARIABLES      
$BaStart = 0;
$BaCount = 3;
$APPID = 'YOUR_APP_ID'; //INDEED

//$request = "http://api.indeed.com/apisearch?key=".$APPID."&q=".urlencode($_GET["e"])."&l=&sort=&start=".$BaStart."&limit=".$BaCount."&fromage=&filter=&latlong=1&as_cmp=".urlencode($camp1)."&st=".$_GET["site"]."";




$con = mysql_connect("localhost","crewedup_live","XFS5metNDZ86FQWz");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("crewedup_live", $con);

$result = mysql_query("SELECT * FROM cyfix_RSS LIMIT 1");

while($row = mysql_fetch_array($result))
  {
  $rssID = $row['id'];
  echo $rssID;
  $rssURL = $row['RSSUrl'];
  $rssLastChecked = $row['LastChecked'];
  $rssLastItemAdded = $row['LastItemAdded'];
  }

mysql_close($con);






//$request = "http://rss.indeed.com/rss?q=".urlencode($_GET["e"])."+company%3A%28".$camp1."%29&sort=date";
$request = str_replace("{URLENCODE}", "".urlencode($_Get["e"])."", $rssURL);
echo $request . ' - request';
$parent = 'item';
//$parent2 = "totalresults";
//$attr1 = "totalhits";
$thing1 = '3'; //JOB RSS URL
//$thing1 = '11';//ORGINAL SITE
$thing2 = '1'; //TITLE
$thing3 = '11'; //DESC
$thing4 = '9'; //DATE
$thing5 = '5';	//COMPANY NAME


//BEGIN XML PARSING
$requestIT = $request;
$response = new DOMDocument();
$response->load($requestIT);

/*$totalResults = $response->getElementsByTagName($parent2); //CHILD BASED TOTAL
  if ($totalResults->length<>0) {
	foreach($totalResults as $value){
echo('<div>' . $value->childNodes->item(0)->nodeValue . '</div>');	
$TotalResults =  $value->childNodes->item(0)->nodeValue;
		}
	}//END RESULT TOTAL
*/	

	 //GET ALL RESULT PARAMETERS
     $webResults = $response->getElementsByTagName($parent);
     if ($webResults->length<>0) {
      
		  $i = ( int )1;
                 foreach($webResults as $value){
			         $inUrl = $value->childNodes->item($thing1)->nodeValue; //Url
				 $inTtl = $value->childNodes->item($thing2)->nodeValue; //Title
				 $inDate = $value->childNodes->item($thing4)->nodeValue; //Date
			         $inDesc = $value->childNodes->item($thing3)->nodeValue; //Description
			      //$inDesc2 = $value->childNodes->item($thing4)->nodeValue; //Description
			      //$inComp = $value->childNodes->item($thing5)->nodeValue; //Company Name
				
			//echo $inUrl.'<br>';
			//echo $inTtl.'<br>';
			//echo $inDate.'<br>';
			//echo $inDesc.'<br>NEWLINE';
				     
			      if ( $i == ( int )20 ){
				    break;
			      } else {
			          $i++;

###############################################
# EXPLODE TITLE AND RETRIEVE CITY AN STATE
##############################################
$exTtl = explode(' - ', $inTtl);//EXPLODE TITLE
$upTitle = $exTtl[0];//Title
$upCompany = $exTtl[1];//Company
//EXPLODE CITY STATE
$exDt = $exTtl[2];
$exData = explode(',', $exDt);
$upCity = $exData[0];//City
$upState = $exData[1];//State

//EXPLODE JOB DESC
$upDesc = explode('...', $inDesc);
//TESTING
echo $inUrl .'<br>';
echo $upTitle .'<br>';
echo $upCompany .'<br>';
echo $upCity .'<br>';
echo $upState .'<br>';
echo $upDesc[0] .'<br>';
echo '<hr/>';
$today = date("Y-m-d");
echo $today;
//Insert into Database - Cyfix

$con = mysql_connect("localhost","crewedup_live","XFS5metNDZ86FQWz");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("crewedup_live", $con);


mysql_query("INSERT INTO cu_jobs (uid, job_title, start_date, project_title, show_proj, descr, pdate, isRSS, URL, rssCity, rssState, rssjobType, rssCompany)
VALUES ('776', '".$upTitle."', '".$today."', '".$upTitle."', '0', '".$upDesc[0]."', '".time()."', 'RSS', '".$inUrl."', '".$upCity."', '".$upState."', 'Other', '".$upCompany."')");

mysql_query("UPDATE `crewedup_live`.`cyfix_RSS` SET `LastItemAdded` = '".$upTitle."' WHERE `cyfix_RSS`.`id` ='".$rssID."' LIMIT 1");

mysql_close($con);


echo 'added successfully';

/*				  
##############################################
# INSERT OR NOT XML DATA INTO DB
#############################################
$result = mysql_query("SELECT SUName FROM FrSettings WHERE SUName = '$dude'");
$row = mysql_fetch_row($result);
$sName = $row[0];


if(empty($sName)){

######################################
# INSERT PREVIEW SETTINGS
######################################
            $sql = 'INSERT INTO '.$this -> mTbJobs.' (uid, job_title, cid, start_date, project_title, show_proj, descr, pdate) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, '.mktime().')';
		    
$query = "INSERT INTO cu_mTbJobs (uid, job_title, cid, start_date, project_title, show_proj, descr, pdate)
VALUES ('--', '--', '--', '--', '--', '--', '--', '--')";
$result =mysql_query($query);

} else {

//No Updates to Make

	}//END IF CUSTOM URL EXISTS
*/

				    }//END LOOP 
			      
			      }
                //echo("</ul>");
			}
			
      }//END FUNK










/* JOB ONE BELOW */
job_one('Fox+Entertainment');

/* JOB TWO BELOW */
#job_one('MTV+Networks');

/* JOB THREE BELOW */
#job_one('Time+Warner+Turner+Broadcasting');

/* JOB FOUR BELOW */
#job_one('Time+Warner+Warner+Bros+Entertainment+Group');

/* JOB FIVE BELOW */
#job_one('Time+Warner+HBO');

/* JOB SIX BELOW */
#job_one('NBC+Universal');

/* JOB SEVEN BELOW */
#job_one('CBS+Corporation');

/* JOB EIGHT BELOW */
#job_one('Disney+ABC+Television+Group');

/* JOB NINE BELOW */
#job_one('Disney+Interactive+Media+Group');

/* JOB TEN BELOW */
#job_one('The+Walt+Disney+Studios');

/* JOB ELEVEN BELOW */
#job_one('Warner+Bros+Entertainment+Group');
?>