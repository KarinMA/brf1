<?php

/**
 * Object factory class for BrfRealtorAdTime. 
 *
 * @see BrfRealtorAdTime
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfRealtorAdTimeFactory extends DomainFactory
{
    /**
     * Creates BrfRealtorAdTime instance. 
     *
     * @param array $a_aRow 
     * @return BrfRealtorAdTime
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
