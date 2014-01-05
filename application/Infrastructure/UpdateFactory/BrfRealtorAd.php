<?php

/**
 * Update factory class for BrfRealtorAd. 
 *
 * @see BrfRealtorAd
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfRealtorAd extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['realtor_user_id'] = $a_oDomainObject->getRealtorUserId();
        $aUpdate['rooms'] = $a_oDomainObject->getRooms();
        $aUpdate['address'] = $a_oDomainObject->getAddress();
        $aUpdate['stairs'] = $a_oDomainObject->getStairs();
        $aUpdate['fee'] = $a_oDomainObject->getFee();
        $aUpdate['price'] = $a_oDomainObject->getPrice();
        $aUpdate['square_meters'] = $a_oDomainObject->getSquareMeters();
        $aUpdate['created_on'] = $a_oDomainObject->getCreatedOn();
        $aUpdate['realtor_ad_link'] = $a_oDomainObject->getRealtorAdLink();
        $aUpdate['price_type'] = $a_oDomainObject->getPriceType();
        $aUpdate['has_picture'] = $a_oDomainObject->getHasPicture();
        $aUpdate['image_type'] = $a_oDomainObject->getImageType();
        $aUpdate['alternate_time'] = $a_oDomainObject->getAlternateTime();
        $aUpdate['sold'] = $a_oDomainObject->getSold();
        return $aUpdate;
    }
}
