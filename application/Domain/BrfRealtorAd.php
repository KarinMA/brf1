<?php

/**
 * Domain object class for BrfRealtorAd. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfRealtorAd extends DomainObject 
{
    /**
     * BrfRealtorAd's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorAd's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * BrfRealtorAd's 'rooms' property. 
     *
     * @var float
     */
    private $_fRooms;

    /**
     * BrfRealtorAd's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * BrfRealtorAd's 'stairs' property. 
     *
     * @var string
     */
    private $_sStairs;

    /**
     * BrfRealtorAd's 'fee' property. 
     *
     * @var int
     */
    private $_iFee;

    /**
     * BrfRealtorAd's 'price' property. 
     *
     * @var int
     */
    private $_iPrice;

    /**
     * BrfRealtorAd's 'square_meters' property. 
     *
     * @var int
     */
    private $_iSquareMeters;

    /**
     * BrfRealtorAd's 'created_on' property. 
     *
     * @var string
     */
    private $_sCreatedOn;

    /**
     * BrfRealtorAd's 'realtor_ad_link' property. 
     *
     * @var string
     */
    private $_sRealtorAdLink;

    /**
     * BrfRealtorAd's 'price_type' property. 
     *
     * @var string
     */
    private $_sPriceType;

    /**
     * BrfRealtorAd's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * BrfRealtorAd's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * BrfRealtorAd's 'alternate_time' property. 
     *
     * @var string
     */
    private $_sAlternateTime;

    /**
     * BrfRealtorAd's 'sold' property. 
     *
     * @var bool
     */
    private $_bSold;

    /**
     * Get BrfRealtorAd's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorAd's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (!is_null($this->_iBrfId) && $this->_iBrfId !== (int) $a_iBrfId) {
            $this->_markModified();
        }
        $this->_iBrfId = (int) $a_iBrfId;
    }

    /**
     * Get BrfRealtorAd's 'realtor_user_id' property. 
     *
     * @return int
     */
    function getRealtorUserId()
    {
        return (int) $this->_iRealtorUserId;
    }

    /**
     * Set BrfRealtorAd's 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        if (!is_null($this->_iRealtorUserId) && $this->_iRealtorUserId !== (int) $a_iRealtorUserId) {
            $this->_markModified();
        }
        $this->_iRealtorUserId = (int) $a_iRealtorUserId;
    }

    /**
     * Get BrfRealtorAd's 'rooms' property. 
     *
     * @return float
     */
    function getRooms()
    {
        return (float) $this->_fRooms;
    }

    /**
     * Set BrfRealtorAd's 'rooms' property. 
     *
     * @param float $a_fRooms
     * @return void
     */
    function setRooms($a_fRooms)
    {
        if (!is_null($this->_fRooms) && $this->_fRooms !== (float) $a_fRooms) {
            $this->_markModified();
        }
        $this->_fRooms = (float) $a_fRooms;
    }

    /**
     * Get BrfRealtorAd's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set BrfRealtorAd's 'address' property. 
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
     * Get BrfRealtorAd's 'stairs' property. 
     *
     * @return string
     */
    function getStairs()
    {
        return (string) $this->_sStairs;
    }

    /**
     * Set BrfRealtorAd's 'stairs' property. 
     *
     * @param string $a_sStairs
     * @return void
     */
    function setStairs($a_sStairs)
    {
        if (!is_null($this->_sStairs) && $this->_sStairs !== (string) $a_sStairs) {
            $this->_markModified();
        }
        $this->_sStairs = (string) $a_sStairs;
    }

    /**
     * Get BrfRealtorAd's 'fee' property. 
     *
     * @return int
     */
    function getFee()
    {
        return (int) $this->_iFee;
    }

    /**
     * Set BrfRealtorAd's 'fee' property. 
     *
     * @param int $a_iFee
     * @return void
     */
    function setFee($a_iFee)
    {
        if (!is_null($this->_iFee) && $this->_iFee !== (int) $a_iFee) {
            $this->_markModified();
        }
        $this->_iFee = (int) $a_iFee;
    }

    /**
     * Get BrfRealtorAd's 'price' property. 
     *
     * @return int
     */
    function getPrice()
    {
        return (int) $this->_iPrice;
    }

    /**
     * Set BrfRealtorAd's 'price' property. 
     *
     * @param int $a_iPrice
     * @return void
     */
    function setPrice($a_iPrice)
    {
        if (!is_null($this->_iPrice) && $this->_iPrice !== (int) $a_iPrice) {
            $this->_markModified();
        }
        $this->_iPrice = (int) $a_iPrice;
    }

    /**
     * Get BrfRealtorAd's 'square_meters' property. 
     *
     * @return int
     */
    function getSquareMeters()
    {
        return (int) $this->_iSquareMeters;
    }

    /**
     * Set BrfRealtorAd's 'square_meters' property. 
     *
     * @param int $a_iSquareMeters
     * @return void
     */
    function setSquareMeters($a_iSquareMeters)
    {
        if (!is_null($this->_iSquareMeters) && $this->_iSquareMeters !== (int) $a_iSquareMeters) {
            $this->_markModified();
        }
        $this->_iSquareMeters = (int) $a_iSquareMeters;
    }

    /**
     * Get BrfRealtorAd's 'created_on' property. 
     *
     * @return string
     */
    function getCreatedOn()
    {
        return strlen($this->_sCreatedOn) ? (string) $this->_sCreatedOn : NULL;
    }

    /**
     * Set BrfRealtorAd's 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return void
     */
    function setCreatedOn($a_sCreatedOn)
    {
        if (!is_null($this->_sCreatedOn) && $this->_sCreatedOn !== (string) $a_sCreatedOn) {
            $this->_markModified();
        }
        $this->_sCreatedOn = (string) $a_sCreatedOn;
    }

    /**
     * Get BrfRealtorAd's 'realtor_ad_link' property. 
     *
     * @return string
     */
    function getRealtorAdLink()
    {
        return (string) $this->_sRealtorAdLink;
    }

    /**
     * Set BrfRealtorAd's 'realtor_ad_link' property. 
     *
     * @param string $a_sRealtorAdLink
     * @return void
     */
    function setRealtorAdLink($a_sRealtorAdLink)
    {
        if (!is_null($this->_sRealtorAdLink) && $this->_sRealtorAdLink !== (string) $a_sRealtorAdLink) {
            $this->_markModified();
        }
        $this->_sRealtorAdLink = (string) $a_sRealtorAdLink;
    }

    /**
     * Get BrfRealtorAd's 'price_type' property. 
     *
     * @return string
     */
    function getPriceType()
    {
        return (string) $this->_sPriceType;
    }

    /**
     * Set BrfRealtorAd's 'price_type' property. 
     *
     * @param string $a_sPriceType
     * @return void
     */
    function setPriceType($a_sPriceType)
    {
        if (!is_null($this->_sPriceType) && $this->_sPriceType !== (string) $a_sPriceType) {
            $this->_markModified();
        }
        $this->_sPriceType = (string) $a_sPriceType;
    }

    /**
     * Get BrfRealtorAd's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set BrfRealtorAd's 'has_picture' property. 
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
     * Get BrfRealtorAd's 'image_type' property. 
     *
     * @return string|null
     */
    function getImageType()
    {
        return is_null($this->_sImageType) ? NULL : (string) $this->_sImageType;
    }

    /**
     * Set BrfRealtorAd's 'image_type' property. 
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
     * Get BrfRealtorAd's 'alternate_time' property. 
     *
     * @return string|null
     */
    function getAlternateTime()
    {
        return is_null($this->_sAlternateTime) ? NULL : (string) $this->_sAlternateTime;
    }

    /**
     * Set BrfRealtorAd's 'alternate_time' property. 
     *
     * @param string|null $a_sAlternateTime
     * @return void
     */
    function setAlternateTime($a_sAlternateTime)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sAlternateTime) ? NULL : ((string) $a_sAlternateTime);
            if ($mCompareValue !== $this->_sAlternateTime) {
                $this->_markModified();
            }
        }
        $this->_sAlternateTime = is_null($a_sAlternateTime) ? NULL : (string) $a_sAlternateTime;
    }

    /**
     * Get BrfRealtorAd's 'sold' property. 
     *
     * @return bool
     */
    function getSold()
    {
        return (bool) $this->_bSold;
    }

    /**
     * Set BrfRealtorAd's 'sold' property. 
     *
     * @param bool $a_bSold
     * @return void
     */
    function setSold($a_bSold)
    {
        if (!is_null($this->_bSold) && $this->_bSold !== (bool) $a_bSold) {
            $this->_markModified();
        }
        $this->_bSold = (bool) $a_bSold;
    }

    /**
     * This BrfRealtorAd's BrfRealtorAdTime collection.
     * 
     * @var Collection
     */
    private $_oBrfRealtorAdTimeCollection;

    /**
     * Get BrfRealtorAdTime collection.
     * 
     * @see BrfRealtorAdTime
     * 
     * @return Collection
     */
    function getBrfRealtorAdTimeCollection()
    {
        if (!isset($this->_oBrfRealtorAdTimeCollection)) {
            $this->_oBrfRealtorAdTimeCollection = new Collection();
        }
        return $this->_oBrfRealtorAdTimeCollection;
    }



    public static function create($a_iBrfId, $a_iRealtorUserId, $a_fRooms, $a_sAddress, $a_sStairs, $a_iFee, $a_iPrice, $a_iSquareMeters, $a_sCreatedOn, $a_sRealtorAdLink, $a_sPriceType, $a_bHasPicture, $a_sImageType, $a_sAlternateTime, $a_bSold, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_ad')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_realtor_ad')->write($oObject);
        }
        return $oObject;
    }

}
