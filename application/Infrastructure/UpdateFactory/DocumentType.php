<?php

/**
 * Update factory class for DocumentType. 
 *
 * @see DocumentType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_DocumentType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['document_type_name'] = $a_oDomainObject->getDocumentTypeName();
        $aUpdate['directory_name'] = $a_oDomainObject->getDirectoryName();
        $aUpdate['has_year'] = $a_oDomainObject->getHasYear();
        $aUpdate['is_archive'] = $a_oDomainObject->getIsArchive();
        return $aUpdate;
    }
}
