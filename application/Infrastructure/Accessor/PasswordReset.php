<?php

/**
 * Database accessor class for PasswordReset. 
 *
 * @see Accessor 
 * @see PasswordReset
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_PasswordReset extends Accessor
{


    /**
     * Get PasswordResets by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getPasswordResetsByUserId($a_iUserId)
    {
        $oPasswordResetSelector = getPasswordResetSelector();
        $oPasswordResetSelector->setUserId($a_iUserId);
        $oPasswordResetCollection = $this->read($oPasswordResetSelector);
        return $oPasswordResetCollection;

    }

    /**
     * Get PasswordResets by 'password_key' property. 
     *
     * @param string $a_sPasswordKey
     * @return Collection
     */
    function getPasswordResetsByPasswordKey($a_sPasswordKey)
    {
        $oPasswordResetSelector = getPasswordResetSelector();
        $oPasswordResetSelector->setPasswordKey($a_sPasswordKey);
        $oPasswordResetCollection = $this->read($oPasswordResetSelector);
        return $oPasswordResetCollection;

    }

    /**
     * Get PasswordResets by 'expires_on' property. 
     *
     * @param string $a_sExpiresOn
     * @return Collection
     */
    function getPasswordResetsByExpiresOn($a_sExpiresOn)
    {
        $oPasswordResetSelector = getPasswordResetSelector();
        $oPasswordResetSelector->setExpiresOn($a_sExpiresOn);
        $oPasswordResetCollection = $this->read($oPasswordResetSelector);
        return $oPasswordResetCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'password_reset', 'PasswordReset', new SelectionFactory_PasswordReset(), new DomainFactory_PasswordResetFactory(), new UpdateFactory_PasswordReset(), array(
            array('user', array('linked_object', 'user_id', 'setUser')), // gets product with product id
        ));
    }




}
