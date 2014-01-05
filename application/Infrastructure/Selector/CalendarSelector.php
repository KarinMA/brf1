<?php

/**
 * Selector class for Calendar. 
 *
 * @see Calendar
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_CalendarSelector extends Selector 
{


    /**
     * Calendar selector's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Calendar selector's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * Calendar selector's 'text' property. 
     *
     * @var string
     */
    private $_sText;

    /**
     * Calendar selector's 'when' property. 
     *
     * @var string
     */
    private $_sWhen;

    /**
     * Calendar selector's 'ends' property. 
     *
     * @var string
     */
    private $_sEnds;

    /**
     * Calendar selector's 'is_board' property. 
     *
     * @var bool
     */
    private $_bIsBoard;
    /**
     * Get Calendar selector's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Calendar selector's 'brf_id' property. 
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
     * Get Calendar selector's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set Calendar selector's 'header' property. 
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
     * Get Calendar selector's 'text' property. 
     *
     * @return string
     */
    function getText()
    {
        return (string) $this->_sText;
    }

    /**
     * Set Calendar selector's 'text' property. 
     *
     * @param string $a_sText
     * @return void
     */
    function setText($a_sText)
    {
        $this->_sText = (string) $a_sText;
        $this->setSearchParameter('text', $this->_sText);
    }

    /**
     * Get Calendar selector's 'when' property. 
     *
     * @return string
     */
    function getWhen()
    {
        return (string) $this->_sWhen;
    }

    /**
     * Set Calendar selector's 'when' property. 
     *
     * @param string $a_sWhen
     * @return void
     */
    function setWhen($a_sWhen)
    {
        $this->_sWhen = (string) $a_sWhen;
        $this->setSearchParameter('when', $this->_sWhen);
    }

    /**
     * Get Calendar selector's 'ends' property. 
     *
     * @return string|null
     */
    function getEnds()
    {
        return is_null($this->_sEnds) ? NULL : (string) $this->_sEnds;
    }

    /**
     * Set Calendar selector's 'ends' property. 
     *
     * @param string|null $a_sEnds
     * @return void
     */
    function setEnds($a_sEnds)
    {
        $this->_sEnds = is_null($a_sEnds) ? NULL : (string) $a_sEnds;
        $this->setSearchParameter('ends', (string) $this->_sEnds, is_null($this->_sEnds) ? self::CONDITION_IS_NULL : self::CONDITION_EQUALS);
    }

    /**
     * Get Calendar selector's 'is_board' property. 
     *
     * @return bool
     */
    function getIsBoard()
    {
        return (bool) $this->_bIsBoard;
    }

    /**
     * Set Calendar selector's 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return void
     */
    function setIsBoard($a_bIsBoard)
    {
        $this->_bIsBoard = (bool) $a_bIsBoard;
        $this->setSearchParameter('is_board', $this->_bIsBoard);
    }

}
