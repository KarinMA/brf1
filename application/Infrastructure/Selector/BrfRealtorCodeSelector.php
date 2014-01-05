<?php

/**
 * Selector class for BrfRealtorCode. 
 *
 * @see BrfRealtorCode
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfRealtorCodeSelector extends Selector 
{


    /**
     * BrfRealtorCode selector's 'realtor_user_id' property. 
     *
     * @var int
     */
    private $_iRealtorUserId;

    /**
     * BrfRealtorCode selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfRealtorCode selector's 'realtor_code' property. 
     *
     * @var string
     */
    private $_sRealtorCode;

    /**
     * BrfRealtorCode selector's 'created_on' property. 
     *
     * @var string
     */
    private $_sCreatedOn;
    /**
     * Get BrfRealtorCode selector's 'realtor_user_id' property. 
     *
     * @return int
     */
    function getRealtorUserId()
    {
        return (int) $this->_iRealtorUserId;
    }

    /**
     * Set BrfRealtorCode selector's 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return void
     */
    function setRealtorUserId($a_iRealtorUserId)
    {
        $this->_iRealtorUserId = (int) $a_iRealtorUserId;
        $this->setSearchParameter('realtor_user_id', $this->_iRealtorUserId);
    }

    /**
     * Get BrfRealtorCode selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfRealtorCode selector's 'brf_id' property. 
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
     * Get BrfRealtorCode selector's 'realtor_code' property. 
     *
     * @return string
     */
    function getRealtorCode()
    {
        return (string) $this->_sRealtorCode;
    }

    /**
     * Set BrfRealtorCode selector's 'realtor_code' property. 
     *
     * @param string $a_sRealtorCode
     * @return void
     */
    function setRealtorCode($a_sRealtorCode)
    {
        $this->_sRealtorCode = (string) $a_sRealtorCode;
        $this->setSearchParameter('realtor_code', $this->_sRealtorCode);
    }

    /**
     * Get BrfRealtorCode selector's 'created_on' property. 
     *
     * @return string
     */
    function getCreatedOn()
    {
        return (string) $this->_sCreatedOn;
    }

    /**
     * Set BrfRealtorCode selector's 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return void
     */
    function setCreatedOn($a_sCreatedOn)
    {
        $this->_sCreatedOn = (string) $a_sCreatedOn;
        $this->setSearchParameter('created_on', $this->_sCreatedOn);
    }

}
