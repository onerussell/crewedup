<?php
/**
 * Model Calendar Events class 
 *
 * @package    engine37  Community v4.0
 * @version    0.1b
 * @since      02/01/2008
 * @copyright  2004-2008 engine.com
 * @link       http://engine37.com
 */

class Model_Main_Calendar_Events
{
    /**
     * Events Table name
     *
     * @var string
     */
    public $mTbEvents;       

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
        $this -> mTbEvents   =  $tables['events'];
    }    
    
    
    public function AddEvent($uid, $pdate, $status, $event = '')
    {
        $sql = 'INSERT INTO '.$this -> mTbEvents.'(uid, pdate, status, event)
                VALUES(?, ?, ?, ?) 
               ';
        $this -> mDbPtr -> query($sql, array($uid, $pdate, $status, $event));
        return true;
    }/** AddEvent */
    
    
    public function &GetEventsList($uid, $dt_start, $dt_end, $assoc = 0)
    {
        $sql = 'SELECT *, 
                DATE_FORMAT(pdate, "%d") AS day,
                DATE_FORMAT(pdate, "%m") AS month,
                DATE_FORMAT(pdate, "%Y") AS year
                FROM '.$this -> mTbEvents.' WHERE uid = ? AND 
                pdate >= ? AND pdate <= ? 
                ORDER BY pdate
               ';
        $db  = $this -> mDbPtr -> query($sql, array($uid, $dt_start, $dt_end));
        while ($row = $db -> FetchRow())
        {
            $row['pdatex'] = (!$row['day'][0] ? $row['day'][1] : $row['day']).'_'.
                             (!$row['month'][0] ? $row['month'][1] : $row['month']).'_'.
                             $row['year'];     
            if (!$assoc)
            {
                $r[] = $row;    
            }   
            else
            {
                $r[$row['pdatex']] = $row;     
            }
        }
        return $r;
    }/** GetList */
    
    
    /**
     * Delete Event By ID
     * @param $id - event id
     * @return bool true
     */
    public function DelEvent($id)
    {
        $sql = 'DELETE FROM '.$this -> mTbEvents.' WHERE id = ?';
        $this -> mDbPtr -> query($sql, $id);
        return true;
    }/**DelEvent */
    
    
    public function DelEventByDate($uid, $pdate)
    {
        $sql = 'DELETE FROM '.$this -> mTbEvents.' WHERE uid = ? AND pdate = ?';
        $this -> mDbPtr -> query($sql, array($uid, $pdate));
        return true;
    }/**DelEvent */
    
    
}/**  Model_Main_Calendar_Events */