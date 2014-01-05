<?php

/**
 * Update factory class for WebformActivation. 
 *
 * @see WebformActivation
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_WebformActivation extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['name'] = $a_oDomainObject->getName();
        $aUpdate['email'] = $a_oDomainObject->getEmail();
        $aUpdate['phone'] = $a_oDomainObject->getPhone();
        $aUpdate['role'] = $a_oDomainObject->getRole();
        $aUpdate['instructions_sent'] = $a_oDomainObject->getInstructionsSent();
        $aUpdate['sent_on'] = $a_oDomainObject->getSentOn();
        return $aUpdate;
    }
}
