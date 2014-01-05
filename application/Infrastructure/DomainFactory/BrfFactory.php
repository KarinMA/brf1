<?php

/**
 * Object factory class for Brf. 
 *
 * @see Brf
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfFactory extends DomainFactory
{
    /**
     * Creates Brf instance. 
     *
     * @param array $a_aRow 
     * @return Brf
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
