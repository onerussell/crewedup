<?php
/**
 * Film2Tv class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Film2Tv
{
    /**
     * Film2Tv category Table name
     *
     * @var string
     */
    public $mTbF2TvCat;    	
	
   
    /**
     * Film2Tv items Table name
     *
     * @var string
     */
    public $mTbF2TvItem;  


    /**
     * Film2Tv item episodes Table name
     *
     * @var string
     */
    public $mTbF2TvEpisodes;

    
    /**
     * User Table name
     *
     * @var string
     */
    private $mTbUsers;     
    
    /**
     * DB pointer  
     *
     * @var pointer
     */
    private $mDb;  
 
    
    public function __construct(&$gDb,
                                $tables  = array()
                                )
    {
        $this -> mDb          =& $gDb; 
        $this -> mTbF2TvCat   =  TB . 'film2tv_cat';
        $this -> mTbF2TvItem  =  TB . 'film2tv_item';
        $this -> mTbF2TvEpisodes = TB . 'film2tv_item_episodes';
    }

    
	public function GetCatList()
	{
		 $sql = 'SELECT * FROM '.$this -> mTbF2TvCat.' ORDER BY sortid';
		 $r   = array();
		 $db  = $this -> mDb -> query( $sql );
		 while ($row = $db -> FetchRow())
		 {
		     $r[] = $row;
		 }
		 return $r;
	}/** GetCatList */
	
	
	public function GetCat( $id )
	{
	    $sql = 'SELECT * FROM '.$this -> mTbF2TvCat.' WHERE id = ?';
	    $db  = $this -> mDb -> query($sql, $id);
	    if ($row = $db -> FetchRow())
	    {
	        return $row;
	    }
	    $r = array();
        return $r;
	}/** GetCat */
	
	public function GetItemsCount( $ctg = 0 )
	{
	    $sql = 'SELECT COUNT(id) FROM '.$this -> mTbF2TvItem.' WHERE id = id';
	    if ($ctg)
	    {
	        $sql .= ' AND cid  = '.(int)$ctg;
	    }
	    $r  = $this -> mDb -> getOne($sql);
	    return $r;
	}/** GetItemsCount */
	
	
	public function GetItemsList( $ctg = 0, $first = 0, $cnt = 0)
	{
	    $sql = 'SELECT * FROM '.$this -> mTbF2TvItem.' WHERE id = id';
        if ($ctg)
        {
            $sql .= ' AND cid  = '.(int)$ctg;
        }	    
        $r = array();
        if ($cnt)
        {
            $db = $this -> mDb -> limitQuery( $sql, $first, $cnt );
        }
        else
        {
            $db = $this -> mDb -> query( $sql );
        }
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
	}/** GetItemsList */

	
	public function GetItem( $id )
	{
	    $sql = 'SELECT * FROM '.$this -> mTbF2TvItem.' WHERE id = ?';
	    $db  = $this -> mDb -> query( $sql, array($id) );
	    if ($row = $db -> FetchRow())
	    {
	        return $row;
	    }
	    $r = array();
	    return $r;
	}/** GetItem */
	
	
	public function GetEpisodes( $item_id )
	{
         $sql = 'SELECT * FROM '.$this -> mTbF2TvEpisodes.' WHERE iid = ? ORDER BY id';
         $r   = array();
         $db  = $this -> mDb -> query( $sql, $item_id );
         while ($row = $db -> FetchRow())
         {
             $r[] = $row;
         }
         return $r;	    
	}/** GetEpisodes */
	
}/** Model_Main_Film2Tv */
?>