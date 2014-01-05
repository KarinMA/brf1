<?php

/**
 * Update factory class for NoticeQueue. 
 *
 * @see NoticeQueue
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_NoticeQueue extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['notice_id'] = $a_oDomainObject->getNoticeId();
        $aUpdate['status'] = $a_oDomainObject->getStatus();
        $aUpdate['error_message'] = $a_oDomainObject->getErrorMessage();
        $aUpdate['error_code'] = $a_oDomainObject->getErrorCode();
        $aUpdate['queued_on'] = $a_oDomainObject->getQueuedOn();
        $aUpdate['send_on'] = $a_oDomainObject->getSendOn();
        return $aUpdate;
    }
}
