<?php

/**
 * Domain object class for ResourceBooking. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class ResourceBooking extends DomainObject 
{
    /**
     * ResourceBooking's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * ResourceBooking's 'resource_id' property. 
     *
     * @var int
     */
    private $_iResourceId;

    /**
     * ResourceBooking's 'start' property. 
     *
     * @var string
     */
    private $_sStart;

    /**
     * ResourceBooking's 'end' property. 
     *
     * @var string
     */
    private $_sEnd;

    /**
     * ResourceBooking's 'sms_reminder' property. 
     *
     * @var bool
     */
    private $_bSmsReminder;

    /**
     * ResourceBooking's 'mail_reminder' property. 
     *
     * @var bool
     */
    private $_bMailReminder;

    /**
     * ResourceBooking's 'unbook_code' property. 
     *
     * @var string
     */
    private $_sUnbookCode;

    /**
     * Get ResourceBooking's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set ResourceBooking's 'user_id' property. 
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
     * Get ResourceBooking's 'resource_id' property. 
     *
     * @return int
     */
    function getResourceId()
    {
        return (int) $this->_iResourceId;
    }

    /**
     * Set ResourceBooking's 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return void
     */
    function setResourceId($a_iResourceId)
    {
        if (!is_null($this->_iResourceId) && $this->_iResourceId !== (int) $a_iResourceId) {
            $this->_markModified();
        }
        $this->_iResourceId = (int) $a_iResourceId;
    }

    /**
     * The Resource.
     * 
     * @var Resource
     */
    private $_oResource;

    /**
     * Get the Resource.
     * 
     * @return Resource
     */
    function getResource()
    {
        return $this->_oResource;
    }

    /**
     * Set the Resource.
     * 
     * @param Resource $a_oResource
     * 
     * @return void
     */
    function setResource($a_oResource)
    {
        $this->_iResourceId = $a_oResource->getId();
        $this->_oResource = $a_oResource;
    }

    /**
     * Get ResourceBooking's 'start' property. 
     *
     * @return string
     */
    function getStart()
    {
        return strlen($this->_sStart) ? (string) $this->_sStart : NULL;
    }

    /**
     * Set ResourceBooking's 'start' property. 
     *
     * @param string $a_sStart
     * @return void
     */
    function setStart($a_sStart)
    {
        if (!is_null($this->_sStart) && $this->_sStart !== (string) $a_sStart) {
            $this->_markModified();
        }
        $this->_sStart = (string) $a_sStart;
    }

    /**
     * Get ResourceBooking's 'end' property. 
     *
     * @return string
     */
    function getEnd()
    {
        return strlen($this->_sEnd) ? (string) $this->_sEnd : NULL;
    }

    /**
     * Set ResourceBooking's 'end' property. 
     *
     * @param string $a_sEnd
     * @return void
     */
    function setEnd($a_sEnd)
    {
        if (!is_null($this->_sEnd) && $this->_sEnd !== (string) $a_sEnd) {
            $this->_markModified();
        }
        $this->_sEnd = (string) $a_sEnd;
    }

    /**
     * Get ResourceBooking's 'sms_reminder' property. 
     *
     * @return bool
     */
    function getSmsReminder()
    {
        return (bool) $this->_bSmsReminder;
    }

    /**
     * Set ResourceBooking's 'sms_reminder' property. 
     *
     * @param bool $a_bSmsReminder
     * @return void
     */
    function setSmsReminder($a_bSmsReminder)
    {
        if (!is_null($this->_bSmsReminder) && $this->_bSmsReminder !== (bool) $a_bSmsReminder) {
            $this->_markModified();
        }
        $this->_bSmsReminder = (bool) $a_bSmsReminder;
    }

    /**
     * Get ResourceBooking's 'mail_reminder' property. 
     *
     * @return bool
     */
    function getMailReminder()
    {
        return (bool) $this->_bMailReminder;
    }

    /**
     * Set ResourceBooking's 'mail_reminder' property. 
     *
     * @param bool $a_bMailReminder
     * @return void
     */
    function setMailReminder($a_bMailReminder)
    {
        if (!is_null($this->_bMailReminder) && $this->_bMailReminder !== (bool) $a_bMailReminder) {
            $this->_markModified();
        }
        $this->_bMailReminder = (bool) $a_bMailReminder;
    }

    /**
     * Get ResourceBooking's 'unbook_code' property. 
     *
     * @return string|null
     */
    function getUnbookCode()
    {
        return is_null($this->_sUnbookCode) ? NULL : (string) $this->_sUnbookCode;
    }

    /**
     * Set ResourceBooking's 'unbook_code' property. 
     *
     * @param string|null $a_sUnbookCode
     * @return void
     */
    function setUnbookCode($a_sUnbookCode)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sUnbookCode) ? NULL : ((string) $a_sUnbookCode);
            if ($mCompareValue !== $this->_sUnbookCode) {
                $this->_markModified();
            }
        }
        $this->_sUnbookCode = is_null($a_sUnbookCode) ? NULL : (string) $a_sUnbookCode;
    }

    /**
     * This ResourceBooking's Notice collection.
     * 
     * @var Collection
     */
    private $_oNoticeCollection;

    /**
     * Get Notice collection.
     * 
     * @see Notice
     * 
     * @return Collection
     */
    function getNoticeCollection()
    {
        if (!isset($this->_oNoticeCollection)) {
            $this->_oNoticeCollection = new Collection();
        }
        return $this->_oNoticeCollection;
    }



    public static function create($a_iUserId, $a_iResourceId, $a_sStart, $a_sEnd, $a_bSmsReminder, $a_bMailReminder, $a_sUnbookCode, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_booking')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('resource_booking')->write($oObject);
        }
        return $oObject;
    }

}
