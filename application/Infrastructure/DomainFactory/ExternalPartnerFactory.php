<?php

/**
 * Object factory class for ExternalPartner. 
 *
 * @see ExternalPartner
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ExternalPartnerFactory extends DomainFactory
{
    /**
     * Creates ExternalPartner instance. 
     *
     * @param array $a_aRow 
     * @return ExternalPartner
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
