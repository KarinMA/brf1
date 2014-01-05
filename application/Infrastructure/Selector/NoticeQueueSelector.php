<?php

/**
 * Selector class for NoticeQueue. 
 *
 * @see NoticeQueue
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_NoticeQueueSelector extends Selector 
{


    /**
     * NoticeQueue selector's 'notice_id' property. 
     *
     * @var int
     */
    private $_iNoticeId;

    /**
     * NoticeQueue selector's 'status' property. 
     *
     * @var string
     */
    private $_sStatus;

    /**
     * NoticeQueue selector's 'error_message' property. 
     *
     * @var string
     */
    private $_sErrorMessage;

    /**
     * NoticeQueue selector's 'error_code' property. 
     *
     * @var int
     */
    private $_iErrorCode;

    /**
     * NoticeQueue selector's 'queued_on' property. 
     *
     * @var string
     */
    private $_sQueuedOn;

    /**
     * NoticeQueue selector's 'send_on' property. 
     *
     * @var string
     */
    private $_sSendOn;
    /**
     * Get NoticeQueue selector's 'notice_id' property. 
     *
     * @return int
     */
    function getNoticeId()
    {
        return (int) $this->_iNoticeId;
    }

    /**
     * Set NoticeQueue selector's 'notice_id' property. 
     *
     * @param int $a_iNoticeId
     * @return void
     */
    function setNoticeId($a_iNoticeId)
    {
        $this->_iNoticeId = (int) $a_iNoticeId;
        $this->setSearchParameter('notice_id', $this->_iNoticeId);
    }

    /**
     * Get NoticeQueue selector's 'status' property. 
     *
     * @return string
     */
    function getStatus()
    {
        return (string) $this->_sStatus;
    }

    /**
     * Set NoticeQueue selector's 'status' property. 
     *
     * @param string $a_sStatus
     * @return void
     */
    function setStatus($a_sStatus)
    {
        $this->_sStatus = (string) $a_sStatus;
        $this->setSearchParameter('status', $this->_sStatus);
    }

    /**
     * Get NoticeQueue selector's 'error_message' property. 
     *
     * @return string|null
     */
    function getErrorMessage()
    {
        return is_null($this->_sErrorMessage) ? NULL : (string) $this->_sErrorMessage;
    }

    /**
     * Set NoticeQueue selector's 'error_message' property. 
     *
     * @param string|null $a_sErrorMessage
     * @return void
     */
    function setErrorMessage($a_sErrorMessage)
    {
        $this->_sErrorMessage = is_null($a_sErrorMessage) ? NULL : (string) $a_sErrorMessage;
        $this->setSearchParameter('error_message', (string) $this->_sErrorMessage, is_null($this->_sErrorMessage) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get NoticeQueue selector's 'error_code' property. 
     *
     * @return int|null
     */
    function getErrorCode()
    {
        return is_null($this->_iErrorCode) ? NULL : (int) $this->_iErrorCode;
    }

    /**
     * Set NoticeQueue selector's 'error_code' property. 
     *
     * @param int|null $a_iErrorCode
     * @return void
     */
    function setErrorCode($a_iErrorCode)
    {
        $this->_iErrorCode = is_null($a_iErrorCode) ? NULL : (int) $a_iErrorCode;
        $this->setSearchParameter('error_code', (int) $this->_iErrorCode, is_null($this->_iErrorCode) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get NoticeQueue selector's 'queued_on' property. 
     *
     * @return string
     */
    function getQueuedOn()
    {
        return (string) $this->_sQueuedOn;
    }

    /**
     * Set NoticeQueue selector's 'queued_on' property. 
     *
     * @param string $a_sQueuedOn
     * @return void
     */
    function setQueuedOn($a_sQueuedOn)
    {
        $this->_sQueuedOn = (string) $a_sQueuedOn;
        $this->setSearchParameter('queued_on', $this->_sQueuedOn);
    }

    /**
     * Get NoticeQueue selector's 'send_on' property. 
     *
     * @return string
     */
    function getSendOn()
    {
        return (string) $this->_sSendOn;
    }

    /**
     * Set NoticeQueue selector's 'send_on' property. 
     *
     * @param string $a_sSendOn
     * @return void
     */
    function setSendOn($a_sSendOn)
    {
        $this->_sSendOn = (string) $a_sSendOn;
        $this->setSearchParameter('send_on', $this->_sSendOn);
    }

}
