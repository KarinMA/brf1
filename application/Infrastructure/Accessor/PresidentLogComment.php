<?php

/**
 * Database accessor class for PresidentLogComment. 
 *
 * @see Accessor 
 * @see PresidentLogComment
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_PresidentLogComment extends Accessor
{


    /**
     * Get PresidentLogComments by 'president_log_id' property. 
     *
     * @param int $a_iPresidentLogId
     * @return Collection
     */
    function getPresidentLogCommentsByPresidentLogId($a_iPresidentLogId)
    {
        $oPresidentLogCommentSelector = getPresidentLogCommentSelector();
        $oPresidentLogCommentSelector->setPresidentLogId($a_iPresidentLogId);
        $oPresidentLogCommentCollection = $this->read($oPresidentLogCommentSelector);
        return $oPresidentLogCommentCollection;

    }

    /**
     * Get PresidentLogComments by 'by_user_id' property. 
     *
     * @param int $a_iByUserId
     * @return Collection
     */
    function getPresidentLogCommentsByByUserId($a_iByUserId)
    {
        $oPresidentLogCommentSelector = getPresidentLogCommentSelector();
        $oPresidentLogCommentSelector->setByUserId($a_iByUserId);
        $oPresidentLogCommentCollection = $this->read($oPresidentLogCommentSelector);
        return $oPresidentLogCommentCollection;

    }

    /**
     * Get PresidentLogComments by 'timestamp' property. 
     *
     * @param string $a_sTimestamp
     * @return Collection
     */
    function getPresidentLogCommentsByTimestamp($a_sTimestamp)
    {
        $oPresidentLogCommentSelector = getPresidentLogCommentSelector();
        $oPresidentLogCommentSelector->setTimestamp($a_sTimestamp);
        $oPresidentLogCommentCollection = $this->read($oPresidentLogCommentSelector);
        return $oPresidentLogCommentCollection;

    }

    /**
     * Get PresidentLogComments by 'comment' property. 
     *
     * @param string $a_sComment
     * @return Collection
     */
    function getPresidentLogCommentsByComment($a_sComment)
    {
        $oPresidentLogCommentSelector = getPresidentLogCommentSelector();
        $oPresidentLogCommentSelector->setComment($a_sComment);
        $oPresidentLogCommentCollection = $this->read($oPresidentLogCommentSelector);
        return $oPresidentLogCommentCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'president_log_comment', 'PresidentLogComment', new SelectionFactory_PresidentLogComment(), new DomainFactory_PresidentLogCommentFactory(), new UpdateFactory_PresidentLogComment(), array(
            array('user', array('linked_object', 'by_user_id', 'setByUser')), // gets product with product id
        ));
    }




}
