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

class Admin_Users
{
    public $LastError = 0; // Last Error Code
    public $ResOnPage = 0; // = 0 if not paginal viewing is required

    private $AccessRightsLevels = array('0' => 'Administrator',
                                        '1' => 'Editor',
                                        '2' => 'No Access');
                                  // general rule: 
                                  //   more value of a level, 
                                  //   is user is more limited

    private $mTable = 'users';     // table with users
    private $mDbPtr;
    
    public function __construct($dbPtr, $table, $resOnPage = 0)
    {
        $this -> mTable     = $table;
        $this -> ResOnPage = $resOnPage;
        $this -> mDbPtr    = $dbPtr;
    }

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
        $sql =   'UPDATE '.$this -> mTable.' 
                  SET status=? 
                  WHERE uid=?';
        $this -> mDbPtr -> query($sql, array($status, $uid));
    }#ChangeStatus

    
    public function Delete($uid)
    {
        $sql = 'DELETE FROM '.$this -> mTable.' WHERE uid=?';
        $this -> mDbPtr -> query($sql, array($uid));
        return true;
    }

    
    public function Get($uid)
    {
         $sql = 'SELECT * 
                 FROM '.$this -> mTable.' 
                 WHERE uid = ?';
         $db  = $this -> mDbPtr -> query($sql, array($uid));
         $r   = array();
         if ($row = $db -> FetchRow())
         {
             $r = $row;
         }
         return $r;
    }#Get
    
    
    public function GetByLogin($login)
    {
         $sql = 'SELECT uid 
                 FROM '.$this -> mTable.' 
                 WHERE login = ?';
         $db  = $this -> mDbPtr -> query($sql, array($login));
         $r   = 0;
         if ($row = $db -> FetchRow())
         {
             $r = $row['uid'];
         }
         return $r;
    }#GetByLogin
    
    
    public function CheckLoginName($login = '')
    {
        $sql = 'SELECT 1 
                FROM '.$this -> mTable.' 
                WHERE login = ?';

        $db  = $this -> mDbPtr -> query($sql, $login);

        if (0 < $db -> NumRows() || empty($login))
        {
            return true;
        }
        else 
            return false;        
    }
    
    public function Add($ar)
    {
        $sql = 'SELECT 1 
                FROM '.$this -> mTable.' 
                WHERE login = ?';
        $db  = $this -> mDbPtr -> query($sql, $ar['login']);
        
        if (0 < $db -> NumRows() || empty($ar['login']))
        {
            $this->LastError = 1; // = error #1: user already exists;
            return false;
        }
        else
        {
            $bx = array($ar['login'], 
                        crypt($ar['pass']), 
                        $ar['name'], 
                        $ar['email'],
                        $ar['status'],
                        $ar['modules'],
                        ((isset($ar['scnt'])) ? (int)$ar['scnt'] : 0) 
                        );
            $sql = 'INSERT INTO '.$this -> mTable.' (login, pass, name, email, status, modules, scnt, dt) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())';
            $this -> mDbPtr -> query($sql, $bx); 
            return true;
        }
    }

    public function Change($uid, &$ar)
    {
        
        $sql = 'SELECT 1 
                FROM '.$this -> mTable.' 
                WHERE uid <> ? AND login = ?';
        $db  = $this -> mDbPtr -> query($sql, array($uid, $ar['login']));

        if (0 < $db -> NumRows())
        {
            $this->LastError = 1; // = error #1: user already exists;
            return false;
        }
        else
        {
            $bx = array($ar['login'], 
                        $ar['email'],
                        $ar['name'], 
                        $ar['status'],
                        $ar['modules'],
                        ((isset($ar['scnt'])) ? (int)$ar['scnt'] : 0),                      
                        $uid
                        );            
            $sql = 'UPDATE ' . $this -> mTable . ' SET login = ?'.
                      ((0 < strlen($ar['pass'])) ? ', pass=\''.crypt($ar['pass']).'\'' : '').
                      ', email   = ?, name    = ?, status  = ?, modules = ?, scnt = ? 
                      WHERE uid = ?';
            $this -> mDbPtr -> query($sql, $bx);          
            return true;
        }
    }

    
    // Get users list (this method supports paginal viewing and sorting)
    public function &GetAll($pStart = 0, $ordercol = 'login', $orderdesc = 'asc') // $pStart for paginal viewing
    {
        $OrderingStr = ' ORDER BY '.$ordercol.' '.StrToUpper($orderdesc);
        
        $PVStr = '';
        if ($this->ResOnPage > 0)
            $PVStr = ' LIMIT '.$pStart.','.$this->ResOnPage;

        $sql = 'SELECT uid, login, name, email, status, modules
                FROM '.$this -> mTable.''.$OrderingStr.$PVStr;

        $dbout = $this -> mDbPtr -> query($sql);
        $UA = array(); // (U)sers (A)rray
        while ($row = $dbout -> FetchRow())
        {
            $row['modules_arr'] = join(', ',preg_split('/;/', $row['modules'], -1, PREG_SPLIT_NO_EMPTY));
            $UA[] = $row;
        }
        return $UA;
    }

    
    public function Count()
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM '.$this -> mTable;
         
        $db  = $this -> mDbPtr -> query($sql);
        $r   = array();
        if ($row = $db -> FetchRow())
        {
            $r = $row;
        }
        return $row['cnt'];
    } 

    /**
     * Check current administrator session or make session
     *
     * $module string access admin module
     * $mainpart - if  == 1  - it's main part of the Site (show all modules)
     *
     * @return int 0 on success session. 1 if specified login and password is correct. 2 on bad session. 3 on bad login or password
     */
    public function CheckLogin($module, $mainpart = 0)
    {
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
    
            if (!empty($_POST['system_login']) 
                && !empty($_POST['system_pass']))
            {

                $sql = 'SELECT uid, pass, status, modules 
                        FROM '.$this -> mTable.'
                        WHERE login = ?
                        AND status <= 2';

                $dbout = $this -> mDbPtr -> query($sql, array($_POST['system_login']));

                if (0 == $dbout -> NumRows())
                   return 3;

                $row = $dbout -> fetchRow();

                if (crypt($_POST['system_pass'], $row['pass']) == $row['pass']
                    && (0 == $row['status'] || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1)
                   )
                {
                    $_SESSION['system_uid']     = $row['uid'];
                    $_SESSION['system_login']   = $_POST['system_login'];
                    $_SESSION['system_session'] = md5('pLmz2a4'.$_POST['system_login'].'pN5'.$row['status'].'1ghO7dNm4s'.$row['pass'].'KxJxnz');
                    $_SESSION['system_status']  = $row['status'];
                    $_SESSION['system_modules'] = $row['modules'];

                    // die('ok');
                    // if (!empty($_POST['redirectLocation']))
                    //   uni_redirect($_POST['redirectLocation']);
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

            $sql = 'SELECT pass, status, modules 
                    FROM '.$this -> mTable.'
                    WHERE login = ?
                    AND status <= 2';
            $dbout = $this -> mDbPtr -> query($sql, array($_SESSION['system_login']));

            if (0 == $dbout -> NumRows())
               return 2;

            $row = $dbout -> FetchRow();
            // Generate check value
            $compValue = md5('pLmz2a4'.$_SESSION['system_login'].'pN5'.$row['status'].'1ghO7dNm4s'.$row['pass'].'KxJxnz');

            if ($_SESSION['system_session'] == $compValue
                && (0 == $row['status'] 
                    || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1)
               )
                return 0;
            else
                return 2;
        }
    }#CheckLogin
    
    
    /**
     * Check current administrator session or make session
     *
     * @param string $authMessage      message, for example 'Bad username'
     * @param string $redirectLocation url where the user after successful authorization should be redirected
     *
     * @return void
     */
    public function AuthForm($authMessage = '', $redirectLocation = CURRENT_URL)
    {
        global $gSmarty;
    
        if (isset($_POST['system_login']))
            $gSmarty -> assign('systemLogin', $_POST['system_login']);
    
        $gSmarty -> assign('authMessage'     , $authMessage);
        $gSmarty -> assign('redirectLocation', $redirectLocation);
        $gSmarty -> display('admin_auth.html');
    
    }#AuthForm
    
    
    public function Logout()
    {
         unset($_SESSION['system_uid']);
         unset($_SESSION['system_login']);
         unset($_SESSION['system_session']);
         unset($_SESSION['system_status']);
         unset($_SESSION['system_modules']);
         return true;
    }
    
    /**
     * Restore user password
     * @param int $uid user id
     * @param string $email user email
     * @return string new password
     */
    public function RestorePassword($uid, $email)
    {
        $newPass = substr(uni_id2($uid.$email),0,8);

        $data[] = crypt($newPass);
        $data[] = $uid;
        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET pass = ?
                              WHERE uid = ?', $data);

        return $newPass;

    }#RestorePassword
}
?>
