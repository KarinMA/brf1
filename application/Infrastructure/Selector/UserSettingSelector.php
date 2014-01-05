<?php

/**
 * Selector class for UserSetting. 
 *
 * @see UserSetting
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_UserSettingSelector extends Selector 
{


    /**
     * UserSetting selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * UserSetting selector's 'setting_type_id' property. 
     *
     * @var int
     */
    private $_iSettingTypeId;

    /**
     * UserSetting selector's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * UserSetting selector's 'setting_time' property. 
     *
     * @var string
     */
    private $_sSettingTime;
    /**
     * Get UserSetting selector's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set UserSetting selector's 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        $this->_iUserId = (int) $a_iUserId;
        $this->setSearchParameter('user_id', $this->_iUserId);
    }

    /**
     * Get UserSetting selector's 'setting_type_id' property. 
     *
     * @return int
     */
    function getSettingTypeId()
    {
        return (int) $this->_iSettingTypeId;
    }

    /**
     * Set UserSetting selector's 'setting_type_id' property. 
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
     * Get UserSetting selector's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set UserSetting selector's 'value' property. 
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
     * Get UserSetting selector's 'setting_time' property. 
     *
     * @return string
     */
    function getSettingTime()
    {
        return (string) $this->_sSettingTime;
    }

    /**
     * Set UserSetting selector's 'setting_time' property. 
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
