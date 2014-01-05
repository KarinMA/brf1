<?php

/**
 * Object factory class for BrfRealtorCode. 
 *
 * @see BrfRealtorCode
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfRealtorCodeFactory extends DomainFactory
{
    /**
     * Creates BrfRealtorCode instance. 
     *
     * @param array $a_aRow 
     * @return BrfRealtorCode
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
