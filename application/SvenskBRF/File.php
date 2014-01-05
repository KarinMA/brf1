<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File
 *
 * @author John Jansson
 */
abstract class SvenskBRF_File extends SvenskBRF_Main 
{
    /**
     *
     * @var string 
     */
    const FILE_BASE_PATH = './../files/brfs/';
    
    public abstract function getFilePath();
}

?>
