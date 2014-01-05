<?php

/**
 * Update factory class for BrfMail. 
 *
 * @see BrfMail
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfMail extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['from_user_id'] = $a_oDomainObject->getFromUserId();
        $aUpdate['message'] = $a_oDomainObject->getMessage();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        $aUpdate['sent_on'] = $a_oDomainObject->getSentOn();
        return $aUpdate;
    }
}
