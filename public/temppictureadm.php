<?php
include 'setup.php';
$sDestination = TMP_DIR . $_REQUEST['brf11'] . '_' .  $_REQUEST['brf11'];
if (move_uploaded_file($_FILES['frontPicture']['tmp_name'][$_REQUEST['pictureIndex']], $sDestination)) {
    $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); 
    echo "<script>document.domain='$sDomain';</script>" . $_FILES['frontPicture']['type'][$_REQUEST['pictureIndex']];
} else {
    // ...
}
include 'unsetup.php';