<?php

/**
 * Description of User
 *
 * @author John Jansson
 */
abstract class SvenskBRF_User extends SvenskBRF_HasPicture 
{
    /**
     * 
     * @var int
     */
    const SYSTEM_USER_ID = 1366;
    
    /**
     * 
     * @var int
     */
    const BLOCK_REALTOR_MESSAGE_SETTING_ID = 16;
    
    /**
     * @param int $a_iBookingtTime
     * @param Resource $a_oResource
     * @return SvenskBRF_User_Member
     */
    public static function getBookedUser(Resource $a_oResource, $a_iBookingtTime)
    {
        self::$_oResourceBookingSelector->setResourceId($a_oResource->getId());
        self::$_oResourceBookingSelector->setStart(date('Y-m-d H:i:s', $a_iBookingtTime));
        $oResourceBooking = self::$_oResourceBookingAccessor->readOne(self::$_oResourceBookingSelector);
        if ($oResourceBooking) { 
            $oUser = SvenskBRF_User::loadById($oResourceBooking->getUserId());
            return $oUser;
        }
        return NULL;
    }
    
    /**
     * 
     * @param type $a_iSettingTypeId
     * @param type $a_sValue
     */
    public function saveSetting($a_iSettingTypeId, $a_sValue)
    {
        $oUserSetting = UserSetting::create($this->_oUser->getId(), $a_iSettingTypeId, $a_sValue, date('Y-m-d H:i:s'), TRUE);
        $oUserSetting->setUser($this->_oUser);
    }
    
    /**
     *
     * 
     * @param type $a_iSettingTypeId
     * @return UserSetting
     */
    function getSetting($a_iSettingTypeId)
    {
        self::$_oUserSettingSelector->setUserId($this->_oUser->getId());
        self::$_oUserSettingSelector->setSettingTypeId($a_iSettingTypeId);
        self::$_oUserSettingSelector->limit(1);
        self::$_oUserSettingSelector->setOrderBy('setting_time DESC');
        $oUserSetting = self::$_oUserSettingAccessor->readOne(self::$_oUserSettingSelector);
        return $oUserSetting ? $oUserSetting->getValue() : NULL;
    }
    
