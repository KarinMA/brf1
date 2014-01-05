<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of archiveproject
 *
 * @author John Jansson
 */
class Command_archiveproject extends Command
{
    protected function _executeCommand() {
        $oProject = getPresidentLogCategoryAccessor()->getById($this->_aRequest['projectid']);
        $oProject->setArchive(TRUE);
    }
}

?>
