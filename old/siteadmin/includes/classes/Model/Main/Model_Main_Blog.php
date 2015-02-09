<?php
/**
 * Model Blog class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Blog
{
    /**
     * Blog Table name
     *
     * @var string
     */
    private $mTbBlog;    
    

    /**
     * Blog Comments Table name
     *
     * @var string
     */
    private $mTbBlogCom;   


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
    private $mDbPtr;  
 
    
    public function __construct(&$gDb,
                                $tables  = array()
                                )
    {
        $this -> mDbPtr      =& $gDb; 
        $this -> mTbBlog     =  $tables['blog'];
        $this -> mTbBlogCom  =  $tables['blogcom'];
        $this -> mTbUsers    =  $tables['users'];
    }
	
    /************************************
     *         Blog
     ************************************/
    
    public function Edit($ar, $id = 0)
    {
    	if (!$id)
    	{
    		$sql = 'INSERT INTO '.$this -> mTbBlog.' (uid, title, story, pdate)
    		        VALUES(?, ?, ?, '.mktime().') 
    		       ';
    		$this -> mDbPtr -> query($sql, $ar);
    		$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
    	}
    	else
     	{
     		
            $ar[] = $id;
     		$sql = 'UPDATE '.$this -> mTbBlog.' SET
                    uid     = ?,
                    title   = ?,
                    story   = ?,
                    pdate_upd = '.mktime().'
                    WHERE id = ?
                   ';
            $this -> mDbPtr -> query($sql, $ar);        		
    	}
    	return $id;
    }/** Edit */
    
    
    public function Del($id)
    {
    	/** Delete items */
    	$sql = 'DELETE FROM '.$this -> mTbBlogCom.' WHERE bid = ?';
    	$this -> mDbPtr -> query($sql, $id);
    	
    	/** Delete base */
    	$sql = 'DELETE FROM '.$this -> mTbBlog.' WHERE id = ?';
    	$this -> mDbPtr -> query($sql, $id);
    	return true;
    }/** Del */
    
    
    /**
     * Update Comments Count
     * @param int $id - blog ID
     * @param int $ucnt = 1 - up, -1 - down
     * 
     * @return bool true
     */
    public function UpdComCnt($id, $ucnt = 1)
    {
    	$this -> mDbPtr -> query('UPDATE '.$this -> mTbBlog.' 
    	                          SET com_cnt = com_cnt '.(1 == $ucnt ? '+' : '-').' 1 
    	                          WHERE id = ?', $id);
    	return true; 
    }/** UpdComCnt */
    
    
    /**
     * Get Items count
     *
     * @param int $uid - user ID
     * @return int  - items count
     */
    public function GetCount($uid = 0)
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbBlog.' WHERE id = id';
    	if ($uid)
    	{
    	    $sql .= ' AND uid = '.(int)$uid;
    	}      
    	$r = $this -> mDbPtr -> getOne($sql);
    	return $r; 
    }/** GetCount */
    
    
    /**
     * Get items list
     *
     * @param int $uid - user ID
     * @param int $first - first item for limit
     * @param int $cnt - items count for limit
     * @param string $sort - sort order field
     * @return array hash with data
     */
    public function &GetList($uid = 0, $first = 0, $cnt = 0, $sort = '')
    {
    	$sql = 'SELECT * FROM '.$this -> mTbBlog.' WHERE id = id';
    	if ($uid)
    	{
    	    $sql .= ' AND uid = '.(int)$uid;
    	}
    	$sql .= ' ORDER BY '.($sort ? $sort : 'pdate DESC');
    	
    	if ($cnt)
    	{
    	    $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
    	}
    	else
    	{
    	    $db = $this -> mDbPtr -> query($sql);   
    	}

        $r =  array();
    	while ($row = $db -> FetchRow())
    	{
    	    $row['mt']    = $row['pdate'];
    	    $row['ptime'] = date("h:i a", $row['pdate']);
    	    $row['pdate'] = date("m/d/Y", $row['pdate']);
    	    
    	    $r[] = $row;
    	}
    	return $r;    	
    }/** GetList */

    
    public function &GetRecentList($first = 0, $cnt = 0, $sort = '')
    {
        $sql = 'SELECT b.*, u.image, u.subdir, u.name, u.lname, u.company, u.status 
                FROM '.$this -> mTbBlog.' b, '.$this -> mTbUsers.' u WHERE u.uid = b.uid';
        $sql .= ' ORDER BY '.($sort ? $sort : 'pdate DESC');
        
        if ($cnt)
        {
            $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        }
        else
        {
            $db = $this -> mDbPtr -> query($sql);   
        }

        $r =  array();
        while ($row = $db -> FetchRow())
        {
            $row['ptime'] = date("h:i a", $row['pdate']);
            $row['pdate'] = date("m/d/Y", $row['pdate']);
            
            $r[] = $row;
        }
        return $r;      
    }/** GetRecentList */

    
    
    /**
     * Get one Item
     *
     * @param int $id
     * @return array with data
     */
    public function &Get($id)
    {
    	$sql = 'SELECT * FROM '.$this -> mTbBlog.' WHERE id = ?';
    	$db  = $this -> mDbPtr -> query($sql, array($id));   
    	if ($row = $db -> FetchRow())
    	{
    	    $row['pdate'] = date("m/d/Y | h:i a", $row['pdate']);
    	    return $row;
    	}
    	else
    	{
    	    $r = array();
    	    return $r;   
    	}	
    }/** Get */
    
     /************************************
     *         Blog Comments
     ************************************/
    
    public function EditCom($ar, $id = 0)
    {
    	if (!$id)
    	{
    		$sql = 'INSERT INTO '.$this -> mTbBlogCom.' (bid, uid, title, story, pdate)
    		        VALUES(?, ?, ?, ?, '.mktime().') 
    		       ';
    		$this -> mDbPtr -> query($sql, $ar);
    		$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
    		$this -> UpdComCnt( $ar[0] ); 
    	}
    	else
     	{
     		
            $ar[] = $id;
     		$sql = 'UPDATE '.$this -> mTbBlogCom.' SET
                    bid     = ?,
     		        uid     = ?,
                    title   = ?,
                    story   = ?,
                    pdate_upd = '.mktime().'
                    WHERE id = ?
                   ';
            $this -> mDbPtr -> query($sql, $ar);        		
    	}
    	return $id;
    }/** Edit */
    
    
    public function DelCom($id)
    {
    	
    	/** Update parent table */
    	$bid = $this -> mDbPtr -> getOne('SELECT bid FROM '.$this -> mTbBlogCom.' WHERE id = ?', $id);
    	if ($bid)
    	{
    	    $this -> UpdComCnt($bid, -1);    	
    	
            /** Delete */
    	    $sql = 'DELETE FROM '.$this -> mTbBlogCom.' WHERE id = ?';
    	    $this -> mDbPtr -> query($sql, $id);
    	}
    	
    	return true;
    }/** DelCom */   
    
    
    /**
     * Get SubItems count
     *
     * @param int $uid - user ID
     * @return int  - subitems count
     */
    public function GetComCount($uid = 0)
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbBlogCom.' WHERE id = id';
    	if ($uid)
    	{
    	    $sql .= ' AND uid = '.(int)$uid;
    	}      
    	$r = $this -> mDbPtr -> getOne($sql);
    	return $r; 
    }/** GetComCount */    
    
    
    /**
     * Get subitems list
     *
     * @param int $uid - user ID
     * @param int $bid - 
     * @param int $first - first item for limit
     * @param int $cnt - items count for limit
     * @param string $sort - sort order field
     * @return array hash with data
     */
    public function &GetComList($uid = 0, $bid = 0,  $first = 0, $cnt = 0, $sort = '')
    {
    	$sql = 'SELECT c.*, u.name, u.lname, u.person_title 
    	        FROM '.$this -> mTbBlogCom.' c 
    	        LEFT JOIN '.$this -> mTbUsers.' u ON c.uid = u.uid   
    	        WHERE c.id = c.id';
    	if ($uid)
    	{
    	    $sql .= ' AND c.uid = '.(int)$uid;
    	}
    	
        if ($bid)
    	{
    	    $sql .= ' AND c.bid = '.(int)$bid;
    	}
    	$sql .= ' ORDER BY '.($sort ? $sort : 'pdate DESC');
    	
    	if ($cnt)
    	{
    	    $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
    	}
    	else
    	{
    	    $db = $this -> mDbPtr -> query($sql);   
    	}
    	
        $r =  array();
    	while ($row = $db -> FetchRow())
    	{
    	    $row['pdate'] = date("m/d/Y  h:i a", $row['pdate']);
    	    $r[] = $row;
    	}
    	return $r;    	
    }/** GetComList */

    
    /**
     * Get one SubItem
     *
     * @param int $id
     * @return array with data
     */
    public function &GetCom($id)
    {
    	$sql = 'SELECT * FROM '.$this -> mTbBlogCom.' WHERE id = ?';
    	$db  = $this -> mDbPtr -> query($sql, array($id));   

    	if ($row = $db -> FetchRow())
    	{
    	    $row['pdate'] = date("m/d/Y  h:i a", $row['pdate']);
    	    return $row;
    	}
    	else
    	{
    	    $r = array();
    	    return $r;   
    	}	
    }/** GetCom */
    
    
}/** Model_Blog */	
?>