<?php

// definitions
define('LOGIN', '___LOGGEDIN___');
define('LOGINCOOKIE', '___LOGGEDINCCOKIE___');
define('BRF', '___BRF___');
define('ADMIN', '___ADMIN___');
define('USER', '___USER___');
define('CURRENT_PRESIDENT_LOG', '____cplog');
define('SAVED_LOGIN_URL', '___savedurl___');

function exitForLocation($a_sLocation = '', $a_sLocationBase = BASE_DIR)
{
    header('Location: ' . $a_sLocationBase . $a_sLocation);
    include 'unsetup.php';
    exit;
}

/**
 * @param SvenskBRF_User_Member $a_oUser
 * @param array $a_aUserLinkNames
 * @param string $a_iCounter
 * @return string
 */
function getUserLinkName(SvenskBRF_User_Member $a_oUser, &$a_aUserLinkNames, &$a_iCounter, array $a_aUsers = NULL)
{
    if (!$a_iCounter) {
        $a_iCounter = 1;
    }
    
    if (!is_array($a_aUserLinkNames)) {
        $a_aUserLinkNames = array();
    }
    
    if ($a_aUsers && count($a_aUsers)) {
        foreach ($a_aUsers as $oUser) {
            if ($oUser->getId() != $a_oUser->getId()) {
                getUserLinkName($oUser, $a_aUserLinkNames, $a_iCounter);
            }
        }
    }
    
    $sUserLinkName = switchCharacters($a_oUser->getName(), FALSE, TRUE);
    while (in_array($sUserLinkName, $a_aUserLinkNames)) {
        $sUserLinkName = preg_replace("/[0-9]/", "", $sUserLinkName) . $a_iCounter;
        $a_iCounter++;
    }
    $a_aUserLinkNames[] = $sUserLinkName;
    return $sUserLinkName;
}

function _realtorInfoMissing($a_sText = NULL)
{
    $sReturnString = "<span class=\"uppgift_saknas\">" . ($a_sText ? $a_sText : 'Uppgift saknas') . "</span>";
    return $sReturnString;
}

function getHeaderPicture($a_sLine1, $a_sLine2 = '', $a_sId = 'knapp', $a_iMarginLeft = -15, $a_iWidth = 300)
{
    if ($a_sLine2) {
        $a_sLine2 = '<br />' . $a_sLine2;
    }
    $sHeight = "";
    if ($a_sLine2) {
        $sHeight = "height: 50px;";
    }
    $sHeaderPicture = <<<HEADERPIC
<div class="headerPicture" id="$a_sId" style="background:#00a3ff; width:{$a_iWidth}px; $sHeight
     border-radius:2px; 
     -moz-box-shadow: 2px 2px 2px #ddd;
     -webkit-box-shadow: 2px 2px 2px #ddd;
     box-shadow: 2px 2px 2px #ddd; color:#fff; font-family: 'Open Sans', sans-serif; font-weight:lighter; font-size:23px; padding-top:4px; padding-right:10px; padding-bottom:12px; line-height:1.2em; text-align:right; margin-left:{$a_iMarginLeft}px; margin-top:20px;">$a_sLine1 $a_sLine2</div>  
HEADERPIC;
    return $sHeaderPicture;
}

function isBrfNameMultipleLine(SvenskBRF_Brf $a_oBrf, $a_iLength = 23)
{
    $bMultipleLine = FALSE;
    $aBrfNameParts = explode(' ', $a_oBrf->getName());
    if (count($aBrfNameParts) == 1 && strlen($aBrfNameParts[0]) >= $a_iLength) {
        $bMultipleLine = TRUE;
    } else if (count($aBrfNameParts) > 1) {
        $sBrfName = $a_oBrf->getName();
        /*for ($iNameIndex = 0; $iNameIndex < strlen($sBrfName); $iNameIndex++) {
            if ($sBrfName[$iNameIndex] === ' ') {
                
            } else {
                $iNameCounter++;
                if ($iNameCounter >= 19) {
                    $bMultipleLine = TRUE;
                    break;
                }
            }
        }*/
        if (strlen($sBrfName) >= $a_iLength) {
            $bMultipleLine = TRUE;
        }
    }
    return $bMultipleLine;
}

