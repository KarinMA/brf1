<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    mysql_query("START TRANSACTION", $GLOBALS['rDatabaseConnection']);
    mysql_query("BEGIN", $GLOBALS['rDatabaseConnection']);
    DomainWatcher::performOperations();
    mysql_query("COMMIT", $GLOBALS['rDatabaseConnection']);
    close_connection($GLOBALS['rDatabaseConnection']);
} catch (DomainObjectException $oDomainObjectException) {
    mysql_query("ROLLBACK", $GLOBALS['rDatabaseConnection']);
    close_connection($GLOBALS['rDatabaseConnection']);
    throw $oDomainObjectException;
    // do logging?
}




?>
