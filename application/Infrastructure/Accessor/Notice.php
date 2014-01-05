<?php

/**
 * Database accessor class for Notice. 
 *
 * @see Accessor 
 * @see Notice
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Notice extends Accessor
{


    /**
     * Get Notices by 'notice_type_id' property. 
     *
     * @param int $a_iNoticeTypeId
     * @return Collection
     */
    function getNoticesByNoticeTypeId($a_iNoticeTypeId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setNoticeTypeId($a_iNoticeTypeId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getNoticesByBrfId($a_iBrfId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setBrfId($a_iBrfId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return Collection
     */
    function getNoticesByUserId($a_iUserId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setUserId($a_iUserId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'resource_booking_id' property. 
     *
     * @param int $a_iResourceBookingId
     * @return Collection
     */
    function getNoticesByResourceBookingId($a_iResourceBookingId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setResourceBookingId($a_iResourceBookingId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'calendar_id' property. 
     *
     * @param int $a_iCalendarId
     * @return Collection
     */
    function getNoticesByCalendarId($a_iCalendarId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setCalendarId($a_iCalendarId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'from_user_id' property. 
     *
     * @param int $a_iFromUserId
     * @return Collection
     */
    function getNoticesByFromUserId($a_iFromUserId)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setFromUserId($a_iFromUserId);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'body' property. 
     *
     * @param string $a_sBody
     * @return Collection
     */
    function getNoticesByBody($a_sBody)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setBody($a_sBody);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'body_html' property. 
     *
     * @param string $a_sBodyHtml
     * @return Collection
     */
    function getNoticesByBodyHtml($a_sBodyHtml)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setBodyHtml($a_sBodyHtml);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'subject' property. 
     *
     * @param string $a_sSubject
     * @return Collection
     */
    function getNoticesBySubject($a_sSubject)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setSubject($a_sSubject);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'sender' property. 
     *
     * @param string $a_sSender
     * @return Collection
     */
    function getNoticesBySender($a_sSender)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setSender($a_sSender);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'receiver' property. 
     *
     * @param string $a_sReceiver
     * @return Collection
     */
    function getNoticesByReceiver($a_sReceiver)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setReceiver($a_sReceiver);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'sent' property. 
     *
     * @param bool $a_bSent
     * @return Collection
     */
    function getNoticesBySent($a_bSent)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setSent($a_bSent);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return Collection
     */
    function getNoticesBySentOn($a_sSentOn)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setSentOn($a_sSentOn);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Get Notices by 'failed_on' property. 
     *
     * @param string $a_sFailedOn
     * @return Collection
     */
    function getNoticesByFailedOn($a_sFailedOn)
    {
        $oNoticeSelector = getNoticeSelector();
        $oNoticeSelector->setFailedOn($a_sFailedOn);
        $oNoticeCollection = $this->read($oNoticeSelector);
        return $oNoticeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'notice', 'Notice', new SelectionFactory_Notice(), new DomainFactory_NoticeFactory(), new UpdateFactory_Notice(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            array('notice_queue', array('dependent_objects', 'notice_id', 'getNoticeId')), // gets orders customer id
            array('notice_attachment', array('dependent_objects', 'notice_id', 'getNoticeId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
