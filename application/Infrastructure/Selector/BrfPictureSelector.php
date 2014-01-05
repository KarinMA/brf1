<?php

/**
 * Selector class for BrfPicture. 
 *
 * @see BrfPicture
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfPictureSelector extends Selector 
{


    /**
     * BrfPicture selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfPicture selector's 'front' property. 
     *
     * @var bool
     */
    private $_bFront;

    /**
     * BrfPicture selector's 'title' property. 
     *
     * @var string
     */
    private $_sTitle;

    /**
     * BrfPicture selector's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * BrfPicture selector's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * BrfPicture selector's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;
    /**
     * Get BrfPicture selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfPicture selector's 'brf_id' property. 
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
     * Get BrfPicture selector's 'front' property. 
     *
     * @return bool
     */
    function getFront()
    {
        return (bool) $this->_bFront;
    }

    /**
     * Set BrfPicture selector's 'front' property. 
     *
     * @param bool $a_bFront
     * @return void
     */
    function setFront($a_bFront)
    {
        $this->_bFront = (bool) $a_bFront;
        $this->setSearchParameter('front', $this->_bFront);
    }

    /**
     * Get BrfPicture selector's 'title' property. 
     *
     * @return string
     */
    function getTitle()
    {
        return (string) $this->_sTitle;
    }

    /**
     * Set BrfPicture selector's 'title' property. 
     *
     * @param string $a_sTitle
     * @return void
     */
    function setTitle($a_sTitle)
    {
        $this->_sTitle = (string) $a_sTitle;
        $this->setSearchParameter('title', $this->_sTitle);
    }

    /**
     * Get BrfPicture selector's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set BrfPicture selector's 'description' property. 
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
     * Get BrfPicture selector's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set BrfPicture selector's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        $this->_bHasPicture = (bool) $a_bHasPicture;
        $this->setSearchParameter('has_picture', $this->_bHasPicture);
    }

    /**
     * Get BrfPicture selector's 'image_type' property. 
     *
     * @return string
     */
    function getImageType()
    {
        return (string) $this->_sImageType;
    }

    /**
     * Set BrfPicture selector's 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        $this->_sImageType = (string) $a_sImageType;
        $this->setSearchParameter('image_type', $this->_sImageType);
    }

}
