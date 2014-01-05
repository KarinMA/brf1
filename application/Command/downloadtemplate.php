<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of downloadtemplate
 *
 * @author John Jansson
 */
class Command_downloadtemplate extends Command_download {
    
    /**
     *
     * @var string
     */
    private $_sTemplateName = NULL;
    
    function __construct($a_aRequest = array()) {
        parent::__construct($a_aRequest);
        // see if it's a template
        if (in_array(@$this->_aRequest['documentName'], SvenskBRF_Document::getTemplateNames())) {
            $this->_sTemplateName = $this->_aRequest['documentName'];
        } else {
            throw new CommandException("Template couldn't be loaded. Request was: " . serialize($this->_aRequest));
        }
    }
        
    protected function _getFilePath()
    {
        return "./../files/templates/".$this->_sTemplateName;
    }
    
    public function getDownloadDataType()
    {
        return 'pdf';
    }
    
    public function getFilename() 
    {
        return ucfirst(str_replace("template_", "", $this->_sTemplateName));
    }
}

?>
