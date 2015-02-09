<?php
/**
 * Admin modules 
 *
 * @package    Engine37 catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37 Team
 * @link       http://Engine37.com
 */

class Modules
{
    private $mTable;    //Categories table name
    private $mDbPtr;     //DB pointer
    private $mHist;
    
    function __construct($dbPtr,
                         $table = 'modules',
                         $hist
                    )
    {
        $this -> mTable    =  $table;
        $this -> mDbPtr    =  $dbPtr;
        $this -> mHist     =  $hist;
    }#End constructor

    
    public function Edit($ar = array())
    {
        if (!isset($ar['id']) || !is_numeric($ar['id']))
        {
            $sql = 'INSERT INTO '.$this -> mTable.' (name, fname) values (?, ?)';
            $this -> mDbPtr -> query($sql, array($ar['name'], $ar['fname']));
            $this -> mHist  -> Add('Add', 'Add module '.$ar['fname'].' to adminpanel');
        }
        else 
        {
            $sql = 'UPDATE '.$this -> mTable.' SET name = ?, fname = ?, sortid = ? WHERE id = ?';
            $this -> mDbPtr -> query($sql, array($ar['name'], $ar['fname'], $ar['sortid'], $ar['id']));
            $this -> mHist  -> Add('Edit', 'Update module with ID = '.$ar['id'].' -> '.$ar['fname'].' in adminpanel');            
        }
        return true;
    }#Edit
        
    public function ChgAct($id = 0)
    {
        $sql = 'SELECT ACTIVE FROM '.$this -> mTable.' WHERE id = ?';
        $ac  = $this -> mDbPtr -> getOne($sql, $id);
        $sql = 'UPDATE '.$this -> mTable.' SET active = '.(!$ac ? 1 : 0).' WHERE id = ?';
        $this -> mDbPtr -> query($sql, array($id));
        $this -> mHist  -> Add('Change', 'Change module active, ID =  '.$id.' in adminpanel');
        return true;
    }#ChgAct
    
    
    public function Del($id = 0)
    {
        $sql = 'DELETE FROM '.$this -> mTable.' WHERE id = ?';    
        $this -> mDbPtr -> query($sql, array($id));
        $this -> mHist  -> Add('Delete', 'Delete module -> ID =  '.$id.' in adminpanel');
        return true;  
    }#Del
    
    
    public function GetOne($id = 0)
    {
        $res = array();
        if (0 == $id)
        {                
            return $res;    
        }
        $sql = 'SELECT * FROM '.$this -> mTable.' WHERE id = '.(int)$id;
        $db  = $this -> mDbPtr -> query($sql);
        if ($row = $db -> FetchRow())
        {
            return $row;
        }
        else 
        {
            return $res;
        }
    }#GetOne
    
    
    public function GetList($smin = 0, $smax = 0, $active = -1)
    {
        $sql = 'SELECT * FROM '.$this -> mTable.' WHERE id = id';
        if (0 < $smax)
        {     
            $sql .= ' AND sortid >='.$smin.' AND sortid < '.$smax;     
        }
        if (0 <= $active)
        {
            $sql .= ' AND active = '.(int)$active;
        }
        $sql .= ' ORDER BY sortid';

        $db  = $this -> mDbPtr -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            $res[] = $row;
        }
        return $res;
    }#GetList
    
    
    public function GetCheckList($smin = 0, $smax = 0, $active = -1, $ustatus = 0, $mlist = '')
    {
        $sql = 'SELECT * FROM '.$this -> mTable.' WHERE id = id';
        if (0 < $smax)
        {     
            $sql .= ' AND sortid >='.$smin.' AND sortid < '.$smax;     
        }
        if (0 <= $active)
        {
            $sql .= ' AND active = '.(int)$active;
        }
        $sql .= ' ORDER BY sortid';

        $db  = $this -> mDbPtr -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            if (0 == $ustatus || 0 < strpos('_'.$mlist, $row['fname'].'.php'))
            {
                $res[] = $row;
            }    
        }
        return $res;
    }#GetList    
    
    
    public function GetMnuText(&$gmodules)
    {
        $st = '<?xml version=\'1.0\' encoding=\'windows-1251\'?>
               <tree id="0">';
        for ($i = 0; $i < count($gmodules);$i++)
        {                   
            if (0 < count($gmodules[$i]['vals']))
            {
                $st .= '<item text="'.$gmodules[$i]['name'].'" id="i'.$i.'" open="1" im0="'.$gmodules[$i]['img'].'" im1="'.$gmodules[$i]['img'].'" im2="'.$gmodules[$i]['img'].'" style="font-weight:bold; background-color: #f5f5f5; color:black;cursor:default;" tooltip="'.$gmodules[$i]['name'].'">';  
                for ($j = 0; $j < count($gmodules[$i]['vals']); $j++)
                {
                    $st .= '
                    	<item text="'.$gmodules[$i]['vals'][$j]['name'].'" id="i'.$i.'_'.$j.'" im0="main.gif" im1="main.gif" im2="main.gif" style="color: steelblue; " tooltip="'.$gmodules[$i]['vals'][$j]['name'].'">
                        <userdata name="myurl">'.$gmodules[$i]['vals'][$j]['fname'].'.php</userdata>
                        </item> 
                       ';   
                }     
                $st .= '</item>';
            } 
        }
        $st .= '</tree> ';
        return $st;         
    }#GetMnuText
    
    
}    
?>