<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 *
 * @author John Jansson
 */
class SvenskBRF_User_Realtor extends SvenskBRF_User
{
    /**
     * @param SvenskBRF_Brf $a_oBrf
     * @return SvenskBRF_Collection_BrfRealtorAd
     */
    public function getAdvertisements(SvenskBRF_Brf $a_oBrf = NULL) 
    {
        self::$_oBrfRealtorAdSelector->setRealtorUserId($this->_oUser->getId());
        self::$_oBrfRealtorAdSelector->setSold(FALSE);
        if ($a_oBrf) {
            self::$_oBrfRealtorAdSelector->setBrfId($a_oBrf->getId());
        }
        $oAds = self::$_oBrfRealtorAdAccessor->read(self::$_oBrfRealtorAdSelector);
        return new SvenskBRF_BrfRealtorAd_Collection($oAds);
    }
    
    public function getRealtorBrfs()
    {
        self::$_oBrfSelector->setOrderBy('name ASC');
        self::$_oBrfSelector->setRealtorUserId($this->_oUser->getId());
        $oBrfs = self::$_oBrfAccessor->read(self::$_oBrfSelector);
        $aBrfs = array();
        foreach ($oBrfs as $oBrf) {
            $aBrfs[] = SvenskBRF_Brf::load($oBrf);
        }
        return $aBrfs;
    }
    
    public function saveRealtorMessage(SvenskBRF_Brf $a_oBrf, $a_sHeader, $a_sMessage, $a_bSendAsMessage = FALSE)
    {
        BrfRealtorLog::create($a_oBrf->getId(), $this->_oUser->getId(), $a_sMessage, $a_sHeader, date('Y-m-d H:i:s'), TRUE);
        // execute sendmail command
        if ($a_bSendAsMessage) {
            $aRequest = array(
                'message' => $a_sMessage,
                'subject' => $a_sHeader,
                'receivers' => array(-1), // send to all
                '_brfId' => $a_oBrf->getId(),
            );
            $oCommand = Command::createCommand('sendmail', $aRequest);
            $oCommand->execute($aResultData);
        }
    }
    
    function getBrfRegisterCode(SvenskBRF_Brf $a_oBrf)
    {
        self::$_oBrfRealtorCodeSelector->setBrfId($a_oBrf->getId());
        self::$_oBrfRealtorCodeSelector->setRealtorUserId($this->_oUser->getId());
        $oBrfRealtorCode = self::$_oBrfRealtorCodeAccessor->readOne(self::$_oBrfRealtorCodeSelector);
        if ($oBrfRealtorCode) {
            return $oBrfRealtorCode->getRealtorCode();
        } else {
            // generate a new code
            $sCode = 'm' . self::generatePassword(6);
            while (self::$_oBrfRealtorCodeAccessor->getBrfRealtorCodesByRealtorCode($sCode)->size()) {
                $sCode = 'm' . self::generatePassword(6);
            }
            BrfRealtorCode::create($this->_oUser->getId(), $a_oBrf->getId(), $sCode, date('Y-m-d H:i:s'));
            return $sCode;
        }
    }
}

?>
