<?php
/**
 * Model Wire class 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
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
		 * ptype: 1  - blog*, 
                  2  - photo*, 
                  3  - message*, 
                  4  - gear*, 
                  5  - friend*, 
                  6  - jobs*
                  7  - live resume*
                  9  - blocks user*
                  10 - comment to profile
                  11 - comment to blog
		 * 
		 */

	    if (!$id)
		{
		    $sql = 'INSERT INTO '.$this -> mTbWire.' (uid, to_uid, fname, ptype, title, link, pdate, ext_id) 
		            VALUES (?, ?, ?, ?, ?, ?, '.mktime().', ?)';
	    	$this -> mDbPtr -> query($sql, $ar);
	    	$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');

            // Get notification settings for to_uid
            global $gUser, $gSmarty;
            if (!empty($gUser) && is_object($gUser))
            {
                if (in_array($ar[3], array(3,5,9,10,11)))
                {
                    $notifySet = $gUser -> GetNotifySettings($ar[1]);

                    if (0 == $notifySet['type']
                        && 
                        (
                            (3 == $ar[3] && $notifySet['message'])
                            ||
                            (5 == $ar[3] && $notifySet['contact_request'])
                            ||
                            (9 == $ar[3] && $notifySet['blocks_me'])
                            ||
                            ((10 == $ar[3] || 11 == $ar[3]) && $notifySet['comment'])
                        )
                        )
                    {
                        $uinfo = $gUser -> Get($ar[1]);
                        $wire  = $this -> GetWire($id);
                        $gSmarty -> assign('wire', $wire);

                        $content = $gSmarty -> fetch('mails/wire_item.html');
                        send_email2user($uinfo['email'], (1 == $uinfo['status'] ? $uinfo['name'] : $uinfo['company']).','.$ar[2].' '.$ar[4], $content);
                    }
                }
                elseif (in_array($ar[3], array(1,4,6,7)))
                {
                    $wire  = $this -> GetWire($id);
                    $gSmarty -> assign('wire', $wire);
                    $content = $gSmarty -> fetch('mails/wire_item.html');

                    $dbout = $this -> mDbPtr -> query('SELECT u.uid, u.email, u.status, u.company, u.lname, u.name, n.* 
                                                       FROM '.$this -> mTbUsers.'_friend uf, 
                                                            '.$this -> mTbUsers.'_notifications n, 
                                                            '.$this -> mTbUsers.' u
                                                       WHERE uf.uid = '.$ar[0].' 
                                                             AND uf.active = 1
                                                             AND n.uid = uf.friend_id
                                                             AND n.type = 0 AND (n.blog_entry = 1 OR n.new_gear = 1 OR n.new_job = 1 OR n.live_resume = 1)
                                                             AND u.uid = n.uid
                                                             AND u.active = 1');

                    while ($uinfo = $dbout -> fetchRow())
                    {
                        if ( (1 == $ar[3] && $uinfo['blog_entry'])
                             ||
                             (4 == $ar[3] && $uinfo['new_gear'])
                             ||
                             (6 == $ar[3] && $uinfo['new_job'])
                             ||
                             (7 == $ar[3] && $uinfo['live_resume'])
                           )
                        {
                           send_email2user($uinfo['email'], (1 == $uinfo['status'] ? $uinfo['name'] : $uinfo['company']).','.$ar[2].' '.$ar[4], $content);
                        }
                    }                    
                }
            }
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
                    pdate_upd = '.mktime().',
                    id     = ?
                    WHERE id = ?';
            $ar[] = $id;
            $this -> mDbPtr -> query($sql, $ar);			
		}
		return $id;
    }/** Edit */    

    public function SendDigest()
    {
        $dbout = $this -> mDbPtr -> query('SELECT n.*, u.email, u.status, u.name
                                           FROM '.$this -> mTbUsers.'_notifications n, 
                                                '.$this -> mTbUsers.' u
                                           WHERE n.type = 1
                                                 AND u.uid = n.uid
                                                 AND u.active = 1');

        while ($uinfo = $dbout -> fetchRow())
        {
            $friends = join(',', $this -> mDbPtr -> getCol('SELECT friend_id 
                                                            FROM '.$this -> mTbUsers.'_friend uf
                                                            WHERE uf.uid = '.$uinfo['uid'].' 
                                                                  AND uf.active = 1'));

            $dbout2 = $this -> mDbPtr -> query('SELECT * FROM '.$this -> mTbWire.' w
                                                WHERE w.pdate > '.(m_time() - 86400).' 
                                                      AND ((w.to_uid = '.$uinfo['uid'].' 
                                                          AND w.ptype IN (3,5,9,10,11))
                                                     '.($friends ? 'OR (w.to_uid = 0 
                                                                         AND w.ptype IN (1,4,6,7) 
                                                                         AND w.uid IN ('.$friends.') ) ) ' : ') ').' ORDER BY pdate DESC'
                                              );

            $wl = array();

            while ($wire = $dbout2 -> fetchRow())
            {
                if ( (1 == $wire['ptype'] && $uinfo['blog_entry'])
                     ||
                     (4 == $wire['ptype'] && $uinfo['new_gear'])
                     ||
                     (6 == $wire['ptype'] && $uinfo['new_job'])
                     ||
                     (7 == $wire['ptype'] && $uinfo['live_resume'])
                     ||
                     (3 == $wire['ptype'] && $uinfo['message'])
                     ||
                     (5 == $wire['ptype'] && $uinfo['contact_request'])
                     ||
                     (9 == $wire['ptype'] && $uinfo['blocks_me'])
                     ||
                     ((10 == $wire['ptype'] || 11 == $wire['ptype']) && $uinfo['comment'])
                   )
                {
                    $wire['mt']    = $wire['pdate'];
                    $wire['pdate'] = date('m/d/Y h:i a', $wire['pdate']);
                    $wl[] = $wire;
                }
            }

            if ($wl)
            {
                global $gSmarty;
                $gSmarty -> assign('wl', $wl);
                $content = $gSmarty -> fetch('mails/wire_digest.html');
                send_email2user($uinfo['email'], (1 == $uinfo['status'] ? $uinfo['name'] : $uinfo['company']).', wire digest '.date('m/d/Y'), $content);
            }
        }
    }
    
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
        $sql .= ' AND ( ( ptype IN (3,5,9,10,11) AND to_uid = '.(int)$uid.' )';
        
        if ($uf)
            $sql .= ' OR ( ptype IN (1,2,4,6,7) AND uid IN ('.$uf.') )';
        
        $sql .= ' )';
        $sql .= ' ORDER BY pdate DESC';
        
        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery( $sql, $first, $cnt );
        else
            $db  = $this -> mDbPtr -> query( $sql );	

        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $row['mt']    = $row['pdate'];
            $row['pdate'] = date("m/d/Y h:i a", $row['pdate']);
            $r[] = $row;
        }
        return $r;
    }/** GetList */
    
    public function GetWire($id)
    {
        $row  = $this -> mDbPtr -> getRow('SELECT * FROM '.$this -> mTbWire.' WHERE id = '.$id);
        if ($row)
        {
            $row['mt']    = $row['pdate'];
            $row['pdate'] = date("m/d/Y h:i a", $row['pdate']);
        }
        return $row;
    }

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
            $sql .= ' AND ((w.ptype IN (3,5,9,10,11) AND w.to_uid = '.(int)$uid.' )';
        elseif (3 == $ptype || 5 == $ptype)
            $sql .= ' AND ( w.ptype = '.$ptype.' AND w.to_uid = '.(int)$uid.' )';
        
        if ($uf)
        {
            if (!$ptype)
            {
                $sql .= ' OR ( w.ptype IN (1,2,4,6,7) AND w.uid IN ('.$uf.')  )';
            }
            elseif (1 == $ptype || 2 == $ptype || 4 == $ptype || 6 == $ptype || 7 == $ptype)
            {
                $sql .= ' AND ( w.ptype = '.$ptype.' AND  w.uid IN ('.$uf.')  )';
            }
        }
        elseif ((1 == $ptype || 2 == $ptype || 4 == $ptype || 6 == $ptype || 7 == $ptype) && !$uf)
        {
            $r = array();
            return $r;
        }
        
        if (!$ptype)
            $sql .= ' )';
        
        $sql .= ' ORDER BY w.pdate DESC';
        
        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery( $sql, $first, $cnt );
        else
            $db  = $this -> mDbPtr -> query( $sql );    

        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $row['pdate'] = date('m/d/Y h:i a', $row['pdate']);
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