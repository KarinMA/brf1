<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of activaterealtordisplay
 *
 * @author John Jansson
 */
class Command_activaterealtordisplay extends Command
{
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $sUrl = $this->_aRequest['url'];
        $oBrf = SvenskBRF_Brf::loadById($this->_aRequest['brfId']);
        $oBrfDisplay = SvenskBRF_Brf::loadByUrl($sUrl);
        $oBrfSetting = $oBrf->getBrfViewSetting($oBrfDisplay->getId());
        $iDisplay = $this->_aRequest['display'];
        if ($oBrfSetting && !$iDisplay) {
            $oBrfSetting->delete();
        } else if (!$oBrfSetting && $iDisplay) {
            BrfSetting::create($this->_aRequest['brfId'], SvenskBRF_Brf::BRF_SETTING_ID_SHOW_REALTOR_LIST, $iDisplay, date('Y-m-d H:i:s'));
        }
    }
}

?>
