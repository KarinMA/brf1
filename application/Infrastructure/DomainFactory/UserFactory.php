<?php

/**
 * Object factory class for User. 
 *
 * @see User
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_UserFactory extends DomainFactory
{
    /**
     * Creates User instance. 
     *
     * @param array $a_aRow 
     * @return User
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
