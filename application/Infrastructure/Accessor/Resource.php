<?php

/**
 * Database accessor class for Resource. 
 *
 * @see Accessor 
 * @see Resource
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Resource extends Accessor
{


    /**
     * Get Resources by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getResourcesByBrfId($a_iBrfId)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setBrfId($a_iBrfId);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;
    }

    /**
     * Get Resources by 'resource_type_id' property. 
     *
     * @param int $a_iResourceTypeId
     * @return Collection
     */
    function getResourcesByResourceTypeId($a_iResourceTypeId)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setResourceTypeId($a_iResourceTypeId);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'open_hour' property. 
     *
     * @param int $a_iOpenHour
     * @return Collection
     */
    function getResourcesByOpenHour($a_iOpenHour)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setOpenHour($a_iOpenHour);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'close_hour' property. 
     *
     * @param int $a_iCloseHour
     * @return Collection
     */
    function getResourcesByCloseHour($a_iCloseHour)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setCloseHour($a_iCloseHour);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'interval' property. 
     *
     * @param int $a_iInterval
     * @return Collection
     */
    function getResourcesByInterval($a_iInterval)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setInterval($a_iInterval);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'description' property. 
     *
     * @param string $a_sDescription
     * @return Collection
     */
    function getResourcesByDescription($a_sDescription)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setDescription($a_sDescription);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'name' property. 
     *
     * @param string $a_sName
     * @return Collection
     */
    function getResourcesByName($a_sName)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setName($a_sName);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Get Resources by 'advance_bookings' property. 
     *
     * @param int $a_iAdvanceBookings
     * @return Collection
     */
    function getResourcesByAdvanceBookings($a_iAdvanceBookings)
    {
        $oResourceSelector = getResourceSelector();
        $oResourceSelector->setAdvanceBookings($a_iAdvanceBookings);
        $oResourceCollection = $this->read($oResourceSelector);
        return $oResourceCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'resource', 'Resource', new SelectionFactory_Resource(), new DomainFactory_ResourceFactory(), new UpdateFactory_Resource(), array(
            array('resource_type', array('linked_object', 'resource_type_id', 'setResourceType')), // gets product with product id
            array('resource_day', array('dependent_objects', 'resource_id', 'getResourceId')), // gets product with product id
        ));
    }




}
