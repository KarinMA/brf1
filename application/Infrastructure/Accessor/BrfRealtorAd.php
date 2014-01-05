<?php

/**
 * Database accessor class for BrfRealtorAd. 
 *
 * @see Accessor 
 * @see BrfRealtorAd
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfRealtorAd extends Accessor
{


    /**
     * Get BrfRealtorAds by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfRealtorAdsByBrfId($a_iBrfId)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setBrfId($a_iBrfId);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return Collection
     */
    function getBrfRealtorAdsByRealtorUserId($a_iRealtorUserId)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setRealtorUserId($a_iRealtorUserId);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'rooms' property. 
     *
     * @param float $a_fRooms
     * @return Collection
     */
    function getBrfRealtorAdsByRooms($a_fRooms)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setRooms($a_fRooms);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'address' property. 
     *
     * @param string $a_sAddress
     * @return Collection
     */
    function getBrfRealtorAdsByAddress($a_sAddress)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setAddress($a_sAddress);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'stairs' property. 
     *
     * @param string $a_sStairs
     * @return Collection
     */
    function getBrfRealtorAdsByStairs($a_sStairs)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setStairs($a_sStairs);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'fee' property. 
     *
     * @param int $a_iFee
     * @return Collection
     */
    function getBrfRealtorAdsByFee($a_iFee)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setFee($a_iFee);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'price' property. 
     *
     * @param int $a_iPrice
     * @return Collection
     */
    function getBrfRealtorAdsByPrice($a_iPrice)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setPrice($a_iPrice);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'square_meters' property. 
     *
     * @param int $a_iSquareMeters
     * @return Collection
     */
    function getBrfRealtorAdsBySquareMeters($a_iSquareMeters)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setSquareMeters($a_iSquareMeters);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return Collection
     */
    function getBrfRealtorAdsByCreatedOn($a_sCreatedOn)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setCreatedOn($a_sCreatedOn);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'realtor_ad_link' property. 
     *
     * @param string $a_sRealtorAdLink
     * @return Collection
     */
    function getBrfRealtorAdsByRealtorAdLink($a_sRealtorAdLink)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setRealtorAdLink($a_sRealtorAdLink);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'price_type' property. 
     *
     * @param string $a_sPriceType
     * @return Collection
     */
    function getBrfRealtorAdsByPriceType($a_sPriceType)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setPriceType($a_sPriceType);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return Collection
     */
    function getBrfRealtorAdsByHasPicture($a_bHasPicture)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setHasPicture($a_bHasPicture);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return Collection
     */
    function getBrfRealtorAdsByImageType($a_sImageType)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setImageType($a_sImageType);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'alternate_time' property. 
     *
     * @param string $a_sAlternateTime
     * @return Collection
     */
    function getBrfRealtorAdsByAlternateTime($a_sAlternateTime)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setAlternateTime($a_sAlternateTime);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Get BrfRealtorAds by 'sold' property. 
     *
     * @param bool $a_bSold
     * @return Collection
     */
    function getBrfRealtorAdsBySold($a_bSold)
    {
        $oBrfRealtorAdSelector = getBrfRealtorAdSelector();
        $oBrfRealtorAdSelector->setSold($a_bSold);
        $oBrfRealtorAdCollection = $this->read($oBrfRealtorAdSelector);
        return $oBrfRealtorAdCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_realtor_ad', 'BrfRealtorAd', new SelectionFactory_BrfRealtorAd(), new DomainFactory_BrfRealtorAdFactory(), new UpdateFactory_BrfRealtorAd(), array(
            array('brf_realtor_ad_time', array('dependent_objects', 'brf_realtor_ad_id', 'getBrfRealtorAdId')), // gets orders customer id
        ));
    }




}
