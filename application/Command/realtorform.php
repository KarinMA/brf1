<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of realtormform
 *
 * @author John Jansson
 */
class Command_realtorform extends Command {
    /**
     * 
     */
    protected function _executeCommand() 
    {
        $aFormData = $this->_aRequest['realtorform'];
        $sText = "Intresseanmälan från " . $aFormData['from'] . ".\n\nMeddelande: " . $aFormData['message'] . "\n\n";
        $sText .= "E-post: " . $aFormData['email'] . "\n\n";
        $sText .= "Telefon: " . $aFormData['phone'] . "\n\n";
        
        $sUsername = switchCharacters($aFormData['from'], FALSE, TRUE);
        $iCounter = rand(1,100);
        while (getUserAccessor()->getUsersByUsername($sUsername)->size() > 0) {
            $sUsername = switchCharacters($aFormData['from'], FALSE, TRUE) . $iCounter;
            $iCounter = rand(1,100);
        }
        $sPassword = SvenskBRF_User::generatePassword();
        $aUserData = array(
            'Password' => array($sPassword),
            'Username' => array($sUsername),
            'userType' => SvenskBRF_User::USER_TYPE_REALTOR,
            'Firstname' => $aFormData['from'],
            'Surname' => '',
            'Email' => array($aFormData['email']),
            'Phone' => $aFormData['phone'],
            'Presentation' => '',
            'Floor' => '',
            'ApartmentNumber' => '',
            'Age' => '',
            'ApartmentNumber2' => '',
            'HidePhone' => 0,
            'AddressId' => '',
            'LivesWith' => '',
            'BrfId' => SvenskBRF_Brf::REALTOR_BRF_ID
        );
        
        $oRealtorUser = SvenskBRF_User::saveUser($aUserData, array());
        
        $aFormData['username'] = $sUsername;
        $aFormData['password'] = $sPassword;
        SvenskBRF_Notice::sendRealtorInterestMail($sText, $aFormData);
    }
}

?>
