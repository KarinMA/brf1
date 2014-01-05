<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of editbooking
 *
 * @author John Jansson
 */
class Command_editbooking extends Command
{
    /**
     * 
     */
    protected function _executeCommand()
    {
        $oBrfSession = SvenskBRF_Session::getInstance();
        call_user_func_array(array($oBrfSession, 'editBooking' . ucfirst($this->_aRequest['type'])), array($this->_aRequest['bookingIndex'], (bool) $this->_aRequest['checked']));
    }
}
