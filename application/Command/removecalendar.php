<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removecalendar
 *
 * @author John Jansson
 */
class Command_removecalendar extends Command 
{
    protected function _executeCommand() {
        $oCalendar = getCalendarAccessor()->getById($this->_aRequest['calendar']);
        if ($oCalendar) {
            $oCalendar->delete();
        }
    }
}

?>
