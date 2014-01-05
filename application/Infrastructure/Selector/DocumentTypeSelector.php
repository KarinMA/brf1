<?php

/**
 * Selector class for DocumentType. 
 *
 * @see DocumentType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_DocumentTypeSelector extends Selector 
{


    /**
     * DocumentType selector's 'document_type_name' property. 
     *
     * @var string
     */
    private $_sDocumentTypeName;

    /**
     * DocumentType selector's 'directory_name' property. 
     *
     * @var string
     */
    private $_sDirectoryName;

    /**
     * DocumentType selector's 'has_year' property. 
     *
     * @var bool
     */
    private $_bHasYear;

    /**
     * DocumentType selector's 'is_archive' property. 
     *
     * @var bool
     */
    private $_bIsArchive;
    /**
     * Get DocumentType selector's 'document_type_name' property. 
     *
     * @return string
     */
    function getDocumentTypeName()
    {
        return (string) $this->_sDocumentTypeName;
    }

    /**
     * Set DocumentType selector's 'document_type_name' property. 
     *
     * @param string $a_sDocumentType selectorName
     * @return void
     */
    function setDocumentTypeName($a_sDocumentTypeName)
    {
        $this->_sDocumentTypeName = (string) $a_sDocumentTypeName;
        $this->setSearchParameter('document_type_name', $this->_sDocumentTypeName);
    }

    /**
     * Get DocumentType selector's 'directory_name' property. 
     *
     * @return string
     */
    function getDirectoryName()
    {
        return (string) $this->_sDirectoryName;
    }

    /**
     * Set DocumentType selector's 'directory_name' property. 
     *
     * @param string $a_sDirectoryName
     * @return void
     */
    function setDirectoryName($a_sDirectoryName)
    {
        $this->_sDirectoryName = (string) $a_sDirectoryName;
        $this->setSearchParameter('directory_name', $this->_sDirectoryName);
    }

    /**
     * Get DocumentType selector's 'has_year' property. 
     *
     * @return bool
     */
    function getHasYear()
    {
        return (bool) $this->_bHasYear;
    }

    /**
     * Set DocumentType selector's 'has_year' property. 
     *
     * @param bool $a_bHasYear
     * @return void
     */
    function setHasYear($a_bHasYear)
    {
        $this->_bHasYear = (bool) $a_bHasYear;
        $this->setSearchParameter('has_year', $this->_bHasYear);
    }

    /**
     * Get DocumentType selector's 'is_archive' property. 
     *
     * @return bool
     */
    function getIsArchive()
    {
        return (bool) $this->_bIsArchive;
    }

    /**
     * Set DocumentType selector's 'is_archive' property. 
     *
     * @param bool $a_bIsArchive
     * @return void
     */
    function setIsArchive($a_bIsArchive)
    {
        $this->_bIsArchive = (bool) $a_bIsArchive;
        $this->setSearchParameter('is_archive', $this->_bIsArchive);
    }

}
