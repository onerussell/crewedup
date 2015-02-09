<?php
/**
 * Main functions library
 * 
 * @package    CrewedUp
 * @version    1.0
 * @since      24.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

function array2json($arr) 
{
    $parts = array();
    $is_list = false;
    if (!is_array($arr)) return;
    if (count($arr)<1) return '{}';

    //Find out if the given array is a numerical array
    $keys = array_keys($arr);
    $max_length = count($arr)-1;
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) 
    {//See if the first key is 0 and last key is length - 1
        $is_list = true;
        for($i=0; $i<count($keys); $i++)
        { //See if each key correspondes to its position
            if($i != $keys[$i])
            { //A key fails at position check.
                $is_list = false; //It is an associative array.
                break;
            }
        }
    }

    foreach($arr as $key=>$value)
    {
        if(is_array($value))
        { //Custom handling for arrays
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
        } 
        else
        {
            $str = '';
            if(!$is_list) $str = '"' . $key . '":';

            //Custom handling for multiple data types
            if(is_numeric($value)) $str .= $value; //Numbers
            elseif($value === false) $str .= 'false'; //The booleans
            elseif($value === true) $str .= 'true';
            else $str .= '"' . addslashes($value) . '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

            $parts[] = $str;
        }
    }
    $json = implode(',',$parts);

    if($is_list) return '[' . $json . ']';//Return numerical JSON
    return '{' . $json . '}';//Return associative JSON
}

function _va($arr, $key, $val = '')
{
    if (isset($arr[$key]))
        $val = $arr[$key];

    return $val;
}

function _vp($key, $val = '')
{
    if (isset($_POST[$key]))
        $val = $_POST[$key];

    return $val;
}

function _vg($key, $val = '')
{
    if (isset($_GET[$key]))
        $val = $_GET[$key];

    return $val;
}

function base_chk2($str)
{
    return substr(trim(strip_tags($str, '')),0,1000);
}

function base_chk3($str, $addtl = '')
{
    return substr(trim(preg_replace('/[^0-9a-z_\.'.$addtl.'-]/i', '', $str)),0,1000);
}

/**
 * Get $key-value from POST or GET
 * @param string $key key of array POST or GET
 * @param mixed  $val default value if key not exists in POST or GET
 *
 * @return mixed required value
 */
function _v($key, $val = '', $cookie_f = '', $srlz = false)
{
    $num =  is_numeric($val);

    if (isset($_POST[$key]))
        $val = $_POST[$key];
    elseif (isset($_GET[$key]))
        $val = $_GET[$key];
    elseif ($cookie_f && isset($_COOKIE[$cookie_f][$key]))
    {
        $val = $_COOKIE[$cookie_f][$key];

        if ($srlz)
            $val = unserialize($val);
    }

    return $val;
}

function replace_op_all($str)
{
    // $str = preg_replace('|<(a[^>]+http://[^>]+)>|','<$1 rel="nofollow">', $str);
    $str = preg_replace('|<(a[^>]+)>|','<$1 rel="nofollow">', $str);
    return $str;
}

function str_truncate($string, $length = 80, $etc = '...',
                      $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (strlen($string) > $length) {
        $length -= strlen($etc);
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        }
        if(!$middle) {
            return substr($string, 0, $length).$etc;
        } else {
            return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        }
    } else {
        return $string;
    }
}

function PrepTags( $t = '' )
{
    $t = trim($t);
	if (!empty($t))
	{
	    $a = explode(',', $t);
		$t = array();
		foreach ($a as $k => $v)
		{
		    $v = trim(strip_tags($v));
		    if (!empty($v) && $v != ',')
			{
			    $t[] = $v;
			}
		}
		$t = (empty($t)) ? '' : ','.implode(',', $t).',';
	}
	return $t;
}/** PrepTags */


function UnPrepTags( $t = '' )
{
    if (!empty($t))
	{
	    $t = substr($t, 1, strlen($t) - 2);
	}
	return $t;
}/** UnPrepTags */

