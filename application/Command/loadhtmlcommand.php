<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadcommand
 *
 * @author John Jansson
 */
abstract class Command_loadhtmlcommand extends Command 
{
    /**
     * 
     */
    protected function _executeCommand()
    {
        ob_start();
        include './' . $this->_getFile();
        $sOutput = ob_get_clean();
        return array(
            'html' => $sOutput
        ) + $this->_getOtherParameters();
    }
    
    protected abstract function _getFile();
    
    /**
     * 
     * @return arrays
     */
    protected function _getOtherParameters()
    {
        return array();
    }
}

?>
