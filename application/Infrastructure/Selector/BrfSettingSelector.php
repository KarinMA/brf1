<?php

/**
 * Selector class for BrfSetting. 
 *
 * @see BrfSetting
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfSettingSelector extends Selector 
{


    /**
     * BrfSetting selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfSetting selector's 'setting_type_id' property. 
     *
     * @var int
     */
    private $_iSettingTypeId;

    /**
     * BrfSetting selector's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * BrfSetting selector's 'setting_time' property. 
     *
     * @var string
     */
    private $_sSettingTime;
    /**
     * Get BrfSetting selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfSetting selector's 'brf_id' property. 
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
     * Get BrfSetting selector's 'setting_type_id' property. 
     *
     * @return int
     */
    function getSettingTypeId()
    {
        return (int) $this->_iSettingTypeId;
    }

    /**
     * Set BrfSetting selector's 'setting_type_id' property. 
     *
     * @param int $a_iSettingTypeId
     * @return void
     */
    function setSettingTypeId($a_iSettingTypeId)
    {
        $this->_iSettingTypeId = (int) $a_iSettingTypeId;
        $this->setSearchParameter('setting_type_id', $this->_iSettingTypeId);
    }

    /**
     * Get BrfSetting selector's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set BrfSetting selector's 'value' property. 
     *
     * @param string $a_sValue
     * @return void
     */
    function setValue($a_sValue)
    {
        $this->_sValue = (string) $a_sValue;
        $this->setSearchParameter('value', $this->_sValue);
    }

    /**
     * Get BrfSetting selector's 'setting_time' property. 
     *
     * @return string
     */
    function getSettingTime()
    {
        return (string) $this->_sSettingTime;
    }

    /**
     * Set BrfSetting selector's 'setting_time' property. 
     *
     * @param string $a_sSettingTime
     * @return void
     */
    function setSettingTime($a_sSettingTime)
    {
        $this->_sSettingTime = (string) $a_sSettingTime;
        $this->setSearchParameter('setting_time', $this->_sSettingTime);
    }

}
