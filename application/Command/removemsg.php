<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removemsg
 *
 * @author John Jansson
 */
class Command_removemsg extends Command {
    protected function _executeCommand() {
        getMessageAccessor()->getById($_REQUEST['id'])->delete();
    }
}

?>
