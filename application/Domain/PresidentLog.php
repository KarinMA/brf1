<?php

/**
 * Domain object class for PresidentLog. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class PresidentLog extends DomainObject 
{
    /**
     * PresidentLog's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * PresidentLog's 'created_by_user_id' property. 
     *
     * @var int
     */
    private $_iCreatedByUserId;

    /**
     * PresidentLog's 'document_id' property. 
     *
     * @var int
     */
    private $_iDocumentId;

    /**
     * PresidentLog's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;

    /**
     * PresidentLog's 'date' property. 
     *
     * @var string
     */
    private $_sDate;

    /**
     * PresidentLog's 'president_log_category_id' property. 
     *
     * @var int
     */
    private $_iPresidentLogCategoryId;

    /**
     * PresidentLog's 'log_name' property. 
     *
     * @var string
     */
    private $_sLogName;

    /**
     * PresidentLog's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * Get PresidentLog's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set PresidentLog's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (!is_null($this->_iBrfId) && $this->_iBrfId !== (int) $a_iBrfId) {
            $this->_markModified();
        }
        $this->_iBrfId = (int) $a_iBrfId;
    }

    /**
     * The Brf.
     * 
     * @var Brf
     */
    private $_oBrf;

    /**
     * Get the Brf.
     * 
     * @return Brf
     */
    function getBrf()
    {
        return $this->_oBrf;
    }

    /**
     * Set the Brf.
     * 
     * @param Brf $a_oBrf
     * 
     * @return void
     */
    function setBrf($a_oBrf)
    {
        $this->_iBrfId = $a_oBrf->getId();
        $this->_oBrf = $a_oBrf;
    }

    /**
     * Get PresidentLog's 'created_by_user_id' property. 
     *
     * @return int|null
     */
    function getCreatedByUserId()
    {
        return is_null($this->_iCreatedByUserId) ? NULL : (int) $this->_iCreatedByUserId;
    }

    /**
     * Set PresidentLog's 'created_by_user_id' property. 
     *
     * @param int|null $a_iCreatedByUserId
     * @return void
     */
    function setCreatedByUserId($a_iCreatedByUserId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iCreatedByUserId) ? NULL : ((int) $a_iCreatedByUserId);
            if ($mCompareValue !== $this->_iCreatedByUserId) {
                $this->_markModified();
            }
        }
        $this->_iCreatedByUserId = is_null($a_iCreatedByUserId) ? NULL : (int) $a_iCreatedByUserId;
    }

    /**
     * The CreatedByUser.
     * 
     * @var CreatedByUser
     */
    private $_oCreatedByUser;

    /**
     * Get the CreatedByUser.
     * 
     * @return CreatedByUser
     */
    function getCreatedByUser()
    {
        return $this->_oCreatedByUser;
    }

    /**
     * Set the CreatedByUser.
     * 
     * @param CreatedByUser $a_oCreatedByUser
     * 
     * @return void
     */
    function setCreatedByUser($a_oCreatedByUser)
    {
        $this->_iCreatedByUserId = $a_oCreatedByUser->getId();
        $this->_oCreatedByUser = $a_oCreatedByUser;
    }

    /**
     * Get PresidentLog's 'document_id' property. 
     *
     * @return int|null
     */
    function getDocumentId()
    {
        return is_null($this->_iDocumentId) ? NULL : (int) $this->_iDocumentId;
    }

    /**
     * Set PresidentLog's 'document_id' property. 
     *
     * @param int|null $a_iDocumentId
     * @return void
     */
    function setDocumentId($a_iDocumentId)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iDocumentId) ? NULL : ((int) $a_iDocumentId);
            if ($mCompareValue !== $this->_iDocumentId) {
                $this->_markModified();
            }
        }
        $this->_iDocumentId = is_null($a_iDocumentId) ? NULL : (int) $a_iDocumentId;
    }

    /**
     * The Document.
     * 
     * @var Document
     */
    private $_oDocument;

    /**
     * Get the Document.
     * 
     * @return Document
     */
    function getDocument()
    {
        return $this->_oDocument;
    }

    /**
     * Set the Document.
     * 
     * @param Document $a_oDocument
     * 
     * @return void
     */
    function setDocument($a_oDocument)
    {
        $this->_iDocumentId = $a_oDocument->getId();
        $this->_oDocument = $a_oDocument;
    }

    /**
     * Get PresidentLog's 'comment' property. 
     *
     * @return string|null
     */
    function getComment()
    {
        return is_null($this->_sComment) ? NULL : (string) $this->_sComment;
    }

    /**
     * Set PresidentLog's 'comment' property. 
     *
     * @param string|null $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sComment) ? NULL : ((string) $a_sComment);
            if ($mCompareValue !== $this->_sComment) {
                $this->_markModified();
            }
        }
        $this->_sComment = is_null($a_sComment) ? NULL : (string) $a_sComment;
    }

    /**
     * Get PresidentLog's 'date' property. 
     *
     * @return string
     */
    function getDate()
    {
        return strlen($this->_sDate) ? (string) $this->_sDate : NULL;
    }

    /**
     * Set PresidentLog's 'date' property. 
     *
     * @param string $a_sDate
     * @return void
     */
    function setDate($a_sDate)
    {
        if (!is_null($this->_sDate) && $this->_sDate !== (string) $a_sDate) {
            $this->_markModified();
        }
        $this->_sDate = (string) $a_sDate;
    }

    /**
     * Get PresidentLog's 'president_log_category_id' property. 
     *
     * @return int
     */
    function getPresidentLogCategoryId()
    {
        return (int) $this->_iPresidentLogCategoryId;
    }

    /**
     * Set PresidentLog's 'president_log_category_id' property. 
     *
     * @param int $a_iPresidentLogCategoryId
     * @return void
     */
    function setPresidentLogCategoryId($a_iPresidentLogCategoryId)
    {
        if (!is_null($this->_iPresidentLogCategoryId) && $this->_iPresidentLogCategoryId !== (int) $a_iPresidentLogCategoryId) {
            $this->_markModified();
        }
        $this->_iPresidentLogCategoryId = (int) $a_iPresidentLogCategoryId;
    }

    /**
     * The PresidentLogCategory.
     * 
     * @var PresidentLogCategory
     */
    private $_oPresidentLogCategory;

    /**
     * Get the PresidentLogCategory.
     * 
     * @return PresidentLogCategory
     */
    function getPresidentLogCategory()
    {
        return $this->_oPresidentLogCategory;
    }

    /**
     * Set the PresidentLogCategory.
     * 
     * @param PresidentLogCategory $a_oPresidentLogCategory
     * 
     * @return void
     */
    function setPresidentLogCategory($a_oPresidentLogCategory)
    {
        $this->_iPresidentLogCategoryId = $a_oPresidentLogCategory->getId();
        $this->_oPresidentLogCategory = $a_oPresidentLogCategory;
    }

    /**
     * Get PresidentLog's 'log_name' property. 
     *
     * @return string|null
     */
    function getLogName()
    {
        return is_null($this->_sLogName) ? NULL : (string) $this->_sLogName;
    }

    /**
     * Set PresidentLog's 'log_name' property. 
     *
     * @param string|null $a_sLogName
     * @return void
     */
    function setLogName($a_sLogName)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sLogName) ? NULL : ((string) $a_sLogName);
            if ($mCompareValue !== $this->_sLogName) {
                $this->_markModified();
            }
        }
        $this->_sLogName = is_null($a_sLogName) ? NULL : (string) $a_sLogName;
    }

    /**
     * Get PresidentLog's 'header' property. 
     *
     * @return string|null
     */
    function getHeader()
    {
        return is_null($this->_sHeader) ? NULL : (string) $this->_sHeader;
    }

    /**
     * Set PresidentLog's 'header' property. 
     *
     * @param string|null $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sHeader) ? NULL : ((string) $a_sHeader);
            if ($mCompareValue !== $this->_sHeader) {
                $this->_markModified();
            }
        }
        $this->_sHeader = is_null($a_sHeader) ? NULL : (string) $a_sHeader;
    }

    /**
     * This PresidentLog's PresidentLogComment collection.
     * 
     * @var Collection
     */
    private $_oPresidentLogCommentCollection;

    /**
     * Get PresidentLogComment collection.
     * 
     * @see PresidentLogComment
     * 
     * @return Collection
     */
    function getPresidentLogCommentCollection()
    {
        if (!isset($this->_oPresidentLogCommentCollection)) {
            $this->_oPresidentLogCommentCollection = new Collection();
        }
        return $this->_oPresidentLogCommentCollection;
    }



    public static function create($a_iBrfId, $a_iCreatedByUserId, $a_iDocumentId, $a_sComment, $a_sDate, $a_iPresidentLogCategoryId, $a_sLogName, $a_sHeader, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('president_log')->write($oObject);
        }
        return $oObject;
    }

}
