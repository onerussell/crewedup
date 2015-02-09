<?php
/**
 * Static pages - text pages administration
 *
 * @package   engine37 Catalog v3.0
 * @version    0.1b
 * @since      10.01.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class Spages
{
    private $mCtable;    //Categories table name
    private $mTable;     //Table name
    private $mLink;      //Link filename
    private $mDbPtr;     //DB pointer

    private $mStype;     //search type ("or" || "and")
    private $mSstr ;     //search string
    private $mSar  ;     //array with search vars values (after explode)

    public function __construct($dbPtr,
                                $ctable = 'spagescat',
                                $table  = 'spages',
                                $link   = 'page.php')
    {
        $this -> mTable    =  $table;
        $this -> mCtable   =  $ctable;
        $this -> mLink     =  $link;
        $this -> mDbPtr    =  $dbPtr;
    }


#***************************************************
#    Edit methods
#***************************************************


    /**
    * Add and Update page in dB
    * @param array $ar with values
    * @param int $cached - image cached if == 1 else not cached
    * @param int $id - page id for Update (if Update)
    * @return bool true
    */
    public function AddPage($ar, $id = 0)
    {
        if ( $id == 0 || !is_numeric($id) )
        {
            $sql  =  'INSERT INTO '.$this -> mTable.' SET
                      cid      = ?,
                      pagename = ?,
                      name     = ?,
                      pagetext = ?,
                      keyw     = ?,
                      sortid   = ?';
        }
        else
        {
            $ar[] = $id;
            $sql  =  'UPDATE '.$this -> mTable.' SET
                      cid      = ?,
                      pagename = ?,
                      name     = ?,
                      pagetext = ?,
                      keyw     = ?,
                      sortid   = ?
                      WHERE id = ?';
        }
        $this -> mDbPtr -> query($sql, $ar);

        return true;
    }#AddPage


    /**
    * Delete page from dB
    *
    * @param int $id - page ID
    * @return bool true
    */
    function DelPage($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.']');
        }
        $sql = 'DELETE FROM '.$this -> mTable.' WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);
        return true;

    }#DelPage


    /**
    * Update page activity
    *
    * @param int $id  - page ID
    * @return bool - only true
    */
    public function ActivePage($id = 0)
    {
        if (!is_numeric($id))
            $id = 0;

        $sql = 'UPDATE '.$this -> mTable.' set active = not active WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);

        return true;
    }#ActivePge


    /**
    * Check unique page name
    *
    * @param string $fld  - page name
    * @return int 1 - if unique else return 0
    */
    public function CheckUniq($fld = '', $id = 0)
    {
        if ($fld == '')
            return 0;
        if ($id == 0 || !is_numeric($id))
            $sql = 'SELECT id FROM '.$this -> mTable.' WHERE lower(pagename) = "'.strtolower($fld).'"';
        else
            $sql = 'SELECT id FROM '.$this -> mTable.' WHERE id <> "'.$id.'" AND lower(pagename) = "'.strtolower($fld).'"';

        $db  = $this -> mDbPtr -> query($sql);
        if ($db -> numRows() > 0)
            return 0;
        else
            return 1;

    }#CheckUniq


    /**
    * Add and Update category in dB
    * @param array $ar with values
    * @param int $cid - category id for Update (if Update)
    * @return bool
    */
    public function AddCat($ar, $cid = 0)
    {
        if ( $cid == 0 || !is_numeric($cid) )
        {
            $sql  =  'INSERT INTO '.$this -> mCtable.' SET
                      name    = ?,
                      sortid  = ?,
                      parent  = ?';
        }
        else
        {
            $ar[] = $cid;
            $sql  = 'UPDATE '.$this -> mCtable.' SET
                     name     = ?,
                     sortid   = ?,
                     parent   = ?
                     WHERE cid = ?';
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
    public function DelCat($cid = 0)
    {
        if ($cid == 0 || !is_numeric($cid))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [cid = '.$cid.']');
        }
        #delete category
        $sql = 'delete from '.$this -> mCtable.' where cid = "'.$cid.'"';
        $this -> mDbPtr -> query($sql);

        #delete products in category
        $sql  = 'select id from '.$this -> mTable.' where cid = "'.$cid.'"';
        $db   =& $this -> mDbPtr -> query($sql);

        while ($row = $db -> fetchRow())
            $this -> DelPage($row['id']);

        #select all subcategories and delete it
        $sql = 'select cid from '.$this -> mCtable.' where parent = "'.$cid.'"';
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
    public function ActiveCat($cid = 0)
    {
        if (!is_numeric($cid))
            $cid = 0;
        $sql = 'update '.$this -> mCtable.' set active = not active where cid = "'.$cid.'"';
        $this -> mDbPtr -> query($sql);

        return true;
    }#ActiveCat


#***************************************************
#    Select methods
#***************************************************

    /**
    * Get page by ID
    *
    * @param int $id - page id
    * @param int $pagename - unique page name (if $id = 0 we can select by $pagename)
    * @param int $active - if $active == 1 - select only active page, else select all
    * @return array - hash with page information
    */
    public function GetPageInfo($id = 0, $pagename = '', $active = 0)
    {

        if ( $id <> 0 && is_numeric($id) )
        {
            $sql  = 'SELECT id, cid, pagename, name, active, pagetext, keyw, sortid
                     FROM '.$this -> mTable.'
                     WHERE id = "'.$id.'"';
        }
        elseif (trim($pagename) <> '')
        {
            $sql  = 'SELECT id, cid, pagename, name, active, pagetext, keyw, sortid
                     FROM '.$this -> mTable.'
                     WHERE pagename = "'.$pagename.'"';
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
        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';
        $row             = $db -> fetchRow();
        $row['name']     = stripslashes($row['name']);
        $row['sortid']   = stripslashes($row['sortid']);
        $row['pagetext'] = stripslashes($row['pagetext']);
        $row['keyw']     = stripslashes($row['keyw']);
        $row['link']     = $link.'ctg='.$row['cid'].'&pn='.$row['pagename'];
        return $row;

    }#GetPageInfo


    /**
    * Get Pages List
    *
    * @param int $active - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "name")
    * @parem int $nuse - not select element with id = $nuse
    * @return array - hash with values
    */
    public function GetPageList($ctg = 0, $active = 0, $sort = '', $nuse = 0)
    {
        if (trim($sort) == '')
            $sort = ' sortid, name';

        $sql = 'SELECT id, pagename, name, active, sortid, pagetext FROM '.$this -> mTable.
               ' WHERE cid = "'.$ctg.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';
        if ($nuse > 0)
            $sql .= ' AND id <> "'.$nuse.'"';
        $sql .= ' ORDER BY '.$sort;

        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        $db   =& $this -> mDbPtr -> query($sql);
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']         = stripslashes($row['name']);
            $row['pagetext']     = stripslashes($row['pagetext']);
            $row['link']         = $link.'ctg='.$ctg.'&pn='.$row['pagename'];
            $res[]               = $row;
        }
        return $res;

    }#GetPageList


    /**
    * Get category by CID
    *
    * @param int $cid - category id
    * @return array - hash with category values
    */
    public function GetCatInfo($cid = 0)
    {

        $sql         = 'select cid, name, sortid, parent from '.$this -> mCtable.' where cid = "'.$cid.'"';
        $db          =& $this -> mDbPtr -> query($sql);

        if ($db -> numRows() == 0)
        {
            $r = array();
			return $r;
        }
        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        $row             = $db -> fetchRow();
        $row['name']     = stripslashes($row['name']);
        $row['link']     = $link.'ctg='.$row['cid'];
        return $row;

    }#GetCatInfo


    /**
    * Get category parent ID by CID
    *
    * @param int $cid - category id
    * @return int - parent first level category ID
    */
    public function GetCatParent($cid = 0)
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
    public function GetCatList($parent = 0, $active = 1, $sort = '')
    {
        if (trim($sort) == '')
            $sort = 'sortid, name';

        $sql  = 'SELECT cid, name, sortid, parent, active
                 FROM '.$this -> mCtable.' WHERE parent = "'.$parent.'"';

        if ($active == 1)
            $sql .= ' and active = 1';
        $sql .= ' order by '.$sort;

        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        $db   =& $this -> mDbPtr -> query($sql);
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $row['link']     = $link.'ctg='.$row['cid'];
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
        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        while ($pr > 0)
        {
            $sql = 'select name, parent from '.$this -> mCtable.' where cid = "'.$pr.'"';
            $db  =& $this -> mDbPtr -> query($sql);

            if ($row = $db -> fetchRow())
            {
                $ar          = array('name' => stripslashes($row['name']),
                                     'link' => $link.'ctg='.$pr);
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


    /**
    * Get metatags
    *
    * @param int $cid - value of max category
    * @param int $id - page id
    * @param array $brc - array with breadcrumb
    * @return array - hash with values
    */
    function GetMeta($cid = 0, $id = 0, $brc = array())
    {

        $res['title'] = '';
        $res['descr'] = '';
        $res['keyw']  = '';
        $dl = ' - ';

        if (count($brc) > 0)
        {
            for ($j = count($brc) -1; $j >=0; $j--)
            {
                if ($res['title'] == '')
                    $res['title']  =  $brc[$j]['name'];
                else
                    $res['title'] .= $dl . $brc[$j]['name'];

                if ($res['descr'] == '')
                    $res['descr']  = $brc[$j]['name'];
                else
                    $res['descr'] .= ' ' . $brc[$j]['name'];

                if ($res['keyw'] == '')
                    $res['keyw'] = $brc[$j]['name'];
                else
                    $res['keyw'] .= ', ' . $brc[$j]['name'];
            }
        }

        if ($id > 0)
        {
            $sql = 'SELECT keyw FROM '.$this -> mTable.' WHERE id = "'.$id.'"';
            $db  =& $this -> mDbPtr -> query($sql);
            if ($db -> numRows() == 0)
            {
                $r = array();
			    return $r;
            }
            $row  = $db -> fetchRow();
            $keyw = explode(';', stripslashes($row['keyw']));
            for ($j = 0; $j < count($keyw); $j++)
            {
                if ($res['keyw'] == '')
                    $res['keyw'] = $keyw[$j];
                else
                    $res['keyw'] .= ', ' . $keyw[$j];
            }
        }

        return $res;

    }#GetMeta



    /**
    * Function for menu generation
    *
    * @param int $pctg - current category
    * @param string $st - current menu text
    * @param int $n - current menu level
    * @return string with menu
    */
    function GetCatMM($pctg, $st = '', $n = 1)
    {
        if ($n == 1)
            $fmc = '    ';
        else
            $fmc = '';
        #level1
        $lst1 = $this -> GetCatList($pctg, 1);
        $m = 0;
        $f = $n;
        if (count($lst1) > 0)
            if ($n == '1')
                $st .= 'stm_bp("p1",[1,4,0,0,0,3,0,0,100,"",-2,"",-2,60,2,2,"#C7D6D8","#2D507E","",3,1,1,"#2D507E"]);';
            else
                $st .= 'stm_bpx("p'.$f.'","p1",[1,4,0,0,0,3,0,7]); ';

        for ($i = 0; $i < count($lst1); $i++)
        {
            #level 2
            $lst2 = $this -> GetCatList($lst1[$i]['cid'], 1);

            if ($m == 0)
            {
                $s = 26 - strlen($lst1[$i]['name']);
                for ($a = 0; $a < $s; $a ++)
                   $lst1[$i]['name'] .= ' ';

            }

            if (count($lst2) > 0)
                $st .= 'stm_aix("p'.$f.'i'.$m.'","p0i0",[0,"'.$lst1[$i]['name'].'","","",-1,-1,0,"'.$lst1[$i]['link'].'","_self","","","","",0,0,0,"arrow_r.gif","arrow_r2.gif",7,7,0,0,1,"#2D507E",0,"#436485",0,"","",3,3,0,0,"#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","8pt '."'".'Arial'."'".','."'".'Verdana'."'".'"]);'."\n";
            else
                #$st .= 'stm_aix("p'.$f.'i'.$m.'","p1i1",[0,"'.$lst1[$i]['name'].'","","",-1,-1,0,"'.$lst1[$i]['link'].'"]);'."\n";
                $st .= 'stm_aix("p'.$f.'i'.$m.'","p0i0",[0,"'.$fmc.$lst1[$i]['name'].'","","",-1,-1,0,"'.$lst1[$i]['link'].'","_self","","","","",0,0,0,"","",0,0,0,0,1,"#2D507E",0,"#436485",0,"","",3,3,0,0,"#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","8pt \'Arial\',\'Verdana\'","8pt \'Arial\',\'Verdana\'"])'."\n";

            if (count($lst2) > 0)
            {
                $n ++;
                $o = 0;
                $st .= 'stm_bpx("p'.$n.'","p1",[1,2,0,0,0,3,0,0,100,"",-2,"",-2,60,2,2,"#C7D6D8","#2D507E"]);'."\n";
                for ($j = 0; $j < count($lst2); $j++)
                {
                    $s = 26 - strlen($lst2[$j]['name']);
                    for ($a = 0; $a < $s; $a ++)
                        $lst2[$j]['name'] .= ' ';

                        #$st .= 'stm_aix("p'.$n.'i'.$o.'","p1i0",[0,"'.$lst2[$j]['name'].'","","",-1,-1,0,"'.$lst2[$j]['link'].'"]);'."\n";
                        #$st .= 'stm_aix("p'.$n.'i'.$o.'","p2i0",[0,"'.$lst2[$j]['name'].'","","",-1,-1,0,"'.$lst2[$j]['link'].'","_self","","","","",0,0,0,"arrow_r.gif","arrow_r2.gif",7,7,0,0,1,"#2D507E",0,"#436485",0,"","",3,3,0,0,"#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","8pt '."'".'Arial'."'".','."'".'Verdana'."'".'"]);'."\n";
                        $st .= 'stm_aix("p'.$n.'i'.$o.'","p1i0",[0,"'.$lst2[$j]['name'].'","","",-1,-1,0,"'.$lst2[$j]['link'].'","_self","","","","",0,0,0,"","",7,7,0,0,1,"#2D507E",0,"#436485",0,"","",3,3,0,0,"#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","8pt \'Arial\',\'Verdana\'"]);'."\n";

                    $o ++;
                }
                $st .= 'stm_ep();'."\n"."\n";
            }
            $m ++;
        }
        if (count($lst1) > 0)
            $st .= 'stm_ep();'."\n"."\n";
       return array($st, $n);
    }#GetCatMM



    /**
    * Prepare data for search
    *
    * @param string $sstr   - search request
    * @param string $stype  - search type
    * @return true only
    */
    public function PrepSearch($sstr = '', $stype = 'or')
    {
        $this -> mStype = $stype;        #type
        $this -> mSstr  = trim($sstr);   #search string
        $this -> StrToAr();              #prepare search array

    }#PrepSearch


    /**
    * Prepare search array - explode search string
    *
    * @param void
    * @return array with field list
    */
    private function StrToAr()
    {
        $res  = array();
        if ($this->mSstr <> '')
        {
            $res = explode(' ', $this -> mSstr);
            for ($i = 0; $i < count($res); $i++)
                $res[$i] = addslashes(trim($res[$i]));
        }
        $this -> mSar = $res;
        return $res;
    }# StrToAr


    /**
    * prepare search list for select query
    *
    * @param array $sf - array with fields for search
    * @return string with field list
    */
    private function FormSQ($sf = array())
    {
        $st='';
        for ($i=0; $i < count($this -> mSar); $i++)
        {
            if ($st <> '')
                $st.=' '.$this -> mStype.' ';
            $st.='(';
            for ($j = 0; $j < count($sf); $j++)
            {
                if ($j > 0)
                    $st .= ' '.'or'.' ';
                $st .= $sf[$j] . ' like "%" "' . $this -> mSar[$i] . '" "%"';
            }
            $st .= ')';
        }
        return '('.$st.')';

    }#Form

    /**
    * Search categories and pages
    *
    * @param void
    * @return array - hash with products values and product count value
    */
    public function Search()
    {

        $st  = $this -> FormSQ(array('pagename', 'name', 'pagetext', 'keyw'));
        $sql = 'select distinct(id)
                from '.$this -> mTable.'
                where '.$st.' and active = 1';

        $db   =& $this -> mDbPtr -> query($sql);

        $res['pages'] = array();
        while ($row = $db -> fetchRow())
        {
            $res['pages'][]  = $this -> GetPageInfo($row['id']);
        }

        $st  = $this -> FormSQ(array('name', 'descr', 'keyw'));
        $sql = 'select distinct(cid)
                from '.$this -> mCtable.'
                where '.$st.' and active = 1';

        $db   =& $this -> mDbPtr -> query($sql);

        $res['cat'] = array();
        while ($row = $db -> fetchRow())
        {
            $res['cat'][]  = $this -> GetCatInfo($row['cid']);
        }

        return $res;

    }#Search


}#End Spages
?>