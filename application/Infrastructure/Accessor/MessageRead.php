<?php

/**
 * Database accessor class for MessageRead. 
 *
 * @see Accessor 
 * @see MessageRead
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_MessageRead extends Accessor
{


    /**
     * Get MessageReads by 'message_id' property. 
     *
     * @param int $a_iMessageId
     * @return Collection
     */
    function getMessageReadsByMessageId($a_iMessageId)
    {
        $oMessageReadSelector = getMessageReadSelector();
        $oMessageReadSelector->setMessageId($a_iMessageId);
        $oMessageReadCollection = $this->read($oMessageReadSelector);
        return $oMessageReadCollection;

    }

    /**
     * Get MessageReads by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getMessageReadsByUserId($a_iUserId)
    {
        $oMessageReadSelector = getMessageReadSelector();
        $oMessageReadSelector->setUserId($a_iUserId);
        $oMessageReadCollection = $this->read($oMessageReadSelector);
        return $oMessageReadCollection;

    }

    /**
     * Get MessageReads by 'read_on' property. 
     *
     * @param string $a_sReadOn
     * @return Collection
     */
    function getMessageReadsByReadOn($a_sReadOn)
    {
        $oMessageReadSelector = getMessageReadSelector();
        $oMessageReadSelector->setReadOn($a_sReadOn);
        $oMessageReadCollection = $this->read($oMessageReadSelector);
        return $oMessageReadCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'message_read', 'MessageRead', new SelectionFactory_MessageRead(), new DomainFactory_MessageReadFactory(), new UpdateFactory_MessageRead(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
