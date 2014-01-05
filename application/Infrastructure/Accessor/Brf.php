<?php

/**
 * Database accessor class for Brf. 
 *
 * @see Accessor 
 * @see Brf
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Brf extends Accessor
{


    /**
     * Get Brfs by 'name' property. 
     *
     * @param string $a_sName
     * @return Collection
     */
    function getBrfsByName($a_sName)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setName($a_sName);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'url' property. 
     *
     * @param string $a_sUrl
     * @return Collection
     */
    function getBrfsByUrl($a_sUrl)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setUrl($a_sUrl);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'government_number' property. 
     *
     * @param string $a_sGovernmentNumber
     * @return Collection
     */
    function getBrfsByGovernmentNumber($a_sGovernmentNumber)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setGovernmentNumber($a_sGovernmentNumber);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'address' property. 
     *
     * @param string $a_sAddress
     * @return Collection
     */
    function getBrfsByAddress($a_sAddress)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setAddress($a_sAddress);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'street_number' property. 
     *
     * @param string $a_sStreetNumber
     * @return Collection
     */
    function getBrfsByStreetNumber($a_sStreetNumber)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setStreetNumber($a_sStreetNumber);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'street_number2' property. 
     *
     * @param string $a_sStreetNumber2
     * @return Collection
     */
    function getBrfsByStreetNumber2($a_sStreetNumber2)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setStreetNumber2($a_sStreetNumber2);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'zip' property. 
     *
     * @param int $a_iZip
     * @return Collection
     */
    function getBrfsByZip($a_iZip)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setZip($a_iZip);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'build_year' property. 
     *
     * @param int $a_iBuildYear
     * @return Collection
     */
    function getBrfsByBuildYear($a_iBuildYear)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setBuildYear($a_iBuildYear);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'register_year' property. 
     *
     * @param int $a_iRegisterYear
     * @return Collection
     */
    function getBrfsByRegisterYear($a_iRegisterYear)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setRegisterYear($a_iRegisterYear);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'postal_address' property. 
     *
     * @param string $a_sPostalAddress
     * @return Collection
     */
    function getBrfsByPostalAddress($a_sPostalAddress)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setPostalAddress($a_sPostalAddress);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'apartments' property. 
     *
     * @param int $a_iApartments
     * @return Collection
     */
    function getBrfsByApartments($a_iApartments)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setApartments($a_iApartments);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'presentation' property. 
     *
     * @param string $a_sPresentation
     * @return Collection
     */
    function getBrfsByPresentation($a_sPresentation)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setPresentation($a_sPresentation);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'activated' property. 
     *
     * @param bool $a_bActivated
     * @return Collection
     */
    function getBrfsByActivated($a_bActivated)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setActivated($a_bActivated);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return Collection
     */
    function getBrfsByRealtorUserId($a_iRealtorUserId)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setRealtorUserId($a_iRealtorUserId);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'show_street_view' property. 
     *
     * @param bool $a_bShowStreetView
     * @return Collection
     */
    function getBrfsByShowStreetView($a_bShowStreetView)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setShowStreetView($a_bShowStreetView);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Get Brfs by 'co_address' property. 
     *
     * @param string $a_sCoAddress
     * @return Collection
     */
    function getBrfsByCoAddress($a_sCoAddress)
    {
        $oBrfSelector = getBrfSelector();
        $oBrfSelector->setCoAddress($a_sCoAddress);
        $oBrfCollection = $this->read($oBrfSelector);
        return $oBrfCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf', 'Brf', new SelectionFactory_Brf(), new DomainFactory_BrfFactory(), new UpdateFactory_Brf(), array(
            array('resource', array('dependent_objects', 'brf_id', 'getBrfId')), // gets orders customer id
            array('brf_address', array('dependent_objects', 'brf_id', 'getBrfId')), // gets orders customer id
            array('user', array('linked_object', 'realtor_user_id', 'setRealtorUser')), // gets product with product id
        ));
    }




}
