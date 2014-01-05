<?php

/**
 * Object factory class for PresidentLogComment. 
 *
 * @see PresidentLogComment
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_PresidentLogCommentFactory extends DomainFactory
{
    /**
     * Creates PresidentLogComment instance. 
     *
     * @param array $a_aRow 
     * @return PresidentLogComment
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
