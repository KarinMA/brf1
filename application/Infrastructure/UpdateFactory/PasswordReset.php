<?php

/**
 * Update factory class for PasswordReset. 
 *
 * @see PasswordReset
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_PasswordReset extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['password_key'] = $a_oDomainObject->getPasswordKey();
        $aUpdate['expires_on'] = $a_oDomainObject->getExpiresOn();
        return $aUpdate;
    }
}
