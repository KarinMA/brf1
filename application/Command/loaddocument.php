<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loaddocument
 *
 * @author John Jansson
 */
class Command_loaddocument extends Command {
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $oDocument = SvenskBRF_Document::loadById($this->_aRequest['documentId']);
        $aData =  array(
            'name' => $oDocument->getFilename($oDocument->getIsBoard()),
            'pub' => $oDocument->getIsPublic(),
            'category' => $oDocument->getDocumentType()->getDirectoryName(),
            'hasYear' => $oDocument->getDocumentType()->getHasYear(),
            'year' => (string) $oDocument->getYear(),
        );
        
        if ($oDocument->getIsBoard()) {
            $aData['documentArchiveType'] = substr($oDocument->getFilename(), 0, strpos($oDocument->getFilename(), '_') - 1);
        }
        
        return $aData;
    }
}

?>
