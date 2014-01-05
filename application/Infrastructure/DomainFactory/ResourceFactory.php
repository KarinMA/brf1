<?php

/**
 * Object factory class for Resource. 
 *
 * @see Resource
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ResourceFactory extends DomainFactory
{
    /**
     * Creates Resource instance. 
     *
     * @param array $a_aRow 
     * @return Resource
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
