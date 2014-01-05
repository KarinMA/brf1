<?php

/**
 * Database accessor class for UserSetting. 
 *
 * @see Accessor 
 * @see UserSetting
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_UserSetting extends Accessor
{


    /**
     * Get UserSettings by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getUserSettingsByUserId($a_iUserId)
    {
        $oUserSettingSelector = getUserSettingSelector();
        $oUserSettingSelector->setUserId($a_iUserId);
        $oUserSettingCollection = $this->read($oUserSettingSelector);
        return $oUserSettingCollection;

    }

    /**
     * Get UserSettings by 'setting_type_id' property. 
     *
     * @param int $a_iSettingTypeId
     * @return Collection
     */
    function getUserSettingsBySettingTypeId($a_iSettingTypeId)
    {
        $oUserSettingSelector = getUserSettingSelector();
        $oUserSettingSelector->setSettingTypeId($a_iSettingTypeId);
        $oUserSettingCollection = $this->read($oUserSettingSelector);
        return $oUserSettingCollection;

    }

    /**
     * Get UserSettings by 'value' property. 
     *
     * @param string $a_sValue
     * @return Collection
     */
    function getUserSettingsByValue($a_sValue)
    {
        $oUserSettingSelector = getUserSettingSelector();
        $oUserSettingSelector->setValue($a_sValue);
        $oUserSettingCollection = $this->read($oUserSettingSelector);
        return $oUserSettingCollection;

    }

    /**
     * Get UserSettings by 'setting_time' property. 
     *
     * @param string $a_sSettingTime
     * @return Collection
     */
    function getUserSettingsBySettingTime($a_sSettingTime)
    {
        $oUserSettingSelector = getUserSettingSelector();
        $oUserSettingSelector->setSettingTime($a_sSettingTime);
        $oUserSettingCollection = $this->read($oUserSettingSelector);
        return $oUserSettingCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'user_setting', 'UserSetting', new SelectionFactory_UserSetting(), new DomainFactory_UserSettingFactory(), new UpdateFactory_UserSetting(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
