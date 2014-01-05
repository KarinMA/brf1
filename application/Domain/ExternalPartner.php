<?php

/**
 * Domain object class for ExternalPartner. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class ExternalPartner extends DomainObject 
{
    /**
     * ExternalPartner's 'external_partner_type_id' property. 
     *
     * @var int
     */
    private $_iExternalPartnerTypeId;

    /**
     * ExternalPartner's 'partner_name' property. 
     *
     * @var string
     */
    private $_sPartnerName;

    /**
     * ExternalPartner's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * ExternalPartner's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * ExternalPartner's 'presentation_text' property. 
     *
     * @var string
     */
    private $_sPresentationText;

    /**
     * ExternalPartner's 'phone' property. 
     *
     * @var string
     */
    private $_sPhone;

    /**
     * ExternalPartner's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * ExternalPartner's 'contact_info' property. 
     *
     * @var string
     */
    private $_sContactInfo;

    /**
     * Get ExternalPartner's 'external_partner_type_id' property. 
     *
     * @return int
     */
    function getExternalPartnerTypeId()
    {
        return (int) $this->_iExternalPartnerTypeId;
    }

    /**
     * Set ExternalPartner's 'external_partner_type_id' property. 
     *
     * @param int $a_iExternalPartnerTypeId
     * @return void
     */
    function setExternalPartnerTypeId($a_iExternalPartnerTypeId)
    {
        if (!is_null($this->_iExternalPartnerTypeId) && $this->_iExternalPartnerTypeId !== (int) $a_iExternalPartnerTypeId) {
            $this->_markModified();
        }
        $this->_iExternalPartnerTypeId = (int) $a_iExternalPartnerTypeId;
    }

    /**
     * The ExternalPartnerType.
     * 
     * @var ExternalPartnerType
     */
    private $_oExternalPartnerType;

    /**
     * Get the ExternalPartnerType.
     * 
     * @return ExternalPartnerType
     */
    function getExternalPartnerType()
    {
        return $this->_oExternalPartnerType;
    }

    /**
     * Set the ExternalPartnerType.
     * 
     * @param ExternalPartnerType $a_oExternalPartnerType
     * 
     * @return void
     */
    function setExternalPartnerType($a_oExternalPartnerType)
    {
        $this->_iExternalPartnerTypeId = $a_oExternalPartnerType->getId();
        $this->_oExternalPartnerType = $a_oExternalPartnerType;
    }

    /**
     * Get ExternalPartner's 'partner_name' property. 
     *
     * @return string
     */
    function getPartnerName()
    {
        return (string) $this->_sPartnerName;
    }

    /**
     * Set ExternalPartner's 'partner_name' property. 
     *
     * @param string $a_sPartnerName
     * @return void
     */
    function setPartnerName($a_sPartnerName)
    {
        if (!is_null($this->_sPartnerName) && $this->_sPartnerName !== (string) $a_sPartnerName) {
            $this->_markModified();
        }
        $this->_sPartnerName = (string) $a_sPartnerName;
    }

    /**
     * Get ExternalPartner's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set ExternalPartner's 'has_picture' property. 
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
     * Get ExternalPartner's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set ExternalPartner's 'image_type' property. 
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
     * Get ExternalPartner's 'presentation_text' property. 
     *
     * @return string|null
     */
    function getPresentationText()
    {
        return is_null($this->_sPresentationText) ? NULL : (string) $this->_sPresentationText;
    }

    /**
     * Set ExternalPartner's 'presentation_text' property. 
     *
     * @param string|null $a_sPresentationText
     * @return void
     */
    function setPresentationText($a_sPresentationText)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sPresentationText) ? NULL : ((string) $a_sPresentationText);
            if ($mCompareValue !== $this->_sPresentationText) {
                $this->_markModified();
            }
        }
        $this->_sPresentationText = is_null($a_sPresentationText) ? NULL : (string) $a_sPresentationText;
    }

    /**
     * Get ExternalPartner's 'phone' property. 
     *
     * @return string|null
     */
    function getPhone()
    {
        return is_null($this->_sPhone) ? NULL : (string) $this->_sPhone;
    }

    /**
     * Set ExternalPartner's 'phone' property. 
     *
     * @param string|null $a_sPhone
     * @return void
     */
    function setPhone($a_sPhone)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sPhone) ? NULL : ((string) $a_sPhone);
            if ($mCompareValue !== $this->_sPhone) {
                $this->_markModified();
            }
        }
        $this->_sPhone = is_null($a_sPhone) ? NULL : (string) $a_sPhone;
    }

    /**
     * Get ExternalPartner's 'email' property. 
     *
     * @return string|null
     */
    function getEmail()
    {
        return is_null($this->_sEmail) ? NULL : (string) $this->_sEmail;
    }

    /**
     * Set ExternalPartner's 'email' property. 
     *
     * @param string|null $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sEmail) ? NULL : ((string) $a_sEmail);
            if ($mCompareValue !== $this->_sEmail) {
                $this->_markModified();
            }
        }
        $this->_sEmail = is_null($a_sEmail) ? NULL : (string) $a_sEmail;
    }

    /**
     * Get ExternalPartner's 'contact_info' property. 
     *
     * @return string|null
     */
    function getContactInfo()
    {
        return is_null($this->_sContactInfo) ? NULL : (string) $this->_sContactInfo;
    }

    /**
     * Set ExternalPartner's 'contact_info' property. 
     *
     * @param string|null $a_sContactInfo
     * @return void
     */
    function setContactInfo($a_sContactInfo)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sContactInfo) ? NULL : ((string) $a_sContactInfo);
            if ($mCompareValue !== $this->_sContactInfo) {
                $this->_markModified();
            }
        }
        $this->_sContactInfo = is_null($a_sContactInfo) ? NULL : (string) $a_sContactInfo;
    }

    /**
     * This ExternalPartner's User collection.
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



    public static function create($a_iExternalPartnerTypeId, $a_sPartnerName, $a_bHasPicture, $a_sImageType, $a_sPresentationText, $a_sPhone, $a_sEmail, $a_sContactInfo, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('external_partner')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('external_partner')->write($oObject);
        }
        return $oObject;
    }

}
