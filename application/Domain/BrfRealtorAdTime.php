<?php

/**
 * Domain object class for BrfRealtorAdTime. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfRealtorAdTime extends DomainObject 
{
    /**
     * BrfRealtorAdTime's 'brf_realtor_ad_id' property. 
     *
     * @var int
     */
    private $_iBrfRealtorAdId;

    /**
     * BrfRealtorAdTime's 'start_time' property. 
     *
     * @var string
     */
    private $_sStartTime;

    /**
     * BrfRealtorAdTime's 'duration_minutes' property. 
     *
     * @var int
     */
    private $_iDurationMinutes;

    /**
     * Get BrfRealtorAdTime's 'brf_realtor_ad_id' property. 
     *
     * @return int
     */
    function getBrfRealtorAdId()
    {
        return (int) $this->_iBrfRealtorAdId;
    }

    /**
     * Set BrfRealtorAdTime's 'brf_realtor_ad_id' property. 
     *
     * @param int $a_iBrfRealtorAdId
     * @return void
     */
    function setBrfRealtorAdId($a_iBrfRealtorAdId)
    {
        if (!is_null($this->_iBrfRealtorAdId) && $this->_iBrfRealtorAdId !== (int) $a_iBrfRealtorAdId) {
            $this->_markModified();
        }
        $this->_iBrfRealtorAdId = (int) $a_iBrfRealtorAdId;
    }

    /**
     * The BrfRealtorAd.
     * 
     * @var BrfRealtorAd
     */
    private $_oBrfRealtorAd;

    /**
     * Get the BrfRealtorAd.
     * 
     * @return BrfRealtorAd
     */
    function getBrfRealtorAd()
    {
        return $this->_oBrfRealtorAd;
    }

    /**
     * Set the BrfRealtorAd.
     * 
     * @param BrfRealtorAd $a_oBrfRealtorAd
     * 
     * @return void
     */
    function setBrfRealtorAd($a_oBrfRealtorAd)
    {
        $this->_iBrfRealtorAdId = $a_oBrfRealtorAd->getId();
        $this->_oBrfRealtorAd = $a_oBrfRealtorAd;
    }

    /**
     * Get BrfRealtorAdTime's 'start_time' property. 
     *
     * @return string
     */
    function getStartTime()
    {
        return strlen($this->_sStartTime) ? (string) $this->_sStartTime : NULL;
    }

    /**
     * Set BrfRealtorAdTime's 'start_time' property. 
     *
     * @param string $a_sStartTime
     * @return void
     */
    function setStartTime($a_sStartTime)
    {
        if (!is_null($this->_sStartTime) && $this->_sStartTime !== (string) $a_sStartTime) {
            $this->_markModified();
        }
        $this->_sStartTime = (string) $a_sStartTime;
    }

    /**
     * Get BrfRealtorAdTime's 'duration_minutes' property. 
     *
     * @return int
     */
    function getDurationMinutes()
    {
        return (int) $this->_iDurationMinutes;
    }

    /**
     * Set BrfRealtorAdTime's 'duration_minutes' property. 
     *
     * @param int $a_iDurationMinutes
     * @return void
     */
    function setDurationMinutes($a_iDurationMinutes)
    {
        if (!is_null($this->_iDurationMinutes) && $this->_iDurationMinutes !== (int) $a_iDurationMinutes) {
            $this->_markModified();
        }
        $this->_iDurationMinutes = (int) $a_iDurationMinutes;
    }



    public static function create($a_iBrfRealtorAdId, $a_sStartTime, $a_iDurationMinutes, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_realtor_ad_time')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_realtor_ad_time')->write($oObject);
        }
        return $oObject;
    }

}
