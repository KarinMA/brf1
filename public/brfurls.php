<?php
include 'setup.php';




/*$oBrf = SvenskBRF_Brf::loadByGovernmentNumber('')
$oBrf->setName('Bågen nr 223 i Stockholm');
$oBrf->setUrl('bagennr223istockholm');

$oBrf = SvenskBRF_Brf::loadById(128357);
$oBrf->setName('Rödklövern nr 7');
$oBrf->setUrl('rodklovernnr7');

$oBrf = SvenskBRF_Brf::loadById(128355);
$oBrf->setName('Modellsnickaren nr 1');
$oBrf->setUrl('modellsnickarennr1');*/

/*$oBrf = SvenskBRF_Brf::loadById(121215);
$oBrf->setName('Slånet');
$oBrf->setUrl('slanet');

$oBrf = SvenskBRF_Brf::loadById(123202);
$oBrf->setName('Beckasinen nr 7');
$oBrf->setUrl('beckasinennr7');
*/
/*
$aBrfs = array(
    'fullblodetbostadsrattsforening' => 'fullblodet',  
    'angantyrbostadsrattsforeningen' => 'angantyr',
    'riksbyggenbostadsrattsforeningfaltskarns' => 'faltskarns',
    'arkitektenbostadsrattsforeningen' => 'arkitekten',
    'bjornlundaparhusbostadsrattsforening' => 'bjornlundaparhus',
    'kalmarhusnr4riksbyggensbostadsrattsforening' => 'kalmarhusnr4',
    'kalmarhusnr6riksbyggensbostadsrattsforening' => 'kalmarhusnr6',
    'gokenbostadsrattsforeningen' => 'goken',
    'hastenbostadsrattsforeningen' => 'hasten',
    'cgbruniusbostadsrattsforening' => 'cgbrunius',
    'stclemensbostadsrattsforening' => 'stclemens',
    'pelikanen4bostadsrattsforening' => 'pelikanen4',
    'hjortennr3bostadsforening' => 'hjortennr3',
    'bokenbostadsrattsforeningen' => 'boken',
    'furanbostadsrattsforening' => 'furan',
    'engelbrekt11vasterasbostadsrattsforening' => 'engelbrkt11vasteras',
    'grandungenbostadsrattsforening' => 'grandungen',
    'gluntenbostadsrattsforening' => 'glunten',
    'forvaltarenbostadsrattsforeningen' => 'forvaltaren',
    'tullenbostadsrattsforening' => 'tullen',
    'bildhuggarenbostadsrattsforeningen' => 'bildhuggaren',
    'briggenbostadsrattsforeningen' => 'briggen',
    'kanalenbostadsrattsforening' => 'kanalen',
    'hildingbostadsrattsforening' => 'hilding',
);

foreach ($aBrfs as $sUrl => $sNewUrl) {
    $oOurBrf = SvenskBRF_Brf::loadByUrl($sUrl);
    $oBrf = SvenskBRF_Brf::loadByUrl($sNewUrl);
    if ($oBrf) {
        $sNewUrl .= '_' . strtolower(switchCharacters($oOurBrf->getPostalAddress()));
    }
    $sName = $oOurBrf->getName();
    $sName = str_replace(array(" Bostadsrättsföreningen", ' Bostadsrättsförening', ' bostadsrättsföreningen', ' bostadsrättsförening', ' Riksbyggens', '.'), array('', '', '', '', '', ''), $sName);
    $sName = str_replace(",", "", $sName);
    
    //$oOurBrf->setName($sName);
    $oOurBrf->setUrl($sNewUrl);
}*/

/*
$sQuery = "select id,url,name,postal_address from brf  where url like '%bostad%foren%'";
$rResult = mysql_query($sQuery, $rDatabaseConnection);
while (($aRow = mysql_fetch_assoc($rResult))) {
    $sUrl = str_replace(array('bostadsrattsforeningen', 'bostadsrattsforening'), array("", ""), $aRow['url']); 
    $sUrl .= '_' . strtolower(switchCharacters($aRow['postal_address']));
    $sName = str_replace(array(' Bostadsrättsförening', ' bostadsrättsförening', "-"), array("",  "", ""), $aRow['name']);
    $oBrf = SvenskBRF_Brf::loadByUrl($sUrl);
    if ($oBrf) {
        print_r($aRow);
    } else {
        if (substr($sUrl, strlen($sUrl) - 1) !== 's') {
            //echo $aRow['id'] . $sUrl.' ' . $sName . '<br />';
            
            /*$oBrf = SvenskBRF_Brf::loadById($aRow['id']);
            $oBrf->setUrl($sUrl);
            $oBrf->setName($sName);*/
  /*      }
   }
}*/

include 'unsetup.php';
?>
