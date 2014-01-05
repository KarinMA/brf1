<?php

/**
 * Selector class for PresidentLogCategory. 
 *
 * @see PresidentLogCategory
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_PresidentLogCategorySelector extends Selector 
{


    /**
     * PresidentLogCategory selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * PresidentLogCategory selector's 'category_name' property. 
     *
     * @var string
     */
    private $_sCategoryName;

    /**
     * PresidentLogCategory selector's 'category_description' property. 
     *
     * @var string
     */
    private $_sCategoryDescription;

    /**
     * PresidentLogCategory selector's 'archive' property. 
     *
     * @var bool
     */
    private $_bArchive;
    /**
     * Get PresidentLogCategory selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set PresidentLogCategory selector's 'brf_id' property. 
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
     * Get PresidentLogCategory selector's 'category_name' property. 
     *
     * @return string|null
     */
    function getCategoryName()
    {
        return is_null($this->_sCategoryName) ? NULL : (string) $this->_sCategoryName;
    }

    /**
     * Set PresidentLogCategory selector's 'category_name' property. 
     *
     * @param string|null $a_sCategoryName
     * @return void
     */
    function setCategoryName($a_sCategoryName)
    {
        $this->_sCategoryName = is_null($a_sCategoryName) ? NULL : (string) $a_sCategoryName;
        $this->setSearchParameter('category_name', (string) $this->_sCategoryName, is_null($this->_sCategoryName) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get PresidentLogCategory selector's 'category_description' property. 
     *
     * @return string
     */
    function getCategoryDescription()
    {
        return (string) $this->_sCategoryDescription;
    }

    /**
     * Set PresidentLogCategory selector's 'category_description' property. 
     *
     * @param string $a_sCategoryDescription
     * @return void
     */
    function setCategoryDescription($a_sCategoryDescription)
    {
        $this->_sCategoryDescription = (string) $a_sCategoryDescription;
        $this->setSearchParameter('category_description', $this->_sCategoryDescription);
    }

    /**
     * Get PresidentLogCategory selector's 'archive' property. 
     *
     * @return bool
     */
    function getArchive()
    {
        return (bool) $this->_bArchive;
    }

    /**
     * Set PresidentLogCategory selector's 'archive' property. 
     *
     * @param bool $a_bArchive
     * @return void
     */
    function setArchive($a_bArchive)
    {
        $this->_bArchive = (bool) $a_bArchive;
        $this->setSearchParameter('archive', $this->_bArchive);
    }

}
