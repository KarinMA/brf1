<?php

/**
 * Domain object class for MailReceiver. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class MailReceiver extends DomainObject 
{
    /**
     * MailReceiver's 'mail_id' property. 
     *
     * @var int
     */
    private $_iMailId;

    /**
     * MailReceiver's 'is_read' property. 
     *
     * @var bool
     */
    private $_bIsRead;

    /**
     * MailReceiver's 'read_on' property. 
     *
     * @var string
     */
    private $_sReadOn;

    /**
     * MailReceiver's 'to_user_id' property. 
     *
     * @var int
     */
    private $_iToUserId;

    /**
     * MailReceiver's 'hidden' property. 
     *
     * @var bool
     */
    private $_bHidden;

    /**
     * Get MailReceiver's 'mail_id' property. 
     *
     * @return int
     */
    function getMailId()
    {
        return (int) $this->_iMailId;
    }

    /**
     * Set MailReceiver's 'mail_id' property. 
     *
     * @param int $a_iMailId
     * @return void
     */
    function setMailId($a_iMailId)
    {
        if (!is_null($this->_iMailId) && $this->_iMailId !== (int) $a_iMailId) {
            $this->_markModified();
        }
        $this->_iMailId = (int) $a_iMailId;
    }

    /**
     * The Mail.
     * 
     * @var Mail
     */
    private $_oMail;

    /**
     * Get the Mail.
     * 
     * @return Mail
     */
    function getMail()
    {
        return $this->_oMail;
    }

    /**
     * Set the Mail.
     * 
     * @param Mail $a_oMail
     * 
     * @return void
     */
    function setMail($a_oMail)
    {
        $this->_iMailId = $a_oMail->getId();
        $this->_oMail = $a_oMail;
    }

    /**
     * Get MailReceiver's 'is_read' property. 
     *
     * @return bool
     */
    function getIsRead()
    {
        return (bool) $this->_bIsRead;
    }

    /**
     * Set MailReceiver's 'is_read' property. 
     *
     * @param bool $a_bIsRead
     * @return void
     */
    function setIsRead($a_bIsRead)
    {
        if (!is_null($this->_bIsRead) && $this->_bIsRead !== (bool) $a_bIsRead) {
            $this->_markModified();
        }
        $this->_bIsRead = (bool) $a_bIsRead;
    }

    /**
     * Get MailReceiver's 'read_on' property. 
     *
     * @return string|null
     */
    function getReadOn()
    {
        return is_null($this->_sReadOn) ? NULL : (string) $this->_sReadOn;
    }

    /**
     * Set MailReceiver's 'read_on' property. 
     *
     * @param string|null $a_sReadOn
     * @return void
     */
    function setReadOn($a_sReadOn)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sReadOn) ? NULL : ((string) $a_sReadOn);
            if ($mCompareValue !== $this->_sReadOn) {
                $this->_markModified();
            }
        }
        $this->_sReadOn = is_null($a_sReadOn) ? NULL : (string) $a_sReadOn;
    }

    /**
     * Get MailReceiver's 'to_user_id' property. 
     *
     * @return int
     */
    function getToUserId()
    {
        return (int) $this->_iToUserId;
    }

    /**
     * Set MailReceiver's 'to_user_id' property. 
     *
     * @param int $a_iToUserId
     * @return void
     */
    function setToUserId($a_iToUserId)
    {
        if (!is_null($this->_iToUserId) && $this->_iToUserId !== (int) $a_iToUserId) {
            $this->_markModified();
        }
        $this->_iToUserId = (int) $a_iToUserId;
    }

    /**
     * The ToUser.
     * 
     * @var ToUser
     */
    private $_oToUser;

    /**
     * Get the ToUser.
     * 
     * @return ToUser
     */
    function getToUser()
    {
        return $this->_oToUser;
    }

    /**
     * Set the ToUser.
     * 
     * @param ToUser $a_oToUser
     * 
     * @return void
     */
    function setToUser($a_oToUser)
    {
        $this->_iToUserId = $a_oToUser->getId();
        $this->_oToUser = $a_oToUser;
    }

    /**
     * Get MailReceiver's 'hidden' property. 
     *
     * @return bool
     */
    function getHidden()
    {
        return (bool) $this->_bHidden;
    }

    /**
     * Set MailReceiver's 'hidden' property. 
     *
     * @param bool $a_bHidden
     * @return void
     */
    function setHidden($a_bHidden)
    {
        if (!is_null($this->_bHidden) && $this->_bHidden !== (bool) $a_bHidden) {
            $this->_markModified();
        }
        $this->_bHidden = (bool) $a_bHidden;
    }



    public static function create($a_iMailId, $a_bIsRead, $a_sReadOn, $a_iToUserId, $a_bHidden, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('mail_receiver')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('mail_receiver')->write($oObject);
        }
        return $oObject;
    }

}
