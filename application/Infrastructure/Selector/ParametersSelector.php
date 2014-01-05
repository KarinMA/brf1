<?php

/**
 * Selector class for Parameters. 
 *
 * @see Parameters
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ParametersSelector extends Selector 
{


    /**
     * Parameters selector's 'insurance_type' property. 
     *
     * @var string
     */
    private $_sInsuranceType;

    /**
     * Parameters selector's 'specification' property. 
     *
     * @var string
     */
    private $_sSpecification;

    /**
     * Parameters selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Parameters selector's 'friendly_name' property. 
     *
     * @var string
     */
    private $_sFriendlyName;

    /**
     * Parameters selector's 'is_preset' property. 
     *
     * @var bool
     */
    private $_bIsPreset;

    /**
     * Parameters selector's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;
    /**
     * Get Parameters selector's 'insurance_type' property. 
     *
     * @return string
     */
    function getInsuranceType()
    {
        return (string) $this->_sInsuranceType;
    }

    /**
     * Set Parameters selector's 'insurance_type' property. 
     *
     * @param string $a_sInsuranceType
     * @return void
     */
    function setInsuranceType($a_sInsuranceType)
    {
        $this->_sInsuranceType = (string) $a_sInsuranceType;
        $this->setSearchParameter('insurance_type', $this->_sInsuranceType);
    }

    /**
     * Get Parameters selector's 'specification' property. 
     *
     * @return string
     */
    function getSpecification()
    {
        return (string) $this->_sSpecification;
    }

    /**
     * Set Parameters selector's 'specification' property. 
     *
     * @param string $a_sSpecification
     * @return void
     */
    function setSpecification($a_sSpecification)
    {
        $this->_sSpecification = (string) $a_sSpecification;
        $this->setSearchParameter('specification', $this->_sSpecification);
    }

    /**
     * Get Parameters selector's 'name' property. 
     *
     * @return string|null
     */
    function getName()
    {
        return is_null($this->_sName) ? NULL : (string) $this->_sName;
    }

    /**
     * Set Parameters selector's 'name' property. 
     *
     * @param string|null $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        $this->_sName = is_null($a_sName) ? NULL : (string) $a_sName;
        $this->setSearchParameter('name', (string) $this->_sName, is_null($this->_sName) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Parameters selector's 'friendly_name' property. 
     *
     * @return string|null
     */
    function getFriendlyName()
    {
        return is_null($this->_sFriendlyName) ? NULL : (string) $this->_sFriendlyName;
    }

    /**
     * Set Parameters selector's 'friendly_name' property. 
     *
     * @param string|null $a_sFriendlyName
     * @return void
     */
    function setFriendlyName($a_sFriendlyName)
    {
        $this->_sFriendlyName = is_null($a_sFriendlyName) ? NULL : (string) $a_sFriendlyName;
        $this->setSearchParameter('friendly_name', (string) $this->_sFriendlyName, is_null($this->_sFriendlyName) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Parameters selector's 'is_preset' property. 
     *
     * @return bool
     */
    function getIsPreset()
    {
        return (bool) $this->_bIsPreset;
    }

    /**
     * Set Parameters selector's 'is_preset' property. 
     *
     * @param bool $a_bIsPreset
     * @return void
     */
    function setIsPreset($a_bIsPreset)
    {
        $this->_bIsPreset = (bool) $a_bIsPreset;
        $this->setSearchParameter('is_preset', $this->_bIsPreset);
    }

    /**
     * Get Parameters selector's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Parameters selector's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        $this->_sDescription = (string) $a_sDescription;
        $this->setSearchParameter('description', $this->_sDescription);
    }

}
