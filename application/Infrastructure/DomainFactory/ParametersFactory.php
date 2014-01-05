<?php

/**
 * Object factory class for Parameters. 
 *
 * @see Parameters
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ParametersFactory extends DomainFactory
{
    /**
     * Creates Parameters instance. 
     *
     * @param array $a_aRow 
     * @return Parameters
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
