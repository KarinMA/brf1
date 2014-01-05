<?php

/**
 * Database accessor class for Message. 
 *
 * @see Accessor 
 * @see Message
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Message extends Accessor
{


    /**
     * Get Messages by 'sender_id' property. 
     *
     * @param int $a_iSenderId
     * @return Collection
     */
    function getMessagesBySenderId($a_iSenderId)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setSenderId($a_iSenderId);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getMessagesByBrfId($a_iBrfId)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setBrfId($a_iBrfId);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'message' property. 
     *
     * @param string $a_sMessage
     * @return Collection
     */
    function getMessagesByMessage($a_sMessage)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setMessage($a_sMessage);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getMessagesByHeader($a_sHeader)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setHeader($a_sHeader);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'send_time' property. 
     *
     * @param string $a_sSendTime
     * @return Collection
     */
    function getMessagesBySendTime($a_sSendTime)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setSendTime($a_sSendTime);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return Collection
     */
    function getMessagesByHasPicture($a_bHasPicture)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setHasPicture($a_bHasPicture);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Get Messages by 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return Collection
     */
    function getMessagesByImageType($a_sImageType)
    {
        $oMessageSelector = getMessageSelector();
        $oMessageSelector->setImageType($a_sImageType);
        $oMessageCollection = $this->read($oMessageSelector);
        return $oMessageCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'message', 'Message', new SelectionFactory_Message(), new DomainFactory_MessageFactory(), new UpdateFactory_Message(), array(
            array('user', array('linked_object', 'sender_id', 'setSender')), // gets product with product id
        ));
    }




}
