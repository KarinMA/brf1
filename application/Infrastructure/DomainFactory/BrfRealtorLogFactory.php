<?php

/**
 * Object factory class for BrfRealtorLog. 
 *
 * @see BrfRealtorLog
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfRealtorLogFactory extends DomainFactory
{
    /**
     * Creates BrfRealtorLog instance. 
     *
     * @param array $a_aRow 
     * @return BrfRealtorLog
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
