<?php

/**
 * Selector class for WebformActivation. 
 *
 * @see WebformActivation
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_WebformActivationSelector extends Selector 
{


    /**
     * WebformActivation selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * WebformActivation selector's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * WebformActivation selector's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * WebformActivation selector's 'phone' property. 
     *
     * @var string
     */
    private $_sPhone;

    /**
     * WebformActivation selector's 'role' property. 
     *
     * @var string
     */
    private $_sRole;

    /**
     * WebformActivation selector's 'instructions_sent' property. 
     *
     * @var bool
     */
    private $_bInstructionsSent;

    /**
     * WebformActivation selector's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;
    /**
     * Get WebformActivation selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set WebformActivation selector's 'brf_id' property. 
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
     * Get WebformActivation selector's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set WebformActivation selector's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        $this->_sName = (string) $a_sName;
        $this->setSearchParameter('name', $this->_sName);
    }

    /**
     * Get WebformActivation selector's 'email' property. 
     *
     * @return string
     */
    function getEmail()
    {
        return (string) $this->_sEmail;
    }

    /**
     * Set WebformActivation selector's 'email' property. 
     *
     * @param string $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        $this->_sEmail = (string) $a_sEmail;
        $this->setSearchParameter('email', $this->_sEmail);
    }

    /**
     * Get WebformActivation selector's 'phone' property. 
     *
     * @return string
     */
    function getPhone()
    {
        return (string) $this->_sPhone;
    }

    /**
     * Set WebformActivation selector's 'phone' property. 
     *
     * @param string $a_sPhone
     * @return void
     */
    function setPhone($a_sPhone)
    {
        $this->_sPhone = (string) $a_sPhone;
        $this->setSearchParameter('phone', $this->_sPhone);
    }

    /**
     * Get WebformActivation selector's 'role' property. 
     *
     * @return string
     */
    function getRole()
    {
        return (string) $this->_sRole;
    }

    /**
     * Set WebformActivation selector's 'role' property. 
     *
     * @param string $a_sRole
     * @return void
     */
    function setRole($a_sRole)
    {
        $this->_sRole = (string) $a_sRole;
        $this->setSearchParameter('role', $this->_sRole);
    }

    /**
     * Get WebformActivation selector's 'instructions_sent' property. 
     *
     * @return bool
     */
    function getInstructionsSent()
    {
        return (bool) $this->_bInstructionsSent;
    }

    /**
     * Set WebformActivation selector's 'instructions_sent' property. 
     *
     * @param bool $a_bInstructionsSent
     * @return void
     */
    function setInstructionsSent($a_bInstructionsSent)
    {
        $this->_bInstructionsSent = (bool) $a_bInstructionsSent;
        $this->setSearchParameter('instructions_sent', $this->_bInstructionsSent);
    }

    /**
     * Get WebformActivation selector's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return (string) $this->_sSentOn;
    }

    /**
     * Set WebformActivation selector's 'sent_on' property. 
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
