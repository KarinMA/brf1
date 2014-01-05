<?php

/**
 * Selector class for MessageRead. 
 *
 * @see MessageRead
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_MessageReadSelector extends Selector 
{


    /**
     * MessageRead selector's 'message_id' property. 
     *
     * @var int
     */
    private $_iMessageId;

    /**
     * MessageRead selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * MessageRead selector's 'read_on' property. 
     *
     * @var string
     */
    private $_sReadOn;
    /**
     * Get MessageRead selector's 'message_id' property. 
     *
     * @return int
     */
    function getMessageId()
    {
        return (int) $this->_iMessageId;
    }

    /**
     * Set MessageRead selector's 'message_id' property. 
     *
     * @param int $a_iMessageId
     * @return void
     */
    function setMessageId($a_iMessageId)
    {
        $this->_iMessageId = (int) $a_iMessageId;
        $this->setSearchParameter('message_id', $this->_iMessageId);
    }

    /**
     * Get MessageRead selector's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set MessageRead selector's 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        $this->_iUserId = (int) $a_iUserId;
        $this->setSearchParameter('user_id', $this->_iUserId);
    }

    /**
     * Get MessageRead selector's 'read_on' property. 
     *
     * @return string
     */
    function getReadOn()
    {
        return (string) $this->_sReadOn;
    }

    /**
     * Set MessageRead selector's 'read_on' property. 
     *
     * @param string $a_sReadOn
     * @return void
     */
    function setReadOn($a_sReadOn)
    {
        $this->_sReadOn = (string) $a_sReadOn;
        $this->setSearchParameter('read_on', $this->_sReadOn);
    }

}
