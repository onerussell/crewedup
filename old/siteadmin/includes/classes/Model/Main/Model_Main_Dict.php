<?php
/**
 * Dictionaries - text pages administration
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1b
 * @since      10.01.2006
 * @copyright  2004-2008 engine37.com
 * @link       http://engine37.com
 */

class Model_Main_Dict
{
	/**
	 * Categories table name
	 *
	 * @var string
	 */
    private $mCtable;

    /**
     * Dictionary table name
     *
     * @var string
     */    
    private $mTable;
    
    /**
     * DB pointer
     *
     * @var object
     */
    private $mDbPtr;
    
    private $mHist;

    public function __construct($dbPtr,
                                $ctable = 'dictcat',
                                $table  = 'dict',
                                $hist)
    {
        $this -> mTable    =  $table;
        $this -> mCtable   =  $ctable;
        $this -> mDbPtr    =  $dbPtr;
        $this -> mHist     =  $hist;
    }


#***************************************************
#    Edit methods
#***************************************************
    /**
    * Add and Update page in dB
    * @param array $ar with values
    * @param int $id - page id for Update (if Update)
    * @return bool true
    */
    function AddDict($ar, $id = 0)
    {
        if ( $id == 0 || !is_numeric($id) )
        {
            $sql  =  'INSERT INTO '.$this -> mTable.' (cid, name, sortid) VALUES(?, ?, ?)';
            if (is_object($this -> mHist))
            {
                $this -> mHist -> Add('Add', 'Add dictionary');
            }    
        }
        else
        {
            $ar[] = $id;
            $sql  =  'UPDATE '.$this -> mTable.' SET
                      cid      = ?,
                      name     = ?,
                      sortid   = ?
                      WHERE id = ?';
            if (is_object($this -> mHist))
            {
                $this -> mHist -> Add('Update', 'Update dictionary with ID = '.$id);
            }    
        }
        $this -> mDbPtr -> query($sql, $ar);

        return true;
    }#AddDict


