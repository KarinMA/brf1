<?php

/**
 * Update factory class for UserSetting. 
 *
 * @see UserSetting
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_UserSetting extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['user_id'] = $a_oDomainObject->getUserId();
        $aUpdate['setting_type_id'] = $a_oDomainObject->getSettingTypeId();
        $aUpdate['value'] = $a_oDomainObject->getValue();
        $aUpdate['setting_time'] = $a_oDomainObject->getSettingTime();
        return $aUpdate;
    }
}
