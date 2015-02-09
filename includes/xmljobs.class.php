<?php
class XMLJobs {
   var $arrcnt ='';
   var $arr = array();
   //var $sortby = '';
   var $totalresults = '';
   var $titles = array();
   //var $userip = '';
   //var $useragent = '';
   //var $jobtypes = array();
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
							'onmousedown'	=>$this_result->onmousedown,
							'source'		=>$this_result->source,
							'url'			=>$this_result->url,
							'date'			=>$this_result->date,
							'jobkey'		=>$this_result->jobkey,
							'age'			=>$this_result->formattedRelativeTime,
							'location'		=>$this_result->formattedLocation);
				
				// Fetching companies
				if (in_array($this_result->company, array_keys($this->companies)) && !empty($this_result->company))
				{
					$this->companies["$this_result->company"]++;
				} else {
					$this->companies["$this_result->company"] = 1;
				}
					
				// Fetching titles
				if (in_array($this_result->jobtitle, array_keys($this->titles))&& !empty($this_result->jobtitle))
				{
					$this->titles["$this_result->jobtitle"]++;
				} else {
					$this->titles["$this_result->jobtitle"] = 1;
				}
					
				
				// Fetching Locations
				if (in_array($this_result->formattedLocation, array_keys($this->locations))&& !empty($this_result->formattedLocation))
				{
					$this->locations["$this_result->formattedLocation"]++;
				} else {
					$this->locations["$this_result->formattedLocation"] = 1;
				}
					
			}
			arsort($this->companies);
			arsort($this->titles);
			arsort($this->locations);
			$this->companies = array_slice($this->companies, 0, 15);
			$this->titles = array_slice($this->titles, 0, 15);
			$this->locations = array_slice($this->locations, 0, 15);
		}
	
	
	function SortBy($sortkey, $value)
	{
		switch ($sortkey)
			{
				case 1: //company
					{
						$newArr = array();
						foreach ($this->jobs as $thisResult)
						{
							if (strcmp(urlencode($thisResult['company']),$value) == 0)
								$newArr[] = $thisResult;
						}
						return $newArr;
						break;
					}
				
				 case 2: //title
					{
						$newArr = array();
						foreach ($this->jobs as $thisResult)
						{
							if (strcmp(urlencode($thisResult['title']),$value) == 0)
								$newArr[] = $thisResult;
						}
						return $newArr;
						break;
					}
				case 3: //location
					{
						$newArr = array();
						foreach ($this->jobs as $thisResult)
						{
							if (strcmp(urlencode($thisResult['location']),$value) == 0)
								$newArr[] = $thisResult;
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
	
	function Init($_what,$_where,$distance,$fromage,$as=0)
		{
		
		$userip = urlencode($_SERVER['REMOTE_ADDR']);
		$useragent = urlencode($_SERVER['HTTP_USER_AGENT']);	
		$XML_Query="http://api.indeed.com/ads/apisearch?publisher=8253132128796554&q=$_what&l=$_where&start=0&limit=1&highlight=1&userip=$userip&useragent=$useragent&v=2";
		$xml = simplexml_load_file($XML_Query);
		$this->totalresults = $xml->totalresults;	
		$bypass = ($xml->totalresults > 200) ? ($xml->totalresults/200)+1 : 1;
		//if ($bypass > 15) $bypass = 15; // 3000 items limit
		for ($i=0; $i<$bypass; $i++)
			{
				$_start = $i*200;
				$_end = $_start+200;
				$XMLQuery="http://api.indeed.com/ads/apisearch?publisher=8253132128796554&q=$_what&l=$_where&start=$_start&limit=$_end&highlight=1&userip=$userip&useragent=$useragent&radius=$distance&fromage=$fromage&v=2";
				$data = simplexml_load_file($XMLQuery);
			
				$this->FetchAllData($data);			
			}
		}
	/*	$XML_Query="http://api.indeed.com/ads/apisearch?publisher=8253132128796554&as_and=$as_and&as_phr=$as_phr&as_any=$as_any&as_not=$as_not&as_ttl=$as_ttl&as_cmp=$as_cmp&jt=$as_jt&st=&salary=&radius=$_distance&l=$_whereCA&fromage=$fromage&limit=$_end&sort=$sort_by&highlight=1&userip=$userip&useragent=$useragent&v=2";
	*/
	
	function FetchPage ($perpage ,$page=1,$sortby='',$sort='')
	{
		$arr = array();
		//$this->Init($what,$where);
		if (!empty($sortby) && !empty($sort))
			$arr = $this->SortBy($sortby,$sort);
		else 
			$arr = $this->jobs;
			$this->arrcnt = count($arr);
		return array_slice($arr,($page-1)*$perpage,$perpage);
	}
   }
?>