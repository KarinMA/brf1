<?php

/**
 * Database accessor class for Startpage. 
 *
 * @see Accessor 
 * @see Startpage
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_Startpage extends Accessor
{


    /**
     * Get Startpage by 'name' property. 
     *
     * @param string $a_sName
     * @return Collection
     */
    function getStartpageByName($a_sName)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setName($a_sName);
        return $this->readOne($oStartpageSelector);

    }

    /**
     * Get Startpages by 'description' property. 
     *
     * @param string $a_sDescription
     * @return Collection
     */
    function getStartpagesByDescription($a_sDescription)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setDescription($a_sDescription);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Get Startpages by 'content' property. 
     *
     * @param string $a_sContent
     * @return Collection
     */
    function getStartpagesByContent($a_sContent)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setContent($a_sContent);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Get Startpages by 'edited_by' property. 
     *
     * @param int $a_iEditedBy
     * @return Collection
     */
    function getStartpagesByEditedBy($a_iEditedBy)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setEditedBy($a_iEditedBy);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Get Startpages by 'edited_at' property. 
     *
     * @param string $a_sEditedAt
     * @return Collection
     */
    function getStartpagesByEditedAt($a_sEditedAt)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setEditedAt($a_sEditedAt);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Get Startpages by 'content_type' property. 
     *
     * @param string $a_sContentType
     * @return Collection
     */
    function getStartpagesByContentType($a_sContentType)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setContentType($a_sContentType);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Get Startpages by 'category' property. 
     *
     * @param string $a_sCategory
     * @return Collection
     */
    function getStartpagesByCategory($a_sCategory)
    {
        $oStartpageSelector = getStartpageSelector();
        $oStartpageSelector->setCategory($a_sCategory);
        $oStartpageCollection = $this->read($oStartpageSelector);
        return $oStartpageCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'startpage', 'Startpage', new SelectionFactory_Startpage(), new DomainFactory_StartpageFactory(), new UpdateFactory_Startpage(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
