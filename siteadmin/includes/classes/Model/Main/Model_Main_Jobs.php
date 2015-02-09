<?php
/**
 * Model Jobs class 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

class Model_Main_Jobs
{
    
   /**
     * Jobs Table name
     *
     * @var string
     */
    private $mTbJobs;       


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
        $this -> mTbJobs     =  $tables['jobs'];
        $this -> mTbUsers    =  $tables['users'];
    }
    
    public function Edit( $ar, $id = 0 )
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbJobs.' (uid, job_title, cid, start_date, project_title, show_proj, descr, pdate) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, '.mktime().')';
            $this -> mDbPtr -> query($sql, $ar);
            $id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        { 
            $sql = 'UPDATE '.$this -> mTbJobs.' SET 
                    uid           = ?, 
                    job_title     = ?, 
                    cid           = ?, 
                    start_date    = ?, 
                    project_title = ?, 
                    show_proj     = ?, 
                    descr         = ? 
                    WHERE id = ?';
            $ar[] = $id;
            $this -> mDbPtr -> query($sql, $ar);            
        }
  
        require_once CLASS_PATH.'Model/Main/Model_Main_Dict.php';
        
        $oDict = new Model_Main_Dict($this -> mDbPtr);

        if (!empty($ar[1]))
            $oDict -> CheckAndUpdate(DICT_JOBS, $ar[1]);
                
        if (!empty($ar[4]))
            $oDict -> CheckAndUpdate(array(DICT_FILMS, DICT_SHOWS),$ar[4]);

        return $id;
    }/** Edit */
    
    
    public function Del( $id, $uid = 0)
    {
         $sql  = 'DELETE FROM '.$this -> mTbJobs.' WHERE id = '.$id;
         if ($uid)
         {
             $sql .= ' AND uid = '.$uid;

             $this -> mDbPtr -> query('DELETE FROM '.TB.'wire WHERE ptype=6 AND ext_id = '.$id.' AND uid = '.$uid);
         }
         $this -> mDbPtr -> query($sql);
         return true;
    }/** Del */
    
    
    /**
     * Get Items count
     *
     * @param int $uid - user ID
     * @return int  - items count
     */
    public function GetCount($uid = 0, $ctg = 0, $state = '', $city = '', $sstr = '')
    {
        $sql = 'SELECT COUNT(j.id) FROM '.$this -> mTbJobs.' j, '.$this -> mTbUsers.' u 
                WHERE j.uid = u.uid';
        $ar  = array(); 
        if ($uid)
        {
            $sql .= ' AND j.uid = ?';
            $ar[] = $uid;
        }
        
        if ( $ctg )
        {
            $sql .= ' AND j.cid = ?';
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

        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(j.job_title) LIKE "%'.mysql_escape_string( $sa[$i] ).'%"';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }
        
        $r = $this -> mDbPtr -> getOne($sql, $ar);
        return $r; 
    }/** GetCount */

    
    public function &GetList( $uid = 0, $ctg = 0,  $first = 0, $cnt = 0, $state = '', $city = '', $sstr = '' )
    {
        $sql = 'SELECT j.*, DATE_FORMAT(start_date, "%m/%d/%Y") AS start_date, 
                u.company, u.state, u.city, u.image
                FROM '.$this -> mTbJobs.' j, '.$this -> mTbUsers.' u 
                WHERE j.uid = u.uid';
        
        $ar  = array(); 
        if ($uid)
        {
            $sql .= ' AND j.uid = ?';
            $ar[] = $uid;
        }
        
        if ( $ctg )
        {
            $sql .= ' AND j.cid = ?';
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
        
        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(j.job_title) LIKE "%'.mysql_escape_string( $sa[$i] ).'%"';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }
        
        $sql .= ' ORDER BY j.pdate DESC';
        
        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, $ar); 
        else
            $db  = $this -> mDbPtr -> query($sql, $ar);   
        $r   = array();
        while ($row = $db -> fetchRow())
        {
            $row['mt']    = $row['pdate'];
            $row['pdate'] = date("m/d/Y", $row['pdate']);
            $r[] = $row;
        }
        return $r;
    }/** GetList */
    
    
    public function Get( $id )
    {
    	$sql = 'SELECT *, DATE_FORMAT(start_date, "%m/%d/%Y") AS sd FROM '.$this -> mTbJobs.' WHERE id = ?';
    	$db  = $this -> mDbPtr -> query( $sql, array($id) );
    	if ($row = $db -> FetchRow())
    	{
    		$row['pdate'] = date("m/d/Y", $row['pdate']);
    	    return $row;
    	}
    	else
    	{
    		$r = array();
    		return $r;
    	}
    }/** Get */

    
    /**
     * Get sipmle jobs list for user (with ID == $uid)
     * @param int $uid - user ID
     * @param int $first - first item
     * @param int $cnt - items count
     * 
     * @return array with jobs info
     */
    public function &GetLowJobList( $uid, $first = 0, $cnt = 0 )
    {
        $sql = 'SELECT id, job_title FROM '.$this -> mTbJobs.' WHERE uid = ? ORDER BY pdate DESC';
        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery( $sql, $first, $cnt, array($uid));            
        else
            $db  = $this -> mDbPtr -> query( $sql, array($uid));            
        
        $r   = array(); 
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetLowJobList */
    
    
    /**
     * Get jobs states
     * 
     * @return array with distinct states
     */
    public function GetJobStates()
    {
        $sql = 'SELECT DISTINCT(u.state) AS state 
                FROM '.$this -> mTbUsers.' u, '.$this -> mTbJobs.' j
                WHERE j.uid = u.uid 
                ORDER BY u.state ASC';
        $db  = $this -> mDbPtr -> query( $sql );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['state'];
        }
        return $r; 
    }/** GetJobStates */
    
    
    /**
     * Get jobs cities
     * 
     * @return array with distinct states
     */
    public function GetJobCities( $state = '' )
    {
        $state =  (2 == strlen($state)) ? mysql_escape_string( $state ) : '';

        $sql = 'SELECT DISTINCT(u.city) AS city 
                FROM '.$this -> mTbUsers.' u, '.$this -> mTbJobs.' j
                WHERE j.uid = u.uid
                '.($state ? ' AND u.state = "'.$state.'"' : '').' 
                ORDER BY city ASC';
        $db  = $this -> mDbPtr -> query( $sql );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['city'];
        }
        return $r; 
    }/** GetJobCities */
        
}/** Model_Main_Jobs */