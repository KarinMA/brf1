<?php

/**
 * Database accessor class for SettingType. 
 *
 * @see Accessor 
 * @see SettingType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_SettingType extends Accessor
{


    /**
     * Get SettingTypes by 'setting_type_key' property. 
     *
     * @param string $a_sSettingTypeKey
     * @return Collection
     */
    function getSettingTypesBySettingTypeKey($a_sSettingTypeKey)
    {
        $oSettingTypeSelector = getSettingTypeSelector();
        $oSettingTypeSelector->setSettingTypeKey($a_sSettingTypeKey);
        $oSettingTypeCollection = $this->read($oSettingTypeSelector);
        return $oSettingTypeCollection;

    }

    /**
     * Get SettingTypes by 'setting_type_name' property. 
     *
     * @param string $a_sSettingTypeName
     * @return Collection
     */
    function getSettingTypesBySettingTypeName($a_sSettingTypeName)
    {
        $oSettingTypeSelector = getSettingTypeSelector();
        $oSettingTypeSelector->setSettingTypeName($a_sSettingTypeName);
        $oSettingTypeCollection = $this->read($oSettingTypeSelector);
        return $oSettingTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'setting_type', 'SettingType', new SelectionFactory_SettingType(), new DomainFactory_SettingTypeFactory(), new UpdateFactory_SettingType(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
