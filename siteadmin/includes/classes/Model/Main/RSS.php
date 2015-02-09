<?php
/**
 * RSS
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

class Rss
{
    private $title = 'CrewedUp rss';
    private $link;
    private $copyright = 'CrewedUp.com';
    private $language = 'eng';
    private $editor;
    private $webmaster;
    private $descr;
    private $mRep   = array('&' => '&amp;', '"' => '&quot;', '>' => '&gt;', '<' => '&lt;', "'" => '&apos;');
    
    // Contructor
    public function __construct($title = '')
    {
	    if ($title)
		{
            $this -> title = $title;
        }
		$this -> link  = 'http://' . DOMEN;   
    }

    public function ShowHeader()
    {
        echo '<?xml version="1.0" encoding="utf-8"?><rss version="2.0"><channel>'."\n";
        if ($this -> title)
            echo "<title>". $this -> title ."</title>\n";
        if ($this -> link)
            echo "<link>". $this -> link ."</link>\n";
        if ($this -> descr)
            echo "<description>". $this -> descr ."</description>\n";
        if ($this -> language)
        	echo "<language>". $this -> language ."</language>\n";
        if ($this -> copyright)
        	echo "<copyright>". $this -> copyright ."</copyright>\n";
        if ($this -> webmaster)
        	echo "<webMaster>". $this -> webmaster ."</webMaster>\n";    	
    }/** ShowHeader */
        
    
    public function ShowFooter()
    {
    	echo "</channel></rss>";
    }/** ShowFooter */
    
    
    
    /**
     * Create rss xml code
     * 
     */
    public function ShowItem( $title, $dt    = 0, $link  = '', $descr = '' )
    {
       	echo "<item>\n";
        echo "<title>".strtr($title, $this -> mRep)."</title>\n";
        echo "<pubDate>".( date("r", empty($dt) ? mktime() : $dt) )."</pubDate>\n";
        if($link)
        {
            echo "<link>".$link."</link>\n";
        }
        else
        {
        	echo "<link />\n";
        }
        echo "<description><![CDATA[".$descr."]]></description>\n";
       	echo "</item>\n";
    }#BuildXml
}
?>