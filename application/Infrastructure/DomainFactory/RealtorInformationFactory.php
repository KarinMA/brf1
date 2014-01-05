<?php

/**
 * Object factory class for RealtorInformation. 
 *
 * @see RealtorInformation
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_RealtorInformationFactory extends DomainFactory
{
    /**
     * Creates RealtorInformation instance. 
     *
     * @param array $a_aRow 
     * @return RealtorInformation
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
