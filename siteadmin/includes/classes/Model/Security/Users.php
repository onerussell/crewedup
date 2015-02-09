<?php
/**
 * Users Class
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

class Users
{
    public $LastError = 0; // Last Error Code
    public $ResOnPage = 0; // = 0 if not paginal viewing is required

    private $AccessRightsLevels = array('0' => 'Administrator',
                                        '1' => 'Manager',
                                        '2' => 'Crew Member',
                                        '3' => 'Employer',
                                        );
                                       // general rule: 
                                       //   more value of a level, 
                                      //   is user is more limited

    /**
     * Table with users
     *
     * @var string
     */
    private $mTbUsers = 'users';     
    
    /**
     * Table with user friends
     * 
     * @var string
     */
    private $mTbFriend;
    
    /**
     * Table with members categories
     * 
     * @var string
     */
    private $mTbMembersCat;
    
    /**
     * Table with blocked users
     * 
     * @var string
     */
    private $mTbUsersBlock;    
    
    /**
     * Database pointer
     *
     * @var pointer
     */
    private $mDbPtr;
    
    /**
     * Crypt pointer
     * 
     * @var pointer
     */
    private $mRc4;
        
    
    public function __construct($dbPtr, $table, $resOnPage = 0, &$rc4)
    {
        $this -> mTbUsers  = $table['table'];     
        $this -> ResOnPage = $resOnPage;
        $this -> mDbPtr    = $dbPtr;

        if (isset($table['friend']))
            $this -> mTbFriend     = $table['friend'];  

        if (isset($table['members_cat']))
            $this -> mTbMembersCat = $table['members_cat'];       

        if (isset($table['users_block']))
            $this -> mTbUsersBlock = $table['users_block'];       
        
        $this -> mRc4 =& $rc4;         
    }/** constructor */


    /**
     * get user info by ID
     * @param int $uid
     * @return array with user info
     */
    public function &Get($uid)
    {
         $sql = 'SELECT *, 
                 DATE_FORMAT(dob, "%m") AS dob_month, 
                 DATE_FORMAT(dob, "%d") AS dob_day,
                 DATE_FORMAT(dob, "%Y") AS dob_year
                 FROM '.$this -> mTbUsers.'
                 WHERE uid = ? AND is_deleted = 0';
         $db  = $this -> mDbPtr -> query($sql, array($uid));
         $r   = array();
         if ($row = $db -> FetchRow())
         {
             $row['image'] =  ($row['image']) ? $row['subdir'].$row['image'] : '';
             $row['age'] = ('0000-00-00' != $row['dob']) ? floor((mktime() - strtotime($row['dob']))/31536000) : '';

             $row['mt']     = $row['dt']; 
             $row['dt']     = (!empty($row['dt'])) ? date("m/d/Y", $row['dt']) : ''; 
             $row['llogin'] = (!empty($row['last_login'])) ? date("m/d/Y", $row['last_login']) : '';  
             $r = $row;
         }
         return $r;
    }#Get
    
    /**
     * Get User Low Info
     *
     * @param int $uid
     * @return array with user info
     */
    public function &GetLowInfo($uid = 0)    
    {
         $sql = 'SELECT email, name, lname FROM '.$this -> mTbUsers.' WHERE uid = ?';
         $db  = $this -> mDbPtr -> query($sql, array($uid));
         $r   = array();
         if ($row = $db -> FetchRow())
             $r = $row;
         return $r;
    }#GetLowInfo

    public function GetNotifySettings($uid)
    {
        return $this -> mDbPtr -> getRow('SELECT * FROM '.$this -> mTbUsers.'_notifications WHERE uid = '.$uid);
    }
    
    public function UpdateNotifySettings($uid, $NI)
    {
        $cols = array('type','announcement', 'message','comment','contact_request','blocks_me','new_job','new_gear','live_resume','blog_entry');
        $cnt  = count($cols);

        $vals_s = '?';
        $vals_a = array($uid);
        for ($i = 0; $i < $cnt; $i++)
        {
            $vals_s .= ',?';
            $vals_a[] = !empty($NI[$cols[$i]]) ? 1 : 0; 
        }

        $this -> mDbPtr -> query('REPLACE INTO '.$this -> mTbUsers.'_notifications 
                                  (uid, '.join(',', $cols).')
                                  VALUES ('.$vals_s.')', $vals_a);
    }
    
    /**
     * Get user ID by email
     *
     * @param string $email
     * @return int User ID
     */     
    function GetByEmail($email)
    {
         $sql = 'SELECT uid 
                 FROM '.$this -> mTbUsers.' 
                 WHERE email = ?';
         $db  = $this -> mDbPtr -> query($sql, array($email));
         $r   = 0;
         if ($row = $db -> FetchRow())
         {
             $r = $row['uid'];
         }
         return $r;
    }#GetByEmail

    
    /**
     * Check email unique
     * @param string email
     * @param int uid - check UID
     * @return bool true (mail exist) or false
     */
    public function CheckEmail($email = '', $uid = 0)
    {
        $sql = 'SELECT 1 FROM '.$this -> mTbUsers.' 
                WHERE email = ?'.($uid ? ' AND uid <> '.(int)$uid : '').' AND is_deleted = 0';

        if ($this -> mDbPtr -> getOne($sql, $email))
            return true;
        else 
            return false;     
    }#CheckEmail
    
    
    /**
     * Add User
     * @param $ar array with data
     * @return int - new user ID
     */
    public function Add($ar = array())
    {
        $errs = array();
        $this -> mRc4 -> crypt($ar['pass']);
        
        if (!empty($ar['dob_day']) && !empty($ar['dob_month']) && !empty($ar['dob_year']))
        	$ar['dob'] = $ar['dob_year'].'-'.$ar['dob_month'].'-'.$ar['dob_day'];
        else
        	$ar['dob'] = '0000-00-00';
        
        $bx = array(
                    $ar['pass'], 
                    $ar['name'], 
                    $ar['email'],
                    $ar['status']
                   );          
        $da  = array('address', 'suite', 'city', 'state', 'zip', 'dob', 'gender', 'company', 'phone', 'fax', 'person_title', 'cperson_title', 'lname', 'prof1');
        $stq = '';
        $stv = '';
        for ($i = 0; $i < count($da); $i++)
        {
        	$stq .= ', '.$da[$i];
        	$stv .= ', ?';
        	$bx[] = (!empty($ar[$da[$i]])) ? $ar[$da[$i]] : '';
        }
        

        $this -> mDbPtr -> query('INSERT INTO '.$this -> mTbUsers.' (pass, name, email, status'.$stq.', dt)
                                  VALUES(?, ?, ?, ?'.$stv.', '.mktime().')', $bx); 
        
        $id = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');

        $this -> mDbPtr -> query('INSERT INTO '.$this -> mTbUsers.'_notifications (uid) VALUES ('.$id.')');
       
        return $id;  
    }/** Add */
    
    
    /**
     * Change user status
     *
     * @param int   $uid user id
     * @param array $status new status value
     *
     * @return void
     */
    public function ChangeStatus($uid, $status)
    {
        $sql =   'UPDATE '.$this -> mTbUsers.' 
                  SET status=? 
                  WHERE uid=?';
        $this -> mDbPtr -> query($sql, array($status, $uid));
    }#ChangeStatus

    
    public function UpdView( $uid )
    {
        $sql = 'UPDATE '.$this -> mTbUsers.' SET view_cnt = view_cnt + 1 WHERE uid = ?';
        $this -> mDbPtr -> query($sql, $uid);
        return true;
    }/** UpdView */
    
    
    /**
     * Change one table field ('active' for example)
     *
     * @return true or false
     */
    public function ChgField($fld = '', $val = '', $uid = 0, $nc = 0)
    {
        if (0 == $uid || !is_numeric($uid) || '' == $fld)
            return false;

        $sql = 'UPDATE '.$this -> mTbUsers.' SET '.$fld.' = '.((1 == $nc) ? $val : '"'.$val.'"').' WHERE uid = ?';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        return true;    
    }#ChgField
    
    
    public function Delete($uid)
    {
        $ci =& $this -> Get($uid);
        if (0 < count($ci))
        {
            $sql = 'DELETE FROM '.$this -> mTbUsers.' WHERE uid=?';
            $this -> mDbPtr -> query($sql, array($uid));
            return true;
        }
        else 
            return false;    
    }#Delete
    
    
    
    public function Change($uid, &$ar)
    {
        if (!empty($ar['dob_day']) && !empty($ar['dob_month']) && !empty($ar['dob_year']))
        	$ar['dob'] = $ar['dob_year'].'-'.$ar['dob_month'].'-'.$ar['dob_day'];
        else
        	$ar['dob'] = '0000-00-00';

        if (0 < strlen($ar['pass']))
            $this -> mRc4 -> crypt($ar['pass']);           
                 
        $bx = array(
                    $ar['name'], 
                    $ar['email'],
                    $ar['status']                  
                   );         

        $da  = array('address', 'suite', 'city', 'state', 'zip', 'dob', 'gender', 'company', 'phone', 'fax', 'lname', 'cperson_title', 'no_age');
        $stq = '';
        $stv = '';
        for ($i = 0; $i < count($da); $i++)
        {
        	$stq .= ', '.$da[$i].' = ?';
        	$bx[] = (!empty($ar[$da[$i]])) ? $ar[$da[$i]] : '';
        }                   
        $bx[] = $uid;   
                
        $sql = 'UPDATE ' . $this -> mTbUsers . ' SET '.
                ((0 < strlen($ar['pass'])) ? 'pass=\''.$ar['pass'].'\', ' : '').'
                name      = ?,
                email     = ?,
                status    = ?,
                checksum  = ""
                '.$stq.'
                WHERE uid = ?';
        $this -> mDbPtr -> query($sql, $bx);          
        return true;
    }#Change

    
    /**
     * Save Profile
     * @param int $uid - user ID
     * @param array $ar - array with fields
     * 
     * @return bool true
     */
    public function SaveProfile($uid, $ar = array(), $image = '')
    {
        
        $da  = array('title', 'about_me', 'interests', 'prof1', 'prof2', 'prof3', 'person_title', 'public_mail');
        $stq = '';
        $stv = '';
        for ($i = 0; $i < count($da); $i++)
        {
        	$stq .= ($stq ? ', ' : '').$da[$i].' = ?';
            if (in_array($da[$i], array('title', 'about_me', 'interests')))
            	$bx[] = (!empty($ar[$da[$i]])) ? strip_tags($ar[$da[$i]], '<span><p><b><i><u><div><strong><small>') : '';
            else
            	$bx[] = (!empty($ar[$da[$i]])) ? strip_tags($ar[$da[$i]]) : '';
        }                   

        $bx[] = $uid;

        $sql = 'UPDATE '.$this -> mTbUsers.' SET '.$stq.' WHERE uid = ?';
        $this -> mDbPtr -> query($sql, $bx);
        
        if ($image)
        {
            $sql = ' UPDATE '.$this -> mTbUsers.' SET image = ?, subdir = ? WHERE uid = ?';
            $this -> mDbPtr -> query($sql, array($image, DIR_NAME_IMAGE_SUBDIR."/", $uid));
        }

        require_once CLASS_PATH.'Model/Main/Model_Main_Dict.php';
        $oDict = new Model_Main_Dict($this -> mDbPtr);
        if (!empty($ar['prof1']))
            $oDict -> CheckAndUpdate(DICT_JOBS, $ar['prof1']);
        if (!empty($ar['prof2']))
            $oDict -> CheckAndUpdate(DICT_JOBS, $ar['prof2']);
        if (!empty($ar['prof3']))
            $oDict -> CheckAndUpdate(DICT_JOBS, $ar['prof3']);
        
        return true;
    }/** SaveProfile */
    
    
    /**
     * Get elemnts count
     *
     * @param int $status - if == -1 - select all, else with status == $status 
     * @return unknown
     */
    public function Count($status = -1, $active  = -1, $state = '', $city = '', $prof = 0, $letter = '')
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM '.$this -> mTbUsers.' WHERE is_deleted = 0';
        $ar  = array();
        
        if (0 <= $status)
        { 
           $sql .= ' AND status = ?';
           $ar[] = $status; 
        }

        if (-1 != $active)
        {
            $sql  .= ' AND active = ?';
            $ar[] = (int)$active;
        }
        
        if ($state)
        {
            $sql .= ' AND state = ?';
            $ar[] = $state;
        }

        if ($city)
        {
            $sql .= ' AND LOWER(city) = ?';
            $ar[] = strtolower( $city );
        } 

        if ($prof)
        {
            $sql .= ' AND ( prof1 = ? OR prof2 = ? OR prof3 = ?)';
            $ar[] = $prof;   
            $ar[] = $prof;   
            $ar[] = $prof;            
        }      

        if ($letter)
            $sql .= ' AND LOWER(name) LIKE "'.strtolower( $letter ).'%"';    
        
        $db  = $this -> mDbPtr -> query($sql, $ar);

        $r   = array();
        if ($row = $db -> FetchRow())
            $r = $row;

        return $row['cnt'];
        
    }/** Count */ 

    
    /**
     * Get list of users 
     *
     * @param int $active - 1 - only active, -1 - all, 0- not active
     * @param int $status - users status
     * @param string $sort  - order by $sort
     * @param int $first - first element (for limit)
     * @param int $cnt - count of elements (for limit)
     * @param int $with_admin - if == 1 - select administrators too (for select "by status")
     * @return array with values
     */
    public function &GetUserList($active = 1, $status = -1, $sort = '', $first = 0, $cnt = 0, $with_admin = 0, $state = '', $city = '', $prof = 0, $letter = '', $featured = 0, $image = '')
    {
        $sql = 'SELECT u.* FROM '.$this -> mTbUsers.' u WHERE 1';
        $ar  = array();
         
        if ('' != $image)
            {
            $sql .= ' AND NOT image = "" ';
            }
        
        if (1 == $active || 0 == $active)
        {      
            $sql  .=  ' AND u.active = ?'; 
            $ar[]  =  $active;    
        }
        
        if (0 <= $status && 4 >= $status)
            $sql .= ' AND (u.status = '.$status.($with_admin ? ' OR u.status = 0' : '').')';
        elseif (-2 == $status)
            $sql .= ' AND u.status <> 0';

        if (!empty($state))
        {
            $sql .= ' AND u.state = ?';
            $ar[] = $state;
        }

        if (!empty($city))
        {
            $sql .= ' AND LOWER(u.city) = ?';
            $ar[] = strtolower( $city );
        } 

        if (!empty($prof))
        {
            $sql .= ' AND ( u.prof1 = ? OR u.prof2 = ? OR u.prof3 = ?)';
            $ar[] = $prof;   
            $ar[] = $prof;   
            $ar[] = $prof;            
        } 

        if (!empty($letter))
            $sql .= ' AND LOWER(u.name) LIKE "'.strtolower( $letter ).'%"';    

        if (!empty($featured))
            $sql .= ' AND featured = 1';
            
        
        
        $sql .= ('' == $sort) ? ' ORDER BY u.name, u.lname, u.uid' : ' ORDER BY '.$sort;

        if (0 < $cnt)
            $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, $ar);
        else 
            $db = $this -> mDbPtr -> query($sql, $ar);

        $r = array();
        while ($row = $db -> FetchRow())
        {
            $row['age'] = ('0000-00-00' != $row['dob']) ? floor((mktime() - strtotime($row['dob']))/31536000) : ''; 
            $row['mt']  = $row['dt']; 
            $row['dt']  = (!empty($row['dt'])) ? date("m/d/Y", $row['dt']) : ''; 
            $r[] = $row;
        }
        return $r;              
    }#GetUserList
    
    
    public function &SearchUser( $sstr, $status = 1, $first = 0, $cnt = 0)
    {
        $sql = 'SELECT DISTINCT u.uid, u.name, u.lname, u.email, u.dob, u.image, 
                       u.subdir, u.status, u.company, u.person_title , u.active
                FROM '.$this -> mTbUsers.' u LEFT JOIN '.TB.'resume r ON r.uid = u.uid
                WHERE 1 ';
        
        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sa[$i] = str_replace( '"', '', $sa[$i] );
                $sa[$i] = str_replace( "'", '', $sa[$i] );
                $sa[$i] = mysql_escape_string( $sa[$i] );
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(u.name) LIKE "%'.$sa[$i].'%" OR LOWER(u.lname) LIKE "%'.$sa[$i].'%" OR LOWER(u.person_title) LIKE "%'.$sa[$i].'%" OR LOWER(u.company) LIKE "%'.$sa[$i].'%" OR LOWER(r.title) LIKE "%'.$sa[$i].'%" OR LOWER(r.company) LIKE "%'.$sa[$i].'%" ';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }
        
        if ( 1 == $status || 2 ==  $status )
            $sql .= ' AND u.status = '.(int)$status;

        $r = array();
        $db = $this -> mDbPtr -> query($sql);
        while ($row = $db -> FetchRow())
        {
            $row['age'] = ('0000-00-00' != $row['dob']) ? floor((mktime() - strtotime($row['dob']))/31536000) : ''; 
            $r[] = $row;
        }
        return $r;
    }/**SearchUser */
    
    
    public function SearchUserCount($sstr, $status = 1)
    {
        $sql = 'SELECT COUNT(DISTINCT u.uid) 
                FROM '.$this -> mTbUsers.' u LEFT JOIN '.TB.'resume r ON r.uid = u.uid
                WHERE 1 ';
        
        if ($sstr)
        {
            $sstr = strtolower(trim($sstr));
            $sa   = explode(' ', $sstr); 
            $sq   = '';
            for ($i = 0; $i < count($sa); $i++)
            {
                $sa[$i] = str_replace( '"', '', $sa[$i] );
                $sa[$i] = str_replace( "'", '', $sa[$i] );
                $sa[$i] = mysql_escape_string( $sa[$i] );
                $sq .= ($sq ? ') '.SEARCH_TYPE.' (' : '') . 'LOWER(u.name) LIKE "%'.$sa[$i].'%" OR LOWER(u.lname) LIKE "%'.$sa[$i].'%" OR LOWER(u.person_title) LIKE "%'.$sa[$i].'%" OR LOWER(u.company) LIKE "%'.$sa[$i].'%" OR LOWER(r.title) LIKE "%'.$sa[$i].'%" OR LOWER(r.company) LIKE "%'.$sa[$i].'%" ';  
            }
            $sql .= $sq ? ' AND ('.$sq.')' : '';
        }
        
        if ( 1 == $status || 2 ==  $status )
            $sql .= ' AND status = '.(int)$status;

        return $this -> mDbPtr -> getOne($sql);
    }/** SearchUserCount */
    
    
    /**
     * Check current administrator session or make session
     *
     * $module string access admin module
     * $mainpart - if  == 1  - it's main part of the Site (show all modules)
     *
     * @return int 0 on success session. 1 if specified email and password is correct. 2 on bad session. 3 on bad email or password
     */
    public function CheckLogin($module, $mainpart = 0)
    {
        if (!empty($_REQUEST['cl']) && !empty($_REQUEST['uid']) && is_numeric($_REQUEST['uid']))
        {
            $sql = 'SELECT * FROM '.$this -> mTbUsers.' WHERE checklogin = ? AND uid = ?';
            $r   = $this -> mDbPtr -> getRow($sql, array($_REQUEST['cl'], $_REQUEST['uid']));
            if (!empty($r))
            {
                $this -> Logout();
                $_POST['system_login'] = $r['email'];
                $this -> mRc4 -> crypt($r['pass']);
                $_POST['system_pass']  = $r['pass'];
                $sql = 'UPDATE '.$this -> mTbUsers.' SET checklogin = ? WHERE uid = ?';
                $this -> mDbPtr -> query($sql, array('', $_REQUEST['uid']));
            }   
        }
        
        if (preg_match(':/([^/]+\.[^/]+)$:', $module, $matches))
            $module = $matches[1];

        if (empty($_SESSION['system_uid']) 
            || empty($_SESSION['system_login']) 
            || empty($_SESSION['system_session']) 
            || !isset($_SESSION['system_status']) 
            || (0 < $_SESSION['system_status'] && empty($_SESSION['system_modules']) && 0 == $mainpart)
           )
        {

            $_SESSION['system_uid']     = 0;
            $_SESSION['system_login']   = '';
            $_SESSION['system_session'] = '';
            $_SESSION['system_status']  = 0;
            $_SESSION['system_modules'] = '';
    
            $wlogin = 0;
            if (isset($_COOKIE['checksum']) && isset($_COOKIE['login']))
            {
            	$sql = 'SELECT uid, pass, status, modules, active, email, company FROM '.$this -> mTbUsers.' 
            	        WHERE email = ? AND checksum = ? AND active = 1';
                $dbout = $this -> mDbPtr -> query($sql, array($_COOKIE['login'], $_COOKIE['checksum']));
                if ($dbout -> NumRows())
                    $wlogin = 1;	
            }   

                       
            if ((!empty($_POST['system_login']) 
                && !empty($_POST['system_pass'])) || $wlogin)
            {
               
                if (!$wlogin)
                {
                    $sql = 'SELECT uid, pass, status, modules, active, email, company 
                        FROM '.$this -> mTbUsers.'
                        WHERE email = ?
                        AND status <= 4
                        AND is_deleted = 0 AND active = 1';
                    $dbout = $this -> mDbPtr -> query($sql, array($_POST['system_login']));
                }

                if (0 == $dbout -> NumRows())
                    return 3;

                $row = $dbout -> FetchRow();
                $this -> mRc4 -> crypt($_POST['system_pass']); 

                if ($wlogin || (isset($_POST['system_pass']) && $_POST['system_pass'] == $row['pass']
                    && (0 == $row['status'] || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1))
                   )
                {
                    $_SESSION['system_uid']     = $row['uid'];
                    $_SESSION['system_login']   = $row['email'];
                    $_SESSION['system_session'] = md5('pLmz2a4'.$row['email'].'pN5'.$row['status'].'1ghO7dNm4s'.$row['pass'].'KxJxnz');
                    $_SESSION['system_status']  = $row['status'];
                    $_SESSION['system_modules'] = $row['modules'];
                    $_SESSION['system_company'] = $row['company'];

                    if ((isset($_POST['remember']) && 1 == $_POST['remember']) || $wlogin)
                    {
                        // Save checksum for Autologin 
                    	$checksum = md5(rand(111111, 999999).$row['email'].'tu3'.$row['status'].'qx8'.mktime().$row['pass']);
                        $sql       = 'UPDATE '.$this -> mTbUsers.' SET checksum = ? WHERE uid = ?';
                        $this -> mDbPtr -> query($sql, array($checksum, $row['uid']));
                        
                        setcookie('checksum', $checksum, mktime() + 31536000, null, '.'.DOMEN); 
                        setcookie('login', $_SESSION['system_login'], mktime() + 31536000, null, '.'.DOMEN);   
                    }  
                    
                    /** Update last_login */
                    $sql = 'UPDATE '.$this ->mTbUsers.' SET last_login = '.mktime().' WHERE uid = ?';
                    $this -> mDbPtr -> query($sql, array($row['uid']));
                                     
                    return 1;
                }
                else
                    return 3;
            }
            else
                return 2;
        }
        else
        {

            $sql = 'SELECT uid, pass, status, modules,company FROM '.$this -> mTbUsers.'
                    WHERE email = ? AND status <= 4 AND is_deleted = 0 AND active = 1';
            $dbout = $this -> mDbPtr -> query($sql, array($_SESSION['system_login']));

            if (0 == $dbout -> NumRows())
               return 2;

            $row = $dbout -> fetchRow();
            // Generate check value
            $compValue = md5('pLmz2a4'.$_SESSION['system_login'].'pN5'.$row['status'].'1ghO7dNm4s'.$row['pass'].'KxJxnz');

            if ($_SESSION['system_session'] == $compValue
                && (0 == $row['status']  || $mainpart == 1)
               )
            {   
                $_SESSION['system_company'] = $row['company'];
                /** Update last_login */
                $sql = 'UPDATE '.$this ->mTbUsers.' SET last_login = '.mktime().' WHERE uid = ?';
                $this -> mDbPtr -> query($sql, array($row['uid']));
                
                return 0;
            }    
            else
                return 2;
        }
    }#CheckLogin
    
    
    public function CheckAuthData( $email, $pass )
    {

        $sql = 'SELECT uid, pass, status, modules, active, email 
                FROM '.$this -> mTbUsers.'
                WHERE email = ?
                AND status <= 4
                AND is_deleted = 0';
        $dbout = $this -> mDbPtr -> query($sql, array($email));
        if (0 == $dbout -> NumRows())
            return 0;

        $row = $dbout -> FetchRow();
        $this -> mRc4 -> crypt($pass); 

        if ( $pass && $pass == $row['pass'] )
            return $row['uid'];

        return 0;
    }/** CheckAuthData */
    
    
    /**
     * Logout method
     *
     * @return false
     */
    public function Logout()
    {
         unset($_SESSION['system_uid']);
         unset($_SESSION['system_login']);
         unset($_SESSION['system_session']);
         unset($_SESSION['system_status']);
         unset($_SESSION['system_modules']);
         
         setcookie('checksum', '',0, null, '.'.DOMEN); 
         setcookie('login', '', 0, null, '.'.DOMEN);         
         return true;
    }#Logout
    
    
    /**
     * Restore user password
     * @param int $uid user id
     * @param string $email user email
     * @return string new password
     */
    public function RestorePassword($uid, $email)
    {
        $sql     = 'SELECT pass FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $r       = $this -> mDbPtr -> getOne($sql, $uid);
        if (!empty($r))
        {
            $this -> mRc4 -> decrypt($r);
            $newPass = $r;
        }
        else
        {
            $newPass = substr(uni_id2($uid.$email),0,8);
            $data    = array();
            $this -> mRc4 -> crypt($newPass);
            $this -> mDbPtr -> query('UPDATE '.$this -> mTbUsers.'
                                  SET pass = "'.$newPass.'"
                                  WHERE uid = ?', $uid);    
        }
        return $newPass; 

    }#RestorePassword
    
    
    /**
     * Email validate method
     *
     * @param string $email
     * @return bool true or false
     */
    public function EmailValidate ($email)
    {
        if (preg_match("/([[:alnum:]\.\-]+)(\@[[:alnum:]\.\-]+\.+)/", $email)) 
            return true;
        else 
            return false;
    }#EmailValidate 
    
    /**
     * Add photo to user
     *
     * @param string $image
     * @param int $id - user ID
     * @return bool true
     */
    public function AddPhoto($image, $id)
    {
    	$sql = 'UPDATE '.$this -> mTbUsers.' SET image = ? WHERE uid = ?';
    	$this -> mDbPtr -> query($sql, array($image, $id));
    	return true;
    }#AddPhoto

    
    public function ChgFeatured($uid, $val)
    {
        $sql = 'UPDATE '.$this -> mTbUsers.' SET featured = ? WHERE uid = ?';
        $this -> mDbPtr -> query($sql, array($val, $uid));
        return true;
    }/** ChgFeatured */

    
    public function &GetAll($pStart = 0, $ordercol = 'email', $orderdesc = 'asc') // $pStart for paginal viewing
    {
        $OrderingStr = ' ORDER BY '.$ordercol.' '.StrToUpper($orderdesc);
        
        $PVStr = '';
        if ($this->ResOnPage > 0)
            $PVStr = ' LIMIT '.$pStart.','.$this->ResOnPage;

        $sql = 'SELECT uid, name, lname, email, status, modules, company, featured, active
                FROM '.$this -> mTbUsers.''.$OrderingStr.$PVStr;

        $dbout = $this -> mDbPtr -> query($sql);
        $UA = array(); // (U)sers (A)rray
        while ($row = $dbout -> FetchRow())
        {
            $row['modules_arr'] = join(', ',preg_split('/;/', $row['modules'], -1, PREG_SPLIT_NO_EMPTY));
            $UA[] = $row;
        }
        return $UA;
    }
        
    /**
     * Delete User photo
     * @param int $id - user ID
     * @return bool - true (ok) or false (no photo)
     */
    public function DelPhoto($id)
    {
    	$sql = 'SELECT image, subdir FROM '.$this -> mTbUsers.' WHERE uid = ?';
    	$row   = $this -> mDbPtr -> getRow($sql, array($id));
    	if (!empty($row['image']))
    	{
    	    $row['image'] =  $row['subdir'].$row['image'];
    	    if (file_exists( DIR_WS_IMAGE .  $row['image'] ))
    	        unlink( DIR_WS_IMAGE .  $row['image'] );

    	    if (file_exists( DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE .  $row['image'] ))
    	        unlink( DIR_WS_IMAGE . '/'. DIR_NAME_IMAGECACHE .  $row['image'] );
    	    
            $sql = 'UPDATE '.$this -> mTbUsers.' SET image = "", subdir = "" WHERE uid = ?';
    	    $this -> mDbPtr -> query($sql, $id);
    	    return true;  
    	}
    	return false;    	
    }#DelPhoto
    
    #********************************
    #    Friends
    #********************************    
    public function AddFriend($uid, $friend_id)
    {
        $sql = 'SELECT id FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ?';
        if (!$this -> mDbPtr -> getOne($sql, array($uid, $friend_id)))
        {
            $sql = 'INSERT INTO '.$this -> mTbFriend.' SET uid = ?, friend_id = ?, pdate = ?';
            $this -> mDbPtr -> query($sql, array($uid, $friend_id, mktime()));
    
            //Possible user already added this user in friends and it's necessary this confirm
            $sql = 'SELECT id FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ?';
            if ($this -> mDbPtr -> getOne($sql, array($friend_id, $uid)))
            {
                //aprove friends
                $this -> UpdInvite($uid, $friend_id, 1);
                $this -> UpdInvite($friend_id, $uid, 1);            
                return false;
            }
            return true;
        }
        else 
            return false;
    }

    public function GetUserFriendsCount($uid, $factive = -1, $letter = '', $sstr = '')
    {
        $sql = 'SELECT COUNT(u.uid) 
                FROM '.$this -> mTbFriend.' f
                RIGHT JOIN  '.$this -> mTbUsers.' u ON (u.uid = f.friend_id AND u.active = 1) 
                WHERE f.uid = ?
                ';
        if (-1 != $factive)
            $sql .= ' AND f.active = '.(int)$factive;

        if ($letter)
            $sql .= ' AND (( LOWER(u.lname) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';

        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" OR LOWER(u.company) LIKE "%'.$sstr.'%" )';
        }
        
        $r   = $this -> mDbPtr -> getOne($sql, array($uid));
        return $r;
    }
    
    public function &GetUserFriends($uid, $first = 0, $cnt = 0, $factive = -1, $letter = '', $sstr = '', $sort = '')
    {
        $sql = 'SELECT u.uid, u.email, u.name, u.lname, u.image, u.subdir, u.status, f.active, u.person_title,
                u.city, u.state, u.zip, u.phone, u.company, u.prof1, u.prof2, u.prof3  
                FROM '.$this -> mTbFriend.' f 
                RIGHT JOIN  '.$this -> mTbUsers.' u ON (u.uid = f.friend_id AND u.active = 1) 
                WHERE f.uid = ?
                ';
        if (-1 != $factive)
            $sql .= ' AND f.active = '.(int)$factive;
        
        if ($letter)
            $sql .= ' AND (( LOWER(u.lname) LIKE "'.$letter.'%" AND u.status = 1 ) OR ( LOWER(u.company) LIKE "'.$letter.'%" AND u.status = 2 ))';
        
        if ($sstr)
        {
            $sstr = mysql_escape_string(strip_tags(strtolower($sstr)));
            $sql .= ' AND ( LOWER(u.name) LIKE "%'.$sstr.'%" OR LOWER(u.lname) LIKE "%'.$sstr.'%" )';
        }

        $sql .= (!$sort) ? ' ORDER BY u.name, u.lname' : ' ORDER BY '.$sort;

        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($uid)); 
        else 
            $db  =$this -> mDbPtr -> query($sql, array($uid));

        $r  = array();
        while ($row = $db -> FetchRow())
        {
            $row['name']  = stripslashes($row['name']);
            $row['lname'] = stripslashes($row['lname']);
            $r[] = $row;
        }
        return $r;      
    }
    
    public function DelFriend($uid, $friend_id)
    {
        $this -> mDbPtr -> query('DELETE FROM '.$this -> mTbFriend.' WHERE uid = '.$uid.' AND friend_id = '.$friend_id);
        $this -> mDbPtr -> query('DELETE FROM '.TB.'wire WHERE ptype = 5 AND uid = '.$uid.' AND to_uid = '.$friend_id);
        return true;    
    }
    
    /**
     * Invite it's users with friend_id = UID and status != 1
     *
     * @param int $uid - user ID
     * @return int  - users count
     */
    public function GetUserInvitesCount($uid)
    {
        $sql = 'SELECT COUNT(u.uid) 
                FROM '.$this -> mTbFriend.' f
                RIGHT JOIN  '.$this -> mTbUsers.' u ON (u.uid = f.uid AND u.active = 1) 
                WHERE f.friend_id = ? AND f.active = 0
                ';
        $r   = $this -> mDbPtr -> getOne($sql, array($uid));
        return $r;
    }#GetUserInvitesCount
        
    
    public function &GetUserInvites($uid, $first = 0, $cnt = 0)
    {
        $sql = 'SELECT u.uid, u.email, u.name, u.lname, u.image, u.subdir, u.status, f.active, u.person_title,
                u.city, u.state, u.zip, u.phone, u.company    
                FROM '.$this -> mTbFriend.' f 
                RIGHT JOIN  '.$this -> mTbUsers.' u ON (u.uid = f.uid AND u.active = 1) 
                WHERE f.friend_id = ?  AND f.active = 0
                ';      
        if ($cnt)
            $db  = $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($uid)); 
        else 
            $db  =$this -> mDbPtr -> query($sql, array($uid));

        $r  = array();
        while ($row = $db -> FetchRow())
        {
            $row['name']  = stripslashes($row['name']);
            $row['lname'] = stripslashes($row['lname']);
            $r[] = $row;
        }
        return $r;      
    }#GetUserInvites   
    
    
    /**
     * Check invite exist
     *
     * @param int $uid
     * @param int $friend_id
     * @return int 0 - No, 1 - Yes
     */
    public function CheckInvite($uid, $friend_id)
    {
        $sql = 'SELECT 1 FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ? AND active = 0';
        $r   =  $this -> mDbPtr -> getOne($sql, array($friend_id, $uid));

        if ($r)
            return 1;
        else 
            return 0;
    }#CheckInvite
    
    
    public function UpdInvite($uid, $friend_id, $status = 0)
    {
        $sql = 'UPDATE '.$this -> mTbFriend.' SET active = ? WHERE uid = ? AND friend_id = ?';
        $this -> mDbPtr -> query($sql, array($status, $friend_id, $uid));
        return true;
    }#CancelInvite
    
    
    /**
     * Check Active friend
     *
     * @param int $uid - user ID
     * @param int $friend_id - friend ID
     * @return int 0 - not friend, 1 - friend
     */
    public function CheckFriend($uid, $friend_id)
    {
        $sql = 'SELECT 1 FROM '.$this -> mTbFriend.' WHERE uid = ? AND friend_id = ?';
        $r   =  $this -> mDbPtr -> getOne($sql, array($uid, $friend_id));
        if ($r)
        {
            return 1;
        }
        else 
        {
            return 0;
        }
    }/** CheckFriend */    
    
    
    #********************************
    #    User Status (flag log)
    #********************************    
    /**
     * Edit "new item" flags state
     * @param int $uid - user ID
     * @param string $what - flag name
     * @param int $val - flag counter 
     */
    public function EditNewState($uid, $what, $val)
    {
        //mess, meet, friend, comm
        if (!in_array($what, array('mess', 'friend')))
            return false;
        
        if (0 > $val)
        {
            $sql = 'SELECT new_'.$what.' FROM '.$this -> mTbUsers.' WHERE uid = ?';
            $r   = $this -> mDbPtr -> getOne($sql, array($uid));
            if (!$r)
                return false;
            elseif ($r < abs($val))
                $val = $r;
        }

        $sql = 'UPDATE '.$this -> mTbUsers.' 
                SET new_'.$what.' = new_'.$what.' + '.(int)$val.'
                WHERE uid = ?';
        
        $this -> mDbPtr -> query($sql, array($uid));
        return true;
    }/**AddNewState */
        
    
    /**
     * Get User states
     * 
     * @return array with distinct states
     */
    public function GetUserStates( $status = 0 )
    {
        $sql = 'SELECT DISTINCT(state) AS state 
                FROM '.$this -> mTbUsers.'
                WHERE uid = uid AND active = 1
                '.( $status ? ' AND status = '.$status : '').' 
                ORDER BY state
                ';
        $db  = $this -> mDbPtr -> query( $sql );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['state'];
        }
        return $r; 
    }/** GetUserStates */
    
    
    /**
     * Get user cities
     * 
     * @return array with distinct states
     */
    public function GetUserCities( $state = '', $status = 0 )
    {
        $state =  (2 == strlen($state)) ? mysql_escape_string( $state ) : '';

        $sql = 'SELECT DISTINCT(city) AS city 
                FROM '.$this -> mTbUsers.'
                WHERE uid = uid
                '.( $status ? ' AND status = '.$status : '').' 
                '.($state ? ' AND state = "'.$state.'"' : '').'
                AND TRIM(city) <> "" 
                ORDER BY city ASC';

        $db  = $this -> mDbPtr -> query( $sql );
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['city'];
        }
        return $r; 
    }/** GetUserCities */    
    
    
    /**
     * Get Online Users Count
     * 
     * @return int users count
     */
    public function GetOnlineUsersCount()
    {
        $sql = 'SELECT COUNT(uid) FROM '.$this -> mTbUsers.' WHERE active = 1 AND last_login > '.(mktime() - 15 * 60);    
        return $this -> mDbPtr -> getOne($sql);
    }/** GetOnlineUsersCount */
    
    
    /**
     * Get New Users Count
     * 
     * @return int users count
     */
    public function GetNewUsersCount()
    {
        $sql = 'SELECT COUNT(uid) FROM '.$this -> mTbUsers.' WHERE active = 1 AND dt > '.(mktime() - 24 * 60 * 60);    
        return $this -> mDbPtr -> getOne($sql);
    }/** GetNewUsersCount */   
    
    
    /****************************************************
                Members Categories Output
     ****************************************************/
    public function EditMembersCat( $cat, $upd = 1)
    {
        if (empty($cat) || !is_numeric($upd) || 0 == $upd)
        {
            return false;
        }
        $sql = 'SELECT users_cnt FROM '.$this -> mTbMembersCat.' WHERE cat = ?';
        $r   = $this -> mDbPtr -> getOne($sql, array( $cat ));
        if (!$r)
        {
            if ( 0 < $upd )
            {
                $sql = 'INSERT INTO '.$this -> mTbMembersCat.'(cat, users_cnt) VALUES(?, ?)';
                $this -> mDbPtr -> query( $sql, array( $cat, $upd ) );
            }
        }
        else
        {
            if ( 0 > $upd && abs($upd) >= $r )
            {
                $sql = 'DELETE FROM '.$this -> mTbMembersCat.' WHERE cat = ?';
                $this -> mDbPtr -> query( $sql, array($cat) );
            }
            else
            {
                $sql = 'UPDATE '.$this -> mTbMembersCat.' SET 
                       users_cnt = users_cnt '.(0 < $upd ? '+ ' : '- ').abs($upd).' WHERE cat = ?';
                $this -> mDbPtr -> query( $sql, array($cat) );
            }    
        }
        return true;
    }/** EditMembersCat */
    
    
    public function &GetMembersCat( $assoc = 0 )
    {
        $sql = 'SELECT * FROM '.$this -> mTbMembersCat.' ORDER BY cat';
        $db  = $this -> mDbPtr -> query($sql);
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            if ($assoc)
                $r[$row['id']] = $row;
            else
                 $r[] = $row;
        }
        return $r;
    }/** GetMembersCat */
    
    
    public function GetMemberCatByName( $name )
    {
        $sql = 'SELECT id FROM '.$this -> mTbMembersCat.' WHERE LOWER(cat) = ?';
        $r   = $this -> mDbPtr -> getOne($sql, array($name));
        return $r;
    }/** GetMemberCatByName */
    
    
    public function &GetMembersCatAsTags( $cnt )
    {
        $cnt = (empty($cnt) || !is_numeric($cnt)) ? 20 : $cnt;
        
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTbMembersCat.' WHERE users_cnt > 0';
        $r   = $this -> mDbPtr -> getOne($sql);
    
        if ($r > $cnt)
        {
            $sql = 'SELECT users_cnt FROM '.$this -> mTbMembersCat.
                   ' WHERE  users_cnt > 0 ORDER BY users_cnt DESC LIMIT ?, 1';         
            $qa[] = $cnt;
            $xc   = $this -> mDbPtr -> query($sql, $qa);           
            $qa  = array($xc); 
            $sql = 'SELECT *, RAND() AS ordf  FROM '.$this -> mTbMembersCat.
                    ' WHERE users_cnt >= ? ORDER BY ordf LIMIT ?';
            $qa[] = $cnt;
            $db   = $this -> mDbPtr -> query($sql, $qa);        
        }
        else
        {
            $qa  = array(); 
            $sql = 'SELECT *, RAND() AS ordf  
                    FROM '.$this -> mTbMembersCat.
                    ' WHERE users_cnt > 0
                    ORDER BY ordf LIMIT ?';           
            $qa[] = $cnt;
            $db  = $this -> mDbPtr -> query($sql, $qa); 
        }
        
        $r  = array();
        $ca = array();
        while ($row = $db -> FetchRow())
        {
            $ca[] = $row['users_cnt']; 
            $r[stripslashes($row['cat'])]  = $row['users_cnt'];
        }
    
        if (empty($r))
            return $r;

        /** get max - min */
        $max     = max($ca);
        $min     = min($ca);
        unset($ca);
        
        $max_cnt = 8;//max tags level
        $mout    = 10;//step for output
        $step    =   ($max - $min) / $max_cnt  ;
                    
        /** gen places */
        foreach ($r as $k => $v)
        {
            if (!$step)
                $r[$k]  = $mout + ceil( $max_cnt / 2 );
            else
            {   
                $s = $min;
                $c = 1;
                while ($s < $max) 
                {
                    if ( $v >= $s && $v <= ($s + $step) )
                    {
                        $r[$k] = $mout + $c;
                        break;  
                    }
                    $c ++;
                    $s += $step;
                }    
            }
        }

        return $r;
    }/** GetMembersCatAsTags */    
    
    /****************************************************
                Blocked users
     ****************************************************/    
    public function UpdBlockUser( $uid, $uid_bl )
    {
        $id = $this -> CheckBlockUser($uid, $uid_bl);
        if ($id)
        {
            $db  = $this -> mDbPtr -> query('DELETE FROM '.$this -> mTbUsersBlock.' WHERE uid = '.$uid.' AND uid_bl = '.$uid_bl);
            $this -> mDbPtr -> query('DELETE FROM '.TB.'wire WHERE ptype = 9 AND ext_id = '.$uid_bl.' AND uid = '.$uid);
        }
        else
        {
            $this -> mDbPtr -> query('INSERT INTO '.$this -> mTbUsersBlock.' (uid, uid_bl) VALUES('.$uid.', '.$uid_bl.')');
            require_once CLASS_PATH . 'Model/Main/Model_Main_Wire.php'; 

            $ui = $this -> Get($uid);
            
            $gWire = new Model_Main_Wire($gDb, array('wire' => TB.'wire', 'users' => TB.'users'));                    
            $gWire -> Edit(
                           array( 
                                 $uid,
                                 $uid_bl, 
                                 (1 == $ui['status'] ? $ui['name'].' '.$ui['lname'] : $ui['company']),
                                  9,
                                 'blocks you',
                                 'profile'.$uid,
                                  $uid_bl
                                 )
                              );
        }
        return true;
    }/** UpdBlockUser */
    
    public function CheckBlockUser( $uid, $uid_bl )
    {
        $sql = 'SELECT id FROM '.$this -> mTbUsersBlock.' WHERE uid = ? AND uid_bl = ?';
        $r   = $this -> mDbPtr -> getOne( $sql, array($uid, $uid_bl) );
        if ($r)
            return $r;
        else
        {
            $r = 0; 
            return $r;
        }
    }/** CheckBlockUser */
    
    
    /**
     * Get Users with newsletter status == 1
     *
     * @return array with values
     */
    public function &GetNewsletterUsers()
    {
        $sql = 'SELECT uid, email, name, lname, company, status FROM '.$this -> mTbUsers.' WHERE active = 1 AND is_deleted = 0';
        $db  = $this -> mDbPtr -> query($sql);
        $r   = array();
        while ($row = $db -> FetchRow())
        {
        	$r[] = $row;
        }
        return $r;
    }#GetNewsletterUsers    
    
    public function CheckLoginSet( $uid )
    {
        $cl  = md5(rand(10000, 999999));
        $sql = 'UPDATE '.$this -> mTbUsers.' SET checklogin = ? WHERE uid = ?';
        $this -> mDbPtr -> query($sql, array($cl, $uid));
        return $cl;
    }/** CheckLoginSet */
   
    
    
}#end Users class


/**
 * Define a Users exception class
 */
class UsersException extends Exception
{
    public function __construct($code)
    {
        if (is_array($code))
        {
           $text = serialize($code);
           $code = -1;
        }
        else
           $text = null;

        parent::__construct($text, $code);

    }#end constructor

}#end class
?>