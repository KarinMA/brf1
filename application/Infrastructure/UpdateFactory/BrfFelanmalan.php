<?php

/**
 * Update factory class for BrfFelanmalan. 
 *
 * @see BrfFelanmalan
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_BrfFelanmalan extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['by_user_id'] = $a_oDomainObject->getByUserId();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        $aUpdate['message'] = $a_oDomainObject->getMessage();
        $aUpdate['sent_on'] = $a_oDomainObject->getSentOn();
        return $aUpdate;
    }
}
