<?php

/**
 * Update factory class for Startpage. 
 *
 * @see Startpage
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Startpage extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['description'] = $a_oDomainObject->getDescription();
        $aUpdate['content'] = $a_oDomainObject->getContent();
        $aUpdate['edited_by'] = $a_oDomainObject->getEditedBy();
        $aUpdate['edited_at'] = $a_oDomainObject->getEditedAt();
        $aUpdate['content_type'] = $a_oDomainObject->getContentType();
        $aUpdate['category'] = $a_oDomainObject->getCategory();
        return $aUpdate;
    }
}
