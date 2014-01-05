<?php

/**
 * Database accessor class for ExternalPartner. 
 *
 * @see Accessor 
 * @see ExternalPartner
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_ExternalPartner extends Accessor
{


    /**
     * Get ExternalPartners by 'external_partner_type_id' property. 
     *
     * @param int $a_iExternalPartnerTypeId
     * @return Collection
     */
    function getExternalPartnersByExternalPartnerTypeId($a_iExternalPartnerTypeId)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setExternalPartnerTypeId($a_iExternalPartnerTypeId);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'partner_name' property. 
     *
     * @param string $a_sPartnerName
     * @return Collection
     */
    function getExternalPartnersByPartnerName($a_sPartnerName)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setPartnerName($a_sPartnerName);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return Collection
     */
    function getExternalPartnersByHasPicture($a_bHasPicture)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setHasPicture($a_bHasPicture);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return Collection
     */
    function getExternalPartnersByImageType($a_sImageType)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setImageType($a_sImageType);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'presentation_text' property. 
     *
     * @param string $a_sPresentationText
     * @return Collection
     */
    function getExternalPartnersByPresentationText($a_sPresentationText)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setPresentationText($a_sPresentationText);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'phone' property. 
     *
     * @param string $a_sPhone
     * @return Collection
     */
    function getExternalPartnersByPhone($a_sPhone)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setPhone($a_sPhone);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'email' property. 
     *
     * @param string $a_sEmail
     * @return Collection
     */
    function getExternalPartnersByEmail($a_sEmail)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setEmail($a_sEmail);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Get ExternalPartners by 'contact_info' property. 
     *
     * @param string $a_sContactInfo
     * @return Collection
     */
    function getExternalPartnersByContactInfo($a_sContactInfo)
    {
        $oExternalPartnerSelector = getExternalPartnerSelector();
        $oExternalPartnerSelector->setContactInfo($a_sContactInfo);
        $oExternalPartnerCollection = $this->read($oExternalPartnerSelector);
        return $oExternalPartnerCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'external_partner', 'ExternalPartner', new SelectionFactory_ExternalPartner(), new DomainFactory_ExternalPartnerFactory(), new UpdateFactory_ExternalPartner(), array(
            array('external_partner_type', array('linked_object', 'external_partner_type_id', 'setExternalPartnerType')), // gets product with product id
        ));
    }




}
