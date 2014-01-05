<?php

/**
 * Domain object class for Message. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Message extends DomainObject 
{
    /**
     * Message's 'sender_id' property. 
     *
     * @var int
     */
    private $_iSenderId;

    /**
     * Message's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Message's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * Message's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * Message's 'send_time' property. 
     *
     * @var string
     */
    private $_sSendTime;

    /**
     * Message's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * Message's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * Get Message's 'sender_id' property. 
     *
     * @return int
     */
    function getSenderId()
    {
        return (int) $this->_iSenderId;
    }

    /**
     * Set Message's 'sender_id' property. 
     *
     * @param int $a_iSenderId
     * @return void
     */
    function setSenderId($a_iSenderId)
    {
        if (!is_null($this->_iSenderId) && $this->_iSenderId !== (int) $a_iSenderId) {
            $this->_markModified();
        }
        $this->_iSenderId = (int) $a_iSenderId;
    }

    /**
     * The Sender.
     * 
     * @var Sender
     */
    private $_oSender;

    /**
     * Get the Sender.
     * 
     * @return Sender
     */
    function getSender()
    {
        return $this->_oSender;
    }

    /**
     * Set the Sender.
     * 
     * @param Sender $a_oSender
     * 
     * @return void
     */
    function setSender($a_oSender)
    {
        $this->_iSenderId = $a_oSender->getId();
        $this->_oSender = $a_oSender;
    }

    /**
     * Get Message's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Message's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (!is_null($this->_iBrfId) && $this->_iBrfId !== (int) $a_iBrfId) {
            $this->_markModified();
        }
        $this->_iBrfId = (int) $a_iBrfId;
    }

    /**
     * The Brf.
     * 
     * @var Brf
     */
    private $_oBrf;

    /**
     * Get the Brf.
     * 
     * @return Brf
     */
    function getBrf()
    {
        return $this->_oBrf;
    }

    /**
     * Set the Brf.
     * 
     * @param Brf $a_oBrf
     * 
     * @return void
     */
    function setBrf($a_oBrf)
    {
        $this->_iBrfId = $a_oBrf->getId();
        $this->_oBrf = $a_oBrf;
    }

    /**
     * Get Message's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set Message's 'message' property. 
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
     * Get Message's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set Message's 'header' property. 
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
     * Get Message's 'send_time' property. 
     *
     * @return string
     */
    function getSendTime()
    {
        return strlen($this->_sSendTime) ? (string) $this->_sSendTime : NULL;
    }

    /**
     * Set Message's 'send_time' property. 
     *
     * @param string $a_sSendTime
     * @return void
     */
    function setSendTime($a_sSendTime)
    {
        if (!is_null($this->_sSendTime) && $this->_sSendTime !== (string) $a_sSendTime) {
            $this->_markModified();
        }
        $this->_sSendTime = (string) $a_sSendTime;
    }

    /**
     * Get Message's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set Message's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        if (!is_null($this->_bHasPicture) && $this->_bHasPicture !== (bool) $a_bHasPicture) {
            $this->_markModified();
        }
        $this->_bHasPicture = (bool) $a_bHasPicture;
    }

    /**
     * Get Message's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set Message's 'image_type' property. 
     *
     * @param string|null $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sImageType) ? NULL : ((string) $a_sImageType);
            if ($mCompareValue !== $this->_sImageType) {
                $this->_markModified();
            }
        }
        $this->_sImageType = is_null($a_sImageType) ? NULL : (string) $a_sImageType;
    }

    /**
     * This Message's MessageRead collection.
     * 
     * @var Collection
     */
    private $_oMessageReadCollection;

    /**
     * Get MessageRead collection.
     * 
     * @see MessageRead
     * 
     * @return Collection
     */
    function getMessageReadCollection()
    {
        if (!isset($this->_oMessageReadCollection)) {
            $this->_oMessageReadCollection = new Collection();
        }
        return $this->_oMessageReadCollection;
    }



    public static function create($a_iSenderId, $a_iBrfId, $a_sMessage, $a_sHeader, $a_sSendTime, $a_bHasPicture, $a_sImageType, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('message')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('message')->write($oObject);
        }
        return $oObject;
    }

}
