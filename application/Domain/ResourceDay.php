<?php

/**
 * Domain object class for ResourceDay. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class ResourceDay extends DomainObject 
{
    /**
     * ResourceDay's 'resource_id' property. 
     *
     * @var int
     */
    private $_iResourceId;

    /**
     * ResourceDay's 'day' property. 
     *
     * @var int
     */
    private $_iDay;

    /**
     * Get ResourceDay's 'resource_id' property. 
     *
     * @return int
     */
    function getResourceId()
    {
        return (int) $this->_iResourceId;
    }

    /**
     * Set ResourceDay's 'resource_id' property. 
     *
     * @param int $a_iResourceId
     * @return void
     */
    function setResourceId($a_iResourceId)
    {
        if (!is_null($this->_iResourceId) && $this->_iResourceId !== (int) $a_iResourceId) {
            $this->_markModified();
        }
        $this->_iResourceId = (int) $a_iResourceId;
    }

    /**
     * The Resource.
     * 
     * @var Resource
     */
    private $_oResource;

    /**
     * Get the Resource.
     * 
     * @return Resource
     */
    function getResource()
    {
        return $this->_oResource;
    }

    /**
     * Set the Resource.
     * 
     * @param Resource $a_oResource
     * 
     * @return void
     */
    function setResource($a_oResource)
    {
        $this->_iResourceId = $a_oResource->getId();
        $this->_oResource = $a_oResource;
    }

    /**
     * Get ResourceDay's 'day' property. 
     *
     * @return int
     */
    function getDay()
    {
        return (int) $this->_iDay;
    }

    /**
     * Set ResourceDay's 'day' property. 
     *
     * @param int $a_iDay
     * @return void
     */
    function setDay($a_iDay)
    {
        if (!is_null($this->_iDay) && $this->_iDay !== (int) $a_iDay) {
            $this->_markModified();
        }
        $this->_iDay = (int) $a_iDay;
    }



    public static function create($a_iResourceId, $a_iDay, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('resource_day')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('resource_day')->write($oObject);
        }
        return $oObject;
    }

}
