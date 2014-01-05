<?php

/**
 * Domain object class for ResourceType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class ResourceType extends DomainObject 
{
    /**
     * ResourceType's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;

    /**
     * ResourceType's 'instruction_text' property. 
     *
     * @var string
     */
    private $_sInstructionText;

    /**
     * ResourceType's 'whole_day' property. 
     *
     * @var bool
     */
    private $_bWholeDay;

    /**
     * Get ResourceType's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set ResourceType's 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return void
     */
    function setTypeName($a_sTypeName)
    {
        if (!is_null($this->_sTypeName) && $this->_sTypeName !== (string) $a_sTypeName) {
            $this->_markModified();
        }
        $this->_sTypeName = (string) $a_sTypeName;
    }

    /**
     * Get ResourceType's 'instruction_text' property. 
     *
     * @return string|null
     */
    function getInstructionText()
    {
        return is_null($this->_sInstructionText) ? NULL : (string) $this->_sInstructionText;
    }

    /**
     * Set ResourceType's 'instruction_text' property. 
     *
     * @param string|null $a_sInstructionText
     * @return void
     */
    function setInstructionText($a_sInstructionText)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sInstructionText) ? NULL : ((string) $a_sInstructionText);
            if ($mCompareValue !== $this->_sInstructionText) {
                $this->_markModified();
            }
        }
        $this->_sInstructionText = is_null($a_sInstructionText) ? NULL : (string) $a_sInstructionText;
    }

    /**
     * Get ResourceType's 'whole_day' property. 
     *
     * @return bool
     */
    function getWholeDay()
    {
        return (bool) $this->_bWholeDay;
    }

    /**
     * Set ResourceType's 'whole_day' property. 
     *
     * @param bool $a_bWholeDay
     * @return void
     */
    function setWholeDay($a_bWholeDay)
    {
        if (!is_null($this->_bWholeDay) && $this->_bWholeDay !== (bool) $a_bWholeDay) {
            $this->_markModified();
        }
        $this->_bWholeDay = (bool) $a_bWholeDay;
    }

    /**
     * This ResourceType's Resource collection.
     * 
     * @var Collection
     */
    private $_oResourceCollection;

    /**
     * Get Resource collection.
     * 
     * @see Resource
     * 
     * @return Collection
     */
    function getResourceCollection()
    {
        if (!isset($this->_oResourceCollection)) {
            $this->_oResourceCollection = new Collection();
        }
        return $this->_oResourceCollection;
    }



    public static function create($a_sTypeName, $a_sInstructionText, $a_bWholeDay, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('resource_type')->write($oObject);
        }
        return $oObject;
    }

}
