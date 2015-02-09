<?php
/**
 * Pagging class - Make pages list
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

class Pagging
{
    private $mResOnPage; //Results on page
    private $mEcount;    //Count of elements
    private $mPageLink;  //Link for pages
    private $mPage;      //Current page
    private $mPageMax;   //Max pagging items on page

    public function __construct($ResOnPage  = 10, $Ecount = 0, $page = 1, $link = '')
    {
        $this -> mResOnPage     =  $ResOnPage;
        $this -> mEcount        =  $Ecount;
        $this -> mPageLink      =  $link;
        $this -> mPageMax       =  8; 
        
        if (!is_numeric($page) || $page == 0)
        {
            $page = 1;
        }    
        $this -> mPage          = $page;
    }#Pagging


    public function &Make()
    {
        $pages = '';
        if ($this -> mEcount < $this -> mResOnPage || $this -> mResOnPage == 0)
        {
            return $pages;
        }
        global $gSmarty;

        $range    = $this -> GetRange();
        $range[]  = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page' , $this -> mPage);

        $link = $this -> mPageLink;
        $link .=  ( strpos($link, '?') > 0 ) ? '&' : '?';
        #make list
        $k   = 0;
        $i   = 1;
        $res = array();

        $fl = 1;
        $lr = 8;  
        if (($this -> mEcount / $this -> mResOnPage) > $this -> mPageMax && $this -> mPage >= $this -> mPageMax - 1)
        {
        	if (floor(($this -> mPage + 1) / $this -> mPageMax) == (($this -> mPage + 1) / $this -> mPageMax))
        	{
        		$fl = $this -> mPage - ($this -> mPageMax / 2);
        		$lr = $this -> mPage + $this -> mPageMax - ($this -> mPageMax / 2); 
        	}
        	else 
        	{
                $fl = floor($this -> mPage / $this -> mPageMax) * $this -> mPageMax  - 1;
                if ($this -> mPage < $fl + ($this -> mPageMax / 2) - 1)
                {
                	$fl = $fl - ($this -> mPageMax / 2);
                }
                $lr = $fl + $this -> mPageMax;   		
        	}
        }
        
        /** prev && next 
        if ($this -> mPage > $this -> mPageMax)
        {
        	$gSmarty -> assign('lfirst', $link.'page=1');
        }
        if ($this -> mPage < ceil($this -> mEcount / $this -> mResOnPage))
        {
        	$gSmarty -> assign('llast', $link.'page='.ceil($this -> mEcount / $this -> mResOnPage));
        }
         */ 
        
        if (1 < $this -> mPage)
        {
        	$gSmarty -> assign('lprev', $link.'page='.($this -> mPage - 1));
        }
        if ($this -> mPage < (ceil($this -> mEcount / $this -> mResOnPage)))
        {
        	$gSmarty -> assign('lnext', $link.'page='.($this -> mPage + 1));
        }
            
        while ($k < $this -> mEcount)
        {
            if ($i > $lr)
            {
            	break;
            }
            if ($i >= $fl && $i <= $lr)
            {
        	    $res[] =  array('page' => $i, 'link' => $link.'page='.$i);
            }    
            $k     += $this -> mResOnPage;
            $i ++;
        }
        $gSmarty -> assign('pages', $res);
        $pages = $gSmarty -> fetch('mods/_pagging.html');
        return $pages;

    }#Make

    
    public function &Make2()
    {
        $pages = '';
        if ($this -> mEcount < $this -> mResOnPage || $this -> mResOnPage == 0)
        {
            return $pages;
        }
        global $gSmarty;

        $range    = $this -> GetRange();
        $range[]  = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page' , $this -> mPage);

        $link = $this -> mPageLink;
        $link .=  ( strpos($link, '?') > 0 ) ? '&' : '?';
        
        #make list
        $k   = 0;
        $i   = 1;
        $res = array();

        $fl = 1;
        $lr = 8;  
        if (($this -> mEcount / $this -> mResOnPage) > $this -> mPageMax && $this -> mPage >= $this -> mPageMax - 1)
        {
        	if (floor(($this -> mPage + 1) / $this -> mPageMax) == (($this -> mPage + 1) / $this -> mPageMax))
        	{
        		$fl = $this -> mPage - ($this -> mPageMax / 2);
        		$lr = $this -> mPage + $this -> mPageMax - ($this -> mPageMax / 2); 
        	}
        	else 
        	{
                $fl = floor($this -> mPage / $this -> mPageMax) * $this -> mPageMax  - 1;
                if ($this -> mPage < $fl + ($this -> mPageMax / 2) - 1)
                {
                	$fl = $fl - ($this -> mPageMax / 2);
                }
                $lr = $fl + $this -> mPageMax;   		
        	}
        }
        
        if (1 < $this -> mPage)
        {
        	$gSmarty -> assign('lprev', ($this -> mPage - 1));
        }
        if ($this -> mPage < (ceil($this -> mEcount / $this -> mResOnPage)))
        {
        	$gSmarty -> assign('lnext', ($this -> mPage + 1));
        }
            
        while ($k < $this -> mEcount)
        {
            if ($i > $lr)
            {
            	break;
            }
            if ($i >= $fl && $i <= $lr)
            {
        	    $res[] =  array('page' => $i, 'link' => $i);
            }    
            $k     += $this -> mResOnPage;
            $i ++;
        }
        $gSmarty -> assign('pages', $res);
        $pages = $gSmarty -> fetch('mods/_pagging.html');
        return $pages;

    }#Make2
    
    
    public function &GetRange()
    {
        $res[0] = ($this -> mPage - 1) * $this -> mResOnPage;
        $res[1] =  $this -> mPage * $this -> mResOnPage;
        if ($res[1] > $this -> mEcount)
            $res[1] = $this -> mEcount;
        return $res;

    }#GetRange
       
}#end class