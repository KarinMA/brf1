<?php

/**
 * Object factory class for Notice. 
 *
 * @see Notice
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_NoticeFactory extends DomainFactory
{
    /**
     * Creates Notice instance. 
     *
     * @param array $a_aRow 
     * @return Notice
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
