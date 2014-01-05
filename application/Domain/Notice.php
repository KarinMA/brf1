<?php

/**
 * Domain object class for Notice. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Notice extends DomainObject 
{
    /**
     * Notice's 'notice_type_id' property. 
     *
     * @var int
     */
    private $_iNoticeTypeId;

    /**
     * Notice's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Notice's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * Notice's 'resource_booking_id' property. 
     *
     * @var int
     */
    private $_iResourceBookingId;

    /**
     * Notice's 'calendar_id' property. 
     *
     * @var int
     */
    private $_iCalendarId;

    /**
     * Notice's 'from_user_id' property. 
     *
     * @var int
     */
    private $_iFromUserId;

    /**
     * Notice's 'body' property. 
     *
     * @var string
     */
    private $_sBody;

    /**
     * Notice's 'body_html' property. 
     *
     * @var string
     */
    private $_sBodyHtml;

    /**
     * Notice's 'subject' property. 
     *
     * @var string
     */
    private $_sSubject;

    /**
     * Notice's 'sender' property. 
     *
     * @var string
     */
    private $_sSender;

    /**
     * Notice's 'receiver' property. 
     *
     * @var string
     */
    private $_sReceiver;

    /**
     * Notice's 'sent' property. 
     *
     * @var bool
     */
    private $_bSent;

    /**
     * Notice's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Notice's 'failed_on' property. 
     *
     * @var string
     */
    private $_sFailedOn;

    /**
     * Get Notice's 'notice_type_id' property. 
     *
     * @return int
     */
    function getNoticeTypeId()
    {
        return (int) $this->_iNoticeTypeId;
    }

    /**
     * Set Notice's 'notice_type_id' property. 
     *
     * @param int $a_iNoticeTypeId
     * @return void
     */
    function setNoticeTypeId($a_iNoticeTypeId)
    {
        if (!is_null($this->_iNoticeTypeId) && $this->_iNoticeTypeId !== (int) $a_iNoticeTypeId) {
            $this->_markModified();
        }
        $this->_iNoticeTypeId = (int) $a_iNoticeTypeId;
    }

    /**
     * The NoticeType.
     * 
     * @var NoticeType
     */
    private $_oNoticeType;

    /**
     * Get the NoticeType.
     * 
     * @return NoticeType
     */
    function getNoticeType()
    {
        return $this->_oNoticeType;
    }

    /**
     * Set the NoticeType.
     * 
     * @param NoticeType $a_oNoticeType
     * 
     * @return void
     */
    function setNoticeType($a_oNoticeType)
    {
        $this->_iNoticeTypeId = $a_oNoticeType->getId();
        $this->_oNoticeType = $a_oNoticeType;
    }

    /**
     * Get Notice's 'brf_id' property. 
     *
     * @return int|null
     */
    function getBrfId()
    {
        return is_null($this->_iBrfId) ? NULL : (int) $this->_iBrfId;
    }

    /**
     * Set Notice's 'brf_id' property. 
     *
     * @param int|null $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iBrfId) ? NULL : ((int) $a_iBrfId);
            if ($mCompareValue !== $this->_iBrfId) {
                $this->_markModified();
            }
        }
        $this->_iBrfId = is_null($a_iBrfId) ? NULL : (int) $a_iBrfId;
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
     * Get Notice's 'user_id' property. 
     *
     * @return int|null
     */
    function getUserId()
    {
        return is_null($this->_iUserId) ? NULL : (int) $this->_iUserId;
    }

    /**
     * Set Notice's 'user_id' property. 
     *
     * @param int|null $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iUserId) ? NULL : ((int) $a_iUserId);
            if ($mCompareValue !== $this->_iUserId) {
                $this->_markModified();
            }
        }
        $this->_iUserId = is_null($a_iUserId) ? NULL : (int) $a_iUserId;
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
     * Get Notice's 'resource_booking_id' property. 
     *
     * @return int|null
     */
    function getResourceBookingId()
    {
        return is_null($this->_iResourceBookingId) ? NULL : (int) $this->_iResourceBookingId;
    }

    /**
     * Set Notice's 'resource_booking_id' property. 
     *
     * @param int|null $a_iResourceBookingId
     * @return void
     */
    function setResourceBookingId($a_iResourceBookingId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iResourceBookingId) ? NULL : ((int) $a_iResourceBookingId);
            if ($mCompareValue !== $this->_iResourceBookingId) {
                $this->_markModified();
            }
        }
        $this->_iResourceBookingId = is_null($a_iResourceBookingId) ? NULL : (int) $a_iResourceBookingId;
    }

    /**
     * The ResourceBooking.
     * 
     * @var ResourceBooking
     */
    private $_oResourceBooking;

    /**
     * Get the ResourceBooking.
     * 
     * @return ResourceBooking
     */
    function getResourceBooking()
    {
        return $this->_oResourceBooking;
    }

    /**
     * Set the ResourceBooking.
     * 
     * @param ResourceBooking $a_oResourceBooking
     * 
     * @return void
     */
    function setResourceBooking($a_oResourceBooking)
    {
        $this->_iResourceBookingId = $a_oResourceBooking->getId();
        $this->_oResourceBooking = $a_oResourceBooking;
    }

    /**
     * Get Notice's 'calendar_id' property. 
     *
     * @return int|null
     */
    function getCalendarId()
    {
        return is_null($this->_iCalendarId) ? NULL : (int) $this->_iCalendarId;
    }

    /**
     * Set Notice's 'calendar_id' property. 
     *
     * @param int|null $a_iCalendarId
     * @return void
     */
    function setCalendarId($a_iCalendarId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iCalendarId) ? NULL : ((int) $a_iCalendarId);
            if ($mCompareValue !== $this->_iCalendarId) {
                $this->_markModified();
            }
        }
        $this->_iCalendarId = is_null($a_iCalendarId) ? NULL : (int) $a_iCalendarId;
    }

    /**
     * The Calendar.
     * 
     * @var Calendar
     */
    private $_oCalendar;

    /**
     * Get the Calendar.
     * 
     * @return Calendar
     */
    function getCalendar()
    {
        return $this->_oCalendar;
    }

    /**
     * Set the Calendar.
     * 
     * @param Calendar $a_oCalendar
     * 
     * @return void
     */
    function setCalendar($a_oCalendar)
    {
        $this->_iCalendarId = $a_oCalendar->getId();
        $this->_oCalendar = $a_oCalendar;
    }

    /**
     * Get Notice's 'from_user_id' property. 
     *
     * @return int|null
     */
    function getFromUserId()
    {
        return is_null($this->_iFromUserId) ? NULL : (int) $this->_iFromUserId;
    }

    /**
     * Set Notice's 'from_user_id' property. 
     *
     * @param int|null $a_iFromUserId
     * @return void
     */
    function setFromUserId($a_iFromUserId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iFromUserId) ? NULL : ((int) $a_iFromUserId);
            if ($mCompareValue !== $this->_iFromUserId) {
                $this->_markModified();
            }
        }
        $this->_iFromUserId = is_null($a_iFromUserId) ? NULL : (int) $a_iFromUserId;
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
     * Get Notice's 'body' property. 
     *
     * @return string|null
     */
    function getBody()
    {
        return is_null($this->_sBody) ? NULL : (string) $this->_sBody;
    }

    /**
     * Set Notice's 'body' property. 
     *
     * @param string|null $a_sBody
     * @return void
     */
    function setBody($a_sBody)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sBody) ? NULL : ((string) $a_sBody);
            if ($mCompareValue !== $this->_sBody) {
                $this->_markModified();
            }
        }
        $this->_sBody = is_null($a_sBody) ? NULL : (string) $a_sBody;
    }

    /**
     * Get Notice's 'body_html' property. 
     *
     * @return string|null
     */
    function getBodyHtml()
    {
        return is_null($this->_sBodyHtml) ? NULL : (string) $this->_sBodyHtml;
    }

    /**
     * Set Notice's 'body_html' property. 
     *
     * @param string|null $a_sBodyHtml
     * @return void
     */
    function setBodyHtml($a_sBodyHtml)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sBodyHtml) ? NULL : ((string) $a_sBodyHtml);
            if ($mCompareValue !== $this->_sBodyHtml) {
                $this->_markModified();
            }
        }
        $this->_sBodyHtml = is_null($a_sBodyHtml) ? NULL : (string) $a_sBodyHtml;
    }

    /**
     * Get Notice's 'subject' property. 
     *
     * @return string|null
     */
    function getSubject()
    {
        return is_null($this->_sSubject) ? NULL : (string) $this->_sSubject;
    }

    /**
     * Set Notice's 'subject' property. 
     *
     * @param string|null $a_sSubject
     * @return void
     */
    function setSubject($a_sSubject)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sSubject) ? NULL : ((string) $a_sSubject);
            if ($mCompareValue !== $this->_sSubject) {
                $this->_markModified();
            }
        }
        $this->_sSubject = is_null($a_sSubject) ? NULL : (string) $a_sSubject;
    }

    /**
     * Get Notice's 'sender' property. 
     *
     * @return string
     */
    function getSender()
    {
        return (string) $this->_sSender;
    }

    /**
     * Set Notice's 'sender' property. 
     *
     * @param string $a_sSender
     * @return void
     */
    function setSender($a_sSender)
    {
        if (!is_null($this->_sSender) && $this->_sSender !== (string) $a_sSender) {
            $this->_markModified();
        }
        $this->_sSender = (string) $a_sSender;
    }

    /**
     * Get Notice's 'receiver' property. 
     *
     * @return string
     */
    function getReceiver()
    {
        return (string) $this->_sReceiver;
    }

    /**
     * Set Notice's 'receiver' property. 
     *
     * @param string $a_sReceiver
     * @return void
     */
    function setReceiver($a_sReceiver)
    {
        if (!is_null($this->_sReceiver) && $this->_sReceiver !== (string) $a_sReceiver) {
            $this->_markModified();
        }
        $this->_sReceiver = (string) $a_sReceiver;
    }

    /**
     * Get Notice's 'sent' property. 
     *
     * @return bool
     */
    function getSent()
    {
        return (bool) $this->_bSent;
    }

    /**
     * Set Notice's 'sent' property. 
     *
     * @param bool $a_bSent
     * @return void
     */
    function setSent($a_bSent)
    {
        if (!is_null($this->_bSent) && $this->_bSent !== (bool) $a_bSent) {
            $this->_markModified();
        }
        $this->_bSent = (bool) $a_bSent;
    }

    /**
     * Get Notice's 'sent_on' property. 
     *
     * @return string|null
     */
    function getSentOn()
    {
        return is_null($this->_sSentOn) ? NULL : (string) $this->_sSentOn;
    }

    /**
     * Set Notice's 'sent_on' property. 
     *
     * @param string|null $a_sSentOn
     * @return void
     */
    function setSentOn($a_sSentOn)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sSentOn) ? NULL : ((string) $a_sSentOn);
            if ($mCompareValue !== $this->_sSentOn) {
                $this->_markModified();
            }
        }
        $this->_sSentOn = is_null($a_sSentOn) ? NULL : (string) $a_sSentOn;
    }

    /**
     * Get Notice's 'failed_on' property. 
     *
     * @return string|null
     */
    function getFailedOn()
    {
        return is_null($this->_sFailedOn) ? NULL : (string) $this->_sFailedOn;
    }

    /**
     * Set Notice's 'failed_on' property. 
     *
     * @param string|null $a_sFailedOn
     * @return void
     */
    function setFailedOn($a_sFailedOn)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sFailedOn) ? NULL : ((string) $a_sFailedOn);
            if ($mCompareValue !== $this->_sFailedOn) {
                $this->_markModified();
            }
        }
        $this->_sFailedOn = is_null($a_sFailedOn) ? NULL : (string) $a_sFailedOn;
    }

    /**
     * This Notice's NoticeAttachment collection.
     * 
     * @var Collection
     */
    private $_oNoticeAttachmentCollection;

    /**
     * Get NoticeAttachment collection.
     * 
     * @see NoticeAttachment
     * 
     * @return Collection
     */
    function getNoticeAttachmentCollection()
    {
        if (!isset($this->_oNoticeAttachmentCollection)) {
            $this->_oNoticeAttachmentCollection = new Collection();
        }
        return $this->_oNoticeAttachmentCollection;
    }

    /**
     * This Notice's NoticeQueue collection.
     * 
     * @var Collection
     */
    private $_oNoticeQueueCollection;

    /**
     * Get NoticeQueue collection.
     * 
     * @see NoticeQueue
     * 
     * @return Collection
     */
    function getNoticeQueueCollection()
    {
        if (!isset($this->_oNoticeQueueCollection)) {
            $this->_oNoticeQueueCollection = new Collection();
        }
        return $this->_oNoticeQueueCollection;
    }



    public static function create($a_iNoticeTypeId, $a_iBrfId, $a_iUserId, $a_iResourceBookingId, $a_iCalendarId, $a_iFromUserId, $a_sBody, $a_sBodyHtml, $a_sSubject, $a_sSender, $a_sReceiver, $a_bSent, $a_sSentOn, $a_sFailedOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('notice')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('notice')->write($oObject);
        }
        return $oObject;
    }

}
