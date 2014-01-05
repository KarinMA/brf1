<?php

/**
 * Selector class for User. 
 *
 * @see User
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_UserSelector extends Selector 
{


    /**
     * User selector's 'user_type' property. 
     *
     * @var int
     */
    private $_iUserType;

    /**
     * User selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * User selector's 'username' property. 
     *
     * @var string
     */
    private $_sUsername;

    /**
     * User selector's 'password' property. 
     *
     * @var string
     */
    private $_sPassword;

    /**
     * User selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * User selector's 'apartment_number' property. 
     *
     * @var string
     */
    private $_sApartmentNumber;

    /**
     * User selector's 'apartment_number2' property. 
     *
     * @var string
     */
    private $_sApartmentNumber2;

    /**
     * User selector's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * User selector's 'cellphone' property. 
     *
     * @var string
     */
    private $_sCellphone;

    /**
     * User selector's 'admin' property. 
     *
     * @var bool
     */
    private $_bAdmin;

    /**
     * User selector's 'external_partner_id' property. 
     *
     * @var int
     */
    private $_iExternalPartnerId;

    /**
     * User selector's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * User selector's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * User selector's 'presentation' property. 
     *
     * @var string
     */
    private $_sPresentation;

    /**
     * User selector's 'age' property. 
     *
     * @var int
     */
    private $_iAge;

    /**
     * User selector's 'lives_with' property. 
     *
     * @var string
     */
    private $_sLivesWith;

    /**
     * User selector's 'hide_phone' property. 
     *
     * @var bool
     */
    private $_bHidePhone;

    /**
     * User selector's 'user_title_id' property. 
     *
     * @var int
     */
    private $_iUserTitleId;

    /**
     * User selector's 'login_cookie' property. 
     *
     * @var string
     */
    private $_sLoginCookie;

    /**
     * User selector's 'floor' property. 
     *
     * @var string
     */
    private $_sFloor;

    /**
     * User selector's 'address_id' property. 
     *
     * @var int
     */
    private $_iAddressId;

    /**
     * User selector's 'is_registered' property. 
     *
     * @var bool
     */
    private $_bIsRegistered;

    /**
     * User selector's 'is_primary_member' property. 
     *
     * @var bool
     */
    private $_bIsPrimaryMember;

    /**
     * User selector's 'primary_member_id' property. 
     *
     * @var int
     */
    private $_iPrimaryMemberId;

    /**
     * User selector's 'address_number' property. 
     *
     * @var string
     */
    private $_sAddressNumber;
    /**
     * Get User selector's 'user_type' property. 
     *
     * @return int
     */
    function getUserType()
    {
        return (int) $this->_iUserType;
    }

    /**
     * Set User selector's 'user_type' property. 
     *
     * @param int $a_iUser selectorType
     * @return void
     */
    function setUserType($a_iUserType)
    {
        $this->_iUserType = (int) $a_iUserType;
        $this->setSearchParameter('user_type', $this->_iUserType);
    }

    /**
     * Get User selector's 'brf_id' property. 
     *
     * @return int|null
     */
    function getBrfId()
    {
        return is_null($this->_iBrfId) ? NULL : (int) $this->_iBrfId;
    }

    /**
     * Set User selector's 'brf_id' property. 
     *
     * @param int|null $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        $this->_iBrfId = is_null($a_iBrfId) ? NULL : (int) $a_iBrfId;
        $this->setSearchParameter('brf_id', (int) $this->_iBrfId, is_null($this->_iBrfId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'username' property. 
     *
     * @return string
     */
    function getUsername()
    {
        return (string) $this->_sUsername;
    }

    /**
     * Set User selector's 'username' property. 
     *
     * @param string $a_sUser selectorname
     * @return void
     */
    function setUsername($a_sUsername)
    {
        $this->_sUsername = (string) $a_sUsername;
        $this->setSearchParameter('username', $this->_sUsername);
    }

    /**
     * Get User selector's 'password' property. 
     *
     * @return string
     */
    function getPassword()
    {
        return (string) $this->_sPassword;
    }

    /**
     * Set User selector's 'password' property. 
     *
     * @param string $a_sPassword
     * @return void
     */
    function setPassword($a_sPassword)
    {
        $this->_sPassword = (string) $a_sPassword;
        $this->setSearchParameter('password', $this->_sPassword);
    }

    /**
     * Get User selector's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set User selector's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        $this->_sName = (string) $a_sName;
        $this->setSearchParameter('name', $this->_sName);
    }

    /**
     * Get User selector's 'apartment_number' property. 
     *
     * @return string|null
     */
    function getApartmentNumber()
    {
        return is_null($this->_sApartmentNumber) ? NULL : (string) $this->_sApartmentNumber;
    }

    /**
     * Set User selector's 'apartment_number' property. 
     *
     * @param string|null $a_sApartmentNumber
     * @return void
     */
    function setApartmentNumber($a_sApartmentNumber)
    {
        $this->_sApartmentNumber = is_null($a_sApartmentNumber) ? NULL : (string) $a_sApartmentNumber;
        $this->setSearchParameter('apartment_number', (string) $this->_sApartmentNumber, is_null($this->_sApartmentNumber) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'apartment_number2' property. 
     *
     * @return string|null
     */
    function getApartmentNumber2()
    {
        return is_null($this->_sApartmentNumber2) ? NULL : (string) $this->_sApartmentNumber2;
    }

    /**
     * Set User selector's 'apartment_number2' property. 
     *
     * @param string|null $a_sApartmentNumber2
     * @return void
     */
    function setApartmentNumber2($a_sApartmentNumber2)
    {
        $this->_sApartmentNumber2 = is_null($a_sApartmentNumber2) ? NULL : (string) $a_sApartmentNumber2;
        $this->setSearchParameter('apartment_number2', (string) $this->_sApartmentNumber2, is_null($this->_sApartmentNumber2) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'email' property. 
     *
     * @return string
     */
    function getEmail()
    {
        return (string) $this->_sEmail;
    }

    /**
     * Set User selector's 'email' property. 
     *
     * @param string $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        $this->_sEmail = (string) $a_sEmail;
        $this->setSearchParameter('email', $this->_sEmail);
    }

    /**
     * Get User selector's 'cellphone' property. 
     *
     * @return string
     */
    function getCellphone()
    {
        return (string) $this->_sCellphone;
    }

    /**
     * Set User selector's 'cellphone' property. 
     *
     * @param string $a_sCellphone
     * @return void
     */
    function setCellphone($a_sCellphone)
    {
        $this->_sCellphone = (string) $a_sCellphone;
        $this->setSearchParameter('cellphone', $this->_sCellphone);
    }

    /**
     * Get User selector's 'admin' property. 
     *
     * @return bool
     */
    function getAdmin()
    {
        return (bool) $this->_bAdmin;
    }

    /**
     * Set User selector's 'admin' property. 
     *
     * @param bool $a_bAdmin
     * @return void
     */
    function setAdmin($a_bAdmin)
    {
        $this->_bAdmin = (bool) $a_bAdmin;
        $this->setSearchParameter('admin', $this->_bAdmin);
    }

    /**
     * Get User selector's 'external_partner_id' property. 
     *
     * @return int|null
     */
    function getExternalPartnerId()
    {
        return is_null($this->_iExternalPartnerId) ? NULL : (int) $this->_iExternalPartnerId;
    }

    /**
     * Set User selector's 'external_partner_id' property. 
     *
     * @param int|null $a_iExternalPartnerId
     * @return void
     */
    function setExternalPartnerId($a_iExternalPartnerId)
    {
        $this->_iExternalPartnerId = is_null($a_iExternalPartnerId) ? NULL : (int) $a_iExternalPartnerId;
        $this->setSearchParameter('external_partner_id', (int) $this->_iExternalPartnerId, is_null($this->_iExternalPartnerId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set User selector's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        $this->_bHasPicture = (bool) $a_bHasPicture;
        $this->setSearchParameter('has_picture', $this->_bHasPicture);
    }

    /**
     * Get User selector's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set User selector's 'image_type' property. 
     *
     * @param string|null $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        $this->_sImageType = is_null($a_sImageType) ? NULL : (string) $a_sImageType;
        $this->setSearchParameter('image_type', (string) $this->_sImageType, is_null($this->_sImageType) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'presentation' property. 
     *
     * @return string|null
     */
    function getPresentation()
    {
        return is_null($this->_sPresentation) ? NULL : (string) $this->_sPresentation;
    }

    /**
     * Set User selector's 'presentation' property. 
     *
     * @param string|null $a_sPresentation
     * @return void
     */
    function setPresentation($a_sPresentation)
    {
        $this->_sPresentation = is_null($a_sPresentation) ? NULL : (string) $a_sPresentation;
        $this->setSearchParameter('presentation', (string) $this->_sPresentation, is_null($this->_sPresentation) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'age' property. 
     *
     * @return int|null
     */
    function getAge()
    {
        return is_null($this->_iAge) ? NULL : (int) $this->_iAge;
    }

    /**
     * Set User selector's 'age' property. 
     *
     * @param int|null $a_iAge
     * @return void
     */
    function setAge($a_iAge)
    {
        $this->_iAge = is_null($a_iAge) ? NULL : (int) $a_iAge;
        $this->setSearchParameter('age', (int) $this->_iAge, is_null($this->_iAge) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'lives_with' property. 
     *
     * @return string|null
     */
    function getLivesWith()
    {
        return is_null($this->_sLivesWith) ? NULL : (string) $this->_sLivesWith;
    }

    /**
     * Set User selector's 'lives_with' property. 
     *
     * @param string|null $a_sLivesWith
     * @return void
     */
    function setLivesWith($a_sLivesWith)
    {
        $this->_sLivesWith = is_null($a_sLivesWith) ? NULL : (string) $a_sLivesWith;
        $this->setSearchParameter('lives_with', (string) $this->_sLivesWith, is_null($this->_sLivesWith) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'hide_phone' property. 
     *
     * @return bool
     */
    function getHidePhone()
    {
        return (bool) $this->_bHidePhone;
    }

    /**
     * Set User selector's 'hide_phone' property. 
     *
     * @param bool $a_bHidePhone
     * @return void
     */
    function setHidePhone($a_bHidePhone)
    {
        $this->_bHidePhone = (bool) $a_bHidePhone;
        $this->setSearchParameter('hide_phone', $this->_bHidePhone);
    }

    /**
     * Get User selector's 'user_title_id' property. 
     *
     * @return int|null
     */
    function getUserTitleId()
    {
        return is_null($this->_iUserTitleId) ? NULL : (int) $this->_iUserTitleId;
    }

    /**
     * Set User selector's 'user_title_id' property. 
     *
     * @param int|null $a_iUser selectorTitleId
     * @return void
     */
    function setUserTitleId($a_iUserTitleId)
    {
        $this->_iUserTitleId = is_null($a_iUserTitleId) ? NULL : (int) $a_iUserTitleId;
        $this->setSearchParameter('user_title_id', (int) $this->_iUserTitleId, is_null($this->_iUserTitleId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'login_cookie' property. 
     *
     * @return string|null
     */
    function getLoginCookie()
    {
        return is_null($this->_sLoginCookie) ? NULL : (string) $this->_sLoginCookie;
    }

    /**
     * Set User selector's 'login_cookie' property. 
     *
     * @param string|null $a_sLoginCookie
     * @return void
     */
    function setLoginCookie($a_sLoginCookie)
    {
        $this->_sLoginCookie = is_null($a_sLoginCookie) ? NULL : (string) $a_sLoginCookie;
        $this->setSearchParameter('login_cookie', (string) $this->_sLoginCookie, is_null($this->_sLoginCookie) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'floor' property. 
     *
     * @return string|null
     */
    function getFloor()
    {
        return is_null($this->_sFloor) ? NULL : (string) $this->_sFloor;
    }

    /**
     * Set User selector's 'floor' property. 
     *
     * @param string|null $a_sFloor
     * @return void
     */
    function setFloor($a_sFloor)
    {
        $this->_sFloor = is_null($a_sFloor) ? NULL : (string) $a_sFloor;
        $this->setSearchParameter('floor', (string) $this->_sFloor, is_null($this->_sFloor) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'address_id' property. 
     *
     * @return int|null
     */
    function getAddressId()
    {
        return is_null($this->_iAddressId) ? NULL : (int) $this->_iAddressId;
    }

    /**
     * Set User selector's 'address_id' property. 
     *
     * @param int|null $a_iAddressId
     * @return void
     */
    function setAddressId($a_iAddressId)
    {
        $this->_iAddressId = is_null($a_iAddressId) ? NULL : (int) $a_iAddressId;
        $this->setSearchParameter('address_id', (int) $this->_iAddressId, is_null($this->_iAddressId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'is_registered' property. 
     *
     * @return bool
     */
    function getIsRegistered()
    {
        return (bool) $this->_bIsRegistered;
    }

    /**
     * Set User selector's 'is_registered' property. 
     *
     * @param bool $a_bIsRegistered
     * @return void
     */
    function setIsRegistered($a_bIsRegistered)
    {
        $this->_bIsRegistered = (bool) $a_bIsRegistered;
        $this->setSearchParameter('is_registered', $this->_bIsRegistered);
    }

    /**
     * Get User selector's 'is_primary_member' property. 
     *
     * @return bool
     */
    function getIsPrimaryMember()
    {
        return (bool) $this->_bIsPrimaryMember;
    }

    /**
     * Set User selector's 'is_primary_member' property. 
     *
     * @param bool $a_bIsPrimaryMember
     * @return void
     */
    function setIsPrimaryMember($a_bIsPrimaryMember)
    {
        $this->_bIsPrimaryMember = (bool) $a_bIsPrimaryMember;
        $this->setSearchParameter('is_primary_member', $this->_bIsPrimaryMember);
    }

    /**
     * Get User selector's 'primary_member_id' property. 
     *
     * @return int|null
     */
    function getPrimaryMemberId()
    {
        return is_null($this->_iPrimaryMemberId) ? NULL : (int) $this->_iPrimaryMemberId;
    }

    /**
     * Set User selector's 'primary_member_id' property. 
     *
     * @param int|null $a_iPrimaryMemberId
     * @return void
     */
    function setPrimaryMemberId($a_iPrimaryMemberId)
    {
        $this->_iPrimaryMemberId = is_null($a_iPrimaryMemberId) ? NULL : (int) $a_iPrimaryMemberId;
        $this->setSearchParameter('primary_member_id', (int) $this->_iPrimaryMemberId, is_null($this->_iPrimaryMemberId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get User selector's 'address_number' property. 
     *
     * @return string|null
     */
    function getAddressNumber()
    {
        return is_null($this->_sAddressNumber) ? NULL : (string) $this->_sAddressNumber;
    }

    /**
     * Set User selector's 'address_number' property. 
     *
     * @param string|null $a_sAddressNumber
     * @return void
     */
    function setAddressNumber($a_sAddressNumber)
    {
        $this->_sAddressNumber = is_null($a_sAddressNumber) ? NULL : (string) $a_sAddressNumber;
        $this->setSearchParameter('address_number', (string) $this->_sAddressNumber, is_null($this->_sAddressNumber) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
