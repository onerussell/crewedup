<?php 
  /**
   * HTTP Auth for RSS
   */
        
    if(!isset($_SERVER['PHP_AUTH_USER'])) 
    { 
        Header("WWW-Authenticate: Basic realm=\"RSS Feed Auth\""); 
        Header("HTTP/1.0 401 Unauthorized"); 
	    require '_bottom.php';
        exit(); 
    } 
    else 
    { 
        if (!get_magic_quotes_gpc())
        {
            $_SERVER['PHP_AUTH_USER'] = mysql_escape_string($_SERVER['PHP_AUTH_USER']);
            $_SERVER['PHP_AUTH_PW'] = mysql_escape_string($_SERVER['PHP_AUTH_PW']);
        }
        $_SERVER['PHP_AUTH_USER'] = str_replace("'","`",$_SERVER['PHP_AUTH_USER']);
        $_SERVER['PHP_AUTH_PW'] = str_replace("'","`",$_SERVER['PHP_AUTH_PW']);
        
        $uid = $gUser -> CheckAuthData($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
        if(!$uid)
        {
            Header("WWW-Authenticate: Basic realm=\"RSS Feed Auth\""); 
            Header("HTTP/1.0 401 Unauthorized"); 
	        require '_bottom.php';
            exit(); 
        }
    }
?>