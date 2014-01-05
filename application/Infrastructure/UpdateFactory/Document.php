<?php

/**
 * Update factory class for Document. 
 *
 * @see Document
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Document extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['uploaded_by'] = $a_oDomainObject->getUploadedBy();
        $aUpdate['document_type_id'] = $a_oDomainObject->getDocumentTypeId();
        $aUpdate['filename'] = $a_oDomainObject->getFilename();
        $aUpdate['year'] = $a_oDomainObject->getYear();
        $aUpdate['is_public'] = $a_oDomainObject->getIsPublic();
        $aUpdate['file_type'] = $a_oDomainObject->getFileType();
        $aUpdate['is_board'] = $a_oDomainObject->getIsBoard();
        $aUpdate['is_president'] = $a_oDomainObject->getIsPresident();
        return $aUpdate;
    }
}
