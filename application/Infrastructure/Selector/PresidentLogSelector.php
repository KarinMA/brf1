<?php

/**
 * Selector class for PresidentLog. 
 *
 * @see PresidentLog
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_PresidentLogSelector extends Selector 
{


    /**
     * PresidentLog selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * PresidentLog selector's 'created_by_user_id' property. 
     *
     * @var int
     */
    private $_iCreatedByUserId;

    /**
     * PresidentLog selector's 'document_id' property. 
     *
     * @var int
     */
    private $_iDocumentId;

    /**
     * PresidentLog selector's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;

    /**
     * PresidentLog selector's 'date' property. 
     *
     * @var string
     */
    private $_sDate;

    /**
     * PresidentLog selector's 'president_log_category_id' property. 
     *
     * @var int
     */
    private $_iPresidentLogCategoryId;

    /**
     * PresidentLog selector's 'log_name' property. 
     *
     * @var string
     */
    private $_sLogName;

    /**
     * PresidentLog selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;
    /**
     * Get PresidentLog selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set PresidentLog selector's 'brf_id' property. 
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
     * Get PresidentLog selector's 'created_by_user_id' property. 
     *
     * @return int|null
     */
    function getCreatedByUserId()
    {
        return is_null($this->_iCreatedByUserId) ? NULL : (int) $this->_iCreatedByUserId;
    }

    /**
     * Set PresidentLog selector's 'created_by_user_id' property. 
     *
     * @param int|null $a_iCreatedByUserId
     * @return void
     */
    function setCreatedByUserId($a_iCreatedByUserId)
    {
        $this->_iCreatedByUserId = is_null($a_iCreatedByUserId) ? NULL : (int) $a_iCreatedByUserId;
        $this->setSearchParameter('created_by_user_id', (int) $this->_iCreatedByUserId, is_null($this->_iCreatedByUserId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get PresidentLog selector's 'document_id' property. 
     *
     * @return int|null
     */
    function getDocumentId()
    {
        return is_null($this->_iDocumentId) ? NULL : (int) $this->_iDocumentId;
    }

    /**
     * Set PresidentLog selector's 'document_id' property. 
     *
     * @param int|null $a_iDocumentId
     * @return void
     */
    function setDocumentId($a_iDocumentId)
    {
        $this->_iDocumentId = is_null($a_iDocumentId) ? NULL : (int) $a_iDocumentId;
        $this->setSearchParameter('document_id', (int) $this->_iDocumentId, is_null($this->_iDocumentId) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get PresidentLog selector's 'comment' property. 
     *
     * @return string|null
     */
    function getComment()
    {
        return is_null($this->_sComment) ? NULL : (string) $this->_sComment;
    }

    /**
     * Set PresidentLog selector's 'comment' property. 
     *
     * @param string|null $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        $this->_sComment = is_null($a_sComment) ? NULL : (string) $a_sComment;
        $this->setSearchParameter('comment', (string) $this->_sComment, is_null($this->_sComment) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get PresidentLog selector's 'date' property. 
     *
     * @return string
     */
    function getDate()
    {
        return (string) $this->_sDate;
    }

    /**
     * Set PresidentLog selector's 'date' property. 
     *
     * @param string $a_sDate
     * @return void
     */
    function setDate($a_sDate)
    {
        $this->_sDate = (string) $a_sDate;
        $this->setSearchParameter('date', $this->_sDate);
    }

    /**
     * Get PresidentLog selector's 'president_log_category_id' property. 
     *
     * @return int
     */
    function getPresidentLogCategoryId()
    {
        return (int) $this->_iPresidentLogCategoryId;
    }

    /**
     * Set PresidentLog selector's 'president_log_category_id' property. 
     *
     * @param int $a_iPresidentLog selectorCategoryId
     * @return void
     */
    function setPresidentLogCategoryId($a_iPresidentLogCategoryId)
    {
        $this->_iPresidentLogCategoryId = (int) $a_iPresidentLogCategoryId;
        $this->setSearchParameter('president_log_category_id', $this->_iPresidentLogCategoryId);
    }

    /**
     * Get PresidentLog selector's 'log_name' property. 
     *
     * @return string|null
     */
    function getLogName()
    {
        return is_null($this->_sLogName) ? NULL : (string) $this->_sLogName;
    }

    /**
     * Set PresidentLog selector's 'log_name' property. 
     *
     * @param string|null $a_sLogName
     * @return void
     */
    function setLogName($a_sLogName)
    {
        $this->_sLogName = is_null($a_sLogName) ? NULL : (string) $a_sLogName;
        $this->setSearchParameter('log_name', (string) $this->_sLogName, is_null($this->_sLogName) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get PresidentLog selector's 'header' property. 
     *
     * @return string|null
     */
    function getHeader()
    {
        return is_null($this->_sHeader) ? NULL : (string) $this->_sHeader;
    }

    /**
     * Set PresidentLog selector's 'header' property. 
     *
     * @param string|null $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        $this->_sHeader = is_null($a_sHeader) ? NULL : (string) $a_sHeader;
        $this->setSearchParameter('header', (string) $this->_sHeader, is_null($this->_sHeader) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
