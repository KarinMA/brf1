<?php
include 'setup.php';
$sDestination = TMP_DIR . $_REQUEST['brf1'] . '_' .  $_REQUEST['brf1'];
if (move_uploaded_file($_FILES['file']['tmp_name'], $sDestination)) {
    $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); 
    echo "<script>document.domain='$sDomain';</script>".$_FILES['file']['type'];
}
include 'unsetup.php';
