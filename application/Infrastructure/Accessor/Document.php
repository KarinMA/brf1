<?php

/**
 * Database accessor class for Document. 
 *
 * @see Accessor 
 * @see Document
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Document extends Accessor
{


    /**
     * Get Documents by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getDocumentsByBrfId($a_iBrfId)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setBrfId($a_iBrfId);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'uploaded_by' property. 
     *
     * @param int $a_iUploadedBy
     * @return Collection
     */
    function getDocumentsByUploadedBy($a_iUploadedBy)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setUploadedBy($a_iUploadedBy);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'document_type_id' property. 
     *
     * @param int $a_iDocumentTypeId
     * @return Collection
     */
    function getDocumentsByDocumentTypeId($a_iDocumentTypeId)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setDocumentTypeId($a_iDocumentTypeId);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'filename' property. 
     *
     * @param string $a_sFilename
     * @return Collection
     */
    function getDocumentsByFilename($a_sFilename)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setFilename($a_sFilename);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'year' property. 
     *
     * @param int $a_iYear
     * @return Collection
     */
    function getDocumentsByYear($a_iYear)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setYear($a_iYear);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'is_public' property. 
     *
     * @param bool $a_bIsPublic
     * @return Collection
     */
    function getDocumentsByIsPublic($a_bIsPublic)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setIsPublic($a_bIsPublic);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'file_type' property. 
     *
     * @param string $a_sFileType
     * @return Collection
     */
    function getDocumentsByFileType($a_sFileType)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setFileType($a_sFileType);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return Collection
     */
    function getDocumentsByIsBoard($a_bIsBoard)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setIsBoard($a_bIsBoard);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Get Documents by 'is_president' property. 
     *
     * @param bool $a_bIsPresident
     * @return Collection
     */
    function getDocumentsByIsPresident($a_bIsPresident)
    {
        $oDocumentSelector = getDocumentSelector();
        $oDocumentSelector->setIsPresident($a_bIsPresident);
        $oDocumentCollection = $this->read($oDocumentSelector);
        return $oDocumentCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'document', 'Document', new SelectionFactory_Document(), new DomainFactory_DocumentFactory(), new UpdateFactory_Document(), array(
            array('document_type', array('linked_object', 'document_type_id', 'setDocumentType')), // gets product with product id
            array('brf', array('linked_object', 'brf_id', 'setBrf')), // gets product with product id
        ));
    }




}
