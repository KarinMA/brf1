<?php

/**
 * Selector class for Resource. 
 *
 * @see Resource
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ResourceSelector extends Selector 
{


    /**
     * Resource selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Resource selector's 'resource_type_id' property. 
     *
     * @var int
     */
    private $_iResourceTypeId;

    /**
     * Resource selector's 'open_hour' property. 
     *
     * @var int
     */
    private $_iOpenHour;

    /**
     * Resource selector's 'close_hour' property. 
     *
     * @var int
     */
    private $_iCloseHour;

    /**
     * Resource selector's 'interval' property. 
     *
     * @var int
     */
    private $_iInterval;

    /**
     * Resource selector's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * Resource selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Resource selector's 'advance_bookings' property. 
     *
     * @var int
     */
    private $_iAdvanceBookings;
    /**
     * Get Resource selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Resource selector's 'brf_id' property. 
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
     * Get Resource selector's 'resource_type_id' property. 
     *
     * @return int
     */
    function getResourceTypeId()
    {
        return (int) $this->_iResourceTypeId;
    }

    /**
     * Set Resource selector's 'resource_type_id' property. 
     *
     * @param int $a_iResource selectorTypeId
     * @return void
     */
    function setResourceTypeId($a_iResourceTypeId)
    {
        $this->_iResourceTypeId = (int) $a_iResourceTypeId;
        $this->setSearchParameter('resource_type_id', $this->_iResourceTypeId);
    }

    /**
     * Get Resource selector's 'open_hour' property. 
     *
     * @return int
     */
    function getOpenHour()
    {
        return (int) $this->_iOpenHour;
    }

    /**
     * Set Resource selector's 'open_hour' property. 
     *
     * @param int $a_iOpenHour
     * @return void
     */
    function setOpenHour($a_iOpenHour)
    {
        $this->_iOpenHour = (int) $a_iOpenHour;
        $this->setSearchParameter('open_hour', $this->_iOpenHour);
    }

    /**
     * Get Resource selector's 'close_hour' property. 
     *
     * @return int
     */
    function getCloseHour()
    {
        return (int) $this->_iCloseHour;
    }

    /**
     * Set Resource selector's 'close_hour' property. 
     *
     * @param int $a_iCloseHour
     * @return void
     */
    function setCloseHour($a_iCloseHour)
    {
        $this->_iCloseHour = (int) $a_iCloseHour;
        $this->setSearchParameter('close_hour', $this->_iCloseHour);
    }

    /**
     * Get Resource selector's 'interval' property. 
     *
     * @return int
     */
    function getInterval()
    {
        return (int) $this->_iInterval;
    }

    /**
     * Set Resource selector's 'interval' property. 
     *
     * @param int $a_iInterval
     * @return void
     */
    function setInterval($a_iInterval)
    {
        $this->_iInterval = (int) $a_iInterval;
        $this->setSearchParameter('interval', $this->_iInterval);
    }

    /**
     * Get Resource selector's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Resource selector's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        $this->_sDescription = (string) $a_sDescription;
        $this->setSearchParameter('description', $this->_sDescription);
    }

    /**
     * Get Resource selector's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Resource selector's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        $this->_sName = (string) $a_sName;
        $this->setSearchParameter('name', $this->_sName);
    }

    /**
     * Get Resource selector's 'advance_bookings' property. 
     *
     * @return int|null
     */
    function getAdvanceBookings()
    {
        return is_null($this->_iAdvanceBookings) ? NULL : (int) $this->_iAdvanceBookings;
    }

    /**
     * Set Resource selector's 'advance_bookings' property. 
     *
     * @param int|null $a_iAdvanceBookings
     * @return void
     */
    function setAdvanceBookings($a_iAdvanceBookings)
    {
        $this->_iAdvanceBookings = is_null($a_iAdvanceBookings) ? NULL : (int) $a_iAdvanceBookings;
        $this->setSearchParameter('advance_bookings', (int) $this->_iAdvanceBookings, is_null($this->_iAdvanceBookings) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
