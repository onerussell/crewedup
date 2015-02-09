<?php
/**
 * Simple pagging class (VIEW)
 *
 * @package    Engine37 catalog
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine37Team
 * @link       http://Engine37.com
 */
class View_Acc_SimplePagging 
{
    /**
     * Указатель на объект PEAR::DB
     * @var DB_common
     */
    private $mDbPtr;

    /**
     * Указатель на объект шаблонизатора Smarty
     * @var Smarty
     */
    private $mSmarty;

    /**
     * Количество элементов на страницу по-умолчанию
     * @var int
     */
    private $mDefCnt;

    /**
     * Индекс массива $_REQUEST по-умолчанию, по которому можно определить 
     * текущий начальный элемент сраницы
     * @var string
     */
    private $mDefVar;

    /**
     * Конструктор класса. Инициализирует все свойства объекта.
     *
     * @param array  $dbObj    массив с указателями на глобальные объекты
     * @param int    $defCnt   количество элементов на страницу по-умолчанию
     * @param string $defVar   индекс массива $_REQUEST по-умолчанию, 
     *                         по которому можно определить текущий начальный
     *                         элемент сраницы
     *
     * @return void
     */
    public function __construct(&$glObj, $defCnt = 20, $defVar = 'pstart')
    {        
        $this -> mDbPtr  =& $glObj['db'];
        $this -> mSmarty =& $glObj['smarty'];
        $this -> mDefCnt =  $defCnt;
        $this -> mDefVar =  $defVar;
    }

    /**
     * Основной метод генерации постраничного просмотра
     * модуля.
     *
     * @param string $query     sql-запрос на выборку, не должен! включать 
     *                          LIMIT. При наличии LIMIT он автоматически
     *                          будет удален
     * @param array  $params    параметры, если в запросе имеются подстановочные 
     *                          переменные ?. Корректно обрабатываются переменные между
     *                          SELECT и FROM.
     * @param string $retType   как возвращать набор результатов
     *                          'array'  - готовый массив;
     *                          'object' - возврат только объекта результата PEAR::DB_Result
     * @param int    $pStart    номер элемента, с которого начать просмотр
     *                          (значение -1 делает данный метод простой заглушкой,
     *                           будут выведены все элементы;
     *                           значение -2 говорит методу попытаться извлечь значение
     *                           данной переменной из массива $_REQUEST, берется переменная,
     *                           указанная в конструкторе класса, по-умолчанию, 'pstart')
     * @param int    $cnt       требуемое количество результатов на страницу, 
     *                          если не указано, берется указанное в соответветст-
     *                          вующем свойстве объекта
     *                          (значение 0 делает данный метод простой заглушкой,
     *                           будут выведены все элементы;
     *                           если равно -1, то будет взято количество по-умолчанию)
     * @param bool   $toSmarty  передать массив сразу же в Smarty
     * @param string $smartyVar имя массива внутри Smarty (имеет смысл только для $toSmarty == true)
     * @param mixed  $gSmarty   указатель на объект шаблонизатора Smarty,
     *                          если null, то берется объект $this -> gSmarty
     * @return array            ассоциативный массив $GP. $GP['gp'] должен быть передан
     *                          полностью в Smarty, если $toSmarty == false.
     *                          $GP['rows']            - содержит всю выборку ($retType == 'array')
     *                          $GP['obj']             - содержит ссылку объект результата;
     *                          $GP['gp']['cnt']       - содержит общее количество элементов без ограничений (нахождение оптимизировано для MySQL);
     *                          $GP['gp']['cntNow']    - содержит количество возвращенных элементов;
     *                          $GP['gp']['pgArr']     - содержит массив, необходимый для
     *                                                   формирования постраничного просмотра,
     *                                                   а именно индексы начальных элементов для каждой страницы;
     *                          $GP['gp']['pages']     - количество страниц;
     *                          $GP['gp']['сurPage']   - текущая страница;
     *                          $GP['gp']['pStart']    - текущий номер элемента;
     *                          $GP['gp']['ResOnPage'] - количество элементов на странице.
     *                          
     *                          Генерирует значение false, если имеются ошибки
     *                         
     */
    public function &GeneratePages($query, $params = array(),   $pStart = -2, $resOnPage = -1, 
                                    $retType = 'object', $toSmarty = false, 
                                    $smartyVar = null,   $gSmarty = null,
                                    $topCnt = 0)
    {
        if (-1 == $resOnPage)
            $resOnPage = $this -> mDefCnt;

        $GP = array();            

        if (-1 == $pStart || 0 == $resOnPage)
        {
            if ('object' == $retType)
            {
                $GP['obj']    = $this -> mDbPtr -> query($query, $params);

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
                $GP['rows'] = $this -> mDbPtr -> getAll($query, $params);
                
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

        // Разбираем sql-запрос
        $matches = array();
        if (preg_match('/SELECT\s+(.+)\s+FROM\s+(.+)$/is', $query, $matches))
        {
            $columns    = $matches[1];
            $base_query = $matches[2];

            // Убираем LIMIT, если это имеет смысл для данного типа базы данных
            $base_query = preg_replace('/LIMIT\s+(.+)$/i', '', $base_query);
            
            // Формируем SQL-запрос на получение количества элементов
            // Оптимизируем его под MySQL
            if (('mysql' == DB_TYPE || 'mysqli' == DB_TYPE) && 4.0 <= DB_MYSQL_VER )
            {
                $GP['obj']   = $this -> mDbPtr -> limitQuery('SELECT SQL_CALC_FOUND_ROWS '.$columns.' FROM '.$base_query, $pStart + $topCnt, $resOnPage, $params);
                $GP['gp']['cntNow'] = $GP['obj'] -> numRows();
                    
                $GP['gp']['cnt'] = $this -> mDbPtr -> getOne('SELECT FOUND_ROWS()') - $topCnt;

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
                
                $GP['gp']['cnt'] = $this -> mDbPtr -> getOne('SELECT COUNT(*) FROM '.$base_query, $otParams) - $topCnt;
                
                $GP['obj']    = $this -> mDbPtr -> limitQuery($query, $pStart + $topCnt, $resOnPage, $params);
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
                    $gSmarty = $this -> mSmarty;

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