<?php

/**
 * Update factory class for SettingType. 
 *
 * @see SettingType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_SettingType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['setting_type_key'] = $a_oDomainObject->getSettingTypeKey();
        $aUpdate['setting_type_name'] = $a_oDomainObject->getSettingTypeName();
        return $aUpdate;
    }
}
