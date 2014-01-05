<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removeregisterresource
 *
 * @author John Jansson
 */
class Command_removeregisteresource extends Command {
    protected function _executeCommand() {
        getResourceAccessor()->getById($this->_aRequest['resourceId'])->delete();
    }
}

?>
