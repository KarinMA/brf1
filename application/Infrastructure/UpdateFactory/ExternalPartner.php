<?php

/**
 * Update factory class for ExternalPartner. 
 *
 * @see ExternalPartner
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_ExternalPartner extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['external_partner_type_id'] = $a_oDomainObject->getExternalPartnerTypeId();
        $aUpdate['partner_name'] = $a_oDomainObject->getPartnerName();
        $aUpdate['has_picture'] = $a_oDomainObject->getHasPicture();
        $aUpdate['image_type'] = $a_oDomainObject->getImageType();
        $aUpdate['presentation_text'] = $a_oDomainObject->getPresentationText();
        $aUpdate['phone'] = $a_oDomainObject->getPhone();
        $aUpdate['email'] = $a_oDomainObject->getEmail();
        $aUpdate['contact_info'] = $a_oDomainObject->getContactInfo();
        return $aUpdate;
    }
}
