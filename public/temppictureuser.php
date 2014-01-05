<?php
include 'setup.php';
$sDestination = TMP_DIR . $_REQUEST['userid'] . '_' .  $_REQUEST['number'];
if (move_uploaded_file($_FILES['Picture']['tmp_name'], $sDestination)) {
    $sDomain = str_replace(array("https://","http://"),array('',''),BASE_DIR); $sDomain = substr($sDomain, 0, strlen($sDomain) - 1); 
    echo "<script>document.domain='$sDomain';</script>". $_FILES['Picture']['type'];
}
include 'unsetup.php';
