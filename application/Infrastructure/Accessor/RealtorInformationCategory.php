<?php

/**
 * Database accessor class for RealtorInformationCategory. 
 *
 * @see Accessor 
 * @see RealtorInformationCategory
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_RealtorInformationCategory extends Accessor
{


    /**
     * Get RealtorInformationCategorys by 'category_name' property. 
     *
     * @param string $a_sCategoryName
     * @return Collection
     */
    function getRealtorInformationCategorysByCategoryName($a_sCategoryName)
    {
        $oRealtorInformationCategorySelector = getRealtorInformationCategorySelector();
        $oRealtorInformationCategorySelector->setCategoryName($a_sCategoryName);
        $oRealtorInformationCategoryCollection = $this->read($oRealtorInformationCategorySelector);
        return $oRealtorInformationCategoryCollection;

    }

    /**
     * Get RealtorInformationCategory by 'category_key' property. 
     *
     * @param string $a_sCategoryKey
     * @return Collection
     */
    function getRealtorInformationCategoryByCategoryKey($a_sCategoryKey)
    {
        $oRealtorInformationCategorySelector = getRealtorInformationCategorySelector();
        $oRealtorInformationCategorySelector->setCategoryKey($a_sCategoryKey);
        return $this->readOne($oRealtorInformationCategorySelector);

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'realtor_information_category', 'RealtorInformationCategory', new SelectionFactory_RealtorInformationCategory(), new DomainFactory_RealtorInformationCategoryFactory(), new UpdateFactory_RealtorInformationCategory(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
