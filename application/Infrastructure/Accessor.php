<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

abstract class Accessor
{
    /**
     *
     * @var resource
     */
    protected static $_rDatabaseConnection;
    
    /**
     *
     * @param resource $a_rDatabaseConnection 
     * @return voice
     */
    public static final function setDatabaseConnection($a_rDatabaseConnection)
    {
        self::$_rDatabaseConnection = $a_rDatabaseConnection;
    }
    
    
    /**
     *
     * @var DomainObjectAssembler
     */
    protected $_oDomainObjectAssembler;
    
    public final function __construct()
    {
        $this->_oDomainObjectAssembler = $this->_initializeDomainObjectAssembler();
    }

    protected abstract function _initializeDomainObjectAssembler();
    
    /**
     *
     * @param Selector $a_oSelector
     * @return Collection 
     */
    public final function read(Selector $a_oSelector)
    {
        $oCollection = $this->_oDomainObjectAssembler->read($a_oSelector);
        if ($oCollection->size()) {
            DomainWatcher::addCollection($oCollection, $this);
        }
        $a_oSelector->reset();
        return $oCollection;
    }
    
    /**
     * Read just one object.
     *
     * @param Selector $a_oSelector
     * @return DomainObject
     * @throws DomainObjetException 
     */
    public final function readOne(Selector $a_oSelector)
    {
        $oObjectCollection = $this->read($a_oSelector);
        if ($oObjectCollection->size() > 1) {
            throw new DomainObjectException("Reading one object failed", -2);
        } else {
            return $oObjectCollection->size() ? $oObjectCollection->current() : NULL;
        }
    }
    

    public final function write(DomainObject $a_oDomainObject, Selector $a_oSelector = NULL)
    {
        try {
            $this->_oDomainObjectAssembler->write($a_oDomainObject, $a_oSelector);
        } catch (SQLException $oSqlException) {
            throw new DomainObjectException("Error when updating domain object", -3, $oSqlException);
        }
    }
    
    public final function delete(DomainObject $a_oDomainObject) {
        try {
            $this->_oDomainObjectAssembler->delete($a_oDomainObject);
        } catch (SQLException $oSqlException) {
            throw new DomainObjectException("Failed to delete domain object", $oSqlException->getCode(), $oSqlException);
        }
    }
    
    public final function getAll($a_sOrderBy = FALSE)
    {
        $oSelector = $this->_getSelector();
        if ($a_sOrderBy) {
            $oSelector->setOrderBy($a_sOrderBy);
        }
        return $this->_oDomainObjectAssembler->read($oSelector);
    }
    
    /**
     *
     * @param int $a_iId 
     * @return Customer
     */
    public final function getById($a_iId)
    {
        $oSelector = $this->_getSelector();
        $oSelector->setId($a_iId);
        return $this->readOne($oSelector);
    }
    
    private function _getSelector() 
    {
        $oSelector = call_user_func_array("get".str_replace("Accessor_", "", get_class($this))."Selector", array());
        return $oSelector;
    }
}



?>
