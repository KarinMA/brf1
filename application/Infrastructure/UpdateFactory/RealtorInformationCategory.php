<?php

/**
 * Update factory class for RealtorInformationCategory. 
 *
 * @see RealtorInformationCategory
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_RealtorInformationCategory extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['category_name'] = $a_oDomainObject->getCategoryName();
        $aUpdate['category_key'] = $a_oDomainObject->getCategoryKey();
        return $aUpdate;
    }
}
