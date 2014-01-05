<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Web
 *
 * @author John Jansson
 */
class SvenskBRF_Web extends SvenskBRF_Main {
    
    const SITE_SETTING_ID_3_MONTH = 5;
    const SITE_SETTING_ID_1_YEAR = 6;
    const SITE_SETTING_ID_2_YEAR = 7;
    const SITE_SETTING_ID_3_YEAR = 8;
    const SITE_SETTING_ID_5_YEAR = 9;
    const SITE_SETTING_ID_3_MONTH_BANK = 10;
    const SITE_SETTING_ID_1_YEAR_BANK = 11;
    const SITE_SETTING_ID_2_YEAR_BANK = 12;
    const SITE_SETTING_ID_3_YEAR_BANK = 13;
    const SITE_SETTING_ID_5_YEAR_BANK = 14;
    
    public static function startActivation(array $a_aActivateData)
    {
        $oBrfs = self::$_oBrfAccessor->getBrfsByUrl($a_aActivateData['url']);
        if ($oBrfs->size() == 1) {
            $oBrf = $oBrfs->current();
            // create webform entry
            $oWebForm = WebformActivation::create($oBrf->getId(), $a_aActivateData['name'], $a_aActivateData['email'], $a_aActivateData['phone'], $a_aActivateData['role'], date('Y-m-d H:i:is'), TRUE);
            $oWebForm->setBrf($oBrf);
            SvenskBRF_Notice::sendActivateResponse($oWebForm);
        }
    }
    
    public static function getSiteSettingValue($a_iSettingTypeId)
    {
        self::$_oSiteSettingSelector->setSettingTypeId($a_iSettingTypeId);
        self::$_oSiteSettingSelector->setOrderBy('setting_time DESC');
        self::$_oSiteSettingSelector->limit(1);
        $oSiteSetting = self::$_oSiteSettingAccessor->readOne(self::$_oSiteSettingSelector);
        return $oSiteSetting ? $oSiteSetting->getValue() : NULL;
    }
    
    /**
     *
     * @param type $a_sFromName
     * @param type $a_sToEmail
     * @param type $a_sMessage 
     * @return void
     */
    public static function sendTipMail($a_sFromName, $a_sToEmail, $a_sMessage = '')
    {
        SvenskBRF_Notice::sendTipMail($a_sFromName, $a_sToEmail, $a_sMessage);
    }
}

?>
