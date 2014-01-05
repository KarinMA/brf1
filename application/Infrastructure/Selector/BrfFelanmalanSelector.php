<?php

/**
 * Selector class for BrfFelanmalan. 
 *
 * @see BrfFelanmalan
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfFelanmalanSelector extends Selector 
{


    /**
     * BrfFelanmalan selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfFelanmalan selector's 'by_user_id' property. 
     *
     * @var int
     */
    private $_iByUserId;

    /**
     * BrfFelanmalan selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfFelanmalan selector's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * BrfFelanmalan selector's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;
    /**
     * Get BrfFelanmalan selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfFelanmalan selector's 'brf_id' property. 
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
     * Get BrfFelanmalan selector's 'by_user_id' property. 
     *
     * @return int
     */
    function getByUserId()
    {
        return (int) $this->_iByUserId;
    }

    /**
     * Set BrfFelanmalan selector's 'by_user_id' property. 
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
     * Get BrfFelanmalan selector's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfFelanmalan selector's 'header' property. 
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
     * Get BrfFelanmalan selector's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set BrfFelanmalan selector's 'message' property. 
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
     * Get BrfFelanmalan selector's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return (string) $this->_sSentOn;
    }

    /**
     * Set BrfFelanmalan selector's 'sent_on' property. 
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
