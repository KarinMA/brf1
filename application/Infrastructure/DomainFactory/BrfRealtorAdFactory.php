<?php

/**
 * Object factory class for BrfRealtorAd. 
 *
 * @see BrfRealtorAd
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfRealtorAdFactory extends DomainFactory
{
    /**
     * Creates BrfRealtorAd instance. 
     *
     * @param array $a_aRow 
     * @return BrfRealtorAd
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
