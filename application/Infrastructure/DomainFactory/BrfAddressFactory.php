<?php

/**
 * Object factory class for BrfAddress. 
 *
 * @see BrfAddress
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfAddressFactory extends DomainFactory
{
    /**
     * Creates BrfAddress instance. 
     *
     * @param array $a_aRow 
     * @return BrfAddress
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
