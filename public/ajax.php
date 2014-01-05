<?php
@session_start();
include 'setup.php';
$sAction = @$_REQUEST['action'];
$oCommand = Command::createCommand($sAction);
if (!$oCommand->isDownload()) {
    $aResult = array();
    echo json_encode(array('result' => $oCommand->execute($aResult), 'data' => $aResult));
} else {
    if (!$oCommand->isView()) {
        header(utf8_decode('Content-Disposition: attachment; filename="'.$oCommand->getFilename().'"'));  
    } else {
        header(utf8_decode('Content-Disposition: inline; filename="'.$oCommand->getFilename().'"'));  
    }
    $sTypeHeader = "Content-Type: application/" . $oCommand->getDownloadDataType();
    header($sTypeHeader);  
    $sData = $oCommand->getFileData();
    //header('Content-Length: ' . strlen($sData));
    print $sData;
}
include 'unsetup.php';
?>
