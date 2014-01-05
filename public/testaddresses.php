<?php
include 'setup.php';

$rResult = mysql_query("SELECT id from brf where address not like 'box %'");
$iCounter = 0;
$iEdited = 0;
while (($aRow = mysql_fetch_assoc($rResult))) {
    
    if (TRUE) {
        $iId = $aRow['id'];
        $oBrf = SvenskBRF_Brf::loadById($iId);
        $sBaseURL = "http://public.api.hitta.se/search/v5/address/";
        $bChar = FALSE;
        $sStreetNumber = $oBrf->getStreetNumber();
        if ($sStreetNumber) {
            if (strlen(preg_replace("/[0-9]/", "", $sStreetNumber)) > 0) {
                $bChar = TRUE;
            }
        }
        $sAddress = getNormalizedAddress($oBrf);
        $oResult = @json_decode(file_get_contents($sBaseURL . $sAddress));
        if ($sStreetNumber && (!$oResult || !$oResult->result->location->address->coordinate->north || !$oResult->result->location->address->coordinate->east) && !$bChar) {
            $oBrf->setStreetNumber($sStreetNumber . 'A');
            $sAddress = getNormalizedAddress($oBrf);
            $oResult = @json_decode(file_get_contents($sBaseURL . $sAddress));
            if (!$oResult || !$oResult->result->location->address->coordinate->north || !$oResult->result->location->address->coordinate->east) {
                $oBrf->setStreetNumber($sStreetNumber);
                echo $oBrf->getGovernmentNumber() . ',' . BASE_DIR . $oBrf->getUrl() . ',' . "http://www.svenskbrf.se/" . $oBrf->getUrl() . '<br />';
                
            } else {
               $iEdited++;
            }
        }
    }
    
    $iCounter++;
    flush();
    if ($iCounter == 1000) {
        break;
    }
}




include 'unsetup.php';