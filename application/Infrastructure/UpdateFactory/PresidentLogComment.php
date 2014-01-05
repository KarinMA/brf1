<?php

/**
 * Update factory class for PresidentLogComment. 
 *
 * @see PresidentLogComment
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_PresidentLogComment extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['president_log_id'] = $a_oDomainObject->getPresidentLogId();
        $aUpdate['by_user_id'] = $a_oDomainObject->getByUserId();
        $aUpdate['timestamp'] = $a_oDomainObject->getTimestamp();
        $aUpdate['comment'] = $a_oDomainObject->getComment();
        return $aUpdate;
    }
}
