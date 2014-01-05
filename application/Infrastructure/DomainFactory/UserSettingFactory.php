<?php

/**
 * Object factory class for UserSetting. 
 *
 * @see UserSetting
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_UserSettingFactory extends DomainFactory
{
    /**
     * Creates UserSetting instance. 
     *
     * @param array $a_aRow 
     * @return UserSetting
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
