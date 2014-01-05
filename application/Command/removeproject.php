<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removeproject
 *
 * @author John Jansson
 */
class Command_removeproject extends Command{
    protected function _executeCommand() {
        SvenskBRF_PresidentLog::removeProject(getBrf(), $_POST['projectid']);
    }
}

?>