function MakeLink($l)
{
    $l    = strtr(strtolower($l), array(' ' => '_'));
    $link = '';
    $as   = array('_abcdefghijklmnopqrstuvwxyz');
    for ($i = 0; $i < strlen($l); $i++)
    {
        if ( $l[$i] == '_' || ('a' <= $l[$i] && 'z' >= $l[$i]) || ('0' <= $l[$i] && '9' >= $l[$i]))
        {
            $link .= $l[$i];
        }
    }	
	return $link;
}#MakeLink


function smarty_block_dynamic($param, $content, &$smarty) 
{
    return $content;
}

	
function checkReq($form, $req)    
{
	$errs = array();
	foreach ($req as $val)
	{
    	if(!isset($form[$val]) || '' == $form[$val])
    		$errs[] = $val;
	}
	return $errs;
}
	
// --------------------------------------------------------------------------------
/**
 * Debug function
 *
 * @param string $val
 * @param int $ondie
 */

function deb(&$val, $ondie = true)
{
    echo '<pre>';
    print_r($val);
    if ($ondie)
        die(); 
}#Deb

// --------------------------------------------------------------------------------

function MakeDate($pd, $delim = '.')
{
     $pd = explode($delim, $pd);
     if (
            (isset($pd[0]) && $pd[0] >= 1 && $pd[0] <= 31) &&
            (isset($pd[1]) && $pd[1] >= 1 && $pd[1] <= 12) &&
            (isset($pd[2]) && $pd[2] >= 1970 && $pd[2] <= 2050)
        )
    {
        $pdate = $pd[2].'-'.$pd[1].'-'.$pd[0];
    }
    else 
    {
        $pdate = date('Y-m-d', mktime());
    }
    return $pdate;       
}#MakeDate


/**
 * Make previous or next date by date Y-m-d
 * 
 * @param string $pdate - date as Y-m-d
 * @param string $pn    - 0 - return prev month date, 1 - next month date
 *
 */
function MakePrevNextDate( $pdate, $pn = 0 )
{
    $pd = explode('-', $pdate); 
    $r  = array(date("j_n_Y", mktime(0, 0, 0, $pd[1]-1, $pd[2], $pd[0])), date("j_n_Y", mktime(0, 0, 0, $pd[1]+1, $pd[2], $pd[0])));
    return $r;       
}/** MakePrevNextDate */


/**
 * Make Y-m-d date from american date
 *
 * @param date $pd - date as m/d/Y
 * @return string $date
 */
function MakeDateA($pd)
{
     $pd = explode('/', $pd);
     if (
            (isset($pd[0]) && $pd[0] >= 1 && $pd[0] <= 12) &&
            (isset($pd[1]) && $pd[1] >= 1 && $pd[1] <= 31) &&
            (isset($pd[2]) && $pd[2] >= 1970 && $pd[2] <= 2050)
        )
    {
        $pdate = $pd[2].'-'.$pd[0].'-'.$pd[1];
    }
    else 
    {
        $pdate = date('Y-m-d', mktime());
    }
    return $pdate;       
}#MakeDateA


function MakeTime($tm = '', $zn = 0)
{
    $r = '00:00:00';
    if ('' == trim($tm))
    {
        return $r;
    }
    $pd = explode(':', $tm);
    $st = '';        
    if (is_numeric($pd[0]) && 0 <= $pd[0] && 23 >= $pd[0])
    {
        $st = ($pd[0] + (1 == $zn ? 12 : 0)).':';
    }
    else 
    {
        return $r;
    }
    
    if (isset($pd[1]) && is_numeric($pd[1]) && 0 <= $pd[1] && 59 >= $pd[1])
    {
        $st .= $pd[1].':';
    }
    else 
    {
        $st .= '00:';
    }
    $st .= '00';
    return $st;
}#MakeTime


    /**
    * Make original filename
    * @param string $fname - filename
    * @param string $path   - filepath, for example see DIR_WS_IMAGE in main.php
    * @return string - unique image name
    */
    function MakeOrig($fname = '', $path = '', $rv = 0)
    {
        if ($fname == '' || $path == '')
        {
            return $fname;
        }
        $i    = explode('.', $fname);
        if (count($i) < 2)
        {
            $i[1] = 'jpg';
        }
        if (1 == $rv)
        {
            $i[0] = randval();
        }
        $ic   = $i[0];
        $k    = 0;
        while (file_exists($path . '/' . $ic.'.'.$i[count($i)-1]))
        {
            $ic = $i[0] . $k;
            $k ++;
        }
        $s =  $ic.'.'.$i[count($i)-1];
        return $s;
    }#MakeOrig

