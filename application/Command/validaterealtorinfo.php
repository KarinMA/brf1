<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validaterealtorinfo
 *
 * @author John Jansson
 */
class Command_validaterealtorinfo extends Command {
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $aErrors = array();
        
        // TV-check
        if (
                array_key_exists('phone_tv_internet', $this->_aRequest)
                
                &&
                
                array_key_exists('kabeltv', $this->_aRequest['phone_tv_internet']) && array_key_exists('kabeltvdebitering', $this->_aRequest['phone_tv_internet']) && array_key_exists('tvgrundutbud', $this->_aRequest['phone_tv_internet'])
                
                &&
                
                $this->_aRequest['phone_tv_internet']['kabeltv']['value'] == "-1"
                
                && 
                
                $this->_aRequest['phone_tv_internet']['kabeltvdebitering']['value'] == "0"
                
                && 
                
                $this->_aRequest['phone_tv_internet']['tvgrundutbud']['value'] == "0"
                
                && 
                
                !array_key_exists('kabeltv', $aErrors)
        ) 
        {
            $aErrors[] = 'kabeltv';
        }
         // broadband-check
        if (
                array_key_exists('telefontvinternet', $this->_aRequest)
                
                &&
                
                array_key_exists('bredband', $this->_aRequest['telefontvinternet']) 
                
                &&
                
                $this->_aRequest['telefontvinternet']['bredband']['value'] == "-1"
                
                && 
                
                !array_key_exists('bredband', $aErrors)
        ) 
        {
            $aErrors[] = 'bredband';
        }
        
        foreach (SvenskBRF_RealtorInformation::getCategoryKeys() as $sCategoryKey) {
            if (array_key_exists($sCategoryKey, $this->_aRequest)) {
                foreach ($this->_aRequest[$sCategoryKey] as $sTypeKey => $aTypeKeyData) {
                    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sTypeKey);
                    if ($oInfoType->getRequired() && (!array_key_exists('value', $aTypeKeyData) || $aTypeKeyData['value'] === '')) {
                        // no value at all
                        $aErrors[] = $sTypeKey;
                    } elseif (FALSE && ($oInfoType->getRequired() && @!$aTypeKeyData['comment'] && ( ($oInfoType->getCommentRequiredYes() && $aTypeKeyData['value'] === '1') || ($aTypeKeyData['value'] === '0' && $oInfoType->getCommentRequiredNo())) )) {
                        // make this one valid for now
                        $aErrors[] = $sTypeKey;
                    } else if (array_key_exists('value', $aTypeKeyData) && $aTypeKeyData['value'] !== '' && !in_array($sTypeKey, $aErrors)) {
                        // save anyway
                        SvenskBRF_RealtorInformation::save(getBrf(), $oInfoType, $aTypeKeyData['value'], @$aTypeKeyData['comment'] ? $aTypeKeyData['comment'] : NULL);
                        if ($sTypeKey === 'byggar') {
                            $sYearValue = preg_replace("/[^0-9]/", "", $aTypeKeyData['value']);
                            if (preg_match("/[12][8901][0-9]{2}/", $sYearValue)) {
                                getBrf()->setBuildYear((int) $sYearValue);
                            }
                        }
                    }
                }
            }
        }
        
        
        
        return array('isValid' => !count($aErrors), 'errors' => $aErrors);
    }
}

?>
