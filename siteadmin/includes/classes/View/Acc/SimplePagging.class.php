<?php
/**
 * ������� ����� ��� ������� ����������� ������������� ��������� (VIEW)
 *
 * ������ ������: 
 *
 * $this -> mPage -> GeneratePages('SELECT *  FROM test WHERE login = ?', -- ������
 *                                  array('admin'), -- �������������� ����������
 *                                  3,              -- ����� ������, � ������� �������� ����� ��� ��������
 *                                  20)             -- ���������� ������� �� ��������
 *
 * ������ ������ � ����� ����������: rows - ������, gp - ����� ��� ����������� � ����� ������� ��������
 *
 * ��� � ����� �����: ���� ������ � ���, ��� �����, ����� ������������ ������ � �������� 
 * �������. 
 *
 * @package    CrewedUp
 * @version    1.0
 * @since      24.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */
class View_Acc_SimplePagging 
{
    /**
     * ��������� �� ������ PEAR::DB
     * @var DB_common
     */
    private $moDb;

    /**
     * ��������� �� ������ ������������� Smarty
     * @var Smarty
     */
    private $moSmarty;

    /**
     * ���������� ��������� �� �������� ��-���������
     * @var int
     */
    private $mDefCnt;

    /**
     * ������ ������� $_REQUEST ��-���������, �� �������� ����� ���������� 
     * ������� ��������� ������� �������
     * @var string
     */
    private $mDefVar;

    /**
     * ����������� ������. �������������� ��� �������� �������.
     *
     * @param array  $dbObj    ������ � ����������� �� ���������� �������
     * @param int    $defCnt   ���������� ��������� �� �������� ��-���������
     * @param string $defVar   ������ ������� $_REQUEST ��-���������, 
     *                         �� �������� ����� ���������� ������� ���������
     *                         ������� �������
     *
     * @return void
     */
    public function __construct(&$glObj, $defCnt = 20, $defVar = 'pstart')
    {        
        $this -> moDb     =& $glObj['db'];
        $this -> moSmarty =& $glObj['smarty'];
        $this -> mDefCnt  =  $defCnt;
        $this -> mDefVar  =  $defVar;
    }

