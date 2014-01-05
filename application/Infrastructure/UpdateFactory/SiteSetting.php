<?php

/**
 * Update factory class for SiteSetting. 
 *
 * @see SiteSetting
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_SiteSetting extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['setting_type_id'] = $a_oDomainObject->getSettingTypeId();
        $aUpdate['value'] = $a_oDomainObject->getValue();
        $aUpdate['setting_time'] = $a_oDomainObject->getSettingTime();
        return $aUpdate;
    }
}
