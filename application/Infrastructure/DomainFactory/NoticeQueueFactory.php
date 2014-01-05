<?php

/**
 * Object factory class for NoticeQueue. 
 *
 * @see NoticeQueue
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_NoticeQueueFactory extends DomainFactory
{
    /**
     * Creates NoticeQueue instance. 
     *
     * @param array $a_aRow 
     * @return NoticeQueue
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
