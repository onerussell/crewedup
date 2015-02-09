<?php
/**
 * Model Resume class 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      02.05.2009
 * @copyright  2007-2009 Engine37
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
        $this -> mDbPtr    =& $gDb; 
        $this -> mTbResume =  $tables['resume'];
        $this -> mTbUsers  =  $tables['users'];
    }
    
    public function Edit($ar, $id = 0, $image = '', $image2 = '')
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbResume.' 
                    (uid, title, prof, sdate, story, company, pdate, prof_cat, fdate, prj_type, prj_episode, empl_type)
                    VALUES
                    (?, ?, ?, ?, ?, ?, '.mktime().', ?, ?, ?, ?, ?)';
            $this -> mDbPtr -> query($sql, $ar);
            $id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $ar[] = $id;
            $sql = 'UPDATE '.$this -> mTbResume.' SET
                    uid         = ?,
                    title       = ?,
                    prof        = ?,
                    sdate       = ?,
                    story       = ?,
                    company     = ?,
                    pdate_upd   = '.mktime().',
                    prof_cat    = ?,
                    fdate       = ?,
                    prj_type    = ?,
                    prj_episode = ?,
                    empl_type   = ?
                    WHERE id    = ?';
            $this -> mDbPtr -> query($sql, $ar);
        }
        
        require_once CLASS_PATH.'Model/Main/Model_Main_Dict.php';
        $oDict =& new Model_Main_Dict($this -> mDbPtr);
        
        // -----------------------------------------------------------------------
        // Movie
        $oDict -> CheckAndUpdate(array(DICT_FILMS, DICT_SHOWS),$ar[1]);

        $image_cur = $oDict -> GetAdditionalField(array(DICT_FILMS, DICT_SHOWS), $ar[1]);

        if ($image_cur[0])
           $image = $image_cur[0];
        elseif ($image)
            $oDict -> UpdateAdditionalField(array(DICT_FILMS, DICT_SHOWS), $ar[1], $image);

        if ($image)
        	$this -> mDbPtr -> query('UPDATE '.$this -> mTbResume.' SET image = \''.$image.'\' WHERE id = '.$id);

        if ($image_cur[1])
           $image2 = $image_cur[1];
        elseif ($image2)
            $oDict -> UpdateAdditionalField(array(DICT_FILMS, DICT_SHOWS), $ar[1], $image2, 2);

        if ($image2)
            $this -> mDbPtr -> query('UPDATE '.$this -> mTbResume.' SET image2 = \''.$image2.'\' WHERE id = '.$id);

        // -----------------------------------------------------------------------
        // Networks
        $oDict -> CheckAndUpdate(DICT_NETS, $ar[5]);

        /*$image2_cur = $oDict -> GetAdditionalField(DICT_NETS, $ar[5]);

        if ($image2_cur)
           $image2 = $image2_cur;
        elseif ($image2)
            $oDict -> UpdateAdditionalField(DICT_NETS, $ar[5], $image2);

        if ($image2)
            $this -> mDbPtr -> query('UPDATE '.$this -> mTbResume.' SET image2 = \''.$image2.'\' WHERE id = '.$id);*/

        // -----------------------------------------------------------------------
        // Jobs
        if (!empty($ar[2]))
            $oDict -> CheckAndUpdate(DICT_JOBS, $ar[2]);

        return $id;
    }
    
    public function Del($id)
    {
        $this -> DelImage($id);
        $this -> mDbPtr -> query('DELETE FROM '.$this -> mTbResume.' WHERE id = '.$id);
        $this -> mDbPtr -> query('DELETE FROM '.TB.'wire WHERE ptype = 7 AND ext_id = '.$id);
        return true;
    }
    
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
                DATE_FORMAT(sdate, "%Y") AS year, 
                DATE_FORMAT(fdate, "%m") AS month_f,
                DATE_FORMAT(fdate, "%Y") AS year_f 
                FROM '.$this -> mTbResume.' WHERE id = id';
        if ($uid)
            $sql .= ' AND uid = '.(int)$uid;

        $sql .= ' ORDER BY sdate DESC';
        
        if ($cnt)
            $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        else
            $db = $this -> mDbPtr -> query($sql);   

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
                DATE_FORMAT(sdate, "%Y") AS year,
                DATE_FORMAT(fdate, "%m") AS month_f,
                DATE_FORMAT(fdate, "%Y") AS year_f
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
            return $row;

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
                 unlink( PATH_ROOT . DIR_NAME_IMAGE .'/'.$r );
            
            if ( file_exists( PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $r ) )
                 unlink( PATH_ROOT . DIR_NAME_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $r );

            $sql = 'UPDATE '.$this -> mTbResume.' SET image'.$num.' = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array('', $id));
            return true;           
        }
        return false;
    }/** DelImage */
    
    
}/** Model_Main_Resume*/
?>