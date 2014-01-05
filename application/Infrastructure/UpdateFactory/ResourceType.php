<?php

/**
 * Update factory class for ResourceType. 
 *
 * @see ResourceType
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_ResourceType extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['type_name'] = $a_oDomainObject->getTypeName();
        $aUpdate['instruction_text'] = $a_oDomainObject->getInstructionText();
        $aUpdate['whole_day'] = $a_oDomainObject->getWholeDay();
        return $aUpdate;
    }
}
