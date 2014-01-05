<?php

/**
 * Database accessor class for ResourceType. 
 *
 * @see Accessor 
 * @see ResourceType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_ResourceType extends Accessor
{


    /**
     * Get ResourceTypes by 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return Collection
     */
    function getResourceTypesByTypeName($a_sTypeName)
    {
        $oResourceTypeSelector = getResourceTypeSelector();
        $oResourceTypeSelector->setTypeName($a_sTypeName);
        $oResourceTypeCollection = $this->read($oResourceTypeSelector);
        return $oResourceTypeCollection;

    }

    /**
     * Get ResourceTypes by 'instruction_text' property. 
     *
     * @param string $a_sInstructionText
     * @return Collection
     */
    function getResourceTypesByInstructionText($a_sInstructionText)
    {
        $oResourceTypeSelector = getResourceTypeSelector();
        $oResourceTypeSelector->setInstructionText($a_sInstructionText);
        $oResourceTypeCollection = $this->read($oResourceTypeSelector);
        return $oResourceTypeCollection;

    }

    /**
     * Get ResourceTypes by 'whole_day' property. 
     *
     * @param bool $a_bWholeDay
     * @return Collection
     */
    function getResourceTypesByWholeDay($a_bWholeDay)
    {
        $oResourceTypeSelector = getResourceTypeSelector();
        $oResourceTypeSelector->setWholeDay($a_bWholeDay);
        $oResourceTypeCollection = $this->read($oResourceTypeSelector);
        return $oResourceTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'resource_type', 'ResourceType', new SelectionFactory_ResourceType(), new DomainFactory_ResourceTypeFactory(), new UpdateFactory_ResourceType(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
