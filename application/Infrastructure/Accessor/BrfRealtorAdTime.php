<?php

/**
 * Database accessor class for BrfRealtorAdTime. 
 *
 * @see Accessor 
 * @see BrfRealtorAdTime
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfRealtorAdTime extends Accessor
{


    /**
     * Get BrfRealtorAdTimes by 'brf_realtor_ad_id' property. 
     *
     * @param int $a_iBrfRealtorAdId
     * @return Collection
     */
    function getBrfRealtorAdTimesByBrfRealtorAdId($a_iBrfRealtorAdId)
    {
        $oBrfRealtorAdTimeSelector = getBrfRealtorAdTimeSelector();
        $oBrfRealtorAdTimeSelector->setBrfRealtorAdId($a_iBrfRealtorAdId);
        $oBrfRealtorAdTimeCollection = $this->read($oBrfRealtorAdTimeSelector);
        return $oBrfRealtorAdTimeCollection;

    }

    /**
     * Get BrfRealtorAdTimes by 'start_time' property. 
     *
     * @param string $a_sStartTime
     * @return Collection
     */
    function getBrfRealtorAdTimesByStartTime($a_sStartTime)
    {
        $oBrfRealtorAdTimeSelector = getBrfRealtorAdTimeSelector();
        $oBrfRealtorAdTimeSelector->setStartTime($a_sStartTime);
        $oBrfRealtorAdTimeCollection = $this->read($oBrfRealtorAdTimeSelector);
        return $oBrfRealtorAdTimeCollection;

    }

    /**
     * Get BrfRealtorAdTimes by 'duration_minutes' property. 
     *
     * @param int $a_iDurationMinutes
     * @return Collection
     */
    function getBrfRealtorAdTimesByDurationMinutes($a_iDurationMinutes)
    {
        $oBrfRealtorAdTimeSelector = getBrfRealtorAdTimeSelector();
        $oBrfRealtorAdTimeSelector->setDurationMinutes($a_iDurationMinutes);
        $oBrfRealtorAdTimeCollection = $this->read($oBrfRealtorAdTimeSelector);
        return $oBrfRealtorAdTimeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_realtor_ad_time', 'BrfRealtorAdTime', new SelectionFactory_BrfRealtorAdTime(), new DomainFactory_BrfRealtorAdTimeFactory(), new UpdateFactory_BrfRealtorAdTime(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
