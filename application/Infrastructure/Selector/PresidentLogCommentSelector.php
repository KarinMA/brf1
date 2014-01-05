<?php

/**
 * Selector class for PresidentLogComment. 
 *
 * @see PresidentLogComment
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_PresidentLogCommentSelector extends Selector 
{


    /**
     * PresidentLogComment selector's 'president_log_id' property. 
     *
     * @var int
     */
    private $_iPresidentLogId;

    /**
     * PresidentLogComment selector's 'by_user_id' property. 
     *
     * @var int
     */
    private $_iByUserId;

    /**
     * PresidentLogComment selector's 'timestamp' property. 
     *
     * @var string
     */
    private $_sTimestamp;

    /**
     * PresidentLogComment selector's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;
    /**
     * Get PresidentLogComment selector's 'president_log_id' property. 
     *
     * @return int
     */
    function getPresidentLogId()
    {
        return (int) $this->_iPresidentLogId;
    }

    /**
     * Set PresidentLogComment selector's 'president_log_id' property. 
     *
     * @param int $a_iPresidentLogId
     * @return void
     */
    function setPresidentLogId($a_iPresidentLogId)
    {
        $this->_iPresidentLogId = (int) $a_iPresidentLogId;
        $this->setSearchParameter('president_log_id', $this->_iPresidentLogId);
    }

    /**
     * Get PresidentLogComment selector's 'by_user_id' property. 
     *
     * @return int
     */
    function getByUserId()
    {
        return (int) $this->_iByUserId;
    }

    /**
     * Set PresidentLogComment selector's 'by_user_id' property. 
     *
     * @param int $a_iByUserId
     * @return void
     */
    function setByUserId($a_iByUserId)
    {
        $this->_iByUserId = (int) $a_iByUserId;
        $this->setSearchParameter('by_user_id', $this->_iByUserId);
    }

    /**
     * Get PresidentLogComment selector's 'timestamp' property. 
     *
     * @return string
     */
    function getTimestamp()
    {
        return (string) $this->_sTimestamp;
    }

    /**
     * Set PresidentLogComment selector's 'timestamp' property. 
     *
     * @param string $a_sTimestamp
     * @return void
     */
    function setTimestamp($a_sTimestamp)
    {
        $this->_sTimestamp = (string) $a_sTimestamp;
        $this->setSearchParameter('timestamp', $this->_sTimestamp);
    }

    /**
     * Get PresidentLogComment selector's 'comment' property. 
     *
     * @return string
     */
    function getComment()
    {
        return (string) $this->_sComment;
    }

    /**
     * Set PresidentLogComment selector's 'comment' property. 
     *
     * @param string $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        $this->_sComment = (string) $a_sComment;
        $this->setSearchParameter('comment', $this->_sComment);
    }

}
