<?php

/**
 * Domain object class for RealtorInformationCategory. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class RealtorInformationCategory extends DomainObject 
{
    /**
     * RealtorInformationCategory's 'category_name' property. 
     *
     * @var string
     */
    private $_sCategoryName;

    /**
     * RealtorInformationCategory's 'category_key' property. 
     *
     * @var string
     */
    private $_sCategoryKey;

    /**
     * Get RealtorInformationCategory's 'category_name' property. 
     *
     * @return string
     */
    function getCategoryName()
    {
        return (string) $this->_sCategoryName;
    }

    /**
     * Set RealtorInformationCategory's 'category_name' property. 
     *
     * @param string $a_sCategoryName
     * @return void
     */
    function setCategoryName($a_sCategoryName)
    {
        if (!is_null($this->_sCategoryName) && $this->_sCategoryName !== (string) $a_sCategoryName) {
            $this->_markModified();
        }
        $this->_sCategoryName = (string) $a_sCategoryName;
    }

    /**
     * Get RealtorInformationCategory's 'category_key' property. 
     *
     * @return string
     */
    function getCategoryKey()
    {
        return (string) $this->_sCategoryKey;
    }

    /**
     * Set RealtorInformationCategory's 'category_key' property. 
     *
     * @param string $a_sCategoryKey
     * @return void
     */
    function setCategoryKey($a_sCategoryKey)
    {
        if (!is_null($this->_sCategoryKey) && $this->_sCategoryKey !== (string) $a_sCategoryKey) {
            $this->_markModified();
        }
        $this->_sCategoryKey = (string) $a_sCategoryKey;
    }

    /**
     * This RealtorInformationCategory's RealtorInformationType collection.
     * 
     * @var Collection
     */
    private $_oRealtorInformationTypeCollection;

    /**
     * Get RealtorInformationType collection.
     * 
     * @see RealtorInformationType
     * 
     * @return Collection
     */
    function getRealtorInformationTypeCollection()
    {
        if (!isset($this->_oRealtorInformationTypeCollection)) {
            $this->_oRealtorInformationTypeCollection = new Collection();
        }
        return $this->_oRealtorInformationTypeCollection;
    }



    public static function create($a_sCategoryName, $a_sCategoryKey, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information_category')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('realtor_information_category')->write($oObject);
        }
        return $oObject;
    }

}
