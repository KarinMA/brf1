<?php
/**
 * Description of archivedocument
 *
 * @author John Jansson
 */
class Command_archivedocument extends Command
{
    /**
     * 
     * @return void
     */
    protected function _executeCommand() 
    {
        $oDocument = SvenskBRF_Document::loadById($this->_aRequest['docid']);
        $oDocument->archive();
    }
}

?>
