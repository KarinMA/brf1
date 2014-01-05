<?php

/**
 * Object factory class for ResourceType. 
 *
 * @see ResourceType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ResourceTypeFactory extends DomainFactory
{
    /**
     * Creates ResourceType instance. 
     *
     * @param array $a_aRow 
     * @return ResourceType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
