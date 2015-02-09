<?php
/**
 * History class
 * 
 * @package    Engine37 catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37 Team
 * @link       http://Engine37.com
 */
class Model_Maintenance_History
{
    /**
     * PEAR::DB
     * @var DB_common
     */
    private $mDbPtr;

    /**
     * Items per page
     * (if 0 -show all)
     * @var int
     */
    private $mResOnPageH; 

    /**
     *Smarty class
     * @var Smarty
     */
    private $mSmarty;

    /**
     * Pagging
     * @var View_Acc_SimplePagging
     */
    private $mPages;

    /**
     * Time offset
     * @var int
     */
    private $mTimeOffset;

    /**
     * History table
     * @var string
     */
    private $mTableH;

    public function __construct(&$glObj, $tableH = 'history', $resOnPageH = 20, $timeOffset = 0)
    {
        $this -> mDbPtr      =& $glObj['db'];
        $this -> mTableH     =  $tableH;
        $this -> mPages      =& $glObj['page'];
        $this -> mResOnPageH =  $resOnPageH;
        $this -> mTimeOffset =  $timeOffset;
    }

    public function &GetLastAccess($login, $actType)
    {
        $data = array($login, $actType);
        $sql = 'SELECT h.date AS date,
                       h.ip FROM '.$this->mTableH.' h 
                WHERE h.login = ?
                      AND h.action = ? 
                ORDER BY h.date DESC';

        $res =& $this->mDbPtr->limitQuery($sql, 1, 1, $data); 

        if (0 < $res -> numRows())
        {
            return $res -> fetchRow();
        }
        else
           {
            $res = array('ip'   => getenv('REMOTE_ADDR'), 
                         'date' => date('d.m.Y H:i'));
            return $res;
           }

    }

    /**
     * Delete message from history
     * @param int $log_id record id
     * @return void
     */
    public function DeleteRecord($log_id)
    {
        $log_id = intval($log_id);
        $this->mDbPtr->query('DELETE FROM '.$this->mTableH.' 
                              WHERE log_id = ?', $log_id);

    }

    public function ResOnPage()
    {
        return $this->mResOnPageH;

    }

    /**
     *Add new message to history
     *
     * @param string $action action, for example 'Delete'
     * @param string $what   for example 'user'
     *
     * @return void
     */
    public function Add($action,$what)
    {
        $data = array($action, 
                      $what, 
                      getenv('REMOTE_ADDR'), 
                      UI_USERNAME);

        $this->mDbPtr->query('INSERT INTO '.$this->mTableH.'
                              (action,what,date,ip,login) 
                              VALUES (?, ?, '.mktime().', ?, ?)', $data, $this -> mDbPtr);

    }

    /**
     * Get messages count
     *
     * @param int $startDate start date, -1 for negative infinity
     * @param int $endDate   end date, -1 for infinity 
     *
     * @return int count of records
     */
    public function &Count($startDate = -1, $endDate = -1)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->mTableH;
        if ($startDate != -1)
            $sql .= ' WHERE date>=\''.$startDate.'\' 
                            AND date<=\''.$endDate.'\'';

        $res =& $this->mDbPtr->getOne($sql, array()); 

        return $res;

    }

    /**
     * Get all
     *
     * @param int $pStart    page number
     * @param int $startDate start date, -1 for negative infinity
     * @param int $endDate   end date, -1 for infinity 
     *
     * @return array associative array with results
     */
    public function &GetAll($pStart = 0, $startDate = -1, $endDate = -1)
    {
        $sql = 'SELECT * 
                FROM '.$this->mTableH;

        if ($startDate != -1)
            $sql .= ' WHERE date>=\''.$startDate.'\' 
                      AND date<=\''.$endDate.'\'';

        $sql .= ' ORDER BY date DESC';

        $HA = $this -> mPages -> GeneratePages($sql, array(), $pStart, $this -> mResOnPageH, 'array');
        return $HA;
    }

    /**
     * Clear all history
     * @return void
     */
    public function DeleteAll()
    {
        $this->mDbPtr->query('TRUNCATE '.$this->mTableH);

    }

}
?>