function login(SvenskBRF_User $a_oUser, $a_bRemember = FALSE) {
    if (!$a_oUser) {
        logout();
        return;
    }
    
    if ($a_bRemember) {
        setcookie(LOGINCOOKIE, $a_oUser->getLoginCookie(), time()+60*60*24*365);
    }

    $_SESSION[LOGIN] = 1;
    $_SESSION[USER] = $a_oUser->getId();
    $_SESSION[BRF] = $a_oUser->getBrfId();
}

function logout($a_bPassiveLogout = FALSE) {
    unset($_SESSION[LOGIN], $_SESSION[USER]);
    if (!$a_bPassiveLogout) {
        $_SESSION[BRF];
    }
    if (@$_COOKIE[LOGINCOOKIE]) {
        setcookie(LOGINCOOKIE, '');
    }
    
    if (!$a_bPassiveLogout) {
        @setcookie(session_name(), '');
    }
}

function getStreetData(SvenskBRF_Brf $a_oBrf)
{
    // get data from hitta.se
    $sStreetViewUrl = "http://static.hitta.se/streetview/v3/";
    $sNormalizedAddress = getNormalizedAddress($a_oBrf);
    $oResult = @json_decode(file_get_contents($sStreetViewUrl . $sNormalizedAddress));
    if ($a_oBrf->getUrl() == 'fornminnet') {
        //echo $sStreetViewUrl . $sNormalizedAddress;
    }
    $sStreetImageUrl = BASE_DIR . 'media/img/forening_bild.png';
    $iNorthCoordinate = 0;
    $iEastCoordinate = 0;
    $sHittaSeLink = "";
    if (!is_null($oResult)) {
        $sStreetImageUrl = $oResult->result->link[1]->uri;
        $iNorthCoordinate = $oResult->result->coordinate->north;
        $iEastCoordinate = $oResult->result->coordinate->east;
        $sHittaSeLink = $oResult->result->link[0]->uri;
        $aData = array(
            'image_url' => $sStreetImageUrl,
            'north' => $iNorthCoordinate,
            'east' => $iEastCoordinate,
            'link' => $sHittaSeLink
        );
        return $aData;
    } else {
        return array();
    }
}



function isLoggedIn() {
    return @$_SESSION[LOGIN];
}

/**
 *
 * @param type $a_iBrfId
 * @return SvenskBRF_Brf 
 */
function getBrf($a_iBrfId = FALSE) {
    if ($a_iBrfId) {
        return SvenskBRF_Brf::load(getBrfAccessor()->getById($a_iBrfId));
    } else {
        $b = BRF;
        return SvenskBRF_Brf::loadById(@$_SESSION[BRF]);
    }
}

/**
 *
 * @return SvenskBRF_User
 */
function getUser() {
    if (array_key_exists(USER, $_SESSION)) {
        $oUser = SvenskBRF_User::load(getUserAccessor()->getById($_SESSION[USER]));
        return $oUser;
    } else {
        return NULL;
    }
}

function getMonth($a_iMonth) {
    $aMonths = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Mars',
        4 => 'April',
        5 => 'Maj',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Augusti',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'December'
    );
    return $aMonths[$a_iMonth];
}

function getMonthLength($a_iYear, $a_iMonth) {
    if ($a_iMonth == 2 && ((($a_iYear % 4 == 0) && ($a_iYear % 100)) || $a_iYear % 400 == 0)) {
        return 29;
    } else {
        $aMonthLengths = array_combine(range(1, 12), array(
            31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31
                ));
        return $aMonthLengths[$a_iMonth];
    }
}

function getMonthReverse($a_sMonthName) {
    for ($iMonth = 1; $iMonth <= 12; $iMonth++) {
        if (getMonth($iMonth) === $a_sMonthName) {
            return $iMonth;
        }
    }
}

function isCalendarDay(Calendar $a_oCalendar, $a_iCalendarYear, $a_iCalendarMonth, $a_iCalendarDay)
{
    if (strlen($a_iCalendarMonth) == 1) {
        $a_iCalendarMonth = "0$a_iCalendarMonth";
    }
    if (strlen($a_iCalendarDay) == 1) {
        $a_iCalendarDay = "0$a_iCalendarDay";
    }
    $iCalendarTime = strtotime($a_oCalendar->getWhen());
    return date('Y-m-d', $iCalendarTime) == date("$a_iCalendarYear-$a_iCalendarMonth-$a_iCalendarDay");
}


/**
 * Find a message for the message view.
 *
 * @param string  $a_sLink
 * @return Message
 */
