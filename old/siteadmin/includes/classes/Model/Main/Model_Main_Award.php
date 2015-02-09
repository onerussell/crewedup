<?php
/**
 * Model Award class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine37.com
 * @link       http://engine37.com
 */

class Model_Main_Award
{
    /**
     * Award Table name
     *
     * @var string
     */
    public $mTbAward;    	

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
        $this -> mTbAward   =  $tables['award'];
    }

    
    public function Edit($ar, $id = 0, $image = '')
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbAward.' (uid, title, link, pdate)
                    VALUES(?, ?, ?, '.mktime().') 
                   ';
            $this -> mDbPtr -> query($sql, $ar);
            $id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            
            $ar[] = $id;
            $sql = 'UPDATE '.$this -> mTbAward.' SET
                    uid     = ?,
                    title   = ?,
                    link    = ?,
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
        $sql = 'DELETE FROM '.$this -> mTbAward.' WHERE id = ?';
        $this -> mDbPtr -> query($sql, $id);
        return true;
    }/** Del */

    
    /**
     * Get Items count
     *
     * @param int $uid - user ID
     * @return int  - items count
     */
    public function GetCount($uid = 0)
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbAward.' WHERE id = id';
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
     * @return array hash with data
     */
    public function &GetList($uid = 0, $first = 0, $cnt = 0)
    {
        $sql = 'SELECT * FROM '.$this -> mTbAward.' WHERE id = id';
        if ($uid)
        {
            $sql .= ' AND uid = '.(int)$uid;
        }
        $sql .= ' ORDER BY pdate DESC';
        
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
            $row['ptime'] = date("H:i", $row['pdate']);
            $row['pdate'] = date("m/d/Y", $row['pdate']);
            
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
        $sql = 'SELECT * FROM '.$this -> mTbAward.' WHERE id = ?';
        $db  = $this -> mDbPtr -> query($sql, array($id));   
        if ($row = $db -> FetchRow())
        {
            $row['pdate'] = date("m/d/Y | H:i", $row['pdate']);
            return $row;
        }
        else
        {
            $r = array();
            return $r;   
        }   
    }/** Get */    
    
}/** Model_Main_Award*/
?>