<?php

/**
 * Database accessor class for NoticeQueue. 
 *
 * @see Accessor 
 * @see NoticeQueue
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_NoticeQueue extends Accessor
{


    /**
     * Get NoticeQueues by 'notice_id' property. 
     *
     * @param int $a_iNoticeId
     * @return Collection
     */
    function getNoticeQueuesByNoticeId($a_iNoticeId)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setNoticeId($a_iNoticeId);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Get NoticeQueues by 'status' property. 
     *
     * @param string $a_sStatus
     * @return Collection
     */
    function getNoticeQueuesByStatus($a_sStatus)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setStatus($a_sStatus);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Get NoticeQueues by 'error_message' property. 
     *
     * @param string $a_sErrorMessage
     * @return Collection
     */
    function getNoticeQueuesByErrorMessage($a_sErrorMessage)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setErrorMessage($a_sErrorMessage);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Get NoticeQueues by 'error_code' property. 
     *
     * @param int $a_iErrorCode
     * @return Collection
     */
    function getNoticeQueuesByErrorCode($a_iErrorCode)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setErrorCode($a_iErrorCode);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Get NoticeQueues by 'queued_on' property. 
     *
     * @param string $a_sQueuedOn
     * @return Collection
     */
    function getNoticeQueuesByQueuedOn($a_sQueuedOn)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setQueuedOn($a_sQueuedOn);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Get NoticeQueues by 'send_on' property. 
     *
     * @param string $a_sSendOn
     * @return Collection
     */
    function getNoticeQueuesBySendOn($a_sSendOn)
    {
        $oNoticeQueueSelector = getNoticeQueueSelector();
        $oNoticeQueueSelector->setSendOn($a_sSendOn);
        $oNoticeQueueCollection = $this->read($oNoticeQueueSelector);
        return $oNoticeQueueCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'notice_queue', 'NoticeQueue', new SelectionFactory_NoticeQueue(), new DomainFactory_NoticeQueueFactory(), new UpdateFactory_NoticeQueue(), array(
            array('notice', array('linked_object', 'notice_id', 'setNotice')), // gets product with product id
        ));
    }




}
