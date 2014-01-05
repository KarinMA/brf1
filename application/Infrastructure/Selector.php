<?php

/**
 * Implements basic search criteria and a method for adding custom search parameters.
 * 
 * @author John
 */
abstract class Selector
{
   
    /**
     * Seach parameter data.
     * 
     * @var array
     */
    protected $_aSearchParameters;

    /**
     * Container for the equals conditions.
     *
     * @var array
     */
    private $_aEqualsConditions;
    
    /**
     * Initiate a selector
     *
     * @param string $a_sTableName 
     * @return Selector
     */
    function __construct($a_sTableName = null)
    {
        $this->_sTableName = $a_sTableName;
        $this->_aSearchParameters = array();
        $this->_aEqualsConditions = array();
    }

    /**
     * The main table name for the selector instance.
     *
     * @var string
     */
    private $_sTableName;

    /**
     * Constant for equals condition.
     * 
     * @var string
     */
    const CONDITION_EQUALS = 'equals';
    
    /**
     * This constant can used with where conditions that compare columns attributes, i.e. not supplied values
     * 
     * @var string
     */
    const CONDITION_EQUALS_NO_QUOTE = 'equals_no_quote';

    /**
     * Constant for greater than or equals condition.
     * 
     * @var string
     */
    const CONDITION_GTE = 'greater_than_or_equals';

    /**
     * Constant for less than or equals condition.
     * 
     * @var string
     */
    const CONDITION_LTE = 'less_than_or_equals';

    /**
     * Constant for greater than  condition.
     * 
     * @var string
     */
    const CONDITION_GT = 'greater_than';

    /**
     * Constant for less than condition.
     * 
     * @var string
     */
    const CONDITION_LT = 'less_than';

    /**
     * In an array.
     * 
     * @var string
     */
    const CONDITION_IN = 'IN';

    /**
     * In an array.
     * 
     * @var string
     */
    const CONDITION_NOT_IN = 'NOT IN';


    /**
     * Like condition, both ways: "%search%"
     * 
     * @var string
     */
    const CONDITION_LIKE_LEFT_AND_RIGHT = 'LIKE_L_R';

    /**
     * Like condition, leftward: "%search"
     * 
     * @var string
     */
    const CONDITION_LIKE_LEFT = 'LIKE_L';

    /**
     * Like condition, rightward: "search%"
     * 
     * @var string
     */
    const CONDITION_LIKE_RIGHT = 'LIKE_R';
    
    /**
     * IS NULL condition.
     *
     * @var string  
     */
    const CONDITION_IS_NULL = 'is_null';

    /**
     * Limit for the selection
     * 
     * @var int
     */
    private $_iLimit;
	
    /**
     * Set the 'id' property to search for.
     * 
     * @param int $a_iId
     * @return void
     */
    function setId($a_iId)
    {
        $sColumn = "`$this->_sTableName`.`id`";
        $this->_aEqualsConditions[$sColumn] = array($sColumn, $a_iId, self::CONDITION_EQUALS);
    }

    /**
     * Return the 'id' property that is searched for.
     * 
     * @return int 
     */
    function getId()
    {
        return @$this->_aEqualsConditions["`$this->_sTableName`.`id`"][1];
    }
	
    /**
     * Set or get the limit. 
     * 
     * @param int $a_iLimit
     * @return int|void
     */
    function limit($a_iLimit = false)
    {
        if ($a_iLimit === false) {
                return $this->_iLimit;
        }
        $this->_iLimit = $a_iLimit;
    }
		
    /**
     * Set the search parameters to use.
     * 
     * @param string $a_sParameterName	The parameter name
     * @param mixed $a_mParameterData	The data to compare with
     * @param string $a_sCondition 	The condition to use 
     * @return void
     */
    function setSearchParameter($a_sParameterName, $a_mParameterValue, $a_sCondition = self::CONDITION_EQUALS, $a_sSetMethod = null)
    {
        if (!is_null($a_mParameterValue)) {
            $this->_aSearchParameters[] = array($a_sParameterName, $a_mParameterValue, $a_sCondition, $a_sSetMethod);
        }	
    }
    
    /**
     * 
     * @var string
     */
    private $_sOrderBy;
    
    /**
     * Order by some condition
     *
     * @param string $a_sOrderBy 
     * @return void
     */
    function setOrderBy($a_sOrderBy = FALSE) 
    {
        if ($a_sOrderBy) {
            $this->_sOrderBy = $a_sOrderBy;
        }
    }
    
    function getOrderBy()
    {
        return $this->_sOrderBy ? " ORDER BY $this->_sOrderBy " : '';
    }
    
	
    /**
     * Returning the array of search parameters
     * 
     * @return array
     */
    function fetchSearchParameters()
    {
        $aParameters = array();

        // use the conditions set by convenience methods also
        foreach (array_merge($this->_aSearchParameters, $this->_aEqualsConditions) as $aParameterData) {
            $aParameters[] = new Selector_SearchParameter($aParameterData[0], $aParameterData[1], $aParameterData[2], array_key_exists(3, $aParameterData)?$aParameterData[3]:null);
        }

        return $aParameters;
    }
    
    function reset()
    {
        $this->_aSearchParameters = array();
    }
}
