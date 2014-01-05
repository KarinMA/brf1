<?php

/**
 * Selector class for SettingType. 
 *
 * @see SettingType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_SettingTypeSelector extends Selector 
{


    /**
     * SettingType selector's 'setting_type_key' property. 
     *
     * @var string
     */
    private $_sSettingTypeKey;

    /**
     * SettingType selector's 'setting_type_name' property. 
     *
     * @var string
     */
    private $_sSettingTypeName;
    /**
     * Get SettingType selector's 'setting_type_key' property. 
     *
     * @return string
     */
    function getSettingTypeKey()
    {
        return (string) $this->_sSettingTypeKey;
    }

    /**
     * Set SettingType selector's 'setting_type_key' property. 
     *
     * @param string $a_sSettingType selectorKey
     * @return void
     */
    function setSettingTypeKey($a_sSettingTypeKey)
    {
        $this->_sSettingTypeKey = (string) $a_sSettingTypeKey;
        $this->setSearchParameter('setting_type_key', $this->_sSettingTypeKey);
    }

    /**
     * Get SettingType selector's 'setting_type_name' property. 
     *
     * @return string
     */
    function getSettingTypeName()
    {
        return (string) $this->_sSettingTypeName;
    }

    /**
     * Set SettingType selector's 'setting_type_name' property. 
     *
     * @param string $a_sSettingType selectorName
     * @return void
     */
    function setSettingTypeName($a_sSettingTypeName)
    {
        $this->_sSettingTypeName = (string) $a_sSettingTypeName;
        $this->setSearchParameter('setting_type_name', $this->_sSettingTypeName);
    }

}
