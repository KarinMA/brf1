<?php
$aReturn = array();
if (@$_REQUEST['term']) {
    include 'setup.php';
    $sTerm = $_REQUEST['term'];
    
    foreach (array('brf', 'bf', 'bostadsrättsföreningen', 'bostadsrättsförening', 'bostadsföreningen', 'bostadsförening') as $sReplaceString) {
        if (strlen($sTerm) > strlen($sReplaceString) + 1 && substr(strtolower($sTerm), 0, strlen($sReplaceString) + 1) == $sReplaceString . ' ') {
            $sTerm = substr($sTerm, strlen($sReplaceString) + 1);
        }
    }
    /*if (strlen($sTerm) > 4 && substr(strtolower($sTerm), 0, 4) == 'brf ') {
        $sTerm = substr($sTerm, 4);
    }
    if (strlen($sTerm) > 4 && substr(strtolower($sTerm), 0, 4) == 'brf ') {
        $sTerm = substr($sTerm, 4);
    }
    if (strlen($sTerm) > 21 && substr(strtolower($sTerm), 0, 21) == 'bostadsrättsförening ') {
        $sTerm = substr($sTerm, 21);
    }*/
    
    // OBS, redan aktiverade ska inte komma med om man skickar med aktiveringsparameter!
    
    $aReturn = SvenskBRF_Brf::findBrfByName($sTerm, @$_REQUEST['param']);
    include 'unsetup.php';
}
echo json_encode($aReturn);
?>
