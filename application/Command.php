<?php

/**
 * API commands.
 *  
 */
abstract class Command
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const PERSONAL_NUMBER = 'pnr';
    
    /**
     *
     * @var type 
     */
    protected $_aRequest;
    
    protected function __construct(array $a_aRequest = array()) 
    {
        $this->_aRequest = $a_aRequest;
    }
    
    private $_sErrorMessage = "";


    /**
     *
     * @param type $a_sCommandName 
     * @return Command
     */
    public final static function createCommand($a_sCommandName, $a_aRequest = NULL)
    {
        $sCommandClass = "Command_$a_sCommandName";
        $oCommand = FALSE;
        if (file_exists('./../application/Command/' . $a_sCommandName . '.php')) {
            $aRequest = $a_aRequest ? $a_aRequest : $_REQUEST;
            $oCommand = new $sCommandClass($aRequest);
        }
        if (!$oCommand) {
            $oCommand = new Command_nocommand(array());
        }
        return $oCommand;
    }
    
    public final function getError()
    {
        return (string) $this->_sErrorMessage;
    }
    
    protected function _setError($a_sMessage, $a_iCode = 0)
    {
        $this->_sErrorMessage = "$a_iCode: $a_sMessage";
    }


    /**
     *
     * @return boolean 
     */
    function execute(&$a_r_aResultData)
    {
        try {
            $a_r_aResultData = $this->_executeCommand();
            return TRUE;
        } catch (CommandException $oException) {
            // log?
            $a_r_aResultData = array('message' => $oException->getMessage());
            return FALSE;
        }
    }
    
    protected abstract function _executeCommand();
    
    function isDownload()
    {
        return FALSE;
    }

}

?>
