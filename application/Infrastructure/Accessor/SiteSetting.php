<?php

/**
 * Database accessor class for SiteSetting. 
 *
 * @see Accessor 
 * @see SiteSetting
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_SiteSetting extends Accessor
{


    /**
     * Get SiteSettings by 'setting_type_id' property. 
     *
     * @param int $a_iSettingTypeId
     * @return Collection
     */
    function getSiteSettingsBySettingTypeId($a_iSettingTypeId)
    {
        $oSiteSettingSelector = getSiteSettingSelector();
        $oSiteSettingSelector->setSettingTypeId($a_iSettingTypeId);
        $oSiteSettingCollection = $this->read($oSiteSettingSelector);
        return $oSiteSettingCollection;

    }

    /**
     * Get SiteSettings by 'value' property. 
     *
     * @param string $a_sValue
     * @return Collection
     */
    function getSiteSettingsByValue($a_sValue)
    {
        $oSiteSettingSelector = getSiteSettingSelector();
        $oSiteSettingSelector->setValue($a_sValue);
        $oSiteSettingCollection = $this->read($oSiteSettingSelector);
        return $oSiteSettingCollection;

    }

    /**
     * Get SiteSettings by 'setting_time' property. 
     *
     * @param string $a_sSettingTime
     * @return Collection
     */
    function getSiteSettingsBySettingTime($a_sSettingTime)
    {
        $oSiteSettingSelector = getSiteSettingSelector();
        $oSiteSettingSelector->setSettingTime($a_sSettingTime);
        $oSiteSettingCollection = $this->read($oSiteSettingSelector);
        return $oSiteSettingCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'site_setting', 'SiteSetting', new SelectionFactory_SiteSetting(), new DomainFactory_SiteSettingFactory(), new UpdateFactory_SiteSetting(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
