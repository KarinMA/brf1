<?php

/**
 * Base class for domain objects.
 * 
 * Contains constructor and magic helper methods, 
 * aswell as a setter and getter for the id attribute
 * which is common to all domain objects.
 * 
 * @author John
 *
 */
abstract class DomainObject 
{
    /**
     * The object's database id.
     *
     * @var int
     */
    protected $_iId;
    
    /**
     * Construct with the id property.
     *
     * @param int|null $a_iId 
     */
    function __construct($a_iId = null)
    {
        $this->_iId = is_null($a_iId) ? $a_iId : (int) $a_iId;
        if (is_null($a_iId)) {
            $this->_markNew();
        }
    }
    
    /**
     * Get 'id' property.
     *
     * @return int
     */
    function getId()
    {
        return $this->_iId;
    }
    
    /**
     * Set 'id' property.
     *
     * @param int $a_iId 
     */
    function setId($a_iId)
    {
        if ($this->_iId && $this->_iId !== (int) $a_iId) {
            $this->_markModified();
        }
        $this->_iId = (int) $a_iId;
    }
    
    /**
     * This function is used by magic methods __get and __set to transform
     * database column name to object property name.
     *
     * @param string $a_sProperty
     * @return string
     */
    private function _propertyNameConverter($a_sProperty)
    {
        return ucfirst(preg_replace("/(_)(\w)/e", "strtoupper('\\2')", $a_sProperty));
    }

    /**
     * Helper method to get a property by its database column name.
     *
     * @param string $a_sProperty
     * @return mixed
     */
    function __get($a_sProperty) 
    {
        // convert property name
        $sMethod = 'get'.$this->_propertyNameConverter($a_sProperty);
        if (method_exists($this, $sMethod)) {
                return $this->{"$sMethod"}();
        }
        return null;
    }

    /**
     * Helper method to set properties for domain objects. The name
     * of the property must correspond to the database column name
     * of the property.
     *
     * @param string $a_sProperty
     * @param mixed $a_sValue 
     * @return void
     */
    function __set($a_sProperty, $a_sValue) 
    {
        // convert property name
        $sMethod = 'set'.$this->_propertyNameConverter($a_sProperty);
        if (method_exists($this, $sMethod)) {
                $this->{"$sMethod"}(mysql_real_escape_string($a_sValue));
        }
    }
    
    /**
     * Mark this as a modified object scheduled for write operation.
     *
     * @return void 
     */
    protected final function _markModified()
    {
        DomainWatcher::addModifiedObject($this);
    }
    
    /**
     * Mark the object as a new object
     *
     * @return void 
     */
    protected function _markNew() 
    {
        DomainWatcher::addNewObject($this);
    }
    
    /**
     * Delete from the domain.
     *
     * @return void 
     */
    public function delete() 
    {
        DomainWatcher::addDeletedObject($this);
    }
}
