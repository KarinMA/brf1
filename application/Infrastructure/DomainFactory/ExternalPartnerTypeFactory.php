<?php

/**
 * Object factory class for ExternalPartnerType. 
 *
 * @see ExternalPartnerType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ExternalPartnerTypeFactory extends DomainFactory
{
    /**
     * Creates ExternalPartnerType instance. 
     *
     * @param array $a_aRow 
     * @return ExternalPartnerType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
