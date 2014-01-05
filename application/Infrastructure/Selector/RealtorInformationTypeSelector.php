<?php

/**
 * Selector class for RealtorInformationType. 
 *
 * @see RealtorInformationType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_RealtorInformationTypeSelector extends Selector 
{


    /**
     * RealtorInformationType selector's 'realtor_information_category_id' property. 
     *
     * @var int
     */
    private $_iRealtorInformationCategoryId;

    /**
     * RealtorInformationType selector's 'type_key' property. 
     *
     * @var string
     */
    private $_sTypeKey;

    /**
     * RealtorInformationType selector's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;

    /**
     * RealtorInformationType selector's 'type_name_public' property. 
     *
     * @var string
     */
    private $_sTypeNamePublic;

    /**
     * RealtorInformationType selector's 'comment_public' property. 
     *
     * @var string
     */
    private $_sCommentPublic;

    /**
     * RealtorInformationType selector's 'required' property. 
     *
     * @var bool
     */
    private $_bRequired;

    /**
     * RealtorInformationType selector's 'comment_required_yes' property. 
     *
     * @var bool
     */
    private $_bCommentRequiredYes;

    /**
     * RealtorInformationType selector's 'comment_required_no' property. 
     *
     * @var bool
     */
    private $_bCommentRequiredNo;
    /**
     * Get RealtorInformationType selector's 'realtor_information_category_id' property. 
     *
     * @return int
     */
    function getRealtorInformationCategoryId()
    {
        return (int) $this->_iRealtorInformationCategoryId;
    }

    /**
     * Set RealtorInformationType selector's 'realtor_information_category_id' property. 
     *
     * @param int $a_iRealtorInformationCategoryId
     * @return void
     */
    function setRealtorInformationCategoryId($a_iRealtorInformationCategoryId)
    {
        $this->_iRealtorInformationCategoryId = (int) $a_iRealtorInformationCategoryId;
        $this->setSearchParameter('realtor_information_category_id', $this->_iRealtorInformationCategoryId);
    }

    /**
     * Get RealtorInformationType selector's 'type_key' property. 
     *
     * @return string
     */
    function getTypeKey()
    {
        return (string) $this->_sTypeKey;
    }

    /**
     * Set RealtorInformationType selector's 'type_key' property. 
     *
     * @param string $a_sTypeKey
     * @return void
     */
    function setTypeKey($a_sTypeKey)
    {
        $this->_sTypeKey = (string) $a_sTypeKey;
        $this->setSearchParameter('type_key', $this->_sTypeKey);
    }

    /**
     * Get RealtorInformationType selector's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set RealtorInformationType selector's 'type_name' property. 
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
     * Get RealtorInformationType selector's 'type_name_public' property. 
     *
     * @return string
     */
    function getTypeNamePublic()
    {
        return (string) $this->_sTypeNamePublic;
    }

    /**
     * Set RealtorInformationType selector's 'type_name_public' property. 
     *
     * @param string $a_sTypeNamePublic
     * @return void
     */
    function setTypeNamePublic($a_sTypeNamePublic)
    {
        $this->_sTypeNamePublic = (string) $a_sTypeNamePublic;
        $this->setSearchParameter('type_name_public', $this->_sTypeNamePublic);
    }

    /**
     * Get RealtorInformationType selector's 'comment_public' property. 
     *
     * @return string
     */
    function getCommentPublic()
    {
        return (string) $this->_sCommentPublic;
    }

    /**
     * Set RealtorInformationType selector's 'comment_public' property. 
     *
     * @param string $a_sCommentPublic
     * @return void
     */
    function setCommentPublic($a_sCommentPublic)
    {
        $this->_sCommentPublic = (string) $a_sCommentPublic;
        $this->setSearchParameter('comment_public', $this->_sCommentPublic);
    }

    /**
     * Get RealtorInformationType selector's 'required' property. 
     *
     * @return bool
     */
    function getRequired()
    {
        return (bool) $this->_bRequired;
    }

    /**
     * Set RealtorInformationType selector's 'required' property. 
     *
     * @param bool $a_bRequired
     * @return void
     */
    function setRequired($a_bRequired)
    {
        $this->_bRequired = (bool) $a_bRequired;
        $this->setSearchParameter('required', $this->_bRequired);
    }

    /**
     * Get RealtorInformationType selector's 'comment_required_yes' property. 
     *
     * @return bool
     */
    function getCommentRequiredYes()
    {
        return (bool) $this->_bCommentRequiredYes;
    }

    /**
     * Set RealtorInformationType selector's 'comment_required_yes' property. 
     *
     * @param bool $a_bCommentRequiredYes
     * @return void
     */
    function setCommentRequiredYes($a_bCommentRequiredYes)
    {
        $this->_bCommentRequiredYes = (bool) $a_bCommentRequiredYes;
        $this->setSearchParameter('comment_required_yes', $this->_bCommentRequiredYes);
    }

    /**
     * Get RealtorInformationType selector's 'comment_required_no' property. 
     *
     * @return bool
     */
    function getCommentRequiredNo()
    {
        return (bool) $this->_bCommentRequiredNo;
    }

    /**
     * Set RealtorInformationType selector's 'comment_required_no' property. 
     *
     * @param bool $a_bCommentRequiredNo
     * @return void
     */
    function setCommentRequiredNo($a_bCommentRequiredNo)
    {
        $this->_bCommentRequiredNo = (bool) $a_bCommentRequiredNo;
        $this->setSearchParameter('comment_required_no', $this->_bCommentRequiredNo);
    }

}
