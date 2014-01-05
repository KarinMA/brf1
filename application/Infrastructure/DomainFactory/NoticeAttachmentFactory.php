<?php

/**
 * Object factory class for NoticeAttachment. 
 *
 * @see NoticeAttachment
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_NoticeAttachmentFactory extends DomainFactory
{
    /**
     * Creates NoticeAttachment instance. 
     *
     * @param array $a_aRow 
     * @return NoticeAttachment
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
