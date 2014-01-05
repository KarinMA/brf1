<?php

/**
 * Object factory class for PresidentLog. 
 *
 * @see PresidentLog
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_PresidentLogFactory extends DomainFactory
{
    /**
     * Creates PresidentLog instance. 
     *
     * @param array $a_aRow 
     * @return PresidentLog
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
