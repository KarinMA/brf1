<?php

/**
 * Domain object class for Brf. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Brf extends DomainObject 
{
    /**
     * Brf's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Brf's 'url' property. 
     *
     * @var string
     */
    private $_sUrl;

    /**
     * Brf's 'government_number' property. 
     *
     * @var string
     */
    private $_sGovernmentNumber;

    /**
     * Brf's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * Brf's 'street_number' property. 
     *
     * @var string
     */
    private $_sStreetNumber;

    /**
     * Brf's 'street_number2' property. 
     *
     * @var string
     */
    private $_sStreetNumber2;

    /**
     * Brf's 'zip' property. 
     *
     * @var int
     */
    private $_iZip;

    /**
     * Brf's 'build_year' property. 
     *
     * @var int
     */
    private $_iBuildYear;

    /**
     * Brf's 'register_year' property. 
     *
     * @var int
     */
    private $_iRegisterYear;

    /**
     * Brf's 'postal_address' property. 
     *
     * @var string
     */
    private $_sPostalAddress;

    /**
     * Brf's 'apartments' property. 
     *
     * @var int
     */
    private $_iApartments;

    /**
     * Brf's 'presentation' property. 
     *
     * @var string
     */
    private $_sPresentation;

    /**
     * Brf's 'activated' property. 
     *
     * @var bool
     */
    private $_bActivated;

    /**
     * Brf's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * Brf's 'show_street_view' property. 
     *
     * @var bool
     */
    private $_bShowStreetView;

    /**
     * Brf's 'co_address' property. 
     *
     * @var string
     */
    private $_sCoAddress;

    /**
     * Get Brf's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Brf's 'name' property. 
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
     * Get Brf's 'url' property. 
     *
     * @return string
     */
    function getUrl()
    {
        return (string) $this->_sUrl;
    }

    /**
     * Set Brf's 'url' property. 
     *
     * @param string $a_sUrl
     * @return void
     */
    function setUrl($a_sUrl)
    {
        if (!is_null($this->_sUrl) && $this->_sUrl !== (string) $a_sUrl) {
            $this->_markModified();
        }
        $this->_sUrl = (string) $a_sUrl;
    }

    /**
     * Get Brf's 'government_number' property. 
     *
     * @return string
     */
    function getGovernmentNumber()
    {
        return (string) $this->_sGovernmentNumber;
    }

    /**
     * Set Brf's 'government_number' property. 
     *
     * @param string $a_sGovernmentNumber
     * @return void
     */
    function setGovernmentNumber($a_sGovernmentNumber)
    {
        if (!is_null($this->_sGovernmentNumber) && $this->_sGovernmentNumber !== (string) $a_sGovernmentNumber) {
            $this->_markModified();
        }
        $this->_sGovernmentNumber = (string) $a_sGovernmentNumber;
    }

    /**
     * Get Brf's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set Brf's 'address' property. 
     *
     * @param string $a_sAddress
     * @return void
     */
    function setAddress($a_sAddress)
    {
        if (!is_null($this->_sAddress) && $this->_sAddress !== (string) $a_sAddress) {
            $this->_markModified();
        }
        $this->_sAddress = (string) $a_sAddress;
    }

    /**
     * Get Brf's 'street_number' property. 
     *
     * @return string|null
     */
    function getStreetNumber()
    {
        return is_null($this->_sStreetNumber) ? NULL : (string) $this->_sStreetNumber;
    }

    /**
     * Set Brf's 'street_number' property. 
     *
     * @param string|null $a_sStreetNumber
     * @return void
     */
    function setStreetNumber($a_sStreetNumber)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sStreetNumber) ? NULL : ((string) $a_sStreetNumber);
            if ($mCompareValue !== $this->_sStreetNumber) {
                $this->_markModified();
            }
        }
        $this->_sStreetNumber = is_null($a_sStreetNumber) ? NULL : (string) $a_sStreetNumber;
    }

    /**
     * Get Brf's 'street_number2' property. 
     *
     * @return string|null
     */
    function getStreetNumber2()
    {
        return is_null($this->_sStreetNumber2) ? NULL : (string) $this->_sStreetNumber2;
    }

    /**
     * Set Brf's 'street_number2' property. 
     *
     * @param string|null $a_sStreetNumber2
     * @return void
     */
    function setStreetNumber2($a_sStreetNumber2)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sStreetNumber2) ? NULL : ((string) $a_sStreetNumber2);
            if ($mCompareValue !== $this->_sStreetNumber2) {
                $this->_markModified();
            }
        }
        $this->_sStreetNumber2 = is_null($a_sStreetNumber2) ? NULL : (string) $a_sStreetNumber2;
    }

    /**
     * Get Brf's 'zip' property. 
     *
     * @return int
     */
    function getZip()
    {
        return (int) $this->_iZip;
    }

    /**
     * Set Brf's 'zip' property. 
     *
     * @param int $a_iZip
     * @return void
     */
    function setZip($a_iZip)
    {
        if (!is_null($this->_iZip) && $this->_iZip !== (int) $a_iZip) {
            $this->_markModified();
        }
        $this->_iZip = (int) $a_iZip;
    }

    /**
     * Get Brf's 'build_year' property. 
     *
     * @return int|null
     */
    function getBuildYear()
    {
        return is_null($this->_iBuildYear) ? NULL : (int) $this->_iBuildYear;
    }

    /**
     * Set Brf's 'build_year' property. 
     *
     * @param int|null $a_iBuildYear
     * @return void
     */
    function setBuildYear($a_iBuildYear)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iBuildYear) ? NULL : ((int) $a_iBuildYear);
            if ($mCompareValue !== $this->_iBuildYear) {
                $this->_markModified();
            }
        }
        $this->_iBuildYear = is_null($a_iBuildYear) ? NULL : (int) $a_iBuildYear;
    }

    /**
     * Get Brf's 'register_year' property. 
     *
     * @return int|null
     */
    function getRegisterYear()
    {
        return is_null($this->_iRegisterYear) ? NULL : (int) $this->_iRegisterYear;
    }

    /**
     * Set Brf's 'register_year' property. 
     *
     * @param int|null $a_iRegisterYear
     * @return void
     */
    function setRegisterYear($a_iRegisterYear)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iRegisterYear) ? NULL : ((int) $a_iRegisterYear);
            if ($mCompareValue !== $this->_iRegisterYear) {
                $this->_markModified();
            }
        }
        $this->_iRegisterYear = is_null($a_iRegisterYear) ? NULL : (int) $a_iRegisterYear;
    }

    /**
     * Get Brf's 'postal_address' property. 
     *
     * @return string
     */
    function getPostalAddress()
    {
        return (string) $this->_sPostalAddress;
    }

    /**
     * Set Brf's 'postal_address' property. 
     *
     * @param string $a_sPostalAddress
     * @return void
     */
    function setPostalAddress($a_sPostalAddress)
    {
        if (!is_null($this->_sPostalAddress) && $this->_sPostalAddress !== (string) $a_sPostalAddress) {
            $this->_markModified();
        }
        $this->_sPostalAddress = (string) $a_sPostalAddress;
    }

    /**
     * Get Brf's 'apartments' property. 
     *
     * @return int
     */
    function getApartments()
    {
        return (int) $this->_iApartments;
    }

    /**
     * Set Brf's 'apartments' property. 
     *
     * @param int $a_iApartments
     * @return void
     */
    function setApartments($a_iApartments)
    {
        if (!is_null($this->_iApartments) && $this->_iApartments !== (int) $a_iApartments) {
            $this->_markModified();
        }
        $this->_iApartments = (int) $a_iApartments;
    }

    /**
     * Get Brf's 'presentation' property. 
     *
     * @return string
     */
    function getPresentation()
    {
        return (string) $this->_sPresentation;
    }

    /**
     * Set Brf's 'presentation' property. 
     *
     * @param string $a_sPresentation
     * @return void
     */
    function setPresentation($a_sPresentation)
    {
        if (!is_null($this->_sPresentation) && $this->_sPresentation !== (string) $a_sPresentation) {
            $this->_markModified();
        }
        $this->_sPresentation = (string) $a_sPresentation;
    }

    /**
     * Get Brf's 'activated' property. 
     *
     * @return bool
     */
    function getActivated()
    {
        return (bool) $this->_bActivated;
    }

    /**
     * Set Brf's 'activated' property. 
     *
     * @param bool $a_bActivated
     * @return void
     */
    function setActivated($a_bActivated)
    {
        if (!is_null($this->_bActivated) && $this->_bActivated !== (bool) $a_bActivated) {
            $this->_markModified();
        }
        $this->_bActivated = (bool) $a_bActivated;
    }

    /**
     * Get Brf's 'realtor_user_id' property. 
     *
     * @return int|null
     */
    function getRealtorUserId()
    {
        return is_null($this->_iRealtorUserId) ? NULL : (int) $this->_iRealtorUserId;
    }

    /**
     * Set Brf's 'realtor_user_id' property. 
     *
     * @param int|null $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iRealtorUserId) ? NULL : ((int) $a_iRealtorUserId);
            if ($mCompareValue !== $this->_iRealtorUserId) {
                $this->_markModified();
            }
        }
        $this->_iRealtorUserId = is_null($a_iRealtorUserId) ? NULL : (int) $a_iRealtorUserId;
    }

    /**
     * The RealtorUser.
     * 
     * @var RealtorUser
     */
    private $_oRealtorUser;

    /**
     * Get the RealtorUser.
     * 
     * @return RealtorUser
     */
    function getRealtorUser()
    {
        return $this->_oRealtorUser;
    }

    /**
     * Set the RealtorUser.
     * 
     * @param RealtorUser $a_oRealtorUser
     * 
     * @return void
     */
    function setRealtorUser($a_oRealtorUser)
    {
        $this->_iRealtorUserId = $a_oRealtorUser->getId();
        $this->_oRealtorUser = $a_oRealtorUser;
    }

    /**
     * Get Brf's 'show_street_view' property. 
     *
     * @return bool
     */
    function getShowStreetView()
    {
        return (bool) $this->_bShowStreetView;
    }

    /**
     * Set Brf's 'show_street_view' property. 
     *
     * @param bool $a_bShowStreetView
     * @return void
     */
    function setShowStreetView($a_bShowStreetView)
    {
        if (!is_null($this->_bShowStreetView) && $this->_bShowStreetView !== (bool) $a_bShowStreetView) {
            $this->_markModified();
        }
        $this->_bShowStreetView = (bool) $a_bShowStreetView;
    }

    /**
     * Get Brf's 'co_address' property. 
     *
     * @return string|null
     */
    function getCoAddress()
    {
        return is_null($this->_sCoAddress) ? NULL : (string) $this->_sCoAddress;
    }

    /**
     * Set Brf's 'co_address' property. 
     *
     * @param string|null $a_sCoAddress
     * @return void
     */
    function setCoAddress($a_sCoAddress)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sCoAddress) ? NULL : ((string) $a_sCoAddress);
            if ($mCompareValue !== $this->_sCoAddress) {
                $this->_markModified();
            }
        }
        $this->_sCoAddress = is_null($a_sCoAddress) ? NULL : (string) $a_sCoAddress;
    }

    /**
     * This Brf's BrfAddress collection.
     * 
     * @var Collection
     */
    private $_oBrfAddressCollection;

    /**
     * Get BrfAddress collection.
     * 
     * @see BrfAddress
     * 
     * @return Collection
     */
    function getBrfAddressCollection()
    {
        if (!isset($this->_oBrfAddressCollection)) {
            $this->_oBrfAddressCollection = new Collection();
        }
        return $this->_oBrfAddressCollection;
    }

    /**
     * This Brf's BrfFelanmalan collection.
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
     * This Brf's BrfPicture collection.
     * 
     * @var Collection
     */
    private $_oBrfPictureCollection;

    /**
     * Get BrfPicture collection.
     * 
     * @see BrfPicture
     * 
     * @return Collection
     */
    function getBrfPictureCollection()
    {
        if (!isset($this->_oBrfPictureCollection)) {
            $this->_oBrfPictureCollection = new Collection();
        }
        return $this->_oBrfPictureCollection;
    }

    /**
     * This Brf's BrfRealtorCode collection.
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
     * This Brf's BrfRealtorLog collection.
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
     * This Brf's BrfSetting collection.
     * 
     * @var Collection
     */
    private $_oBrfSettingCollection;

    /**
     * Get BrfSetting collection.
     * 
     * @see BrfSetting
     * 
     * @return Collection
     */
    function getBrfSettingCollection()
    {
        if (!isset($this->_oBrfSettingCollection)) {
            $this->_oBrfSettingCollection = new Collection();
        }
        return $this->_oBrfSettingCollection;
    }

    /**
     * This Brf's Calendar collection.
     * 
     * @var Collection
     */
    private $_oCalendarCollection;

    /**
     * Get Calendar collection.
     * 
     * @see Calendar
     * 
     * @return Collection
     */
    function getCalendarCollection()
    {
        if (!isset($this->_oCalendarCollection)) {
            $this->_oCalendarCollection = new Collection();
        }
        return $this->_oCalendarCollection;
    }

    /**
     * This Brf's Document collection.
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
     * This Brf's Message collection.
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
     * This Brf's Notice collection.
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

    /**
     * This Brf's PresidentLog collection.
     * 
     * @var Collection
     */
    private $_oPresidentLogCollection;

    /**
     * Get PresidentLog collection.
     * 
     * @see PresidentLog
     * 
     * @return Collection
     */
    function getPresidentLogCollection()
    {
        if (!isset($this->_oPresidentLogCollection)) {
            $this->_oPresidentLogCollection = new Collection();
        }
        return $this->_oPresidentLogCollection;
    }

    /**
     * This Brf's PresidentLogCategory collection.
     * 
     * @var Collection
     */
    private $_oPresidentLogCategoryCollection;

    /**
     * Get PresidentLogCategory collection.
     * 
     * @see PresidentLogCategory
     * 
     * @return Collection
     */
    function getPresidentLogCategoryCollection()
    {
        if (!isset($this->_oPresidentLogCategoryCollection)) {
            $this->_oPresidentLogCategoryCollection = new Collection();
        }
        return $this->_oPresidentLogCategoryCollection;
    }

    /**
     * This Brf's RealtorInformation collection.
     * 
     * @var Collection
     */
    private $_oRealtorInformationCollection;

    /**
     * Get RealtorInformation collection.
     * 
     * @see RealtorInformation
     * 
     * @return Collection
     */
    function getRealtorInformationCollection()
    {
        if (!isset($this->_oRealtorInformationCollection)) {
            $this->_oRealtorInformationCollection = new Collection();
        }
        return $this->_oRealtorInformationCollection;
    }

    /**
     * This Brf's RealtorInformationHistory collection.
     * 
     * @var Collection
     */
    private $_oRealtorInformationHistoryCollection;

    /**
     * Get RealtorInformationHistory collection.
     * 
     * @see RealtorInformationHistory
     * 
     * @return Collection
     */
    function getRealtorInformationHistoryCollection()
    {
        if (!isset($this->_oRealtorInformationHistoryCollection)) {
            $this->_oRealtorInformationHistoryCollection = new Collection();
        }
        return $this->_oRealtorInformationHistoryCollection;
    }

    /**
     * This Brf's Resource collection.
     * 
     * @var Collection
     */
    private $_oResourceCollection;

    /**
     * Get Resource collection.
     * 
     * @see Resource
     * 
     * @return Collection
     */
    function getResourceCollection()
    {
        if (!isset($this->_oResourceCollection)) {
            $this->_oResourceCollection = new Collection();
        }
        return $this->_oResourceCollection;
    }

    /**
     * This Brf's User collection.
     * 
     * @var Collection
     */
    private $_oUserCollection;

    /**
     * Get User collection.
     * 
     * @see User
     * 
     * @return Collection
     */
    function getUserCollection()
    {
        if (!isset($this->_oUserCollection)) {
            $this->_oUserCollection = new Collection();
        }
        return $this->_oUserCollection;
    }

    /**
     * This Brf's WebformActivation collection.
     * 
     * @var Collection
     */
    private $_oWebformActivationCollection;

    /**
     * Get WebformActivation collection.
     * 
     * @see WebformActivation
     * 
     * @return Collection
     */
    function getWebformActivationCollection()
    {
        if (!isset($this->_oWebformActivationCollection)) {
            $this->_oWebformActivationCollection = new Collection();
        }
        return $this->_oWebformActivationCollection;
    }



    public static function create($a_sName, $a_sUrl, $a_sGovernmentNumber, $a_sAddress, $a_sStreetNumber, $a_sStreetNumber2, $a_iZip, $a_iBuildYear, $a_iRegisterYear, $a_sPostalAddress, $a_iApartments, $a_sPresentation, $a_bActivated, $a_iRealtorUserId, $a_bShowStreetView, $a_sCoAddress, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf')->write($oObject);
        }
        return $oObject;
    }

}
