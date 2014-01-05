<?php

/**
 * Update factory class for PresidentLogCategory. 
 *
 * @see PresidentLogCategory
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_PresidentLogCategory extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['category_name'] = $a_oDomainObject->getCategoryName();
        $aUpdate['category_description'] = $a_oDomainObject->getCategoryDescription();
        $aUpdate['archive'] = $a_oDomainObject->getArchive();
        return $aUpdate;
    }
}
