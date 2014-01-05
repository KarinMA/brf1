<?php

/**
 * Object factory class for Startpage. 
 *
 * @see Startpage
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_StartpageFactory extends DomainFactory
{
    /**
     * Creates Startpage instance. 
     *
     * @param array $a_aRow 
     * @return Startpage
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
