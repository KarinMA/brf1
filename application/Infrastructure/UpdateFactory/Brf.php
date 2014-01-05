<?php

/**
 * Update factory class for Brf. 
 *
 * @see Brf
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Brf extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['url'] = $a_oDomainObject->getUrl();
        $aUpdate['government_number'] = $a_oDomainObject->getGovernmentNumber();
        $aUpdate['address'] = $a_oDomainObject->getAddress();
        $aUpdate['street_number'] = $a_oDomainObject->getStreetNumber();
        $aUpdate['street_number2'] = $a_oDomainObject->getStreetNumber2();
        $aUpdate['zip'] = $a_oDomainObject->getZip();
        $aUpdate['build_year'] = $a_oDomainObject->getBuildYear();
        $aUpdate['register_year'] = $a_oDomainObject->getRegisterYear();
        $aUpdate['postal_address'] = $a_oDomainObject->getPostalAddress();
        $aUpdate['apartments'] = $a_oDomainObject->getApartments();
        $aUpdate['presentation'] = $a_oDomainObject->getPresentation();
        $aUpdate['activated'] = $a_oDomainObject->getActivated();
        $aUpdate['realtor_user_id'] = $a_oDomainObject->getRealtorUserId();
        $aUpdate['show_street_view'] = $a_oDomainObject->getShowStreetView();
        $aUpdate['co_address'] = $a_oDomainObject->getCoAddress();
        return $aUpdate;
    }
}
