<?php

/**
 * Object factory class for Document. 
 *
 * @see Document
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_DocumentFactory extends DomainFactory
{
    /**
     * Creates Document instance. 
     *
     * @param array $a_aRow 
     * @return Document
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