    /**
    * Delete dictionary from dB
    *
    * @param int $id - dict ID
    * @return bool true
    */
    function DelDict($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            global $gSmarty;
            sc_error($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.']');
        }
        $sql = 'DELETE FROM '.$this -> mTable.' WHERE id = "'.$id.'"';
        if (is_object($this -> mHist))
        {
            $this -> mHist -> Add('Delete', 'Delete dictionary with ID = '.$id);
        }    
        $this -> mDbPtr -> query($sql);
        return true;

    }#DelDict


    /**
    * Update dictionary activity
    *
    * @param int $id  - dict ID
    * @return bool - only true
    */
    function ActiveDict($id = 0)
    {
        if (!is_numeric($id))
            $id = 0;

        $sql = 'UPDATE '.$this -> mTable.' set active = not active WHERE id = "'.$id.'"';
        $this -> mDbPtr -> query($sql);
        if (is_object($this -> mHist))
        {
            $this -> mHist -> Add('Update', 'Update dictionary activity - ID = '.$id);
        }
        return true;
    }#ActivePge


    /**
    * Add and Update category in dB
    * @param array $ar with values
    * @param int $cid - category id for Update (if Update)
    * @return bool
    */
    function AddCat($ar, $cid = 0)
    {
        if ( $cid == 0 || !is_numeric($cid) )
        {
            $sql  =  'INSERT INTO '.$this -> mCtable.' (name, sortid, parent, dictname) VALUES(?, ?, ?, ?)';
            if (is_object($this -> mHist))
            {
                $this -> mHist -> Add('Add', 'Add dictionary category');
            }    
        }
        else
        {
            $ar[] = $cid;
            $sql  = 'UPDATE '.$this -> mCtable.' SET
                     name     = ?,
                     sortid   = ?,
                     parent   = ?,
                     dictname = ?
                     WHERE cid = ?';
            if (is_object($this -> mHist))
            {
                $this -> mHist -> Add('Update', 'Update dictionary category with CID = '.$cid);
            }    
        }

        $this -> mDbPtr -> query($sql, $ar);
        return true;

    }#AddCat


    /**
    * Delete category from dB
    *
    * @param int $cid - category ID
    * @return bool true
    */
    function DelCat($cid = 0)
    {
        if ($cid == 0 || !is_numeric($cid))
        {
            global $gSmarty;
            sc_error($gSmarty -> _config[0]['vars']['errdel'].' [cid = '.$cid.']');
        }
        #delete category
        $sql = 'delete from '.$this -> mCtable.' where cid = "'.$cid.'"';
        $this -> mDbPtr -> query($sql);
        
        if (is_object($this -> mHist))
        {
            $this -> mHist -> Add('Delete', 'Delete dictionary category with CID = '.$cid);
        }
        #delete products in category
        $sql  = 'SELECT id FROM '.$this -> mTable.' WHERE cid = "'.$cid.'"';
        $db   =& $this -> mDbPtr -> query($sql);

        while ($row = $db -> fetchRow())
            $this -> DelDict($row['id']);

        #select all subcategories and delete it
        $sql = 'SELECT cid FROM '.$this -> mCtable.' WHERE parent = "'.$cid.'"';
        $db  =& $this -> mDbPtr -> query($sql);

        while ($row = $db -> fetchRow())
            $this -> DelCat($row['cid']);

        return true;

    }#DelCat


    /**
    * Update category activity
    *
    * @param int $cid
    * @return bool - only true
    */
    function ActiveCat($cid = 0)
    {
        if (!is_numeric($cid))
            $cid = 0;
        $sql = 'UPDATE '.$this -> mCtable.' SET active = NOT active WHERE cid = "'.$cid.'"';
        $this -> mDbPtr -> query($sql);
        if (is_object($this -> mHist))
        {
            $this -> mHist -> Add('Update', 'Update dictionary category activity - CID = '.$cid);
        }
        return true;
    }#ActiveCat


