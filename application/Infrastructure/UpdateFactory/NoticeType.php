<?php

/**
 * Update factory class for NoticeType. 
 *
 * @see NoticeType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_NoticeType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['notice_type'] = $a_oDomainObject->getNoticeType();
        return $aUpdate;
    }
}
