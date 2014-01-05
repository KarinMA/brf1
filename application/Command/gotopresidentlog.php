<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gotopresidentlog
 *
 * @author John Jansson
 */
class Command_gotopresidentlog extends Command
{
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $_SESSION[CURRENT_PRESIDENT_LOG] = $this->_aRequest['presidentLog'];
    }
}

?>
