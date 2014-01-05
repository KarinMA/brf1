<?php

/**
 * Selector class for ResourceDay. 
 *
 * @see ResourceDay
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ResourceDaySelector extends Selector 
{


    /**
     * ResourceDay selector's 'resource_id' property. 
     *
     * @var int
     */
    private $_iResourceId;

    /**
     * ResourceDay selector's 'day' property. 
     *
     * @var int
     */
    private $_iDay;
    /**
     * Get ResourceDay selector's 'resource_id' property. 
     *
     * @return int
     */
    function getResourceId()
    {
        return (int) $this->_iResourceId;
    }

    /**
     * Set ResourceDay selector's 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return void
     */
    function setResourceId($a_iResourceId)
    {
        $this->_iResourceId = (int) $a_iResourceId;
        $this->setSearchParameter('resource_id', $this->_iResourceId);
    }

    /**
     * Get ResourceDay selector's 'day' property. 
     *
     * @return int
     */
    function getDay()
    {
        return (int) $this->_iDay;
    }

    /**
     * Set ResourceDay selector's 'day' property. 
     *
     * @param int $a_iDay
     * @return void
     */
    function setDay($a_iDay)
    {
        $this->_iDay = (int) $a_iDay;
        $this->setSearchParameter('day', $this->_iDay);
    }

}
