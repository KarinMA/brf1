<?php

/**
 * Domain object class for Resource. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Resource extends DomainObject 
{
    /**
     * Resource's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Resource's 'resource_type_id' property. 
     *
     * @var int
     */
    private $_iResourceTypeId;

    /**
     * Resource's 'open_hour' property. 
     *
     * @var int
     */
    private $_iOpenHour;

    /**
     * Resource's 'close_hour' property. 
     *
     * @var int
     */
    private $_iCloseHour;

    /**
     * Resource's 'interval' property. 
     *
     * @var int
     */
    private $_iInterval;

    /**
     * Resource's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * Resource's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Resource's 'advance_bookings' property. 
     *
     * @var int
     */
    private $_iAdvanceBookings;

    /**
     * Get Resource's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Resource's 'brf_id' property. 
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
     * Get Resource's 'resource_type_id' property. 
     *
     * @return int
     */
    function getResourceTypeId()
    {
        return (int) $this->_iResourceTypeId;
    }

    /**
     * Set Resource's 'resource_type_id' property. 
     *
     * @param int $a_iResourceTypeId
     * @return void
     */
    function setResourceTypeId($a_iResourceTypeId)
    {
        if (!is_null($this->_iResourceTypeId) && $this->_iResourceTypeId !== (int) $a_iResourceTypeId) {
            $this->_markModified();
        }
        $this->_iResourceTypeId = (int) $a_iResourceTypeId;
    }

    /**
     * The ResourceType.
     * 
     * @var ResourceType
     */
    private $_oResourceType;

    /**
     * Get the ResourceType.
     * 
     * @return ResourceType
     */
    function getResourceType()
    {
        return $this->_oResourceType;
    }

    /**
     * Set the ResourceType.
     * 
     * @param ResourceType $a_oResourceType
     * 
     * @return void
     */
    function setResourceType($a_oResourceType)
    {
        $this->_iResourceTypeId = $a_oResourceType->getId();
        $this->_oResourceType = $a_oResourceType;
    }

    /**
     * Get Resource's 'open_hour' property. 
     *
     * @return int
     */
    function getOpenHour()
    {
        return (int) $this->_iOpenHour;
    }

    /**
     * Set Resource's 'open_hour' property. 
     *
     * @param int $a_iOpenHour
     * @return void
     */
    function setOpenHour($a_iOpenHour)
    {
        if (!is_null($this->_iOpenHour) && $this->_iOpenHour !== (int) $a_iOpenHour) {
            $this->_markModified();
        }
        $this->_iOpenHour = (int) $a_iOpenHour;
    }

    /**
     * Get Resource's 'close_hour' property. 
     *
     * @return int
     */
    function getCloseHour()
    {
        return (int) $this->_iCloseHour;
    }

    /**
     * Set Resource's 'close_hour' property. 
     *
     * @param int $a_iCloseHour
     * @return void
     */
    function setCloseHour($a_iCloseHour)
    {
        if (!is_null($this->_iCloseHour) && $this->_iCloseHour !== (int) $a_iCloseHour) {
            $this->_markModified();
        }
        $this->_iCloseHour = (int) $a_iCloseHour;
    }

    /**
     * Get Resource's 'interval' property. 
     *
     * @return int
     */
    function getInterval()
    {
        return (int) $this->_iInterval;
    }

    /**
     * Set Resource's 'interval' property. 
     *
     * @param int $a_iInterval
     * @return void
     */
    function setInterval($a_iInterval)
    {
        if (!is_null($this->_iInterval) && $this->_iInterval !== (int) $a_iInterval) {
            $this->_markModified();
        }
        $this->_iInterval = (int) $a_iInterval;
    }

    /**
     * Get Resource's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Resource's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        if (!is_null($this->_sDescription) && $this->_sDescription !== (string) $a_sDescription) {
            $this->_markModified();
        }
        $this->_sDescription = (string) $a_sDescription;
    }

    /**
     * Get Resource's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Resource's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        if (!is_null($this->_sName) && $this->_sName !== (string) $a_sName) {
            $this->_markModified();
        }
        $this->_sName = (string) $a_sName;
    }

    /**
     * Get Resource's 'advance_bookings' property. 
     *
     * @return int|null
     */
    function getAdvanceBookings()
    {
        return is_null($this->_iAdvanceBookings) ? NULL : (int) $this->_iAdvanceBookings;
    }

    /**
     * Set Resource's 'advance_bookings' property. 
     *
     * @param int|null $a_iAdvanceBookings
     * @return void
     */
    function setAdvanceBookings($a_iAdvanceBookings)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iAdvanceBookings) ? NULL : ((int) $a_iAdvanceBookings);
            if ($mCompareValue !== $this->_iAdvanceBookings) {
                $this->_markModified();
            }
        }
        $this->_iAdvanceBookings = is_null($a_iAdvanceBookings) ? NULL : (int) $a_iAdvanceBookings;
    }

    /**
     * This Resource's ResourceBooking collection.
     * 
     * @var Collection
     */
    private $_oResourceBookingCollection;

    /**
     * Get ResourceBooking collection.
     * 
     * @see ResourceBooking
     * 
     * @return Collection
     */
    function getResourceBookingCollection()
    {
        if (!isset($this->_oResourceBookingCollection)) {
            $this->_oResourceBookingCollection = new Collection();
        }
        return $this->_oResourceBookingCollection;
    }

    /**
     * This Resource's ResourceDay collection.
     * 
     * @var Collection
     */
    private $_oResourceDayCollection;

    /**
     * Get ResourceDay collection.
     * 
     * @see ResourceDay
     * 
     * @return Collection
     */
    function getResourceDayCollection()
    {
        if (!isset($this->_oResourceDayCollection)) {
            $this->_oResourceDayCollection = new Collection();
        }
        return $this->_oResourceDayCollection;
    }



    public static function create($a_iBrfId, $a_iResourceTypeId, $a_iOpenHour, $a_iCloseHour, $a_iInterval, $a_sDescription, $a_sName, $a_iAdvanceBookings, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('resource')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('resource')->write($oObject);
        }
        return $oObject;
    }

}
