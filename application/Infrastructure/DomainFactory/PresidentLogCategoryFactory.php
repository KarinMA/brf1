<?php

/**
 * Object factory class for PresidentLogCategory. 
 *
 * @see PresidentLogCategory
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_PresidentLogCategoryFactory extends DomainFactory
{
    /**
     * Creates PresidentLogCategory instance. 
     *
     * @param array $a_aRow 
     * @return PresidentLogCategory
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
