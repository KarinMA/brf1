<?php

/**
 * Update factory class for ResourceDay. 
 *
 * @see ResourceDay
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_ResourceDay extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['resource_id'] = $a_oDomainObject->getResourceId();
        $aUpdate['day'] = $a_oDomainObject->getDay();
        return $aUpdate;
    }
}
