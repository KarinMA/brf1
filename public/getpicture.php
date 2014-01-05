<?php
include 'setup.php';
$oPicture = SvenskBRF_BrfPicture::loadById($_REQUEST['id']);
$sPictureType = $oPicture->getImageType();
if ($sPictureType === 'jpg') {
    $sPictureType = 'jpeg';
}
header("Content-Type: image/$sPictureType");
$rIM = call_user_func_array("imagecreatefrom$sPictureType", array($oPicture->getPicturePath()));
call_user_func_array("image$sPictureType", array($rIM));
imagedestroy($rIM);
include 'unsetup.php';
?>
