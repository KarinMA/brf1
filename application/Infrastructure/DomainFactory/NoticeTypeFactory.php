<?php

/**
 * Object factory class for NoticeType. 
 *
 * @see NoticeType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_NoticeTypeFactory extends DomainFactory
{
    /**
     * Creates NoticeType instance. 
     *
     * @param array $a_aRow 
     * @return NoticeType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
