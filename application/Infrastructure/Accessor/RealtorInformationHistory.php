<?php

/**
 * Database accessor class for RealtorInformationHistory. 
 *
 * @see Accessor 
 * @see RealtorInformationHistory
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_RealtorInformationHistory extends Accessor
{


    /**
     * Get RealtorInformationHistorys by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getRealtorInformationHistorysByBrfId($a_iBrfId)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setBrfId($a_iBrfId);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Get RealtorInformationHistorys by 'set_by' property. 
     *
     * @param int $a_iSetBy
     * @return Collection
     */
    function getRealtorInformationHistorysBySetBy($a_iSetBy)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setSetBy($a_iSetBy);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Get RealtorInformationHistorys by 'realtor_information_type_id' property. 
     *
     * @param int $a_iRealtorInformationTypeId
     * @return Collection
     */
    function getRealtorInformationHistorysByRealtorInformationTypeId($a_iRealtorInformationTypeId)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setRealtorInformationTypeId($a_iRealtorInformationTypeId);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Get RealtorInformationHistorys by 'value' property. 
     *
     * @param string $a_sValue
     * @return Collection
     */
    function getRealtorInformationHistorysByValue($a_sValue)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setValue($a_sValue);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Get RealtorInformationHistorys by 'comment' property. 
     *
     * @param string $a_sComment
     * @return Collection
     */
    function getRealtorInformationHistorysByComment($a_sComment)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setComment($a_sComment);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Get RealtorInformationHistorys by 'saved_on' property. 
     *
     * @param string $a_sSavedOn
     * @return Collection
     */
    function getRealtorInformationHistorysBySavedOn($a_sSavedOn)
    {
        $oRealtorInformationHistorySelector = getRealtorInformationHistorySelector();
        $oRealtorInformationHistorySelector->setSavedOn($a_sSavedOn);
        $oRealtorInformationHistoryCollection = $this->read($oRealtorInformationHistorySelector);
        return $oRealtorInformationHistoryCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'realtor_information_history', 'RealtorInformationHistory', new SelectionFactory_RealtorInformationHistory(), new DomainFactory_RealtorInformationHistoryFactory(), new UpdateFactory_RealtorInformationHistory(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
