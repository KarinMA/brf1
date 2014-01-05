<?php

/**
 * Database accessor class for DocumentType. 
 *
 * @see Accessor 
 * @see DocumentType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_DocumentType extends Accessor
{


    /**
     * Get DocumentTypes by 'document_type_name' property. 
     *
     * @param string $a_sDocumentTypeName
     * @return Collection
     */
    function getDocumentTypesByDocumentTypeName($a_sDocumentTypeName)
    {
        $oDocumentTypeSelector = getDocumentTypeSelector();
        $oDocumentTypeSelector->setDocumentTypeName($a_sDocumentTypeName);
        $oDocumentTypeCollection = $this->read($oDocumentTypeSelector);
        return $oDocumentTypeCollection;

    }

    /**
     * Get DocumentTypes by 'directory_name' property. 
     *
     * @param string $a_sDirectoryName
     * @return Collection
     */
    function getDocumentTypesByDirectoryName($a_sDirectoryName)
    {
        $oDocumentTypeSelector = getDocumentTypeSelector();
        $oDocumentTypeSelector->setDirectoryName($a_sDirectoryName);
        $oDocumentTypeCollection = $this->read($oDocumentTypeSelector);
        return $oDocumentTypeCollection;

    }

    /**
     * Get DocumentTypes by 'has_year' property. 
     *
     * @param bool $a_bHasYear
     * @return Collection
     */
    function getDocumentTypesByHasYear($a_bHasYear)
    {
        $oDocumentTypeSelector = getDocumentTypeSelector();
        $oDocumentTypeSelector->setHasYear($a_bHasYear);
        $oDocumentTypeCollection = $this->read($oDocumentTypeSelector);
        return $oDocumentTypeCollection;

    }

    /**
     * Get DocumentTypes by 'is_archive' property. 
     *
     * @param bool $a_bIsArchive
     * @return Collection
     */
    function getDocumentTypesByIsArchive($a_bIsArchive)
    {
        $oDocumentTypeSelector = getDocumentTypeSelector();
        $oDocumentTypeSelector->setIsArchive($a_bIsArchive);
        $oDocumentTypeCollection = $this->read($oDocumentTypeSelector);
        return $oDocumentTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'document_type', 'DocumentType', new SelectionFactory_DocumentType(), new DomainFactory_DocumentTypeFactory(), new UpdateFactory_DocumentType(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
