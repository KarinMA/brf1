<?php

include 'setup.php';
$oDOMXml = new DOMDocument;
$sStartPage  = file_get_contents("http://www.di.se/amnen/sa-dyr-ar-borantan/");
libxml_use_internal_errors(TRUE);
$oDOMXml->loadHTML($sStartPage);
$oDOMXPath = new DOMXPath($oDOMXml);
$aRates = array();
foreach ($oDOMXPath->query("//div[@class='widgetContent']/ul/li") as $oRate) {
    $aRates[$oDOMXPath->query("div/b", $oRate)->item(0)->nodeValue] = array(
        $oDOMXPath->query("div[2]", $oRate)->item(0)->nodeValue,
    );
}

foreach ($aRates as $sInterval => $aRate) {
    if (preg_match("/([0-9.]+) \%/", $aRate[0], $aMatches)) {
        $sBank = str_replace($aMatches[0], "", $aRate[0]);
        $fRate = (float) $aMatches[1];
        $oSettingTypes = getSettingTypeAccessor()->getSettingTypesBySettingTypeName($sInterval);
        $oSettingTypesBank = getSettingTypeAccessor()->getSettingTypesBySettingTypeKey($oSettingTypes->current()->getSettingTypeKey().'_bank');
        if ($sBank && $fRate && $oSettingTypes->size() == 1 && $oSettingTypesBank->size() == 1) {
            // the rate
            if ($fRate != SvenskBRF_Web::getSiteSettingValue($oSettingTypes->current()->getId())) {
                SiteSetting::create($oSettingTypes->current()->getId(), $fRate, date('Y-m-d H:i:s'));
            }
            if ($sBank != SvenskBRF_Web::getSiteSettingValue($oSettingTypesBank->current()->getId())) {
                SiteSetting::create($oSettingTypesBank->current()->getId(), $sBank, date('Y-m-d H:i:s'));
            }
        }
    }
}
include 'unsetup.php';
?>
