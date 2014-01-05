<?php

/**
 * Domain object class for Startpage. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Startpage extends DomainObject 
{
    /**
     * Startpage's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * Startpage's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * Startpage's 'content' property. 
     *
     * @var string
     */
    private $_sContent;

    /**
     * Startpage's 'edited_by' property. 
     *
     * @var int
     */
    private $_iEditedBy;

    /**
     * Startpage's 'edited_at' property. 
     *
     * @var string
     */
    private $_sEditedAt;

    /**
     * Startpage's 'content_type' property. 
     *
     * @var string
     */
    private $_sContentType;

    /**
     * Startpage's 'category' property. 
     *
     * @var string
     */
    private $_sCategory;

    /**
     * Get Startpage's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set Startpage's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        if (!is_null($this->_sName) && $this->_sName !== (string) $a_sName) {
            $this->_markModified();
        }
        $this->_sName = (string) $a_sName;
    }

    /**
     * Get Startpage's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set Startpage's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        if (!is_null($this->_sDescription) && $this->_sDescription !== (string) $a_sDescription) {
            $this->_markModified();
        }
        $this->_sDescription = (string) $a_sDescription;
    }

    /**
     * Get Startpage's 'content' property. 
     *
     * @return string
     */
    function getContent()
    {
        return (string) $this->_sContent;
    }

    /**
     * Set Startpage's 'content' property. 
     *
     * @param string $a_sContent
     * @return void
     */
    function setContent($a_sContent)
    {
        if (!is_null($this->_sContent) && $this->_sContent !== (string) $a_sContent) {
            $this->_markModified();
        }
        $this->_sContent = (string) $a_sContent;
    }

    /**
     * Get Startpage's 'edited_by' property. 
     *
     * @return int
     */
    function getEditedBy()
    {
        return (int) $this->_iEditedBy;
    }

    /**
     * Set Startpage's 'edited_by' property. 
     *
     * @param int $a_iEditedBy
     * @return void
     */
    function setEditedBy($a_iEditedBy)
    {
        if (!is_null($this->_iEditedBy) && $this->_iEditedBy !== (int) $a_iEditedBy) {
            $this->_markModified();
        }
        $this->_iEditedBy = (int) $a_iEditedBy;
    }

    /**
     * The EditedBy.
     * 
     * @var EditedBy
     */
    private $_oEditedBy;

    /**
     * Get the EditedBy.
     * 
     * @return EditedBy
     */
    function getEdited()
    {
        return $this->_oEdited;
    }

    /**
     * Set the EditedBy.
     * 
     * @param Edited $a_oEdited
     * 
     * @return void
     */
    function setEdited($a_oEdited)
    {
        $this->_iEditedBy = $a_oEdited->getId();
        $this->_oEdited = $a_oEdited;
    }

    /**
     * Get Startpage's 'edited_at' property. 
     *
     * @return string
     */
    function getEditedAt()
    {
        return strlen($this->_sEditedAt) ? (string) $this->_sEditedAt : NULL;
    }

    /**
     * Set Startpage's 'edited_at' property. 
     *
     * @param string $a_sEditedAt
     * @return void
     */
    function setEditedAt($a_sEditedAt)
    {
        if (!is_null($this->_sEditedAt) && $this->_sEditedAt !== (string) $a_sEditedAt) {
            $this->_markModified();
        }
        $this->_sEditedAt = (string) $a_sEditedAt;
    }

    /**
     * Get Startpage's 'content_type' property. 
     *
     * @return string
     */
    function getContentType()
    {
        return (string) $this->_sContentType;
    }

    /**
     * Set Startpage's 'content_type' property. 
     *
     * @param string $a_sContentType
     * @return void
     */
    function setContentType($a_sContentType)
    {
        if (!is_null($this->_sContentType) && $this->_sContentType !== (string) $a_sContentType) {
            $this->_markModified();
        }
        $this->_sContentType = (string) $a_sContentType;
    }

    /**
     * Get Startpage's 'category' property. 
     *
     * @return string
     */
    function getCategory()
    {
        return (string) $this->_sCategory;
    }

    /**
     * Set Startpage's 'category' property. 
     *
     * @param string $a_sCategory
     * @return void
     */
    function setCategory($a_sCategory)
    {
        if (!is_null($this->_sCategory) && $this->_sCategory !== (string) $a_sCategory) {
            $this->_markModified();
        }
        $this->_sCategory = (string) $a_sCategory;
    }



    public static function create($a_sName, $a_sDescription, $a_sContent, $a_iEditedBy, $a_sEditedAt, $a_sContentType, $a_sCategory, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('startpage')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('startpage')->write($oObject);
        }
        return $oObject;
    }

}
