<?php
@session_start();
include_once './../include/functions.php';
// include accessor getters and selector getters
include_once './../include/accessor_getters.php';
include_once './../include/selector_getters.php';

//define('BASE_DIR', 'http://109.74.7.190/b/');
define('BASE_DIR', 'http://localhost/b/');
//define('BASE_DIR', "http://www.svenskbrf.se/");
//define('TEST', 1);
define('TEST', 1);
define('TMP_DIR', '/tmp/');
//define('TMP_DIR', './../tmp/');

/**
 * This is a front controller script.
 * 
 * - Define autoload script
 * - Set up database connection
 * - Initialize libraries and helpers
 * - Direct to view script
 * - Define constants
 */

/**
 * Look for classes in application and library directories
 * 
 * @param string $a_sClassName
 * @return void
 */
function __autoload($a_sClassName)
{
    // the paths
    $aDirs = array(
            './../application/', 
            './../application/Domain/', 
            './../application/Infrastructure/',
            './../application/SvenskBRF/',
            './../application/Command/',
            './../include/fpdf/',
            './../include/fpdi/',
            './../include/',
            './../include/Mail/',
            './../libraries/',
    );

    // set class paths
    $sPath = '';
    foreach ($aDirs as $sClassPath) {
        $sCompletePath = './' . $sClassPath;
        $sPath .= PATH_SEPARATOR . $sCompletePath;
    }
    set_include_path(get_include_path() . $sPath);
	
    
	// use the application directory classpath
    $sPath = str_replace('_', '/', $a_sClassName);
    $sFileName = $sPath . '.php';
    
    
    
    for ($iIndex = 0; $iIndex < count($aDirs); $iIndex++) {
        //var_dump($sFileName);
        if (file_exists($aDirs[$iIndex] . $sFileName)) {
            require_once($sFileName);
            return;	
        } elseif (file_exists(($sFileName = $aDirs[$iIndex] . strtoupper($sPath) . ".php"))) {
            require_once($sFileName);
            return;	
        } elseif (file_exists(($sFileName = $aDirs[$iIndex] . strtolower($sPath) . ".php"))) {
            require_once($sFileName);
            return;	
        }
        $sFileName = $sPath . ".php";
    }
    
    // no class found!
    throw new Exception("Class $a_sClassName not found.");
}


/**
 * Get the database connection.
 * 
 * @return resource
 */
function get_connection()
{
    $connection = mysql_connect("localhost", "root", "root");
    //$connection = mysql_connect("mysql443.loopia.se", "svbrfdb@s88387", "urby3twx");
    mysql_select_db("svenskbrf");
    //mysql_select_db("svenskbrf_se");
    return $connection;
}

/**
 * Close the database connection.
 *
 * @param resource $a_rDatabaseConnection
 */
function close_connection($a_rDatabaseConnection)
{
    mysql_close($a_rDatabaseConnection);
}

$rDatabaseConnection = get_connection();

Accessor::setDatabaseConnection($rDatabaseConnection);

//
SvenskBRF_Main::init();