function getMessageByLink1($a_sLink) {
    if (preg_match("/([0-9]{4}-[0-9]{2}-[0-9]{2})-([0-9]{2}-[0-9]{2}-[0-9]{2})/", $a_sLink, $aMatches) && count($aMatches) == 3) {
        $sSender = str_replace("-", ' ', str_replace($aMatches[0], '', $a_sLink));
        $sSendTime = $aMatches[1] . ' ' . str_replace('-', ':', $aMatches[2]);

        $aNeighbors = getUser()->findNeighborByName($sSender);

        if (count($aNeighbors)) {
            $oMessageSelector = getMessageSelector();
            $oMessageSelector->setBrfId(getUser()->getBrfId());
            $oMessageSelector->setSendTime($sSendTime);
            $aNeighborIds = array();
            foreach ($aNeighbors as $oNeighbor) {
                $aNeighborIds[] = $oNeighbor->getId();
            }
            $oMessageSelector->setSearchParameter('sender_id', $aNeighborIds, Selector::CONDITION_IN);
            $oMessageCollection = getMessageAccessor()->read($oMessageSelector);
            if ($oMessageCollection->size() >= 1) {
                return $oMessageCollection->current();
            }
        }
    }

    return NULL;
}

function getResourceLink(Resource $a_oResource) {
    $sName = switchCharacters($a_oResource->getName(), TRUE);
    return str_replace("/", "-", $sName);
}

function getBookingString(Resource $a_oResource, $a_iBookingTime) {
    // Mån 4/3 7.00-10.00
    $sBooking = getShortDay(date('w', $a_iBookingTime));
    $sBooking .= " ";
    $sBooking .= date('j', $a_iBookingTime);
    $sBooking .= "/";
    $sBooking .= date('n', $a_iBookingTime);
    $sBooking .= " ";
    $sBooking .= date('H', $a_iBookingTime) . '.00';
    $sBooking .= "-";
    $sBooking .= date('H', $a_iBookingTime + $a_oResource->getInterval() * 3600) . '.00';
    return $sBooking;
}

function getSwitchCharacters() {
    $aSwitchCharacters = array_combine(
        array(
            'å',
            'ä',
            'ö',
            'ë',
            'è',
            'é',
            'ü',
            'Å',
            'Ä',
            'Ö',
            'É',
            'È',
            'Ü'
        ), array(
            'a',
            'a',
            'o',
            'e',
            'e',
            'e',
            'u',
            'A',
            'A',
            'O',
            'E',
            'E',
            'U'
        )
    );
    return $aSwitchCharacters;
}

function rrmdir($dir) 
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir")
                    rrmdir($dir . "/" . $object);
                else
                    unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}


/**
 * Replace å,ä,ö etc.
 * 
 * If resourceName, then replace " ", and #
 * 
 * If realUserRealName, then to lower and no numbers
 * 
 * @param type $a_sString
 * @param type $a_bResourceName
 * @param type $a_bUserRealName
 * @return type 
 */
function switchCharacters($a_sString, $a_bResourceName = FALSE, $a_bUserRealName = FALSE) {
    
    $aSwitchCharacters = getSwitchCharacters();
    $sSwitched = str_replace(
        array_keys($aSwitchCharacters),
        array_values($aSwitchCharacters)
    , $a_sString);
    if ($a_bResourceName || $a_bUserRealName) {
        $sSwitched = preg_replace("/[^A-Za-z0-9]/", "", $sSwitched);
        if ($a_bUserRealName) {
            $sSwitched = strtolower($sSwitched);
            $sSwitched = preg_replace("/[0-9]/", "", $sSwitched);
        }
    }
    return $sSwitched;
}

/**
 *
 * 
 * @param ResourceBooking $a_oResourceBooking 
 * @return string
 */
function getResourceBookingTimeFormat(ResourceBooking $a_oResourceBooking) {
    // make it readable
    $iStartTime = strtotime($a_oResourceBooking->getStart());
    $sReadable = "";

    $sReadable .= getShortDay(date('w', $iStartTime)) . " "; // weekday
    $sReadable .= date('j', $iStartTime) . "/" . date('n', $iStartTime) . " "; // date
    $sReadable .= substr($a_oResourceBooking->getStart(), 11, 5) . "-" . substr($a_oResourceBooking->getEnd(), 11, 5); // time
    return $sReadable;
}

