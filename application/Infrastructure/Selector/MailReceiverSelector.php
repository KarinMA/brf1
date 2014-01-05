<?php

/**
 * Selector class for MailReceiver. 
 *
 * @see MailReceiver
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_MailReceiverSelector extends Selector 
{


    /**
     * MailReceiver selector's 'mail_id' property. 
     *
     * @var int
     */
    private $_iMailId;

    /**
     * MailReceiver selector's 'is_read' property. 
     *
     * @var bool
     */
    private $_bIsRead;

    /**
     * MailReceiver selector's 'read_on' property. 
     *
     * @var string
     */
    private $_sReadOn;

    /**
     * MailReceiver selector's 'to_user_id' property. 
     *
     * @var int
     */
    private $_iToUserId;

    /**
     * MailReceiver selector's 'hidden' property. 
     *
     * @var bool
     */
    private $_bHidden;
    /**
     * Get MailReceiver selector's 'mail_id' property. 
     *
     * @return int
     */
    function getMailId()
    {
        return (int) $this->_iMailId;
    }

    /**
     * Set MailReceiver selector's 'mail_id' property. 
     *
     * @param int $a_iMailId
     * @return void
     */
    function setMailId($a_iMailId)
    {
        $this->_iMailId = (int) $a_iMailId;
        $this->setSearchParameter('mail_id', $this->_iMailId);
    }

    /**
     * Get MailReceiver selector's 'is_read' property. 
     *
     * @return bool
     */
    function getIsRead()
    {
        return (bool) $this->_bIsRead;
    }

    /**
     * Set MailReceiver selector's 'is_read' property. 
     *
     * @param bool $a_bIsRead
     * @return void
     */
    function setIsRead($a_bIsRead)
    {
        $this->_bIsRead = (bool) $a_bIsRead;
        $this->setSearchParameter('is_read', $this->_bIsRead);
    }

    /**
     * Get MailReceiver selector's 'read_on' property. 
     *
     * @return string|null
     */
    function getReadOn()
    {
        return is_null($this->_sReadOn) ? NULL : (string) $this->_sReadOn;
    }

    /**
     * Set MailReceiver selector's 'read_on' property. 
     *
     * @param string|null $a_sReadOn
     * @return void
     */
    function setReadOn($a_sReadOn)
    {
        $this->_sReadOn = is_null($a_sReadOn) ? NULL : (string) $a_sReadOn;
        $this->setSearchParameter('read_on', (string) $this->_sReadOn, is_null($this->_sReadOn) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get MailReceiver selector's 'to_user_id' property. 
     *
     * @return int
     */
    function getToUserId()
    {
        return (int) $this->_iToUserId;
    }

    /**
     * Set MailReceiver selector's 'to_user_id' property. 
     *
     * @param int $a_iToUserId
     * @return void
     */
    function setToUserId($a_iToUserId)
    {
        $this->_iToUserId = (int) $a_iToUserId;
        $this->setSearchParameter('to_user_id', $this->_iToUserId);
    }

    /**
     * Get MailReceiver selector's 'hidden' property. 
     *
     * @return bool
     */
    function getHidden()
    {
        return (bool) $this->_bHidden;
    }

    /**
     * Set MailReceiver selector's 'hidden' property. 
     *
     * @param bool $a_bHidden
     * @return void
     */
    function setHidden($a_bHidden)
    {
        $this->_bHidden = (bool) $a_bHidden;
        $this->setSearchParameter('hidden', $this->_bHidden);
    }

}
