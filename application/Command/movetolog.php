<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of movetolog
 *
 * @author John Jansson
 */
class Command_movetolog extends Command {
    protected function _executeCommand() {
            $oCategory = getPresidentLogCategoryAccessor()->getById($this->_aRequest['projectid']);
            $oCategory->setArchive(FALSE);
    }
}

?>
