<?php

/**
 * Object factory class for DocumentType. 
 *
 * @see DocumentType
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_DocumentTypeFactory extends DomainFactory
{
    /**
     * Creates DocumentType instance. 
     *
     * @param array $a_aRow 
     * @return DocumentType
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
