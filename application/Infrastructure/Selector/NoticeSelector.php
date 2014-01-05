<?php

/**
 * Selector class for Notice. 
 *
 * @see Notice
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_NoticeSelector extends Selector 
{


    /**
     * Notice selector's 'notice_type_id' property. 
     *
     * @var int
     */
    private $_iNoticeTypeId;

    /**
     * Notice selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Notice selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * Notice selector's 'resource_booking_id' property. 
     *
     * @var int
     */
    private $_iResourceBookingId;

    /**
     * Notice selector's 'calendar_id' property. 
     *
     * @var int
     */
    private $_iCalendarId;

    /**
     * Notice selector's 'from_user_id' property. 
     *
     * @var int
     */
    private $_iFromUserId;

    /**
     * Notice selector's 'body' property. 
     *
     * @var string
     */
    private $_sBody;

    /**
     * Notice selector's 'body_html' property. 
     *
     * @var string
     */
    private $_sBodyHtml;

    /**
     * Notice selector's 'subject' property. 
     *
     * @var string
     */
    private $_sSubject;

    /**
     * Notice selector's 'sender' property. 
     *
     * @var string
     */
    private $_sSender;

    /**
     * Notice selector's 'receiver' property. 
     *
     * @var string
     */
    private $_sReceiver;

    /**
     * Notice selector's 'sent' property. 
     *
     * @var bool
     */
    private $_bSent;

    /**
     * Notice selector's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Notice selector's 'failed_on' property. 
     *
     * @var string
     */
    private $_sFailedOn;
    /**
     * Get Notice selector's 'notice_type_id' property. 
     *
     * @return int
     */
    function getNoticeTypeId()
    {
        return (int) $this->_iNoticeTypeId;
    }

    /**
     * Set Notice selector's 'notice_type_id' property. 
     *
     * @param int $a_iNotice selectorTypeId
     * @return void
     */
    function setNoticeTypeId($a_iNoticeTypeId)
    {
        $this->_iNoticeTypeId = (int) $a_iNoticeTypeId;
        $this->setSearchParameter('notice_type_id', $this->_iNoticeTypeId);
    }

    /**
     * Get Notice selector's 'brf_id' property. 
     *
     * @return int|null
     */
    function getBrfId()
    {
        return is_null($this->_iBrfId) ? NULL : (int) $this->_iBrfId;
    }

    /**
     * Set Notice selector's 'brf_id' property. 
     *
     * @param int|null $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        $this->_iBrfId = is_null($a_iBrfId) ? NULL : (int) $a_iBrfId;
        $this->setSearchParameter('brf_id', (int) $this->_iBrfId, is_null($this->_iBrfId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'user_id' property. 
     *
     * @return int|null
     */
    function getUserId()
    {
        return is_null($this->_iUserId) ? NULL : (int) $this->_iUserId;
    }

    /**
     * Set Notice selector's 'user_id' property. 
     *
     * @param int|null $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        $this->_iUserId = is_null($a_iUserId) ? NULL : (int) $a_iUserId;
        $this->setSearchParameter('user_id', (int) $this->_iUserId, is_null($this->_iUserId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'resource_booking_id' property. 
     *
     * @return int|null
     */
    function getResourceBookingId()
    {
        return is_null($this->_iResourceBookingId) ? NULL : (int) $this->_iResourceBookingId;
    }

    /**
     * Set Notice selector's 'resource_booking_id' property. 
     *
     * @param int|null $a_iResourceBookingId
     * @return void
     */
    function setResourceBookingId($a_iResourceBookingId)
    {
        $this->_iResourceBookingId = is_null($a_iResourceBookingId) ? NULL : (int) $a_iResourceBookingId;
        $this->setSearchParameter('resource_booking_id', (int) $this->_iResourceBookingId, is_null($this->_iResourceBookingId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'calendar_id' property. 
     *
     * @return int|null
     */
    function getCalendarId()
    {
        return is_null($this->_iCalendarId) ? NULL : (int) $this->_iCalendarId;
    }

    /**
     * Set Notice selector's 'calendar_id' property. 
     *
     * @param int|null $a_iCalendarId
     * @return void
     */
    function setCalendarId($a_iCalendarId)
    {
        $this->_iCalendarId = is_null($a_iCalendarId) ? NULL : (int) $a_iCalendarId;
        $this->setSearchParameter('calendar_id', (int) $this->_iCalendarId, is_null($this->_iCalendarId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'from_user_id' property. 
     *
     * @return int|null
     */
    function getFromUserId()
    {
        return is_null($this->_iFromUserId) ? NULL : (int) $this->_iFromUserId;
    }

    /**
     * Set Notice selector's 'from_user_id' property. 
     *
     * @param int|null $a_iFromUserId
     * @return void
     */
    function setFromUserId($a_iFromUserId)
    {
        $this->_iFromUserId = is_null($a_iFromUserId) ? NULL : (int) $a_iFromUserId;
        $this->setSearchParameter('from_user_id', (int) $this->_iFromUserId, is_null($this->_iFromUserId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'body' property. 
     *
     * @return string|null
     */
    function getBody()
    {
        return is_null($this->_sBody) ? NULL : (string) $this->_sBody;
    }

    /**
     * Set Notice selector's 'body' property. 
     *
     * @param string|null $a_sBody
     * @return void
     */
    function setBody($a_sBody)
    {
        $this->_sBody = is_null($a_sBody) ? NULL : (string) $a_sBody;
        $this->setSearchParameter('body', (string) $this->_sBody, is_null($this->_sBody) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'body_html' property. 
     *
     * @return string|null
     */
    function getBodyHtml()
    {
        return is_null($this->_sBodyHtml) ? NULL : (string) $this->_sBodyHtml;
    }

    /**
     * Set Notice selector's 'body_html' property. 
     *
     * @param string|null $a_sBodyHtml
     * @return void
     */
    function setBodyHtml($a_sBodyHtml)
    {
        $this->_sBodyHtml = is_null($a_sBodyHtml) ? NULL : (string) $a_sBodyHtml;
        $this->setSearchParameter('body_html', (string) $this->_sBodyHtml, is_null($this->_sBodyHtml) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'subject' property. 
     *
     * @return string|null
     */
    function getSubject()
    {
        return is_null($this->_sSubject) ? NULL : (string) $this->_sSubject;
    }

    /**
     * Set Notice selector's 'subject' property. 
     *
     * @param string|null $a_sSubject
     * @return void
     */
    function setSubject($a_sSubject)
    {
        $this->_sSubject = is_null($a_sSubject) ? NULL : (string) $a_sSubject;
        $this->setSearchParameter('subject', (string) $this->_sSubject, is_null($this->_sSubject) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'sender' property. 
     *
     * @return string
     */
    function getSender()
    {
        return (string) $this->_sSender;
    }

    /**
     * Set Notice selector's 'sender' property. 
     *
     * @param string $a_sSender
     * @return void
     */
    function setSender($a_sSender)
    {
        $this->_sSender = (string) $a_sSender;
        $this->setSearchParameter('sender', $this->_sSender);
    }

    /**
     * Get Notice selector's 'receiver' property. 
     *
     * @return string
     */
    function getReceiver()
    {
        return (string) $this->_sReceiver;
    }

    /**
     * Set Notice selector's 'receiver' property. 
     *
     * @param string $a_sReceiver
     * @return void
     */
    function setReceiver($a_sReceiver)
    {
        $this->_sReceiver = (string) $a_sReceiver;
        $this->setSearchParameter('receiver', $this->_sReceiver);
    }

    /**
     * Get Notice selector's 'sent' property. 
     *
     * @return bool
     */
    function getSent()
    {
        return (bool) $this->_bSent;
    }

    /**
     * Set Notice selector's 'sent' property. 
     *
     * @param bool $a_bSent
     * @return void
     */
    function setSent($a_bSent)
    {
        $this->_bSent = (bool) $a_bSent;
        $this->setSearchParameter('sent', $this->_bSent);
    }

    /**
     * Get Notice selector's 'sent_on' property. 
     *
     * @return string|null
     */
    function getSentOn()
    {
        return is_null($this->_sSentOn) ? NULL : (string) $this->_sSentOn;
    }

    /**
     * Set Notice selector's 'sent_on' property. 
     *
     * @param string|null $a_sSentOn
     * @return void
     */
    function setSentOn($a_sSentOn)
    {
        $this->_sSentOn = is_null($a_sSentOn) ? NULL : (string) $a_sSentOn;
        $this->setSearchParameter('sent_on', (string) $this->_sSentOn, is_null($this->_sSentOn) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Notice selector's 'failed_on' property. 
     *
     * @return string|null
     */
    function getFailedOn()
    {
        return is_null($this->_sFailedOn) ? NULL : (string) $this->_sFailedOn;
    }

    /**
     * Set Notice selector's 'failed_on' property. 
     *
     * @param string|null $a_sFailedOn
     * @return void
     */
    function setFailedOn($a_sFailedOn)
    {
        $this->_sFailedOn = is_null($a_sFailedOn) ? NULL : (string) $a_sFailedOn;
        $this->setSearchParameter('failed_on', (string) $this->_sFailedOn, is_null($this->_sFailedOn) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
