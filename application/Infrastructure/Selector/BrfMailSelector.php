<?php

/**
 * Selector class for BrfMail. 
 *
 * @see BrfMail
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfMailSelector extends Selector 
{


    /**
     * BrfMail selector's 'from_user_id' property. 
     *
     * @var int
     */
    private $_iFromUserId;

    /**
     * BrfMail selector's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * BrfMail selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfMail selector's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;
    /**
     * Get BrfMail selector's 'from_user_id' property. 
     *
     * @return int
     */
    function getFromUserId()
    {
        return (int) $this->_iFromUserId;
    }

    /**
     * Set BrfMail selector's 'from_user_id' property. 
     *
     * @param int $a_iFromUserId
     * @return void
     */
    function setFromUserId($a_iFromUserId)
    {
        $this->_iFromUserId = (int) $a_iFromUserId;
        $this->setSearchParameter('from_user_id', $this->_iFromUserId);
    }

    /**
     * Get BrfMail selector's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set BrfMail selector's 'message' property. 
     *
     * @param string $a_sMessage
     * @return void
     */
    function setMessage($a_sMessage)
    {
        $this->_sMessage = (string) $a_sMessage;
        $this->setSearchParameter('message', $this->_sMessage);
    }

    /**
     * Get BrfMail selector's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfMail selector's 'header' property. 
     *
     * @param string $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        $this->_sHeader = (string) $a_sHeader;
        $this->setSearchParameter('header', $this->_sHeader);
    }

    /**
     * Get BrfMail selector's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return (string) $this->_sSentOn;
    }

    /**
     * Set BrfMail selector's 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return void
     */
    function setSentOn($a_sSentOn)
    {
        $this->_sSentOn = (string) $a_sSentOn;
        $this->setSearchParameter('sent_on', $this->_sSentOn);
    }

}
