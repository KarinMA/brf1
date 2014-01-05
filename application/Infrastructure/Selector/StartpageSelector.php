<?php

/**
 * Selector class for Startpage. 
 *
 * @see Startpage
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_StartpageSelector extends Selector 
{


    /**
     * Startpage selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Startpage selector's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * Startpage selector's 'content' property. 
     *
     * @var string
     */
    private $_sContent;

    /**
     * Startpage selector's 'edited_by' property. 
     *
     * @var int
     */
    private $_iEditedBy;

    /**
     * Startpage selector's 'edited_at' property. 
     *
     * @var string
     */
    private $_sEditedAt;

    /**
     * Startpage selector's 'content_type' property. 
     *
     * @var string
     */
    private $_sContentType;

    /**
     * Startpage selector's 'category' property. 
     *
     * @var string
     */
    private $_sCategory;
    /**
     * Get Startpage selector's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Startpage selector's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        $this->_sName = (string) $a_sName;
        $this->setSearchParameter('name', $this->_sName);
    }

    /**
     * Get Startpage selector's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Startpage selector's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        $this->_sDescription = (string) $a_sDescription;
        $this->setSearchParameter('description', $this->_sDescription);
    }

    /**
     * Get Startpage selector's 'content' property. 
     *
     * @return string
     */
    function getContent()
    {
        return (string) $this->_sContent;
    }

    /**
     * Set Startpage selector's 'content' property. 
     *
     * @param string $a_sContent
     * @return void
     */
    function setContent($a_sContent)
    {
        $this->_sContent = (string) $a_sContent;
        $this->setSearchParameter('content', $this->_sContent);
    }

    /**
     * Get Startpage selector's 'edited_by' property. 
     *
     * @return int
     */
    function getEditedBy()
    {
        return (int) $this->_iEditedBy;
    }

    /**
     * Set Startpage selector's 'edited_by' property. 
     *
     * @param int $a_iEditedBy
     * @return void
     */
    function setEditedBy($a_iEditedBy)
    {
        $this->_iEditedBy = (int) $a_iEditedBy;
        $this->setSearchParameter('edited_by', $this->_iEditedBy);
    }

    /**
     * Get Startpage selector's 'edited_at' property. 
     *
     * @return string
     */
    function getEditedAt()
    {
        return (string) $this->_sEditedAt;
    }

    /**
     * Set Startpage selector's 'edited_at' property. 
     *
     * @param string $a_sEditedAt
     * @return void
     */
    function setEditedAt($a_sEditedAt)
    {
        $this->_sEditedAt = (string) $a_sEditedAt;
        $this->setSearchParameter('edited_at', $this->_sEditedAt);
    }

    /**
     * Get Startpage selector's 'content_type' property. 
     *
     * @return string
     */
    function getContentType()
    {
        return (string) $this->_sContentType;
    }

    /**
     * Set Startpage selector's 'content_type' property. 
     *
     * @param string $a_sContentType
     * @return void
     */
    function setContentType($a_sContentType)
    {
        $this->_sContentType = (string) $a_sContentType;
        $this->setSearchParameter('content_type', $this->_sContentType);
    }

    /**
     * Get Startpage selector's 'category' property. 
     *
     * @return string
     */
    function getCategory()
    {
        return (string) $this->_sCategory;
    }

    /**
     * Set Startpage selector's 'category' property. 
     *
     * @param string $a_sCategory
     * @return void
     */
    function setCategory($a_sCategory)
    {
        $this->_sCategory = (string) $a_sCategory;
        $this->setSearchParameter('category', $this->_sCategory);
    }

}
