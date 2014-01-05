<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validaterealtorad
 *
 * @author John Jansson
 */
class Command_validaterealtorad extends Command 
{
    /**
     * 
     */
    protected function _executeCommand() 
    {
        // form data
        $aRequest = $this->_aRequest['adForm'];
        
        // vallid fields...
        $adForm =& $aRequest;
        $aRequiredFields = explode(",", $this->_aRequest['required']);
        $aErrors = array();
        foreach ($aRequiredFields as $sFieldName) {
            if ('' === eval(($sEval = "return $".str_replace(array('[',']'), array("['", "']"), $sFieldName)).";")) {
                $aErrors[] = $sFieldName;
            } else {
                
            }
        }
        
        return array(
            'valid' => !count($aErrors),
            'errors' => $aErrors,
        );
    }
}

?>
