<?php

/**
 * Domain object class for User. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class User extends DomainObject 
{
    /**
     * User's 'user_type' property. 
     *
     * @var int
     */
    private $_iUserType;

    /**
     * User's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * User's 'username' property. 
     *
     * @var string
     */
    private $_sUsername;

    /**
     * User's 'password' property. 
     *
     * @var string
     */
    private $_sPassword;

    /**
     * User's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * User's 'apartment_number' property. 
     *
     * @var string
     */
    private $_sApartmentNumber;

    /**
     * User's 'apartment_number2' property. 
     *
     * @var string
     */
    private $_sApartmentNumber2;

    /**
     * User's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * User's 'cellphone' property. 
     *
     * @var string
     */
    private $_sCellphone;

    /**
     * User's 'admin' property. 
     *
     * @var bool
     */
    private $_bAdmin;

    /**
     * User's 'external_partner_id' property. 
     *
     * @var int
     */
    private $_iExternalPartnerId;

    /**
     * User's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * User's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * User's 'presentation' property. 
     *
     * @var string
     */
    private $_sPresentation;

    /**
     * User's 'age' property. 
     *
     * @var int
     */
    private $_iAge;

    /**
     * User's 'lives_with' property. 
     *
     * @var string
     */
    private $_sLivesWith;

    /**
     * User's 'hide_phone' property. 
     *
     * @var bool
     */
    private $_bHidePhone;

    /**
     * User's 'user_title_id' property. 
     *
     * @var int
     */
    private $_iUserTitleId;

    /**
     * User's 'login_cookie' property. 
     *
     * @var string
     */
    private $_sLoginCookie;

    /**
     * User's 'floor' property. 
     *
     * @var string
     */
    private $_sFloor;

    /**
     * User's 'address_id' property. 
     *
     * @var int
     */
    private $_iAddressId;

    /**
     * User's 'is_registered' property. 
     *
     * @var bool
     */
    private $_bIsRegistered;

    /**
     * User's 'is_primary_member' property. 
     *
     * @var bool
     */
    private $_bIsPrimaryMember;

    /**
     * User's 'primary_member_id' property. 
     *
     * @var int
     */
    private $_iPrimaryMemberId;

    /**
     * User's 'address_number' property. 
     *
     * @var string
     */
    private $_sAddressNumber;

    /**
     * Get User's 'user_type' property. 
     *
     * @return int
     */
    function getUserType()
    {
        return (int) $this->_iUserType;
    }

    /**
     * Set User's 'user_type' property. 
     *
     * @param int $a_iUserType
     * @return void
     */
    function setUserType($a_iUserType)
    {
        if (!is_null($this->_iUserType) && $this->_iUserType !== (int) $a_iUserType) {
            $this->_markModified();
        }
        $this->_iUserType = (int) $a_iUserType;
    }

    /**
     * Get User's 'brf_id' property. 
     *
     * @return int|null
     */
    function getBrfId()
    {
        return is_null($this->_iBrfId) ? NULL : (int) $this->_iBrfId;
    }

    /**
     * Set User's 'brf_id' property. 
     *
     * @param int|null $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iBrfId) ? NULL : ((int) $a_iBrfId);
            if ($mCompareValue !== $this->_iBrfId) {
                $this->_markModified();
            }
        }
        $this->_iBrfId = is_null($a_iBrfId) ? NULL : (int) $a_iBrfId;
    }

    /**
     * The Brf.
     * 
     * @var Brf
     */
    private $_oBrf;

    /**
     * Get the Brf.
     * 
     * @return Brf
     */
    function getBrf()
    {
        return $this->_oBrf;
    }

    /**
     * Set the Brf.
     * 
     * @param Brf $a_oBrf
     * 
     * @return void
     */
    function setBrf($a_oBrf)
    {
        $this->_iBrfId = $a_oBrf->getId();
        $this->_oBrf = $a_oBrf;
    }

    /**
     * Get User's 'username' property. 
     *
     * @return string
     */
    function getUsername()
    {
        return (string) $this->_sUsername;
    }

    /**
     * Set User's 'username' property. 
     *
     * @param string $a_sUsername
     * @return void
     */
    function setUsername($a_sUsername)
    {
        if (!is_null($this->_sUsername) && $this->_sUsername !== (string) $a_sUsername) {
            $this->_markModified();
        }
        $this->_sUsername = (string) $a_sUsername;
    }

    /**
     * Get User's 'password' property. 
     *
     * @return string
     */
    function getPassword()
    {
        return (string) $this->_sPassword;
    }

    /**
     * Set User's 'password' property. 
     *
     * @param string $a_sPassword
     * @return void
     */
    function setPassword($a_sPassword)
    {
        if (!is_null($this->_sPassword) && $this->_sPassword !== (string) $a_sPassword) {
            $this->_markModified();
        }
        $this->_sPassword = (string) $a_sPassword;
    }

    /**
     * Get User's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set User's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        if (!is_null($this->_sName) && $this->_sName !== (string) $a_sName) {
            $this->_markModified();
        }
        $this->_sName = (string) $a_sName;
    }

    /**
     * Get User's 'apartment_number' property. 
     *
     * @return string|null
     */
    function getApartmentNumber()
    {
        return is_null($this->_sApartmentNumber) ? NULL : (string) $this->_sApartmentNumber;
    }

    /**
     * Set User's 'apartment_number' property. 
     *
     * @param string|null $a_sApartmentNumber
     * @return void
     */
    function setApartmentNumber($a_sApartmentNumber)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sApartmentNumber) ? NULL : ((string) $a_sApartmentNumber);
            if ($mCompareValue !== $this->_sApartmentNumber) {
                $this->_markModified();
            }
        }
        $this->_sApartmentNumber = is_null($a_sApartmentNumber) ? NULL : (string) $a_sApartmentNumber;
    }

    /**
     * Get User's 'apartment_number2' property. 
     *
     * @return string|null
     */
    function getApartmentNumber2()
    {
        return is_null($this->_sApartmentNumber2) ? NULL : (string) $this->_sApartmentNumber2;
    }

    /**
     * Set User's 'apartment_number2' property. 
     *
     * @param string|null $a_sApartmentNumber2
     * @return void
     */
    function setApartmentNumber2($a_sApartmentNumber2)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sApartmentNumber2) ? NULL : ((string) $a_sApartmentNumber2);
            if ($mCompareValue !== $this->_sApartmentNumber2) {
                $this->_markModified();
            }
        }
        $this->_sApartmentNumber2 = is_null($a_sApartmentNumber2) ? NULL : (string) $a_sApartmentNumber2;
    }

    /**
     * Get User's 'email' property. 
     *
     * @return string
     */
    function getEmail()
    {
        return (string) $this->_sEmail;
    }

    /**
     * Set User's 'email' property. 
     *
     * @param string $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        if (!is_null($this->_sEmail) && $this->_sEmail !== (string) $a_sEmail) {
            $this->_markModified();
        }
        $this->_sEmail = (string) $a_sEmail;
    }

    /**
     * Get User's 'cellphone' property. 
     *
     * @return string
     */
    function getCellphone()
    {
        return (string) $this->_sCellphone;
    }

    /**
     * Set User's 'cellphone' property. 
     *
     * @param string $a_sCellphone
     * @return void
     */
    function setCellphone($a_sCellphone)
    {
        if (!is_null($this->_sCellphone) && $this->_sCellphone !== (string) $a_sCellphone) {
            $this->_markModified();
        }
        $this->_sCellphone = (string) $a_sCellphone;
    }

    /**
     * Get User's 'admin' property. 
     *
     * @return bool
     */
    function getAdmin()
    {
        return (bool) $this->_bAdmin;
    }

    /**
     * Set User's 'admin' property. 
     *
     * @param bool $a_bAdmin
     * @return void
     */
    function setAdmin($a_bAdmin)
    {
        if (!is_null($this->_bAdmin) && $this->_bAdmin !== (bool) $a_bAdmin) {
            $this->_markModified();
        }
        $this->_bAdmin = (bool) $a_bAdmin;
    }

    /**
     * Get User's 'external_partner_id' property. 
     *
     * @return int|null
     */
    function getExternalPartnerId()
    {
        return is_null($this->_iExternalPartnerId) ? NULL : (int) $this->_iExternalPartnerId;
    }

    /**
     * Set User's 'external_partner_id' property. 
     *
     * @param int|null $a_iExternalPartnerId
     * @return void
     */
    function setExternalPartnerId($a_iExternalPartnerId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iExternalPartnerId) ? NULL : ((int) $a_iExternalPartnerId);
            if ($mCompareValue !== $this->_iExternalPartnerId) {
                $this->_markModified();
            }
        }
        $this->_iExternalPartnerId = is_null($a_iExternalPartnerId) ? NULL : (int) $a_iExternalPartnerId;
    }

    /**
     * The ExternalPartner.
     * 
     * @var ExternalPartner
     */
    private $_oExternalPartner;

    /**
     * Get the ExternalPartner.
     * 
     * @return ExternalPartner
     */
    function getExternalPartner()
    {
        return $this->_oExternalPartner;
    }

    /**
     * Set the ExternalPartner.
     * 
     * @param ExternalPartner $a_oExternalPartner
     * 
     * @return void
     */
    function setExternalPartner($a_oExternalPartner)
    {
        $this->_iExternalPartnerId = $a_oExternalPartner->getId();
        $this->_oExternalPartner = $a_oExternalPartner;
    }

    /**
     * Get User's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set User's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        if (!is_null($this->_bHasPicture) && $this->_bHasPicture !== (bool) $a_bHasPicture) {
            $this->_markModified();
        }
        $this->_bHasPicture = (bool) $a_bHasPicture;
    }

    /**
     * Get User's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set User's 'image_type' property. 
     *
     * @param string|null $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sImageType) ? NULL : ((string) $a_sImageType);
            if ($mCompareValue !== $this->_sImageType) {
                $this->_markModified();
            }
        }
        $this->_sImageType = is_null($a_sImageType) ? NULL : (string) $a_sImageType;
    }

    /**
     * Get User's 'presentation' property. 
     *
     * @return string|null
     */
    function getPresentation()
    {
        return is_null($this->_sPresentation) ? NULL : (string) $this->_sPresentation;
    }

    /**
     * Set User's 'presentation' property. 
     *
     * @param string|null $a_sPresentation
     * @return void
     */
    function setPresentation($a_sPresentation)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sPresentation) ? NULL : ((string) $a_sPresentation);
            if ($mCompareValue !== $this->_sPresentation) {
                $this->_markModified();
            }
        }
        $this->_sPresentation = is_null($a_sPresentation) ? NULL : (string) $a_sPresentation;
    }

    /**
     * Get User's 'age' property. 
     *
     * @return int|null
     */
    function getAge()
    {
        return is_null($this->_iAge) ? NULL : (int) $this->_iAge;
    }

    /**
     * Set User's 'age' property. 
     *
     * @param int|null $a_iAge
     * @return void
     */
    function setAge($a_iAge)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iAge) ? NULL : ((int) $a_iAge);
            if ($mCompareValue !== $this->_iAge) {
                $this->_markModified();
            }
        }
        $this->_iAge = is_null($a_iAge) ? NULL : (int) $a_iAge;
    }

    /**
     * Get User's 'lives_with' property. 
     *
     * @return string|null
     */
    function getLivesWith()
    {
        return is_null($this->_sLivesWith) ? NULL : (string) $this->_sLivesWith;
    }

    /**
     * Set User's 'lives_with' property. 
     *
     * @param string|null $a_sLivesWith
     * @return void
     */
    function setLivesWith($a_sLivesWith)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sLivesWith) ? NULL : ((string) $a_sLivesWith);
            if ($mCompareValue !== $this->_sLivesWith) {
                $this->_markModified();
            }
        }
        $this->_sLivesWith = is_null($a_sLivesWith) ? NULL : (string) $a_sLivesWith;
    }

    /**
     * Get User's 'hide_phone' property. 
     *
     * @return bool
     */
    function getHidePhone()
    {
        return (bool) $this->_bHidePhone;
    }

    /**
     * Set User's 'hide_phone' property. 
     *
     * @param bool $a_bHidePhone
     * @return void
     */
    function setHidePhone($a_bHidePhone)
    {
        if (!is_null($this->_bHidePhone) && $this->_bHidePhone !== (bool) $a_bHidePhone) {
            $this->_markModified();
        }
        $this->_bHidePhone = (bool) $a_bHidePhone;
    }

    /**
     * Get User's 'user_title_id' property. 
     *
     * @return int|null
     */
    function getUserTitleId()
    {
        return is_null($this->_iUserTitleId) ? NULL : (int) $this->_iUserTitleId;
    }

    /**
     * Set User's 'user_title_id' property. 
     *
     * @param int|null $a_iUserTitleId
     * @return void
     */
    function setUserTitleId($a_iUserTitleId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iUserTitleId) ? NULL : ((int) $a_iUserTitleId);
            if ($mCompareValue !== $this->_iUserTitleId) {
                $this->_markModified();
            }
        }
        $this->_iUserTitleId = is_null($a_iUserTitleId) ? NULL : (int) $a_iUserTitleId;
    }

    /**
     * The UserTitle.
     * 
     * @var UserTitle
     */
    private $_oUserTitle;

    /**
     * Get the UserTitle.
     * 
     * @return UserTitle
     */
    function getUserTitle()
    {
        return $this->_oUserTitle;
    }

    /**
     * Set the UserTitle.
     * 
     * @param UserTitle $a_oUserTitle
     * 
     * @return void
     */
    function setUserTitle($a_oUserTitle)
    {
        $this->_iUserTitleId = $a_oUserTitle->getId();
        $this->_oUserTitle = $a_oUserTitle;
    }

    /**
     * Get User's 'login_cookie' property. 
     *
     * @return string|null
     */
    function getLoginCookie()
    {
        return is_null($this->_sLoginCookie) ? NULL : (string) $this->_sLoginCookie;
    }

    /**
     * Set User's 'login_cookie' property. 
     *
     * @param string|null $a_sLoginCookie
     * @return void
     */
    function setLoginCookie($a_sLoginCookie)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sLoginCookie) ? NULL : ((string) $a_sLoginCookie);
            if ($mCompareValue !== $this->_sLoginCookie) {
                $this->_markModified();
            }
        }
        $this->_sLoginCookie = is_null($a_sLoginCookie) ? NULL : (string) $a_sLoginCookie;
    }

    /**
     * Get User's 'floor' property. 
     *
     * @return string|null
     */
    function getFloor()
    {
        return is_null($this->_sFloor) ? NULL : (string) $this->_sFloor;
    }

    /**
     * Set User's 'floor' property. 
     *
     * @param string|null $a_sFloor
     * @return void
     */
    function setFloor($a_sFloor)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sFloor) ? NULL : ((string) $a_sFloor);
            if ($mCompareValue !== $this->_sFloor) {
                $this->_markModified();
            }
        }
        $this->_sFloor = is_null($a_sFloor) ? NULL : (string) $a_sFloor;
    }

    /**
     * Get User's 'address_id' property. 
     *
     * @return int|null
     */
    function getAddressId()
    {
        return is_null($this->_iAddressId) ? NULL : (int) $this->_iAddressId;
    }

    /**
     * Set User's 'address_id' property. 
     *
     * @param int|null $a_iAddressId
     * @return void
     */
    function setAddressId($a_iAddressId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iAddressId) ? NULL : ((int) $a_iAddressId);
            if ($mCompareValue !== $this->_iAddressId) {
                $this->_markModified();
            }
        }
        $this->_iAddressId = is_null($a_iAddressId) ? NULL : (int) $a_iAddressId;
    }

    /**
     * The Address.
     * 
     * @var Address
     */
    private $_oAddress;

    /**
     * Get the Address.
     * 
     * @return Address
     */
    function getAddress()
    {
        return $this->_oAddress;
    }

    /**
     * Set the Address.
     * 
     * @param Address $a_oAddress
     * 
     * @return void
     */
    function setAddress($a_oAddress)
    {
        $this->_iAddressId = $a_oAddress->getId();
        $this->_oAddress = $a_oAddress;
    }

    /**
     * Get User's 'is_registered' property. 
     *
     * @return bool
     */
    function getIsRegistered()
    {
        return (bool) $this->_bIsRegistered;
    }

    /**
     * Set User's 'is_registered' property. 
     *
     * @param bool $a_bIsRegistered
     * @return void
     */
    function setIsRegistered($a_bIsRegistered)
    {
        if (!is_null($this->_bIsRegistered) && $this->_bIsRegistered !== (bool) $a_bIsRegistered) {
            $this->_markModified();
        }
        $this->_bIsRegistered = (bool) $a_bIsRegistered;
    }

    /**
     * Get User's 'is_primary_member' property. 
     *
     * @return bool
     */
    function getIsPrimaryMember()
    {
        return (bool) $this->_bIsPrimaryMember;
    }

    /**
     * Set User's 'is_primary_member' property. 
     *
     * @param bool $a_bIsPrimaryMember
     * @return void
     */
    function setIsPrimaryMember($a_bIsPrimaryMember)
    {
        if (!is_null($this->_bIsPrimaryMember) && $this->_bIsPrimaryMember !== (bool) $a_bIsPrimaryMember) {
            $this->_markModified();
        }
        $this->_bIsPrimaryMember = (bool) $a_bIsPrimaryMember;
    }

    /**
     * Get User's 'primary_member_id' property. 
     *
     * @return int|null
     */
    function getPrimaryMemberId()
    {
        return is_null($this->_iPrimaryMemberId) ? NULL : (int) $this->_iPrimaryMemberId;
    }

    /**
     * Set User's 'primary_member_id' property. 
     *
     * @param int|null $a_iPrimaryMemberId
     * @return void
     */
    function setPrimaryMemberId($a_iPrimaryMemberId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iPrimaryMemberId) ? NULL : ((int) $a_iPrimaryMemberId);
            if ($mCompareValue !== $this->_iPrimaryMemberId) {
                $this->_markModified();
            }
        }
        $this->_iPrimaryMemberId = is_null($a_iPrimaryMemberId) ? NULL : (int) $a_iPrimaryMemberId;
    }

    /**
     * Get User's 'address_number' property. 
     *
     * @return string|null
     */
    function getAddressNumber()
    {
        return is_null($this->_sAddressNumber) ? NULL : (string) $this->_sAddressNumber;
    }

    /**
     * Set User's 'address_number' property. 
     *
     * @param string|null $a_sAddressNumber
     * @return void
     */
    function setAddressNumber($a_sAddressNumber)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sAddressNumber) ? NULL : ((string) $a_sAddressNumber);
            if ($mCompareValue !== $this->_sAddressNumber) {
                $this->_markModified();
            }
        }
        $this->_sAddressNumber = is_null($a_sAddressNumber) ? NULL : (string) $a_sAddressNumber;
    }

    /**
     * This User's Brf collection.
     * 
     * @var Collection
     */
    private $_oBrfCollection;

    /**
     * Get Brf collection.
     * 
     * @see Brf
     * 
     * @return Collection
     */
    function getBrfCollection()
    {
        if (!isset($this->_oBrfCollection)) {
            $this->_oBrfCollection = new Collection();
        }
        return $this->_oBrfCollection;
    }

    /**
     * This User's BrfFelanmalan collection.
     * 
     * @var Collection
     */
    private $_oBrfFelanmalanCollection;

    /**
     * Get BrfFelanmalan collection.
     * 
     * @see BrfFelanmalan
     * 
     * @return Collection
     */
    function getBrfFelanmalanCollection()
    {
        if (!isset($this->_oBrfFelanmalanCollection)) {
            $this->_oBrfFelanmalanCollection = new Collection();
        }
        return $this->_oBrfFelanmalanCollection;
    }

    /**
     * This User's BrfMail collection.
     * 
     * @var Collection
     */
    private $_oBrfMailCollection;

    /**
     * Get BrfMail collection.
     * 
     * @see BrfMail
     * 
     * @return Collection
     */
    function getBrfMailCollection()
    {
        if (!isset($this->_oBrfMailCollection)) {
            $this->_oBrfMailCollection = new Collection();
        }
        return $this->_oBrfMailCollection;
    }

    /**
     * This User's BrfRealtorCode collection.
     * 
     * @var Collection
     */
    private $_oBrfRealtorCodeCollection;

    /**
     * Get BrfRealtorCode collection.
     * 
     * @see BrfRealtorCode
     * 
     * @return Collection
     */
    function getBrfRealtorCodeCollection()
    {
        if (!isset($this->_oBrfRealtorCodeCollection)) {
            $this->_oBrfRealtorCodeCollection = new Collection();
        }
        return $this->_oBrfRealtorCodeCollection;
    }

    /**
     * This User's BrfRealtorLog collection.
     * 
     * @var Collection
     */
    private $_oBrfRealtorLogCollection;

    /**
     * Get BrfRealtorLog collection.
     * 
     * @see BrfRealtorLog
     * 
     * @return Collection
     */
    function getBrfRealtorLogCollection()
    {
        if (!isset($this->_oBrfRealtorLogCollection)) {
            $this->_oBrfRealtorLogCollection = new Collection();
        }
        return $this->_oBrfRealtorLogCollection;
    }

    /**
     * This User's Document collection.
     * 
     * @var Collection
     */
    private $_oDocumentCollection;

    /**
     * Get Document collection.
     * 
     * @see Document
     * 
     * @return Collection
     */
    function getDocumentCollection()
    {
        if (!isset($this->_oDocumentCollection)) {
            $this->_oDocumentCollection = new Collection();
        }
        return $this->_oDocumentCollection;
    }

    /**
     * This User's MailReceiver collection.
     * 
     * @var Collection
     */
    private $_oMailReceiverCollection;

    /**
     * Get MailReceiver collection.
     * 
     * @see MailReceiver
     * 
     * @return Collection
     */
    function getMailReceiverCollection()
    {
        if (!isset($this->_oMailReceiverCollection)) {
            $this->_oMailReceiverCollection = new Collection();
        }
        return $this->_oMailReceiverCollection;
    }

    /**
     * This User's Message collection.
     * 
     * @var Collection
     */
    private $_oMessageCollection;

    /**
     * Get Message collection.
     * 
     * @see Message
     * 
     * @return Collection
     */
    function getMessageCollection()
    {
        if (!isset($this->_oMessageCollection)) {
            $this->_oMessageCollection = new Collection();
        }
        return $this->_oMessageCollection;
    }

    /**
     * This User's MessageRead collection.
     * 
     * @var Collection
     */
    private $_oMessageReadCollection;

    /**
     * Get MessageRead collection.
     * 
     * @see MessageRead
     * 
     * @return Collection
     */
    function getMessageReadCollection()
    {
        if (!isset($this->_oMessageReadCollection)) {
            $this->_oMessageReadCollection = new Collection();
        }
        return $this->_oMessageReadCollection;
    }

    /**
     * This User's Notice collection.
     * 
     * @var Collection
     */
    private $_oNoticeCollection;

    /**
     * Get Notice collection.
     * 
     * @see Notice
     * 
     * @return Collection
     */
    function getNoticeCollection()
    {
        if (!isset($this->_oNoticeCollection)) {
            $this->_oNoticeCollection = new Collection();
        }
        return $this->_oNoticeCollection;
    }



    public static function create($a_iUserType, $a_iBrfId, $a_sUsername, $a_sPassword, $a_sName, $a_sApartmentNumber, $a_sApartmentNumber2, $a_sEmail, $a_sCellphone, $a_bAdmin, $a_iExternalPartnerId, $a_bHasPicture, $a_sImageType, $a_sPresentation, $a_iAge, $a_sLivesWith, $a_bHidePhone, $a_iUserTitleId, $a_sLoginCookie, $a_sFloor, $a_iAddressId, $a_bIsRegistered, $a_bIsPrimaryMember, $a_iPrimaryMemberId, $a_sAddressNumber, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('user')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('user')->write($oObject);
        }
        return $oObject;
    }

}
