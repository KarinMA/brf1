<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailreply
 *
 * @author John Jansson
 */
class Command_mailreply extends Command_readmail {
    protected function _executeCommand() {
        // mail will be marked as read
        parent::_executeCommand();
    }
}

?>
