<?php

/**
 * Object factory class for Calendar. 
 *
 * @see Calendar
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_CalendarFactory extends DomainFactory
{
    /**
     * Creates Calendar instance. 
     *
     * @param array $a_aRow 
     * @return Calendar
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
