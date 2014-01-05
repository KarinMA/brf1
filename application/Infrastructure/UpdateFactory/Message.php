<?php

/**
 * Update factory class for Message. 
 *
 * @see Message
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Message extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['sender_id'] = $a_oDomainObject->getSenderId();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['message'] = $a_oDomainObject->getMessage();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        $aUpdate['send_time'] = $a_oDomainObject->getSendTime();
        $aUpdate['has_picture'] = $a_oDomainObject->getHasPicture();
        $aUpdate['image_type'] = $a_oDomainObject->getImageType();
        return $aUpdate;
    }
}
