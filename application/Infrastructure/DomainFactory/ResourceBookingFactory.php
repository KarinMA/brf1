<?php

/**
 * Object factory class for ResourceBooking. 
 *
 * @see ResourceBooking
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_ResourceBookingFactory extends DomainFactory
{
    /**
     * Creates ResourceBooking instance. 
     *
     * @param array $a_aRow 
     * @return ResourceBooking
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
