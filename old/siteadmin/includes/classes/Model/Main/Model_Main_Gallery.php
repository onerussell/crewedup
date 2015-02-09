<?php
/**
 * Gallery
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Gallery
{
    
    /**
     * PEAR::DB object
     * @var DB_common
     */
    private $mDbPtr;

    /**
     * Smarty object
     * @var Smarty
     */
    private $mSmarty;
    
    /**
     * Gallery table
     */
    private $mGtable;
    
    
    /**
     * Constructor
     *
     * @param array  $dbObj        global objects array
     * @param string $utable       users table
     * @param string $gtable       gallery table
     * @return void
     */
    public function __construct(&$glObj, $utable = 'fe_users', $gtable = 'fe_users_profilegallery')
    {
        $this -> mDbPtr       =& $glObj['db'];
        $this -> mSmarty      =& $glObj['smarty'];
        $this -> mUtable      =  $utable; 
        $this -> mGtable      =  $gtable;
    }
    
    
    function &Get($id = 0, $uid = 0)
    {
        $r   = array();
        $sql = 'SELECT * FROM '.$this -> mGtable.' WHERE id = ? AND uid = ?';
        $db  = $this -> mDbPtr -> query($sql, array($id, $uid));
        if ($row = $db -> FetchRow())
        {
            $row['ptime'] = date("h:i a", $row['pdate']);
            $row['pdate'] = date("m/d/Y", $row['pdate']);
            
            $row['title'] =  stripslashes($row['title']);
            $row['image'] =  $row['subdir'].$row['image'];
            $r            =& $row;
        }
        return $r;
    }#Get
    
    
    function GetCnt($UID, $active = 0)
    {
        if (!is_numeric($UID) || 0 == $UID)
        {
            return 0;
        }
        $sql = 'SELECT count(id) FROM '.$this -> mGtable.' WHERE uid = ?';
        if (1 == $active)
        {
            $sql .= ' AND active = 1';
        }
        $mm  = $this -> mDbPtr -> GetOne($sql, array($UID));
        return $mm;        
    }#GetCnt
    
    
    function &GetList($UID, $first = 0, $cnt = 0, $active = 0)
    {
        $r  = array();
        if (!is_numeric($UID) || 0 == $UID)
        {
            return $r;
        }
        $sql = 'SELECT * FROM '.$this -> mGtable.' WHERE uid = ?';
        if (1 == $active)
        {
            $sql .= ' AND active = 1';
        }
                
        if (0 < $cnt)
        {
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($UID));  
        }
        else 
        {
            $db  = $this -> mDbPtr -> query($sql, array($UID));   
        } 

        while ($row = $db -> FetchRow())
        {
            $row['ptime'] = date("h:i a", $row['pdate']);
            $row['pdate'] = date("m/d/Y", $row['pdate']);
            $row['title'] = stripslashes($row['title']); 
            $row['image'] =  $row['subdir'].$row['image'];
            $r[] = $row;
        }
        return $r;
    }#GetList
    
    
    function Add($ar = array(), $UID = 0)
    {
        if (!is_numeric($UID) || 0 == $UID)
        {
            return 0;
        }
        $sql = 'INSERT INTO '.$this -> mGtable.' (image, subdir, uid, title, story, pdate) 
                                                  VALUES(?, ?, ?, ?, ?, ?)';
        $db  = $this -> mDbPtr -> query($sql, 
                                        array($ar['image'], 
                                              DIR_NAME_IMAGE_SUBDIR."/",
                                              $UID, 
                                              $ar['title'],
                                              $ar['story'],
                                              mktime()));
        $sql = 'SELECT LAST_INSERT_ID()'; 
        $id  = $this -> mDbPtr -> getOne($sql);
        return $id;    
    }#Add
    
    
    function Update($ar = array(), $id = 0, $UID = 0)
    {
        if (!is_numeric($id) || !is_numeric($UID) || 0 == $UID || 0 == $id)
        {
            return 0;
        }
        
        $sql = 'UPDATE '.$this -> mGtable.' SET 
                title    = ?,
                story    = ?
                WHERE id = ? AND uid = ?';
        $ar = array_merge($ar, array($id, $UID));#print_r($ar);
        $db  = $this -> mDbPtr -> query($sql, $ar);
        return $id;
    }#Update
    
    /*
     *Clear is_first field
     * 
     */
    public function ClearFirst($UID = 0)
    {
        if (!is_numeric($UID) || 0 == $UID)
        {
            return 0;
        }        
        $sql = 'UPDATE '.$this -> mGtable.' SET is_first = 0 WHERE uid = ?';
        $this -> mDbPtr -> query($sql, array($UID));
        return 1;
    }#ClearFirst
    
       
    function UpdateActive($id = 0, $UID = 0)
    {
        if (!is_numeric($UID) || 0 == $UID || !is_numeric($id) || 0 == $id)
        {
            return 0;
        }        
        $sql = 'UPDATE '.$this -> mGtable.' SET active = NOT active 
                WHERE id = ? AND uid = ?';    
        $this -> mDbPtr -> query($sql, array($id, $UID));
        return true;
    }#UpdateActive  
    
    
    function Del($id = 0, $UID = 0)
    {
        if (!is_numeric($UID) || 0 == $UID || !is_numeric($id) || 0 == $id)
        {
            return false;
        }   
        $im    =& $this -> Get($id, $UID);
        if (isset($im['image']))
        {
            $fl  = DIR_WS_IMAGE .'/'. $im['image'];
            $fls = DIR_WS_IMAGE .'/'. DIR_NAME_IMAGECACHE . $im['subdir'] . $im['image'];
            //$flx = DIR_WS_IMAGE .'/'. DIR_NAME_IMAGECACHE2 . $im['subdir'] . $im['image'];
            if (file_exists($fl))
            {
                unlink($fl);
            }
            if (file_exists($fls))
            {
                unlink($fls);
            }
            /*
            if (file_exists($flx))
            {
                unlink($flx);
            } 
            */              
        }
        $sql   = 'DELETE FROM '.$this -> mGtable.' WHERE id = ? AND uid = ?';
        $this -> mDbPtr -> query($sql, array($id, $UID));
        return true;
    }#Del        
    
    /*
     * Update user main table - set default photo
     *
     */
    public function UpdateUserMain($UID = 0)
    {
        if (!is_numeric($UID) || 0 == $UID)
        {
            return false;
        }          
        
        $cnt           = $this -> GetCnt($UID, 1);
        $is_intimphoto = 0;
        $icon          = '';
        if (0 < $cnt)
        { 
            $sql = 'SELECT id, image, subdir, is_first FROM '.$this -> mGtable.
                   ' WHERE uid = ? AND active = 1
                     ORDER BY is_first DESC LIMIT 1';
            $db  = $this -> mDbPtr -> query($sql, array($UID));
            if ($row = $db -> FetchRow())
            {
                $icon          = $row['subdir'].$row['image'];
            }
        }
        $sql = 'UPDATE '.$this -> mUtable.' SET 
                photos_cnt    = ?,
                is_photo      = ?,
                icon          = ? 
                WHERE uid = ?              
               ';        
        $this -> mDbPtr -> query($sql, array($cnt, (0 < $cnt ? 1 : 0), $is_intimphoto, $icon, $UID));
        return true;
    }#UpdateUserMain

}/** Model_Main_Gallery **/
?>