/**
 *
 * 
 * @param ResourceBooking $a_oResourceBooking 
 * @return string
 */
function getResourceBookingTimeFormatMainViewFirstPart(ResourceBooking $a_oResourceBooking) {
    // make it readable
    $iStartTime = strtotime($a_oResourceBooking->getStart());
    $sReadable = "";
    $sReadable .= getDay(date('w', $iStartTime)) . " "; // weekday
    $sReadable .= date('j', $iStartTime) . " " . getMonthShort(date('n', strtotime($a_oResourceBooking->getStart())));
    return $sReadable;
}

function getDaySlashMonth($a_sTimestamp)
{
    $iTime = strtotime($a_sTimestamp);
    return date('d/n', $iTime);
}

/**
 * Returns e.g. 18:00-21:00
 *
 * @param ResourceBooking $a_oResourceBooking
 * @return string 
 */
function getResourceBookingTimeFormatMainViewSecondPart(ResourceBooking $a_oResourceBooking) {
    $sReadable = substr($a_oResourceBooking->getStart(), 11, 5) . "-" . substr($a_oResourceBooking->getEnd(), 11, 5); // time
    return $sReadable;
}

function getResourceBookingTimeFormatMainViewSecondPartNoZeros(ResourceBooking $a_oResourceBooking)
{
    $sTime = getResourceBookingTimeFormatMainViewSecondPart($a_oResourceBooking);
    return str_replace("-00", "-24", preg_replace("/\:00/", "", $sTime));
}

function getMonthShort($a_iMonth) {
    return substr(getMonth($a_iMonth), 0, 3);
}

function getDay($a_iWeekDay, $a_bHTML = TRUE) {
    $aWeekDays = array(
        0 => $a_bHTML ? 'S&ouml;ndag' : 'Söndag',
        1 => $a_bHTML ? 'M&aring;ndag' : 'Måndag',
        2 => 'Tisdag',
        3 => 'Onsdag',
        4 => 'Torsdag',
        5 => 'Fredag',
        6 => $a_bHTML ? 'L&ouml;rdag' : 'Lördag'
    );
    return $aWeekDays[$a_iWeekDay];
}

function getHour($a_iHour)
{
    return strlen($a_iHour) == 1 ? "0$a_iHour" : $a_iHour;
}

function getShortDay($a_iWeekDay) {
    if (in_array($a_iWeekDay, array(0, 1, 6))) {
        return substr(getDay($a_iWeekDay), 0, 3 + ($a_iWeekDay % 2 ? 6 : 5));
    } else {
        return substr(getDay($a_iWeekDay), 0, 3);
    }
}

function getReadableDate($a_sDateString) {
    $iTime = strtotime($a_sDateString);
    $sWeekDay = getDay(date('w', $iTime));
    $sDay = date('j', $iTime);
    $sMonth = getMonthShort(date('n', $iTime));
    return "$sWeekDay $sDay $sMonth";
}

function getReadableDateAndTime($a_sDateString) {
    $iTime = strtotime($a_sDateString);
    $sTime = date('H:i', $iTime);
    return "$sTime " . getReadableDate($a_sDateString);
}



/**
 * Convert to readable image data.
 * 
 * @param string $a_sContents
 * @param string $a_sMime
 * @return string 
 */
function getDataUri($a_sContents, $a_sMimeType) {
    $sBase64 = base64_encode($a_sContents);
    return ('data:' . $a_sMimeType . ';base64,' . $sBase64);
}



/**
 * Parse data from hitta.se's service.
 *
 * @param object $a_oData 
 * @return array
 */
