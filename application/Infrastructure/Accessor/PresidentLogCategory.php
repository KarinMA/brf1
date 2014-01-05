<?php

/**
 * Database accessor class for PresidentLogCategory. 
 *
 * @see Accessor 
 * @see PresidentLogCategory
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_PresidentLogCategory extends Accessor
{


    /**
     * Get PresidentLogCategorys by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getPresidentLogCategorysByBrfId($a_iBrfId)
    {
        $oPresidentLogCategorySelector = getPresidentLogCategorySelector();
        $oPresidentLogCategorySelector->setBrfId($a_iBrfId);
        $oPresidentLogCategoryCollection = $this->read($oPresidentLogCategorySelector);
        return $oPresidentLogCategoryCollection;

    }

    /**
     * Get PresidentLogCategorys by 'category_name' property. 
     *
     * @param string $a_sCategoryName
     * @return Collection
     */
    function getPresidentLogCategorysByCategoryName($a_sCategoryName)
    {
        $oPresidentLogCategorySelector = getPresidentLogCategorySelector();
        $oPresidentLogCategorySelector->setCategoryName($a_sCategoryName);
        $oPresidentLogCategoryCollection = $this->read($oPresidentLogCategorySelector);
        return $oPresidentLogCategoryCollection;

    }

    /**
     * Get PresidentLogCategorys by 'category_description' property. 
     *
     * @param string $a_sCategoryDescription
     * @return Collection
     */
    function getPresidentLogCategorysByCategoryDescription($a_sCategoryDescription)
    {
        $oPresidentLogCategorySelector = getPresidentLogCategorySelector();
        $oPresidentLogCategorySelector->setCategoryDescription($a_sCategoryDescription);
        $oPresidentLogCategoryCollection = $this->read($oPresidentLogCategorySelector);
        return $oPresidentLogCategoryCollection;

    }

    /**
     * Get PresidentLogCategorys by 'archive' property. 
     *
     * @param bool $a_bArchive
     * @return Collection
     */
    function getPresidentLogCategorysByArchive($a_bArchive)
    {
        $oPresidentLogCategorySelector = getPresidentLogCategorySelector();
        $oPresidentLogCategorySelector->setArchive($a_bArchive);
        $oPresidentLogCategoryCollection = $this->read($oPresidentLogCategorySelector);
        return $oPresidentLogCategoryCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'president_log_category', 'PresidentLogCategory', new SelectionFactory_PresidentLogCategory(), new DomainFactory_PresidentLogCategoryFactory(), new UpdateFactory_PresidentLogCategory(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
