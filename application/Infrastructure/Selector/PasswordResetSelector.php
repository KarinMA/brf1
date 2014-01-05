<?php

/**
 * Selector class for PasswordReset. 
 *
 * @see PasswordReset
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_PasswordResetSelector extends Selector 
{


    /**
     * PasswordReset selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * PasswordReset selector's 'password_key' property. 
     *
     * @var string
     */
    private $_sPasswordKey;

    /**
     * PasswordReset selector's 'expires_on' property. 
     *
     * @var string
     */
    private $_sExpiresOn;
    /**
     * Get PasswordReset selector's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set PasswordReset selector's 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        $this->_iUserId = (int) $a_iUserId;
        $this->setSearchParameter('user_id', $this->_iUserId);
    }

    /**
     * Get PasswordReset selector's 'password_key' property. 
     *
     * @return string
     */
    function getPasswordKey()
    {
        return (string) $this->_sPasswordKey;
    }

    /**
     * Set PasswordReset selector's 'password_key' property. 
     *
     * @param string $a_sPasswordKey
     * @return void
     */
    function setPasswordKey($a_sPasswordKey)
    {
        $this->_sPasswordKey = (string) $a_sPasswordKey;
        $this->setSearchParameter('password_key', $this->_sPasswordKey);
    }

    /**
     * Get PasswordReset selector's 'expires_on' property. 
     *
     * @return string
     */
    function getExpiresOn()
    {
        return (string) $this->_sExpiresOn;
    }

    /**
     * Set PasswordReset selector's 'expires_on' property. 
     *
     * @param string $a_sExpiresOn
     * @return void
     */
    function setExpiresOn($a_sExpiresOn)
    {
        $this->_sExpiresOn = (string) $a_sExpiresOn;
        $this->setSearchParameter('expires_on', $this->_sExpiresOn);
    }

}
