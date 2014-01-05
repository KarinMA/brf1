<?php

/**
 * 
 */
class Helper {

    /**
     * Storage for manager objects.
     *
     * @var array
     */
    private static $_aStoredObjects = array();

    /**
     * 
     * @var Manager_OrderManager
     */
    private static $_oOrderManager;

    /**
     * 
     * @var Manager_TemplateManager
     */
    private static $_oTemplateManager;

    /**
     * 
     * @var Manager_CatalogManager
     */
    private static $_oCatalogManager;

  

    /**
     * Get a manager by it's table name.
     * 
     * @param string $a_sManager
     * @return ManagerAbstract
     */
    public static function getManager($a_sManager) {
        $sClassNamePrefix = preg_replace("/_([a-z])/e", 'strtoupper("\\1")', $a_sManager);
        $sClassName = $sClassNamePrefix . 'Manager';

        if (!array_key_exists($sClassNamePrefix, self::$_aStoredObjects)) {
            $sMapperFactoryName = "MappingFactory_{$sClassNamePrefix}MappingFactory";
            self::$_aStoredObjects[$sClassNamePrefix] = new $sClassName(new $sMapperFactoryName());
        }

        return self::$_aStoredObjects[$sClassNamePrefix];
    }

    /**
     * Implemented this way to help with code completion.
     * 
     * @param unknown_type $a_sManager
     * @return unknown_type
     */
    static function getManager123($a_sManager) {
        
    }

    static function getDefaultStatus() {
        return 'CLOSED';
    }

    static function isPostRequest() {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'post';
    }

    /**
     * Helper function generate links in the layout.
     * 
     * @param string $sLeftLink
     * @param string $sRightLink
     * @return string 
     */
    static function prepareLink($sLeftLink, $sRightLinkStatus) {
        return 'layout.php?l=' . $sLeftLink . '&s=' . $sRightLinkStatus;
    }

    static function getParameter($a_sParameterName, $a_sDefaultValue = '', $a_sIndex = null, $a_sIndex2 = null) {
        if ($a_sIndex !== null) {
            if
            (
                    array_key_exists($a_sParameterName, $_REQUEST) &&
                    is_array($_REQUEST[$a_sParameterName]) &&
                    array_key_exists($a_sIndex, $_REQUEST[$a_sParameterName]) &&
                    $_REQUEST[$a_sParameterName][$a_sIndex] !== ''
            ) {

                if
                (
                        $a_sIndex2 !== null &&
                        is_array($_REQUEST[$a_sParameterName][$a_sIndex]) &&
                        array_key_exists($a_sIndex2, $_REQUEST[$a_sParameterName][$a_sIndex]) &&
                        $_REQUEST[$a_sParameterName][$a_sIndex][$a_sIndex2] !== ''
                ) {
                    return $_REQUEST[$a_sParameterName][$a_sIndex][$a_sIndex2];
                } else if ($a_sIndex2 !== null) {
                    return $a_sDefaultValue;
                }

                return $_REQUEST[$a_sParameterName][$a_sIndex];
            } else {
                return $a_sDefaultValue;
            }
        } else {
            return array_key_exists($a_sParameterName, $_REQUEST) && $_REQUEST[$a_sParameterName] !== '' ? $_REQUEST[$a_sParameterName] : $a_sDefaultValue;
        }
    }

    public static function getStateGraph() {
        return StateGraph::getInstance();
    }

    static function getDefaultStatusId() {
        return 1;
    }

    static function isAdmin() {
        if (isset($_SESSION['admin'])) {
            return (boolean) $_SESSION['admin'];
        } else {
            return false;
        }
    }

    /**
     * 
     * @return MessageQueue
     */
    static function getMessageQueue() {
        return MessageQueue::getInstance();
    }

    /**
     * Log user actions to textfile
     * 
     * @param $msg
     */
    static function addUserLog($msg, $log_path) {
        // open file
        $fd = fopen($log_path . "log/USR_" . date("Ymd") . ".txt", "a");

        if (isset($_SESSION["user"])) {
            $usr = $_SESSION["user"];
        } else {
            $usr = $_SERVER["REMOTE_ADDR"];
        }

        // append date/time to message
        $str = "[" . date("Y-m-d h:i:s", time()) . "] " . $usr . ": " . $msg;

        // write string
        fwrite($fd, $str . "\r\n");

        // close file
        fclose($fd);
    }

    /**
     * Log sql querys to textfile
     * 
     * @param $msg
     */
    static function addSQLLog($msg, $log_path) {

        // open file
        $logFile = $log_path . "log/SQL_" . date("Ymd") . ".txt";
        if (!file_exists($logFile)) {
            touch($logFile);
        }
        $fd = fopen($logFile, "a");


        if (isset($_SESSION["user"])) {
            $usr = $_SESSION["user"];
        } else {
            $usr = $_SERVER["REMOTE_ADDR"];
        }

        // append date/time to message
        $str = "[" . date("Y-m-d h:i:s", time()) . "] " . $usr . ": " . $msg;

        // write string
        fwrite($fd, $str . "\r\n");

        // close file
        fclose($fd);
    }

    /**
     * Substring from left
     *
     * @param $s1 string
     * @param $s2 string
     * @return string
     */
    static private function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }

    /**
     * Get url
     *
     * @return string
     */
    static function getUrl() {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = self::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
    }

    /**
     * Get carriage return line feed
     *
     * @return string
     */
    static function crlf() {
        return chr(13) . chr(10);
    }

    /**
     * Set custom error handler
     */
    static function errorHandler($errno = '', $errstr = '', $errfile = '', $errline = '', $errcontext = '') {
        // Send email with error, except notices (8)
        /* if ($errno != 8) {
          $message = "Errno: " . $errno . self::crlf();
          $message .= "Errstr: " . $errstr . self::crlf();
          $message .= "Errfile: " . $errfile . self::crlf();
          $message .= "Errline: " . $errline . self::crlf();
          $message .= "URL: " . self::getUrl() . self::crlf();
          $message .= "IP: " . $_SERVER["REMOTE_ADDR"] . self::crlf();
          mail("samuel@improove.se", "PHP Error! ", $message, "From: samuel@improove.se");
          } */
    }

    /**
     * Generate a hashcode property for an order.
     * 
     * This property is used so that a customer can be identified by using a generated link.
     *
     * @param Order $a_oOrder 
     * @return string
     */
    static function getHashcode(Order $a_oOrder) {
        return sha1($a_oOrder->getFirstname() . HASH_SECRET . $a_oOrder->getLastname());
    }

}

//set_error_handler(array("Helper", "errorHandler"), E_ALL);