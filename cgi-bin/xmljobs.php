<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title><?php echo $title ?></title>
    <script type="text/javascript" src="http://www.indeed.com/ads/apiresults.js"></script>
</head>
<body>

<form method="get" action="<?=$_SERVER['PHP_SELF']?>" target="_self">
  <input type="text" name="what" size=20 maxlength=20>
  <input type="text" name="where" size=20 maxlength=20>
  <input type="submit">
</form>



<?php
   
   class XMLJobs {
   var $totalresults = '';
   var $titles = array();
   var $jobtypes = array();
   var $companies = array();
   var $locations = array();
   var $jobs = array();
	function FetchAllData($l_xml)
		{
		foreach ($l_xml->results->result as $this_result)
			{
			//Fetching Jobs
			$this->jobs[]	=	array(	'title'			=>$this_result->jobtitle,
							'company'		=>$this_result->company,
							'snippet'		=>$this_result->snippet,
							'onmousedown'		=>$this_result->onmousedown,
							'source'		=>$this_result->source,
							'url'			=>$this_result->url,
							'date'			=>$this_result->date,
							'jobkey'		=>$this_result->jobkey,
							'age'			=>$this_result->formattedRelativeTime,
							'location'		=>$this_result->formattedLocationFull);
				
				// Fetching companies
				if (in_array($this_result->company, array_keys($this->companies)))
				{
					$this->companies["$this_result->company"]++;
				} else {
					$this->companies["$this_result->company"] = 1;
				}
				
				// Fetching titles
				if (in_array($this_result->jobtitle, array_keys($this->titles)))
				{
					$this->titles["$this_result->jobtitle"]++;
				} else {
					$this->titles["$this_result->jobtitle"] = 1;
				}
				
				// Fetching Locations
				if (in_array($this_result->formattedLocationFull, array_keys($this->locations)))
				{
					$this->locations["$this_result->formattedLocationFull"]++;
				} else {
					$this->locations["$this_result->formattedLocationFull"] = 1;
				}
			}
		$this->companies = arsort($this->companies);
		$this->titles = arsort($this->titles);

		}
	
	function FetchData($Data, $DataArr)
		{
		if (in_array($Data, array_keys($DataArr)))
			{
				$DataArr["$Data"]++;
			} else {
				$DataArr["$Data"] =1;
		}
		return $DataArr;
		}
	
	function SortBy($value,$sortkey)
		/*{	$newArr = array();
			if (!empty($sortby))
			{
				
				foreach ($arr as $thisResult)
					if (inarray($thisResult, $value))
					{
						$newArr[] = $thisResult;
					}
				return $newArr;
			} else {
				return $arr;
			}
		}*/
	{
		switch ($sortkey)
			{
				case 1: //company
					{
						$newArr = array();
						foreach ($this->jobs as $thisResult)
						{
							/*if (preg_replace(" ", "_", $thisResult['company']) == preg_replace(" ", "_", $value))
						
							{
								echo $value."<br>";
								echo $thisResult['$value'];
								$newArr[] = array($thisResult);
							}
							*/
							//if (in_array($value, $thisResult))
							if (strcmp(urlencode($thisResult['company']),$value) == 0)
								$newArr[] = $thisResult;
								/*$newArr[] = array(
										'title' 		=>$thisResult[title],
										'company'               =>$thisResult[company],
										'snippet'               =>$thisResult[snippet],
										'onmousedown'           =>$thisResult[onmousedown],
										'source'                =>$thisResult[source],
										'url'                   =>$thisResult[url],
										'date'                  =>$thisResult[date],
										'jobkey'                =>$thisResult[jobkey],
										'age'                   =>$thisResult[formattedRelativeTime],
										'location'              =>$thisResult[formattedLocation]);
							*/
							echo $value."<br>";	
						//	return $newArr;
						}
						return $newArr;
						break;
					}
				
				 case 2: //title
					{
						$newArr = array();
						foreach ($this->jobs as $thisResult)
						{
							/*if (preg_replace(" ", "_", $thisResult['title']) == preg_replace(" ", "_", $value))
							{
								$newArr[] = array(thisResult);
							}
							return $newArr;

						*/
							//if (in_array($value, $thisResult))
							if (strcmp(urlencode($thisResult['title']),$value) == 0)
								$newArr[] = $thisResult;
								/*$newArr[] = array(
										'title' 		=>$thisResult[title],
										'company'               =>$thisResult[company],
										'snippet'               =>$thisResult[snippet],
										'onmousedown'           =>$thisResult[onmousedown],
										'source'                =>$thisResult[source],
										'url'                   =>$thisResult[url],
										'date'                  =>$thisResult[date],
										'jobkey'                =>$thisResult[jobkey],
										'age'                   =>$thisResult[formattedRelativeTime],
										'location'              =>$thisResult[formattedLocation]);
							*/
							echo $value."<br>";



						}
						return $newArr;
						break;
					}
				default:
				{
					return $this->jobs;
				}
					
				
			}
			
		
			
	}
	
	function Init($_what,$_where)
		{
		//if (empty($_what)) $_what = 'TV';
		$what = empty($_what) ? $_what : 'TV';
		//if (empty($_where)) $_where = 'Los+Angeles+CA';
		$where = empty($_where) ? $_where : 'Los+Angeles+CA';
		
		
		
		$XML_Query="http://api.indeed.com/ads/apisearch?publisher=8253132128796554&q=$what&l=$where&start=0&limit=1&highlight=1&userip=$userip&useragent=$useragent";
		$xml = simplexml_load_file($XML_Query);
		/*if ($xml->totalresults > 200)
			{
			$bypass = ($xml->totalresults/200)+1;
			} else {
			$bypass = 1;
			}
		*/
		$this->totalresults = $xml->totalresults;	
		$bypass = ($xml->totalresults > 200) ? ($xml->totalresults/200)+1 : 1;
		
		for ($i=0; $i<$bypass; $i++)
			{
				$_start = $i*200;
				$_end = $start+200;
				$XMLQuery="http://api.indeed.com/ads/apisearch?publisher=8253132128796554&q=$_what&l=$_where&start=$_start&limit=$_end&highlight=1&userip=$userip&useragent=$useragent";
				$data = simplexml_load_file($XMLQuery);
			
				$this->FetchAllData($data,$start);
			
			/*foreach ($data->results->result as $this_result)
				{
				$companies = this->FetchData($this_result->company, $companies);
				$titles = this->FetchData($this_result->title, $titles);
				$locations = this->FetchData($this_result->formattedLocationFull, $locations);}
				*/
				
			
			}
		}
	}
   
	
	echo "Start".time()."<br>";
	$what = isset($_GET['what']) && !empty($_GET['what']) ? urlencode($_GET['what']) : 'TV';
	$where = isset($_GET['where']) && !empty($_GET['where']) ? urlencode($_GET['where']) : 'Los+Angeles+CA' ;
	$page = isset($_GET['page']) && !empty($_GET['page']) ? urlencode($_GET['page']) : '1';
	$userip = urlencode($_SERVER['REMOTE_ADDR']);
	$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);		
			
	$xmlData = new XMLJobs();
	$xmlData->Init($what,$where);
	echo "After init".time()."<br>";
	echo"<table width='100%' border='1'><td>";
	echo "Companies count:".count(array_keys($xmlData->companies));
	/*
	foreach ($xmlData->companies as $name => $value)
		{
			echo "$name => (<b>$value</b>)<tr>";
		}
	echo "<tr>";
	echo "After companies count before titles count".time()."<tr>";
	
	echo count(array_keys($xmlData->titles))."<tr>";
	
	
	foreach ($xmlData->titles as $title => $value)
		{
			echo "$title => (<b>$value</b>)<tr>";
		}
	echo "<tr>";
	echo "Done!".time()."</td>";

	echo '<td width="75%">';
	
	
	foreach ($xmlData->jobs as $result)
		{
			echo "<tr>".
			"<h2>".$result['title']."</h2><br>".
			"<font color=grey>".$result['company']."</font><br>".
			$result['snippet']."<br>".
			"From:".$result['source']." ".$result['age']."<br><a href='".
			$result['url']."' alt='See more...' onmousedown=".$result['onmousedown'].">See more...</a><br></tr>";
		}
	
	echo "</td></table>";
	*/
	$sortby = isset($_GET['sortby']) ? urlencode($_GET['sortby']) : '' ;
	$sort = isset($_GET['sort']) ? urlencode($_GET['sort']) : '' ;
	$sorted = array();
	$sorted = $xmlData->SortBy($sort,$sortby);
	
	foreach ($sorted as $result)
	{
		echo "<br>".gettype($result);
	//foreach ($sorted as $result)
	
		echo 	'<a href="xmljobs.php?sortby=2&sort='.urlencode($result['title']).'" >'.$result['title'].'</a><br>'.
		'<a href="xmljobs.php?sortby=1&sort='.urlencode($result['company']).'" >'.$result['company'].'</a><br>'.
		$result['snippet'].'<br>'.'<a href="'.$result['url'].'">'.$result['url'].'</a>'.
		'Posted: '.
		$result['date'].'<br>'.
		$result['jobkey'].'<br>'.
		$result['age'].'<br>'.
		$result['location'].'<br>';
	}
	
			
	
	
	
   
   
   // Some init
   /*
	function GetCmpList( 
				$company = '',
				$cmpArr = array()
				)
		{
		foreach ($cmpArr as $cmpName => $cmpVal)
			{
			if ($cmpName == $company)
				{
	
					$cmpArr[$cmpName]++  ;
				
				} else {
					
					$cmpArr[] = array($company => 1);
				
				}
			}
		return $cmpArr;
		}

	
	


	$companyArr = array();

	$what = isset($_GET['what']) ? urlencode($_GET['what']) : 'TV';
	$where = isset($_GET['where']) ? urlencode($_GET['where']) : 'Los+Angeles+CA' ;
	$page = isset($_GET['page']) ? urlencode($_GET['page']) : '1';
	$company ='';

	// $sort	// Sort by relevance or date. Default is relevance.
	// $jt		// Job type. Allowed values: "fulltime", "parttime", "contract", "internship", "temporary".
	// $fromage	// Number of days back to search.
	// $highlight	// Setting this value to 1 will bold terms in the snippet that are also present in q. Default is 0.




	
	$title = "$what in $where";
	
	$start = (($page-1) * 200);
	
	$end = $start + 200;


	//Some debug
	echo "page: $page <br>";
	echo "start: $start <br>";
	echo "end: $end <hr>";
	
	
	
	$tmpdir = sys_get_temp_dir();
	$publisher = "8253132128796554";
	$userip = urlencode($_SERVER['REMOTE_ADDR']);
	$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
	//if ($what && $where) {   
		//$XML_Query="http://api.indeed.com/ads/apisearch?publisher=$publisher&q=$what&l=$where&start=0&limit=1&userip=$userip&useragent=$useragent"; 
		echo "Fetching XML Data (200)<br>";
		echo time()."<br>";
		$XML_Query="http://api.indeed.com/ads/apisearch?publisher=$publisher&q=$what&l=$where&start=$start&limit=$end&highlight=1&userip=$userip&useragent=$useragent"; 

		//echo phpinfo();
		echo "Loading it to RAM<br>".time()."<br>";	
		$xml = simplexml_load_file($XML_Query);
		echo "Loaded<br>".time()."<br>";
?>
		<table width="100%" >
			<td width="300" align="center" >
				<?php
				foreach ($xml->results->result as $thisResult)	
				{
				
				if (in_array($thisResult->company, array_keys($companyArr)))
					{
						$companyArr["$thisResult->company"]++;
					} else {
						$companyArr["$thisResult->company"] = "1";
					}
				
				echo '
				
				<tr>
				<br>Printing results<br>'.time().'
				<br>

				<h2>
					<a href="http://www.indeed.com/rc/clk?jk='
					.$thisResult->jobkey.
					'" onClick="'
					.$thisResult->onmousedown.
					'" alt="Apply">'
					.$thisResult->jobtitle.
					'</a></h2><p>'
					.$thisResult->snippet.
					'</p><br><b>'
					.$thisResult->company.
					'</b><br>'
					.$thisResult->jobkey.
					'<br>

					</tr>'
				;
				}




		//$XML_Query="http://api.indeed.com/ads/apisearch?publisher=$publisher&q=$what&l=$where&start=$start&limit=$end&highlight=1&userip=$userip&useragent=$useragent"; 
		
		
		
		/*
		$сurrentTime = microtime(true);
		$cache = $tmpdir.'/yws_'.md5($XML_Query);
		
		if(file_exists($cache) && filemtime($cache) > (time()-7200)) {
			//If there's a valid cache file, load its data.
			//$data = load->($cache);
		} else {
			//If there's no valid cache file, grab a live version of the
			//data and save it to a temporary file.  Once the file is complete,
			//copy it to a permanent file.  (This prevents concurrency issues.)
			$xmldata = file_get_contents($XML_Query);
			$tempName = tempnam('$tmpdir','yws');
			file_put_contents($tempName, $xmldata);
			rename($tempName, $cache);
		}
		
		$xml = simplexml_load_file($cache);
		
		foreach ($xml->results->result as $results)
			echo $results -> jobkey ,$results -> company;
			
			echo $xml->results->result;i}
		
		
		
		//echo '<table width="100%" border=0 cellpadding=0 cellspacing=0><td><tr heigth="800"><iframe width=100% src="'.$XML_Query.'" ></tr></td></table>';
	echo "<hr>";
	
	echo count($companyArr)."<br>";

		
		foreach ($companyArr as $compName => $compValue)
		
		{
		
			echo "$compName => (<b>$compValue</b>)<br>";
		
		}
		echo "Done!<br>".time();
	*/
	?>
			</td>
		</table>


</body>
</html>
