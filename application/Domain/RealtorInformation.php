<?php

/**
 * Domain object class for RealtorInformation. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class RealtorInformation extends DomainObject 
{
    /**
     * RealtorInformation's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * RealtorInformation's 'set_by' property. 
     *
     * @var int
     */
    private $_iSetBy;

    /**
     * RealtorInformation's 'realtor_information_type_id' property. 
     *
     * @var int
     */
    private $_iRealtorInformationTypeId;

    /**
     * RealtorInformation's 'value' property. 
     *
     * @var string
     */
    private $_sValue;

    /**
     * RealtorInformation's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;

    /**
     * Get RealtorInformation's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set RealtorInformation's 'brf_id' property. 
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
     * Get RealtorInformation's 'set_by' property. 
     *
     * @return int|null
     */
    function getSetBy()
    {
        return is_null($this->_iSetBy) ? NULL : (int) $this->_iSetBy;
    }

    /**
     * Set RealtorInformation's 'set_by' property. 
     *
     * @param int|null $a_iSetBy
     * @return void
     */
    function setSetBy($a_iSetBy)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iSetBy) ? NULL : ((int) $a_iSetBy);
            if ($mCompareValue !== $this->_iSetBy) {
                $this->_markModified();
            }
        }
        $this->_iSetBy = is_null($a_iSetBy) ? NULL : (int) $a_iSetBy;
    }

    /**
     * The SetBy.
     * 
     * @var SetBy
     */
    private $_oSetBy;

    /**
     * Get the SetBy.
     * 
     * @return SetBy
     */
    function getSet()
    {
        return $this->_oSet;
    }

    /**
     * Set the SetBy.
     * 
     * @param Set $a_oSet
     * 
     * @return void
     */
    function setSet($a_oSet)
    {
        $this->_iSetBy = $a_oSet->getId();
        $this->_oSet = $a_oSet;
    }

    /**
     * Get RealtorInformation's 'realtor_information_type_id' property. 
     *
     * @return int
     */
    function getRealtorInformationTypeId()
    {
        return (int) $this->_iRealtorInformationTypeId;
    }

    /**
     * Set RealtorInformation's 'realtor_information_type_id' property. 
     *
     * @param int $a_iRealtorInformationTypeId
     * @return void
     */
    function setRealtorInformationTypeId($a_iRealtorInformationTypeId)
    {
        if (!is_null($this->_iRealtorInformationTypeId) && $this->_iRealtorInformationTypeId !== (int) $a_iRealtorInformationTypeId) {
            $this->_markModified();
        }
        $this->_iRealtorInformationTypeId = (int) $a_iRealtorInformationTypeId;
    }

    /**
     * The RealtorInformationType.
     * 
     * @var RealtorInformationType
     */
    private $_oRealtorInformationType;

    /**
     * Get the RealtorInformationType.
     * 
     * @return RealtorInformationType
     */
    function getRealtorInformationType()
    {
        return $this->_oRealtorInformationType;
    }

    /**
     * Set the RealtorInformationType.
     * 
     * @param RealtorInformationType $a_oRealtorInformationType
     * 
     * @return void
     */
    function setRealtorInformationType($a_oRealtorInformationType)
    {
        $this->_iRealtorInformationTypeId = $a_oRealtorInformationType->getId();
        $this->_oRealtorInformationType = $a_oRealtorInformationType;
    }

    /**
     * Get RealtorInformation's 'value' property. 
     *
     * @return string
     */
    function getValue()
    {
        return (string) $this->_sValue;
    }

    /**
     * Set RealtorInformation's 'value' property. 
     *
     * @param string $a_sValue
     * @return void
     */
    function setValue($a_sValue)
    {
        if (!is_null($this->_sValue) && $this->_sValue !== (string) $a_sValue) {
            $this->_markModified();
        }
        $this->_sValue = (string) $a_sValue;
    }

    /**
     * Get RealtorInformation's 'comment' property. 
     *
     * @return string|null
     */
    function getComment()
    {
        return is_null($this->_sComment) ? NULL : (string) $this->_sComment;
    }

    /**
     * Set RealtorInformation's 'comment' property. 
     *
     * @param string|null $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sComment) ? NULL : ((string) $a_sComment);
            if ($mCompareValue !== $this->_sComment) {
                $this->_markModified();
            }
        }
        $this->_sComment = is_null($a_sComment) ? NULL : (string) $a_sComment;
    }



    public static function create($a_iBrfId, $a_iSetBy, $a_iRealtorInformationTypeId, $a_sValue, $a_sComment, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('realtor_information')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('realtor_information')->write($oObject);
        }
        return $oObject;
    }

}