function SaveLog($query)
{
	global $gCnt;
	$gCnt ++;
	/*
	if (isset($_COOKIE['cat3id']))
	{
	    $ft = getenv("DOCUMENT_ROOT").'/files/log/'.$_COOKIE['cat3id'].'.txt';
        if (file_exists($ft))
        {
            $fl = fopen($ft, "a"); 
        }
        else 
        {
            $fl = fopen($ft, "w");            
        }
        fputs($fl, date("d.m.Y h:i:s", mktime()).' '.$query."\n");
        fclose($fl);
	}	
	*/
}#SaveLog
    


/**
 * Crop function
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop($w, $h, $uploadfile, $res_img, $crop = 1)
{
    $size = getimagesize($uploadfile);

    if ($size)
       {
        $width  = $size[0];
        $height = $size[1];

        $imgObjName  =  'Ctrl_Image_Transform_Driver_'.IMG_DRIVER;
        $img         =& new $imgObjName();

        if ($width > $w || $height > $h)
           {
            $wx = $w;
            $hx = $h;

            $img -> load($uploadfile);

            if (1 == $crop)
               {
                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                   {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                   }
                else // árop by height
                   {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                   }
               
                $img -> save($res_img);
                $img -> load($res_img);
               }
             else
               {
                $coeff = $height / $width;

                if ($coeff*$wx > $hx)
                   $wx = $width*$hx / $height;
                  else
                   $hx = $height*$wx / $width;
               }

            if ($img -> resize($wx, $hx))
               {
                $img -> save($res_img,'jpeg');
                return true;
               }
             else
                return false;
           }
         else
           return false;
       }
     else
       return false;
}

/**
 * Crop function with copy image
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop_copy($w, $h, $uploadfile, $res_img, $crop = 1)
{
    $size = getimagesize($uploadfile);

    if ($size)
    {
        $width  = $size[0];
        $height = $size[1];

        $imgObjName  =  'Image_Transform_Driver_'.IMG_DRIVER;
        $img         =& new $imgObjName();

        if ($width > $w || $height > $h)
        {
            $wx = $w;
            $hx = $h;

            $img -> load($uploadfile);

            if (1 == $crop)
            {
                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // árop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }
               
                $img -> save($res_img);
                $img -> load($res_img);
            }
            else
            {
                $coeff = $height / $width;

                if ($coeff*$wx > $hx)
                   $wx = $width*$hx / $height;
                else
                   $hx = $height*$wx / $width;
            }

            if ($img -> resize($wx, $hx))
            {
                $img -> save($res_img,'jpeg');
                return true;
            }
            else
            {
                return false;
            }    
        }
        else
		{
            copy($uploadfile, $res_img); 
		}	
    }
    else
    {
        return false;
    }  
}#i_crop_copy

/**
 * Add watermark to image
 *
 * @param string $im
 * @param string $wm
 * @return bool true
 */
function WaterMark($im = '', $wm)
{
    $size   = getimagesize($im); 
    if (strpos('_'.$size['mime'], 'image') <=0)
    {
        return false;
    }
	
    $watermark        = imagecreatefrompng($wm);  
	$watermark_width  = imagesx($watermark);  
    $watermark_height = imagesy($watermark); 
    $iim = imagecreatefromjpeg($im);     
 
    #$image = imagecreatetruecolor($size[0], $size[1]);  
    #imagecopy($image, $watermark, 0,0,0,0, $size[0], $size[1]);    
    ImageCopy($iim,$watermark,$size[0]-$watermark_width-2, 2,0,0,$watermark_width,$watermark_height);    
    imagejpeg($iim, $im, 90);
    imagedestroy($iim);  
    imagedestroy($watermark); 
    return true; 
}#WaterMark

