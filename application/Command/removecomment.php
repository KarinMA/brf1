<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removecomment
 *
 * @author John Jansson
 */
class Command_removecomment extends Command {
    protected function _executeCommand() {
        getPresidentLogCommentAccessor()->getById($this->_aRequest['commentId'])->delete();
    }
}

?>
