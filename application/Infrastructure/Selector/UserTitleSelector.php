<?php

/**
 * Selector class for UserTitle. 
 *
 * @see UserTitle
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_UserTitleSelector extends Selector 
{


    /**
     * UserTitle selector's 'title_name' property. 
     *
     * @var string
     */
    private $_sTitleName;
    /**
     * Get UserTitle selector's 'title_name' property. 
     *
     * @return string
     */
    function getTitleName()
    {
        return (string) $this->_sTitleName;
    }

    /**
     * Set UserTitle selector's 'title_name' property. 
     *
     * @param string $a_sTitleName
     * @return void
     */
    function setTitleName($a_sTitleName)
    {
        $this->_sTitleName = (string) $a_sTitleName;
        $this->setSearchParameter('title_name', $this->_sTitleName);
    }

}