// --------------------------------------------------------------------------------

/**
 * Element in_array
 * @param mixed  $needle 
 * @param array $haystack  
 * @param bool  $strict   
 *
 * @return bool
 */
function in_array_i($needle, $haystack, $strict = false)
{
    if (is_array($needle))
    {
        $flag = false;
        $cnt  = count($needle);
        for ($i = 0; $i < $cnt; $i++)
        {
            if (in_array($needle[$i], $haystack, $strict))
            {
                $flag = true;
                break;
            }
        }
    }
    else
        $flag = in_array($needle, $haystack, $strict);

    return $flag;
}

// --------------------------------------------------------------------------------

/**
 * make unsigned int
 * @param  mixed $val output var
 * @return int
 */
function uintval($val)
{
    return abs(intval($val));
}

// --------------------------------------------------------------------------------

/**
 * check int val as 0||1
 * only two value: 0 or 1
 * @param  mixed $val output var
 * @return int only 0 or 1
 */
function bitval($val)
{
    if (empty($val))
       $val = 0;
      else
       $val = 1;

    return $val;
}

// --------------------------------------------------------------------------------

function get_img_ext($fname)
{
   $temp = getimagesize($fname);
   if (!$temp) 
      return false;

   $ext = '';
   switch($temp[2])
         {
          case 1:  $ext = 'gif';
                   break;
          case 2:  $ext = 'jpg';
                   break;
          case 3:  $ext = 'png';
                   break;
          //case 6:  $ext = 'bmp';
          //         break;
          default: $ext = false;
                   break;
         }
   return $ext;
}

// --------------------------------------------------------------------------------

/**
 * Prepare string for DB
 * @param string $str ¢å®¤­ ï áâà®ª 
 * @param int    for htmlspecialchars
 * @return string
 */
function SpecialChars($str, $quote = ENT_COMPAT)
{
    return htmlspecialchars($str, $quote, ENCODING_PHP);
}

// --------------------------------------------------------------------------------

/**
 * make lowercase 
 * mb_string
 * @param string $str input string
 * @return string
 */
function ToLower($str)
{
    return StrToLower($str);
}

// --------------------------------------------------------------------------------

/**
 * Make Uppercase
 * (for insert mb_string)
 * @param string $str input string
 * @return string
 */
function ToUpper($str)
{
    return StrToUpper($str);
}

// --------------------------------------------------------------------------------

/**
 * GZ-Compress (i)

 * @param Smarty $gSmarty ®¡ê¥ªâ Smarty
 *
 * @return void
 */
function load_gz_compress(&$gSmarty)
{
    if (defined('GZ_COMPRESS') && 1 == GZ_COMPRESS 
        && false !== strpos(getenv('HTTP_ACCEPT_ENCODING'), 'gzip') 
       )
    {
        header('Content-Encoding: gzip');
       
        function GZCallback($buffer) 
        {
            return gzencode($buffer, 9);
        }
       
        ob_start('GZCallback');
        ob_implicit_flush(0);
        $gSmarty -> assign('GZ_COMPRESS', GZ_COMPRESS);
    }
}

// --------------------------------------------------------------------------------

/**
 * PEAR Error handling function. Generate exception.
 *
 * @param object $errorPbj
 * @return void
 */
function pear_error_callback($errorObj) 
{
    if (empty($GLOBALS['noDbErrors']))
        sc_error($errorObj->message.'<br /><br />'.$errorObj->userinfo);
}

// --------------------------------------------------------------------------------

function get_referer($onlyMyHost = true)
{
    $ref = getenv('HTTP_REFERER');
    if ($ref)
    {
        if ($onlyMyHost)
        {
            $out = p_url($ref);
            $ref = $out['path'].$out['query'];
        }
    }
    else
        $ref = '/';

    return $ref;
}

// --------------------------------------------------------------------------------

/**
 * Normal exit
 *
 * @param bool $callExit call exit() after function execution
 * @return void
 */
function sc_exit($callExit = true)
{
    global $gDb;
    @$gDb -> disconnect();

    $_SESSION = array();

    if (isset($_COOKIE[session_name()]))
       setcookie(session_name(), '', m_time()-90000, '/');

    session_unset();
    session_destroy();

    if ($callExit)
        n_exit();
}

