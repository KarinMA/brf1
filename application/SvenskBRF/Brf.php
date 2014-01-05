<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Brf
 *
 * @author John Jansson
 */
class SvenskBRF_Brf extends SvenskBRF_Main 
{
    const BRF_SETTING_ID_REGISTER_PRINTHELP = 1;
    const BRF_SETTING_ID_REGISTER_BRFCODE = 2;
    const BRF_SETTING_ID_SMS_CALENDAR = 3;
    const BRF_SETTING_ID_SMS_BOOKING = 4;
    const BRF_SETTING_ID_SHOW_REALTOR_LIST = 15;
    const BRF_SETTING_HIDE_RESOURCE_MESSAGE = 17;
    const BRF_SETTING_HIDE_DOCUMENT_MESSAGE = 18;
    const BRF_SETTING_HIDE_PRESENTATION_MESSAGE = 19;
    const BRF_SETTING_ID_SMS_FELANMALAN = 20;
    
    
    function getBoardMembers()
    {
        self::$_oUserSelector->setBrfId($this->_oBrf->getId());
        self::$_oUserSelector->setUserType(SvenskBRF_User::USER_TYPE_MEMBER);
        self::$_oUserSelector->setIsRegistered(TRUE);
        self::$_oUserSelector->setSearchParameter('user_title_id', array(1,2,3,4), Selector::CONDITION_IN);
        return new SvenskBRF_User_Collection(self::$_oUserAccessor->read(self::$_oUserSelector));
    }
    
    /**
     * 
     * @var int
     */
    const REALTOR_BRF_ID = 5;
    
    
    /**
     * 
     * @var itn
     */
    const DOCUMENT_TYPE_ID_REALTOR_MATERIAL = 6;
    
    /**
     *
     * 
     * @param type $a_sName 
     * @return array
     */
    public static function findBrfByName($a_sName, $a_sParam = NULL)
    {
        $aBrfs = array();
        $sQuery = "SELECT `url`, `name`  FROM `brf` WHERE `name` LIKE '" . mysql_real_escape_string($a_sName . '%') . "'";
        switch ($a_sParam) {
            case 'realtor':
                $sQuery .= " AND realtor_user_id IS NULL";
                break;
            default:
                break;
        }
        $rResult = mysql_query($sQuery . " ORDER BY `name` LIMIT 25");
        while (($aRow = mysql_fetch_assoc($rResult))) {
            if (!preg_match("/^svenskbrf[0-9]?[0-9]?$/", $aRow['url']) && $aRow['url'] !== 'maklare') {
                $aBrfs[] = $aRow;
            }
        }
        return $aBrfs;
    }
    
    public function delete()
    {
        rrmdir("./../files/brfs/" . $this->_oBrf->getUrl());
        $this->_oBrf->delete();
    }
    
    function hasAd()
    {
        $oAds = self::$_oBrfRealtorAdAccessor->getBrfRealtorAdsByBrfId($this->_oBrf->getId());
        return (bool) $oAds->size();
    }
    
    function createAd(SvenskBRF_User $a_oUser, $a_aForm, $a_aFileData = array())
    {
        $oAd = BrfRealtorAd::create(
            $this->_oBrf->getId(), 
            $a_oUser->getId(), 
            $a_aForm['rooms'], 
            $a_aForm['address'], 
            $a_aForm['stairs'], 
            $a_aForm['fee'], 
            $a_aForm['price'], 
            $a_aForm['sqm'], 
            date('Y-m-d H:i:s'), 
            $a_aForm['link'], 
            $a_aForm['pricetype'],
            0,
            NULL,
            NULL,
            FALSE,
            TRUE
        );
        $oAd = SvenskBRF_BrfRealtorAd::load($oAd);
        
        // save picture
        $bPictureSaved = FALSE;
        if ($a_aFileData && $a_aFileData['error'] == UPLOAD_ERR_OK &&
                in_array($a_aFileData['type'], array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))
        ) {
            if (preg_match("/image\/([a-z]{3})/", str_replace("image/jpeg", "image/jpg", $a_aFileData['type']), $aMatches) && count($aMatches) == 2) {
                if ($oAd->savePicture($a_aFileData)) {
                    $bPictureSaved = TRUE;
                }
            }
        }
        
        $bTimeAdded = FALSE;
        foreach ($a_aForm['time'] as $iTimeIndex => $aTimes) {
            if ($aTimes[0] && $aTimes[1] && $a_aForm['date'][$iTimeIndex]) {
                $iStart = (int) preg_replace("/[^0-9]/", "", $aTimes[0]);
                $iEnd = (int) preg_replace("/[^0-9]/", "", $aTimes[1]);
                $iDiff =  $iEnd - $iStart ;
                $iMinutes = 0;
                if ($iDiff > 0) {
                    if ($iDiff == 15) {
                        $iMinutes = 15;
                    } else if ($iDiff == 30) {
                        $iMinutes = 30;
                    } else if ($iDiff == 45) {
                        $iMinutes = 45;
                    } else {
                        $iAdd = 0;
                        if (preg_match("/30$/", $iDiff)) {
                            $iAdd = 30;
                            $iEnd -= 30;
                        }
                        if (preg_match("/15$/", $iDiff)) {
                            $iAdd = 15;
                            $iEnd -= 15;
                        }
                        if (preg_match("/45$/", $iDiff)) {
                            $iAdd = 45;
                            $iEnd -= 45;
                        }
                        if (preg_match("/70$/", $iDiff)) {
                            $iAdd = 30;
                            $iStart += 70;
                        }
                        if (preg_match("/75$/", $iDiff)) {
                            $iAdd = 15;
                            $iStart += 75;
                        }
                        if (preg_match("/55$/", $iDiff)) {
                            $iAdd = 45;
                            $iStart += 55;
                        }
                        $iMinutes = ($iEnd - $iStart) /100  * 60;
                        $iMinutes += $iAdd;
                    }

                    $oBrfAdTime = BrfRealtorAdTime::create($oAd->getId(), $a_aForm['date'][$iTimeIndex] . ' ' . $aTimes[0] . ':00', $iMinutes, TRUE);
                    $oAd->getDomainObject()->getBrfRealtorAdTimeCollection()->addObject($oBrfAdTime);
                    $bTimeAdded = TRUE;
                }
            }
        }
        
        // set time
        if (!$bTimeAdded && $a_aForm['alternatetime']) {
            $oAd->setAlternateTime($a_aForm['alternatetime']);
        }
        
