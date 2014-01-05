<?php

/**
 * Update factory class for ResourceBooking. 
 *
 * @see ResourceBooking
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_ResourceBooking extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['resource_id'] = $a_oDomainObject->getResourceId();
        $aUpdate['start'] = $a_oDomainObject->getStart();
        $aUpdate['end'] = $a_oDomainObject->getEnd();
        $aUpdate['sms_reminder'] = $a_oDomainObject->getSmsReminder();
        $aUpdate['mail_reminder'] = $a_oDomainObject->getMailReminder();
        $aUpdate['unbook_code'] = $a_oDomainObject->getUnbookCode();
        return $aUpdate;
    }
}
