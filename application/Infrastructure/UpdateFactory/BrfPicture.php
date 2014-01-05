<?php

/**
 * Update factory class for BrfPicture. 
 *
 * @see BrfPicture
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfPicture extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['front'] = $a_oDomainObject->getFront();
        $aUpdate['title'] = $a_oDomainObject->getTitle();
        $aUpdate['description'] = $a_oDomainObject->getDescription();
        $aUpdate['has_picture'] = $a_oDomainObject->getHasPicture();
        $aUpdate['image_type'] = $a_oDomainObject->getImageType();
        return $aUpdate;
    }
}
