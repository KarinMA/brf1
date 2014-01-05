<?php

/**
 * Selector class for SiteSetting. 
 *
 * @see SiteSetting
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_SiteSettingSelector extends Selector 
{


    /**
     * SiteSetting selector's 'setting_type_id' property. 
     *
     * @var int
     */
    private $_iSettingTypeId;

    /**
     * SiteSetting selector's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * SiteSetting selector's 'setting_time' property. 
     *
     * @var string
     */
    private $_sSettingTime;
    /**
     * Get SiteSetting selector's 'setting_type_id' property. 
     *
     * @return int
     */
    function getSettingTypeId()
    {
        return (int) $this->_iSettingTypeId;
    }

    /**
     * Set SiteSetting selector's 'setting_type_id' property. 
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
     * Get SiteSetting selector's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set SiteSetting selector's 'value' property. 
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
     * Get SiteSetting selector's 'setting_time' property. 
     *
     * @return string
     */
    function getSettingTime()
    {
        return (string) $this->_sSettingTime;
    }

    /**
     * Set SiteSetting selector's 'setting_time' property. 
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
