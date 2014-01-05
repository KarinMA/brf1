<?php

/**
 * Selector class for Message. 
 *
 * @see Message
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_MessageSelector extends Selector 
{


    /**
     * Message selector's 'sender_id' property. 
     *
     * @var int
     */
    private $_iSenderId;

    /**
     * Message selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Message selector's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * Message selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * Message selector's 'send_time' property. 
     *
     * @var string
     */
    private $_sSendTime;

    /**
     * Message selector's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * Message selector's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;
    /**
     * Get Message selector's 'sender_id' property. 
     *
     * @return int
     */
    function getSenderId()
    {
        return (int) $this->_iSenderId;
    }

    /**
     * Set Message selector's 'sender_id' property. 
     *
     * @param int $a_iSenderId
     * @return void
     */
    function setSenderId($a_iSenderId)
    {
        $this->_iSenderId = (int) $a_iSenderId;
        $this->setSearchParameter('sender_id', $this->_iSenderId);
    }

    /**
     * Get Message selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Message selector's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        $this->_iBrfId = (int) $a_iBrfId;
        $this->setSearchParameter('brf_id', $this->_iBrfId);
    }

    /**
     * Get Message selector's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set Message selector's 'message' property. 
     *
     * @param string $a_sMessage selector
     * @return void
     */
    function setMessage($a_sMessage)
    {
        $this->_sMessage = (string) $a_sMessage;
        $this->setSearchParameter('message', $this->_sMessage);
    }

    /**
     * Get Message selector's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set Message selector's 'header' property. 
     *
     * @param string $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        $this->_sHeader = (string) $a_sHeader;
        $this->setSearchParameter('header', $this->_sHeader);
    }

    /**
     * Get Message selector's 'send_time' property. 
     *
     * @return string
     */
    function getSendTime()
    {
        return (string) $this->_sSendTime;
    }

    /**
     * Set Message selector's 'send_time' property. 
     *
     * @param string $a_sSendTime
     * @return void
     */
    function setSendTime($a_sSendTime)
    {
        $this->_sSendTime = (string) $a_sSendTime;
        $this->setSearchParameter('send_time', $this->_sSendTime);
    }

    /**
     * Get Message selector's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set Message selector's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        $this->_bHasPicture = (bool) $a_bHasPicture;
        $this->setSearchParameter('has_picture', $this->_bHasPicture);
    }

    /**
     * Get Message selector's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set Message selector's 'image_type' property. 
     *
     * @param string|null $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        $this->_sImageType = is_null($a_sImageType) ? NULL : (string) $a_sImageType;
        $this->setSearchParameter('image_type', (string) $this->_sImageType, is_null($this->_sImageType) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
