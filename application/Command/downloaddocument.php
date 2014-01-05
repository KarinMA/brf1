<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of downloaddocument
 *
 * @author John Jansson
 */
class Command_downloaddocument extends Command_download {
    /**
     *
     * @var SvenskBRF_Document
     */
    private $_oDocument;
    
    function __construct($a_aRequest = array()) {
        parent::__construct($a_aRequest);
        $oDocument = getDocumentAccessor()->getById(@$this->_aRequest['id']);
        if (!$oDocument) {
            $oDocumentSelector = getDocumentSelector();
            $oDocumentSelector->setBrfId(@$this->_aRequest['brfId']);
            $oDocumentSelector->setFilename(@$this->_aRequest['documentName']);
            $oDocuments = getDocumentAccessor()->read($oDocumentSelector);
            if ($oDocuments->size()) {
                $oDocument = $oDocuments->current();
            }
        }
        if ($oDocument) {
            $this->_oDocument = SvenskBRF_Document::load($oDocument);
        } else {
            throw new CommandException("Document couldn't be loaded. Request was: " . serialize($this->_aRequest));
        }
    }
        
    protected function _getFilePath()
    {
        return $this->_oDocument->getFilePath();
    }
    
    public function getDownloadDataType()
    {
        $sDownloadDataType = $this->_getContentType($this->_oDocument->getFileType());
        return $sDownloadDataType;
    }
    
    public function getFilename() 
    {
        $sFileName = $this->_oDocument->getFilename() . '.' . $this->_oDocument->getFileType();
        if ($this->_oDocument->getDocumentType()->getIsArchive()) {
            $sFileName = substr($sFileName, strpos($sFileName, "_") + 2);
        }
        return $sFileName;
    }
    
    private function _getContentType($a_sFileType)
    {
        $aContentTypes = array(
            'pdf' => 'pdf', // pdf
            'xls' => 'vnd.ms-excel', // excel 203
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // excel 2007+
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // word 2007+
            'doc'  => 'application/msword' // word 2003'
        );
        return $aContentTypes[$a_sFileType];
    }
    
    
}

?>
