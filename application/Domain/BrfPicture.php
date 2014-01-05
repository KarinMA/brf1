<?php

/**
 * Domain object class for BrfPicture. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class BrfPicture extends DomainObject 
{
    /**
     * BrfPicture's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * BrfPicture's 'front' property. 
     *
     * @var bool
     */
    private $_bFront;

    /**
     * BrfPicture's 'title' property. 
     *
     * @var string
     */
    private $_sTitle;

    /**
     * BrfPicture's 'description' property. 
     *
     * @var string
     */
    private $_sDescription;

    /**
     * BrfPicture's 'has_picture' property. 
     *
     * @var bool
     */
    private $_bHasPicture;

    /**
     * BrfPicture's 'image_type' property. 
     *
     * @var string
     */
    private $_sImageType;

    /**
     * Get BrfPicture's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set BrfPicture's 'brf_id' property. 
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
     * Get BrfPicture's 'front' property. 
     *
     * @return bool
     */
    function getFront()
    {
        return (bool) $this->_bFront;
    }

    /**
     * Set BrfPicture's 'front' property. 
     *
     * @param bool $a_bFront
     * @return void
     */
    function setFront($a_bFront)
    {
        if (!is_null($this->_bFront) && $this->_bFront !== (bool) $a_bFront) {
            $this->_markModified();
        }
        $this->_bFront = (bool) $a_bFront;
    }

    /**
     * Get BrfPicture's 'title' property. 
     *
     * @return string
     */
    function getTitle()
    {
        return (string) $this->_sTitle;
    }

    /**
     * Set BrfPicture's 'title' property. 
     *
     * @param string $a_sTitle
     * @return void
     */
    function setTitle($a_sTitle)
    {
        if (!is_null($this->_sTitle) && $this->_sTitle !== (string) $a_sTitle) {
            $this->_markModified();
        }
        $this->_sTitle = (string) $a_sTitle;
    }

    /**
     * Get BrfPicture's 'description' property. 
     *
     * @return string
     */
    function getDescription()
    {
        return (string) $this->_sDescription;
    }

    /**
     * Set BrfPicture's 'description' property. 
     *
     * @param string $a_sDescription
     * @return void
     */
    function setDescription($a_sDescription)
    {
        if (!is_null($this->_sDescription) && $this->_sDescription !== (string) $a_sDescription) {
            $this->_markModified();
        }
        $this->_sDescription = (string) $a_sDescription;
    }

    /**
     * Get BrfPicture's 'has_picture' property. 
     *
     * @return bool
     */
    function getHasPicture()
    {
        return (bool) $this->_bHasPicture;
    }

    /**
     * Set BrfPicture's 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return void
     */
    function setHasPicture($a_bHasPicture)
    {
        if (!is_null($this->_bHasPicture) && $this->_bHasPicture !== (bool) $a_bHasPicture) {
            $this->_markModified();
        }
        $this->_bHasPicture = (bool) $a_bHasPicture;
    }

    /**
     * Get BrfPicture's 'image_type' property. 
     *
     * @return string
     */
    function getImageType()
    {
        return (string) $this->_sImageType;
    }

    /**
     * Set BrfPicture's 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return void
     */
    function setImageType($a_sImageType)
    {
        if (!is_null($this->_sImageType) && $this->_sImageType !== (string) $a_sImageType) {
            $this->_markModified();
        }
        $this->_sImageType = (string) $a_sImageType;
    }



    public static function create($a_iBrfId, $a_bFront, $a_sTitle, $a_sDescription, $a_bHasPicture, $a_sImageType, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('brf_picture')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('brf_picture')->write($oObject);
        }
        return $oObject;
    }

}
