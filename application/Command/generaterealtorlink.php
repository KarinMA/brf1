<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generaterealtorlink
 *
 * @author John Jansson
 */
class Command_generaterealtorlink extends Command {
    protected function _executeCommand() {
        $aBrfs = SvenskBRF_Brf::findBrfByName($this->_aRequest['brf']);
        if (count($aBrfs)) {
            // see if log already exists
            $oBrf = SvenskBRF_Brf::loadByUrl($aBrfs[0]['url']);
            return array('link' => 
                TEST ? 
                (BASE_DIR . 'registrera/' . getUser()->getBrfRegisterCode($oBrf)) :
                ('Funktionen är inte tillgänglig ännu.')
            );
        } else {
            throw new CommandException('BRF not found');
        }
    }
}

?>
