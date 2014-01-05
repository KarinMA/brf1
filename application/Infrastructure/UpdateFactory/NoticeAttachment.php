<?php

/**
 * Update factory class for NoticeAttachment. 
 *
 * @see NoticeAttachment
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_NoticeAttachment extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['notice_id'] = $a_oDomainObject->getNoticeId();
        $aUpdate['attachment_file'] = $a_oDomainObject->getAttachmentFile();
        $aUpdate['attachment_file_type'] = $a_oDomainObject->getAttachmentFileType();
        $aUpdate['attachment_file_name'] = $a_oDomainObject->getAttachmentFileName();
        return $aUpdate;
    }
}
