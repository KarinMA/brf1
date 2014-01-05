<?php

/**
 * Database accessor class for Calendar. 
 *
 * @see Accessor 
 * @see Calendar
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Calendar extends Accessor
{


    /**
     * Get Calendars by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getCalendarsByBrfId($a_iBrfId)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setBrfId($a_iBrfId);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Get Calendars by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getCalendarsByHeader($a_sHeader)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setHeader($a_sHeader);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Get Calendars by 'text' property. 
     *
     * @param string $a_sText
     * @return Collection
     */
    function getCalendarsByText($a_sText)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setText($a_sText);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Get Calendars by 'when' property. 
     *
     * @param string $a_sWhen
     * @return Collection
     */
    function getCalendarsByWhen($a_sWhen)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setWhen($a_sWhen);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Get Calendars by 'ends' property. 
     *
     * @param string $a_sEnds
     * @return Collection
     */
    function getCalendarsByEnds($a_sEnds)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setEnds($a_sEnds);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Get Calendars by 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return Collection
     */
    function getCalendarsByIsBoard($a_bIsBoard)
    {
        $oCalendarSelector = getCalendarSelector();
        $oCalendarSelector->setIsBoard($a_bIsBoard);
        $oCalendarCollection = $this->read($oCalendarSelector);
        return $oCalendarCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'calendar', 'Calendar', new SelectionFactory_Calendar(), new DomainFactory_CalendarFactory(), new UpdateFactory_Calendar(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
