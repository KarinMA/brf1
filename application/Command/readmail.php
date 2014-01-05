<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of readmail
 *
 * @author John Jansson
 */
class Command_readmail extends Command {
    protected function _executeCommand() {
        getUser()->readMail($this->_aRequest['readid']);
        return 1;
    }
}

?>
