<?php

/**
 * Update factory class for Calendar. 
 *
 * @see Calendar
 * @see UpdateFactory
 * @package JJ_OrderSystem
 * @subpackage UpdateFactory
 */
class UpdateFactory_Calendar extends UpdateFactory
{
    function newUpdate(DomainObject $a_oDomainObject)
    {
        $aUpdate = array();
        $aUpdate['brf_id'] = $a_oDomainObject->getBrfId();
        $aUpdate['header'] = $a_oDomainObject->getHeader();
        $aUpdate['text'] = $a_oDomainObject->getText();
        $aUpdate['when'] = $a_oDomainObject->getWhen();
        $aUpdate['ends'] = $a_oDomainObject->getEnds();
        $aUpdate['is_board'] = $a_oDomainObject->getIsBoard();
        return $aUpdate;
    }
}
