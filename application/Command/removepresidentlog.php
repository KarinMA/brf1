<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removepresidentlog
 *
 * @author John Jansson
 */
class Command_removepresidentlog extends Command {
    protected function _executeCommand() {
        SvenskBRF_PresidentLog::deleteLog(getBrf(), $this->_aRequest['logId']);
    }
}

?>
