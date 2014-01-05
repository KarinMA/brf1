<?php

/**
 * Domain object class for BrfSetting. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfSetting extends DomainObject 
{
    /**
     * BrfSetting's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfSetting's 'setting_type_id' property. 
     *
     * @var int
     */
    private $_iSettingTypeId;

    /**
     * BrfSetting's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * BrfSetting's 'setting_time' property. 
     *
     * @var string
     */
    private $_sSettingTime;

    /**
     * Get BrfSetting's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfSetting's 'brf_id' property. 
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
     * Get BrfSetting's 'setting_type_id' property. 
     *
     * @return int
     */
    function getSettingTypeId()
    {
        return (int) $this->_iSettingTypeId;
    }

    /**
     * Set BrfSetting's 'setting_type_id' property. 
     *
     * @param int $a_iSettingTypeId
     * @return void
     */
    function setSettingTypeId($a_iSettingTypeId)
    {
        if (!is_null($this->_iSettingTypeId) && $this->_iSettingTypeId !== (int) $a_iSettingTypeId) {
            $this->_markModified();
        }
        $this->_iSettingTypeId = (int) $a_iSettingTypeId;
    }

    /**
     * The SettingType.
     * 
     * @var SettingType
     */
    private $_oSettingType;

    /**
     * Get the SettingType.
     * 
     * @return SettingType
     */
    function getSettingType()
    {
        return $this->_oSettingType;
    }

    /**
     * Set the SettingType.
     * 
     * @param SettingType $a_oSettingType
     * 
     * @return void
     */
    function setSettingType($a_oSettingType)
    {
        $this->_iSettingTypeId = $a_oSettingType->getId();
        $this->_oSettingType = $a_oSettingType;
    }

    /**
     * Get BrfSetting's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set BrfSetting's 'value' property. 
     *
     * @param string $a_sValue
     * @return void
     */
    function setValue($a_sValue)
    {
        if (!is_null($this->_sValue) && $this->_sValue !== (string) $a_sValue) {
            $this->_markModified();
        }
        $this->_sValue = (string) $a_sValue;
    }

    /**
     * Get BrfSetting's 'setting_time' property. 
     *
     * @return string
     */
    function getSettingTime()
    {
        return strlen($this->_sSettingTime) ? (string) $this->_sSettingTime : NULL;
    }

    /**
     * Set BrfSetting's 'setting_time' property. 
     *
     * @param string $a_sSettingTime
     * @return void
     */
    function setSettingTime($a_sSettingTime)
    {
        if (!is_null($this->_sSettingTime) && $this->_sSettingTime !== (string) $a_sSettingTime) {
            $this->_markModified();
        }
        $this->_sSettingTime = (string) $a_sSettingTime;
    }



    public static function create($a_iBrfId, $a_iSettingTypeId, $a_sValue, $a_sSettingTime, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_setting')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_setting')->write($oObject);
        }
        return $oObject;
    }

}
