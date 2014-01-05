<?php

/**
 * Domain object class for BrfRealtorCode. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfRealtorCode extends DomainObject 
{
    /**
     * BrfRealtorCode's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * BrfRealtorCode's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorCode's 'realtor_code' property. 
     *
     * @var string
     */
    private $_sRealtorCode;

    /**
     * BrfRealtorCode's 'created_on' property. 
     *
     * @var string
     */
    private $_sCreatedOn;

    /**
     * Get BrfRealtorCode's 'realtor_user_id' property. 
     *
     * @return int
     */
    function getRealtorUserId()
    {
        return (int) $this->_iRealtorUserId;
    }

    /**
     * Set BrfRealtorCode's 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        if (!is_null($this->_iRealtorUserId) && $this->_iRealtorUserId !== (int) $a_iRealtorUserId) {
            $this->_markModified();
        }
        $this->_iRealtorUserId = (int) $a_iRealtorUserId;
    }

    /**
     * The RealtorUser.
     * 
     * @var RealtorUser
     */
    private $_oRealtorUser;

    /**
     * Get the RealtorUser.
     * 
     * @return RealtorUser
     */
    function getRealtorUser()
    {
        return $this->_oRealtorUser;
    }

    /**
     * Set the RealtorUser.
     * 
     * @param RealtorUser $a_oRealtorUser
     * 
     * @return void
     */
    function setRealtorUser($a_oRealtorUser)
    {
        $this->_iRealtorUserId = $a_oRealtorUser->getId();
        $this->_oRealtorUser = $a_oRealtorUser;
    }

    /**
     * Get BrfRealtorCode's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorCode's 'brf_id' property. 
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
     * Get BrfRealtorCode's 'realtor_code' property. 
     *
     * @return string
     */
    function getRealtorCode()
    {
        return (string) $this->_sRealtorCode;
    }

    /**
     * Set BrfRealtorCode's 'realtor_code' property. 
     *
     * @param string $a_sRealtorCode
     * @return void
     */
    function setRealtorCode($a_sRealtorCode)
    {
        if (!is_null($this->_sRealtorCode) && $this->_sRealtorCode !== (string) $a_sRealtorCode) {
            $this->_markModified();
        }
        $this->_sRealtorCode = (string) $a_sRealtorCode;
    }

    /**
     * Get BrfRealtorCode's 'created_on' property. 
     *
     * @return string
     */
    function getCreatedOn()
    {
        return strlen($this->_sCreatedOn) ? (string) $this->_sCreatedOn : NULL;
    }

    /**
     * Set BrfRealtorCode's 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return void
     */
    function setCreatedOn($a_sCreatedOn)
    {
        if (!is_null($this->_sCreatedOn) && $this->_sCreatedOn !== (string) $a_sCreatedOn) {
            $this->_markModified();
        }
        $this->_sCreatedOn = (string) $a_sCreatedOn;
    }



    public static function create($a_iRealtorUserId, $a_iBrfId, $a_sRealtorCode, $a_sCreatedOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_code')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_realtor_code')->write($oObject);
        }
        return $oObject;
    }

}