// --------------------------------------------------------------------------------

/**
 * Standard function for display of errors
 *
 * @param string $mess       message of error
 * @param string $addMess    additional information about error
 * @param string $fName      script name
 * @param string $lineNumber number of line in script
 *
 * @return string
 */
function sc_error($mess, $addMess = '', $fName = '', $lineNumber = '')
{
    $trace = '';
    if (is_object($mess))
    {
        $trace  = $mess -> getTrace();
        $newArr = array();
        for ($i = 0; $i < count($trace); $i++)
        {
            if (preg_match('/(pear|db\.php)/i', $trace[$i]['file']) )
               continue;
               
            $newArr[] = $trace[$i];
        }

        $trace      = '<pre>'.print_r($newArr,true).'</pre>';
        $lineNumber = $mess -> getLine();
        $fName      = $mess -> getFile();
        $mess       = $mess -> getMessage();
    }

    $matches = array();
    if (preg_match('/^\@(.+)$/', $mess, $matches)) 
       {
        global $gLang;
        $mess = $gLang[$matches[1]];
       }

    if (!empty($fName))
        $mess .= '<br /><br />file: '.$fName.'<br />line: '.$lineNumber;
     else
        $mess .= '<br /><br />script: '.getenv('SCRIPT_NAME');

    $mess = '<font color="#000000"><b>' . $mess . '<br /><br />';

    if (!empty($addMess))
       $mess .= $addMess . '<br /><br />';

    $mess .=  '<small><font color="#ff0000">STOP</font></small>'
            .'<br /><br /></b></font>'.$trace;

    if (1 == FATAL_ERROR_DISP)
    {
        echo $mess;
        n_exit();
    }
    else
    {
        admin_notify('Fatal Error', $mess);
        require(BPATH.'404.php');
    }
}

// --------------------------------------------------------------------------------

/**
 * Generate random string value (through md5) based on unique information.
 * Initial unique information is supplemented with random numbers
 *
 * @param string $info unique information for encryption
 *
 * @return string
 */
