<?php

/**
 * Database accessor class for BrfMail. 
 *
 * @see Accessor 
 * @see BrfMail
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfMail extends Accessor
{


    /**
     * Get BrfMails by 'from_user_id' property. 
     *
     * @param int $a_iFromUserId
     * @return Collection
     */
    function getBrfMailsByFromUserId($a_iFromUserId)
    {
        $oBrfMailSelector = getBrfMailSelector();
        $oBrfMailSelector->setFromUserId($a_iFromUserId);
        $oBrfMailCollection = $this->read($oBrfMailSelector);
        return $oBrfMailCollection;

    }

    /**
     * Get BrfMails by 'message' property. 
     *
     * @param string $a_sMessage
     * @return Collection
     */
    function getBrfMailsByMessage($a_sMessage)
    {
        $oBrfMailSelector = getBrfMailSelector();
        $oBrfMailSelector->setMessage($a_sMessage);
        $oBrfMailCollection = $this->read($oBrfMailSelector);
        return $oBrfMailCollection;

    }

    /**
     * Get BrfMails by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getBrfMailsByHeader($a_sHeader)
    {
        $oBrfMailSelector = getBrfMailSelector();
        $oBrfMailSelector->setHeader($a_sHeader);
        $oBrfMailCollection = $this->read($oBrfMailSelector);
        return $oBrfMailCollection;

    }

    /**
     * Get BrfMails by 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return Collection
     */
    function getBrfMailsBySentOn($a_sSentOn)
    {
        $oBrfMailSelector = getBrfMailSelector();
        $oBrfMailSelector->setSentOn($a_sSentOn);
        $oBrfMailCollection = $this->read($oBrfMailSelector);
        return $oBrfMailCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_mail', 'BrfMail', new SelectionFactory_BrfMail(), new DomainFactory_BrfMailFactory(), new UpdateFactory_BrfMail(), array(
            array('mail_receiver', array('dependent_objects', 'mail_id', 'getMailId')), // gets orders customer id
            array('user', array('linked_object', 'from_user_id', 'setFromUser')), // gets product with product id
        ));
    }




}
