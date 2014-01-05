<?php

/**
 * Object factory class for ResourceDay. 
 *
 * @see ResourceDay
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ResourceDayFactory extends DomainFactory
{
    /**
     * Creates ResourceDay instance. 
     *
     * @param array $a_aRow 
     * @return ResourceDay
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
