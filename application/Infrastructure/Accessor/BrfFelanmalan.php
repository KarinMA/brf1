<?php

/**
 * Database accessor class for BrfFelanmalan. 
 *
 * @see Accessor 
 * @see BrfFelanmalan
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfFelanmalan extends Accessor
{


    /**
     * Get BrfFelanmalans by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfFelanmalansByBrfId($a_iBrfId)
    {
        $oBrfFelanmalanSelector = getBrfFelanmalanSelector();
        $oBrfFelanmalanSelector->setBrfId($a_iBrfId);
        $oBrfFelanmalanCollection = $this->read($oBrfFelanmalanSelector);
        return $oBrfFelanmalanCollection;

    }

    /**
     * Get BrfFelanmalans by 'by_user_id' property. 
     *
     * @param int $a_iByUserId
     * @return Collection
     */
    function getBrfFelanmalansByByUserId($a_iByUserId)
    {
        $oBrfFelanmalanSelector = getBrfFelanmalanSelector();
        $oBrfFelanmalanSelector->setByUserId($a_iByUserId);
        $oBrfFelanmalanCollection = $this->read($oBrfFelanmalanSelector);
        return $oBrfFelanmalanCollection;

    }

    /**
     * Get BrfFelanmalans by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getBrfFelanmalansByHeader($a_sHeader)
    {
        $oBrfFelanmalanSelector = getBrfFelanmalanSelector();
        $oBrfFelanmalanSelector->setHeader($a_sHeader);
        $oBrfFelanmalanCollection = $this->read($oBrfFelanmalanSelector);
        return $oBrfFelanmalanCollection;

    }

    /**
     * Get BrfFelanmalans by 'message' property. 
     *
     * @param string $a_sMessage
     * @return Collection
     */
    function getBrfFelanmalansByMessage($a_sMessage)
    {
        $oBrfFelanmalanSelector = getBrfFelanmalanSelector();
        $oBrfFelanmalanSelector->setMessage($a_sMessage);
        $oBrfFelanmalanCollection = $this->read($oBrfFelanmalanSelector);
        return $oBrfFelanmalanCollection;

    }

    /**
     * Get BrfFelanmalans by 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return Collection
     */
    function getBrfFelanmalansBySentOn($a_sSentOn)
    {
        $oBrfFelanmalanSelector = getBrfFelanmalanSelector();
        $oBrfFelanmalanSelector->setSentOn($a_sSentOn);
        $oBrfFelanmalanCollection = $this->read($oBrfFelanmalanSelector);
        return $oBrfFelanmalanCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_felanmalan', 'BrfFelanmalan', new SelectionFactory_BrfFelanmalan(), new DomainFactory_BrfFelanmalanFactory(), new UpdateFactory_BrfFelanmalan(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
