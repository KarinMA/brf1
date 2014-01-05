<?php
$sStepParameter = "";
define('REALTOR_CODE', '____rc____');
define('REGSTEP', '____rgstp_____');
include 'setup.php';
// brf register code?
if (@$_REQUEST['registerCode']) {
    if (strlen($_REQUEST['registerCode']) >= 6) {
        $oBrfRegister = SvenskBRF_Brf::getByRegisterCode($_REQUEST['registerCode']);
        $iStep = 1;
        if (!$oBrfRegister) {
            $oBrfRegister = SvenskBRF_Brf::getByRealtorCode($_REQUEST['registerCode']);
            $_SESSION[REALTOR_CODE] = $_REQUEST['registerCode'];
        }
        
        if ($oBrfRegister) {
            if (@$_SESSION[REGSTEP][$oBrfRegister->getUrl()]) {
                $iStep = (int) $_SESSION[REGSTEP][$oBrfRegister->getUrl()];
            } else if (@$_COOKIE[REGSTEP] && (($aCookie = unserialize($_COOKIE[REGSTEP])) && array_key_exists($oBrfRegister->getUrl(), $aCookie))) {
                $iStep = $aCookie[$oBrfRegister->getUrl()];
            } 
        }
        
        if ($oBrfRegister) {
            if (isLoggedIn() && getBrf()->getId() != $oBrfRegister->getId())  {
                logout(TRUE);
            }
            $_SESSION[BRF] = $oBrfRegister->getId();
            exitForLocation('registrera/' . $iStep);
        } else {
            exitForLocation();
        }
        
        
    } else {
        // some parameter for a register step
        $sStepParameter = $_REQUEST['registerCode'];
    }
}

// check that we're logged in
if ((!$oBrf = getBrf())) {
    exitForLocation();
}

$bIsFromAdmin = (($oUser = getUser()) && $oUser->getAdmin());

// step?
$iStep = @$_REQUEST['step'] ? $_REQUEST['step'] : 1;



if (!file_exists('./brf_registrera_' . $iStep . '.php')) {
    $iStep = 1;
}

if ($bIsFromAdmin && !in_array($iStep, array(1,3,4,6,7,8,10,11,12)) && !$_POST['step']) {
    header('Location: ' . BASE_DIR . $oBrf->getUrl());
    include 'unsetup.php';
    exit;
}

// BARA TRE STEG
if ($iStep == 3) {
    // && strpos(@$_SERVER['HTTP_REFERER'], "registrera") !== FALSE
    $iStep = 10;
}

