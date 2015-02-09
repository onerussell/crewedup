<?php
/**
 * Model Comments class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Comments
{
    /**
     * Comments Table name
     *
     * @var string
     */
    private $mTbComments;    
    

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
        $this -> mTbComments     =  $tables['comments'];
        $this -> mTbUsers    =  $tables['users'];
    }
	
    /************************************
     *         Comments
     ************************************/
    
    public function Edit($ar, $id = 0)
    {
    	if (!$id)
    	{
    		$sql = 'INSERT INTO '.$this -> mTbComments.' (uid, author, ctype, story, pdate)
    		        VALUES(?, ?, ?, ?, '.mktime().') 
    		       ';
    		$this -> mDbPtr -> query($sql, $ar);
    		$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
    	}
    	else
     	{
     		
            $ar[] = $id;
     		$sql = 'UPDATE '.$this -> mTbComments.' SET
                    uid     = ?,
                    author  = ?,
                    ctype   = ?,
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
    	/** Delete base */
    	$sql = 'DELETE FROM '.$this -> mTbComments.' WHERE id = ?';
    	$this -> mDbPtr -> query($sql, $id);
    	return true;
    }/** Del */
        
    
    /**
     * Get Items count
     *
     * @param int $uid - user ID
     * @return int  - items count
     */
    public function GetCount($uid = 0, $ctype = 0)
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbComments.' WHERE id = id';
    	$ar = array();
        if (-1 != $ctype)
        {
            $sql .= ' AND ctype = ?';  
            $ar[] = $ctype;  
        }
        
        if ($uid)
    	{
    	    $sql .= ' AND uid = ?';
    	    $ar[] = $uid;
    	}      
    	$r = $this -> mDbPtr -> getOne($sql, $ar);
    	return $r; 
    }/** GetCount */
    
    
    /**
     * Get items list
     *
     * @param int $uid - user ID
     * @param int $first - first item for limit
     * @param int $cnt - items count for limit
     * @return array hash with data
     */
    public function &GetList($uid = 0, $ctype = 0, $first = 0, $cnt = 0)
    {
    	$sql = 'SELECT c.*, u.name, u.lname, u.person_title, u.status, u.company 
    	        FROM '.$this -> mTbComments.' c 
    	        LEFT JOIN '.$this -> mTbUsers.' u ON (u.uid = c.author)
    	        WHERE c.id = id';
        
    	$ar = array();
        if (-1 != $ctype)
        {
            $sql .= ' AND ctype = ?';  
            $ar[] = $ctype;  
        }
        
    	if ($uid)
    	{
    	    $sql .= ' AND c.uid = ?';
    	    $ar[] = $uid;
    	}
    	$sql .= ' ORDER BY c.pdate DESC';

    	
    	if ($cnt)
    	{
    	    $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, $ar);
    	}
    	else
    	{
    	    $db = $this -> mDbPtr -> query($sql, $ar);   
    	}
        $r =  array();
    	while ($row = $db -> FetchRow())
    	{
    	    $row['ptime'] = date("h:i a", $row['pdate']);
    	    $row['pdate'] = date("m/d/Y", $row['pdate']);
    	    if ($row['reply_text'])
            {
                $row['reply_date'] = date("m/d/Y | h:i a", $row['reply_date']);
            }    	    
    	    $r[] = $row;
    	}
    	return $r;    	
    }/** GetList */

    
    /**
     * Get one Item
     *
     * @param int $id
     * @return array with data
     */
    public function &Get($id)
    {
    	$sql = 'SELECT * FROM '.$this -> mTbComments.' WHERE id = ?';
    	$db  = $this -> mDbPtr -> query($sql, array($id));   
    	if ($row = $db -> FetchRow())
    	{
    	    $row['pdate'] = date("m/d/Y | h:i a", $row['pdate']);
    	    if ($row['reply_text'])
    	    {
    	        $row['reply_date'] = date("m/d/Y | h:i a", $row['reply_date']);
    	    }
    	    return $row;
    	}
    	else
    	{
    	    $r = array();
    	    return $r;   
    	}	
    }/** Get */

    
    public function AddReply($id, $reply)
    {
        $sql = 'UPDATE '.$this -> mTbComments.' SET
                reply_text = ?,
                reply_date = ?
                WHERE id = ? 
               ';
        $this -> mDbPtr -> query($sql, array($reply, mktime(), $id));
        return true;
    }/** AddReply */
    

    public function DelReply($id)
    {
        $sql = 'UPDATE '.$this -> mTbComments.' SET
                reply_text = ?,
                reply_date = ?
                WHERE id = ? 
               ';
        $this -> mDbPtr -> query($sql, array("", 0, $id));
        return true;        
    }/** DelReply */
    
}/** Model_Main_Comments */	
?>