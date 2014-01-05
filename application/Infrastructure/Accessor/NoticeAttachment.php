<?php

/**
 * Database accessor class for NoticeAttachment. 
 *
 * @see Accessor 
 * @see NoticeAttachment
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_NoticeAttachment extends Accessor
{


    /**
     * Get NoticeAttachments by 'notice_id' property. 
     *
     * @param int $a_iNoticeId
     * @return Collection
     */
    function getNoticeAttachmentsByNoticeId($a_iNoticeId)
    {
        $oNoticeAttachmentSelector = getNoticeAttachmentSelector();
        $oNoticeAttachmentSelector->setNoticeId($a_iNoticeId);
        $oNoticeAttachmentCollection = $this->read($oNoticeAttachmentSelector);
        return $oNoticeAttachmentCollection;

    }

    /**
     * Get NoticeAttachments by 'attachment_file' property. 
     *
     * @param string $a_sAttachmentFile
     * @return Collection
     */
    function getNoticeAttachmentsByAttachmentFile($a_sAttachmentFile)
    {
        $oNoticeAttachmentSelector = getNoticeAttachmentSelector();
        $oNoticeAttachmentSelector->setAttachmentFile($a_sAttachmentFile);
        $oNoticeAttachmentCollection = $this->read($oNoticeAttachmentSelector);
        return $oNoticeAttachmentCollection;

    }

    /**
     * Get NoticeAttachments by 'attachment_file_type' property. 
     *
     * @param string $a_sAttachmentFileType
     * @return Collection
     */
    function getNoticeAttachmentsByAttachmentFileType($a_sAttachmentFileType)
    {
        $oNoticeAttachmentSelector = getNoticeAttachmentSelector();
        $oNoticeAttachmentSelector->setAttachmentFileType($a_sAttachmentFileType);
        $oNoticeAttachmentCollection = $this->read($oNoticeAttachmentSelector);
        return $oNoticeAttachmentCollection;

    }

    /**
     * Get NoticeAttachments by 'attachment_file_name' property. 
     *
     * @param string $a_sAttachmentFileName
     * @return Collection
     */
    function getNoticeAttachmentsByAttachmentFileName($a_sAttachmentFileName)
    {
        $oNoticeAttachmentSelector = getNoticeAttachmentSelector();
        $oNoticeAttachmentSelector->setAttachmentFileName($a_sAttachmentFileName);
        $oNoticeAttachmentCollection = $this->read($oNoticeAttachmentSelector);
        return $oNoticeAttachmentCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'notice_attachment', 'NoticeAttachment', new SelectionFactory_NoticeAttachment(), new DomainFactory_NoticeAttachmentFactory(), new UpdateFactory_NoticeAttachment(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
