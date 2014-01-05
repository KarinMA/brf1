<?php

/**
 * Object factory class for SiteSetting. 
 *
 * @see SiteSetting
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_SiteSettingFactory extends DomainFactory
{
    /**
     * Creates SiteSetting instance. 
     *
     * @param array $a_aRow 
     * @return SiteSetting
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
