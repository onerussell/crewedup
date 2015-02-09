<?php
/**
 * Dictionaries - text pages administration
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */

define('DICT_FILMS', 23);
define('DICT_SHOWS', 25);
define('DICT_NETS' , 24);
define('DICT_JOBS' , 26);

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
                                $ctable = null,
                                $table  = null,
                                $hist   = null)
    {
        $this -> mDbPtr    =  $dbPtr;
        $this -> mCtable   =  is_null($ctable) ? TB.'dictcat' : $ctable;
        $this -> mTable    =  is_null($table)  ? TB.'dict'    : $table;
        $this -> mHist     =  $hist;
    }

    // ***************************************************
    //     Edit methods
    // ***************************************************
    /**
    * Add and Update page in dB
    * @param array $ar with values
    * @param int $id - page id for Update (if Update)
    * @return bool true
    */
    function AddDict($ar, $id = 0, $add_field = '', $add_field2 = '')
    {
        if (!$id)
        {
            $ar[] = $add_field;
            $ar[] = $add_field2;
            $sql  =  'INSERT INTO '.$this -> mTable.' 
                      (cid, name, sortid, add_field, add_field2) VALUES(?, ?, ?, ?, ?)';
            $this -> mDbPtr -> query($sql, $ar);

            $id = (int)$this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');

            if (is_object($this -> mHist))
                $this -> mHist -> Add('Add', 'Add dictionary');
        }
        else
        {
           $sql  =  'UPDATE '.$this -> mTable.' SET
                     cid       = ?,
                     name      = ?,
                     sortid    = ?';

            if ($add_field)
            {
                $this -> UpdateImage($id, $add_field);
                $sql .=  ', add_field = ?';
                $ar[] = $add_field;
            }

            if ($add_field2)
            {
                $this -> UpdateImage($id, $add_field2, 2);
                $sql .=  ', add_field2 = ?';
                $ar[] = $add_field2;
            }

            $sql .= ' WHERE id  = ?';

            $ar[] = $id;

            $this -> mDbPtr -> query($sql, $ar);

            if (is_object($this -> mHist))
                $this -> mHist -> Add('Update', 'Update dictionary with ID = '.$id);
    
        }

        return $id;
    }// AddDict


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
            $this -> mHist -> Add('Delete', 'Delete dictionary with ID = '.$id);
        $this -> mDbPtr -> query($sql);
        return true;

    }// DelDict


    function CheckAndUpdate($ctg, $str)
    {
        $res = array();
        
        if (!is_array($ctg))
        {
            $ctg_query = '=\''.$ctg.'\'';
            $ctg = array($ctg);
        }
        else
            $ctg_query = 'IN (\''.join('\',\'',$ctg).'\')';

        if (is_numeric($ctg[0]))
        {
            $sql = 'SELECT 1
                    FROM '.$this -> mTable .' e
                    WHERE e.cid '.$ctg_query.'
                          AND e.name = ?'; // (e.name LIKE ? OR SOUNDEX(e.name) = SOUNDEX(?))';
            $cid = $ctg[0];
        }
        else
        {
            $sql = 'SELECT 1
                    FROM '.$this -> mCtable.' c,
                         '.$this -> mTable .' e
                    WHERE dictname '.$ctg_query.'
                          AND e.cid = c.cid 
                          AND e.name = ?'; // (e.name LIKE ? OR SOUNDEX(e.name) = SOUNDEX(?))';
            $cid = $this -> GetCidByDictName($ctg[0]);
        }

        $res = $this -> mDbPtr -> query($sql, array($str)); // , $str));

        if (0 == $res -> numRows())
            $this -> mDbPtr -> query('INSERT INTO '.$this -> mTable.' 
                                      (cid, name, is_new)
                                      VALUES ('.$cid.', ?, 1)',  array($str));
    }

    /**
    * Delete image for element
    *
    * @param int $id - element ID
    * @return bool - true if delete else false
    */
    public function DelImage($id, $postfix = '')
    {
        $row = $this -> mDbPtr -> getRow('SELECT add_field'.$postfix.', cid
                                          FROM '.$this -> mTable.' WHERE id = '.$id);

        if (!empty($row['add_field'.$postfix]))
        {
            // delete image from imagecategory and cache
            if (file_exists(DIR_WS_IMAGE . '/' . $row['add_field'.$postfix]))
                @unlink(DIR_WS_IMAGE . '/' . $row['add_field'.$postfix]);

            if (file_exists(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['add_field'.$postfix]))
                @unlink(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['add_field'.$postfix]);

            $this -> mDbPtr -> query('UPDATE  '.$this -> mTable.' 
                                      SET add_field'.$postfix.' = \'\' 
                                      WHERE id = '.$id);

            if (in_array($row['cid'], array(DICT_FILMS, DICT_SHOWS)))
                $this -> mDbPtr -> query('UPDATE '.TB.'resume
                                          SET image'.$postfix.' = \'\'
                                          WHERE image'.$postfix.' = \''.$row['add_field'.$postfix].'\'');
            /*elseif (DICT_NETS == $row['cid'])
                $this -> mDbPtr -> query('UPDATE '.TB.'resume
                                          SET image2 = \'\'
                                          WHERE image2 = \''.$row['add_field'].'\'');*/

            return true;
        }
        else
            return false;

    }// DelImage

    public function UpdateImage($id, $new_add_field, $postfix = '')
    {
        $row = $this -> mDbPtr -> getRow('SELECT add_field'.$postfix.', cid FROM '.$this -> mTable.' WHERE id = '.$id);

        if (!empty($row['add_field'.$postfix]))
        {
            // delete image from imagecategory and cache
            if (file_exists(DIR_WS_IMAGE . '/' . $row['add_field'.$postfix]))
                @unlink(DIR_WS_IMAGE . '/' . $row['add_field'.$postfix]);

            if (file_exists(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['add_field'.$postfix]))
                @unlink(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['add_field'.$postfix]);

            $this -> mDbPtr -> query('UPDATE  '.$this -> mTable.' 
                                      SET add_field'.$postfix.' = \''.$new_add_field.'\' 
                                      WHERE id = '.$id);

            if (in_array($row['cid'], array(DICT_FILMS, DICT_SHOWS)))
                $this -> mDbPtr -> query('UPDATE '.TB.'resume
                                          SET   image'.$postfix.' = \''.$new_add_field.'\'
                                          WHERE image'.$postfix.' = \''.$row['add_field'.$postfix].'\'');
            /*elseif (DICT_NETS == $row['cid'])
                $this -> mDbPtr -> query('UPDATE '.TB.'resume
                                          SET image2 = \''.$new_add_field.'\'
                                          WHERE image2 = \''.$row['add_field'].'\'');*/

        }
    }

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
    }// ActivePge


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
                $this -> mHist -> Add('Add', 'Add dictionary category');
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
                $this -> mHist -> Add('Update', 'Update dictionary category with CID = '.$cid);
        }

        $this -> mDbPtr -> query($sql, $ar);
        return true;

    }// AddCat


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
        // delete category
        $sql = 'delete from '.$this -> mCtable.' where cid = "'.$cid.'"';
        $this -> mDbPtr -> query($sql);
        
        if (is_object($this -> mHist))
        {
            $this -> mHist -> Add('Delete', 'Delete dictionary category with CID = '.$cid);
        }
        // delete products in category
        $sql  = 'SELECT id FROM '.$this -> mTable.' WHERE cid = "'.$cid.'"';
        $db   =& $this -> mDbPtr -> query($sql);

        while ($row = $db -> fetchRow())
            $this -> DelDict($row['id']);

        // select all subcategories and delete it
        $sql = 'SELECT cid FROM '.$this -> mCtable.' WHERE parent = "'.$cid.'"';
        $db  =& $this -> mDbPtr -> query($sql);

        while ($row = $db -> fetchRow())
            $this -> DelCat($row['cid']);

        return true;

    }// DelCat


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
            $this -> mHist -> Add('Update', 'Update dictionary category activity - CID = '.$cid);
        return true;
    }// ActiveCat

    function Moderate($statusArr)
    {
        if (is_array($statusArr))
        {
            while (list($key, $val) = each($statusArr))
            {
                if (0 == $val)
                    $this -> mDbPtr -> query('UPDATE '.$this -> mTable.' SET is_new = 0 WHERE id ='.(int)$key);
                elseif (-1 == $val)
                    $this -> mDbPtr -> query('DELETE FROM '.$this -> mTable.' WHERE id ='.(int)$key);
            }
        }
    }

    // ***************************************************
    //     Select methods
    // ***************************************************

    function &GetNewElements($pStart)
    {
        $sql = 'SELECT e.id, e.name, c.name AS c_name
                FROM '.$this -> mTable.' e,
                     '.$this -> mCtable .' c
                WHERE e.is_new = 1 
                      AND c.cid = e.cid
                ORDER BY e.id DESC';

        $NA =& $GLOBALS['glObj']['page'] -> GeneratePages($sql, array(), $pStart, 20, 'array');

        return $NA;
    }

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
            $sql  = 'SELECT *
                     FROM '.$this -> mTable.'
                     WHERE id = "'.$id.'"';
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

    }// GetDictInfo


    /**
    * Get Dictionary List
    *
    * @param int $active - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "name")
    * @param int $nuse - not select element with id = $nuse
    * @return array - hash with values
    */
    function GetDictList($ctg = 0, $active = 0, $sort = '', $nuse = 0, $first = 0, $cnt = 0)
    {
        if (trim($sort) == '')
            $sort = 'name ASC';

        $sql = 'SELECT id, name, active, sortid, cid FROM '.$this -> mTable.
               ' WHERE cid = '.$ctg;
        if ($active == 1)
            $sql .= ' AND active = 1';
        if ($nuse > 0)
            $sql .= ' AND id <> '.$nuse;
        $sql .= ' ORDER BY '.$sort;
        
        if ($cnt)
            $db   =& $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        else
            $db   =& $this -> mDbPtr -> query($sql);

        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $res[]           = $row;
        }
        return $res;

    }// GetDictList

    function &SearchDict($query, $ctg = 0)
    {
        $query = '%'.$query.'%';

        if ($ctg)
        {
            if (!is_array($ctg))
            {
                $ctg_query = '=\''.$ctg.'\'';
                $ctg = array($ctg);
            }
            else
                $ctg_query = 'IN (\''.join('\',\'',$ctg).'\')';

            if (is_numeric($ctg[0]))
                $sql = 'SELECT e.id, e.name
                        FROM '.$this -> mTable .' e
                        WHERE e.cid '.$ctg_query.'  
                              AND e.name LIKE ? 
                              AND e.active = 1
                        ORDER BY e.name ASC';
            else
                $sql = 'SELECT e.id, e.name
                        FROM '.$this -> mCtable.' c,
                             '.$this -> mTable .' e
                        WHERE dictname '.$ctg_query.'
                              e.cid = c.cid 
                              AND e.name LIKE ? 
                              AND e.active = 1
                        ORDER BY e.name ASC
                        LIMIT 0,10';
            $res = $this -> mDbPtr -> getAssoc($sql, false, array($query));
        }
        else
            $res = $this -> mDbPtr -> getAll('SELECT e.id, e.name, e.active, e.cid, c.name AS cat_name
                                              FROM '.$this -> mTable .' e,
                                                   '.$this -> mCtable.' c
                                              WHERE e.name LIKE ? 
                                                    AND c.cid = e.cid
                                              ORDER BY cat_name ASC, e.name ASC', array($query));
        return $res;
    }
    
    function UpdateAdditionalField($ctg, $val, $field, $postfix = '')
    {
        $this -> mDbPtr -> query('UPDATE '.$this -> mTable .' e
                                  SET add_field'.$postfix.' = ?, is_new = 1
                                  WHERE e.cid '.(!is_array($ctg) ? '='.$ctg : 'IN ('.join(',',$ctg).')').'
                                        AND e.name   = ? 
                                        AND e.active = 1
                                        AND e.add_field'.$postfix.' = \'\'', array($field, $val));
        
    }

    function GetAdditionalField($ctg, $val)
    {
        return $this -> mDbPtr -> getRow('SELECT e.add_field, e.add_field2
                                          FROM '.$this -> mTable .' e
                                          WHERE e.cid '.(!is_array($ctg) ? '='.$ctg : 'IN ('.join(',',$ctg).')').'
                                                AND e.name = ? 
                                                AND e.active = 1
                                          LIMIT 0,1', array($val), DB_FETCHMODE_ORDERED);
    }

    public function GetDictCount($ctg = 0, $active = 0)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this -> mTable.'
                WHERE cid = '.$ctg;

        if ($active == 1)
            $sql .= ' AND active = 1';

        $r   =& $this -> mDbPtr -> getOne($sql);
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

    }// GetCatInfo


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

    }// GetCatParent


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
            $sort = 'sortid ASC, name ASC';

        $sql  = 'SELECT *
                 FROM '.$this -> mCtable.' WHERE parent = '.$parent;

        if ($active == 1)
            $sql .= ' AND active = 1';
        $sql .= ' ORDER BY '.$sort;

        $db   =& $this -> mDbPtr -> query($sql);
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $res[]       = $row;
        }
        return $res;

    }// GetCatList


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
                                     'link' => '?ctg='.$pr);
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

    }// GetCatBrC
    
    
    function &GetDict($dictname = '')
    {
        $res = array();
        
        $dictname = trim($dictname);

        if (!$dictname)
            return $res;

        $sql = 'SELECT e.id, e.name FROM ' . $this -> mCtable . ' c, 
                                         ' . $this -> mTable  . ' e 
                WHERE e.cid = c.cid AND c.dictname = \''.$dictname.'\'
                ORDER BY e.name ASC';
        
        $res  = $this -> mDbPtr -> getAssoc($sql);

        return $res;
    }// GetDict


    private function GetCidByDictName($dictname)
    {
        return $this -> mDbPtr -> getOne('SELECT cid FROM '.$this -> mCtable.' WHERE dictname = \''.$dictname.'\'');
    }

    
}// End Dict
?>