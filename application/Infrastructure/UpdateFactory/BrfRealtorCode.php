<?php

/**
 * Update factory class for BrfRealtorCode. 
 *
 * @see BrfRealtorCode
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfRealtorCode extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['realtor_user_id'] = $a_oDomainObject->getRealtorUserId();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['realtor_code'] = $a_oDomainObject->getRealtorCode();
        $aUpdate['created_on'] = $a_oDomainObject->getCreatedOn();
        return $aUpdate;
    }
}
