<?php

/**
 * Object factory class for PasswordReset. 
 *
 * @see PasswordReset
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_PasswordResetFactory extends DomainFactory
{
    /**
     * Creates PasswordReset instance. 
     *
     * @param array $a_aRow 
     * @return PasswordReset
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
