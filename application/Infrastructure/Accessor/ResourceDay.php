<?php

/**
 * Database accessor class for ResourceDay. 
 *
 * @see Accessor 
 * @see ResourceDay
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_ResourceDay extends Accessor
{


    /**
     * Get ResourceDays by 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return Collection
     */
    function getResourceDaysByResourceId($a_iResourceId)
    {
        $oResourceDaySelector = getResourceDaySelector();
        $oResourceDaySelector->setResourceId($a_iResourceId);
        $oResourceDayCollection = $this->read($oResourceDaySelector);
        return $oResourceDayCollection;

    }

    /**
     * Get ResourceDays by 'day' property. 
     *
     * @param int $a_iDay
     * @return Collection
     */
    function getResourceDaysByDay($a_iDay)
    {
        $oResourceDaySelector = getResourceDaySelector();
        $oResourceDaySelector->setDay($a_iDay);
        $oResourceDayCollection = $this->read($oResourceDaySelector);
        return $oResourceDayCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'resource_day', 'ResourceDay', new SelectionFactory_ResourceDay(), new DomainFactory_ResourceDayFactory(), new UpdateFactory_ResourceDay(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
