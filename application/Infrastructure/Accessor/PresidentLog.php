<?php

/**
 * Database accessor class for PresidentLog. 
 *
 * @see Accessor 
 * @see PresidentLog
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_PresidentLog extends Accessor
{


    /**
     * Get PresidentLogs by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getPresidentLogsByBrfId($a_iBrfId)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setBrfId($a_iBrfId);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'created_by_user_id' property. 
     *
     * @param int $a_iCreatedByUserId
     * @return Collection
     */
    function getPresidentLogsByCreatedByUserId($a_iCreatedByUserId)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setCreatedByUserId($a_iCreatedByUserId);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'document_id' property. 
     *
     * @param int $a_iDocumentId
     * @return Collection
     */
    function getPresidentLogsByDocumentId($a_iDocumentId)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setDocumentId($a_iDocumentId);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'comment' property. 
     *
     * @param string $a_sComment
     * @return Collection
     */
    function getPresidentLogsByComment($a_sComment)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setComment($a_sComment);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'date' property. 
     *
     * @param string $a_sDate
     * @return Collection
     */
    function getPresidentLogsByDate($a_sDate)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setDate($a_sDate);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'president_log_category_id' property. 
     *
     * @param int $a_iPresidentLogCategoryId
     * @return Collection
     */
    function getPresidentLogsByPresidentLogCategoryId($a_iPresidentLogCategoryId)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setPresidentLogCategoryId($a_iPresidentLogCategoryId);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'log_name' property. 
     *
     * @param string $a_sLogName
     * @return Collection
     */
    function getPresidentLogsByLogName($a_sLogName)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setLogName($a_sLogName);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Get PresidentLogs by 'header' property. 
     *
     * @param string $a_sHeader
     * @return Collection
     */
    function getPresidentLogsByHeader($a_sHeader)
    {
        $oPresidentLogSelector = getPresidentLogSelector();
        $oPresidentLogSelector->setHeader($a_sHeader);
        $oPresidentLogCollection = $this->read($oPresidentLogSelector);
        return $oPresidentLogCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'president_log', 'PresidentLog', new SelectionFactory_PresidentLog(), new DomainFactory_PresidentLogFactory(), new UpdateFactory_PresidentLog(), array(
            array('president_log_comment', array('dependent_objects', 'president_log_id', 'getPresidentLogId')), // gets orders customer id
            array('user', array('linked_object', 'created_by_user_id', 'setCreatedByUser')), // gets product with product id
            array('president_log_category', array('linked_object', 'president_log_category_id', 'setPresidentLogCategory')), // gets product with product id
            array('document', array('linked_object', 'document_id', 'setDocument')), // gets product with product id
        ));
    }




}
