<?php

/**
 * Selector class for BrfRealtorAdTime. 
 *
 * @see BrfRealtorAdTime
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_BrfRealtorAdTimeSelector extends Selector 
{


    /**
     * BrfRealtorAdTime selector's 'brf_realtor_ad_id' property. 
     *
     * @var int
     */
    private $_iBrfRealtorAdId;

    /**
     * BrfRealtorAdTime selector's 'start_time' property. 
     *
     * @var string
     */
    private $_sStartTime;

    /**
     * BrfRealtorAdTime selector's 'duration_minutes' property. 
     *
     * @var int
     */
    private $_iDurationMinutes;
    /**
     * Get BrfRealtorAdTime selector's 'brf_realtor_ad_id' property. 
     *
     * @return int
     */
    function getBrfRealtorAdId()
    {
        return (int) $this->_iBrfRealtorAdId;
    }

    /**
     * Set BrfRealtorAdTime selector's 'brf_realtor_ad_id' property. 
     *
     * @param int $a_iBrfRealtorAdId
     * @return void
     */
    function setBrfRealtorAdId($a_iBrfRealtorAdId)
    {
        $this->_iBrfRealtorAdId = (int) $a_iBrfRealtorAdId;
        $this->setSearchParameter('brf_realtor_ad_id', $this->_iBrfRealtorAdId);
    }

    /**
     * Get BrfRealtorAdTime selector's 'start_time' property. 
     *
     * @return string
     */
    function getStartTime()
    {
        return (string) $this->_sStartTime;
    }

    /**
     * Set BrfRealtorAdTime selector's 'start_time' property. 
     *
     * @param string $a_sStartTime
     * @return void
     */
    function setStartTime($a_sStartTime)
    {
        $this->_sStartTime = (string) $a_sStartTime;
        $this->setSearchParameter('start_time', $this->_sStartTime);
    }

    /**
     * Get BrfRealtorAdTime selector's 'duration_minutes' property. 
     *
     * @return int
     */
    function getDurationMinutes()
    {
        return (int) $this->_iDurationMinutes;
    }

    /**
     * Set BrfRealtorAdTime selector's 'duration_minutes' property. 
     *
     * @param int $a_iDurationMinutes
     * @return void
     */
    function setDurationMinutes($a_iDurationMinutes)
    {
        $this->_iDurationMinutes = (int) $a_iDurationMinutes;
        $this->setSearchParameter('duration_minutes', $this->_iDurationMinutes);
    }

}