    /**
     * Save from register form
     *
     * @param array $a_aUserData
     * @param array $a_aPictureData
     * @param type $a_bExisting 
     */
    public static function saveUser(array $a_aUserData, array $a_aPictureData, SvenskBRF_User $a_oUser = NULL, SvenskBRF_User $a_oParentMember = NULL)
    {
        $bTitle = FALSE;
        if (array_key_exists('TitleId', $a_aUserData)) {
            if (!is_numeric($a_aUserData['TitleId'])) {
                // create a new title
                $oUTs = getUserTitleAccessor()->getUserTitlesByTitleName($a_aUserData['OwnTitle']);
                if (!$oUTs->size()) {
                    $oUserTitle = UserTitle::create($a_aUserData['OwnTitle'], TRUE);
                    $a_aUserData['TitleId'] = $oUserTitle->getId();
                }
            } else if (array_key_exists('OwnTitle', $a_aUserData) && !$a_aUserData['OwnTitle']) {
                $a_aUserData['TitleId'] = NULL;
            }
            $bTitle = TRUE;
        }
        $iUserType = self::USER_TYPE_MEMBER;
        if (array_key_exists('userType', $a_aUserData)) {
            $iUserType = $a_aUserData['userType'];
            unset($a_aUserData['userType']);
        }
        
        $oBrfUser = $a_oUser;
        if (!$oBrfUser) {
            if (!$a_oParentMember) {
                $oBrfUser = self::load(User::create(
                        $iUserType,
                        $a_aUserData['BrfId'], 
                        $a_aUserData['Username'][0], 
                        $a_aUserData['Password'][0], 
                        trim($a_aUserData['Firstname'] . ' ' . $a_aUserData['Surname']), 
                        $a_aUserData['ApartmentNumber'] ? $a_aUserData['ApartmentNumber'] : NULL, 
                        $a_aUserData['ApartmentNumber2'] ? $a_aUserData['ApartmentNumber2'] : NULL,
                        $a_aUserData['Email'][0], 
                        $a_aUserData['Phone'],
                        FALSE, // admin
                        NULL, // external partner id
                        FALSE, // has picture
                        NULL, // picture type
                        $a_aUserData['Presentation'] ? $a_aUserData['Presentation'] : NULL, 
                        is_numeric($a_aUserData['Age']) && ((int)$a_aUserData['Age']) > 0 ? ((int) $a_aUserData['Age']) : NULL, 
                        $a_aUserData['LivesWith'] ? $a_aUserData['LivesWith'] : NULL, 
                        (bool) $a_aUserData['HidePhone'],
                        @$a_aUserData['TitleId'] ? $a_aUserData['TitleId'] : NULL,
                        SvenskBRF_User::generatePassword(32), /// login cookie
                        $a_aUserData['Floor'] ? $a_aUserData['Floor'] : NULL,
                        $a_aUserData['AddressId'] ? $a_aUserData['AddressId'] : NULL,
                        FALSE, // is_registered
                        TRUE,
                        NULL,
                        NULL,
                        TRUE
                ));
            } else {
                $oBrfUser = self::load(User::create(
                        self::USER_TYPE_MEMBER, 
                        $a_aUserData['BrfId'], 
                        $a_aUserData['Username'][0], 
                        $a_aUserData['Password'][0], 
                        $a_aUserData['Firstname'] . ' ' . $a_aUserData['Surname'], 
                        $a_oParentMember->getApartmentNumber(),
                        $a_oParentMember->getApartmentNumber2(),
                        $a_aUserData['Email'][0], 
                        $a_aUserData['Phone'][0],
                        FALSE, // admin
                        NULL, // external partner id
                        FALSE, // has picture
                        NULL, // picture type
                        $a_aUserData['Presentation'] ? $a_aUserData['Presentation'] : NULL, 
                        is_numeric($a_aUserData['Age']) && ((int)$a_aUserData['Age']) > 0 ? ((int) $a_aUserData['Age']) : NULL, 
                        $a_aUserData['LivesWith'] ? $a_aUserData['LivesWith'] : NULL, 
                        (bool) $a_aUserData['HidePhone'],
                        @$a_aUserData['TitleId'] ? $a_aUserData['TitleId'] : NULL,
                        SvenskBRF_User::generatePassword(32), /// login cookie
                        $a_oParentMember->getFloor(),
                        $a_oParentMember->getAddressId(),
                        FALSE, // is_registered
                        FALSE,
                        $a_oParentMember->getId(),
                        $a_oParentMember->getAddressNumber(),
                        TRUE
                ));
                if ($a_aPictureData) {
                    $oBrfUser->savePicture($a_aPictureData);
                }
            }
        } else {
            // fix properties
            $a_aUserData['Name'] = $a_aUserData['Firstname'] . ' ' . $a_aUserData['Surname'];
            $a_aUserData['Cellphone'] = $a_aUserData['Phone'];
            if ($bTitle) {
                $iTitleId = $a_aUserData['TitleId'];
                unset($a_aUserData['TitleId']);
                $a_aUserData['UserTitleId'] = $iTitleId;
                unset($a_aUserData['OwnTitle']);
            }
            
            $aSettings = @$a_aUserData['setting'];
            if (is_array($aSettings)) {
                foreach ($aSettings as $iSettingTypeId => $sValue) {
                    $oBrfUser->saveSetting($iSettingTypeId, $sValue);
                }
            }
            unset($a_aUserData['setting']);
            
            // null properties?
            foreach (array('Age', 'LivesWith', 'Presentation', 'ApartmentNumber', 'ApartmentNumber2', 'AddressId', 'Floor', 'AddressNumber') as $sNullProperty) {
                if (array_key_exists($sNullProperty, $a_aUserData) && !$a_aUserData[$sNullProperty]) {
                    $a_aUserData[$sNullProperty] = NULL;
                }
            }
            foreach ($a_aUserData as $sKey => $mValue) {
                if (is_array($mValue) && !$mValue[0]) {
                    // optional field
                } else {
                    call_user_func_array(array($oBrfUser, 'set' . $sKey), array(is_array($mValue) ? $mValue[0] : $mValue));
                }
            }
        }
        $oBrfUser->savePicture($a_aPictureData);
        return $oBrfUser;
    }
    
    /**
     *
     * @return SvenskBRF_User_Collection 
     */
    public function _getOtherHouseholdMembers()
    {
        if ($this->getPrimaryMember()) {
            return new SvenskBRF_User_Collection(self::$_oUserAccessor->getUsersByPrimaryMemberId($this->_oUser->getId()));
        }
        $oCollection = new SvenskBRF_User_Collection();
        return $oCollection;
    }
    
