<?php

/**
 * Domain object class for NoticeType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class NoticeType extends DomainObject 
{
    /**
     * NoticeType's 'notice_type' property. 
     *
     * @var string
     */
    private $_sNoticeType;

    /**
     * Get NoticeType's 'notice_type' property. 
     *
     * @return string
     */
    function getNoticeType()
    {
        return (string) $this->_sNoticeType;
    }

    /**
     * Set NoticeType's 'notice_type' property. 
     *
     * @param string $a_sNoticeType
     * @return void
     */
    function setNoticeType($a_sNoticeType)
    {
        if (!is_null($this->_sNoticeType) && $this->_sNoticeType !== (string) $a_sNoticeType) {
            $this->_markModified();
        }
        $this->_sNoticeType = (string) $a_sNoticeType;
    }

    /**
     * This NoticeType's Notice collection.
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



    public static function create($a_sNoticeType, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('notice_type')->write($oObject);
        }
        return $oObject;
    }

}
