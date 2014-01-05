<?php

/**
 * Selector class for Brf. 
 *
 * @see Brf
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfSelector extends Selector 
{


    /**
     * Brf selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Brf selector's 'url' property. 
     *
     * @var string
     */
    private $_sUrl;

    /**
     * Brf selector's 'government_number' property. 
     *
     * @var string
     */
    private $_sGovernmentNumber;

    /**
     * Brf selector's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * Brf selector's 'street_number' property. 
     *
     * @var string
     */
    private $_sStreetNumber;

    /**
     * Brf selector's 'street_number2' property. 
     *
     * @var string
     */
    private $_sStreetNumber2;

    /**
     * Brf selector's 'zip' property. 
     *
     * @var int
     */
    private $_iZip;

    /**
     * Brf selector's 'build_year' property. 
     *
     * @var int
     */
    private $_iBuildYear;

    /**
     * Brf selector's 'register_year' property. 
     *
     * @var int
     */
    private $_iRegisterYear;

    /**
     * Brf selector's 'postal_address' property. 
     *
     * @var string
     */
    private $_sPostalAddress;

    /**
     * Brf selector's 'apartments' property. 
     *
     * @var int
     */
    private $_iApartments;

    /**
     * Brf selector's 'presentation' property. 
     *
     * @var string
     */
    private $_sPresentation;

    /**
     * Brf selector's 'activated' property. 
     *
     * @var bool
     */
    private $_bActivated;

    /**
     * Brf selector's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * Brf selector's 'show_street_view' property. 
     *
     * @var bool
     */
    private $_bShowStreetView;

    /**
     * Brf selector's 'co_address' property. 
     *
     * @var string
     */
    private $_sCoAddress;
    /**
     * Get Brf selector's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Brf selector's 'name' property. 
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
     * Get Brf selector's 'url' property. 
     *
     * @return string
     */
    function getUrl()
    {
        return (string) $this->_sUrl;
    }

    /**
     * Set Brf selector's 'url' property. 
     *
     * @param string $a_sUrl
     * @return void
     */
    function setUrl($a_sUrl)
    {
        $this->_sUrl = (string) $a_sUrl;
        $this->setSearchParameter('url', $this->_sUrl);
    }

    /**
     * Get Brf selector's 'government_number' property. 
     *
     * @return string
     */
    function getGovernmentNumber()
    {
        return (string) $this->_sGovernmentNumber;
    }

    /**
     * Set Brf selector's 'government_number' property. 
     *
     * @param string $a_sGovernmentNumber
     * @return void
     */
    function setGovernmentNumber($a_sGovernmentNumber)
    {
        $this->_sGovernmentNumber = (string) $a_sGovernmentNumber;
        $this->setSearchParameter('government_number', $this->_sGovernmentNumber);
    }

    /**
     * Get Brf selector's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set Brf selector's 'address' property. 
     *
     * @param string $a_sAddress
     * @return void
     */
    function setAddress($a_sAddress)
    {
        $this->_sAddress = (string) $a_sAddress;
        $this->setSearchParameter('address', $this->_sAddress);
    }

    /**
     * Get Brf selector's 'street_number' property. 
     *
     * @return string|null
     */
    function getStreetNumber()
    {
        return is_null($this->_sStreetNumber) ? NULL : (string) $this->_sStreetNumber;
    }

    /**
     * Set Brf selector's 'street_number' property. 
     *
     * @param string|null $a_sStreetNumber
     * @return void
     */
    function setStreetNumber($a_sStreetNumber)
    {
        $this->_sStreetNumber = is_null($a_sStreetNumber) ? NULL : (string) $a_sStreetNumber;
        $this->setSearchParameter('street_number', (string) $this->_sStreetNumber, is_null($this->_sStreetNumber) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Brf selector's 'street_number2' property. 
     *
     * @return string|null
     */
    function getStreetNumber2()
    {
        return is_null($this->_sStreetNumber2) ? NULL : (string) $this->_sStreetNumber2;
    }

    /**
     * Set Brf selector's 'street_number2' property. 
     *
     * @param string|null $a_sStreetNumber2
     * @return void
     */
    function setStreetNumber2($a_sStreetNumber2)
    {
        $this->_sStreetNumber2 = is_null($a_sStreetNumber2) ? NULL : (string) $a_sStreetNumber2;
        $this->setSearchParameter('street_number2', (string) $this->_sStreetNumber2, is_null($this->_sStreetNumber2) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Brf selector's 'zip' property. 
     *
     * @return int
     */
    function getZip()
    {
        return (int) $this->_iZip;
    }

    /**
     * Set Brf selector's 'zip' property. 
     *
     * @param int $a_iZip
     * @return void
     */
    function setZip($a_iZip)
    {
        $this->_iZip = (int) $a_iZip;
        $this->setSearchParameter('zip', $this->_iZip);
    }

    /**
     * Get Brf selector's 'build_year' property. 
     *
     * @return int|null
     */
    function getBuildYear()
    {
        return is_null($this->_iBuildYear) ? NULL : (int) $this->_iBuildYear;
    }

    /**
     * Set Brf selector's 'build_year' property. 
     *
     * @param int|null $a_iBuildYear
     * @return void
     */
    function setBuildYear($a_iBuildYear)
    {
        $this->_iBuildYear = is_null($a_iBuildYear) ? NULL : (int) $a_iBuildYear;
        $this->setSearchParameter('build_year', (int) $this->_iBuildYear, is_null($this->_iBuildYear) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Brf selector's 'register_year' property. 
     *
     * @return int|null
     */
    function getRegisterYear()
    {
        return is_null($this->_iRegisterYear) ? NULL : (int) $this->_iRegisterYear;
    }

    /**
     * Set Brf selector's 'register_year' property. 
     *
     * @param int|null $a_iRegisterYear
     * @return void
     */
    function setRegisterYear($a_iRegisterYear)
    {
        $this->_iRegisterYear = is_null($a_iRegisterYear) ? NULL : (int) $a_iRegisterYear;
        $this->setSearchParameter('register_year', (int) $this->_iRegisterYear, is_null($this->_iRegisterYear) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Brf selector's 'postal_address' property. 
     *
     * @return string
     */
    function getPostalAddress()
    {
        return (string) $this->_sPostalAddress;
    }

    /**
     * Set Brf selector's 'postal_address' property. 
     *
     * @param string $a_sPostalAddress
     * @return void
     */
    function setPostalAddress($a_sPostalAddress)
    {
        $this->_sPostalAddress = (string) $a_sPostalAddress;
        $this->setSearchParameter('postal_address', $this->_sPostalAddress);
    }

    /**
     * Get Brf selector's 'apartments' property. 
     *
     * @return int
     */
    function getApartments()
    {
        return (int) $this->_iApartments;
    }

    /**
     * Set Brf selector's 'apartments' property. 
     *
     * @param int $a_iApartments
     * @return void
     */
    function setApartments($a_iApartments)
    {
        $this->_iApartments = (int) $a_iApartments;
        $this->setSearchParameter('apartments', $this->_iApartments);
    }

    /**
     * Get Brf selector's 'presentation' property. 
     *
     * @return string
     */
    function getPresentation()
    {
        return (string) $this->_sPresentation;
    }

    /**
     * Set Brf selector's 'presentation' property. 
     *
     * @param string $a_sPresentation
     * @return void
     */
    function setPresentation($a_sPresentation)
    {
        $this->_sPresentation = (string) $a_sPresentation;
        $this->setSearchParameter('presentation', $this->_sPresentation);
    }

    /**
     * Get Brf selector's 'activated' property. 
     *
     * @return bool
     */
    function getActivated()
    {
        return (bool) $this->_bActivated;
    }

    /**
     * Set Brf selector's 'activated' property. 
     *
     * @param bool $a_bActivated
     * @return void
     */
    function setActivated($a_bActivated)
    {
        $this->_bActivated = (bool) $a_bActivated;
        $this->setSearchParameter('activated', $this->_bActivated);
    }

    /**
     * Get Brf selector's 'realtor_user_id' property. 
     *
     * @return int|null
     */
    function getRealtorUserId()
    {
        return is_null($this->_iRealtorUserId) ? NULL : (int) $this->_iRealtorUserId;
    }

    /**
     * Set Brf selector's 'realtor_user_id' property. 
     *
     * @param int|null $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        $this->_iRealtorUserId = is_null($a_iRealtorUserId) ? NULL : (int) $a_iRealtorUserId;
        $this->setSearchParameter('realtor_user_id', (int) $this->_iRealtorUserId, is_null($this->_iRealtorUserId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Brf selector's 'show_street_view' property. 
     *
     * @return bool
     */
    function getShowStreetView()
    {
        return (bool) $this->_bShowStreetView;
    }

    /**
     * Set Brf selector's 'show_street_view' property. 
     *
     * @param bool $a_bShowStreetView
     * @return void
     */
    function setShowStreetView($a_bShowStreetView)
    {
        $this->_bShowStreetView = (bool) $a_bShowStreetView;
        $this->setSearchParameter('show_street_view', $this->_bShowStreetView);
    }

    /**
     * Get Brf selector's 'co_address' property. 
     *
     * @return string|null
     */
    function getCoAddress()
    {
        return is_null($this->_sCoAddress) ? NULL : (string) $this->_sCoAddress;
    }

    /**
     * Set Brf selector's 'co_address' property. 
     *
     * @param string|null $a_sCoAddress
     * @return void
     */
    function setCoAddress($a_sCoAddress)
    {
        $this->_sCoAddress = is_null($a_sCoAddress) ? NULL : (string) $a_sCoAddress;
        $this->setSearchParameter('co_address', (string) $this->_sCoAddress, is_null($this->_sCoAddress) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
