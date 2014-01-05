<?php

/**
 * Object factory class for RealtorInformationType. 
 *
 * @see RealtorInformationType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_RealtorInformationTypeFactory extends DomainFactory
{
    /**
     * Creates RealtorInformationType instance. 
     *
     * @param array $a_aRow 
     * @return RealtorInformationType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
