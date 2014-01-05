<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removeregisterdocument
 *
 * @author John Jansson
 */
class Command_removeregisterdocument extends Command
{
    protected function _executeCommand() {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setBrfId(getBrf()->getId());
        $oDocumentSelector->setFilename($this->_aRequest['documentname']);
        $oDocuments = getDocumentAccessor()->read($oDocumentSelector);
        if ($oDocuments->valid()) {
            $oDocument = SvenskBRF_Document::load($oDocuments->current());
            $oDocument->delete();
        }
    }
}

?>
