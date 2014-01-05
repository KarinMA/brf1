<?php

/**
 * Selector class for BrfRealtorLog. 
 *
 * @see BrfRealtorLog
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfRealtorLogSelector extends Selector 
{


    /**
     * BrfRealtorLog selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorLog selector's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * BrfRealtorLog selector's 'realtor_message' property. 
     *
     * @var string
     */
    private $_sRealtorMessage;

    /**
     * BrfRealtorLog selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfRealtorLog selector's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;
    /**
     * Get BrfRealtorLog selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorLog selector's 'brf_id' property. 
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
     * Get BrfRealtorLog selector's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set BrfRealtorLog selector's 'user_id' property. 
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
     * Get BrfRealtorLog selector's 'realtor_message' property. 
     *
     * @return string
     */
    function getRealtorMessage()
    {
        return (string) $this->_sRealtorMessage;
    }

    /**
     * Set BrfRealtorLog selector's 'realtor_message' property. 
     *
     * @param string $a_sRealtorMessage
     * @return void
     */
    function setRealtorMessage($a_sRealtorMessage)
    {
        $this->_sRealtorMessage = (string) $a_sRealtorMessage;
        $this->setSearchParameter('realtor_message', $this->_sRealtorMessage);
    }

    /**
     * Get BrfRealtorLog selector's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfRealtorLog selector's 'header' property. 
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
     * Get BrfRealtorLog selector's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return (string) $this->_sSentOn;
    }

    /**
     * Set BrfRealtorLog selector's 'sent_on' property. 
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
