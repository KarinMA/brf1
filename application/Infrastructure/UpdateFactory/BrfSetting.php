<?php

/**
 * Update factory class for BrfSetting. 
 *
 * @see BrfSetting
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfSetting extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['setting_type_id'] = $a_oDomainObject->getSettingTypeId();
        $aUpdate['value'] = $a_oDomainObject->getValue();
        $aUpdate['setting_time'] = $a_oDomainObject->getSettingTime();
        return $aUpdate;
    }
}