function getBranchData($a_oData, array $a_aBranches, $iHomeNorthCoordinate, $iHomeEastCoordinate) {
    // no data?
    if (empty($a_oData) || $a_oData->result->companies->total == 0) {
        return array();
    }

    $aResults = array();
    foreach ($a_oData->result->companies->company as $oCompany) {
        $aEstablishmentData = array();
        foreach ($oCompany->trade as $oTrade) {
            $iTradeId = 0;
            if (in_array($oTrade->id, array_keys($a_aBranches)) && @count($aResults[$oTrade->id]) < 3) {
                $aEstablishmentData = array(
                    'name' => $oCompany->displayName,
                    'distance' => round(sqrt(pow(abs($iHomeEastCoordinate - $oCompany->address[0]->coordinate->east), 2) + pow(abs($iHomeNorthCoordinate - $oCompany->address[0]->coordinate->north), 2)))
                );
                if (property_exists($oCompany, 'link') && is_array($oCompany->link) && count($oCompany->link) && property_exists($oCompany->link[0], 'url')) {
                    $aEstablishmentData['link'] = $oCompany->link[0]->url;
                    if (strpos($aEstablishmentData['link'], 'http://') === FALSE) {
                        $aEstablishmentData['link'] = "http://" . $aEstablishmentData['link'];
                    }
                }
                
                $iTradeId = $oTrade->id;
            } elseif (!in_array($oTrade->id, array_keys($a_aBranches))) {
                // check exkluces
                foreach ($a_aBranches as $aConfiguration) {
                    if (in_array($oTrade->id, $aConfiguration['exclude'])) {
                        continue 3;
                    }
                }
            }
            if (count($aEstablishmentData) && $iTradeId) {
                if (array_key_exists($iTradeId, $aResults)) {
                    $bSkip = FALSE;
                    foreach ($aResults[$iTradeId] as $aStoredBranchData) {
                        if ($aStoredBranchData['name'] === $aEstablishmentData['name']) {
                            if ($aEstablishmentData['distance'] < $aStoredBranchData['distance']) {
                                $aStoredBranchData['distance'] = $aEstablishmentData['distance'];
                                if ($aEstablishmentData['link']) {
                                    $aStoredBranchData['link'] = $aEstablishmentData['link'];
                                } else if ($aStoredBranchData['link']) {
                                    unset($aStoredBranchData['link']);
                                }
                                
                            }
                            $bSkip = TRUE;
                        }
                    }
                    if (!$bSkip) {
                        $aResults[$iTradeId][] = $aEstablishmentData;
                    }
                } else {
                    $aResults[$iTradeId][] = $aEstablishmentData;
                }
            }
        }
        
    }
    return $aResults;
}

/**
 * Normalize address for hitta.se's service.
 *
 * @param Brf $a_oBrf 
 * @return string
 */
function getNormalizedAddress(SvenskBRF_Brf $a_oBrf) {
    $sBaseAddress = ($a_oBrf->getAddress());
    
    if ($a_oBrf->getStreetNumber()) {
        $sBaseAddress .= ' ' . $a_oBrf->getStreetNumber();
    }
    $sBaseAddress .= $a_oBrf->getPostalAddress();
    $sAddressString = strtolower(str_replace(array('å', 'ä', 'ö', 'é', 'ü', ' ','Å','Ä','Ö'), array('oe', 'ae', 'oo', 'ee', 'uu', '', 'oe', 'ae', 'oo'), $sBaseAddress));
    return $sAddressString;
}


function saveArsredovisning(SvenskBRF_Brf $a_oBrf, array $a_aFileData, $a_iYear)
{
    if (@$a_aFileData['error'] === UPLOAD_ERR_OK && in_array($a_aFileData['type'], array('application/pdf'))) {
        $cwd = getcwd();
        move_uploaded_file($a_aFileData['tmp_name'], "./pdf/" . $a_oBrf->getUrl() . "/arsredovisningar/$a_iYear.pdf");
        
        return TRUE;
    }
    return FALSE;
}

function saveEnergideklaration(SvenskBRF_Brf $a_oBrf, array $a_aFileData)
{
    if (@$a_aFileData['error'] === UPLOAD_ERR_OK && in_array($a_aFileData['type'], array('application/pdf'))) {
        move_uploaded_file($a_aFileData['tmp_name'], "./pdf/" . $a_oBrf->getUrl() . "/energideklaration/energideklaration.pdf");
        return TRUE;
    }
    return FALSE;
}

function getFormatedMonth($a_iMonth) 
{
    return strlen($a_iMonth) == 2 ? $a_iMonth : "0$a_iMonth";
}

function getFormattedHour($a_iHour) 
{
    if (strlen($a_iHour) == 1) {
        return "0$a_iHour";
    } else {
        return $a_iHour;
    }
}

function saveStadgar(SvenskBRF_Brf $a_oBrf, array $a_aFileData)
{
    if (@$a_aFileData['error'] === UPLOAD_ERR_OK && in_array($a_aFileData['type'], array('application/pdf'))) {
        move_uploaded_file($a_aFileData['tmp_name'], "./pdf/" . $a_oBrf->getUrl() . "/stadgar/stadgar.pdf");
        return TRUE;
    }
    return FALSE;
}

?>