// actions
if (@is_numeric(@$_POST['vidare_x']) && @is_numeric(@$_POST['vidare_y'])) {
    switch ($iStep):
        case 1;
            // first page, welcome text and pictures
            if ((TRUE || array_key_exists('presentation', $_POST)) || $bIsFromAdmin) {
                if (!$bIsFromAdmin) {
                    //$oBrf->setPresentation($_POST['presentation']);
                    if (@$_POST['lagenheter']) {
                        $oBrf->setApartments($_POST['lagenheter']);
                    }
                }
                $aSessionAddresses = SvenskBRF_Session::getInstance()->getSavedAddresses();
                // save other addresses
                foreach ($aSessionAddresses as $aOtherAddress) {
                    $oBrf->addAddress($aOtherAddress['Adress'], $aOtherAddress['Nummer1'], $aOtherAddress['Nummer2'], $aOtherAddress['Postnummer'], $aOtherAddress['Postort'], $aOtherAddress['Jamna'], $aOtherAddress['Udda']);
                }
                
                if (FALSE && !$bIsFromAdmin) {
                    // save pictures
                    foreach (SvenskBRF_Session::getInstance()->getSavedPictureData() as $aPictureData) {
                        $aPictureData[1]['tmp_name'] = $aPictureData[0];
                        $oBrf->savePictureArray($aPictureData[1]);
                    }

                    // front removed
                    foreach (SvenskBRF_Session::getInstance()->getRemovedFrontPictureIds() as $iPictureId) {
                        SvenskBRF_BrfPicture::loadById($iPictureId)->setFront(FALSE);
                    }
                }
                
                // clear sessson for step 1 since we've saved now
                SvenskBRF_Session::getInstance()->clearRegister($iStep);
                
                if (!$bIsFromAdmin) {
                    $aPasswords = array();
                    // create users
                    if (count(SvenskBRF_User::getAllUsersByBrfId($oBrf->getId())) == 0) {
                        for ($iUserIndex = 0; $iUserIndex < $oBrf->getApartments(); $iUserIndex++) {
                            do {
                                $sPassword = SvenskBRF_User::generatePassword();
                            } while (in_array($sPassword, $aPasswords));
                            $aPasswords[] = $sPassword;
                            SvenskBRF_User::saveUser(array(
                                'BrfId' => $oBrf->getId(),
                                'Presentation' => '',
                                'Age' => NULL,
                                'LivesWith' => NULL,
                                'Username' => array($oBrf->getUrl(), $oBrf->getUrl()),
                                'Password' => array($sPassword, $sPassword),
                                'Email' => array('',''),
                                'Firstname' => '',
                                'Surname' => '',
                                'ApartmentNumber' => '',
                                'ApartmentNumber2' => '',
                                'Phone' => '',
                                'HidePhone' => 0,
                                'TitleId' => NULL,
                                'OwnTitle' => NULL,
                                'AddressId' => NULL,
                                'Floor' => NULL,
                            ), array());
                        }
                    }

                    $oBrf->setShowStreetView((bool) @$_POST['showStreetView']);
                    $oBrf->setShowStreetView(TRUE);
                }
                
                if ($bIsFromAdmin) {
                    exitForLocation($oBrf->getUrl() . '/admin');
                }
                
                $iStep = 2;
            }
            break;
        case 2:
            if (TRUE || !$oBrf->getActivated()) {
                if (TRUE || !file_exists(SvenskBRF_Document::FILE_BASE_PATH . $oBrf->getUrl() . '/documents/administration/' . SvenskBRF_Document::getToMembersStartDocumentName($oBrf))) {
                    $oCreateFileCommand = new Command_getuserpdfs(array('brfId' => $oBrf->getId()));
                    $aDataReturned = array();
                    $oCreateFileCommand->execute($aDataReturned);
                }
                if (TRUE && @$_POST['utskrift']) {
                    SvenskBRF_Notice::queueToMembersNotification($oBrf);
                    $oBrf->saveSetting(SvenskBRF_Brf::BRF_SETTING_ID_REGISTER_PRINTHELP, 1);
                } else {
                    $oBrf->saveSetting(SvenskBRF_Brf::BRF_SETTING_ID_REGISTER_PRINTHELP, 0);
                }
            }
            $iStep = 10;
            break;
        case 3:
            if (($sActionType = @$_POST['actionType'])) {
                switch ($sActionType) {
                    case 'save':
                        if (@$_POST['documentType']) {
                            SvenskBRF_Document::saveDocument(
                                $oBrf, 
                                @$_FILES['file1'], 
                                @$_POST['documentType'], 
                                @$_POST['public'], 
                                
                                !@array_key_exists('documentType_prepend', $_POST) ?    
                                (@$_POST['name']) : 
                                (
                                    ($_POST['documentType_prepend'] ? 
                                    $_POST['documentType_prepend'] : 'Dokumentarkiv')
                                    
                                    .
                                        " _ "
                                    .
                                        
                                    ($_POST['name'] ? $_POST['name'] : $_FILES['file1']['name'])
                                    
                                    
                                )
                                , 
                                
                                    
                                (int) @$_POST['year'],
                                (bool) $_POST['isBoard']
                            );
                            
                        }
                        break;
                        case 'update':
                            $oDocument = SvenskBRF_Document::loadById($_POST['documentId']);
                            if ($_POST['name']) {
                                $oDocument->setIsPublic((bool) @$_POST['public']);
                                $oDocumentTypes = getDocumentTypeAccessor()->getDocumentTypesByDirectoryName($_POST['documentType']);
                                $oDocumentType = $oDocumentTypes->current();
                                $oDocument->setDocumentTypeId($oDocumentType->getId());
                                $oDocument->setDocumentType($oDocumentType);
                                if (@$_POST['isBoard']) {
                                    $oDocument->setFilename($_POST['documentType_prepend'] . ' _ ' . $_POST['name']);
                                } else {
                                    $oDocument->setFilename($_POST['name']);
                                }
                                if ($_POST['year'] && $oDocument->getDocumentType()->getHasYear()) {
                                    $oDocument->setYear($_POST['year']);
                                }
                            }
                        break;
                }
                
                $sStepParameter = $_POST['isBoard'] ? '/s' : '';
                exitForLocation('registrera/12' . $sStepParameter);
            } else {
                if ($bIsFromAdmin) {
                    exitForLocation($oBrf->getUrl() . ((!$_POST['isBoard']) ? '/admin' : '/dokument/arkiv'));
                }
                $iStep = 4;
            }
            break;
        case 4:
             if (($sActionType = @$_POST['actionType'])) {
                switch ($sActionType) {
                    case 'save':
                        if (
                            (@$_POST['Lokal']) && 
                            @$_POST['sluttid'] &&
                            ($_POST['starttid']) !== '' &&
                            ((int)$_POST['starttid']) < 24 &&
                            @$_POST['sluttid'] && 
                            ((int)$_POST['sluttid']) > 0 &&
                            ((int)$_POST['sluttid']) <= 24 &&
                            ((int)$_POST['sluttid']) > ((int)$_POST['starttid']) &&
                            @$_POST['tidsintervall'] && 
                            @count(@$_POST['days']) 
                        ) {
                            $oResource = NULL;
                            if (!$_POST['resource']) {
                                $oResource = $oBrf->createResource(
                                    $_POST['Lokal'] ? $_POST['Lokal'] : $_POST['name'],
                                    (int) $_POST['starttid'],
                                    (int) $_POST['sluttid'], 
                                    $_POST['tidsintervall'],
                                    trim($_POST['description']),
                                    trim((string) $_POST['name']), 
                                    $_POST['days'] ,
                                    $_POST['antalBokningar']
                                );
                            } else {
                                $oResource = $oBrf->saveResource(
                                    $_POST['resource'],
                                    $_POST['Lokal'] ? $_POST['Lokal'] : $_POST['name'],
                                    (int) $_POST['starttid'],
                                    (int) $_POST['sluttid'], 
                                    $_POST['tidsintervall'],
                                    trim($_POST['description']),
                                    trim((string) $_POST['name']), 
                                    $_POST['days'],
                                    $_POST['antalBokningar']
                                );
                            }
                            // generate a document
                            if ($oResource) {
                                SvenskBRF_Document::generateDocumentForResource($oResource, array_keys(@$_POST['days']));
                            }
                        }
                        break;
                }
                
                exitForLocation('registrera/4');
            } else {
                if ($bIsFromAdmin) {
                    exitForLocation($oBrf->getUrl() . '/admin');
                }
                $iStep = 5;
            }
            break;
        case 5: 
            $oBrf->setPresentation($_POST['presentation']);
            if (FALSE && !$bIsFromAdmin) {
                // save pictures
                foreach (SvenskBRF_Session::getInstance()->getSavedPictureData() as $aPictureData) {
                    $aPictureData[1]['tmp_name'] = $aPictureData[0];
                    $oBrf->savePictureArray($aPictureData[1]);
                }
                SvenskBRF_Session::getInstance()->clearRegister($iStep);
                // front removed
                foreach (SvenskBRF_Session::getInstance()->getRemovedFrontPictureIds() as $iPictureId) {
                    SvenskBRF_BrfPicture::loadById($iPictureId)->setFront(FALSE);
                }
            }
            
            
            $iStep = 6;
            break;
        case 6: 
            $iStep = 7;
            break;
        case 7: 
            $iStep = 8;
            break;
        case 8: 
            $iStep = 9;
            break;
        case 9: 
            $iStep = 10;
            break;
        case 10: 
            if (array_key_exists('PrePass', $_POST['member'])) {
                $oBrf->setActivated(TRUE);
                $oBrfUser = SvenskBRF_User::saveUser($_POST['member'], $_FILES['file'], SvenskBRF_User::getUserByPrePass($_POST['member']['PrePass'], $oBrf));
                $oBrfUser->setIsRegistered(TRUE);
                $oBrfUser->setAdmin(TRUE);
                $_SESSION[USER] = $oBrfUser->getId();
                $_SESSION[LOGIN] = 1;
                
                // see if realtor activated?
                if (
                        @$_SESSION[REALTOR_CODE] && 
                        ($oRCodeBrf = SvenskBRF_Brf::getByRealtorCode($_SESSION[REALTOR_CODE])) && 
                        $oBrf->getId() 
                        == 
                        $oRCodeBrf->getId()
                ) {
                    $oRealtorCodeSelector = getBrfRealtorCodeSelector();
                    $oRealtorCodeSelector->setBrfId($oBrf->getId());
                    $oRealtorCodeSelector->setRealtorCode($_SESSION[REALTOR_CODE]);
                    if (($oRealtorCode = getBrfRealtorCodeAccessor()->readOne($oRealtorCodeSelector))) {
                        $oBrf->setRealtorUserId($oRealtorCode->getRealtorUserId());
                        // send an e-mail notification
                        SvenskBRF_Notice::sendRealtorActivationMail($oBrf);
                    }
                }
                
            } else {
                $oBrfUser = SvenskBRF_User::saveUser($_POST['member'], $_FILES['file'], getUser());
            }
            $bNoCookie = TRUE;
            unset($_SESSION['activateEmail'], $_SESSION['activatePhone'], $_SESSION[REGSTEP]);
            setcookie(REGSTEP, "", time()-3600);
            $iStep = 11;
            break;
    endswitch;
} 

$sAction = @$_REQUEST['action'];

// save step
if (!isset($bNoCookie) || !$bNoCookie) {
    $_SESSION[REGSTEP][$oBrf->getUrl()] = $iStep;
    $aCookieValue = @$_COOKIE[REGSTEP] ? unserialize($_COOKIE[REGSTEP]) : array();
    $aCookieValue[$oBrf->getUrl()] = $iStep;
    setcookie(REGSTEP, serialize($aCookieValue), time()+60*60*24*30);
}

include "./brf_registrera_$iStep.php";
include 'unsetup.php';
?>
