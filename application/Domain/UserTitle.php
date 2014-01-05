<?php

/**
 * Domain object class for UserTitle. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class UserTitle extends DomainObject 
{
    /**
     * UserTitle's 'title_name' property. 
     *
     * @var string
     */
    private $_sTitleName;

    /**
     * Get UserTitle's 'title_name' property. 
     *
     * @return string
     */
    function getTitleName()
    {
        return (string) $this->_sTitleName;
    }

    /**
     * Set UserTitle's 'title_name' property. 
     *
     * @param string $a_sTitleName
     * @return void
     */
    function setTitleName($a_sTitleName)
    {
        if (!is_null($this->_sTitleName) && $this->_sTitleName !== (string) $a_sTitleName) {
            $this->_markModified();
        }
        $this->_sTitleName = (string) $a_sTitleName;
    }

    /**
     * This UserTitle's User collection.
     * 
     * @var Collection
     */
    private $_oUserCollection;

    /**
     * Get User collection.
     * 
     * @see User
     * 
     * @return Collection
     */
    function getUserCollection()
    {
        if (!isset($this->_oUserCollection)) {
            $this->_oUserCollection = new Collection();
        }
        return $this->_oUserCollection;
    }



    public static function create($a_sTitleName, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('user_title')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('user_title')->write($oObject);
        }
        return $oObject;
    }

}