#***************************************************
#    Select methods
#***************************************************

    /**
    * Get dict by ID
    *
    * @param int $id - dict id
    * @param int $active - if $active == 1 - select only active dictionary, else select all
    * @return array - hash with dictionary information
    */
    function GetDictInfo($id = 0, $active = 0)
    {

        if ( $id <> 0 && is_numeric($id) )
        {
            $sql  = 'SELECT id, cid, name, active, sortid
                     FROM '.$this -> mTable.'
                     WHERE id = "'.$id.'"';
        }
        else
        {
            $r = array();
			return $r;
        }

        if ($active == 1)
            $sql .= ' AND active = 1';


        $db   =& $this -> mDbPtr -> query($sql);

        if ($db -> numRows() == 0)
        {
            $r = array();
			return $r;
        }
        $row             = $db -> fetchRow();
        $row['name']     = stripslashes($row['name']);
        $row['sortid']   = stripslashes($row['sortid']);
        return $row;

    }#GetDictInfo


    /**
    * Get Dictionary List
    *
    * @param int $active - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "name")
    * @parem int $nuse - not select element with id = $nuse
    * @return array - hash with values
    */
    function GetDictList($ctg = 0, $active = 0, $sort = '', $nuse = 0, $first = 0, $cnt = 0)
    {
        if (trim($sort) == '')
            $sort = ' sortid, name';

        $sql = 'SELECT id, name, active, sortid FROM '.$this -> mTable.
               ' WHERE cid = "'.$ctg.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';
        if ($nuse > 0)
            $sql .= ' AND id <> "'.$nuse.'"';
        $sql .= ' ORDER BY '.$sort;
        
        if ($cnt)
        {
            $db   =& $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        }
        else
        {
            $db   =& $this -> mDbPtr -> query($sql);
        }
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $res[]           = $row;
        }
        return $res;

    }#GetDictList

    
    public function GetDictCount($ctg = 0, $active = 0)
    {
        $sql = 'SELECT COUNT(id) FROM '.$this -> mTable.
               ' WHERE cid = ?';

        if ($active == 1)
            $sql .= ' AND active = 1';

        $r   =& $this -> mDbPtr -> getOne($sql, array($ctg));    
        return $r;        
    }/** GetDictCount */
    
    
    /**
    * Get category by CID
    *
    * @param int $cid - category id
    * @return array - hash with category values
    */
    function GetCatInfo($cid = 0)
    {

        $sql         = 'SELECT * FROM '.$this -> mCtable.' WHERE cid = "'.$cid.'"';
        $db          =& $this -> mDbPtr -> query($sql);

        if ($db -> numRows() == 0)
        {
            global $gSmarty;
            sc_error($gSmarty -> _config[0]['vars']['errnfound'].' [cid = '.$cid.']');
        }

        $row             = $db -> fetchRow();
        $row['name']     = stripslashes($row['name']);
        return $row;

    }#GetCatInfo


    /**
    * Get category parent ID by CID
    *
    * @param int $cid - category id
    * @return int - parent first level category ID
    */
    function GetCatParent($cid = 0)
    {
        $pr = $cid;
        while ($pr > 0)
        {
            $sql    =  'SELECT parent FROM '.$this -> mCtable.' WHERE cid = "'.$pr.'"';
            $db     =& $this -> mDbPtr -> query($sql);
            if ($db -> numRows() > 0)
            {
                $row   = $db -> fetchRow();
                if ($row['parent'] > 0)
                    $pr = $row['parent'];
                else
                    break;
            }
            else
                break;
        }
        return $pr;

    }#GetCatParent


    /**
    * Get Categories List by parent field
    *
    * @param int $parent - value of parent field
    * @param int $active - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "sortid, name")
    * @return array - hash with values
    */
    function GetCatList($parent = 0, $active = 1, $sort = '')
    {
        if (trim($sort) == '')
            $sort = 'sortid, name';

        $sql  = 'SELECT *
                 FROM '.$this -> mCtable.' WHERE parent = "'.$parent.'"';

        if ($active == 1)
            $sql .= ' and active = 1';
        $sql .= ' order by '.$sort;

        $db   =& $this -> mDbPtr -> query($sql);
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $res[]       = $row;
        }
        return $res;

    }#GetCatList


    /**
    * Get Categories breadcrumb
    *
    * @param int $cid - value of max category
    * @return array - hash with values
    */
    function GetCatBrC($cid = 0)
    {
        if ($cid == 0) return '';

        $pr   = $cid;
        $bc   = array();

        while ($pr > 0)
        {
            $sql = 'SELECT name, parent FROM '.$this -> mCtable.' WHERE cid = "'.$pr.'"';
            $db  =& $this -> mDbPtr -> query($sql);

            if ($row = $db -> fetchRow())
            {
                $ar          = array('name' => stripslashes($row['name']),
                                     'link' => 'ctg='.$pr);
                $bc[]        = $ar;
                $pr          = $row['parent'];
            }
            else
                $pr = 0;
        }
        $bcc = array();
        for ($i = count($bc)-1; $i >= 0; $i--)
           $bcc[] = $bc[$i];

        return $bcc;

    }#GetCatBrC
    
    
    function &GetDict($dictname = '')
    {
        $res = array();
        if (trim($dictname) == '')
        {
            return $res;
        }
        $sql = 'SELECT e.id, e.name FROM ' . $this -> mCtable . ' c, ' . $this -> mTable . ' e 
                WHERE e.cid = c.cid AND c.dictname = "'.trim($dictname).'"
                ORDER BY e.sortid, e.name';
        $db  = $this -> mDbPtr -> query($sql);
        while ($row = $db -> fetchRow())
        {
            $res[$row['id']] = stripslashes($row['name']);    
        }
        return $res;
    }#GetDict

    
}#End Dict
?>