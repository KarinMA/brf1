<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validatememberform
 *
 * @author John Jansson
 */
class Command_validatememberform extends Command 
{
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $aErrors = array();
        $aData = $this->_aRequest['member'];
        $aSingleFields = array(
            'Firstname', 
            'Surname',
        );
        
        if (array_key_exists('Villkor', $aData)) {
            $aSingleFields[] = 'Villkor';
        }
        if (!array_key_exists('realtor', $this->_aRequest)) {
            if (array_key_exists('ExternalPartnerId', $aData)) {
                $aSingleFields[] = 'ExternalPartnerId';
            }
        }
       
        $aDoubleFields = array(
            'Password', 
            'Username'
        );
        
        
        foreach (array('Email', 'Phone') as $sContactField) {
            if (@count($aData[$sContactField]) < 2) {
                $aSingleFields[] = $sContactField;
            } else {
                $aDoubleFields[] = $sContactField;
            }
        }

        
        // also: phone and e-mail validation
        foreach ($aSingleFields as $sKey) {
            $this->_aRequest[$sKey] = $aData[$sKey];
            if (array_key_exists($sKey, $aData) && !trim($aData[$sKey])) {
                $aErrors[] = $sKey;
            }
        }
        
        // validate double fields
        foreach ($aDoubleFields as $sField) {
            if (@$this->_aRequest['doubleOptional']) {
                if (!trim($aData[$sField][0]) && !trim($aData[$sField][1])) {
                    continue;
                } else {
                    if (in_array($sField, array('Email', 'Phone'))) {
                        $this->_aRequest['double' . $sField] = TRUE;
                        $this->_aRequest[$sField] = $aData[$sField[0]];
                    }
                }
            } else {
                if (in_array($sField, array('Email', 'Phone'))) {
                    $this->_aRequest['double' . $sField] = TRUE;
                    $this->_aRequest[$sField] = $aData[$sField][0];
                }
            }
            if (array_key_exists($sField, $aData)) {
                if (strlen(trim($aData[$sField][0])) < 4) {
                    $aErrors[] = array($sField, 0);
                } elseif (trim($aData[$sField][0]) !== trim($aData[$sField][1])) {
                    $aErrors[] = array($sField, 1);
                }
            }
        }
        
        $oValidateCommand = Command::createCommand("validatemailandphone", $this->_aRequest);
        $oValidateCommand->execute($aPhoneEmail);

        if (@$this->_aRequest['doubleOptional'] && !trim($aData['Username'][0])) {
            // no need to check
        } else {
            // validate unique username and password
            if (($oNewUser = SvenskBRF_User::getByUsername(trim($aData['Username'][0]))) && (!($oMyUser = getUser()) || $oNewUser->getId() != $oMyUser->getId())) {
                $_sPwd = $aData['Password'][0];
                if (!$_sPwd) {
                    $aErrors[] = array('Password', 0);
                } else {
                    $oUserSelector = getUserSelector();
                    $oUserSelector->setUsername($oNewUser->getUsername());
                    $oUserSelector->setPassword($aData['Password'][0]);
                    if (getUserAccessor()->read($oUserSelector)->size()) {
                        $aErrors[] = array('Username', 0);
                    }
                }
            }
        }
        
        // check e-mail
        $oMyUser = getUser();
        $iUserId = $oMyUser ? $oMyUser->getId() : NULL;
        if (($oOtherUser = SvenskBRF_User::getByEmail(count($aData['Email']) == 2 ? $aData['Email'][0] : $aData['Email'], $iUserId))) {
            if (count($aData['Email']) == 2) {
                $aErrors[] = array('Email', 0);
            } else {
                $aErrors[] = 'Email';
            }
        }
        
        if (array_key_exists('PrePass', $aData)) {
            // check
            if (!SvenskBRF_User::getUserByPrePass($aData['PrePass'], getBrf())) {
                $aErrors[] = 'PrePass';
            }
        }
        
        // validate title field
        if (array_key_exists('TitleId', $aData)) {
            if (getUser() && getUser()->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER && !$aData['TitleId'] && array_key_exists('OwnTitle', $aData) && !$aData['OwnTitle']) {
                $aErrors[] = 'OwnTitle';
            } else if ((!getUser() || getUser()->getUserType()) == SvenskBRF_User::USER_TYPE_MEMBER && !array_key_exists('OwnTitle', $aData) && !$aData['TitleId']) {
                $aErrors[] = 'TitleId';
            }
        }
        
        $aErrors = array_merge($aErrors, $aPhoneEmail['message']);
        
        return array('error' => FALSE, 'errors' => $aErrors);
        return array('error' => (bool) !count($aErrors), 'errors' => $aErrors);
    }
}

?>
