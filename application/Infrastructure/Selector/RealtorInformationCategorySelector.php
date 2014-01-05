<?php

/**
 * Selector class for RealtorInformationCategory. 
 *
 * @see RealtorInformationCategory
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_RealtorInformationCategorySelector extends Selector 
{


    /**
     * RealtorInformationCategory selector's 'category_name' property. 
     *
     * @var string
     */
    private $_sCategoryName;

    /**
     * RealtorInformationCategory selector's 'category_key' property. 
     *
     * @var string
     */
    private $_sCategoryKey;
    /**
     * Get RealtorInformationCategory selector's 'category_name' property. 
     *
     * @return string
     */
    function getCategoryName()
    {
        return (string) $this->_sCategoryName;
    }

    /**
     * Set RealtorInformationCategory selector's 'category_name' property. 
     *
     * @param string $a_sCategoryName
     * @return void
     */
    function setCategoryName($a_sCategoryName)
    {
        $this->_sCategoryName = (string) $a_sCategoryName;
        $this->setSearchParameter('category_name', $this->_sCategoryName);
    }

    /**
     * Get RealtorInformationCategory selector's 'category_key' property. 
     *
     * @return string
     */
    function getCategoryKey()
    {
        return (string) $this->_sCategoryKey;
    }

    /**
     * Set RealtorInformationCategory selector's 'category_key' property. 
     *
     * @param string $a_sCategoryKey
     * @return void
     */
    function setCategoryKey($a_sCategoryKey)
    {
        $this->_sCategoryKey = (string) $a_sCategoryKey;
        $this->setSearchParameter('category_key', $this->_sCategoryKey);
    }

}