    /**
     * �������� ����� ��������� ������������� ���������
     * ������.
     *
     * @param string $query     sql-������ �� �������, �� ������! �������� 
     *                          LIMIT. ��� ������� LIMIT �� �������������
     *                          ����� ������
     * @param array  $params    ���������, ���� � ������� ������� �������������� 
     *                          ���������� ?. ��������� �������������� ���������� �����
     *                          SELECT � FROM.
     * @param string $retType   ��� ���������� ����� �����������
     *                          'array'  - ������� ������;
     *                          'object' - ������� ������ ������� ���������� PEAR::DB_Result
     * @param int    $pStart    ����� ��������, � �������� ������ ��������
     *                          (�������� -1 ������ ������ ����� ������� ���������,
     *                           ����� �������� ��� ��������;
     *                           �������� -2 ������� ������ ���������� ������� ��������
     *                           ������ ���������� �� ������� $_REQUEST, ������� ����������,
     *                           ��������� � ������������ ������, ��-���������, 'pstart')
     * @param int    $cnt       ��������� ���������� ����������� �� ��������, 
     *                          ���� �� �������, ������� ��������� � ������������-
     *                          ������ �������� �������
     *                          (�������� 0 ������ ������ ����� ������� ���������,
     *                           ����� �������� ��� ��������;
     *                           ���� ����� -1, �� ����� ����� ���������� ��-���������)
     * @param bool   $toSmarty  �������� ������ ����� �� � Smarty
     * @param string $smartyVar ��� ������� ������ Smarty (����� ����� ������ ��� $toSmarty == true)
     * @param mixed  $gSmarty   ��������� �� ������ ������������� Smarty,
     *                          ���� null, �� ������� ������ $this -> gSmarty
     * @return array            ������������� ������ $GP. $GP['gp'] ������ ���� �������
     *                          ��������� � Smarty, ���� $toSmarty == false.
     *                          $GP['rows']            - �������� ��� ������� ($retType == 'array')
     *                          $GP['obj']             - �������� ������ ������ ����������;
     *                          $GP['gp']['cnt']       - �������� ����� ���������� ��������� ��� ����������� (���������� �������������� ��� MySQL);
     *                          $GP['gp']['cntNow']    - �������� ���������� ������������ ���������;
     *                          $GP['gp']['pgArr']     - �������� ������, ����������� ���
     *                                                   ������������ ������������� ���������,
     *                                                   � ������ ������� ��������� ��������� ��� ������ ��������;
     *                          $GP['gp']['pages']     - ���������� �������;
     *                          $GP['gp']['�urPage']   - ������� ��������;
     *                          $GP['gp']['pStart']    - ������� ����� ��������;
     *                          $GP['gp']['ResOnPage'] - ���������� ��������� �� ��������.
     *                          
     *                          ���������� �������� false, ���� ������� ������
     *                         
     */
    public function &GeneratePages($query, $params = array(),   $pStart = -2, $resOnPage = -1, 
                                    $retType = 'object', $toSmarty = false, 
                                    $smartyVar = null,   $gSmarty = null,
                                    $topCnt = 0)
    {
        if (-1 == $resOnPage)
            $resOnPage = $this -> mDefCnt;

        $GP         = array();
        $GP['rows'] = array();

        if (-1 == $pStart || 0 == $resOnPage)
        {
            if ('object' == $retType)
            {
                $GP['obj']    = $this -> moDb -> query($query, $params);

                if (0 < $topCnt)
                {
                    $GP['gp']['cnt']    = $GP['obj'] -> numRows() - $topCnt;

                    for ($i = 0; $i < $topCnt; $i++)
                    {
                        $GP['obj'] -> fetchRow();
                    }

                }
                else
                    $GP['gp']['cnt']    = $GP['obj'] -> numRows();
            }
            else 
            {
                $GP['rows'] = $this -> moDb -> getAll($query, $params);
                
                if (0 < $topCnt)
                    array_splice($GP['rows'], 0, $topCnt);

                $GP['gp']['cnt']   = count($GP['rows']);
            }

            $GP['gp']['cntNow']    = $GP['gp']['cnt'];
            $GP['gp']['pgArr']     = array(0);
            $GP['gp']['pages']     = 1;
            $GP['gp']['curPage']   = 1;
            $GP['gp']['curPage10'] = 0;
            $GP['gp']['pStart']    = 0;
            $GP['gp']['ResOnPage'] = $GP['gp']['cnt'];
            return $GP;
        }

        // ��������� sql-������
        $matches = array();
        if (preg_match('/SELECT\s+(.+)\s+FROM\s+(.+)$/is', $query, $matches))
        {
            $columns    = $matches[1];
            $base_query = $matches[2];

            // ������� LIMIT, ���� ��� ����� ����� ��� ������� ���� ���� ������
            $base_query = preg_replace('/LIMIT\s+(.+)$/i', '', $base_query);
            
            // ��������� SQL-������ �� ��������� ���������� ���������
            // ������������ ��� ��� MySQL
            if (('mysql' == DB_TYPE || 'mysqli' == DB_TYPE) && 4.0 <= DB_MYSQL_VER )
            {
                $GP['obj']   = $this -> moDb -> limitQuery('SELECT SQL_CALC_FOUND_ROWS '.$columns.' FROM '.$base_query, $pStart + $topCnt, $resOnPage, $params);
                $GP['gp']['cntNow'] = $GP['obj'] -> numRows();
                    
                $GP['gp']['cnt'] = $this -> moDb -> getOne('SELECT FOUND_ROWS()') - $topCnt;

                if ('array' == $retType)
                {
                    while ($row = $GP['obj']->fetchRow())
                    {
                        $GP['rows'][] = $row;
                    }
                }
            }
            else
            {
                $varsCnt    = substr_count('?') - substr_count('\\?');
                $otParams   = array();
                $parCnt     = count($params);
                for ($i = $varsCnt; $i < $parCnt; $i++)
                {
                    $otParams[] = $params[$i];
                }
                
                $GP['gp']['cnt'] = $this -> moDb -> getOne('SELECT COUNT(*) FROM '.$base_query, $otParams) - $topCnt;
                
                $GP['obj']    = $this -> moDb -> limitQuery($query, $pStart + $topCnt, $resOnPage, $params);
                $GP['gp']['cntNow'] = $GP['obj'] -> numRows();

                if ('array' == $retType)
                {
                    while ($row = $GP['obj'] -> fetchRow())
                    {
                        $GP['rows'][] = $row;
                    }
                }
            }

            $GP['gp']['pStart']    = $pStart;
            $GP['gp']['pages']     = ceil($GP['gp']['cnt'] / $resOnPage);
            $GP['gp']['pgArr']     = array();
            for ($i = 0; $i < $GP['gp']['pages']; $i++)
            {
                $GP['gp']['pgArr'][] = $i * $resOnPage;
            }
    
            if (-2 == $pStart)
            {
                if (!isset($_REQUEST[$this ->mDefVar]))
                    return false;
                    
                $pStart = uintval($_REQUEST[$this ->mDefVar]);
            }
            $GP['gp']['curPage']   = floor($pStart / $resOnPage);
            $GP['gp']['ResOnPage'] = $resOnPage;

            $GP['gp']['curPage10'] = 10*floor($GP['gp']['curPage']/10);

            if ($toSmarty)
            {
                if (is_null($gSmarty))
                    $gSmarty = $this -> moSmarty;

                if (is_null($smartyVar))
                    return false;

                $gSmarty -> assign_by_ref($smartyVar, $GP['gp']);
            }
            
            return $GP;
        }
        else
            return false;
    }
}

?>