<?php

/**
 * An exception that contains error code and error message.
 * 
 * @author John
 */
class Messaging_SendException extends Exception {

    /**
     * The error message
     * 
     * @var string
     */
    private $_iErrorCode;

    /**
     * The error code
     * 
     * @var int
     */
    private $_sErrorMessage;
    
    function __construct($a_sErrorMessage = NULL, $a_iErrorCode = NULL) {
        parent::__construct("Failed with error_message '{$a_sErrorMessage}.", $a_iErrorCode);
        $this->_sErrorMessage = $a_sErrorMessage;
        $this->_iErrorCode = $a_iErrorCode;
    }
    

    function getErrorMessage() {
        return $this->_sErrorMessage === '' ? NULL : $this->_sErrorMessage;
    }

    function getErrorCode() {
        return $this->_iErrorCode === '' ? NULL : $this->_iErrorCode;
    }
}
