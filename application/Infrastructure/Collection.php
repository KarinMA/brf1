<?php

/**
 * Abstract class for collection of domain objects
 * 
 * @author John
 *
 */
class Collection implements Iterator
{
	protected $_iRows = 0;
        
        
        protected $_aIdIndex = array();
	
	private $_iIndex = 0;
	
	protected $_aRows;
	
	protected $_oFactory;

	private $_aDomainObjects = array();
	
	/**
	 * Initialize a collection.
	 * 
	 * @param array $a_aRows
	 * @param DomainFactory $a_oDomainFactory
	 * @return Collection
	 */
	function __construct(DomainFactory $a_oDomainFactory = null, array $a_aRows = array())
	{
            $this->_aRows = array_key_exists(0, $a_aRows) ? $a_aRows : (empty($a_aRows) ? array() : array($a_aRows));
            $this->_iRows = count($this->_aRows);
            $this->_oFactory = $a_oDomainFactory;
            
            $iIdIndexing = 0;
            foreach ($a_aRows as $aRow) {
                $this->_aIdIndex[$aRow['id']] = $iIdIndexing++;
                $this->_aDomainObjects[] = $this->_oFactory->createDomainObject($aRow);
            }
	}
	
	/**
	 * Return the size of the collection.
	 *
	 * @return int
	 */
	function size()
	{
            return $this->_iRows;
	}
	
	/**
		Here follows the implementation of the iterator interface for collections.

	 */
	
	/**
	 * 
	 * 
	 */
	function rewind()
	{
		$this->_iIndex = 0;
	}
	
	function key()
	{
		return $this->_iIndex;
	}
	
	private function _getRow($a_iIndex)
	{
		if (isset($this->_aDomainObjects[$a_iIndex])) {
			return $this->_aDomainObjects[$a_iIndex];
		}	
		
		if (isset($this->_aRows[$a_iIndex])) { 
			$this->_aDomainObjects[$a_iIndex] = $this->_oFactory->createDomainObject($this->_aRows[$a_iIndex]);	
                        return $this->_aDomainObjects[$a_iIndex];
		}
		
		return null;
	}
	
	function next()
	{
		$this->_iIndex++;
	}
	
	function current()
	{
		return $this->_getRow($this->_iIndex);
	}
	
	function valid()
	{
		return (boolean) $this->current();
	}
        
        function addObject(DomainObject $a_oObject)
        {
            $this->_aDomainObjects[] = $a_oObject;
            if ($a_oObject->getId()) {
                $this->_aIdIndex[$a_oObject->getId()] = $this->_iRows++;
            }
        }
        
        
        function getById($a_iId) {
            return $this->_getRow($this->_aIdIndex[$a_iId]);
        }
        
        function getKeys()
        {
            return array_keys($this->_aIdIndex);
        }
}