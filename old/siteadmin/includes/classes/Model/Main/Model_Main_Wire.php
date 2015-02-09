<?php
/**
 * Model Wire class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Wire
{
	
   /**
     * Wire Table name
     *
     * @var string
     */
    private $mTbWire;       


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
        $this -> mTbWire     =  $tables['wire'];
        $this -> mTbUsers    =  $tables['users'];
    }
  	
	public function Edit( $ar, $id = 0 )
	{
		/**
		 * ptype: 1 - blog, 2 - photo, 3 - message, 4 - gear, 5 - friend, 6 - jobs
		 * 
		 */

	    if (!$id)
		{
		    $sql = 'INSERT INTO '.$this -> mTbWire.' (uid, to_uid, fname, ptype, title, link, pdate) 
		            VALUES (?, ?, ?, ?, ?, ?, '.mktime().')';
	    	$this -> mDbPtr -> query($sql, $ar);
	    	$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
		}
		else
		{
            $sql = 'UPDATE '.$this -> mTbWire.' SET 
                    uid    = ?, 
                    to_uid = ?,
                    fname  = ?,
                    ptype  = ?, 
                    title  = ?, 
                    link   = ?, 
                    pdate_upd = '.mktime().' 
                    WHERE id = ?';
            $ar[] = $id;
            $this -> mDbPtr -> query($sql, $ar);			
		}
		return $id;
    }/** Edit */
	
    
    public function Del( $id, $uid = 0)
    {
    	 $sql  = 'DELETE FROM '.$this -> mTbWire.' WHERE id = ?';
    	 $ar[] = $id;
    	 if ($uid)
    	 {
    	     $sql .= ' AND uid = ?';
    	     $ar[] = $uid;
    	 }
    	 $this -> mDbPtr -> query($sql, $ar);
    	 return true;
    }/** Del */
    
    
    public function &GetList( $uid, $first = 0, $cnt = 0 )
    {
        /** get user friends */
        $sql = 'SELECT friend_id FROM '.TB.'users_friend WHERE uid = ? AND active = 1';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        $uf  = '';
        while ($row = $db -> FetchRow())
        {
            $uf .= ($uf ? ', ' : '') . $row['friend_id'];
        }
        $sql = 'SELECT * FROM '.$this -> mTbWire.' WHERE id = id';
        $sql .= ' AND ( ( (ptype = 3 OR ptype = 5) AND to_uid = '.(int)$uid.' )';
        if ($uf)
        {
            $sql .= ' OR ( (ptype = 1 OR ptype = 2 OR ptype = 4 OR ptype = 6 OR ptype = 7) AND ( uid IN ('.$uf.') ) )';
        }
        $sql .= ' )';
        $sql .= ' ORDER BY pdate DESC';
        
        if ($cnt)
        {
            $db  = $this -> mDbPtr -> limitQuery( $sql, $first, $cnt );
        }
        else
        {
            $db  = $this -> mDbPtr -> query( $sql );	
        }
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $row['mt']    = $row['pdate'];
            $row['pdate'] = date("m/d/Y h:i a", $row['pdate']);
            $r[] = $row;
        }
        return $r;
    }/** GetList */
    
    public function &GetListAdi( $uid, $first = 0, $cnt = 0, $ptype = 0 )
    {
        /** get user friends */
        $sql = 'SELECT friend_id FROM '.TB.'users_friend WHERE uid = ? AND active = 1';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        $uf  = '';
        while ($row = $db -> FetchRow())
        {
            $uf .= ($uf ? ', ' : '') . $row['friend_id'];
        }
        $sql = 'SELECT w.*, u.image, u.subdir FROM '.$this -> mTbWire.' w, '.$this -> mTbUsers.' u
                WHERE w.uid = u.uid';
        
        if (!$ptype)
        {      
            $sql .= ' AND ( ( (w.ptype = 3 OR w.ptype = 5) AND w.to_uid = '.(int)$uid.' )';
        }
        elseif (3 == $ptype || 5 == $ptype)
        {
            $sql .= ' AND ( ( (w.ptype = '.$ptype.') AND w.to_uid = '.(int)$uid.' ) )';
        }
        
        if ($uf)
        {
            if (!$ptype)
            {
                $sql .= ' OR ( (w.ptype = 1 OR w.ptype = 2 OR w.ptype = 4 OR w.ptype = 6 OR w.ptype = 7) AND ( w.uid IN ('.$uf.') ) )';
            }
            elseif (1 == $ptype || 2 == $ptype || 4 == $ptype || 6 == $ptype || 7 == $ptype)
            {
                $sql .= ' AND ( (w.ptype = '.$ptype.') AND ( w.uid IN ('.$uf.') ) )';
            }
        }
        elseif ((1 == $ptype || 2 == $ptype || 4 == $ptype || 6 == $ptype || 7 == $ptype) && !$uf)
        {
            $r = array();
            return $r;
        }
        
        if (!$ptype)
        {
            $sql .= ' )';
        }
        
        $sql .= ' ORDER BY w.pdate DESC';
        
        if ($cnt)
        {
            $db  = $this -> mDbPtr -> limitQuery( $sql, $first, $cnt );
        }
        else
        {
            $db  = $this -> mDbPtr -> query( $sql );    
        }
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $row['pdate'] = date("m/d/Y h:i a", $row['pdate']);
            $r[] = $row;
        }
        return $r;
    }/** GetListAdi */
    
    
    public function &GetCount( $uid )
    {
        /** get user friends */
        $sql = 'SELECT friend_id FROM '.TB.'users_friend WHERE uid = ? AND active = 1';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        $uf  = '';
        while ($row = $db -> FetchRow())
        {
            $uf .= ($uf ? ', ' : '') . $row['friend_id'];
        }
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbWire.' WHERE id = id';
        
        /** item parameters */ 
        if (!$ptype)
        {      
            $sql .= ' AND ( ( (ptype = 3 OR ptype = 5) AND to_uid = '.(int)$uid.' )';
        }
        elseif (3 == $ptype || 5 == $ptype)
        {
            $sql .= ' AND ( ( (ptype = '.$ptype.') AND to_uid = '.(int)$uid.' ) )';
        }
        
        if ($uf)
        {
            if (!$ptype)
            {
                $sql .= ' OR ( (ptype = 1 OR ptype = 2 OR ptype = 4 OR ptype = 6) AND ( uid IN ('.$uf.') ) )';
            }
            elseif (1 == $ptype || 2 == $ptype || 4 == $ptype || 6 == $ptype)
            {
                $sql .= ' AND ( (ptype = '.$ptype.') AND ( uid IN ('.$uf.') ) )';
            }
        }
        
        if (!$ptype)
        {
            $sql .= ' )';
        }
        /** end item parameters */ 
        
        $r   = $this -> mDbPtr -> getOne( $sql );
        return $r;
    }/** GetCount */    

    
    public function &GetCountAdi( $uid, $ptype )
    {
        /** get user friends */
        $sql = 'SELECT friend_id FROM '.TB.'users_friend WHERE uid = ? AND active = 1';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        $uf  = '';
        while ($row = $db -> FetchRow())
        {
            $uf .= ($uf ? ', ' : '') . $row['friend_id'];
        }
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbWire.' WHERE id = id';
        $sql .= ' AND ( ( (ptype = 3 OR ptype = 5) AND to_uid = '.(int)$uid.' )';
        if ($uf)
        {
            $sql .= ' OR ( (ptype = 1 OR ptype = 2 OR ptype = 4 OR ptype = 6) AND ( uid IN ('.$uf.') ) )';
        }
        $sql .= ' )';

        $r   = $this -> mDbPtr -> getOne( $sql );
        return $r;
    }/** GetCount */       
}