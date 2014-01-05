<?php

/**
 * Update factory class for BrfRealtorAdTime. 
 *
 * @see BrfRealtorAdTime
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfRealtorAdTime extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_realtor_ad_id'] = $a_oDomainObject->getBrfRealtorAdId();
        $aUpdate['start_time'] = $a_oDomainObject->getStartTime();
        $aUpdate['duration_minutes'] = $a_oDomainObject->getDurationMinutes();
        return $aUpdate;
    }
}
