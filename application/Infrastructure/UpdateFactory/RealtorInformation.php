<?php

/**
 * Update factory class for RealtorInformation. 
 *
 * @see RealtorInformation
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_RealtorInformation extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['set_by'] = $a_oDomainObject->getSetBy();
        $aUpdate['realtor_information_type_id'] = $a_oDomainObject->getRealtorInformationTypeId();
        $aUpdate['value'] = $a_oDomainObject->getValue();
        $aUpdate['comment'] = $a_oDomainObject->getComment();
        return $aUpdate;
    }
}
