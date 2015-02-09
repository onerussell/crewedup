<?php
/**
 * Model Company Roster class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Roster
{
    /**
     * Roster Table name
     *
     * @var string
     */
    private $mTbRoster;    	
	
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
        $this -> mTbRoster   =  $tables['roster'];
        $this -> mTbUsers    =  $tables['users'];
    }

    
    public function Add( $uid, $mid )
    {
    	if (!$this -> Check($uid, $mid))
    	{
    		$sql = 'INSERT INTO '.$this -> mTbRoster.' (uid, mid, pdate) VALUES(?, ?, ?)';
    		$this -> mDbPtr -> query($sql, array($uid, $mid, mktime()));
    	}
    	return true;
    }/** Add */
    
    
    public function Check( $uid, $mid )
    {
    	$sql = 'SELECT id FROM '.$this -> mTbRoster.' WHERE uid = ? AND mid = ?';
    	$r   = $this -> mDbPtr -> getOne($sql, array($uid, $mid));
    	if ($r)
    	{
    		return true; 
    	}
    	else
    	{
    		return false;
    	}
    }/** Check */
    
    
    public function Del( $uid, $mid )
    {
    	$sql = 'DELETE FROM '.$this -> mTbRoster.' WHERE uid = ? AND mid = ?';
    	$this -> mDbPtr -> query($sql, array($uid, $mid));
    	return true;
    }/** Del */
    
    
    public function GetCount( $uid, $letter = '', $sstr = '' )
    {
    	$sql = 'SELECT COUNT(r.id) FROM '.$this -> mTbRoster.' r, '.$this -> mTbUsers.' u
    	        WHERE r.mid = u.uid AND u.active = 1 AND r.uid = ?';
    	
        if ($letter)
        {
            $sql .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
        }
        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" OR LOWER(u.company) LIKE "%'.$sstr.'%" )';
        }
    	
    	$r   = $this -> mDbPtr -> getOne( $sql, array($uid) );
    	return $r;
    	
    }/** GetCount */
    
    
    public function &GetList( $uid, $first = 0, $cnt = 0, $letter = '', $sstr = '', $sort = '' ) 
    {
        $sql = 'SELECT u.uid, u.email, u.name, u.lname, u.image, u.subdir, u.status, u.person_title,
                u.city, u.state, u.zip, u.phone, u.company  
                FROM '.$this -> mTbRoster.' r, '.$this -> mTbUsers.' u 
                WHERE u.uid = r.mid AND u.active = 1 AND r.uid = ?
                ';
                
        if ($letter)
        {
            $sql .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
        }
        
        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" )';
        }

        $sql .= (!$sort) ? ' ORDER BY u.name, u.lname' : ' ORDER BY '.$sort;

        if ($cnt)
        {
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($uid)); 
        }
        else 
        {
            $db  =$this -> mDbPtr -> query($sql, array($uid));
        }

        $r  = array();
        while ($row = $db -> FetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $row['lname']    = stripslashes($row['lname']);
            $row['company']  = stripslashes($row['company']);
            $r[] = $row;
        }
        return $r;          
    }/** GetList */
    
}/** Model_Main_Roster */