<?php

/**
 * Update factory class for UserTitle. 
 *
 * @see UserTitle
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_UserTitle extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['title_name'] = $a_oDomainObject->getTitleName();
        return $aUpdate;
    }
}
