<?php

/**
 * Update factory class for BrfAddress. 
 *
 * @see BrfAddress
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfAddress extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['address'] = $a_oDomainObject->getAddress();
        $aUpdate['street_number'] = $a_oDomainObject->getStreetNumber();
        $aUpdate['street_number2'] = $a_oDomainObject->getStreetNumber2();
        $aUpdate['zip'] = $a_oDomainObject->getZip();
        $aUpdate['postal_address'] = $a_oDomainObject->getPostalAddress();
        $aUpdate['even_numbers'] = $a_oDomainObject->getEvenNumbers();
        $aUpdate['odd_numbers'] = $a_oDomainObject->getOddNumbers();
        return $aUpdate;
    }
}
