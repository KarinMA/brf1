<?php

/**
 * Object factory class for BrfSetting. 
 *
 * @see BrfSetting
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfSettingFactory extends DomainFactory
{
    /**
     * Creates BrfSetting instance. 
     *
     * @param array $a_aRow 
     * @return BrfSetting
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
