<?php

/**
 * Domain object class for WebformActivation. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class WebformActivation extends DomainObject 
{
    /**
     * WebformActivation's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * WebformActivation's 'name' property. 
     *
     * @var string
     */
    private $_sName;

    /**
     * WebformActivation's 'email' property. 
     *
     * @var string
     */
    private $_sEmail;

    /**
     * WebformActivation's 'phone' property. 
     *
     * @var string
     */
    private $_sPhone;

    /**
     * WebformActivation's 'role' property. 
     *
     * @var string
     */
    private $_sRole;

    /**
     * WebformActivation's 'instructions_sent' property. 
     *
     * @var bool
     */
    private $_bInstructionsSent;

    /**
     * WebformActivation's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Get WebformActivation's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set WebformActivation's 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return void
     */
    function setBrfId($a_iBrfId)
    {
        if (!is_null($this->_iBrfId) && $this->_iBrfId !== (int) $a_iBrfId) {
            $this->_markModified();
        }
        $this->_iBrfId = (int) $a_iBrfId;
    }

    /**
     * The Brf.
     * 
     * @var Brf
     */
    private $_oBrf;

    /**
     * Get the Brf.
     * 
     * @return Brf
     */
    function getBrf()
    {
        return $this->_oBrf;
    }

    /**
     * Set the Brf.
     * 
     * @param Brf $a_oBrf
     * 
     * @return void
     */
    function setBrf($a_oBrf)
    {
        $this->_iBrfId = $a_oBrf->getId();
        $this->_oBrf = $a_oBrf;
    }

    /**
     * Get WebformActivation's 'name' property. 
     *
     * @return string
     */
    function getName()
    {
        return (string) $this->_sName;
    }

    /**
     * Set WebformActivation's 'name' property. 
     *
     * @param string $a_sName
     * @return void
     */
    function setName($a_sName)
    {
        if (!is_null($this->_sName) && $this->_sName !== (string) $a_sName) {
            $this->_markModified();
        }
        $this->_sName = (string) $a_sName;
    }

    /**
     * Get WebformActivation's 'email' property. 
     *
     * @return string
     */
    function getEmail()
    {
        return (string) $this->_sEmail;
    }

    /**
     * Set WebformActivation's 'email' property. 
     *
     * @param string $a_sEmail
     * @return void
     */
    function setEmail($a_sEmail)
    {
        if (!is_null($this->_sEmail) && $this->_sEmail !== (string) $a_sEmail) {
            $this->_markModified();
        }
        $this->_sEmail = (string) $a_sEmail;
    }

    /**
     * Get WebformActivation's 'phone' property. 
     *
     * @return string
     */
    function getPhone()
    {
        return (string) $this->_sPhone;
    }

    /**
     * Set WebformActivation's 'phone' property. 
     *
     * @param string $a_sPhone
     * @return void
     */
    function setPhone($a_sPhone)
    {
        if (!is_null($this->_sPhone) && $this->_sPhone !== (string) $a_sPhone) {
            $this->_markModified();
        }
        $this->_sPhone = (string) $a_sPhone;
    }

    /**
     * Get WebformActivation's 'role' property. 
     *
     * @return string
     */
    function getRole()
    {
        return (string) $this->_sRole;
    }

    /**
     * Set WebformActivation's 'role' property. 
     *
     * @param string $a_sRole
     * @return void
     */
    function setRole($a_sRole)
    {
        if (!is_null($this->_sRole) && $this->_sRole !== (string) $a_sRole) {
            $this->_markModified();
        }
        $this->_sRole = (string) $a_sRole;
    }

    /**
     * Get WebformActivation's 'instructions_sent' property. 
     *
     * @return bool
     */
    function getInstructionsSent()
    {
        return (bool) $this->_bInstructionsSent;
    }

    /**
     * Set WebformActivation's 'instructions_sent' property. 
     *
     * @param bool $a_bInstructionsSent
     * @return void
     */
    function setInstructionsSent($a_bInstructionsSent)
    {
        if (!is_null($this->_bInstructionsSent) && $this->_bInstructionsSent !== (bool) $a_bInstructionsSent) {
            $this->_markModified();
        }
        $this->_bInstructionsSent = (bool) $a_bInstructionsSent;
    }

    /**
     * Get WebformActivation's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return strlen($this->_sSentOn) ? (string) $this->_sSentOn : NULL;
    }

    /**
     * Set WebformActivation's 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return void
     */
    function setSentOn($a_sSentOn)
    {
        if (!is_null($this->_sSentOn) && $this->_sSentOn !== (string) $a_sSentOn) {
            $this->_markModified();
        }
        $this->_sSentOn = (string) $a_sSentOn;
    }



    public static function create($a_iBrfId, $a_sName, $a_sEmail, $a_sPhone, $a_sRole, $a_bInstructionsSent, $a_sSentOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('webform_activation')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('webform_activation')->write($oObject);
        }
        return $oObject;
    }

}
