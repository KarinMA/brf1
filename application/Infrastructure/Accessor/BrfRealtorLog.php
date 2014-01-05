<?php

/**
 * Database accessor class for BrfRealtorLog. 
 *
 * @see Accessor 
 * @see BrfRealtorLog
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfRealtorLog extends Accessor
{


    /**
     * Get BrfRealtorLogs by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfRealtorLogsByBrfId($a_iBrfId)
    {
        $oBrfRealtorLogSelector = getBrfRealtorLogSelector();
        $oBrfRealtorLogSelector->setBrfId($a_iBrfId);
        $oBrfRealtorLogCollection = $this->read($oBrfRealtorLogSelector);
        return $oBrfRealtorLogCollection;

    }

    /**
     * Get BrfRealtorLogs by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getBrfRealtorLogsByUserId($a_iUserId)
    {
        $oBrfRealtorLogSelector = getBrfRealtorLogSelector();
        $oBrfRealtorLogSelector->setUserId($a_iUserId);
        $oBrfRealtorLogCollection = $this->read($oBrfRealtorLogSelector);
        return $oBrfRealtorLogCollection;

    }

    /**
     * Get BrfRealtorLogs by 'realtor_message' property. 
     *
     * @param string $a_sRealtorMessage
     * @return Collection
     */
    function getBrfRealtorLogsByRealtorMessage($a_sRealtorMessage)
    {
        $oBrfRealtorLogSelector = getBrfRealtorLogSelector();
        $oBrfRealtorLogSelector->setRealtorMessage($a_sRealtorMessage);
        $oBrfRealtorLogCollection = $this->read($oBrfRealtorLogSelector);
        return $oBrfRealtorLogCollection;

    }

    /**
     * Get BrfRealtorLogs by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getBrfRealtorLogsByHeader($a_sHeader)
    {
        $oBrfRealtorLogSelector = getBrfRealtorLogSelector();
        $oBrfRealtorLogSelector->setHeader($a_sHeader);
        $oBrfRealtorLogCollection = $this->read($oBrfRealtorLogSelector);
        return $oBrfRealtorLogCollection;

    }

    /**
     * Get BrfRealtorLogs by 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return Collection
     */
    function getBrfRealtorLogsBySentOn($a_sSentOn)
    {
        $oBrfRealtorLogSelector = getBrfRealtorLogSelector();
        $oBrfRealtorLogSelector->setSentOn($a_sSentOn);
        $oBrfRealtorLogCollection = $this->read($oBrfRealtorLogSelector);
        return $oBrfRealtorLogCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_realtor_log', 'BrfRealtorLog', new SelectionFactory_BrfRealtorLog(), new DomainFactory_BrfRealtorLogFactory(), new UpdateFactory_BrfRealtorLog(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
