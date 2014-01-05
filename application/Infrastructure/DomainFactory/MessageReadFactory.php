<?php

/**
 * Object factory class for MessageRead. 
 *
 * @see MessageRead
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_MessageReadFactory extends DomainFactory
{
    /**
     * Creates MessageRead instance. 
     *
     * @param array $a_aRow 
     * @return MessageRead
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
