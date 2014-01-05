<?php

/**
 * Domain object class for BrfFelanmalan. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfFelanmalan extends DomainObject 
{
    /**
     * BrfFelanmalan's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfFelanmalan's 'by_user_id' property. 
     *
     * @var int
     */
    private $_iByUserId;

    /**
     * BrfFelanmalan's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * BrfFelanmalan's 'message' property. 
     *
     * @var string
     */
    private $_sMessage;

    /**
     * BrfFelanmalan's 'sent_on' property. 
     *
     * @var string
     */
    private $_sSentOn;

    /**
     * Get BrfFelanmalan's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfFelanmalan's 'brf_id' property. 
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
     * Get BrfFelanmalan's 'by_user_id' property. 
     *
     * @return int
     */
    function getByUserId()
    {
        return (int) $this->_iByUserId;
    }

    /**
     * Set BrfFelanmalan's 'by_user_id' property. 
     *
     * @param int $a_iByUserId
     * @return void
     */
    function setByUserId($a_iByUserId)
    {
        if (!is_null($this->_iByUserId) && $this->_iByUserId !== (int) $a_iByUserId) {
            $this->_markModified();
        }
        $this->_iByUserId = (int) $a_iByUserId;
    }

    /**
     * The ByUser.
     * 
     * @var ByUser
     */
    private $_oByUser;

    /**
     * Get the ByUser.
     * 
     * @return ByUser
     */
    function getByUser()
    {
        return $this->_oByUser;
    }

    /**
     * Set the ByUser.
     * 
     * @param ByUser $a_oByUser
     * 
     * @return void
     */
    function setByUser($a_oByUser)
    {
        $this->_iByUserId = $a_oByUser->getId();
        $this->_oByUser = $a_oByUser;
    }

    /**
     * Get BrfFelanmalan's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set BrfFelanmalan's 'header' property. 
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
     * Get BrfFelanmalan's 'message' property. 
     *
     * @return string
     */
    function getMessage()
    {
        return (string) $this->_sMessage;
    }

    /**
     * Set BrfFelanmalan's 'message' property. 
     *
     * @param string $a_sMessage
     * @return void
     */
    function setMessage($a_sMessage)
    {
        if (!is_null($this->_sMessage) && $this->_sMessage !== (string) $a_sMessage) {
            $this->_markModified();
        }
        $this->_sMessage = (string) $a_sMessage;
    }

    /**
     * Get BrfFelanmalan's 'sent_on' property. 
     *
     * @return string
     */
    function getSentOn()
    {
        return strlen($this->_sSentOn) ? (string) $this->_sSentOn : NULL;
    }

    /**
     * Set BrfFelanmalan's 'sent_on' property. 
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



    public static function create($a_iBrfId, $a_iByUserId, $a_sHeader, $a_sMessage, $a_sSentOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_felanmalan')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_felanmalan')->write($oObject);
        }
        return $oObject;
    }

}
