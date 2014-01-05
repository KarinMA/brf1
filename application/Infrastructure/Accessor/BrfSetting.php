<?php

/**
 * Database accessor class for BrfSetting. 
 *
 * @see Accessor 
 * @see BrfSetting
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfSetting extends Accessor
{


    /**
     * Get BrfSettings by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfSettingsByBrfId($a_iBrfId)
    {
        $oBrfSettingSelector = getBrfSettingSelector();
        $oBrfSettingSelector->setBrfId($a_iBrfId);
        $oBrfSettingCollection = $this->read($oBrfSettingSelector);
        return $oBrfSettingCollection;

    }

    /**
     * Get BrfSettings by 'setting_type_id' property. 
     *
     * @param int $a_iSettingTypeId
     * @return Collection
     */
    function getBrfSettingsBySettingTypeId($a_iSettingTypeId)
    {
        $oBrfSettingSelector = getBrfSettingSelector();
        $oBrfSettingSelector->setSettingTypeId($a_iSettingTypeId);
        $oBrfSettingCollection = $this->read($oBrfSettingSelector);
        return $oBrfSettingCollection;

    }

    /**
     * Get BrfSettings by 'value' property. 
     *
     * @param string $a_sValue
     * @return Collection
     */
    function getBrfSettingsByValue($a_sValue)
    {
        $oBrfSettingSelector = getBrfSettingSelector();
        $oBrfSettingSelector->setValue($a_sValue);
        $oBrfSettingCollection = $this->read($oBrfSettingSelector);
        return $oBrfSettingCollection;

    }

    /**
     * Get BrfSettings by 'setting_time' property. 
     *
     * @param string $a_sSettingTime
     * @return Collection
     */
    function getBrfSettingsBySettingTime($a_sSettingTime)
    {
        $oBrfSettingSelector = getBrfSettingSelector();
        $oBrfSettingSelector->setSettingTime($a_sSettingTime);
        $oBrfSettingCollection = $this->read($oBrfSettingSelector);
        return $oBrfSettingCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_setting', 'BrfSetting', new SelectionFactory_BrfSetting(), new DomainFactory_BrfSettingFactory(), new UpdateFactory_BrfSetting(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
