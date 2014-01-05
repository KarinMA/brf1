<?php

/**
 * Object factory class for Message. 
 *
 * @see Message
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_MessageFactory extends DomainFactory
{
    /**
     * Creates Message instance. 
     *
     * @param array $a_aRow 
     * @return Message
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
