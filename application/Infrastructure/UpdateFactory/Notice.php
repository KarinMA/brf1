<?php

/**
 * Update factory class for Notice. 
 *
 * @see Notice
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Notice extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['notice_type_id'] = $a_oDomainObject->getNoticeTypeId();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['resource_booking_id'] = $a_oDomainObject->getResourceBookingId();
        $aUpdate['calendar_id'] = $a_oDomainObject->getCalendarId();
        $aUpdate['from_user_id'] = $a_oDomainObject->getFromUserId();
        $aUpdate['body'] = $a_oDomainObject->getBody();
        $aUpdate['body_html'] = $a_oDomainObject->getBodyHtml();
        $aUpdate['subject'] = $a_oDomainObject->getSubject();
        $aUpdate['sender'] = $a_oDomainObject->getSender();
        $aUpdate['receiver'] = $a_oDomainObject->getReceiver();
        $aUpdate['sent'] = $a_oDomainObject->getSent();
        $aUpdate['sent_on'] = $a_oDomainObject->getSentOn();
        $aUpdate['failed_on'] = $a_oDomainObject->getFailedOn();
        return $aUpdate;
    }
}
