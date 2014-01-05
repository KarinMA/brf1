<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadbookingcalendar
 *
 * @author John Jansson
 */
class Command_loadbookingcalendar extends Command_loadhtmlcommand 
{
    
    protected function _getFile() {
        return 'brf_loggedin_bokningskalender.php';
    }
    
    /**
     * @return array
     */
    protected function _getOtherParameters()
    {
        return array('available' => $GLOBALS['iAvailableSlots']);
    }
}

?>
