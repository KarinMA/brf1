<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of downloadresourcedocument
 *
 * @author John Jansson
 */
class Command_downloadresourcedocument extends Command_download
{
    
    /**
     *
     * @var string
     */
    private $_sResourceName = NULL;
    
    /**
     *
     * @var SvenskBRF_Brf 
     */
    private $_oBrf;
    
    function __construct($a_aRequest = array()) {
        parent::__construct($a_aRequest);
        // see if it's a template
        $this->_sResourceName = $this->_aRequest['documentName'];
        $this->_oBrf = SvenskBRF_Brf::loadById($this->_aRequest['brfId']);
    }
        
    protected function _getFilePath()
    {
        return SvenskBRF_Document::FILE_BASE_PATH . $this->_oBrf->getUrl() . '/documents/lokaler/' . $this->_sResourceName . '.pdf';
    }
    
    public function getDownloadDataType()
    {
        return 'pdf';
    }
    
    public function getFilename() 
    {
        return "$this->_sResourceName.pdf";
    }

}

?>
