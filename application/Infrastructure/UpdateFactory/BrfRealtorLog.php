<?php

/**
 * Update factory class for BrfRealtorLog. 
 *
 * @see BrfRealtorLog
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfRealtorLog extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['realtor_message'] = $a_oDomainObject->getRealtorMessage();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        $aUpdate['sent_on'] = $a_oDomainObject->getSentOn();
        return $aUpdate;
    }
}
