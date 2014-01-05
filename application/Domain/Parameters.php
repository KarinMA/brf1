<?php

/**
 * Domain object class for Parameters. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Parameters extends DomainObject 
{
    /**
     * Parameters's 'insurance_type' property. 
     *
     * @var string
     */
    private $_sInsuranceType;

    /**
     * Parameters's 'specification' property. 
     *
     * @var string
     */
    private $_sSpecification;

    /**
     * Parameters's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Parameters's 'friendly_name' property. 
     *
     * @var string
     */
    private $_sFriendlyName;

    /**
     * Parameters's 'is_preset' property. 
     *
     * @var bool
     */
    private $_bIsPreset;

    /**
     * Parameters's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * Get Parameters's 'insurance_type' property. 
     *
     * @return string
     */
    function getInsuranceType()
    {
        return (string) $this->_sInsuranceType;
    }

    /**
     * Set Parameters's 'insurance_type' property. 
     *
     * @param string $a_sInsuranceType
     * @return void
     */
    function setInsuranceType($a_sInsuranceType)
    {
        if (!is_null($this->_sInsuranceType) && $this->_sInsuranceType !== (string) $a_sInsuranceType) {
            $this->_markModified();
        }
        $this->_sInsuranceType = (string) $a_sInsuranceType;
    }

    /**
     * Get Parameters's 'specification' property. 
     *
     * @return string
     */
    function getSpecification()
    {
        return (string) $this->_sSpecification;
    }

    /**
     * Set Parameters's 'specification' property. 
     *
     * @param string $a_sSpecification
     * @return void
     */
    function setSpecification($a_sSpecification)
    {
        if (!is_null($this->_sSpecification) && $this->_sSpecification !== (string) $a_sSpecification) {
            $this->_markModified();
        }
        $this->_sSpecification = (string) $a_sSpecification;
    }

    /**
     * Get Parameters's 'name' property. 
     *
     * @return string|null
     */
    function getName()
    {
        return is_null($this->_sName) ? NULL : (string) $this->_sName;
    }

    /**
     * Set Parameters's 'name' property. 
     *
     * @param string|null $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sName) ? NULL : ((string) $a_sName);
            if ($mCompareValue !== $this->_sName) {
                $this->_markModified();
            }
        }
        $this->_sName = is_null($a_sName) ? NULL : (string) $a_sName;
    }

    /**
     * Get Parameters's 'friendly_name' property. 
     *
     * @return string|null
     */
    function getFriendlyName()
    {
        return is_null($this->_sFriendlyName) ? NULL : (string) $this->_sFriendlyName;
    }

    /**
     * Set Parameters's 'friendly_name' property. 
     *
     * @param string|null $a_sFriendlyName
     * @return void
     */
    function setFriendlyName($a_sFriendlyName)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sFriendlyName) ? NULL : ((string) $a_sFriendlyName);
            if ($mCompareValue !== $this->_sFriendlyName) {
                $this->_markModified();
            }
        }
        $this->_sFriendlyName = is_null($a_sFriendlyName) ? NULL : (string) $a_sFriendlyName;
    }

    /**
     * Get Parameters's 'is_preset' property. 
     *
     * @return bool
     */
    function getIsPreset()
    {
        return (bool) $this->_bIsPreset;
    }

    /**
     * Set Parameters's 'is_preset' property. 
     *
     * @param bool $a_bIsPreset
     * @return void
     */
    function setIsPreset($a_bIsPreset)
    {
        if (!is_null($this->_bIsPreset) && $this->_bIsPreset !== (bool) $a_bIsPreset) {
            $this->_markModified();
        }
        $this->_bIsPreset = (bool) $a_bIsPreset;
    }

    /**
     * Get Parameters's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Parameters's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        if (!is_null($this->_sDescription) && $this->_sDescription !== (string) $a_sDescription) {
            $this->_markModified();
        }
        $this->_sDescription = (string) $a_sDescription;
    }



    public static function create($a_sInsuranceType, $a_sSpecification, $a_sName, $a_sFriendlyName, $a_bIsPreset, $a_sDescription, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('parameters')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('parameters')->write($oObject);
        }
        return $oObject;
    }

}
