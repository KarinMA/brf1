<?php

/**
 * Selector class for RealtorInformationHistory. 
 *
 * @see RealtorInformationHistory
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_RealtorInformationHistorySelector extends Selector 
{


    /**
     * RealtorInformationHistory selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * RealtorInformationHistory selector's 'set_by' property. 
     *
     * @var int
     */
    private $_iSetBy;

    /**
     * RealtorInformationHistory selector's 'realtor_information_type_id' property. 
     *
     * @var int
     */
    private $_iRealtorInformationTypeId;

    /**
     * RealtorInformationHistory selector's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * RealtorInformationHistory selector's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;

    /**
     * RealtorInformationHistory selector's 'saved_on' property. 
     *
     * @var string
     */
    private $_sSavedOn;
    /**
     * Get RealtorInformationHistory selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set RealtorInformationHistory selector's 'brf_id' property. 
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
     * Get RealtorInformationHistory selector's 'set_by' property. 
     *
     * @return int|null
     */
    function getSetBy()
    {
        return is_null($this->_iSetBy) ? NULL : (int) $this->_iSetBy;
    }

    /**
     * Set RealtorInformationHistory selector's 'set_by' property. 
     *
     * @param int|null $a_iSetBy
     * @return void
     */
    function setSetBy($a_iSetBy)
    {
        $this->_iSetBy = is_null($a_iSetBy) ? NULL : (int) $a_iSetBy;
        $this->setSearchParameter('set_by', (int) $this->_iSetBy, is_null($this->_iSetBy) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get RealtorInformationHistory selector's 'realtor_information_type_id' property. 
     *
     * @return int
     */
    function getRealtorInformationTypeId()
    {
        return (int) $this->_iRealtorInformationTypeId;
    }

    /**
     * Set RealtorInformationHistory selector's 'realtor_information_type_id' property. 
     *
     * @param int $a_iRealtorInformationTypeId
     * @return void
     */
    function setRealtorInformationTypeId($a_iRealtorInformationTypeId)
    {
        $this->_iRealtorInformationTypeId = (int) $a_iRealtorInformationTypeId;
        $this->setSearchParameter('realtor_information_type_id', $this->_iRealtorInformationTypeId);
    }

    /**
     * Get RealtorInformationHistory selector's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set RealtorInformationHistory selector's 'value' property. 
     *
     * @param string $a_sValue
     * @return void
     */
    function setValue($a_sValue)
    {
        $this->_sValue = (string) $a_sValue;
        $this->setSearchParameter('value', $this->_sValue);
    }

    /**
     * Get RealtorInformationHistory selector's 'comment' property. 
     *
     * @return string|null
     */
    function getComment()
    {
        return is_null($this->_sComment) ? NULL : (string) $this->_sComment;
    }

    /**
     * Set RealtorInformationHistory selector's 'comment' property. 
     *
     * @param string|null $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        $this->_sComment = is_null($a_sComment) ? NULL : (string) $a_sComment;
        $this->setSearchParameter('comment', (string) $this->_sComment, is_null($this->_sComment) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get RealtorInformationHistory selector's 'saved_on' property. 
     *
     * @return string
     */
    function getSavedOn()
    {
        return (string) $this->_sSavedOn;
    }

    /**
     * Set RealtorInformationHistory selector's 'saved_on' property. 
     *
     * @param string $a_sSavedOn
     * @return void
     */
    function setSavedOn($a_sSavedOn)
    {
        $this->_sSavedOn = (string) $a_sSavedOn;
        $this->setSearchParameter('saved_on', $this->_sSavedOn);
    }

}
