<?php
/**
 * Model Resume class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Resume
{
    /**
     * Resume Table name
     *
     * @var string
     */
    public $mTbResume;    	
	
    
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
        $this -> mTbResume   =  $tables['resume'];
        $this -> mTbUsers    =  $tables['users'];
    }

    
    public function Edit($ar, $id = 0, $image = '', $image2 = '')
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbResume.' (uid, title, prof, sdate, story, company, pdate)
                    VALUES(?, ?, ?, ?, ?, ?, '.mktime().') 
                   ';
            $this -> mDbPtr -> query($sql, $ar);
            $id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            
            $ar[] = $id;
            $sql = 'UPDATE '.$this -> mTbResume.' SET
                    uid     = ?,
                    title   = ?,
                    prof    = ?,
                    sdate   = ?,
                    story   = ?,
                    company = ?,
                    pdate_upd = '.mktime().'
                    WHERE id = ?
                   ';
            $this -> mDbPtr -> query($sql, $ar);                
        }
        
        if ($image)
        {
        	$sql = 'UPDATE '.$this -> mTbResume.' SET image = ? WHERE id = ?';
        	$this -> mDbPtr -> query($sql, array($image, $id));
        }

        if ($image2)
        {
            $sql = 'UPDATE '.$this -> mTbResume.' SET image2 = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array($image2, $id));
        }
        return $id;
    }/** Edit */
    
    
    public function Del($id)
    {
        $this -> DelImage( $id );
        /** Delete base */
        $sql = 'DELETE FROM '.$this -> mTbResume.' WHERE id = ?';
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
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbResume.' WHERE id = id';
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
        $sql = 'SELECT *, 
                DATE_FORMAT(sdate, "%m") AS month,
                DATE_FORMAT(sdate, "%Y") AS year 
                FROM '.$this -> mTbResume.' WHERE id = id';
        if ($uid)
        {
            $sql .= ' AND uid = '.(int)$uid;
        }
        $sql .= ' ORDER BY sdate DESC';
        
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
            $row['month'] = (!empty($row['month']) && 2 == strlen($row['month']) && '0' == $row['month'][0]) ? $row['month'][1] : $row['month']; 
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
        $sql = 'SELECT *, 
                DATE_FORMAT(sdate, "%m") AS month,
                DATE_FORMAT(sdate, "%Y") AS year
               FROM '.$this -> mTbResume.' WHERE id = ?';
        $db  = $this -> mDbPtr -> query($sql, array($id));   
        if ($row = $db -> FetchRow())
        {
            $row['month'] = (!empty($row['month']) && 2 == strlen($row['month']) && '0' == $row['month'][0]) ? $row['month'][1] : $row['month']; 
            $row['pdate'] = date("m/d/Y | H:i", $row['pdate']);
            return $row;
        }
        else
        {
            $r = array();
            return $r;   
        }   
    }/** Get */    
    
    public function GetLastResume( $uid )
    {
        $sql = 'SELECT id, title FROM '.$this -> mTbResume.' WHERE uid = ? ORDER BY sdate DESC LIMIT 1';
        $db  = $this -> mDbPtr -> query($sql, $uid);
        if ($row = $db -> FetchRow())
        {
            return $row;
        }
        $r = array();
        return $r;
    }/** GetLastResume */
    
    public function DelImage( $id, $num = '' )
    {
        $sql = 'SELECT image'.$num.' FROM '.$this -> mTbResume.' WHERE id = ?';
        $r   = $this -> mDbPtr -> getOne($sql, array($id));
        if ($r)
        {
            if ( file_exists( PATH_ROOT . DIR_NAME_IMAGE .'/'.$r ) )
            {
                 unlink( PATH_ROOT . DIR_NAME_IMAGE .'/'.$r );
            }
            
            if ( file_exists( PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $r ) )
            {
                 unlink( PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $r );
            } 
            $sql = 'UPDATE '.$this -> mTbResume.' SET image'.$num.' = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array('', $id));
            return true;           
        }
        return false;
    }/** DelImage */
    
    
}/** Model_Main_Resume*/
?>