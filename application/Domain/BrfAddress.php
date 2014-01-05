<?php

/**
 * Domain object class for BrfAddress. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfAddress extends DomainObject 
{
    /**
     * BrfAddress's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfAddress's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * BrfAddress's 'street_number' property. 
     *
     * @var string
     */
    private $_sStreetNumber;

    /**
     * BrfAddress's 'street_number2' property. 
     *
     * @var string
     */
    private $_sStreetNumber2;

    /**
     * BrfAddress's 'zip' property. 
     *
     * @var int
     */
    private $_iZip;

    /**
     * BrfAddress's 'postal_address' property. 
     *
     * @var string
     */
    private $_sPostalAddress;

    /**
     * BrfAddress's 'even_numbers' property. 
     *
     * @var bool
     */
    private $_bEvenNumbers;

    /**
     * BrfAddress's 'odd_numbers' property. 
     *
     * @var bool
     */
    private $_bOddNumbers;

    /**
     * Get BrfAddress's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfAddress's 'brf_id' property. 
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
     * The Brf.
     * 
     * @var Brf
     */
    private $_oBrf;

    /**
     * Get the Brf.
     * 
     * @return Brf
     */
    function getBrf()
    {
        return $this->_oBrf;
    }

    /**
     * Set the Brf.
     * 
     * @param Brf $a_oBrf
     * 
     * @return void
     */
    function setBrf($a_oBrf)
    {
        $this->_iBrfId = $a_oBrf->getId();
        $this->_oBrf = $a_oBrf;
    }

    /**
     * Get BrfAddress's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set BrfAddress's 'address' property. 
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
     * Get BrfAddress's 'street_number' property. 
     *
     * @return string|null
     */
    function getStreetNumber()
    {
        return is_null($this->_sStreetNumber) ? NULL : (string) $this->_sStreetNumber;
    }

    /**
     * Set BrfAddress's 'street_number' property. 
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
     * Get BrfAddress's 'street_number2' property. 
     *
     * @return string|null
     */
    function getStreetNumber2()
    {
        return is_null($this->_sStreetNumber2) ? NULL : (string) $this->_sStreetNumber2;
    }

    /**
     * Set BrfAddress's 'street_number2' property. 
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
     * Get BrfAddress's 'zip' property. 
     *
     * @return int
     */
    function getZip()
    {
        return (int) $this->_iZip;
    }

    /**
     * Set BrfAddress's 'zip' property. 
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
     * Get BrfAddress's 'postal_address' property. 
     *
     * @return string
     */
    function getPostalAddress()
    {
        return (string) $this->_sPostalAddress;
    }

    /**
     * Set BrfAddress's 'postal_address' property. 
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
     * Get BrfAddress's 'even_numbers' property. 
     *
     * @return bool
     */
    function getEvenNumbers()
    {
        return (bool) $this->_bEvenNumbers;
    }

    /**
     * Set BrfAddress's 'even_numbers' property. 
     *
     * @param bool $a_bEvenNumbers
     * @return void
     */
    function setEvenNumbers($a_bEvenNumbers)
    {
        if (!is_null($this->_bEvenNumbers) && $this->_bEvenNumbers !== (bool) $a_bEvenNumbers) {
            $this->_markModified();
        }
        $this->_bEvenNumbers = (bool) $a_bEvenNumbers;
    }

    /**
     * Get BrfAddress's 'odd_numbers' property. 
     *
     * @return bool
     */
    function getOddNumbers()
    {
        return (bool) $this->_bOddNumbers;
    }

    /**
     * Set BrfAddress's 'odd_numbers' property. 
     *
     * @param bool $a_bOddNumbers
     * @return void
     */
    function setOddNumbers($a_bOddNumbers)
    {
        if (!is_null($this->_bOddNumbers) && $this->_bOddNumbers !== (bool) $a_bOddNumbers) {
            $this->_markModified();
        }
        $this->_bOddNumbers = (bool) $a_bOddNumbers;
    }

    /**
     * This BrfAddress's User collection.
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



    public static function create($a_iBrfId, $a_sAddress, $a_sStreetNumber, $a_sStreetNumber2, $a_iZip, $a_sPostalAddress, $a_bEvenNumbers, $a_bOddNumbers, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_address')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_address')->write($oObject);
        }
        return $oObject;
    }

}
