<?php

/**
 * Selector class for RealtorInformation. 
 *
 * @see RealtorInformation
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_RealtorInformationSelector extends Selector 
{


    /**
     * RealtorInformation selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * RealtorInformation selector's 'set_by' property. 
     *
     * @var int
     */
    private $_iSetBy;

    /**
     * RealtorInformation selector's 'realtor_information_type_id' property. 
     *
     * @var int
     */
    private $_iRealtorInformationTypeId;

    /**
     * RealtorInformation selector's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * RealtorInformation selector's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;
    /**
     * Get RealtorInformation selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set RealtorInformation selector's 'brf_id' property. 
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
     * Get RealtorInformation selector's 'set_by' property. 
     *
     * @return int|null
     */
    function getSetBy()
    {
        return is_null($this->_iSetBy) ? NULL : (int) $this->_iSetBy;
    }

    /**
     * Set RealtorInformation selector's 'set_by' property. 
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
     * Get RealtorInformation selector's 'realtor_information_type_id' property. 
     *
     * @return int
     */
    function getRealtorInformationTypeId()
    {
        return (int) $this->_iRealtorInformationTypeId;
    }

    /**
     * Set RealtorInformation selector's 'realtor_information_type_id' property. 
     *
     * @param int $a_iRealtorInformation selectorTypeId
     * @return void
     */
    function setRealtorInformationTypeId($a_iRealtorInformationTypeId)
    {
        $this->_iRealtorInformationTypeId = (int) $a_iRealtorInformationTypeId;
        $this->setSearchParameter('realtor_information_type_id', $this->_iRealtorInformationTypeId);
    }

    /**
     * Get RealtorInformation selector's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set RealtorInformation selector's 'value' property. 
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
     * Get RealtorInformation selector's 'comment' property. 
     *
     * @return string|null
     */
    function getComment()
    {
        return is_null($this->_sComment) ? NULL : (string) $this->_sComment;
    }

    /**
     * Set RealtorInformation selector's 'comment' property. 
     *
     * @param string|null $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        $this->_sComment = is_null($a_sComment) ? NULL : (string) $a_sComment;
        $this->setSearchParameter('comment', (string) $this->_sComment, is_null($this->_sComment) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

}
