<?php

/**
 * Database accessor class for MailReceiver. 
 *
 * @see Accessor 
 * @see MailReceiver
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_MailReceiver extends Accessor
{


    /**
     * Get MailReceivers by 'mail_id' property. 
     *
     * @param int $a_iMailId
     * @return Collection
     */
    function getMailReceiversByMailId($a_iMailId)
    {
        $oMailReceiverSelector = getMailReceiverSelector();
        $oMailReceiverSelector->setMailId($a_iMailId);
        $oMailReceiverCollection = $this->read($oMailReceiverSelector);
        return $oMailReceiverCollection;

    }

    /**
     * Get MailReceivers by 'is_read' property. 
     *
     * @param bool $a_bIsRead
     * @return Collection
     */
    function getMailReceiversByIsRead($a_bIsRead)
    {
        $oMailReceiverSelector = getMailReceiverSelector();
        $oMailReceiverSelector->setIsRead($a_bIsRead);
        $oMailReceiverCollection = $this->read($oMailReceiverSelector);
        return $oMailReceiverCollection;

    }

    /**
     * Get MailReceivers by 'read_on' property. 
     *
     * @param string $a_sReadOn
     * @return Collection
     */
    function getMailReceiversByReadOn($a_sReadOn)
    {
        $oMailReceiverSelector = getMailReceiverSelector();
        $oMailReceiverSelector->setReadOn($a_sReadOn);
        $oMailReceiverCollection = $this->read($oMailReceiverSelector);
        return $oMailReceiverCollection;

    }

    /**
     * Get MailReceivers by 'to_user_id' property. 
     *
     * @param int $a_iToUserId
     * @return Collection
     */
    function getMailReceiversByToUserId($a_iToUserId)
    {
        $oMailReceiverSelector = getMailReceiverSelector();
        $oMailReceiverSelector->setToUserId($a_iToUserId);
        $oMailReceiverCollection = $this->read($oMailReceiverSelector);
        return $oMailReceiverCollection;

    }

    /**
     * Get MailReceivers by 'hidden' property. 
     *
     * @param bool $a_bHidden
     * @return Collection
     */
    function getMailReceiversByHidden($a_bHidden)
    {
        $oMailReceiverSelector = getMailReceiverSelector();
        $oMailReceiverSelector->setHidden($a_bHidden);
        $oMailReceiverCollection = $this->read($oMailReceiverSelector);
        return $oMailReceiverCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'mail_receiver', 'MailReceiver', new SelectionFactory_MailReceiver(), new DomainFactory_MailReceiverFactory(), new UpdateFactory_MailReceiver(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
