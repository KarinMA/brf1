<?php

/**
 * Object factory class for BrfPicture. 
 *
 * @see BrfPicture
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_BrfPictureFactory extends DomainFactory
{
    /**
     * Creates BrfPicture instance. 
     *
     * @param array $a_aRow 
     * @return BrfPicture
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
