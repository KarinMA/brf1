<?php

/**
 * Domain object class for RealtorInformationType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class RealtorInformationType extends DomainObject 
{
    /**
     * RealtorInformationType's 'realtor_information_category_id' property. 
     *
     * @var int
     */
    private $_iRealtorInformationCategoryId;

    /**
     * RealtorInformationType's 'type_key' property. 
     *
     * @var string
     */
    private $_sTypeKey;

    /**
     * RealtorInformationType's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;

    /**
     * RealtorInformationType's 'type_name_public' property. 
     *
     * @var string
     */
    private $_sTypeNamePublic;

    /**
     * RealtorInformationType's 'comment_public' property. 
     *
     * @var string
     */
    private $_sCommentPublic;

    /**
     * RealtorInformationType's 'required' property. 
     *
     * @var bool
     */
    private $_bRequired;

    /**
     * RealtorInformationType's 'comment_required_yes' property. 
     *
     * @var bool
     */
    private $_bCommentRequiredYes;

    /**
     * RealtorInformationType's 'comment_required_no' property. 
     *
     * @var bool
     */
    private $_bCommentRequiredNo;

    /**
     * Get RealtorInformationType's 'realtor_information_category_id' property. 
     *
     * @return int
     */
    function getRealtorInformationCategoryId()
    {
        return (int) $this->_iRealtorInformationCategoryId;
    }

    /**
     * Set RealtorInformationType's 'realtor_information_category_id' property. 
     *
     * @param int $a_iRealtorInformationCategoryId
     * @return void
     */
    function setRealtorInformationCategoryId($a_iRealtorInformationCategoryId)
    {
        if (!is_null($this->_iRealtorInformationCategoryId) && $this->_iRealtorInformationCategoryId !== (int) $a_iRealtorInformationCategoryId) {
            $this->_markModified();
        }
        $this->_iRealtorInformationCategoryId = (int) $a_iRealtorInformationCategoryId;
    }

    /**
     * The RealtorInformationCategory.
     * 
     * @var RealtorInformationCategory
     */
    private $_oRealtorInformationCategory;

    /**
     * Get the RealtorInformationCategory.
     * 
     * @return RealtorInformationCategory
     */
    function getRealtorInformationCategory()
    {
        return $this->_oRealtorInformationCategory;
    }

    /**
     * Set the RealtorInformationCategory.
     * 
     * @param RealtorInformationCategory $a_oRealtorInformationCategory
     * 
     * @return void
     */
    function setRealtorInformationCategory($a_oRealtorInformationCategory)
    {
        $this->_iRealtorInformationCategoryId = $a_oRealtorInformationCategory->getId();
        $this->_oRealtorInformationCategory = $a_oRealtorInformationCategory;
    }

    /**
     * Get RealtorInformationType's 'type_key' property. 
     *
     * @return string
     */
    function getTypeKey()
    {
        return (string) $this->_sTypeKey;
    }

    /**
     * Set RealtorInformationType's 'type_key' property. 
     *
     * @param string $a_sTypeKey
     * @return void
     */
    function setTypeKey($a_sTypeKey)
    {
        if (!is_null($this->_sTypeKey) && $this->_sTypeKey !== (string) $a_sTypeKey) {
            $this->_markModified();
        }
        $this->_sTypeKey = (string) $a_sTypeKey;
    }

    /**
     * Get RealtorInformationType's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set RealtorInformationType's 'type_name' property. 
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
     * Get RealtorInformationType's 'type_name_public' property. 
     *
     * @return string
     */
    function getTypeNamePublic()
    {
        return (string) $this->_sTypeNamePublic;
    }

    /**
     * Set RealtorInformationType's 'type_name_public' property. 
     *
     * @param string $a_sTypeNamePublic
     * @return void
     */
    function setTypeNamePublic($a_sTypeNamePublic)
    {
        if (!is_null($this->_sTypeNamePublic) && $this->_sTypeNamePublic !== (string) $a_sTypeNamePublic) {
            $this->_markModified();
        }
        $this->_sTypeNamePublic = (string) $a_sTypeNamePublic;
    }

    /**
     * Get RealtorInformationType's 'comment_public' property. 
     *
     * @return string
     */
    function getCommentPublic()
    {
        return (string) $this->_sCommentPublic;
    }

    /**
     * Set RealtorInformationType's 'comment_public' property. 
     *
     * @param string $a_sCommentPublic
     * @return void
     */
    function setCommentPublic($a_sCommentPublic)
    {
        if (!is_null($this->_sCommentPublic) && $this->_sCommentPublic !== (string) $a_sCommentPublic) {
            $this->_markModified();
        }
        $this->_sCommentPublic = (string) $a_sCommentPublic;
    }

    /**
     * Get RealtorInformationType's 'required' property. 
     *
     * @return bool
     */
    function getRequired()
    {
        return (bool) $this->_bRequired;
    }

    /**
     * Set RealtorInformationType's 'required' property. 
     *
     * @param bool $a_bRequired
     * @return void
     */
    function setRequired($a_bRequired)
    {
        if (!is_null($this->_bRequired) && $this->_bRequired !== (bool) $a_bRequired) {
            $this->_markModified();
        }
        $this->_bRequired = (bool) $a_bRequired;
    }

    /**
     * Get RealtorInformationType's 'comment_required_yes' property. 
     *
     * @return bool
     */
    function getCommentRequiredYes()
    {
        return (bool) $this->_bCommentRequiredYes;
    }

    /**
     * Set RealtorInformationType's 'comment_required_yes' property. 
     *
     * @param bool $a_bCommentRequiredYes
     * @return void
     */
    function setCommentRequiredYes($a_bCommentRequiredYes)
    {
        if (!is_null($this->_bCommentRequiredYes) && $this->_bCommentRequiredYes !== (bool) $a_bCommentRequiredYes) {
            $this->_markModified();
        }
        $this->_bCommentRequiredYes = (bool) $a_bCommentRequiredYes;
    }

    /**
     * Get RealtorInformationType's 'comment_required_no' property. 
     *
     * @return bool
     */
    function getCommentRequiredNo()
    {
        return (bool) $this->_bCommentRequiredNo;
    }

    /**
     * Set RealtorInformationType's 'comment_required_no' property. 
     *
     * @param bool $a_bCommentRequiredNo
     * @return void
     */
    function setCommentRequiredNo($a_bCommentRequiredNo)
    {
        if (!is_null($this->_bCommentRequiredNo) && $this->_bCommentRequiredNo !== (bool) $a_bCommentRequiredNo) {
            $this->_markModified();
        }
        $this->_bCommentRequiredNo = (bool) $a_bCommentRequiredNo;
    }

    /**
     * This RealtorInformationType's RealtorInformation collection.
     * 
     * @var Collection
     */
    private $_oRealtorInformationCollection;

    /**
     * Get RealtorInformation collection.
     * 
     * @see RealtorInformation
     * 
     * @return Collection
     */
    function getRealtorInformationCollection()
    {
        if (!isset($this->_oRealtorInformationCollection)) {
            $this->_oRealtorInformationCollection = new Collection();
        }
        return $this->_oRealtorInformationCollection;
    }

    /**
     * This RealtorInformationType's RealtorInformationHistory collection.
     * 
     * @var Collection
     */
    private $_oRealtorInformationHistoryCollection;

    /**
     * Get RealtorInformationHistory collection.
     * 
     * @see RealtorInformationHistory
     * 
     * @return Collection
     */
    function getRealtorInformationHistoryCollection()
    {
        if (!isset($this->_oRealtorInformationHistoryCollection)) {
            $this->_oRealtorInformationHistoryCollection = new Collection();
        }
        return $this->_oRealtorInformationHistoryCollection;
    }



    public static function create($a_iRealtorInformationCategoryId, $a_sTypeKey, $a_sTypeName, $a_sTypeNamePublic, $a_sCommentPublic, $a_bRequired, $a_bCommentRequiredYes, $a_bCommentRequiredNo, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('realtor_information_type')->write($oObject);
        }
        return $oObject;
    }

}
