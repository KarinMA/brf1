<?php

/**
 * Domain object class for PresidentLogCategory. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class PresidentLogCategory extends DomainObject 
{
    /**
     * PresidentLogCategory's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * PresidentLogCategory's 'category_name' property. 
     *
     * @var string
     */
    private $_sCategoryName;

    /**
     * PresidentLogCategory's 'category_description' property. 
     *
     * @var string
     */
    private $_sCategoryDescription;

    /**
     * PresidentLogCategory's 'archive' property. 
     *
     * @var bool
     */
    private $_bArchive;

    /**
     * Get PresidentLogCategory's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set PresidentLogCategory's 'brf_id' property. 
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
     * Get PresidentLogCategory's 'category_name' property. 
     *
     * @return string|null
     */
    function getCategoryName()
    {
        return is_null($this->_sCategoryName) ? NULL : (string) $this->_sCategoryName;
    }

    /**
     * Set PresidentLogCategory's 'category_name' property. 
     *
     * @param string|null $a_sCategoryName
     * @return void
     */
    function setCategoryName($a_sCategoryName)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sCategoryName) ? NULL : ((string) $a_sCategoryName);
            if ($mCompareValue !== $this->_sCategoryName) {
                $this->_markModified();
            }
        }
        $this->_sCategoryName = is_null($a_sCategoryName) ? NULL : (string) $a_sCategoryName;
    }

    /**
     * Get PresidentLogCategory's 'category_description' property. 
     *
     * @return string
     */
    function getCategoryDescription()
    {
        return (string) $this->_sCategoryDescription;
    }

    /**
     * Set PresidentLogCategory's 'category_description' property. 
     *
     * @param string $a_sCategoryDescription
     * @return void
     */
    function setCategoryDescription($a_sCategoryDescription)
    {
        if (!is_null($this->_sCategoryDescription) && $this->_sCategoryDescription !== (string) $a_sCategoryDescription) {
            $this->_markModified();
        }
        $this->_sCategoryDescription = (string) $a_sCategoryDescription;
    }

    /**
     * Get PresidentLogCategory's 'archive' property. 
     *
     * @return bool
     */
    function getArchive()
    {
        return (bool) $this->_bArchive;
    }

    /**
     * Set PresidentLogCategory's 'archive' property. 
     *
     * @param bool $a_bArchive
     * @return void
     */
    function setArchive($a_bArchive)
    {
        if (!is_null($this->_bArchive) && $this->_bArchive !== (bool) $a_bArchive) {
            $this->_markModified();
        }
        $this->_bArchive = (bool) $a_bArchive;
    }

    /**
     * This PresidentLogCategory's PresidentLog collection.
     * 
     * @var Collection
     */
    private $_oPresidentLogCollection;

    /**
     * Get PresidentLog collection.
     * 
     * @see PresidentLog
     * 
     * @return Collection
     */
    function getPresidentLogCollection()
    {
        if (!isset($this->_oPresidentLogCollection)) {
            $this->_oPresidentLogCollection = new Collection();
        }
        return $this->_oPresidentLogCollection;
    }



    public static function create($a_iBrfId, $a_sCategoryName, $a_sCategoryDescription, $a_bArchive, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log_category')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('president_log_category')->write($oObject);
        }
        return $oObject;
    }

}
