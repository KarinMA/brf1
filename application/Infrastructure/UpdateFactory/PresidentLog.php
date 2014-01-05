<?php

/**
 * Update factory class for PresidentLog. 
 *
 * @see PresidentLog
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_PresidentLog extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['created_by_user_id'] = $a_oDomainObject->getCreatedByUserId();
        $aUpdate['document_id'] = $a_oDomainObject->getDocumentId();
        $aUpdate['comment'] = $a_oDomainObject->getComment();
        $aUpdate['date'] = $a_oDomainObject->getDate();
        $aUpdate['president_log_category_id'] = $a_oDomainObject->getPresidentLogCategoryId();
        $aUpdate['log_name'] = $a_oDomainObject->getLogName();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        return $aUpdate;
    }
}
