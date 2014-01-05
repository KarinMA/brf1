<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sendmail
 *
 * @author John Jansson
 */
class Command_sendmail extends Command 
{
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $oSendUser = NULL;
        if (@$this->_aRequest['userId']) {
            $oSendUser = SvenskBRF_User::loadById($this->_aRequest['userId']);
        } else {
            $oSendUser = getUser();
        }
        $oMail = $oSendUser->sendMail($this->_aRequest['message'], $this->_aRequest['subject']);
        if (count($this->_aRequest['receivers']) == 1 && $this->_aRequest['receivers'][0] == -1) {
            foreach (SvenskBRF_User::getUsersByBrfId(!@$this->_aRequest['_brfId'] ? getBrf()->getId() : $this->_aRequest['_brfId']/*, $oSendUser*/) as $oUser) {
                if ($oSendUser->getUserType() != SvenskBRF_User::USER_TYPE_REALTOR || !(!$oUser->getPrimaryMember() && $oUser->getSetting(SvenskBRF_User::BLOCK_REALTOR_MESSAGE_SETTING_ID))) {
                    $oUser->getMail($oMail, (bool) @$this->_aRequest['skipNotification']);
                }
            }
        } else {
            foreach ($this->_aRequest['receivers'] as $iReceiverId) {
                $oReceiver = SvenskBRF_User::loadById($iReceiverId);
                $oReceiver->getMail($oMail, (bool) @$this->_aRequest['skipNotification']);
            }
        }
        return 1;
    }
}

?>
