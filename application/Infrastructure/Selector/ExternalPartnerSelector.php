<?php

/**
 * Selector class for ExternalPartner. 
 *
 * @see ExternalPartner
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ExternalPartnerSelector extends Selector 
{


    /**
     * ExternalPartner selector's 'external_partner_type_id' property. 
     *
     * @var int
     */
    private $_iExternalPartnerTypeId;

    /**
     * ExternalPartner selector's 'partner_name' property. 
     *
     * @var string
     */
    private $_sPartnerName;

    /**
     * ExternalPartner selector's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * ExternalPartner selector's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * ExternalPartner selector's 'presentation_text' property. 
     *
     * @var string
     */
    private $_sPresentationText;

    /**
     * ExternalPartner selector's 'phone' property. 
     *
     * @var string
     */
    private $_sPhone;

    /**
     * ExternalPartner selector's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * ExternalPartner selector's 'contact_info' property. 
     *
     * @var string
     */
    private $_sContactInfo;
    /**
     * Get ExternalPartner selector's 'external_partner_type_id' property. 
     *
     * @return int
     */
    function getExternalPartnerTypeId()
    {
        return (int) $this->_iExternalPartnerTypeId;
    }

    /**
     * Set ExternalPartner selector's 'external_partner_type_id' property. 
     *
     * @param int $a_iExternalPartner selectorTypeId
     * @return void
     */
    function setExternalPartnerTypeId($a_iExternalPartnerTypeId)
    {
        $this->_iExternalPartnerTypeId = (int) $a_iExternalPartnerTypeId;
        $this->setSearchParameter('external_partner_type_id', $this->_iExternalPartnerTypeId);
    }

    /**
     * Get ExternalPartner selector's 'partner_name' property. 
     *
     * @return string
     */
    function getPartnerName()
    {
        return (string) $this->_sPartnerName;
    }

    /**
     * Set ExternalPartner selector's 'partner_name' property. 
     *
     * @param string $a_sPartnerName
     * @return void
     */
    function setPartnerName($a_sPartnerName)
    {
        $this->_sPartnerName = (string) $a_sPartnerName;
        $this->setSearchParameter('partner_name', $this->_sPartnerName);
    }

    /**
     * Get ExternalPartner selector's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set ExternalPartner selector's 'has_picture' property. 
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
     * Get ExternalPartner selector's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set ExternalPartner selector's 'image_type' property. 
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
     * Get ExternalPartner selector's 'presentation_text' property. 
     *
     * @return string|null
     */
    function getPresentationText()
    {
        return is_null($this->_sPresentationText) ? NULL : (string) $this->_sPresentationText;
    }

    /**
     * Set ExternalPartner selector's 'presentation_text' property. 
     *
     * @param string|null $a_sPresentationText
     * @return void
     */
    function setPresentationText($a_sPresentationText)
    {
        $this->_sPresentationText = is_null($a_sPresentationText) ? NULL : (string) $a_sPresentationText;
        $this->setSearchParameter('presentation_text', (string) $this->_sPresentationText, is_null($this->_sPresentationText) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get ExternalPartner selector's 'phone' property. 
     *
     * @return string|null
     */
    function getPhone()
    {
        return is_null($this->_sPhone) ? NULL : (string) $this->_sPhone;
    }

    /**
     * Set ExternalPartner selector's 'phone' property. 
     *
     * @param string|null $a_sPhone
     * @return void
     */
    function setPhone($a_sPhone)
    {
        $this->_sPhone = is_null($a_sPhone) ? NULL : (string) $a_sPhone;
        $this->setSearchParameter('phone', (string) $this->_sPhone, is_null($this->_sPhone) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get ExternalPartner selector's 'email' property. 
     *
     * @return string|null
     */
    function getEmail()
    {
        return is_null($this->_sEmail) ? NULL : (string) $this->_sEmail;
    }

    /**
     * Set ExternalPartner selector's 'email' property. 
     *
     * @param string|null $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        $this->_sEmail = is_null($a_sEmail) ? NULL : (string) $a_sEmail;
        $this->setSearchParameter('email', (string) $this->_sEmail, is_null($this->_sEmail) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get ExternalPartner selector's 'contact_info' property. 
     *
     * @return string|null
     */
    function getContactInfo()
    {
        return is_null($this->_sContactInfo) ? NULL : (string) $this->_sContactInfo;
    }

    /**
     * Set ExternalPartner selector's 'contact_info' property. 
     *
     * @param string|null $a_sContactInfo
     * @return void
     */
    function setContactInfo($a_sContactInfo)
    {
        $this->_sContactInfo = is_null($a_sContactInfo) ? NULL : (string) $a_sContactInfo;
        $this->setSearchParameter('contact_info', (string) $this->_sContactInfo, is_null($this->_sContactInfo) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
