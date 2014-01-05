<?php

/**
 * Domain object class for Calendar. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class Calendar extends DomainObject 
{
    /**
     * Calendar's 'brf_id' property. 
     *
     * @var int
     */
    private $_iBrfId;

    /**
     * Calendar's 'header' property. 
     *
     * @var string
     */
    private $_sHeader;

    /**
     * Calendar's 'text' property. 
     *
     * @var string
     */
    private $_sText;

    /**
     * Calendar's 'when' property. 
     *
     * @var string
     */
    private $_sWhen;

    /**
     * Calendar's 'ends' property. 
     *
     * @var string
     */
    private $_sEnds;

    /**
     * Calendar's 'is_board' property. 
     *
     * @var bool
     */
    private $_bIsBoard;

    /**
     * Get Calendar's 'brf_id' property. 
     *
     * @return int
     */
    function getBrfId()
    {
        return (int) $this->_iBrfId;
    }

    /**
     * Set Calendar's 'brf_id' property. 
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
     * Get Calendar's 'header' property. 
     *
     * @return string
     */
    function getHeader()
    {
        return (string) $this->_sHeader;
    }

    /**
     * Set Calendar's 'header' property. 
     *
     * @param string $a_sHeader
     * @return void
     */
    function setHeader($a_sHeader)
    {
        if (!is_null($this->_sHeader) && $this->_sHeader !== (string) $a_sHeader) {
            $this->_markModified();
        }
        $this->_sHeader = (string) $a_sHeader;
    }

    /**
     * Get Calendar's 'text' property. 
     *
     * @return string
     */
    function getText()
    {
        return (string) $this->_sText;
    }

    /**
     * Set Calendar's 'text' property. 
     *
     * @param string $a_sText
     * @return void
     */
    function setText($a_sText)
    {
        if (!is_null($this->_sText) && $this->_sText !== (string) $a_sText) {
            $this->_markModified();
        }
        $this->_sText = (string) $a_sText;
    }

    /**
     * Get Calendar's 'when' property. 
     *
     * @return string
     */
    function getWhen()
    {
        return strlen($this->_sWhen) ? (string) $this->_sWhen : NULL;
    }

    /**
     * Set Calendar's 'when' property. 
     *
     * @param string $a_sWhen
     * @return void
     */
    function setWhen($a_sWhen)
    {
        if (!is_null($this->_sWhen) && $this->_sWhen !== (string) $a_sWhen) {
            $this->_markModified();
        }
        $this->_sWhen = (string) $a_sWhen;
    }

    /**
     * Get Calendar's 'ends' property. 
     *
     * @return string|null
     */
    function getEnds()
    {
        return is_null($this->_sEnds) ? NULL : (string) $this->_sEnds;
    }

    /**
     * Set Calendar's 'ends' property. 
     *
     * @param string|null $a_sEnds
     * @return void
     */
    function setEnds($a_sEnds)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sEnds) ? NULL : ((string) $a_sEnds);
            if ($mCompareValue !== $this->_sEnds) {
                $this->_markModified();
            }
        }
        $this->_sEnds = is_null($a_sEnds) ? NULL : (string) $a_sEnds;
    }

    /**
     * Get Calendar's 'is_board' property. 
     *
     * @return bool
     */
    function getIsBoard()
    {
        return (bool) $this->_bIsBoard;
    }

    /**
     * Set Calendar's 'is_board' property. 
     *
     * @param bool $a_bIsBoard
     * @return void
     */
    function setIsBoard($a_bIsBoard)
    {
        if (!is_null($this->_bIsBoard) && $this->_bIsBoard !== (bool) $a_bIsBoard) {
            $this->_markModified();
        }
        $this->_bIsBoard = (bool) $a_bIsBoard;
    }

    /**
     * This Calendar's Notice collection.
     * 
     * @var Collection
     */
    private $_oNoticeCollection;

    /**
     * Get Notice collection.
     * 
     * @see Notice
     * 
     * @return Collection
     */
    function getNoticeCollection()
    {
        if (!isset($this->_oNoticeCollection)) {
            $this->_oNoticeCollection = new Collection();
        }
        return $this->_oNoticeCollection;
    }



    public static function create($a_iBrfId, $a_sHeader, $a_sText, $a_sWhen, $a_sEnds, $a_bIsBoard, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('calendar')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('calendar')->write($oObject);
        }
        return $oObject;
    }

}
