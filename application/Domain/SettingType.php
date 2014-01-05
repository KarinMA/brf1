<?php

/**
 * Domain object class for SettingType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class SettingType extends DomainObject 
{
    /**
     * SettingType's 'setting_type_key' property. 
     *
     * @var string
     */
    private $_sSettingTypeKey;

    /**
     * SettingType's 'setting_type_name' property. 
     *
     * @var string
     */
    private $_sSettingTypeName;

    /**
     * Get SettingType's 'setting_type_key' property. 
     *
     * @return string
     */
    function getSettingTypeKey()
    {
        return (string) $this->_sSettingTypeKey;
    }

    /**
     * Set SettingType's 'setting_type_key' property. 
     *
     * @param string $a_sSettingTypeKey
     * @return void
     */
    function setSettingTypeKey($a_sSettingTypeKey)
    {
        if (!is_null($this->_sSettingTypeKey) && $this->_sSettingTypeKey !== (string) $a_sSettingTypeKey) {
            $this->_markModified();
        }
        $this->_sSettingTypeKey = (string) $a_sSettingTypeKey;
    }

    /**
     * Get SettingType's 'setting_type_name' property. 
     *
     * @return string
     */
    function getSettingTypeName()
    {
        return (string) $this->_sSettingTypeName;
    }

    /**
     * Set SettingType's 'setting_type_name' property. 
     *
     * @param string $a_sSettingTypeName
     * @return void
     */
    function setSettingTypeName($a_sSettingTypeName)
    {
        if (!is_null($this->_sSettingTypeName) && $this->_sSettingTypeName !== (string) $a_sSettingTypeName) {
            $this->_markModified();
        }
        $this->_sSettingTypeName = (string) $a_sSettingTypeName;
    }

    /**
     * This SettingType's BrfSetting collection.
     * 
     * @var Collection
     */
    private $_oBrfSettingCollection;

    /**
     * Get BrfSetting collection.
     * 
     * @see BrfSetting
     * 
     * @return Collection
     */
    function getBrfSettingCollection()
    {
        if (!isset($this->_oBrfSettingCollection)) {
            $this->_oBrfSettingCollection = new Collection();
        }
        return $this->_oBrfSettingCollection;
    }

    /**
     * This SettingType's SiteSetting collection.
     * 
     * @var Collection
     */
    private $_oSiteSettingCollection;

    /**
     * Get SiteSetting collection.
     * 
     * @see SiteSetting
     * 
     * @return Collection
     */
    function getSiteSettingCollection()
    {
        if (!isset($this->_oSiteSettingCollection)) {
            $this->_oSiteSettingCollection = new Collection();
        }
        return $this->_oSiteSettingCollection;
    }

    /**
     * This SettingType's UserSetting collection.
     * 
     * @var Collection
     */
    private $_oUserSettingCollection;

    /**
     * Get UserSetting collection.
     * 
     * @see UserSetting
     * 
     * @return Collection
     */
    function getUserSettingCollection()
    {
        if (!isset($this->_oUserSettingCollection)) {
            $this->_oUserSettingCollection = new Collection();
        }
        return $this->_oUserSettingCollection;
    }



    public static function create($a_sSettingTypeKey, $a_sSettingTypeName, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('setting_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('setting_type')->write($oObject);
        }
        return $oObject;
    }

}
