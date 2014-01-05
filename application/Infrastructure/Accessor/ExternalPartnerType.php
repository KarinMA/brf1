<?php

/**
 * Database accessor class for ExternalPartnerType. 
 *
 * @see Accessor 
 * @see ExternalPartnerType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_ExternalPartnerType extends Accessor
{


    /**
     * Get ExternalPartnerTypes by 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return Collection
     */
    function getExternalPartnerTypesByTypeName($a_sTypeName)
    {
        $oExternalPartnerTypeSelector = getExternalPartnerTypeSelector();
        $oExternalPartnerTypeSelector->setTypeName($a_sTypeName);
        $oExternalPartnerTypeCollection = $this->read($oExternalPartnerTypeSelector);
        return $oExternalPartnerTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'external_partner_type', 'ExternalPartnerType', new SelectionFactory_ExternalPartnerType(), new DomainFactory_ExternalPartnerTypeFactory(), new UpdateFactory_ExternalPartnerType(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
