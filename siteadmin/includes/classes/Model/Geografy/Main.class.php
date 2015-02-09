<?php
/**
 * Access to countries, subdivisions and cities
 * 
 * @package    CrewedUp
 * @version    1.0
 * @since      10.05.2009
 * @copyright  2007-2009 Engine37
 * @link       http://engine37.com
 */
class Model_Geografy_Main
{

    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;

    /**
     * Database table for country subdivisions
     * @var string
     */
    private $mSubDiv;

    
    /**
     * Constructor. Iniatilize base class variables
     *
     * @param array  $glObj    
     * @param array  $tables
     * @return void
     */
    public function __construct(&$glObj,  $tables)
    {
        $this -> mDbPtr  = $glObj['db'];
        $this -> mSubDiv = $tables['subdivs'];
    }#end constructor

    /**
     * Get all subdivisions for specified country
     * @param string $iso2_cntr unique country iso2-code
     * @return array 
     */
    public function &GetSubDiv($iso2_cntr)
    {
        $res = $this->mDbPtr->getAll('SELECT subdiv_id, name, code
                                       FROM '.$this->mSubDiv.'
                                       WHERE iso2_cntr = ?
                                       ORDER BY name ASC', array($iso2_cntr));
        return $res;

    }#GetSubDiv
    
    
    /**
     * Get all subdivisions for specified country 
     * @param string $iso2_cntr unique country iso2-code
     * @return array (assoc array)
     */
    public function &GetSubDivAssoc($iso2_cntr)
    {
        $db =  $this->mDbPtr->query('SELECT subdiv_id, name, code
                                     FROM '.$this->mSubDiv.'
                                     WHERE iso2_cntr = ?
                                     ORDER BY name ASC', array($iso2_cntr));
        $res = array();
        while ($row = $db -> FetchRow())
        {
            $res[$row['code']] = $row['name'];
        }
        return $res;

    }#GetSubDivAssoc
    
    
    public function GetSubDivName($subdiv_id)
    {
        return $this->mDbPtr->getRow('SELECT name, iso2_cntr
                                      FROM '.$this->mSubDiv.'
                                      WHERE subdiv_id = ?', array($subdiv_id));

    }#GetSubDivName
    
    
    public function GetSubDivCode($subdiv_id)
    {
        return $this->mDbPtr->getOne('SELECT code
                                      FROM '.$this->mSubDiv.'
                                      WHERE subdiv_id = ?', array($subdiv_id));

    }#GetSubDivCode
    
    
    public function GetSubDivByCode($code)
    {
    	$sql = 'SELECT subdiv_id, name, iso2_cntr FROM '.$this -> mSubDiv.' WHERE code = ?';
    	return $this -> mDbPtr -> getRow($sql, array($code));  	
    }#GetSubDivByCode
}
?>