function uni_id2($info = '')
{
    $length = SALT_LENGTH;
    $chars = '0123456789abcdef';
    $salt  = '';
    mt_srand((double)microtime()*1000000);
    while ($length--) 
    {
        $salt .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    
    return md5($salt.$info.mt_rand(0,1000000).get_mt_time());
}

// --------------------------------------------------------------------------------

/**
 * Generate random string value (through md5) based on unique information.
 * Result string includes additional information for subsequent comparison.
 *
 * @param string $info unique information for encryption
 *
 * @return string
 *
 * @see auto_login()
 */
function uni_id($info = '')
{
    $length = SALT_LENGTH;
    $chars  = '0123456789abcdef';
    $salt   = '';
    mt_srand((double)microtime()*1000000);
    while ($length--) 
    {
        $salt .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    
    return $salt.md5($salt.$info);
}

// --------------------------------------------------------------------------------

/**
 * Generate random unique integer value dependent on current time
 *
 * @return int
 */
function randval()
{
   return (int)date('n').date('j').date('y').date('h').date('i').date('s').rand(99,2);
}         

// --------------------------------------------------------------------------------

/**
 * Universal function for redirect. Auto-update urls if use_trans_id is on.
 *
 * @param string $url       url for redirect
 * @param int    $flag      type of redirect: 1,3 - through HTTP Header, 2,4 - through meta-tag. 3,4 - auto-update url with https (SSL Only)
 * @param int    $useSID    update url with session id: 0 - never, 1 - if no host in url, 2 - always
 * @param string $addParams this string is put in url end
 *
 * @return void
 */
function uni_redirect($url, $flag = 1, $useSID = 1, $addParams = '') // 
{
    $url = add_sid($url,$useSID);
    if ('' != $addParams)
    {
        $purl   = parse_url($url);

        if (3 == $flag || 4 == $flag)
            $scheme = 'https://';
        else
            $scheme = (!empty($purl['scheme'])) ? $purl['scheme'].'://' : '';

        $host   = (!empty($purl['host'])) ?$purl['host'] : '';
        $port   = (!empty($purl['port'])) ?$purl['port'] : '';
        $path   = (!empty($purl['path'])) ?$purl['path'] : '/';


        $url    = $scheme.$host.$port.$path.'?';
        
        $url   .= (!empty($purl['query'])) ? $purl['query'].'&' : '';
        $url   .= $addParams;
    }

    if (1 == $flag || 3 == $flag)
        header('Location: '.$url);
     else
        echo '<html><head><meta http-equiv="Refresh" content="0; url='.$url.'" /></head></html>';

    n_exit();
}

// --------------------------------------------------------------------------------

/**
 * Add session id in url if it is required
 *
 * @param string $url     url
 * @param int    $useSID  0 - no , 1 - if no host, 2 - always
 *
 * @return string result url
 *
 * @see uni_redirect()
 */
function add_sid($url, $useSID = 1) // 
{
    $purl   = parse_url($url);
    $scheme = (!empty($purl['scheme']))  ? $purl['scheme'].'://' : '';
    $host   = (!empty($purl['host']))    ? $purl['host']         : '';
    $port   = (!empty($purl['port']))    ? $purl['port']         : '';
    $path   = (!empty($purl['path']))    ? $purl['path']         : '/';
                   
    $url = $scheme.$host.$port.$path;

    if (defined('SID') && strlen(SID) > 0 
        && (2 == $useSID || 1 == $useSID && empty($host) ) )
    {
        if (!empty($purl['query']) && preg_match('/'.SID.'/',$purl['query']))
           $url = $url.'?'.$purl['query'];
        else 
           $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'].'&'.SID : $url.'?'.SID;
    }
    else
       $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'] : $url;

    return $url;
}

// --------------------------------------------------------------------------------

/**
 * Time in seconds including micro seconds.
 *
 * @return string time in seconds: example 5.234232432
 *
 * @see microtime()
 */
function get_mt_time()
{
    $arr = split(' ',microtime());
    return ($arr[0] + $arr[1]);
}

// --------------------------------------------------------------------------------

/**
 * Hides and supplements corresponding PHP-function mktime().
 * Can be used for global shift of time zone.
 *
 * @return int UNIX-time in seconds
 *
 * @see mktime()
 */
function m_time()
{
    return mktime();
}

// --------------------------------------------------------------------------------

/**
 * Used for automatic users authorization by check of the crypted information transmitted in url.
 *
 * @param string $authInfo crypted information (MD5)
 * @param string $str      unique user information
 *
 * @return bool true on success otherwise false

 * @see uni_id()
 */
function auto_login($authInfo, $str) 
{
    $salt = substr($authInfo, 0, SALT_LENGTH);
    $auth = substr($authInfo, SALT_LENGTH);

    if (md5($salt.$str) == $auth)
        return false;
     else
        return true;
}

// --------------------------------------------------------------------------------

/**
 * Send email to admin (with email ADMIN_EMAIL)
 *
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 *
 * @see includes/config/main.ini
 */
function admin_notify($source, $message)
{
    $headers = '';
    $headers .= 'From: '.SUPPORT_SITENAME.' Notification <'.SUPPORT_EMAIL.">\n";
    $headers .= 'Content-Type: text/html; charset='.DEF_CHARSET."\n"; 
    $headers .= 'Content-Transfer-Encoding: 8bit'."\n";
    @mail(ADMIN_EMAIL,'New notify: '.$source, $message, $headers,'-f'.SUPPORT_EMAIL);
}

// --------------------------------------------------------------------------------

/**
 * Send message to specified email
 *
 * @param string $email   user email
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 */
function send_email2user($email, $source, $message, $format = 'html')
{
    $headers = '';
    $headers .= 'From: '.SUPPORT_SITENAME.' <'.SUPPORT_EMAIL.">\n";
    if ('html' == $format)
        $headers .= 'Content-Type: text/html; charset='.DEF_CHARSET."\n"; 
    else
        $headers .= 'Content-Type: text/plain; charset='.DEF_CHARSET."\n"; 
    $headers .= 'Content-Transfer-Encoding: 8bit'."\n";

    @mail($email,$source, $message, $headers,'-f'.SUPPORT_EMAIL);
}

// --------------------------------------------------------------------------------

/**
 * Parse url. Hides and supplements corresponding PHP-function.
 *
 * @param string $email email for checking
 *
 * @return array with urls parts: scheme, host, port, path, query. 
 *              All these array elements is defined
 */
function p_url($url)
{
    $url = parse_url($url);
    $url['scheme'] = (!empty($url['scheme'])) ? $url['scheme'].'://' : '';
    $url['host']   = (!empty($url['host']))   ? $url['host']         : '';
    $url['port']   = (!empty($url['port']))   ? $url['port']         : '';
    $url['path']   = (!empty($url['path']))   ? $url['path']         : '/';
    $url['query']  = (!empty($url['query']))  ? '?'.$url['query']    : '';
    return $url;
}

// --------------------------------------------------------------------------------

/**
 * Verify Email
 *
 * @param string $email email for checking
 *
 * @return bool false if bad email or true if email is correct
 */
function verify_email($email)
{
    if (7 > strlen($email))
       return false;

    $zones = array(
            'ac','ad','ae','af','ag','ai','al','am','an','ao','aq','ar','as','at','au','aw','az',
            'ax','ba','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bv',
            'bw','by','bz','ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cs',
            'cu','cv','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','er','es',
            'et','eu','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl',
            'gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id',
            'ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki',
            'km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv',
            'ly','ma','mc','md','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu',
            'mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz',
            'om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re',
            'ro','ru','rw','sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so',
            'sr','st','sv','sy','sz','tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tp',
            'tr','tt','tv','tw','tz','ua','ug','uk','um','us','uy','uz','va','vc','ve','vg','vi',
            'vn','vu','wf','ws','ye','yt','yu','za','zm','zw',
            'aero','biz','cat','com','coop','info','jobs','mobi','museum','name','net',
            'org','pro','travel','gov','edu','mil','int'
            );
    $regEmail = '/^[\w-\.]+@([\w-]+\.)+([\w-]{2,4})$/';

    $matches = array();
    if (!preg_match($regEmail, $email, $matches))
        return false;

    if (!in_array($matches[2], $zones))
       return false;

    return true;
}#verify_email 

// --------------------------------------------------------------------------------

/**
 * Show message and send 404 Error to browser
 *
 * @param string $mess Shown which will be shown
 *
 * @return void
 */
function page404($mess = '')
{
    header('HTTP/1.0 404');
    require(BPATH.'404.php');
    n_exit();
}

// --------------------------------------------------------------------------------

/**
 * Get url through cURL
 *
 * @return mixed false on error or string otherwise
 */
function curlget ($url, $ua=false, $timeout=60, $method='get' ,$proxy=false)
{
    if($ua === false) $ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; Q312461)';

    if ($method=='post')
       {
        $purl = parse_url($url);
        $scheme=!empty($purl['scheme'])?$purl['scheme'].'://':'';
        $host = !empty($purl['host'])?$purl['host']:'';
        $port = !empty($purl['port'])?$purl['port']:'';
        $path = !empty($purl['path'])?$purl['path']:'/';
        $query= !empty($purl['query'])?$purl['query']:'';

        $headers = array('Connection: Keep-Alive');
        $url=$scheme.$host.$port.$path;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme.$host);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 

        if ($proxy!==false)
           curl_setopt($ch, CURLOPT_PROXY,$proxy);

        curl_setopt($ch, CURLOPT_POST, 1); // set POST method 
       }
     else
       {
        $refAr = parse_url($url);
        $scheme=!empty($refAr['scheme'])?$refAr['scheme'].'://':'';
        $headers = array('Connection: Keep-Alive');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme . $refAr['host']);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 
  
        if ($proxy!==false)
          curl_setopt($ch, CURLOPT_PROXY,$proxy);
       } 
    $result = curl_exec($ch);
    if (!$ch) return false;
    curl_close($ch);
    return $result;
}

function n_exit()
{
    @$GLOBALS['gDb'] -> disconnect();
    exit();
}
?>