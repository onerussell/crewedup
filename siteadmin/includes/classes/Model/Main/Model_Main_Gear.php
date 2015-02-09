<?php
/**
 * Model Gear class 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

class Model_Main_Gear
{
    /**
     * Gear Table name
     *
     * @var string
     */
    private $mTbGear;       


    /**
     * User Table name
     *
     * @var string
     */
    private $mTbUsers; 

    /**
     * Categories table name
     * 
     * @var string
     */
    private $mTbCat;
    
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
        $this -> mTbGear     =  $tables['gear'];
        $this -> mTbCat      =  $tables['gearcat'];
        $this -> mTbUsers    =  $tables['users'];
    }
    
    /****************************************
           Gear Catalog 
     ****************************************/
    public function EditCat( $ar, $id )
    {
    	if ($id)
    	{
    	    $sql  = 'UPDATE '.$this -> mTbCat.' SET title = ?, sortid = ?
    	             WHERE id = ?';
    	    $ar[] =  $id;
    	    $this -> mDbPtr -> query($sql, $ar);
    	}
    	else
    	{
            $sql  = 'INSERT INTO '.$this -> mTbCat.' (title, sortid)
                     VALUES(?, ?)';
            $ar[] =  $id;
            $this -> mDbPtr -> query($sql, $ar);    		
    	}
    }/** EditCat */
    
    
    public function &GetCatList()
    {
    	$sql = 'SELECT * FROM '.$this -> mTbCat.' ORDER BY sortid, title';
    	$db  = $this -> mDbPtr -> query($sql);
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$r[] = $row;
    	}
    	return $r;
    }/** GetCatList */
    
    
    public function &GetCatListAssoc()
    {
        $sql = 'SELECT id, title FROM '.$this -> mTbCat.' ORDER BY sortid, title';
        $db  = $this -> mDbPtr -> query($sql);
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[$row['id']] = $row['title'];
        }
        return $r;
    }/** GetCatList */

    
    public function UpdCnt( $id, $val)
    {
    	$sql = 'UPDATE '.$this -> mTbCat.' SET cnt = cnt + '.(int)$val.' WHERE id = ?';
    	$this -> mDbPtr -> query($sql, array($id));
    	
    	$sql = 'UPDATE '.$this -> mTbCat.' SET cnt = 0 WHERE cnt < 0 AND id = ?';
    	$this -> mDbPtr -> query($sql, array($id));
    	return true;
    }/** UpdCnt*/
    
    
    public function &GetCat( $id )
    {
    	$sql = 'SELECT * FROM '.$this -> mTbCat.' WHERE id = ?';
    	$db  = $this -> mDbPtr -> query( $sql, array($id) );
    	if ($row = $db -> FetchRow())
    	{
    		return $row;
    	}
    	else
    	{
    		$r = array();
    		return $r;
    	}
    }/** GetCat */
    
    /****************************************
          Gear Items
     ****************************************/
    
    public function Edit($ar, $id = 0, $image = '')
    {
        if (!$id)
        {
            $sql = 'SELECT MAX(sortid) FROM '.$this -> mTbGear;
            $si  = $this -> mDbPtr -> getOne($sql);
            $si  = (!$si) ? 1 : ($si+1);
        	$sql = 'INSERT INTO '.$this -> mTbGear.' (uid, title, story, cid, sortid, pdate)
                    VALUES(?, ?, ?, ?, '.$si.', '.mktime().') 
                   ';
            $this -> mDbPtr -> query($sql, $ar);
            $id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            
            $ar[] = $id;
            $sql = 'UPDATE '.$this -> mTbGear.' SET
                    uid     = ?,
                    title   = ?,
                    story   = ?,
                    cid     = ?,
                    pdate_upd = '.mktime().'
                    WHERE id = ?
                   ';
            $this -> mDbPtr -> query($sql, $ar);                
        }
        
        if ($image)
        {
            $sql = 'UPDATE '.$this -> mTbGear.' SET image = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array($image, $id));
        }   
        return $id;
    }/** Edit */
    
    
    /**
     *Update items Sort
     *
     * @param int $id - item ID
     * @param int $act - action: 1 - up, -1  - down
     * 
     * @return bool true||false
     */
    public function ItemsSortUpd($uid, $id, $act = 1)
    {
        $sql = 'SELECT sortid FROM '.$this -> mTbGear.' WHERE id = ? AND uid = ?';
        $si  = $this -> mDbPtr -> getOne($sql, array($id, $uid));
        if ($si && (1 == $act || (-1 == $act && $si > 1)))
        {
            $sql = 'UPDATE '.$this -> mTbGear.' SET sortid = sortid '.(1 == $act ? ' + 1' : ' - 1').' WHERE id = ? AND uid = ?';
            $this -> mDbPtr -> query($sql, array($id, $uid));

            $sql = 'UPDATE '.$this -> mTbGear.' SET sortid = ? 
                    WHERE sortid = ? AND id <> ? AND uid = ?';
            $this -> mDbPtr -> query($sql, array($si, (1 == $act ? $si+1 : $si-1), $id, $uid));
            return true;
        }
        return false;
    }/** ItemsSortUpd */

    
    public function FullUpdSort($uid)
    {
        $sql = 'SELECT id FROM '.$this -> mTbGear.' WHERE uid = ? ORDER BY sortid';
        $db  = $this -> mDbPtr -> query($sql, $uid);
        $k   = 1;
        while ($row = $db -> FetchRow())
        {
            $sql = 'UPDATE '.$this -> mTbGear.' SET sortid = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array($k, $row['id']));
            $k++;       
        }
        return true;
    }/** Full sort update */
        
    
    public function Del($id, $uid)
    {
        $this -> DelImage( $id );
        $this -> mDbPtr -> query('DELETE FROM '.$this -> mTbGear.' WHERE id = '.$id.' AND uid = '.$uid);
        $this -> FullUpdSort( $uid );
        $this -> mDbPtr -> query('DELETE FROM '.TB.'wire WHERE ptype = 4 AND ext_id = '.$id.' AND uid = '.$uid);

        return true;
    }/** Del */

    
    /**
     * Get Items count
     *
     * @param int $uid - user ID
     * @return int  - items count
     */
    public function GetCount($uid = 0, $ctg = 0, $state = '', $city = '', $model = '', $sstr = '')
    {
        $sql = 'SELECT COUNT(g.id) FROM '.$this -> mTbGear.' g,  '.$this -> mTbUsers.' u
                WHERE g.uid = u.uid';
        $ar  = array(); 
        if ($uid)
        {
            $sql .= ' AND g.uid = ?';
            $ar[] = $uid;
        }
        if ($ctg)
        {
            $sql .= ' AND g.cid = ?';
            $ar[] = $ctg;
        }  
        if ($state)
        {
            $sql .= ' AND u.state = ?';
            $ar[] = $state;
        }
        if ($city)
        {
            $sql .= ' AND LOWER(u.city) = ?';
            $ar[] = strtolower( $city );
        } 

        if ($model)
            $sql .= ' AND LOWER(g.title) LIKE "%" "'.mysql_escape_string(strtolower(trim($model))).'" "%"';

        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(g.title) LIKE "%'.mysql_escape_string($sa[$i]).'%"';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
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
    public function &GetList($uid = 0, $ctg = 0,  $first = 0, $cnt = 0, $state = '', $city = '', $model = '', $sort = '', $sstr = '')
    {
        $sql = 'SELECT g.*, u.status, u.name, u.lname, u.company, u.address, u.city, u.state
                FROM '.$this -> mTbGear.' g, '.$this -> mTbUsers.' u
                WHERE u.uid = g.uid';

        $ar  = array(); 
        if ($uid)
        {
            $sql .= ' AND g.uid = ?';
            $ar[] = $uid;
        }
        if ($ctg)
        {
            $sql .= ' AND g.cid = ?';
            $ar[] = $ctg;
        }  
        if ($state)
        {
            $sql .= ' AND u.state = ?';
            $ar[] = $state;
        }
        if ($city)
        {
            $sql .= ' AND LOWER(u.city) = ?';
            $ar[] = strtolower( $city );
        } 

        if ($model)
            $sql .= ' AND LOWER(g.title) LIKE "%" "'.mysql_escape_string(strtolower(trim($model))).'" "%"';
        
        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(g.title) LIKE "%'.mysql_escape_string($sa[$i]).'%"';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }
        
        $sql .= ' ORDER BY '.($sort ? $sort : 'g.sortid');
        
        if ($cnt)
            $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, $ar);
        else
            $db = $this -> mDbPtr -> query($sql, $ar);   

        //deb($db);
        $r =  array();
        while ($row = $db -> FetchRow())
        {
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
        $sql = 'SELECT *
               FROM '.$this -> mTbGear.' WHERE id = ?';
        $db  = $this -> mDbPtr -> query($sql, array($id));   
        if ($row = $db -> FetchRow())
        {
            return $row;
        }
        else
        {
            $r = array();
            return $r;   
        }   
    }/** Get */    
    
    
    public function DelImage( $id )
    {
        $sql = 'SELECT image FROM '.$this -> mTbGear.' WHERE id = ?';
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
            $sql = 'UPDATE '.$this -> mTbGear.' SET image = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array('', $id));
            return true;           
        }
        return false;
    }/** DelImage */
    
    
    /**
     * Get gear states
     * 
     * @return array with distinct states
     */
    public function GetGearStates( $cid = 0 )
    {
        $sql = 'SELECT DISTINCT(u.state) AS state 
                FROM '.$this -> mTbUsers.' u, '.$this -> mTbGear.' g
                WHERE g.uid = u.uid AND cid = ? 
                ORDER BY u.state
                ';
        $db  = $this -> mDbPtr -> query( $sql, array($cid) );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['state'];
        }
        return $r; 
    }/** GetGearStates */
    
    
    /**
     * Get gears cities
     * 
     * @return array with distinct states
     */
    public function GetGearCities( $state = '', $cid = 0 )
    {
        $state =  (2 == strlen($state)) ? mysql_escape_string( $state ) : '';

        $sql = 'SELECT DISTINCT(u.city) AS city 
                FROM '.$this -> mTbUsers.' u, '.$this -> mTbGear.' g
                WHERE g.uid = u.uid AND cid = ?
                '.($state ? ' AND u.state = "'.$state.'"' : '').' 
                ORDER BY city
                ';
        $db  = $this -> mDbPtr -> query( $sql, array($cid) );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['city'];
        }
        return $r; 
    }/** GetGearCities */    
    
    
}
?>