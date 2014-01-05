<?php

/**
 * Update factory class for Resource. 
 *
 * @see Resource
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Resource extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['resource_type_id'] = $a_oDomainObject->getResourceTypeId();
        $aUpdate['open_hour'] = $a_oDomainObject->getOpenHour();
        $aUpdate['close_hour'] = $a_oDomainObject->getCloseHour();
        $aUpdate['interval'] = $a_oDomainObject->getInterval();
        $aUpdate['description'] = $a_oDomainObject->getDescription();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['advance_bookings'] = $a_oDomainObject->getAdvanceBookings();
        return $aUpdate;
    }
}
