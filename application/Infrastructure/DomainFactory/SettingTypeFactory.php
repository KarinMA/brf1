<?php

/**
 * Object factory class for SettingType. 
 *
 * @see SettingType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_SettingTypeFactory extends DomainFactory
{
    /**
     * Creates SettingType instance. 
     *
     * @param array $a_aRow 
     * @return SettingType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