        if (array_key_exists('id', $a_aForm) && is_numeric($a_aForm['id'])) {
            $oPreviousAd = self::$_oBrfRealtorAdAccessor->getById($a_aForm['id']);
            // if image - copy it, and set the parameters
            $oPreviousAdObject = SvenskBRF_BrfRealtorAd::load($oPreviousAd);
            if (!$bPictureSaved && $oPreviousAdObject->hasPicture()) {
                $oAd->setHasPicture(TRUE);
                $oAd->setImageType($oPreviousAdObject->getImageType());
                // copy the image
                $sOldImagePath = SvenskBRF_Document::FILE_BASE_PATH . $this->_oBrf->getUrl() . '/pictures/ad/' . $oPreviousAdObject->getId() . '.' . $oPreviousAdObject->getImageType();
                $sNewImagePath = SvenskBRF_Document::FILE_BASE_PATH . $this->_oBrf->getUrl() . '/pictures/ad/' . $oAd->getId() . '.' . $oPreviousAdObject->getImageType();
                copy($sOldImagePath, $sNewImagePath);
                unlink($sOldImagePath);
            }
            $oPreviousAd->delete();
        }
        
        return $oAd;
    }
    
    /**
     *
     * @param type $a_sRealtorCode
     * @return SvenskBRF_Brf
     */
    public static function getByRealtorCode($a_sRealtorCode) 
    {
        self::$_oBrfRealtorCodeSelector->setRealtorCode($a_sRealtorCode);
        $oRealtorCode = self::$_oBrfRealtorCodeAccessor->readOne(self::$_oBrfRealtorCodeSelector);
        if ($oRealtorCode) {
            return self::load($oRealtorCode->getBrf());
        } else {
            return NULL;
        }
    }
    
    /**
     *
     * return BrfRealtorLog 
     */
    public function getLatestRealtorMessage()
    {
        self::$_oBrfRealtorLogSelector->limit(1);
        self::$_oBrfRealtorLogSelector->setOrderBy('sent_on DESC');
        self::$_oBrfRealtorLogSelector->setBrfId($this->_oBrf->getId());
        return self::$_oBrfRealtorLogAccessor->readOne(self::$_oBrfRealtorLogSelector);
    }
    
    
    public static function createTestBrfs()
    {
        for ($iBrfId = 1; $iBrfId <= 20; $iBrfId++) {
            $oBrf = Brf::create("Svensk Brf $iBrfId", "svenskbrf$iBrfId", "700000-0000", "Vegagatan", "15", NULL, 11329, 2013, 2013, "STOCKHOLM", 3, "Demoförening Svensk Brf #$iBrfId", TRUE, 323, TRUE, NULL, TRUE);
            User::create(SvenskBRF_User::USER_TYPE_MEMBER, $oBrf->getId(), "svenskbrf{$iBrfId}_1", "svenskbrf{$iBrfId}_1", "Svensk Brf", NULL, NULL, "kontakt@svenskbrf.se", "0700000000", TRUE, NULL, FALSE, NULL, '', 35, '', FALSE, 1, SvenskBRF_User::generatePassword(12), '', NULL, TRUE, TRUE, NULL, TRUE);
            User::create(SvenskBRF_User::USER_TYPE_MEMBER, $oBrf->getId(), "svenskbrf{$iBrfId}_2", "svenskbrf{$iBrfId}_2", "Svensk Brf", NULL, NULL, "kontakt@svenskbrf.se", "0700000000", FALSE, NULL, FALSE, NULL, '', 35, '', FALSE, 1, SvenskBRF_User::generatePassword(12), '', NULL, TRUE, TRUE, NULL, TRUE);
            User::create(SvenskBRF_User::USER_TYPE_MEMBER, $oBrf->getId(), "svenskbrf{$iBrfId}_3", "svenskbrf{$iBrfId}_3", "Svensk Brf", NULL, NULL, "kontakt@svenskbrf.se", "0700000000", FALSE, NULL, FALSE, NULL, '', 35, '', FALSE, 1, SvenskBRF_User::generatePassword(12), '', NULL, TRUE, TRUE, NULL, TRUE);
            if (!file_exists("./../brfs/" . $oBrf->getUrl())) {
                @mkdir("./../files/brfs/" . $oBrf->getUrl());
                @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/documents');
                foreach (array('administration', 'arsredovisning', 'energideklaration', 'kalkyl', 'lokaler', 'maklarunderlag', 'ordningsregler', 'ovrigt', 'protokoll', 'stadgar', 'styrelselogg') as $sDirectory) {
                    @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/documents/' . $sDirectory);
                }
                @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures');
                @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures/brf');
                @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures/message');
            }
        }
    }
    
    public static function readBrfs($a_sCsvFilePath, $a_iOffset = 0, $a_iLimit = FALSE)
    {
        set_time_limit ( 60 * 5 );
        $aSpecialAddresses = array(
            'Finspångsvägen 1a - gavel' => array('Finspångsvägen', '1A'),
            '4:e Långgatan 19' => array('4:e Långgatan', '19'),
            '5:e Villagatan 10' => array('5:e Villagatan', '10'),
            '2:a Villagatan 14' => array('2:a Villagatan', '14'),
            '5.e Villagatan 9' => array('5:e Villagatan', '9'),
            '2:a Villagatan 16' => array('2:a Villagatan', '16'),
            '5:e Tvärgatan 34 B' => array('5:e Tvärgatan', '34B'),
        );
        $aBrfs = array();
        $aRegisterCodes = array();
        $rFile = fopen($a_sCsvFilePath, 'r');
        fgetcsv($rFile, 0, ";"); // first row
        $iCounter = 0;
        $bBreak = FALSE;
        
        $aReadAddress = array();
        $aBrfObjs = array();
        
        while (($sRow = fgets($rFile))) {
            setlocale(LC_ALL, 'sv_SE'); 
            $aRow = str_getcsv(utf8_encode($sRow), ";");
            
            
            $bTest = TRUE;
            $sTestBrf  = "769605-5214";
            if (@$_REQUEST['test']) {
                $sTestBrf = $_REQUEST['test'];
            }
            if ($bBreak && $aRow[0] != $sTestBrf) {
                if ($bTest) {
                    break;
                }
            }
            if ($aRow[0] != $sTestBrf) {
                if ($bTest) {
                    continue;
                }
            } else {
                if ($bTest) {
                    $bBreak = TRUE;
                }
            }
            
            if (!in_array($aRow[0], $aBrfs)) {
                $aBrfs[] = $aRow[0];
                
                if (count($aBrfs) < $a_iOffset) {
                    //echo "continuing<br />";
                    continue;
                }
                if ($a_iLimit && (count($aBrfs) - $a_iOffset >= $a_iLimit)) {
                    //echo "breaking<br />";
                    break;
                }
                
                
                if (in_array($aRow[0], array(
                    '702002-5677',
                    '769618-4527',
                ))) {
                    continue;
                }
                
                $aRow[1] = trim(str_replace(array(
                    "u.p.a",
                    " utan personlig ansvarighet",
                    "utan personlig ansvarighet",
                    "utan personligt ansvar",
                    "\"",
                    "&",
                    "Bostadsrättsförening ",
                    "Bostadsrättsföreningen ",
                    "Brf ",
                    "BRF ",
                ), array(
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                ), $aRow[1]));
                
                
                
                $aReadAddress[$aRow[0]] = array();
                if (!preg_match("/[Bb]ox/", $aRow[22])) {
                    $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                }
                $aOtherAddresses = array();
                
                // address matching
                $sAddress = "";
                $iStreetNumber = NULL;
                $bCo = FALSE;
                if (array_key_exists($aRow[4], $aSpecialAddresses)) {
                    $sAddress = $aSpecialAddresses[$aRow[4]][0];
                    if (array_key_exists(1, $aSpecialAddresses[$aRow[4]])) {
                        $iStreetNumber = $aSpecialAddresses[$aRow[4]][1];
                    }
                    unset($aReadAddress[$aRow[0]]);
                } else if (preg_match("/^[Bb]ox ([0-9 ]+)$/", $aRow[4], $aAddressMatches)) {
                    $sAddress = "Box " . str_replace(" ", "", $aAddressMatches[1]);
                    $bCo = FALSE;
                } else if (preg_match("/^([A-Öa-öé, ]+)( )?([0-9 A-Za-z]+)?/", $aRow[4], $aAddressMatch) && count($aAddressMatch) == 2 || count($aAddressMatch) == 4) {
                    // regular address
                    unset($aReadAddress[$aRow[0]]);
                    $sAddress = $aAddressMatch[1];
                    if (count($aAddressMatch) == 4) {
                        $iStreetNumber = str_replace(" ", "", $aAddressMatch[3]);
                        if (preg_match("/([0-9]+)\-([0-9]+)/", $aRow[4], $aNumberMatches) && count($aNumberMatches) == 3 && $aNumberMatches[1] == $iStreetNumber) {
                            $iStreetNumber2 = $aNumberMatches[2];
                            $bNumbersEven = $iStreetNumber % 2 == 0;
                            $iDiff = $iStreetNumber2 - $iStreetNumber;
                            if ($iDiff % 2 == 0) {
                                // one side
                                $iSubNumber1 = $iDiff == 2 ? $iStreetNumber2 : ($iStreetNumber + 2);
                                $iSubNumber2 = $iDiff == 2 ? NULL : $iStreetNumber2;
                                $aOtherAddresses[] = array(
                                    'setAddress' => $sAddress,
                                    'setStreetNumber' => $iSubNumber1,
                                    'setStreetNumber2' => $iSubNumber2,
                                    'setZip' => str_replace(" ", "", $aRow[5]),
                                    'setPostalAddress' => $aRow[6],
                                    'setEvenNumbers' => $bNumbersEven && $iSubNumber2,
                                    'setOddNumbers' => !$bNumbersEven
                                );
                            } else {
                                // both sides
                                $iSubNumber1 = $iStreetNumber + 1;
                                $iSubNumber2 = $iStreetNumber2;
                                $aOtherAddresses[] = array(
                                    'setAddress' => $sAddress,
                                    'setStreetNumber' => $iSubNumber1,
                                    'setStreetNumber2' => $iSubNumber2,
                                    'setZip' => str_replace(" ", "", $aRow[5]),
                                    'setPostalAddress' => $aRow[6],
                                    'setEvenNumbers' => TRUE,
                                    'setOddNumbers' => TRUE
                                );
                            }
                        }
                    }
                    
                } else if ($aRow[3]) {
                    $sAddress = str_replace(array("c/o ", 'c/o', '/'), array('','',''), $aRow[3]);
                    $aRow[3] = '';
                }
                
                
                if (!$sAddress && $aRow[4]) {
                    print_r($aRow);
                    continue;
                }
                
                if (strtolower(substr($aRow[1], 0, 4)) === 'hsb ') {
                    $aRow[1] = substr($aRow[1], 4);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                if (strtolower(substr($aRow[1], 0, 5)) === 'hsbs ') {
                    $aRow[1] = substr($aRow[1], 5);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                if (strtolower(substr($aRow[1], 0, 6)) === 'hsb:s ') {
                    $aRow[1] = substr($aRow[1], 6);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                if (strtolower(substr($aRow[1], 0, 12)) === 'riksbyggens ') {
                    $aRow[1] = substr($aRow[1], 12);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                if (strtolower(substr($aRow[1], 0, 5)) === 'sbcs ') {
                    $aRow[1] = substr($aRow[1], 5);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                if (strtolower(substr($aRow[1], 0, 6)) === 'sbc:s ') {
                    $aRow[1] = substr($aRow[1], 6);
                    if (!preg_match("/[Bb]ox/", $aRow[22])) {
                        $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                    }
                }
                
                $aRow[1] = trim($aRow[1]);
                if (preg_match("/^([0-9]+)/", $aRow[1], $aMatches)) {
                    $aRow[1] = substr($aRow[1], strlen($aMatches[1]));
                }
                
                
                $oBrf = Brf::create(
                        ($sName = /*str_replace(
                                array(
                                    "Bostadsrättsförening ",
                                    "Bostadsrättsföreningen ",
                                    'Brf '
                                ),
                                array(
                                    '',
                                    '',
                                    ''
                                ),
                                $aRow[1]
                        )*/ $aRow[1]),
                       ($sUrl =
                        str_replace(array(":", ",", '%', '-'), array("_", "_", '_o_', ''), 
                        strtolower(
                        switchCharacters(
                                $sName
                        , TRUE)))), $aRow[0], $sAddress, $iStreetNumber, NULL, preg_replace("/[^0-9]/", "", $aRow[23]), NULL, substr($aRow[2], 0, 4), $aRow[24], 0, '', FALSE, NULL, TRUE
                , $aRow[3] ? str_replace(array("c/o ", 'c/o', '/'), array('','',''), $aRow[3]) : NULL, TRUE);
                
                foreach ($aOtherAddresses as $aOtherAddress) {
                    $oBrfAddress = new BrfAddress();
                    $oBrfAddress->setBrfId($oBrf->getId());
                    foreach ($aOtherAddress as $sMethod => $mValue) {
                        call_user_func_array(array($oBrfAddress, $sMethod), array($mValue));
                    }
                }
                
                $oSvenskBRF = SvenskBRF_Brf::load($oBrf);
                $aBrfObjs[$aRow[0]] = $oBrf;
                if (!$bCo) {
                    $oSvenskBRF->setCoAddress(NULL);
                }
                
                do {
                    $sRegisterCode = SvenskBRF_User::generatePassword(10);
                } while (in_array($sRegisterCode, $aRegisterCodes));
                $aRegisterCodes[] = $sRegisterCode;
                try {
                    $oSvenskBRF->saveSetting(SvenskBRF_Brf::BRF_SETTING_ID_REGISTER_BRFCODE, $sRegisterCode);
                } catch (DomainObjectException $oDOException) {
                    while (TRUE) {
                        break;
                    }
                } catch (SvenskBRFException $oSBException) {
                    while (TRUE) {
                        break;
                    }
                }
                $iCounter++;
                
                
                // create file structure
                if (!file_exists("./../brfs/" . $oBrf->getUrl())) {
                    @mkdir("./../files/brfs/" . $oBrf->getUrl());
                    @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/documents');
                    foreach (array('administration', 'arsredovisning', 'energideklaration', 'kalkyl', 'lokaler', 'maklarunderlag', 'ordningsregler', 'ovrigt', 'protokoll', 'stadgar', 'styrelselogg') as $sDirectory) {
                        @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/documents/' . $sDirectory);
                    }
                    @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures');
                    @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures/brf');
                    @mkdir("./../files/brfs/" . $oBrf->getUrl() . '/pictures/message');
                }
            } elseif (array_key_exists($aRow[0], $aReadAddress)) {
                if (!preg_match("/[Bb]ox/", $aRow[22])) {
                    $aReadAddress[$aRow[0]][] = array($aRow[22], $aRow[23], $aRow[24]);
                }
            }
            
        }
        
        foreach ($aReadAddress as $sGovNr => $aReadAddresses) {
            $oBrf = $aBrfObjs[$sGovNr];
            if ($oBrf && count($aReadAddresses)) {
                $aStreets = array();
                foreach ($aReadAddresses as $aRAdr) {
                    $sStreet = preg_replace("/[0-9]/", "", $aRAdr[0]);
                    @$aStreets[$sStreet]++;
                }
                asort($aStreets);
                end($aStreets);
                $sStreet = key($aStreets);
                
                $aAddrMatches = array();
                foreach ($aReadAddresses as $aRAdr) {
                    if (preg_match("/([0-9]+)/", $aRAdr[0], $aMatches) && $sStreet === preg_replace("/[0-9]/", "", $aRAdr[0])) {
                        @$aAddrMatches[$aRAdr[0]]++;
                    }
                }
                asort($aAddrMatches);
                $sNumber = NULL;
                $sSelectedAddress = NULL;
                if (count($aAddrMatches)) {
                    // om gatunummer...
                    end($aAddrMatches);
                    $sSelectedAddress = key($aAddrMatches);
                    preg_match("/([0-9]+)/", $sSelectedAddress, $aMatches);
                    $sNumber = $aMatches[1];
                }
                if (!$sNumber) {
                    $oBrf->setAddress($aReadAddresses[0][0]);
                    $oBrf->setZip(preg_replace("/[^0-9]/", "", $aReadAddresses[0][1]));
                    $oBrf->setPostalAddress($aReadAddresses[0][2]);
                    $oBrf->setStreetNumber(NULL);
                } else {
                    $sAddress = trim(substr($sSelectedAddress, 0, strpos($sSelectedAddress, $sNumber) - 0));
                    $oBrf->setAddress($sAddress);
                    $oBrf->setStreetNumber($sNumber);
                    $iSelectedAddressIndex = 0;
                    foreach ($aReadAddresses as $iARIndex => $aR) {
                        if ($aR[0] == $sSelectedAddress) {
                            $iSelectedAddressIndex = $iARIndex;
                        }
                    }
                    $oBrf->setZip(preg_replace("/[^0-9]/", "", $aReadAddresses[$iSelectedAddressIndex][1]));
                    $oBrf->setPostalAddress(($aReadAddresses[$iSelectedAddressIndex][2]));
                }
                
            }
        }
        
        //print_r($aReadAddress);
    }
    
    
    
    public static function readBrfs2($a_sCsvFilePath, $a_iOffset = 0, $a_iLimit = FALSE)
    {
        set_time_limit ( 60 * 5 );
        
        $rResult = mysql_query("SELECT id,address,government_number from brf where address like '%box%'", $GLOBALS['rDatabaseConnection']);
        $aBrfs = array();
        while (($aRow = mysql_fetch_assoc($rResult))) {
            //echo $aRow['address'] . ' ' . $aRow['government_number'] . '<br />';
            $aBrfs[] = $aRow['government_number'];
        }
        
        
        $rFile = fopen($a_sCsvFilePath, 'r');
        $aData = array();
        fgetcsv($rFile, 0, ";"); // first row
        while (($sRow = fgets($rFile))) {
            setlocale(LC_ALL, 'sv_SE'); 
            $aRow = str_getcsv(utf8_encode($sRow), ";");
            if (in_array($aRow[0], $aBrfs)) {
                $aData[$aRow[0]][] = $aRow;
            }
        }
        
        foreach ($aData as $sGovNr => $aRows) {
            $aAddresses = array();
            $aAddresses2 = array();
            $bFound = FALSE;
            foreach ($aRows as $aRow) {
                if (preg_match("/([A-Öa-öéüÉÜ\: ]+)([0-9]+)?/", $aRow[22], $aMatches) && $aMatches[1] !== 'Box ') {
                    @$aAddresses[$aMatches[1]]++;
                    @$aAddresses2[$aMatches[1]] = array(trim($aMatches[1]), $aMatches[2], $aRow[23], $aRow[24]);
                    $bFound = TRUE;
                }
            }
            if ($bFound) {
                asort($aAddresses);
                end($aAddresses);
                $sKey = key($aAddresses);
                $aAddrData = $aAddresses2[$sKey];

                var_dump($sGovNr, $aAddrData);
                $oBrf = SvenskBRF_Brf::loadByGovernmentNumber($sGovNr);
                if ($oBrf) {
                    /*$oBrf->setAddress($aAddrData[0]);
                    $oBrf->setStreetNumber($aAddrData[1]);
                    $oBrf->setZip(preg_replace("/[^0-9]/", "", $aAddrData[2]));
                    $oBrf->setPostalAddress($aAddrData[3]);*/
                } else {
                    echo "no brf $sGovNr<br />";
                }
            }
        }
        
        //print_r($aData);
    }
    
    
    
    /**
     * Saves a picture for the BRF
     */
    function savePicture($a_sTitle, $a_sDescription, $a_sFileKey = 'newpicture')
    {
        $oBrfPicture = SvenskBRF_BrfPicture::load(BrfPicture::create($this->_oBrf->getId(), FALSE, $a_sTitle, $a_sDescription, FALSE, NULL, TRUE));
        $oBrfPicture->setBrf($this->_oBrf);
        if (!$oBrfPicture->savePicture($_FILES[$a_sFileKey])) {
            $oBrfPicture->delete();
            return NULL;
        }
        return $oBrfPicture;
    }
    
    function hasUnregisteredMembers()
    {
        $bReturn = FALSE;
        $oUsers = new SvenskBRF_User_Collection(self::$_oUserAccessor->getUsersByBrfId($this->_oBrf->getId()));
        foreach ($oUsers as $oUser) {
            if ($oUser->isMember() && !$oUser->isRegistered()) {
                $bReturn = TRUE;
                break;
            }
        }
        return $bReturn;
    }
 
    
    function addAddress($a_sAddress, $a_sStreetNumber, $a_sStreetNumber2, $a_iZip, $a_sPostalAddress, $a_bEvenNumbers = FALSE, $a_bOddNumbers = FALSE) 
    {
        $oBrfAddress = BrfAddress::create($this->_oBrf->getId(), $a_sAddress, ($a_sStreetNumber ? $a_sStreetNumber : NULL), ($a_sStreetNumber && $a_sStreetNumber2 ? $a_sStreetNumber2 : NULL), $a_iZip, $a_sPostalAddress, $a_bEvenNumbers, $a_bOddNumbers, TRUE);
        $this->_oBrf->getBrfAddressCollection()->addObject($oBrfAddress);
    }
    
    function savePictureArray($a_aFileData, $a_sTitle = '', $a_sDescription = '', $a_bFront = TRUE) 
    {
        $oBrfPicture = SvenskBRF_BrfPicture::load(BrfPicture::create($this->_oBrf->getId(), $a_bFront, $a_sTitle, $a_sDescription, FALSE, NULL, TRUE));
        $oBrfPicture->setBrf($this->_oBrf);
        if (!$oBrfPicture->savePicture($a_aFileData)) {
            $oBrfPicture->delete();
            return NULL;
        }
        return $oBrfPicture;
    }
    
    /**
     *
     * @var Brf
     */
    private $_oBrf;
    
    /**
     *
     * @param Brf $a_oBrf 
     * @return SvenskBRF_Brf
     */
    private function __construct(Brf $a_oBrf)
    {
        $this->_oBrf = $a_oBrf;
    }
    
    function createCalendarDay($a_sDate, $a_sTime, $a_sEndTime, $a_sHeader, $a_sText, $a_bIsBoard = FALSE, $a_bSmsReminder = FALSE, $a_sSmsText = NULL)
    {
        $oCalendar = Calendar::create($this->_oBrf->getId(), $a_sHeader, $a_sText, "$a_sDate $a_sTime:00", "$a_sDate $a_sEndTime", $a_bIsBoard, TRUE);
        if ($a_bSmsReminder && $a_sSmsText) {
            SvenskBRF_Notice::queueCalendarSms($oCalendar, $a_sSmsText, SvenskBRF_User::getUsersByBrfId($this->_oBrf->getId()), $a_bIsBoard);
        }
    }
    
    
    /**
     * Call the domain object.
     *
     * @param string $a_sMethod
     * @param array $a_aArguments
     * @return mixed 
     */
    function __call($a_sMethod, array $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oBrf, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     * @param Brf $a_oBrf
     * @return SvenskBRF_Brf
     */
    public static function load(Brf $a_oBrf)
    {
        return new self($a_oBrf);
    }
    
    /**
     *
     * @return Collection
     */
    function getBrfAddresses()
    {
        return $this->_oBrf->getBrfAddressCollection();
    }
    
    /**
     *
     * @param BrfAddress|NULL $a_oBrfAddress 
     * @return string
     */
    function formatBrfAddress(BrfAddress $a_oBrfAddress = NULL, $a_bExcludePostAddress = FALSE)
    {
        $sAddress = "";
        if ($a_oBrfAddress) {
            $sAddress .= $a_oBrfAddress->getAddress();
            if ($a_oBrfAddress->getStreetNumber()) {
                $sAddress .= " " . $a_oBrfAddress->getStreetNumber();
            }
            if ($a_oBrfAddress->getStreetNumber2()) {
                $sAddress .= "-" . $a_oBrfAddress->getStreetNumber2();
            }
            if (!$a_bExcludePostAddress) {
                $sAddress .= " " . $a_oBrfAddress->getZip();
                $sAddress .= " " . $a_oBrfAddress->getPostalAddress();
            }
        } else {
            $sAddress .= $this->_oBrf->getAddress();
            if ($this->_oBrf->getStreetNumber()) {
                $sAddress .= " " . $this->_oBrf->getStreetNumber();
            }
            if ($this->_oBrf->getStreetNumber2()) {
                $sAddress .= "-" . $this->_oBrf->getStreetNumber2();
            }
            if (!$a_bExcludePostAddress) {
                $sAddress .= " " . $this->_oBrf->getZip();
                $sAddress .= " " . $this->_oBrf->getPostalAddress();
            }
        }
        return $sAddress;
    }
    
    function isBoxAddress(BrfAddress $a_oAddress = NULL)
    {
        $sAddressString = $a_oAddress ? $a_oAddress->getAddress() : $this->_oBrf->getAddress();
        return (bool) preg_match("/^[Bb]ox [0-9]+$/", $sAddressString);
    }
    
    
    /**
     *
     * @param string $a_sUrl 
     * @return SvenskBRF_Brf
     */
    public static function loadByUrl($a_sUrl)
    {
        $oBrfs = self::$_oBrfAccessor->getBrfsByUrl($a_sUrl);
        return $oBrfs->size() ? self::load($oBrfs->current()) : NULL;
    }
    
    /**
     *
     * @param string $a_sUrl 
     * @return SvenskBRF_Brf
     */
    public static function loadByGovernmentNumber($a_sGovernmentNumber)
    {
        $oBrfs = self::$_oBrfAccessor->getBrfsByGovernmentNumber($a_sGovernmentNumber);
        return $oBrfs->size() ? self::load($oBrfs->current()) : NULL;
    }
    
    /**
     *
     * @param id $a_iId
     * @return SvenskBRF_Brf
     */
    public static function loadById($a_iId)
    {
        $oBrf = self::$_oBrfAccessor->getById($a_iId);
        return $oBrf ? self::load($oBrf) : NULL;
    }
    
    public static function activate($a_sName, $a_sEmail, $a_sPhone, $a_bIsOnBoard)
    {
        // log the activation
        
    }
    
    public function getResources()
    {
        return $this->_oBrf->getResourceCollection();
    }
    
    public function createResource($a_sResourceBookingType, $a_iStartTime, $a_iEndTime, $a_iInterval, $a_sDescription, $a_sName, array $a_aDays, $a_iAdvanceBookings)
    {
        $oResourceType = NULL;
        if (($oResourceTypes = self::$_oResourceTypeAccessor->getResourceTypesByTypeName(trim($a_sResourceBookingType))) && $oResourceTypes->size() == 1) {
            $oResourceType = $oResourceTypes->current();
        } 
        if (!$oResourceType) {
            $oResourceTypes = self::$_oResourceTypeAccessor->getAll();
            $sText = $oResourceTypes->current()->getInstructionText();
            $oResourceType = ResourceType::create(trim($a_sResourceBookingType), $sText, TRUE);
        }

        // create resource
        $oResource = Resource::create($this->_oBrf->getId(), $oResourceType->getId(), $a_iStartTime, $a_iEndTime, $a_iInterval, $a_sDescription, "", $a_iAdvanceBookings == -1 ? NULL : $a_iAdvanceBookings, TRUE);
        $oResource->setBrf($this->_oBrf);
        
        // set resource name
        if ($a_sName) {
            $oResource->setName($this->_getResourceName($oResource, $a_sName));
        } else {
            // no name entered
            $oResource->setName($this->_getResourceName($oResource, $oResourceType->getTypeName()));
        }
        
        $this->_oBrf->getResourceCollection()->addObject($oResource);
        
        $aDays = array_keys($a_aDays);
        sort($aDays);
        if (count($aDays) && $aDays[0] == 0) {
            array_shift($aDays);
            $aDays[] = 0;
        }
        foreach ($aDays as $iDay) {
            ResourceDay::create($oResource->getId(), $iDay);
        }
        
        return $oResource;
    }
    
    /**
     *
     * @return Collection
     */
    public static function getResourceTypes()
    {
        return self::$_oResourceTypeAccessor->getAll();
    }
    
    /**
     * @param type $a_iResourceId
     * @param type $a_sResourceBookingType
     * @param type $a_iStartTime
     * @param type $a_iEndTime
     * @param type $a_iInterval
     * @param type $a_sDescription
     * @param type $a_sName
     * @param array $a_aDays 
     * @return bool
     */
    public function saveResource($a_iResourceId, $a_sResourceBookingType, $a_iStartTime, $a_iEndTime, $a_iInterval, $a_sDescription, $a_sName, array $a_aDays, $a_iAdvanceBookings)
    {
        $oResource = self::$_oResourceAccessor->getById($a_iResourceId);
        self::$_oResourceTypeSelector->setTypeName($a_sResourceBookingType);
        $oResourceType = self::$_oResourceTypeAccessor->readOne(self::$_oResourceTypeSelector);
        if (!$oResourceType) {
            $oResourceTypes = self::$_oResourceTypeAccessor->getAll();
            $sText = $oResourceTypes->current()->getInstructionText();
            $oResourceType = ResourceType::create($a_sName, $sText, TRUE);
        }
        $oResource->setResourceTypeId($oResourceType->getId());
        if ($a_sName) {
            $oResource->setName($this->_getResourceName($oResource, $a_sName));
        } else {
            $oResource->setName($this->_getResourceName($oResource, $oResourceType->getTypeName()));
        }
        $oResource->setResourceType($oResourceType);
        $oResource->setOpenHour((int) $a_iStartTime);
        $oResource->setCloseHour((int) $a_iEndTime);
        $oResource->setInterval($a_iInterval);
        $oResource->setDescription($a_sDescription);
        $oResource->setAdvanceBookings($a_iAdvanceBookings == -1 ? NULL : $a_iAdvanceBookings);
        
        // count days
        $oResourceDays = $oResource->getResourceDayCollection();
        $aDays = array_keys($a_aDays);
        sort($aDays);
        if (count($aDays) && $aDays[0] == 0) {
            array_shift($aDays);
            $aDays[] = 0;
        }
        foreach ($aDays as $iDay) {
            if ($oResourceDays->valid()) {
                $oResourceDays->current()->setDay($iDay);
                $oResourceDays->next();
            } else {
                ResourceDay::create($oResource->getId(), $iDay);
            }
        }
        while ($oResourceDays->valid()) {
            $oResourceDays->current()->delete();
            $oResourceDays->next();
        }
        return $oResource;
    }
    
    /**
     * Validate the name.
     *
     * @param string $a_sResourceNameSuggestion 
     * @return string 
     */
    private function _getResourceName(Resource $a_oResource, $a_sNameSuggestion)
    {
        $a_oResource->setName($a_sNameSuggestion);
        $sUrlName = getResourceLink($a_oResource);
        $bNameFound = FALSE;
        $aNumbers = array();
        $oResources = self::$_oResourceAccessor->getResourcesByBrfId($this->_oBrf->getId());
        foreach ($oResources as $oResource) {
            if ($oResource->getId() != $a_oResource->getId()){
                $sOtherUrlName = getResourceLink($oResource);
                $sOtherUrlName = preg_replace("/[0-9]+/", "", $sOtherUrlName);
                if ($sOtherUrlName == $sUrlName) {
                    $bNameFound = TRUE;
                    if (preg_match("/^(.*) \#([0-9])+$/", $oResource->getName(), $aMatches)) {
                        $aNumbers[] = $aMatches[2];
                    } 
                }
            }
        }
        if ($bNameFound) {
            $iNumber = 2;
            while (in_array($iNumber, $aNumbers)) {
                $iNumber++;
            }
            $sNewName = preg_replace("/ \#[0-9]+/", "", $a_sNameSuggestion);
            return "$sNewName #$iNumber";
        } else {
            return $a_sNameSuggestion;
        }
    }
    
    public function getCalendarEvents($a_iNumberOfEvents = 3, $a_bIsBoard = FALSE, $a_bBoth = FALSE)
    {
        self::$_oCalendarSelector->setBrfId($this->_oBrf->getId());
        if (!$a_bBoth || !$a_bIsBoard) {
            self::$_oCalendarSelector->setIsBoard($a_bIsBoard);
        }
        self::$_oCalendarSelector->setSearchParameter('`when`', date('Y-m-d'), Selector::CONDITION_GTE);
        if ($a_iNumberOfEvents > 0) {
            self::$_oCalendarSelector->limit($a_iNumberOfEvents);
        }
        self::$_oCalendarSelector->setOrderBy('`when` ASC');
        return self::$_oCalendarAccessor->read(self::$_oCalendarSelector);
    }
    
    public function getResourceByName($a_sResourceName)
    {
        foreach ($this->getResources() as $oResource) {
            $sSwitch = switchCharacters($oResource->getName(), TRUE);
            if ($sSwitch == $a_sResourceName) {
                return $oResource;
            } elseif (str_replace("/", "-", $sSwitch) == $a_sResourceName) {
                return $oResource;
            }
        }
        return NULL;
    }
    
    public function getResourceById($a_iResourceId)
    {
        $oResources = $this->getResources();
        foreach ($oResources as $oResource) {
            if ($a_iResourceId == $oResource->getId()) {
                return $oResource;
            }
        }
        return NULL;
    }
    
    public function sendRegisterInstructions()
    {
        self::$_oWebformActivationSelector->setInstructionsSent(FALSE);
        self::$_oWebformActivationSelector->setBrfId($this->_oBrf->getId());
        self::$_oWebformActivationSelector->setOrderBy('sent_on DESC');
        self::$_oWebformActivationSelector->limit(1);
        if (($oWebForm = self::$_oWebformActivationAccessor->readOne(self::$_oWebformActivationSelector))) {
            SvenskBRF_Notice::sendRegisterInstructions($oWebForm);
        }
    }
    
    
    
    function getMessagePictureLocation(SvenskBRF_Message $a_oMessage, $a_sImageType) 
    {
        $sImageUrl = './media/inloggad/msgpictures/' . $this->_oBrf->getUrl() . '/' . $a_oMessage->getMessageLink() . '.' . $a_sImageType;
        return $sImageUrl;
    }
    
    public function getRealtorUser()
    {
        $oRealtorUser = $this->_oBrf->getRealtorUser();
        $oRealtorUserDomain = NULL;
        if ($oRealtorUser) {
            $oRealtorUserDomain = SvenskBRF_User::load($oRealtorUser);
        }
        return $oRealtorUserDomain;
    }
    
    /**
     *
     * @return SvenskBRF_BrfPicture_Collection 
     */
    public function getPictures()
    {
        $oPictures = self::$_oBrfPictureAccessor->getBrfPicturesByBrfId($this->_oBrf->getId());
        return new SvenskBRF_BrfPicture_Collection($oPictures);
    }
    
    /**
     *
     * @return SvenskBRF_BrfPicture_Collection 
     */
    public function getFrontPictures()
    {
        self::$_oBrfPictureSelector->setBrfId($this->_oBrf->getId());
        self::$_oBrfPictureSelector->setFront(TRUE);
        return new SvenskBRF_BrfPicture_Collection(self::$_oBrfPictureAccessor->read(self::$_oBrfPictureSelector));
    }
    
    /**
     *
     * @return SvenskBRF_Document_Collection 
     */
    public function getPublicDocuments($a_iDocumentTypeId = FALSE)
    {
        self::$_oDocumentSelector->setBrfId($this->_oBrf->getId());
        self::$_oDocumentSelector->setIsBoard(FALSE);
        self::$_oDocumentSelector->setIsPresident(FALSE);
        if ($a_iDocumentTypeId) {
            self::$_oDocumentSelector->setDocumentTypeId($a_iDocumentTypeId);
        }
        self::$_oDocumentSelector->setIsPublic(TRUE);
        $oDocumentCollection = new SvenskBRF_Document_Collection(self::$_oDocumentAccessor->read(self::$_oDocumentSelector));
        return $oDocumentCollection;
    }
    
    /**
     *
     * @return SvenskBRF_Document_Collection 
     */
    public function getDocuments($a_iDocumentTypeId = FALSE, $a_bBoardDocuments = FALSE, $a_bPresidentDocuments = FALSE)
    {
        self::$_oDocumentSelector->setBrfId($this->_oBrf->getId());
        self::$_oDocumentSelector->setIsBoard($a_bBoardDocuments);
        self::$_oDocumentSelector->setIsPresident($a_bPresidentDocuments);
        if ($a_iDocumentTypeId) {
            self::$_oDocumentSelector->setDocumentTypeId($a_iDocumentTypeId);
        } else {
            // not arkiv...
            //self::$_oDocumentSelector->setSearchParameter('document_type_id', array(9), Selector::CONDITION_NOT_IN);
        }
        $oDocumentCollection = new SvenskBRF_Document_Collection(self::$_oDocumentAccessor->read(self::$_oDocumentSelector));
        return $oDocumentCollection;
    }
    
    /**
     * @return Collection 
     */
    public function getPublicDocumentTypes()
    {
        $oDocumentTypes = new Collection();
        $oPublicDocuments = $this->getPublicDocuments();
        $aPublicDocumentTypes = array();
        foreach ($oPublicDocuments as $oPublicDocument) {
            if (!in_array($oPublicDocument->getDocumentType()->getId(), $aPublicDocumentTypes)) {
                $aPublicDocumentTypes[] = $oPublicDocument->getDocumentType()->getId();
                $oDocumentTypes->addObject($oPublicDocument->getDocumentType());
            }
        }
        return $oDocumentTypes;
    }
    
    /**
     * @return Collection 
     */
    public function getDocumentTypes($a_bBoardDocuments = FALSE)
    {
        $oDocumentTypes = new Collection();
        $oPublicDocuments = $this->getDocuments(FALSE, $a_bBoardDocuments);
        $aPublicDocumentTypes = array();
        foreach ($oPublicDocuments as $oPublicDocument) {
            if (!$oPublicDocument->getDocumentType()) {
                $oPublicDocument->setDocumentType(self::$_oDocumentTypeAccessor->getById($oPublicDocument->getDocumentTypeId()));
            }
            if (!in_array($oPublicDocument->getDocumentType()->getId(), $aPublicDocumentTypes)) {
                $aPublicDocumentTypes[] = $oPublicDocument->getDocumentType()->getId();
                $oDocumentTypes->addObject($oPublicDocument->getDocumentType());
            }
        }
        return $oDocumentTypes;
    }
    
    /**
     *
     * @param string $a_sUrl 
     */
    function setUrl($a_sUrl, $a_bPreserveUrl = FALSE)
    {
        if ($a_sUrl && $this->_oBrf->getUrl() && $a_sUrl != $this->_oBrf->getUrl()) {
            if (!$a_bPreserveUrl) {
                if (!file_exists("./../files/brfs/" . $a_sUrl)) {
                    rename("./../files/brfs/".$this->_oBrf->getUrl(), "./../files/brfs/".$a_sUrl);
                } else {
                    throw new SvenskBRFException("Could not rename " . $this->_oBrf->getUrl() . " to " . $a_sUrl . ". $a_sUrl already exists. #1");
                }
            } else {
                if (!file_exists("./../files/brfs/" . $a_sUrl)) {
                    @mkdir("./../files/brfs/" . $a_sUrl);
                    @mkdir("./../files/brfs/" . $a_sUrl . '/documents');
                    foreach (array('administration', 'arsredovisning', 'energideklaration', 'kalkyl', 'lokaler', 'maklarunderlag', 'ordningsregler', 'ovrigt', 'protokoll', 'stadgar', 'styrelselogg') as $sDirectory) {
                        @mkdir("./../files/brfs/" . $a_sUrl . '/documents/' . $sDirectory);
                    }
                    @mkdir("./../files/brfs/" . $a_sUrl . '/pictures');
                    @mkdir("./../files/brfs/" . $a_sUrl . '/pictures/brf');
                    @mkdir("./../files/brfs/" . $a_sUrl . '/pictures/message');
                } else {
                    throw new SvenskBRFException("Could not rename " . $this->_oBrf->getUrl() . " to " . $a_sUrl . ". $a_sUrl already exists. #2");
                }
            }
        }
        $this->_oBrf->setUrl($a_sUrl);
    }
    
    /**
     *
     * @param string $a_sRegisterCode 
     * @return SvenskBRF_Brf
     */
    public static function getByRegisterCode($a_sRegisterCode)
    {
        self::$_oBrfSettingSelector->setValue($a_sRegisterCode);
        $oBrfSetting = self::$_oBrfSettingAccessor->readOne(self::$_oBrfSettingSelector);
        if ($oBrfSetting) {
            return self::loadById($oBrfSetting->getBrfId());
        } else {
            return NULL;
        }
    }
    
    public function saveSetting($a_iSettingTypeId, $a_sValue)
    {
        $oBrfSetting = BrfSetting::create($this->_oBrf->getId(), $a_iSettingTypeId, $a_sValue, date('Y-m-d H:i:s'), TRUE);
        $oBrfSetting->setBrf($this->_oBrf);
    }
    
    /**
     *
     * 
     * @param type $a_iSettingTypeId
     * @return BrfSetting
     */
    function getSetting($a_iSettingTypeId)
    {
        self::$_oBrfSettingSelector->setBrfId($this->_oBrf->getId());
        self::$_oBrfSettingSelector->setSettingTypeId($a_iSettingTypeId);
        self::$_oBrfSettingSelector->limit(1);
        self::$_oBrfSettingSelector->setOrderBy('setting_time DESC');
        $oBrfSetting = self::$_oBrfSettingAccessor->readOne(self::$_oBrfSettingSelector);
        return $oBrfSetting ? $oBrfSetting->getValue() : NULL;
    }
    
    /**
     * 
     * @param int $a_iBrfId
     * @return bool
     */
    function getBrfViewSetting($a_iBrfId)
    {
        self::$_oBrfSettingSelector->setBrfId($this->_oBrf->getId());
        self::$_oBrfSettingSelector->setValue($a_iBrfId);
        self::$_oBrfSettingSelector->setSettingTypeId(self::BRF_SETTING_ID_SHOW_REALTOR_LIST);
        $oBrfSetting = self::$_oBrfSettingAccessor->readOne(self::$_oBrfSettingSelector);
        return $oBrfSetting;
    }
    
    function hasRealtorMaterial()
    {
        return $this->getDocuments(self::DOCUMENT_TYPE_ID_REALTOR_MATERIAL)->size() > 0;
    }
    
    /**
     *
     * @param SvenskBRF_User_Realtor $a_oRealtor 
     * @return array
     */
    public static function getBrfsForRealtor(SvenskBRF_User_Realtor $a_oRealtor)
    {
        self::$_oBrfSelector->setRealtorUserId($a_oRealtor->getId());
        $aBrfs = array();
        foreach (self::$_oBrfAccessor->read(self::$_oBrfSelector) as $oBrf) {
            $aBrfs[] = self::load($oBrf);
        }
        return $aBrfs;
    }
    
    /**
     *
     * @param bool $a_bIncludeBoard
     * @return Calendar
     */
    function getNewestCalendarEvent($a_bIncludeBoard = FALSE)
    {
        self::$_oCalendarSelector->setBrfId($this->_oBrf->getId());
        self::$_oCalendarSelector->setSearchParameter('DATE(`when`)', date('Y-m-d'), Selector::CONDITION_GTE);
        self::$_oCalendarSelector->limit(1);
        self::$_oCalendarSelector->setOrderBy('id DESC');
        if (!$a_bIncludeBoard) {
            self::$_oCalendarSelector->setIsBoard(FALSE);
        }
        $oCalendar = self::$_oCalendarAccessor->readOne(self::$_oCalendarSelector);
        return $oCalendar;
    }
    
      /**
     *
     * @param bool $a_bIncludeBoard
     * @return SvenskBRF_Message
     */
    function getLatestMessageBoardEntry()
    {
        self::$_oMessageSelector->setBrfId($this->_oBrf->getId());
        self::$_oMessageSelector->limit(1);
        self::$_oMessageSelector->setOrderBy('id DESC');
        
        $oMessage = self::$_oMessageAccessor->readOne(self::$_oMessageSelector);
        return $oMessage ? SvenskBRF_Message::load($oMessage) : NULL;
    }
    
    /**
     * @retrn array
     */
    public function getInactivatedFunctions()
    {
        $aMessages = array();
        $oUser = getUser();
        if ($oUser) {
            if (!$this->getResources()->size() && !$oUser->getSetting(self::BRF_SETTING_HIDE_RESOURCE_MESSAGE)) {
                $aMessages[self::BRF_SETTING_HIDE_RESOURCE_MESSAGE] = array(
                    'Bokningsbara utrymmen',
                    BASE_DIR . 'registrera/4'
                );
            }

            if (!$this->getDocumentTypes()->size() && !$oUser->getSetting(self::BRF_SETTING_HIDE_DOCUMENT_MESSAGE)) {
                $aMessages[self::BRF_SETTING_HIDE_DOCUMENT_MESSAGE] = array(
                    'Dokument för medlemmar',
                    BASE_DIR . $this->_oBrf->getUrl() . '/dokument/laddaupp/medlem'
                );
            }

            if (!$this->_oBrf->getPresentation() && !$oUser->getSetting(self::BRF_SETTING_HIDE_PRESENTATION_MESSAGE)) {
                $aMessages[self::BRF_SETTING_HIDE_PRESENTATION_MESSAGE] = array(
                    'Föreningens presentations-<br />text',
                    BASE_DIR . $this->_oBrf->getUrl() . '/admin/presentation'
                );
            }

            return $aMessages;
        }
    }
}

?>
