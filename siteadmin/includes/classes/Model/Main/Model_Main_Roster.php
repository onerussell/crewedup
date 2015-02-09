<?php
/**
 * Model Company Roster class 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
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
    }
    
    public function Check($uid, $mid)
    {
        $val1 = (bool)$this -> mDbPtr -> getOne('SELECT 1 FROM '.$this -> mTbRoster.' 
                                                 WHERE uid = '.$uid.' AND mid = '.$mid);

        if (!$val1)
            return (bool)$this -> mDbPtr -> getOne('SELECT 1
                                                    FROM '.TB.'resume rs 
                                                    WHERE rs.uid = '.$mid.'
                                                          AND rs.empl_type IN (0,1)
                                                          AND rs.company = ?', array($_SESSION['system_company']));

    	return true;
    }
    
    public function Del($uid, $mid)
    {
    	$this -> mDbPtr -> query('DELETE FROM  '.$this -> mTbRoster.' WHERE uid = '.$uid.' AND mid = '.$mid);

        $this -> mDbPtr -> query('REPLACE INTO '.$this -> mTbRoster.'_block
                                  (uid, mid) VALUES ('.$uid.', '.$mid.')');
    	return true;
    }
    
    public function GetCount($uid, $letter = '', $sstr = '')
    {
        $company_name = $this -> mDbPtr -> getOne('SELECT company 
                                                   FROM '.$this -> mTbUsers.' 
                                                   WHERE uid = '.$uid);

       	$sql1 = 'SELECT COUNT(*) 
                 FROM '.$this -> mTbRoster.' r, 
                      '.$this -> mTbUsers.' u
    	         WHERE r.mid = u.uid
                       AND u.active = 1
                       AND r.uid = '.$uid;
    	
        $sql2 = 'SELECT COUNT(*)
                 FROM '.TB.'resume rs, 
                      '.$this -> mTbUsers.' u 
                 WHERE rs.empl_type IN (0,1)
                       AND rs.company = ? 
                       AND rs.uid NOT IN(SELECT mid FROM '.$this -> mTbRoster.'_block WHERE uid = '.$uid.') 
                       AND u.uid = rs.uid';

        if ($letter)
        {
            $sql1 .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%"AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
            $sql2 .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
        }

        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql1 .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" OR LOWER(u.company) LIKE "%'.$sstr.'%" )';
            $sql2 .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" OR LOWER(u.company) LIKE "%'.$sstr.'%" )';
        }
        	
    	return $this -> mDbPtr -> getOne( $sql1) + $this -> mDbPtr -> getOne( $sql2, array($_SESSION['system_company']));
    }/** GetCount */
    
    
    public function &GetList( $uid, $first = 0, $cnt = 0, $letter = '', $sstr = '', $sort = '' ) 
    {
        $company_name = $this -> mDbPtr -> getOne('SELECT company 
                                                   FROM '.$this -> mTbUsers.' 
                                                   WHERE uid = '.$uid);

        $sql1 = 'SELECT u.uid, u.email, u.name, u.lname, u.image, u.subdir, u.status, u.person_title,
                 u.city, u.state, u.zip, u.phone, u.company, 1 AS rtype
                 FROM '.$this -> mTbRoster.' r, '.$this -> mTbUsers.' u 
                 WHERE u.uid = r.mid AND u.active = 1 AND r.uid = '.$uid;
                
        $sql2 = 'SELECT u.uid, u.email, u.name, u.lname, u.image, u.subdir, u.status, u.person_title,
                 u.city, u.state, u.zip, u.phone, u.company, 0 AS rtype
                 FROM '.TB.'resume rs, '.$this -> mTbUsers.' u 
                 WHERE rs.empl_type IN (0,1) 
                       AND rs.company = ? 
                       AND rs.uid NOT IN(SELECT mid FROM '.$this -> mTbRoster.'_block WHERE uid = '.$uid.') 
                       AND u.uid = rs.uid';

        if ($letter)
        {
            $sql1 .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
            $sql2 .= ' AND (( LOWER(u.name) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
        }
        
        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql1 .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" )';
            $sql2 .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" )';
        }

        $sql = '('.$sql1.') UNION ('.$sql2.') '.(!$sort ? ' ORDER BY name, lname' : ' ORDER BY '.$sort);


        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($company_name)); 
        else 
            $db  =$this -> mDbPtr -> query($sql, array($company_name));

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