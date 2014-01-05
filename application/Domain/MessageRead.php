<?php

/**
 * Domain object class for MessageRead. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class MessageRead extends DomainObject 
{
    /**
     * MessageRead's 'message_id' property. 
     *
     * @var int
     */
    private $_iMessageId;

    /**
     * MessageRead's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * MessageRead's 'read_on' property. 
     *
     * @var string
     */
    private $_sReadOn;

    /**
     * Get MessageRead's 'message_id' property. 
     *
     * @return int
     */
    function getMessageId()
    {
        return (int) $this->_iMessageId;
    }

    /**
     * Set MessageRead's 'message_id' property. 
     *
     * @param int $a_iMessageId
     * @return void
     */
    function setMessageId($a_iMessageId)
    {
        if (!is_null($this->_iMessageId) && $this->_iMessageId !== (int) $a_iMessageId) {
            $this->_markModified();
        }
        $this->_iMessageId = (int) $a_iMessageId;
    }

    /**
     * The Message.
     * 
     * @var Message
     */
    private $_oMessage;

    /**
     * Get the Message.
     * 
     * @return Message
     */
    function getMessage()
    {
        return $this->_oMessage;
    }

    /**
     * Set the Message.
     * 
     * @param Message $a_oMessage
     * 
     * @return void
     */
    function setMessage($a_oMessage)
    {
        $this->_iMessageId = $a_oMessage->getId();
        $this->_oMessage = $a_oMessage;
    }

    /**
     * Get MessageRead's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set MessageRead's 'user_id' property. 
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
     * Get MessageRead's 'read_on' property. 
     *
     * @return string
     */
    function getReadOn()
    {
        return strlen($this->_sReadOn) ? (string) $this->_sReadOn : NULL;
    }

    /**
     * Set MessageRead's 'read_on' property. 
     *
     * @param string $a_sReadOn
     * @return void
     */
    function setReadOn($a_sReadOn)
    {
        if (!is_null($this->_sReadOn) && $this->_sReadOn !== (string) $a_sReadOn) {
            $this->_markModified();
        }
        $this->_sReadOn = (string) $a_sReadOn;
    }



    public static function create($a_iMessageId, $a_iUserId, $a_sReadOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('message_read')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('message_read')->write($oObject);
        }
        return $oObject;
    }

}
