<?php

/**
 * Database accessor class for ResourceBooking. 
 *
 * @see Accessor 
 * @see ResourceBooking
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_ResourceBooking extends Accessor
{


    /**
     * Get ResourceBookings by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getResourceBookingsByUserId($a_iUserId)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setUserId($a_iUserId);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return Collection
     */
    function getResourceBookingsByResourceId($a_iResourceId)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setResourceId($a_iResourceId);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'start' property. 
     *
     * @param string $a_sStart
     * @return Collection
     */
    function getResourceBookingsByStart($a_sStart)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setStart($a_sStart);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'end' property. 
     *
     * @param string $a_sEnd
     * @return Collection
     */
    function getResourceBookingsByEnd($a_sEnd)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setEnd($a_sEnd);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'sms_reminder' property. 
     *
     * @param bool $a_bSmsReminder
     * @return Collection
     */
    function getResourceBookingsBySmsReminder($a_bSmsReminder)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setSmsReminder($a_bSmsReminder);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'mail_reminder' property. 
     *
     * @param bool $a_bMailReminder
     * @return Collection
     */
    function getResourceBookingsByMailReminder($a_bMailReminder)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setMailReminder($a_bMailReminder);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Get ResourceBookings by 'unbook_code' property. 
     *
     * @param string $a_sUnbookCode
     * @return Collection
     */
    function getResourceBookingsByUnbookCode($a_sUnbookCode)
    {
        $oResourceBookingSelector = getResourceBookingSelector();
        $oResourceBookingSelector->setUnbookCode($a_sUnbookCode);
        $oResourceBookingCollection = $this->read($oResourceBookingSelector);
        return $oResourceBookingCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'resource_booking', 'ResourceBooking', new SelectionFactory_ResourceBooking(), new DomainFactory_ResourceBookingFactory(), new UpdateFactory_ResourceBooking(), array(
            array('resource', array('linked_object', 'resource_id', 'setResource')), // gets product with product id
            array('user', array('linked_object', 'user_id', 'setUser')), // gets product with product id
            array('notice', array('dependent_objects', 'resource_booking_id', 'getResourceBookingId')), // gets orders customer id
        ));
    }




}
