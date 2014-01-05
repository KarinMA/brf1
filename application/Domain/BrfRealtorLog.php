<?php

/**
 * Domain object class for BrfRealtorLog. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfRealtorLog extends DomainObject 
{
    /**
     * BrfRealtorLog's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorLog's 'user_id' property. 
     *
     * @var int
     */
    private $_iUserId;

    /**
     * BrfRealtorLog's 'realtor_message' property. 
     *
     * @var string
     */
    private $_sRealtorMessage;

    /**
     * BrfRealtorLog's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfRealtorLog's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Get BrfRealtorLog's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorLog's 'brf_id' property. 
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
     * Get BrfRealtorLog's 'user_id' property. 
     *
     * @return int
     */
    function getUserId()
    {
        return (int) $this->_iUserId;
    }

    /**
     * Set BrfRealtorLog's 'user_id' property. 
     *
     * @param int $a_iUserId
     * @return void
     */
    function setUserId($a_iUserId)
    {
        if (!is_null($this->_iUserId) && $this->_iUserId !== (int) $a_iUserId) {
            $this->_markModified();
        }
        $this->_iUserId = (int) $a_iUserId;
    }

    /**
     * The User.
     * 
     * @var User
     */
    private $_oUser;

    /**
     * Get the User.
     * 
     * @return User
     */
    function getUser()
    {
        return $this->_oUser;
    }

    /**
     * Set the User.
     * 
     * @param User $a_oUser
     * 
     * @return void
     */
    function setUser($a_oUser)
    {
        $this->_iUserId = $a_oUser->getId();
        $this->_oUser = $a_oUser;
    }

    /**
     * Get BrfRealtorLog's 'realtor_message' property. 
     *
     * @return string
     */
    function getRealtorMessage()
    {
        return (string) $this->_sRealtorMessage;
    }

    /**
     * Set BrfRealtorLog's 'realtor_message' property. 
     *
     * @param string $a_sRealtorMessage
     * @return void
     */
    function setRealtorMessage($a_sRealtorMessage)
    {
        if (!is_null($this->_sRealtorMessage) && $this->_sRealtorMessage !== (string) $a_sRealtorMessage) {
            $this->_markModified();
        }
        $this->_sRealtorMessage = (string) $a_sRealtorMessage;
    }

    /**
     * Get BrfRealtorLog's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfRealtorLog's 'header' property. 
     *
     * @param string $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        if (!is_null($this->_sHeader) && $this->_sHeader !== (string) $a_sHeader) {
            $this->_markModified();
        }
        $this->_sHeader = (string) $a_sHeader;
    }

    /**
     * Get BrfRealtorLog's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return strlen($this->_sSentOn) ? (string) $this->_sSentOn : NULL;
    }

    /**
     * Set BrfRealtorLog's 'sent_on' property. 
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



    public static function create($a_iBrfId, $a_iUserId, $a_sRealtorMessage, $a_sHeader, $a_sSentOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_log')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_realtor_log')->write($oObject);
        }
        return $oObject;
    }

}
