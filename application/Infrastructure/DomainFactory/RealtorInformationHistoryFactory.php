<?php

/**
 * Object factory class for RealtorInformationHistory. 
 *
 * @see RealtorInformationHistory
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_RealtorInformationHistoryFactory extends DomainFactory
{
    /**
     * Creates RealtorInformationHistory instance. 
     *
     * @param array $a_aRow 
     * @return RealtorInformationHistory
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
