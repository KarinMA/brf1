<?php

/**
 * Update factory class for MessageRead. 
 *
 * @see MessageRead
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_MessageRead extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['message_id'] = $a_oDomainObject->getMessageId();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['read_on'] = $a_oDomainObject->getReadOn();
        return $aUpdate;
    }
}
