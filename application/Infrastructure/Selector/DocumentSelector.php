<?php

/**
 * Selector class for Document. 
 *
 * @see Document
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_DocumentSelector extends Selector 
{


    /**
     * Document selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Document selector's 'uploaded_by' property. 
     *
     * @var int
     */
    private $_iUploadedBy;

    /**
     * Document selector's 'document_type_id' property. 
     *
     * @var int
     */
    private $_iDocumentTypeId;

    /**
     * Document selector's 'filename' property. 
     *
     * @var string
     */
    private $_sFilename;

    /**
     * Document selector's 'year' property. 
     *
     * @var int
     */
    private $_iYear;

    /**
     * Document selector's 'is_public' property. 
     *
     * @var bool
     */
    private $_bIsPublic;

    /**
     * Document selector's 'file_type' property. 
     *
     * @var string
     */
    private $_sFileType;

    /**
     * Document selector's 'is_board' property. 
     *
     * @var bool
     */
    private $_bIsBoard;

    /**
     * Document selector's 'is_president' property. 
     *
     * @var bool
     */
    private $_bIsPresident;
    /**
     * Get Document selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Document selector's 'brf_id' property. 
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
     * Get Document selector's 'uploaded_by' property. 
     *
     * @return int|null
     */
    function getUploadedBy()
    {
        return is_null($this->_iUploadedBy) ? NULL : (int) $this->_iUploadedBy;
    }

    /**
     * Set Document selector's 'uploaded_by' property. 
     *
     * @param int|null $a_iUploadedBy
     * @return void
     */
    function setUploadedBy($a_iUploadedBy)
    {
        $this->_iUploadedBy = is_null($a_iUploadedBy) ? NULL : (int) $a_iUploadedBy;
        $this->setSearchParameter('uploaded_by', (int) $this->_iUploadedBy, is_null($this->_iUploadedBy) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Document selector's 'document_type_id' property. 
     *
     * @return int
     */
    function getDocumentTypeId()
    {
        return (int) $this->_iDocumentTypeId;
    }

    /**
     * Set Document selector's 'document_type_id' property. 
     *
     * @param int $a_iDocument selectorTypeId
     * @return void
     */
    function setDocumentTypeId($a_iDocumentTypeId)
    {
        $this->_iDocumentTypeId = (int) $a_iDocumentTypeId;
        $this->setSearchParameter('document_type_id', $this->_iDocumentTypeId);
    }

    /**
     * Get Document selector's 'filename' property. 
     *
     * @return string
     */
    function getFilename()
    {
        return (string) $this->_sFilename;
    }

    /**
     * Set Document selector's 'filename' property. 
     *
     * @param string $a_sFilename
     * @return void
     */
    function setFilename($a_sFilename)
    {
        $this->_sFilename = (string) $a_sFilename;
        $this->setSearchParameter('filename', $this->_sFilename);
    }

    /**
     * Get Document selector's 'year' property. 
     *
     * @return int|null
     */
    function getYear()
    {
        return is_null($this->_iYear) ? NULL : (int) $this->_iYear;
    }

    /**
     * Set Document selector's 'year' property. 
     *
     * @param int|null $a_iYear
     * @return void
     */
    function setYear($a_iYear)
    {
        $this->_iYear = is_null($a_iYear) ? NULL : (int) $a_iYear;
        $this->setSearchParameter('year', (int) $this->_iYear, is_null($this->_iYear) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Document selector's 'is_public' property. 
     *
     * @return bool
     */
    function getIsPublic()
    {
        return (bool) $this->_bIsPublic;
    }

    /**
     * Set Document selector's 'is_public' property. 
     *
     * @param bool $a_bIsPublic
     * @return void
     */
    function setIsPublic($a_bIsPublic)
    {
        $this->_bIsPublic = (bool) $a_bIsPublic;
        $this->setSearchParameter('is_public', $this->_bIsPublic);
    }

    /**
     * Get Document selector's 'file_type' property. 
     *
     * @return string
     */
    function getFileType()
    {
        return (string) $this->_sFileType;
    }

    /**
     * Set Document selector's 'file_type' property. 
     *
     * @param string $a_sFileType
     * @return void
     */
    function setFileType($a_sFileType)
    {
        $this->_sFileType = (string) $a_sFileType;
        $this->setSearchParameter('file_type', $this->_sFileType);
    }

    /**
     * Get Document selector's 'is_board' property. 
     *
     * @return bool
     */
    function getIsBoard()
    {
        return (bool) $this->_bIsBoard;
    }

    /**
     * Set Document selector's 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return void
     */
    function setIsBoard($a_bIsBoard)
    {
        $this->_bIsBoard = (bool) $a_bIsBoard;
        $this->setSearchParameter('is_board', $this->_bIsBoard);
    }

    /**
     * Get Document selector's 'is_president' property. 
     *
     * @return bool
     */
    function getIsPresident()
    {
        return (bool) $this->_bIsPresident;
    }

    /**
     * Set Document selector's 'is_president' property. 
     *
     * @param bool $a_bIsPresident
     * @return void
     */
    function setIsPresident($a_bIsPresident)
    {
        $this->_bIsPresident = (bool) $a_bIsPresident;
        $this->setSearchParameter('is_president', $this->_bIsPresident);
    }

}
