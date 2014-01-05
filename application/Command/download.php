<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of download
 *
 * @author John Jansson
 */
abstract class Command_download extends Command {
    function isDownload()
    {
        return TRUE;
    }
    
    protected function _executeCommand() {
        return array('file_found' => file_exists($this->_getFilePath()));
    }
    
    function getFileData()
    {
        $sFilePath = $this->_getFilePath();
        return file_get_contents($sFilePath);
    }
    
    public function isView()
    {
        return FALSE;
    }
    
    protected abstract function _getFilePath();
    public abstract function getDownloadDataType();
    public abstract function getFilename();
}

?>
