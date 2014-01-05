<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadpublicmiddlesection
 *
 * @author John Jansson
 */
class Command_loadpublicmiddlesection extends Command_loadhtmlcommand 
{
    protected function _getFile()
    {
        define('LOAD_URL', $this->_aRequest['url']);
        return 'brf_public_maklare_di.php';
    }
}

?>
