<?php

/**
 * Selector class for ResourceBooking. 
 *
 * @see ResourceBooking
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ResourceBookingSelector extends Selector 
{


    /**
     * ResourceBooking selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * ResourceBooking selector's 'resource_id' property. 
     *
     * @var int
     */
    private $_iResourceId;

    /**
     * ResourceBooking selector's 'start' property. 
     *
     * @var string
     */
    private $_sStart;

    /**
     * ResourceBooking selector's 'end' property. 
     *
     * @var string
     */
    private $_sEnd;

    /**
     * ResourceBooking selector's 'sms_reminder' property. 
     *
     * @var bool
     */
    private $_bSmsReminder;

    /**
     * ResourceBooking selector's 'mail_reminder' property. 
     *
     * @var bool
     */
    private $_bMailReminder;

    /**
     * ResourceBooking selector's 'unbook_code' property. 
     *
     * @var string
     */
    private $_sUnbookCode;
    /**
     * Get ResourceBooking selector's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set ResourceBooking selector's 'user_id' property. 
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
     * Get ResourceBooking selector's 'resource_id' property. 
     *
     * @return int
     */
    function getResourceId()
    {
        return (int) $this->_iResourceId;
    }

    /**
     * Set ResourceBooking selector's 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return void
     */
    function setResourceId($a_iResourceId)
    {
        $this->_iResourceId = (int) $a_iResourceId;
        $this->setSearchParameter('resource_id', $this->_iResourceId);
    }

    /**
     * Get ResourceBooking selector's 'start' property. 
     *
     * @return string
     */
    function getStart()
    {
        return (string) $this->_sStart;
    }

    /**
     * Set ResourceBooking selector's 'start' property. 
     *
     * @param string $a_sStart
     * @return void
     */
    function setStart($a_sStart)
    {
        $this->_sStart = (string) $a_sStart;
        $this->setSearchParameter('start', $this->_sStart);
    }

    /**
     * Get ResourceBooking selector's 'end' property. 
     *
     * @return string
     */
    function getEnd()
    {
        return (string) $this->_sEnd;
    }

    /**
     * Set ResourceBooking selector's 'end' property. 
     *
     * @param string $a_sEnd
     * @return void
     */
    function setEnd($a_sEnd)
    {
        $this->_sEnd = (string) $a_sEnd;
        $this->setSearchParameter('end', $this->_sEnd);
    }

    /**
     * Get ResourceBooking selector's 'sms_reminder' property. 
     *
     * @return bool
     */
    function getSmsReminder()
    {
        return (bool) $this->_bSmsReminder;
    }

    /**
     * Set ResourceBooking selector's 'sms_reminder' property. 
     *
     * @param bool $a_bSmsReminder
     * @return void
     */
    function setSmsReminder($a_bSmsReminder)
    {
        $this->_bSmsReminder = (bool) $a_bSmsReminder;
        $this->setSearchParameter('sms_reminder', $this->_bSmsReminder);
    }

    /**
     * Get ResourceBooking selector's 'mail_reminder' property. 
     *
     * @return bool
     */
    function getMailReminder()
    {
        return (bool) $this->_bMailReminder;
    }

    /**
     * Set ResourceBooking selector's 'mail_reminder' property. 
     *
     * @param bool $a_bMailReminder
     * @return void
     */
    function setMailReminder($a_bMailReminder)
    {
        $this->_bMailReminder = (bool) $a_bMailReminder;
        $this->setSearchParameter('mail_reminder', $this->_bMailReminder);
    }

    /**
     * Get ResourceBooking selector's 'unbook_code' property. 
     *
     * @return string|null
     */
    function getUnbookCode()
    {
        return is_null($this->_sUnbookCode) ? NULL : (string) $this->_sUnbookCode;
    }

    /**
     * Set ResourceBooking selector's 'unbook_code' property. 
     *
     * @param string|null $a_sUnbookCode
     * @return void
     */
    function setUnbookCode($a_sUnbookCode)
    {
        $this->_sUnbookCode = is_null($a_sUnbookCode) ? NULL : (string) $a_sUnbookCode;
        $this->setSearchParameter('unbook_code', (string) $this->_sUnbookCode, is_null($this->_sUnbookCode) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
