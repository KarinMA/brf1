<?php

/**
 * Selector class for ResourceType. 
 *
 * @see ResourceType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ResourceTypeSelector extends Selector 
{


    /**
     * ResourceType selector's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;

    /**
     * ResourceType selector's 'instruction_text' property. 
     *
     * @var string
     */
    private $_sInstructionText;

    /**
     * ResourceType selector's 'whole_day' property. 
     *
     * @var bool
     */
    private $_bWholeDay;
    /**
     * Get ResourceType selector's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set ResourceType selector's 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return void
     */
    function setTypeName($a_sTypeName)
    {
        $this->_sTypeName = (string) $a_sTypeName;
        $this->setSearchParameter('type_name', $this->_sTypeName);
    }

    /**
     * Get ResourceType selector's 'instruction_text' property. 
     *
     * @return string|null
     */
    function getInstructionText()
    {
        return is_null($this->_sInstructionText) ? NULL : (string) $this->_sInstructionText;
    }

    /**
     * Set ResourceType selector's 'instruction_text' property. 
     *
     * @param string|null $a_sInstructionText
     * @return void
     */
    function setInstructionText($a_sInstructionText)
    {
        $this->_sInstructionText = is_null($a_sInstructionText) ? NULL : (string) $a_sInstructionText;
        $this->setSearchParameter('instruction_text', (string) $this->_sInstructionText, is_null($this->_sInstructionText) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get ResourceType selector's 'whole_day' property. 
     *
     * @return bool
     */
    function getWholeDay()
    {
        return (bool) $this->_bWholeDay;
    }

    /**
     * Set ResourceType selector's 'whole_day' property. 
     *
     * @param bool $a_bWholeDay
     * @return void
     */
    function setWholeDay($a_bWholeDay)
    {
        $this->_bWholeDay = (bool) $a_bWholeDay;
        $this->setSearchParameter('whole_day', $this->_bWholeDay);
    }

}
