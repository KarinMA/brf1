<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadresource
 *
 * @author John Jansson
 */
class Command_loadresource extends Command {
    
    protected function _executeCommand() 
    {
        $oBrf = getBrf();
        $oResource = $oBrf->getResourceById($this->_aRequest['resourceId']);
        if ($oResource->getBrfId() != $oBrf->getId()) {
            throw new CommandException("security error");
        }
        
        $aAvailableDays = array();
        $oAvailableDays = $oResource->getResourceDayCollection();
        foreach ($oAvailableDays as $oAvailableDay) {
            $aAvailableDays[] = $oAvailableDay->getDay();
        }
        
        $aReturn = array(
            'rules' => $oResource->getDescription(),
            'startTime' => getFormattedHour($oResource->getOpenHour()),
            'endTime' => getFormattedhour($oResource->getCloseHour()),
            'interval' => $oResource->getInterval(),
            'numberOfBookings' => $oResource->getAdvanceBookings() ? $oResource->getAdvanceBookings() : -1,
            'availableDays' => $aAvailableDays,
            'resourceType' => $oResource->getResourceType()->getTypeName(),
            'resourceName' => $oResource->getName(),
            'wholeDay' => $oResource->getResourceType()->getWholeDay(),
        );
        return $aReturn;
    }
}

?>
