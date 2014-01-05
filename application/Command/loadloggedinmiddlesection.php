<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadloggedinmiddlesection
 *
 * @author John Jansson
 */
class Command_loadloggedinmiddlesection extends Command_loadhtmlcommand 
{
    protected function _getFile()
    {
        if (array_key_exists('ad', $this->_aRequest)) {
            define('SHOW_AD', $this->_aRequest['ad']);
            return 'brf_di_news.php';
        } else {
            define('LOAD_URL', $this->_aRequest['url']);
            return 'brf_loggedin_maklare_di.php';
        }
    }
}

?>
