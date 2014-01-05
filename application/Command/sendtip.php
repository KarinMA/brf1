<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Command_sendtip
 *
 * @author John Jansson
 */
class Command_sendtip extends Command {
    /**
     * 
     */
    protected function _executeCommand() 
    {
        SvenskBRF_Web::sendTipMail($this->_aRequest['from'], $this->_aRequest['to'], $this->_aRequest['message']);
    }
}

?>
