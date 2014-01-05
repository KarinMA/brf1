<?php

/**
 * Domain object class for BrfMail. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfMail extends DomainObject 
{
    /**
     * BrfMail's 'from_user_id' property. 
     *
     * @var int
     */
    private $_iFromUserId;

    /**
     * BrfMail's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * BrfMail's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfMail's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Get BrfMail's 'from_user_id' property. 
     *
     * @return int
     */
    function getFromUserId()
    {
        return (int) $this->_iFromUserId;
    }

    /**
     * Set BrfMail's 'from_user_id' property. 
     *
     * @param int $a_iFromUserId
     * @return void
     */
    function setFromUserId($a_iFromUserId)
    {
        if (!is_null($this->_iFromUserId) && $this->_iFromUserId !== (int) $a_iFromUserId) {
            $this->_markModified();
        }
        $this->_iFromUserId = (int) $a_iFromUserId;
    }

    /**
     * The FromUser.
     * 
     * @var FromUser
     */
    private $_oFromUser;

    /**
     * Get the FromUser.
     * 
     * @return FromUser
     */
    function getFromUser()
    {
        return $this->_oFromUser;
    }

    /**
     * Set the FromUser.
     * 
     * @param FromUser $a_oFromUser
     * 
     * @return void
     */
    function setFromUser($a_oFromUser)
    {
        $this->_iFromUserId = $a_oFromUser->getId();
        $this->_oFromUser = $a_oFromUser;
    }

    /**
     * Get BrfMail's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set BrfMail's 'message' property. 
     *
     * @param string $a_sMessage
     * @return void
     */
    function setMessage($a_sMessage)
    {
        if (!is_null($this->_sMessage) && $this->_sMessage !== (string) $a_sMessage) {
            $this->_markModified();
        }
        $this->_sMessage = (string) $a_sMessage;
    }

    /**
     * Get BrfMail's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfMail's 'header' property. 
     *
     * @param string $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        if (!is_null($this->_sHeader) && $this->_sHeader !== (string) $a_sHeader) {
            $this->_markModified();
        }
        $this->_sHeader = (string) $a_sHeader;
    }

    /**
     * Get BrfMail's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return strlen($this->_sSentOn) ? (string) $this->_sSentOn : NULL;
    }

    /**
     * Set BrfMail's 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return void
     */
    function setSentOn($a_sSentOn)
    {
        if (!is_null($this->_sSentOn) && $this->_sSentOn !== (string) $a_sSentOn) {
            $this->_markModified();
        }
        $this->_sSentOn = (string) $a_sSentOn;
    }

    /**
     * This BrfMail's MailReceiver collection.
     * 
     * @var Collection
     */
    private $_oMailReceiverCollection;

    /**
     * Get MailReceiver collection.
     * 
     * @see MailReceiver
     * 
     * @return Collection
     */
    function getMailReceiverCollection()
    {
        if (!isset($this->_oMailReceiverCollection)) {
            $this->_oMailReceiverCollection = new Collection();
        }
        return $this->_oMailReceiverCollection;
    }



    public static function create($a_iFromUserId, $a_sMessage, $a_sHeader, $a_sSentOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_mail')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_mail')->write($oObject);
        }
        return $oObject;
    }

}
