<?php

/**
 * Object factory class for WebformActivation. 
 *
 * @see WebformActivation
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_WebformActivationFactory extends DomainFactory
{
    /**
     * Creates WebformActivation instance. 
     *
     * @param array $a_aRow 
     * @return WebformActivation
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
