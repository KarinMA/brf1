<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of setusersetting
 *
 * @author John Jansson
 */
class Command_setusersetting extends Command
{
    /**
     * @return array
     */
    protected function _executeCommand() 
    {
        $oUser = getUser();
        if (!$oUser) {
            throw new CommandException('User not loaded...');
        }
        $oUser->saveSetting($this->_aRequest['settingType'], $this->_aRequest['value']);
    }
}

?>
