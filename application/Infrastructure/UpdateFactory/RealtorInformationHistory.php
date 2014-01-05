<?php

/**
 * Update factory class for RealtorInformationHistory. 
 *
 * @see RealtorInformationHistory
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_RealtorInformationHistory extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['set_by'] = $a_oDomainObject->getSetBy();
        $aUpdate['realtor_information_type_id'] = $a_oDomainObject->getRealtorInformationTypeId();
        $aUpdate['value'] = $a_oDomainObject->getValue();
        $aUpdate['comment'] = $a_oDomainObject->getComment();
        $aUpdate['saved_on'] = $a_oDomainObject->getSavedOn();
        return $aUpdate;
    }
}