    /**
     *
     * @param type $a_sFloor 
     * @return void
     */
    public function setFloor($a_sFloor)
    {
        $this->_oUser->setFloor($a_sFloor);
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                $oMember->setFloor($a_sFloor);
            }
        }
    }
    
    function setName($a_sName)
    {
        // change msg picture names to
        if ($a_sName !== $this->_oUser->getName()) {
            self::$_oMessageSelector->setHasPicture(TRUE);
            self::$_oMessageSelector->setSenderId($this->_oUser->getId());
            $oMessages = new SvenskBRF_Message_Collection(self::$_oMessageAccessor->read(self::$_oMessageSelector));
            $aLinks = array();
            foreach ($oMessages as $oMessage) {
                $aLinks[] = $oMessage->getMessageLink() . '.' . $oMessage->getImageType();
            }
            $this->_oUser->setName($a_sName);
            $aLinks2 = array();
            foreach ($oMessages as $oMessage) {
                $aLinks2[] = $oMessage->getMessageLink() . '.' . $oMessage->getImageType();
            }
            $sPicturePath = SvenskBRF_Message::getMessagePicturePath(SvenskBRF_Brf::load($this->_oUser->getBrf()));
            foreach ($aLinks as $iLinkIndex => $sLink) {
                rename($sPicturePath . $sLink, $sPicturePath . $aLinks2[$iLinkIndex]);
            }
        }
    }
    
    /**
     *
     * @param type $a_sApartmentNumber 
     * @return void
     */
    public function setApartmentNumber($a_sApartmentNumber)
    {
        $this->_oUser->setApartmentNumber($a_sApartmentNumber);
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                $oMember->setApartmentNumber($a_sApartmentNumber);
            }
        }
    }
    
    /**
     *
     * @param type $a_sApartmentNumber 
     * @return void
     */
    public function setAddressNumber($a_sAddressNumber)
    {
        $this->_oUser->setAddressNumber($a_sAddressNumber);
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                $oMember->setAddressNumber($a_sAddressNumber);
            }
        }
    }
    
    /**
     *
     * @param type $a_sApartmentNumber2 
     * @return void
     */
    public function setApartmentNumber2($a_sApartmentNumber2)
    {
        $this->_oUser->setApartmentNumber2($a_sApartmentNumber2);
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                $oMember->setApartmentNumber2($a_sApartmentNumber2);
            }
        }
    }
    
    /**
     *
     * @param BrfAddress $a_oAddress
     * @return void
     */
    public function setAddress(BrfAddress $a_oAddress = NULL)
    {
        if ($a_oAddress) {
            $this->_oUser->setAddress($a_oAddress);
        } else {
            $this->_oUser->setAddressId(NULL);
        }
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                if ($a_oAddress) {
                    $oMember->setAddress($a_oAddress);
                } else {
                    $oMember->setAddressId(NULL);
                }
            }
        }
    }
    
    /**
     *
     * @param int $a_iAddressId
     * @return void
     */
    public function setAddressId($a_iAddressId)
    {
        $this->_oUser->setAddressId($a_iAddressId);
        if ($this->getPrimaryMember()) {
            foreach ($this->_getOtherHouseholdMembers() as $oMember) {
                $oMember->setAddressId($a_iAddressId);
            }
        }
    }
    
    /**
     * 
     * @return bool
     */
    function getPrimaryMember()
    {
        return $this->_oUser->getIsPrimaryMember();
    }
    
    /**
     *
     * @var int 
     */
    const USER_TYPE_MEMBER = 1;
    
    /**
     *
     * @var int 
     */
    const USER_TYPE_REALTOR = 2;
    
    /**
     *
     * @var int 
     */
    const USER_TYPE_CONTRACTOR = 3;

    /**
     * 
     * @var int
     */
    const RESOURSE_AVAILABILITY_PAST = 4;
    
    /**
     * 
     * @var int
     */
    const RESOURSE_AVAILABILITY_AVAILABLE = 5;
    
    /**
     * 
     * @var int
     */
    const RESOURSE_AVAILABILITY_BOOKED = 6;
    
    /**
     *
     * @var User
     * 
     */
    protected $_oUser;

    
    private final function __construct(User $a_oUser)
    {
        $this->_oUser = $a_oUser;
    }
    
    public static function load(User $a_oUser)
    {
        switch ($a_oUser->getUserType()) {
            case self::USER_TYPE_CONTRACTOR:
                return new SvenskBRF_User_Contractor($a_oUser);
                break;
            case self::USER_TYPE_REALTOR:
                return new SvenskBRF_User_Realtor($a_oUser);
                break;
            default:
                return new SvenskBRF_User_Member($a_oUser);
        }
    }
    
    public static function loadById($a_iId)
    {
        return self::load(self::$_oUserAccessor->getById($a_iId));
    }
    
    function __call($a_sMethod, array $a_aArguments = array()) 
    {
        if (method_exists($this->_oUser, $a_sMethod)) {
            return call_user_func_array(array($this->_oUser, $a_sMethod), $a_aArguments);
        }
    }
    
    function isMember()
    {
        return FALSE;
    }
    
    public static function getByLoginCookie($a_sLoginCookie)
    {
        $oUserObject = self::$_oUserAccessor->getUserByLoginCookie($a_sLoginCookie);
        if ($oUserObject) {
            return self::load($oUserObject);
        } else {
            return NULL;
        }
    }
    
    /**
     *
     * 
     * @param type $a_sUsername
     * @param type $a_sPassword 
     * @return SvenskBRF_User
     * @throws new 
     */
    public static function login($a_sUsername, $a_sPassword)
    {
        self::$_oUserSelector->setUsername($a_sUsername);
        self::$_oUserSelector->setPassword($a_sPassword);
        try {
            $oUser = self::$_oUserAccessor->readOne(self::$_oUserSelector);
            if ($oUser) {
                return self::load($oUser);
            } else {
                throw new DomainObjectException("login error");
            }
        } catch (DomainObjectException $oException) {
            throw new SvenskBRFException("Felaktiga loginuppgifter");
        }
    }
    
    public static function getUsersByBrfId($a_iBrfId, $a_oExcludedUser = FALSE)
    {
        $aUsers = array();
        self::$_oUserSelector->setOrderBy('name ASC');
        self::$_oUserSelector->setBrfId($a_iBrfId);
        self::$_oUserSelector->setUserType(SvenskBRF_User::USER_TYPE_MEMBER);
        self::$_oUserSelector->setIsRegistered(TRUE);
        foreach (self::$_oUserAccessor->read(self::$_oUserSelector) as $oUser) {
            if (!is_object($a_oExcludedUser) || $a_oExcludedUser->getId() != $oUser->getId()) {
                $aUsers[] = self::load($oUser);
            }
        }
        return $aUsers;
    }
    
    public static function getAllUsersByBrfId($a_iBrfId, $a_oExcludedUser = FALSE)
    {
        $aUsers = array();
        self::$_oUserSelector->setOrderBy('name ASC');
        self::$_oUserSelector->setBrfId($a_iBrfId);
        foreach (self::$_oUserAccessor->read(self::$_oUserSelector) as $oUser) {
            if (!is_object($a_oExcludedUser) || $a_oExcludedUser->getId() != $oUser->getId()) {
                $aUsers[] = self::load($oUser);
            }
        }
        return $aUsers;
    }
    
    public function getBookings($a_iNumberOfBookings = 0)
    {
        self::$_oResourceBookingSelector->setUserId($this->_oUser->getId());
        self::$_oResourceBookingSelector->setSearchParameter('start', date('Y-m-d'), Selector::CONDITION_GTE);
        self::$_oResourceBookingSelector->setOrderBy('start ASC');
        if ($a_iNumberOfBookings > 0) {
            self::$_oResourceBookingSelector->limit($a_iNumberOfBookings);
        } 
        return self::$_oResourceBookingAccessor->read(self::$_oResourceBookingSelector);
    }
    
    public function getNumberOfUnreadMessages()
    {
        $oReadMessages = self::$_oMessageReadAccessor->getMessageReadsByUserId($this->_oUser->getId());
        $oMessages = self::$_oMessageAccessor->getMessagesByBrfId($this->_oUser->getBrfId());
        return $oMessages->size() - $oReadMessages->size();
    }
    
    function isRead(SvenskBRF_Message $a_oMessage)
    {
        self::$_oMessageReadSelector->setUserId($this->_oUser->getId());
        self::$_oMessageReadSelector->setMessageId($a_oMessage->getId());
        $oReadMessageCollection = self::$_oMessageReadAccessor->read(self::$_oMessageReadSelector);
        return $oReadMessageCollection->size() == 1;
    }
    
    public function getNumberOfUnreadMails()
    {
        self::$_oMailReceiverSelector->setToUserId($this->_oUser->getId());
        self::$_oMailReceiverSelector->setHidden(FALSE);
        self::$_oMailReceiverSelector->setIsRead(FALSE);
        return self::$_oMailReceiverAccessor->read(self::$_oMailReceiverSelector)->size();
    }
    
    
    public function getMessages($a_iNumberOfMessages = 3)
    {
        self::$_oMessageSelector->setOrderBy('send_time DESC');
        self::$_oMessageSelector->setBrfId($this->_oUser->getBrfId());
        if ($a_iNumberOfMessages > 0) {
            self::$_oMessageSelector->limit($a_iNumberOfMessages);
        } 
        return new SvenskBRF_Message_Collection(self::$_oMessageAccessor->read(self::$_oMessageSelector));
    }
    
    public function removeBookingByBookingId($a_iBookingId)
    {
        try {
            $oBooking = self::$_oResourceBookingAccessor->getById($a_iBookingId);
            if ($oBooking) {
                self::$_oResourceBookingAccessor->delete($oBooking);
            }
        } catch (DomainException $oDomainException) {}
    }
    
    /**
     *
     * @var Collection 
     */
    private $_oHouseHoldMembers = NULL;
    
    /**
     * See if a resource is available.
     *
     * @param Resource $a_oResource
     * @param SvenskBRF_User $a_oUser
     * @param int $a_iBookingTime 
     * @return int
     */
    public function checkResourceAvailability(Resource $a_oResource, $a_iBookingTime)
    {
        $sDateTime = date('Y-m-d H:i:s', $a_iBookingTime);
        // can't book back in time!
        $sNow = date('Y-m-d H:i:s');
        $sNowDateT = date('Y-m-d H:i:s', $a_iBookingTime + $a_oResource->getInterval() * 60 * 60);
        if (time() > $a_iBookingTime + $a_oResource->getInterval() * 60 * 60) {
            return self::RESOURSE_AVAILABILITY_PAST;
        }
        
        // check if day is available
        $iWeekDay = date('w', $a_iBookingTime);
        $bWeekDayFound = FALSE;
        foreach ($a_oResource->getResourceDayCollection() as $oResourceDay) {
            if ($oResourceDay->getDay() == $iWeekDay) {
                $bWeekDayFound = TRUE;
                break;
            }
        }
        if (!$bWeekDayFound) {
            return self::RESOURSE_AVAILABILITY_PAST;
        }

        // debug...
        $sDateTime = date('Y-m-d H:i:s', $a_iBookingTime);
        
        // see if someone else booked it!
        self::$_oResourceBookingSelector->setStart(date('Y-m-d H:i:s', $a_iBookingTime));
        self::$_oResourceBookingSelector->setResourceId($a_oResource->getId());
        if (self::$_oResourceBookingAccessor->read(self::$_oResourceBookingSelector)->size()) {
            return self::RESOURSE_AVAILABILITY_BOOKED;
        }
        
        // check if we've already chosen it for booking
        foreach (SvenskBRF_Session::getInstance()->getBookings() as $aBooking) {
            if ($a_iBookingTime == $aBooking['time'] && $aBooking['resource'] == $a_oResource->getId()) {
                return self::RESOURSE_AVAILABILITY_BOOKED;
            }
        }
        
        
        if (!$this->_oHouseHoldMembers && $this->getPrimaryMember()) {
            $this->_oHouseHoldMembers = self::$_oUserAccessor->getUsersByPrimaryMemberId($this->_oUser->getId());
        } else if (!$this->_oHouseHoldMembers && $this->_oUser->getPrimaryMemberId()) {
            $this->_oHouseHoldMembers = self::$_oUserAccessor->getUsersByPrimaryMemberId($this->_oUser->getPrimayMemberId());
        }
        
        // check number of bookings
        if ($a_oResource->getAdvanceBookings()) {
            
            $aUserIDs = $this->_oHouseHoldMembers->getKeys();
            $aUserIDs[] = $this->_oUser->getId();
            
            self::$_oResourceBookingSelector->setSearchParameter('user_id', $aUserIDs, Selector::CONDITION_IN);
            self::$_oResourceBookingSelector->setResourceId($a_oResource->getId());
            self::$_oResourceBookingSelector->setSearchParameter('end', date('Y-m-d H:i:s'), Selector::CONDITION_GT);
            $iSize = self::$_oResourceBookingAccessor->read(self::$_oResourceBookingSelector)->size();
            if ($iSize >= $a_oResource->getAdvanceBookings() && $a_oResource->getAdvanceBookings()) {
                return self::RESOURSE_AVAILABILITY_PAST;
            }
            
            // check session
            $aResourceCounts = array();
            foreach (SvenskBRF_Session::getInstance()->getBookings() as $aBooking) {
                @$aResourceCounts[$aBooking['resource']]++;
            }
            if (@$aResourceCounts[$a_oResource->getId()] >= $a_oResource->getAdvanceBookings() && $a_oResource->getAdvanceBookings()) {
                return self::RESOURSE_AVAILABILITY_PAST;
            }
        }
        
        
        
        return self::RESOURSE_AVAILABILITY_AVAILABLE;
    }
    
    public function bookResource(Resource $a_oResource, $a_iBookingTime, $a_bSmsReminder = FALSE, $a_bMailReminder = FALSE)
    {
        $sBT = date('Y-m-d H:i:s', $a_iBookingTime);
        $oResourceBooking = ResourceBooking::create($this->_oUser->getId(), $a_oResource->getId(), date('Y-m-d H:i:s', $a_iBookingTime), date('Y-m-d H:i:s', $a_iBookingTime + $a_oResource->getInterval() * 3600), $a_bSmsReminder, $a_bMailReminder, NULL, TRUE);
        // create booking code
        do {
            $sBookingCode = self::generatePassword(7);
            $oResourceBooking->setUnbookCode($sBookingCode);
            self::$_oResourceBookingSelector->setUnbookCode($sBookingCode);
            self::$_oResourceBookingSelector->setSearchParameter('end', date('Y-m-d'), Selector::CONDITION_GT);
        } while (self::$_oResourceBookingAccessor->read(self::$_oResourceBookingSelector)->size() > 1);
        
        $oResourceBooking->setResource($a_oResource);
        $oResourceBooking->setUser($this->_oUser);
        if ($a_bSmsReminder) {
            SvenskBRF_Notice::queueBookingReminderSms($oResourceBooking);
        }
        if ($a_bMailReminder) {
            SvenskBRF_Notice::queueBookingReminderMail($oResourceBooking);
        }
    }
    
    /**
     * Returns an array of neighbors.
     *
     * @param string $a_sName 
     * @return array
     */
    public function findNeighborByName($a_sName, $a_bReplaceSpace = FALSE)
    {
        self::$_oUserSelector->setBrfId($this->_oUser->getBrfId());
        $sTestName = "`name`";
        if ($a_bReplaceSpace) {
            $a_sName = str_replace(" ", "", $a_sName);
            $sTestName = "REPLACE(`name`,' ', '')";
        }
        
        // build query?
        
        $aSwitchCharacters = getSwitchCharacters();
        $aKeys = array_keys($aSwitchCharacters);
        $aValues = array_values($aSwitchCharacters);
        foreach ($aKeys as $iIndex => $sCharacter) {
            $sCorrespondingCharacter = $aValues[$iIndex];
            if (strpos($a_sName, $sCorrespondingCharacter)!== FALSE) {
                $sTestName = "REPLACE($sTestName, '$sCharacter', '$sCorrespondingCharacter')";
            }
        }
        
        self::$_oUserSelector->setSearchParameter($sTestName, $a_sName);
        $aUsers = array();
        foreach (self::$_oUserAccessor->read(self::$_oUserSelector) as $oUser) {
            $aUsers[] = self::load($oUser);
        }
        return $aUsers;
    }
    
    
    function readMessage(SvenskBRF_Message $a_oMessage)
    {
        self::$_oMessageReadSelector->setMessageId($a_oMessage->getId());
        self::$_oMessageReadSelector->setUserId($this->_oUser->getId());
        $oMessageReadCollection = self::$_oMessageReadAccessor->read(self::$_oMessageReadSelector);
        if ($oMessageReadCollection->size() == 0) {
            MessageRead::create($a_oMessage->getId(), $this->_oUser->getId(), date('Y-m-d H:i:s'), TRUE);
        }
    }
    
    function sendMessage($a_sMessage, $a_sHeader = 'Meddelande')
    {
        $oMessage = Message::create($this->_oUser->getId(), $this->_oUser->getBrfId(), $a_sMessage, $a_sHeader, date('Y-m-d H:i:s'), FALSE, NULL, TRUE);
        $oMessage->setSender($this->_oUser);
        $oMessageRead = MessageRead::create($oMessage->getId(), $this->_oUser->getId(), date('Y-m-d H:i:s'), TRUE);
        return SvenskBRF_Message::load($oMessage);
    }
    
    function sendMail($a_sMessage, $a_sSubject) 
    {
        $oMail = BrfMail::create($this->_oUser->getId(), $a_sMessage, $a_sSubject, date('Y-m-d H:i:s'), TRUE);
        $oMail->setFromUser($this->_oUser);
        return $oMail;
    }
    
    function getMail(BrfMail $a_oMail, $a_bSkipNotification = FALSE)
    {
        $oMailReceiver = MailReceiver::create($a_oMail->getId(), FALSE, NULL, $this->_oUser->getId(), FALSE, TRUE);
        $oMailReceiver->setMail($a_oMail);
        if (!$a_bSkipNotification) {
            SvenskBRF_Notice::sendMailNotification($oMailReceiver);
        }
    }
    
    function readMail($a_iMailReadId)
    {
        $oMailRead = self::$_oMailReceiverAccessor->getById($a_iMailReadId);
        if ($oMailRead && !$oMailRead->getIsRead()) {
            $oMailRead->setIsRead(TRUE);
            $oMailRead->setReadOn(date('Y-m-d H:i:s'));
        }
    }
    
    
    /**
     * Get e-mails.
     *
     * @return Collection; 
     */
    function getEmails($a_iLimit, $a_iOffset, &$a_iNumberOfEmails)
    {
        self::$_oMailReceiverSelector->setOrderBy('mail_id DESC');
        self::$_oMailReceiverSelector->setToUserId($this->_oUser->getId());
        self::$_oMailReceiverSelector->setHidden(FALSE);
        $oEmails = self::$_oMailReceiverAccessor->read(self::$_oMailReceiverSelector);
        $a_iNumberOfEmails = $oEmails->size();
        for ($iIndex = 0; $iIndex < $a_iOffset; $iIndex++) {
            $oEmails->next();
        }
        $oCollection = new Collection();
        $iCounter = 0;
        while ($oEmails->valid() && $iCounter < $a_iLimit) {
            $oCollection->addObject($oEmails->current());
            $oEmails->next();
            $iCounter++;
        }
        return $oCollection;
    }
    
    function getSentEmails() {
        self::$_oBrfMailSelector->setOrderBy('sent_on DESC');
        self::$_oBrfMailSelector->setFromUserId($this->_oUser->getId());
        $oMailCollection = self::$_oBrfMailAccessor->read(self::$_oBrfMailSelector);
        return $oMailCollection;
    }

    
    /**
     *
     * @return SvenskBRF_ExternalPartner
     */
    public function getExternalPartner()
    {
        $oExternalPartner = $this->_oUser->getExternalPartner();
        return $oExternalPartner ? SvenskBRF_ExternalPartner::load($oExternalPartner) : NULL;        
    }
    
    
    
    public function hasPicture()
    {
        return $this->_oUser->getHasPicture();
    }
    
    protected function _getPictureName()
    {
        return $this->_oUser->getName();
    }
    
    protected function _getImagePath()
    {
        $sPath = "./../files/userpictures/";
        $sPath .= $this->_oUser->getId();
        return $sPath;
    }
    
    /**
     *
     * @param int $a_iPasswordLength
     * @return string 
     */
    public static function generatePassword($a_iPasswordLength = 6)
    {
        $aCharacters = range(97,122);
        $aNumbers = range(48,57);
        $aNumbersAndCharacters = array_merge($aCharacters, $aNumbers);
        $sPassword = "";
        for ($iIndex = 0; $iIndex < $a_iPasswordLength; $iIndex++) {
            $sPassword .= chr($aNumbersAndCharacters[rand(0, count($aNumbersAndCharacters) - 1)]);
        }
        return $sPassword;
    }
    
 
    public function isBoardMember()
    {
        if (!$this->_oUser->getIsRegistered()) {
            return FALSE;
        }
        if ($this->_oUser->getAdmin() || in_array($this->_oUser->getUserTitleId(), array(1,2,3,4))) {
            return TRUE;
        }
        
        return FALSE;
    }

    /**
     * 
     * @return UserTitle
     */
    public function getUserTitle()
    {
        $oUserTitle = $this->_oUser->getUserTitle();
        if (!$oUserTitle && $this->_oUser->getUserTitleId()) {
            $oUserTitle = self::$_oUserTitleAccessor->getById($this->_oUser->getUserTitleId());
        }
        return $oUserTitle;
    }
    
    public function isRegistered()
    {
        return $this->_oUser->getIsRegistered();
    }
    
    /**
     *
     * @param type $a_sPassword
     * @param SvenskBRF_Brf $a_oBrf 
     * return SvenskBRF_User
     */
    public static function getUserByPrePass($a_sPassword, SvenskBRF_Brf $a_oBrf)
    {
        self::$_oUserSelector->setUsername($a_oBrf->getUrl());
        self::$_oUserSelector->setPassword($a_sPassword);
        self::$_oUserSelector->setBrfId($a_oBrf->getId());
        $oUser = self::$_oUserAccessor->readOne(self::$_oUserSelector);
        return $oUser ? self::load($oUser) : NULL;
    }
    
    /**
     *
     * @param type $a_aData
     * @param type $a_aPictureData 
     */
    function saveData($a_aData, $a_aPictureData)
    {
        self::saveUser($a_aData, $a_aPictureData, $this);
    }
    
    function getPasswordLinkKey()
    {
        $sKey = self::generatePassword(10);
        PasswordReset::create($this->_oUser->getId(), $sKey, date('Y-m-d H:i:s', strtotime('+10 minute', strtotime(date('Y-m-d H:i:s')))));
        return $sKey;
    }
    
    public static function isValidPasswordKey($a_sKey)
    {
        self::$_oPasswordResetSelector->setPasswordKey($a_sKey);
        self::$_oPasswordResetSelector->setSearchParameter("expires_on", date('Y-m-d H:i:s'), Selector::CONDITION_GT);
        $oReset = self::$_oPasswordResetAccessor->readOne(self::$_oPasswordResetSelector);
        return (bool) $oReset;
    }
    
    public static function getUserByPasswordKey($a_sKey) 
    {
        return self::loadById(self::$_oPasswordResetAccessor->getPasswordResetsByPasswordKey($a_sKey)->current()->getUserId());
    }

    public static function loadByLinkName($a_sLinkName, SvenskBRF_Brf $a_oBrf)
    {
        $iOffset = 0;
        if (preg_match("/[a-öéüè]+([0-9]+)/i", $a_sLinkName, $aMatches) && count($aMatches) == 2) {
            $iOffset = $aMatches[1];
        }
        $a_sLinkName = preg_replace("/[0-9]/", "", $a_sLinkName);
        $sField = "REPLACE(name, ' ', '')";
        foreach (getSwitchCharacters() as $sReplace => $sReplaceMent) {
            $sField = "REPLACE($sField, '$sReplace', '$sReplaceMent')";
        }
        foreach (range(0,9) as $iNumber) {
            $sField = "REPLACE($sField, '$iNumber', '')";
        }
        self::$_oUserSelector->setBrfId($a_oBrf->getId());
        self::$_oUserSelector->setIsRegistered(TRUE);
        self::$_oUserSelector->setUserType(self::USER_TYPE_MEMBER);
        self::$_oUserSelector->setSearchParameter($sField, $a_sLinkName, Selector::CONDITION_LIKE_LEFT);
        self::$_oUserSelector->setSearchParameter($sField, $a_sLinkName, Selector::CONDITION_LIKE_RIGHT);
        $oUsers = self::$_oUserAccessor->read(self::$_oUserSelector);
        $oUser = NULL;
        for ($iIndex = 0; $iIndex < $iOffset; $iIndex++) {
            $oUsers->next();
        }
        $oUser = $oUsers->current();
        return self::load($oUser);
    }
    
    /**
     *
     * @param string $a_sUsername
     * @return SvenskBRF_User
     * 
     */
    public static function getByUsername($a_sUsername) 
    {
        $sUsername = trim($a_sUsername);
        $oUsers = self::$_oUserAccessor->getUsersByUsername($sUsername);
        return $oUsers->size() ? self::load($oUsers->current()) : NULL;
    }
    
    /**
     * 
     * @param type $a_sEmail
     * @param type $a_iUserId
     * @return \SvenskBRF_User
     */
    public static function getByEmail($a_sEmail, $a_iUserId = NULL)
    {
        $oCollection = new Collection;
        if (!$a_sEmail) {
            return new SvenskBRF_User_Collection($oCollection);
        }
        self::$_oUserSelector->setEmail($a_sEmail);
        if ($a_iUserId) {
            self::$_oUserSelector->setSearchParameter('id', array($a_iUserId), Selector::CONDITION_NOT_IN);
        }
        $oCollection = self::$_oUserAccessor->read(self::$_oUserSelector);
        return $oCollection->size() ? self::load($oCollection->current()) : NULL;
    }
}

