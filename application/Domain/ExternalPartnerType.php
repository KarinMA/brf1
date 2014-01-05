<?php

/**
 * Domain object class for ExternalPartnerType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class ExternalPartnerType extends DomainObject 
{
    /**
     * ExternalPartnerType's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;

    /**
     * Get ExternalPartnerType's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set ExternalPartnerType's 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return void
     */
    function setTypeName($a_sTypeName)
    {
        if (!is_null($this->_sTypeName) && $this->_sTypeName !== (string) $a_sTypeName) {
            $this->_markModified();
        }
        $this->_sTypeName = (string) $a_sTypeName;
    }

    /**
     * This ExternalPartnerType's ExternalPartner collection.
     * 
     * @var Collection
     */
    private $_oExternalPartnerCollection;

    /**
     * Get ExternalPartner collection.
     * 
     * @see ExternalPartner
     * 
     * @return Collection
     */
    function getExternalPartnerCollection()
    {
        if (!isset($this->_oExternalPartnerCollection)) {
            $this->_oExternalPartnerCollection = new Collection();
        }
        return $this->_oExternalPartnerCollection;
    }



    public static function create($a_sTypeName, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('external_partner_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('external_partner_type')->write($oObject);
        }
        return $oObject;
    }

}
