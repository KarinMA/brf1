<?php

/**
 * Domain object class for PasswordReset. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class PasswordReset extends DomainObject 
{
    /**
     * PasswordReset's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * PasswordReset's 'password_key' property. 
     *
     * @var string
     */
    private $_sPasswordKey;

    /**
     * PasswordReset's 'expires_on' property. 
     *
     * @var string
     */
    private $_sExpiresOn;

    /**
     * Get PasswordReset's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set PasswordReset's 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        if (!is_null($this->_iUserId) && $this->_iUserId !== (int) $a_iUserId) {
            $this->_markModified();
        }
        $this->_iUserId = (int) $a_iUserId;
    }

    /**
     * The User.
     * 
     * @var User
     */
    private $_oUser;

    /**
     * Get the User.
     * 
     * @return User
     */
    function getUser()
    {
        return $this->_oUser;
    }

    /**
     * Set the User.
     * 
     * @param User $a_oUser
     * 
     * @return void
     */
    function setUser($a_oUser)
    {
        $this->_iUserId = $a_oUser->getId();
        $this->_oUser = $a_oUser;
    }

    /**
     * Get PasswordReset's 'password_key' property. 
     *
     * @return string
     */
    function getPasswordKey()
    {
        return (string) $this->_sPasswordKey;
    }

    /**
     * Set PasswordReset's 'password_key' property. 
     *
     * @param string $a_sPasswordKey
     * @return void
     */
    function setPasswordKey($a_sPasswordKey)
    {
        if (!is_null($this->_sPasswordKey) && $this->_sPasswordKey !== (string) $a_sPasswordKey) {
            $this->_markModified();
        }
        $this->_sPasswordKey = (string) $a_sPasswordKey;
    }

    /**
     * Get PasswordReset's 'expires_on' property. 
     *
     * @return string
     */
    function getExpiresOn()
    {
        return strlen($this->_sExpiresOn) ? (string) $this->_sExpiresOn : NULL;
    }

    /**
     * Set PasswordReset's 'expires_on' property. 
     *
     * @param string $a_sExpiresOn
     * @return void
     */
    function setExpiresOn($a_sExpiresOn)
    {
        if (!is_null($this->_sExpiresOn) && $this->_sExpiresOn !== (string) $a_sExpiresOn) {
            $this->_markModified();
        }
        $this->_sExpiresOn = (string) $a_sExpiresOn;
    }



    public static function create($a_iUserId, $a_sPasswordKey, $a_sExpiresOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('password_reset')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('password_reset')->write($oObject);
        }
        return $oObject;
    }

}
