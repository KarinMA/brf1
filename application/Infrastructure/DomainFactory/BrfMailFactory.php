<?php

/**
 * Object factory class for BrfMail. 
 *
 * @see BrfMail
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfMailFactory extends DomainFactory
{
    /**
     * Creates BrfMail instance. 
     *
     * @param array $a_aRow 
     * @return BrfMail
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
