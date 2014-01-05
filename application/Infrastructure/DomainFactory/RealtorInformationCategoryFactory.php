<?php

/**
 * Object factory class for RealtorInformationCategory. 
 *
 * @see RealtorInformationCategory
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_RealtorInformationCategoryFactory extends DomainFactory
{
    /**
     * Creates RealtorInformationCategory instance. 
     *
     * @param array $a_aRow 
     * @return RealtorInformationCategory
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
