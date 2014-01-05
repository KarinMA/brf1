<?php

/**
 * Domain object class for Document. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Document extends DomainObject 
{
    /**
     * Document's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Document's 'uploaded_by' property. 
     *
     * @var int
     */
    private $_iUploadedBy;

    /**
     * Document's 'document_type_id' property. 
     *
     * @var int
     */
    private $_iDocumentTypeId;

    /**
     * Document's 'filename' property. 
     *
     * @var string
     */
    private $_sFilename;

    /**
     * Document's 'year' property. 
     *
     * @var int
     */
    private $_iYear;

    /**
     * Document's 'is_public' property. 
     *
     * @var bool
     */
    private $_bIsPublic;

    /**
     * Document's 'file_type' property. 
     *
     * @var string
     */
    private $_sFileType;

    /**
     * Document's 'is_board' property. 
     *
     * @var bool
     */
    private $_bIsBoard;

    /**
     * Document's 'is_president' property. 
     *
     * @var bool
     */
    private $_bIsPresident;

    /**
     * Get Document's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Document's 'brf_id' property. 
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
     * Get Document's 'uploaded_by' property. 
     *
     * @return int|null
     */
    function getUploadedBy()
    {
        return is_null($this->_iUploadedBy) ? NULL : (int) $this->_iUploadedBy;
    }

    /**
     * Set Document's 'uploaded_by' property. 
     *
     * @param int|null $a_iUploadedBy
     * @return void
     */
    function setUploadedBy($a_iUploadedBy)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iUploadedBy) ? NULL : ((int) $a_iUploadedBy);
            if ($mCompareValue !== $this->_iUploadedBy) {
                $this->_markModified();
            }
        }
        $this->_iUploadedBy = is_null($a_iUploadedBy) ? NULL : (int) $a_iUploadedBy;
    }

    /**
     * The UploadedBy.
     * 
     * @var UploadedBy
     */
    private $_oUploadedBy;

    /**
     * Get the UploadedBy.
     * 
     * @return UploadedBy
     */
    function getUploaded()
    {
        return $this->_oUploaded;
    }

    /**
     * Set the UploadedBy.
     * 
     * @param Uploaded $a_oUploaded
     * 
     * @return void
     */
    function setUploaded($a_oUploaded)
    {
        $this->_iUploadedBy = $a_oUploaded->getId();
        $this->_oUploaded = $a_oUploaded;
    }

    /**
     * Get Document's 'document_type_id' property. 
     *
     * @return int
     */
    function getDocumentTypeId()
    {
        return (int) $this->_iDocumentTypeId;
    }

    /**
     * Set Document's 'document_type_id' property. 
     *
     * @param int $a_iDocumentTypeId
     * @return void
     */
    function setDocumentTypeId($a_iDocumentTypeId)
    {
        if (!is_null($this->_iDocumentTypeId) && $this->_iDocumentTypeId !== (int) $a_iDocumentTypeId) {
            $this->_markModified();
        }
        $this->_iDocumentTypeId = (int) $a_iDocumentTypeId;
    }

    /**
     * The DocumentType.
     * 
     * @var DocumentType
     */
    private $_oDocumentType;

    /**
     * Get the DocumentType.
     * 
     * @return DocumentType
     */
    function getDocumentType()
    {
        return $this->_oDocumentType;
    }

    /**
     * Set the DocumentType.
     * 
     * @param DocumentType $a_oDocumentType
     * 
     * @return void
     */
    function setDocumentType($a_oDocumentType)
    {
        $this->_iDocumentTypeId = $a_oDocumentType->getId();
        $this->_oDocumentType = $a_oDocumentType;
    }

    /**
     * Get Document's 'filename' property. 
     *
     * @return string
     */
    function getFilename()
    {
        return (string) $this->_sFilename;
    }

    /**
     * Set Document's 'filename' property. 
     *
     * @param string $a_sFilename
     * @return void
     */
    function setFilename($a_sFilename)
    {
        if (!is_null($this->_sFilename) && $this->_sFilename !== (string) $a_sFilename) {
            $this->_markModified();
        }
        $this->_sFilename = (string) $a_sFilename;
    }

    /**
     * Get Document's 'year' property. 
     *
     * @return int|null
     */
    function getYear()
    {
        return is_null($this->_iYear) ? NULL : (int) $this->_iYear;
    }

    /**
     * Set Document's 'year' property. 
     *
     * @param int|null $a_iYear
     * @return void
     */
    function setYear($a_iYear)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iYear) ? NULL : ((int) $a_iYear);
            if ($mCompareValue !== $this->_iYear) {
                $this->_markModified();
            }
        }
        $this->_iYear = is_null($a_iYear) ? NULL : (int) $a_iYear;
    }

    /**
     * Get Document's 'is_public' property. 
     *
     * @return bool
     */
    function getIsPublic()
    {
        return (bool) $this->_bIsPublic;
    }

    /**
     * Set Document's 'is_public' property. 
     *
     * @param bool $a_bIsPublic
     * @return void
     */
    function setIsPublic($a_bIsPublic)
    {
        if (!is_null($this->_bIsPublic) && $this->_bIsPublic !== (bool) $a_bIsPublic) {
            $this->_markModified();
        }
        $this->_bIsPublic = (bool) $a_bIsPublic;
    }

    /**
     * Get Document's 'file_type' property. 
     *
     * @return string
     */
    function getFileType()
    {
        return (string) $this->_sFileType;
    }

    /**
     * Set Document's 'file_type' property. 
     *
     * @param string $a_sFileType
     * @return void
     */
    function setFileType($a_sFileType)
    {
        if (!is_null($this->_sFileType) && $this->_sFileType !== (string) $a_sFileType) {
            $this->_markModified();
        }
        $this->_sFileType = (string) $a_sFileType;
    }

    /**
     * Get Document's 'is_board' property. 
     *
     * @return bool
     */
    function getIsBoard()
    {
        return (bool) $this->_bIsBoard;
    }

    /**
     * Set Document's 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return void
     */
    function setIsBoard($a_bIsBoard)
    {
        if (!is_null($this->_bIsBoard) && $this->_bIsBoard !== (bool) $a_bIsBoard) {
            $this->_markModified();
        }
        $this->_bIsBoard = (bool) $a_bIsBoard;
    }

    /**
     * Get Document's 'is_president' property. 
     *
     * @return bool
     */
    function getIsPresident()
    {
        return (bool) $this->_bIsPresident;
    }

    /**
     * Set Document's 'is_president' property. 
     *
     * @param bool $a_bIsPresident
     * @return void
     */
    function setIsPresident($a_bIsPresident)
    {
        if (!is_null($this->_bIsPresident) && $this->_bIsPresident !== (bool) $a_bIsPresident) {
            $this->_markModified();
        }
        $this->_bIsPresident = (bool) $a_bIsPresident;
    }

    /**
     * This Document's PresidentLog collection.
     * 
     * @var Collection
     */
    private $_oPresidentLogCollection;

    /**
     * Get PresidentLog collection.
     * 
     * @see PresidentLog
     * 
     * @return Collection
     */
    function getPresidentLogCollection()
    {
        if (!isset($this->_oPresidentLogCollection)) {
            $this->_oPresidentLogCollection = new Collection();
        }
        return $this->_oPresidentLogCollection;
    }



    public static function create($a_iBrfId, $a_iUploadedBy, $a_iDocumentTypeId, $a_sFilename, $a_iYear, $a_bIsPublic, $a_sFileType, $a_bIsBoard, $a_bIsPresident, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('document')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('document')->write($oObject);
        }
        return $oObject;
    }

}
