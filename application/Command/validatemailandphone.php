<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validatemailandphone
 *
 * @author John Jansson
 */
class Command_validatemailandphone extends Command
{
    /**
     * @return array
     */
    protected function _executeCommand()
    {
        $aMessages = array();
        $oEmailValidation = new Zend_Validate_EmailAddress();
        if (!$oEmailValidation->isValid($this->_aRequest['Email'])) {
            if (@$this->_aRequest['doubleEmail']) {
                $aMessages[] = array('Email', 0);
            } else {
                $aMessages[] = 'Email';
            }
        }
        $sPhone = preg_replace("/[^0-9]/", "", $this->_aRequest['Phone']);
        if (!preg_match("/^07[0-9]{8}$/", $sPhone)) {
            if (@$this->_aRequest['doublePhone']) {
                $aMessages[] = array('Phone', 0);
            } else {
                $aMessages[] = 'Phone';
            }
        }
        return array('error' => (bool) !count($aMessages), 'message' => $aMessages);
    }
}

?>
