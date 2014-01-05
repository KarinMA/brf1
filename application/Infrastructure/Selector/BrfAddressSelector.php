<?php

/**
 * Selector class for BrfAddress. 
 *
 * @see BrfAddress
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfAddressSelector extends Selector 
{


    /**
     * BrfAddress selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfAddress selector's 'address' property. 
     *
     * @var string
     */
    private $_sAddress;

    /**
     * BrfAddress selector's 'street_number' property. 
     *
     * @var string
     */
    private $_sStreetNumber;

    /**
     * BrfAddress selector's 'street_number2' property. 
     *
     * @var string
     */
    private $_sStreetNumber2;

    /**
     * BrfAddress selector's 'zip' property. 
     *
     * @var int
     */
    private $_iZip;

    /**
     * BrfAddress selector's 'postal_address' property. 
     *
     * @var string
     */
    private $_sPostalAddress;

    /**
     * BrfAddress selector's 'even_numbers' property. 
     *
     * @var bool
     */
    private $_bEvenNumbers;

    /**
     * BrfAddress selector's 'odd_numbers' property. 
     *
     * @var bool
     */
    private $_bOddNumbers;
    /**
     * Get BrfAddress selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfAddress selector's 'brf_id' property. 
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
     * Get BrfAddress selector's 'address' property. 
     *
     * @return string
     */
    function getAddress()
    {
        return (string) $this->_sAddress;
    }

    /**
     * Set BrfAddress selector's 'address' property. 
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
     * Get BrfAddress selector's 'street_number' property. 
     *
     * @return string|null
     */
    function getStreetNumber()
    {
        return is_null($this->_sStreetNumber) ? NULL : (string) $this->_sStreetNumber;
    }

    /**
     * Set BrfAddress selector's 'street_number' property. 
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
     * Get BrfAddress selector's 'street_number2' property. 
     *
     * @return string|null
     */
    function getStreetNumber2()
    {
        return is_null($this->_sStreetNumber2) ? NULL : (string) $this->_sStreetNumber2;
    }

    /**
     * Set BrfAddress selector's 'street_number2' property. 
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
     * Get BrfAddress selector's 'zip' property. 
     *
     * @return int
     */
    function getZip()
    {
        return (int) $this->_iZip;
    }

    /**
     * Set BrfAddress selector's 'zip' property. 
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
     * Get BrfAddress selector's 'postal_address' property. 
     *
     * @return string
     */
    function getPostalAddress()
    {
        return (string) $this->_sPostalAddress;
    }

    /**
     * Set BrfAddress selector's 'postal_address' property. 
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
     * Get BrfAddress selector's 'even_numbers' property. 
     *
     * @return bool
     */
    function getEvenNumbers()
    {
        return (bool) $this->_bEvenNumbers;
    }

    /**
     * Set BrfAddress selector's 'even_numbers' property. 
     *
     * @param bool $a_bEvenNumbers
     * @return void
     */
    function setEvenNumbers($a_bEvenNumbers)
    {
        $this->_bEvenNumbers = (bool) $a_bEvenNumbers;
        $this->setSearchParameter('even_numbers', $this->_bEvenNumbers);
    }

    /**
     * Get BrfAddress selector's 'odd_numbers' property. 
     *
     * @return bool
     */
    function getOddNumbers()
    {
        return (bool) $this->_bOddNumbers;
    }

    /**
     * Set BrfAddress selector's 'odd_numbers' property. 
     *
     * @param bool $a_bOddNumbers
     * @return void
     */
    function setOddNumbers($a_bOddNumbers)
    {
        $this->_bOddNumbers = (bool) $a_bOddNumbers;
        $this->setSearchParameter('odd_numbers', $this->_bOddNumbers);
    }

}
