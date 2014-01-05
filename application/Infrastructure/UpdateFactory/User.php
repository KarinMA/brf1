<?php

/**
 * Update factory class for User. 
 *
 * @see User
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_User extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['user_type'] = $a_oDomainObject->getUserType();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['username'] = $a_oDomainObject->getUsername();
        $aUpdate['password'] = $a_oDomainObject->getPassword();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['apartment_number'] = $a_oDomainObject->getApartmentNumber();
        $aUpdate['apartment_number2'] = $a_oDomainObject->getApartmentNumber2();
        $aUpdate['email'] = $a_oDomainObject->getEmail();
        $aUpdate['cellphone'] = $a_oDomainObject->getCellphone();
        $aUpdate['admin'] = $a_oDomainObject->getAdmin();
        $aUpdate['external_partner_id'] = $a_oDomainObject->getExternalPartnerId();
        $aUpdate['has_picture'] = $a_oDomainObject->getHasPicture();
        $aUpdate['image_type'] = $a_oDomainObject->getImageType();
        $aUpdate['presentation'] = $a_oDomainObject->getPresentation();
        $aUpdate['age'] = $a_oDomainObject->getAge();
        $aUpdate['lives_with'] = $a_oDomainObject->getLivesWith();
        $aUpdate['hide_phone'] = $a_oDomainObject->getHidePhone();
        $aUpdate['user_title_id'] = $a_oDomainObject->getUserTitleId();
        $aUpdate['login_cookie'] = $a_oDomainObject->getLoginCookie();
        $aUpdate['floor'] = $a_oDomainObject->getFloor();
        $aUpdate['address_id'] = $a_oDomainObject->getAddressId();
        $aUpdate['is_registered'] = $a_oDomainObject->getIsRegistered();
        $aUpdate['is_primary_member'] = $a_oDomainObject->getIsPrimaryMember();
        $aUpdate['primary_member_id'] = $a_oDomainObject->getPrimaryMemberId();
        $aUpdate['address_number'] = $a_oDomainObject->getAddressNumber();
        return $aUpdate;
    }
}
