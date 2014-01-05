<?php

/**
 * Update factory class for ExternalPartnerType. 
 *
 * @see ExternalPartnerType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_ExternalPartnerType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['type_name'] = $a_oDomainObject->getTypeName();
        return $aUpdate;
    }
}
