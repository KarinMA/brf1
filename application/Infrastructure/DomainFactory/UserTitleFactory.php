<?php

/**
 * Object factory class for UserTitle. 
 *
 * @see UserTitle
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_UserTitleFactory extends DomainFactory
{
    /**
     * Creates UserTitle instance. 
     *
     * @param array $a_aRow 
     * @return UserTitle
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
