<?php

/**
 * Selector class for BrfRealtorAd. 
 *
 * @see BrfRealtorAd
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfRealtorAdSelector extends Selector 
{


    /**
     * BrfRealtorAd selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorAd selector's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * BrfRealtorAd selector's 'rooms' property. 
     *
     * @var float
     */
    private $_fRooms;

    /**
     * BrfRealtorAd selector's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * BrfRealtorAd selector's 'stairs' property. 
     *
     * @var string
     */
    private $_sStairs;

    /**
     * BrfRealtorAd selector's 'fee' property. 
     *
     * @var int
     */
    private $_iFee;

    /**
     * BrfRealtorAd selector's 'price' property. 
     *
     * @var int
     */
    private $_iPrice;

    /**
     * BrfRealtorAd selector's 'square_meters' property. 
     *
     * @var int
     */
    private $_iSquareMeters;

    /**
     * BrfRealtorAd selector's 'created_on' property. 
     *
     * @var string
     */
    private $_sCreatedOn;

    /**
     * BrfRealtorAd selector's 'realtor_ad_link' property. 
     *
     * @var string
     */
    private $_sRealtorAdLink;

    /**
     * BrfRealtorAd selector's 'price_type' property. 
     *
     * @var string
     */
    private $_sPriceType;

    /**
     * BrfRealtorAd selector's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * BrfRealtorAd selector's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * BrfRealtorAd selector's 'alternate_time' property. 
     *
     * @var string
     */
    private $_sAlternateTime;

    /**
     * BrfRealtorAd selector's 'sold' property. 
     *
     * @var bool
     */
    private $_bSold;
    /**
     * Get BrfRealtorAd selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorAd selector's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        $this->_iBrfId = (int) $a_iBrfId;
        $this->setSearchParameter('brf_id', $this->_iBrfId);
    }

    /**
     * Get BrfRealtorAd selector's 'realtor_user_id' property. 
     *
     * @return int
     */
    function getRealtorUserId()
    {
        return (int) $this->_iRealtorUserId;
    }

    /**
     * Set BrfRealtorAd selector's 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        $this->_iRealtorUserId = (int) $a_iRealtorUserId;
        $this->setSearchParameter('realtor_user_id', $this->_iRealtorUserId);
    }

    /**
     * Get BrfRealtorAd selector's 'rooms' property. 
     *
     * @return float
     */
    function getRooms()
    {
        return (float) $this->_fRooms;
    }

    /**
     * Set BrfRealtorAd selector's 'rooms' property. 
     *
     * @param float $a_fRooms
     * @return void
     */
    function setRooms($a_fRooms)
    {
        $this->_fRooms = (float) $a_fRooms;
        $this->setSearchParameter('rooms', $this->_fRooms);
    }

    /**
     * Get BrfRealtorAd selector's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set BrfRealtorAd selector's 'address' property. 
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
     * Get BrfRealtorAd selector's 'stairs' property. 
     *
     * @return string
     */
    function getStairs()
    {
        return (string) $this->_sStairs;
    }

    /**
     * Set BrfRealtorAd selector's 'stairs' property. 
     *
     * @param string $a_sStairs
     * @return void
     */
    function setStairs($a_sStairs)
    {
        $this->_sStairs = (string) $a_sStairs;
        $this->setSearchParameter('stairs', $this->_sStairs);
    }

    /**
     * Get BrfRealtorAd selector's 'fee' property. 
     *
     * @return int
     */
    function getFee()
    {
        return (int) $this->_iFee;
    }

    /**
     * Set BrfRealtorAd selector's 'fee' property. 
     *
     * @param int $a_iFee
     * @return void
     */
    function setFee($a_iFee)
    {
        $this->_iFee = (int) $a_iFee;
        $this->setSearchParameter('fee', $this->_iFee);
    }

    /**
     * Get BrfRealtorAd selector's 'price' property. 
     *
     * @return int
     */
    function getPrice()
    {
        return (int) $this->_iPrice;
    }

    /**
     * Set BrfRealtorAd selector's 'price' property. 
     *
     * @param int $a_iPrice
     * @return void
     */
    function setPrice($a_iPrice)
    {
        $this->_iPrice = (int) $a_iPrice;
        $this->setSearchParameter('price', $this->_iPrice);
    }

    /**
     * Get BrfRealtorAd selector's 'square_meters' property. 
     *
     * @return int
     */
    function getSquareMeters()
    {
        return (int) $this->_iSquareMeters;
    }

    /**
     * Set BrfRealtorAd selector's 'square_meters' property. 
     *
     * @param int $a_iSquareMeters
     * @return void
     */
    function setSquareMeters($a_iSquareMeters)
    {
        $this->_iSquareMeters = (int) $a_iSquareMeters;
        $this->setSearchParameter('square_meters', $this->_iSquareMeters);
    }

    /**
     * Get BrfRealtorAd selector's 'created_on' property. 
     *
     * @return string
     */
    function getCreatedOn()
    {
        return (string) $this->_sCreatedOn;
    }

    /**
     * Set BrfRealtorAd selector's 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return void
     */
    function setCreatedOn($a_sCreatedOn)
    {
        $this->_sCreatedOn = (string) $a_sCreatedOn;
        $this->setSearchParameter('created_on', $this->_sCreatedOn);
    }

    /**
     * Get BrfRealtorAd selector's 'realtor_ad_link' property. 
     *
     * @return string
     */
    function getRealtorAdLink()
    {
        return (string) $this->_sRealtorAdLink;
    }

    /**
     * Set BrfRealtorAd selector's 'realtor_ad_link' property. 
     *
     * @param string $a_sRealtorAdLink
     * @return void
     */
    function setRealtorAdLink($a_sRealtorAdLink)
    {
        $this->_sRealtorAdLink = (string) $a_sRealtorAdLink;
        $this->setSearchParameter('realtor_ad_link', $this->_sRealtorAdLink);
    }

    /**
     * Get BrfRealtorAd selector's 'price_type' property. 
     *
     * @return string
     */
    function getPriceType()
    {
        return (string) $this->_sPriceType;
    }

    /**
     * Set BrfRealtorAd selector's 'price_type' property. 
     *
     * @param string $a_sPriceType
     * @return void
     */
    function setPriceType($a_sPriceType)
    {
        $this->_sPriceType = (string) $a_sPriceType;
        $this->setSearchParameter('price_type', $this->_sPriceType);
    }

    /**
     * Get BrfRealtorAd selector's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set BrfRealtorAd selector's 'has_picture' property. 
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
     * Get BrfRealtorAd selector's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set BrfRealtorAd selector's 'image_type' property. 
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
     * Get BrfRealtorAd selector's 'alternate_time' property. 
     *
     * @return string|null
     */
    function getAlternateTime()
    {
        return is_null($this->_sAlternateTime) ? NULL : (string) $this->_sAlternateTime;
    }

    /**
     * Set BrfRealtorAd selector's 'alternate_time' property. 
     *
     * @param string|null $a_sAlternateTime
     * @return void
     */
    function setAlternateTime($a_sAlternateTime)
    {
        $this->_sAlternateTime = is_null($a_sAlternateTime) ? NULL : (string) $a_sAlternateTime;
        $this->setSearchParameter('alternate_time', (string) $this->_sAlternateTime, is_null($this->_sAlternateTime) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get BrfRealtorAd selector's 'sold' property. 
     *
     * @return bool
     */
    function getSold()
    {
        return (bool) $this->_bSold;
    }

    /**
     * Set BrfRealtorAd selector's 'sold' property. 
     *
     * @param bool $a_bSold
     * @return void
     */
    function setSold($a_bSold)
    {
        $this->_bSold = (bool) $a_bSold;
        $this->setSearchParameter('sold', $this->_bSold);
    }

}
