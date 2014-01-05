<?php

/**
 * Update factory class for MailReceiver. 
 *
 * @see MailReceiver
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_MailReceiver extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['mail_id'] = $a_oDomainObject->getMailId();
        $aUpdate['is_read'] = $a_oDomainObject->getIsRead();
        $aUpdate['read_on'] = $a_oDomainObject->getReadOn();
        $aUpdate['to_user_id'] = $a_oDomainObject->getToUserId();
        $aUpdate['hidden'] = $a_oDomainObject->getHidden();
        return $aUpdate;
    }
}
