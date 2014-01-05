<?php

/**
 * Update factory class for Parameters. 
 *
 * @see Parameters
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Parameters extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['insurance_type'] = $a_oDomainObject->getInsuranceType();
        $aUpdate['specification'] = $a_oDomainObject->getSpecification();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['friendly_name'] = $a_oDomainObject->getFriendlyName();
        $aUpdate['is_preset'] = $a_oDomainObject->getIsPreset();
        $aUpdate['description'] = $a_oDomainObject->getDescription();
        return $aUpdate;
    }
}
