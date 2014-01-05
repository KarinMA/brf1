<?php

/**
 * Domain object class for DocumentType. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class DocumentType extends DomainObject 
{
    /**
     * DocumentType's 'document_type_name' property. 
     *
     * @var string
     */
    private $_sDocumentTypeName;

    /**
     * DocumentType's 'directory_name' property. 
     *
     * @var string
     */
    private $_sDirectoryName;

    /**
     * DocumentType's 'has_year' property. 
     *
     * @var bool
     */
    private $_bHasYear;

    /**
     * DocumentType's 'is_archive' property. 
     *
     * @var bool
     */
    private $_bIsArchive;

    /**
     * Get DocumentType's 'document_type_name' property. 
     *
     * @return string
     */
    function getDocumentTypeName()
    {
        return (string) $this->_sDocumentTypeName;
    }

    /**
     * Set DocumentType's 'document_type_name' property. 
     *
     * @param string $a_sDocumentTypeName
     * @return void
     */
    function setDocumentTypeName($a_sDocumentTypeName)
    {
        if (!is_null($this->_sDocumentTypeName) && $this->_sDocumentTypeName !== (string) $a_sDocumentTypeName) {
            $this->_markModified();
        }
        $this->_sDocumentTypeName = (string) $a_sDocumentTypeName;
    }

    /**
     * Get DocumentType's 'directory_name' property. 
     *
     * @return string
     */
    function getDirectoryName()
    {
        return (string) $this->_sDirectoryName;
    }

    /**
     * Set DocumentType's 'directory_name' property. 
     *
     * @param string $a_sDirectoryName
     * @return void
     */
    function setDirectoryName($a_sDirectoryName)
    {
        if (!is_null($this->_sDirectoryName) && $this->_sDirectoryName !== (string) $a_sDirectoryName) {
            $this->_markModified();
        }
        $this->_sDirectoryName = (string) $a_sDirectoryName;
    }

    /**
     * Get DocumentType's 'has_year' property. 
     *
     * @return bool
     */
    function getHasYear()
    {
        return (bool) $this->_bHasYear;
    }

    /**
     * Set DocumentType's 'has_year' property. 
     *
     * @param bool $a_bHasYear
     * @return void
     */
    function setHasYear($a_bHasYear)
    {
        if (!is_null($this->_bHasYear) && $this->_bHasYear !== (bool) $a_bHasYear) {
            $this->_markModified();
        }
        $this->_bHasYear = (bool) $a_bHasYear;
    }

    /**
     * Get DocumentType's 'is_archive' property. 
     *
     * @return bool
     */
    function getIsArchive()
    {
        return (bool) $this->_bIsArchive;
    }

    /**
     * Set DocumentType's 'is_archive' property. 
     *
     * @param bool $a_bIsArchive
     * @return void
     */
    function setIsArchive($a_bIsArchive)
    {
        if (!is_null($this->_bIsArchive) && $this->_bIsArchive !== (bool) $a_bIsArchive) {
            $this->_markModified();
        }
        $this->_bIsArchive = (bool) $a_bIsArchive;
    }

    /**
     * This DocumentType's Document collection.
     * 
     * @var Collection
     */
    private $_oDocumentCollection;

    /**
     * Get Document collection.
     * 
     * @see Document
     * 
     * @return Collection
     */
    function getDocumentCollection()
    {
        if (!isset($this->_oDocumentCollection)) {
            $this->_oDocumentCollection = new Collection();
        }
        return $this->_oDocumentCollection;
    }



    public static function create($a_sDocumentTypeName, $a_sDirectoryName, $a_bHasYear, $a_bIsArchive, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('document_type')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('document_type')->write($oObject);
        }
        return $oObject;
    }

}
