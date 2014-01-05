<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailremove
 *
 * @author John Jansson
 */
class Command_mailremove extends Command {
    /**
     * 
     */
    protected function _executeCommand()
    {
        getMailReceiverAccessor()->getById($this->_aRequest['readid'])->setHidden(TRUE);
    }
}

?>
