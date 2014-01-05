<?php

/**
 * Object factory class for BrfFelanmalan. 
 *
 * @see BrfFelanmalan
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfFelanmalanFactory extends DomainFactory
{
    /**
     * Creates BrfFelanmalan instance. 
     *
     * @param array $a_aRow 
     * @return BrfFelanmalan
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
