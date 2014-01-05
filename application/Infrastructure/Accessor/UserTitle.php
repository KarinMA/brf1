<?php

/**
 * Database accessor class for UserTitle. 
 *
 * @see Accessor 
 * @see UserTitle
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_UserTitle extends Accessor
{


    /**
     * Get UserTitles by 'title_name' property. 
     *
     * @param string $a_sTitleName
     * @return Collection
     */
    function getUserTitlesByTitleName($a_sTitleName)
    {
        $oUserTitleSelector = getUserTitleSelector();
        $oUserTitleSelector->setTitleName($a_sTitleName);
        $oUserTitleCollection = $this->read($oUserTitleSelector);
        return $oUserTitleCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'user_title', 'UserTitle', new SelectionFactory_UserTitle(), new DomainFactory_UserTitleFactory(), new UpdateFactory_UserTitle(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
