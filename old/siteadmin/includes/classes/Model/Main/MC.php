<?php
/**
 * Simple interface, allowing to organize simple Message Center
 * By the current moment are supported:
 * paginal viewing, edit, delete
 * 
 * @package    engine37 Catalog v3.0
 * @version    0.1a
 * @since      04.04.2006
 * @copyright  2004-2008 engine37.com
 * @link       http://engine37.com
 */
class MC
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;

    /**
     * Messages count on each page
     * Set 0 if not paginal viewing is required
     * @var int
     */
    private $mResOnPage; 

    /**
     * Users class object
     * @var mixed
     */
    private $mUser; 


    /**
     * Allow tags in message body
     * @var string
     */
    private $mAllowTags = '<p><br><a><b><i><a>';
    /**
     * Database table for messages
     * @var string
     */
    private $mTable;

    /**
     * Users table
     * @var string
     */
    private $mTableUsers;

    /**
     * Constructor. Iniatilize base class variables
     *
     * @param mixed  $dbPtr     PEAR::DB pointer
     * @param string $table     database table for Users
     * @param string $table     Users database table for users
     * @param string $tags      allow tags in message body
     * @param mixed  $uid       Users class object
     * @param int    $resOnPage Messages count on each page
     *                          Set 0 if not paginal viewing is required
     *
     * @return void
     */
    public function __construct($dbPtr, $table = 'mc', $tableUsers = 'users', $tags = '', &$uid, $resOnPage = 20)
    {
        $this -> mDbPtr      =  $dbPtr;
        $this -> mTable      =  $table;
        $this -> mTableUsers =  $tableUsers;
        $this -> mAllowTags  =  $tags;
        $this -> mUser       =& $uid;
        $this -> mResOnPage  =  $resOnPage;

    }#end constructor

    public function ResOnPage()
    {
        return $this -> mResOnPage;

    }#ResOnPage


    /**
     * Mark message as readed
     * @param int   $id  message
     * @return void     (for errors detection use try-catch)
     */
    public function SetReaded($id, $toid)
    {
        $toid = intval($toid);
        $id   = intval($id);
        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET readed = 1
                              WHERE id='.$id.'
                                    AND toid='.$toid);
    }

    /**
     * Mark message as replied
     * @param int   $id  message
     * @return void     (for errors detection use try-catch)
     */
    public function SetReplied($id, $toid)
    {
        $toid = intval($toid);
        $id   = intval($id);
        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET replied = 1
                              WHERE id='.$id.'
                                    AND toid='.$toid);
    }

    /**
     * Add new message
     * @param int            $toid     correct user id
     * @param int            $fromid   correct user id
     * @param string         $subject  subject
     * @param string         $message  body
     * @param UNIX Timestamp $sendtime if 0 then current date
     * @param int            $type     message type: 0 - default, 
                                                     1 - kiss,
                                                     2 - friend request
     * @return int insert id (for errors detection use try-catch)
     */
    public function Add($toid, $fromid, $subject, $message, $sendtime = 0, $type = 0, $is_invite = 0)
    {
        $toid    = intval($toid);
        $fromid  = intval($fromid);
        $subject = strip_tags($subject, '');
        $message = strip_tags($message, $this -> mAllowTags);

        if (0 == $sendtime)
           $sendtime = date('Y-m-d H:i:s', m_time());

        $vals = array($subject, $message, (int)$is_invite);

        $this->mDbPtr->query('INSERT INTO '.$this -> mTable.'
                              (toid, fromid, sendtime, subject, message, is_invite) 
                              VALUES ('.$toid.',
                                      '.$fromid.',
                                      \''.$sendtime.'\',
                                       ?,?,?)', $vals);

        return $this->mDbPtr->getOne('SELECT LAST_INSERT_ID()');

    }#Add

    /**
     * Get messages list (this method supports paginal viewing and sorting)
     *
     * @param int    $uid       correct user id
     * @param int    $type      0 - inbox, 
                                1 - sent items,
                                2 - deleted items
                                3 - kisses
                                4 - friend requests
                                5 - pending friend request
     * @param string $pStart    page number, -1 - for no paginal viewing
     * @param string $order     ordering settings
     *
     * @return array
     */
    public function &GetAll($uid, $type = 0, $pStart = -1, $order = 0)
    {
        $uid = intval($uid);
        switch ($order)
        {
            case 1:   // by from ASC
                $OrderingStr = ' ORDER BY mu.name ASC, mu.lname ASC, mc.sendtime DESC';
                break;
            case 2:   // by from DESC
                $OrderingStr = ' ORDER BY mu.name DESC, mu.lname DESC, mc.sendtime DESC';
                break;
            case 3:   // by date ASC
                $OrderingStr = ' ORDER BY mc.sendtime ASC';
                break;
            case 4:   // by date DESC
                $OrderingStr = ' ORDER BY mc.sendtime DESC';
                break;
            case 5:
            case 6:
                $OrderingStr = '';
                break;
            /*case 5:   // by subject ASC
                $OrderingStr = ' ORDER BY mc.subject ASC, mc.sendtime DESC';
                break;
            case 6:   // by subject DESC
                $OrderingStr = ' ORDER BY mc.subject DESC, mc.sendtime DESC';
                break;*/
            default:
                $OrderingStr = ' ORDER BY mc.sendtime DESC';
                break;
        }
        
        $clause = '';
        if (0 == $type)
            $clause = 'mc.toid='.$uid.' AND mc.deleted_by_to=0 AND mc.status=1 AND mu.uid=mc.fromid';
        elseif (1 == $type)
            $clause = 'mc.fromid='.$uid.' AND mc.deleted_by_from=0 AND mc.type=0 AND mu.uid=mc.toid';
        elseif (2 == $type)
            $clause = '(mc.toid='.$uid.' AND mc.deleted_by_to=1 AND mc.status=1 AND mu.uid=mc.fromid) OR (mc.fromid='.$uid.' AND mc.deleted_by_from=1 AND mc.type=0 AND mu.uid=mc.toid)';

        $PVStr  = '';
        if ($this -> mResOnPage > 0 && $pStart > -1 && ($order != 5 && $order != 6) )
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $sql = 'SELECT mc.id, mc.toid, mc.fromid, mc.sendtime, mc.is_invite,
                       mc.subject, mc.message, mc.status, mc.readed,
                       mc.replied, 
                       mu.uid, mu.name, mu.lname, mu.company, mu.status, mu.person_title, mu.image, mu.subdir
                FROM '.$this -> mTable.' mc, '.$this ->mTableUsers.' mu
                WHERE '.$clause.
                $OrderingStr.
                $PVStr;

        $dbout = $this->mDbPtr->query($sql);
        $MA = array(); // (M)essage (A)rray
        while ($row = $dbout -> fetchRow())
        {
            #$row['user_images'] =& $this -> mUser-> GetUserPic($row['uid']);
            $MA[] = $row;
        }

        if ($order == 5 || $order == 6)
        {
            function sortMessBox($a, $b)
                {
                 global $order;
                 $a['subject'] = trim(preg_replace('|Re\[\d+?\]:|i', '', $a['subject']));
                 $a['subject'] = trim(preg_replace('|Re:|i'        , '', $a['subject']));
                 $b['subject'] = trim(preg_replace('|Re\[\d+?\]:|i', '', $b['subject']));
                 $b['subject'] = trim(preg_replace('|Re:|i'        , '', $b['subject']));
                 if ($order == 5) 
                    return strnatcasecmp($a['subject'], $b['subject']);
                  else
                    return strnatcasecmp($b['subject'], $a['subject']);
            }
            usort($MA, 'sortMessBox');
            $MA = array_slice($MA, $pStart, $this -> mResOnPage);
        }
        return $MA;

     }#GetAll

    /**
     * Get messages count (for paginal viewing and other operations)
     * @param int    $uid       correct user id
     * @param int    $type      0 - inbox, 1 - sent items, 2 - deleted items
     * @return int
     */
    public function Count($uid, $type = 0)
    {
        $clause = '';
        $vals = array();

        if (0 == $type)
        {
            $clause = 'mc.toid             = '.$uid.'
                   AND mc.deleted_by_to    = 0 
                   AND mc.status           = 1 
                   AND mu.uid              = mc.fromid';
        }
        elseif (1 == $type)
        {
            $clause = 'mc.fromid           = '.$uid.'
                   AND mc.deleted_by_from  = 0 
                   AND mu.uid              = mc.toid';
        }
        else
        {
            $clause = '(mc.toid            = '.$uid.'
                    AND mc.deleted_by_to   = 1 
                    AND mc.status          = 1 
                    AND mu.uid              = mc.fromid
                       )
                   OR 
                       (
                        mc.fromid          = '.$uid.'
                    AND mc.deleted_by_from = 1 
                    AND mu.uid              = mc.toid
                       )';
        }

        $sql = 'SELECT COUNT(*)
                FROM '.$this -> mTable.' mc, '.$this ->mTableUsers.' mu 
                WHERE '.$clause;

        return $this->mDbPtr->getOne($sql);
    }#Count

    public function CountNotReaded($uid)
    {
        $clause = '';
        $vals = array();

        $clause = 'mc.toid             = '.$uid.'
               AND mc.deleted_by_to    = 0 
               AND mc.status           = 1 
               AND mc.readed           = 0
               AND mu.uid              = mc.fromid';

        $sql = 'SELECT COUNT(*)
                FROM '.$this -> mTable.' mc, '.$this ->mTableUsers.' mu 
                WHERE '.$clause;

        return $this->mDbPtr->getOne($sql);
    }#CountNotReaded

    /**
     * Get full message info
     * @param int $id  message id
     * @param int $uid user id
     * @return array
     */
    public function &Get($id, $uid)
    {
        $id  = intval($id);
        $uid = intval($uid);

        $dbout = $this->mDbPtr->query('SELECT
                                       mc.id, mc.toid, mc.fromid, mc.sendtime,
                                       mc.subject, mc.message, mc.readed, 
                                       mc.replied, mc.deleted_by_to, 
                                       mc.deleted_by_from, 
                                       mu.uid, mu.name, mu.lname, mu.status, mu.company, mu.person_title, mu.image, mu.subdir
                                       FROM '.$this -> mTable.' mc,
                                            '.$this -> mTableUsers.' mu
                                       WHERE mc.id='.$id.' 
                                             AND ( ( mc.toid='.$uid.'
                                                     AND mc.deleted_by_to<2
                                                     AND mc.status=1
                                                     AND mu.uid = mc.fromid)
                                                 OR (mc.fromid='.$uid.'
                                                     AND mc.deleted_by_from<2
                                                     AND mu.uid=mc.toid) ) ');
        if ($dbout -> numRows() < 1)
           throw new MCException(2);

        $row   = $dbout -> fetchRow();

        #$row['user_images'] =& $this -> mUser-> GetUserPic($row['uid']);

        return $row;

    }#Get


    /**
     * Intellectual removal of the message with specified id
     * @param int $id  message id
     * @param int $uid correct user id
     * @return void
     */
    public function Delete($id, $uid)
    {
        $id  = intval($id);
        $uid = intval($uid);

        $row =& $this->mDbPtr->getRow('SELECT id, toid, fromid,
                                              deleted_by_to, deleted_by_from
                                       FROM '.$this->mTable.'
                                       WHERE id='.$id);

        // 0 (not deleted) -> 1 (deleted logical) -> 2 (deleted from DB)
        if ($row)
        {
            if ($uid == $row['toid']) // delete from inbox
            {
                if (0 == $row['deleted_by_to']) // if not deleted then mark 'deleted'
                {
                    $this->mDbPtr->query('UPDATE '.$this->mTable.'
                                          SET deleted_by_to = 1
                                          WHERE id = '.$id);
                }
                elseif (1 == $row['deleted_by_to'])
                {
                    if (2 == $row['deleted_by_from'])
                        $this->mDbPtr->query('DELETE FROM '.$this->mTable.'
                                              WHERE id = '.$id);
                    else
                        $this->mDbPtr->query('UPDATE '.$this->mTable.'
                                              SET deleted_by_to = 2
                                              WHERE id = '.$id);
                }
                else
                    throw new MCException(2);
            }
            elseif ($uid == $row['fromid']) // delete from sent items
            {
                if (0 == $row['deleted_by_from'])
                {
                    $this->mDbPtr->query('UPDATE '.$this->mTable.'
                                          SET deleted_by_from = 1
                                          WHERE id = '.$id);
                }
                elseif (1 == $row['deleted_by_from'])
                {
                    if (1 == $row['deleted_by_to'])
                        $this->mDbPtr->query('DELETE FROM '.$this->mTable.'
                                              WHERE id = '.$id);
                    else
                        $this->mDbPtr->query('UPDATE '.$this->mTable.'
                                              SET deleted_by_from = 2
                                              WHERE id = '.$id);
                }
                else
                    throw new MCException(2);
            }
            else
                throw new MCException(1);

        }
        else
            throw new MCException(2);

    }#Delete

    /**
     * Update Invite Mail to standart mail
     * @param int $friend_id - friend ID
     * @param int $uid - user ID
     * 
     * @return bool true
     */
    public function UpdateInviteMail( $friend_id, $uid )
    {
        $sql = 'UPDATE '.$this -> mTable.' SET is_invite = 0 WHERE is_invite = ? AND toid = ?';
        $this -> mDbPtr -> query($sql, array($friend_id, $uid));
        return true;
    }/** UpdateInviteMail */
    
}#end class

/**
 * Define a Message Center exception class
 */
class MCException extends Exception
{
    public function __construct($code)
    {
        parent::__construct(null, $code);

    }#end constructor

}#end class

?>