<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadmail
 *
 * @author John Jansson
 */
class Command_loadmail extends Command {
    protected function _executeCommand()
    {
        $oMail = getBrfMailAccessor()->getById($this->_aRequest['id']);
        return array('mailcontent' => nl2br(str_replace("'", "&#39;", $oMail->getMessage())));
    }
}

?>
