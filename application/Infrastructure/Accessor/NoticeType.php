<?php

/**
 * Database accessor class for NoticeType. 
 *
 * @see Accessor 
 * @see NoticeType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_NoticeType extends Accessor
{


    /**
     * Get NoticeTypes by 'notice_type' property. 
     *
     * @param string $a_sNoticeType
     * @return Collection
     */
    function getNoticeTypesByNoticeType($a_sNoticeType)
    {
        $oNoticeTypeSelector = getNoticeTypeSelector();
        $oNoticeTypeSelector->setNoticeType($a_sNoticeType);
        $oNoticeTypeCollection = $this->read($oNoticeTypeSelector);
        return $oNoticeTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'notice_type', 'NoticeType', new SelectionFactory_NoticeType(), new DomainFactory_NoticeTypeFactory(), new UpdateFactory_NoticeType(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
