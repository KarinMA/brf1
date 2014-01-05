<?php

/**
 * Database accessor class for RealtorInformation. 
 *
 * @see Accessor 
 * @see RealtorInformation
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_RealtorInformation extends Accessor
{


    /**
     * Get RealtorInformations by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getRealtorInformationsByBrfId($a_iBrfId)
    {
        $oRealtorInformationSelector = getRealtorInformationSelector();
        $oRealtorInformationSelector->setBrfId($a_iBrfId);
        $oRealtorInformationCollection = $this->read($oRealtorInformationSelector);
        return $oRealtorInformationCollection;

    }

    /**
     * Get RealtorInformations by 'set_by' property. 
     *
     * @param int $a_iSetBy
     * @return Collection
     */
    function getRealtorInformationsBySetBy($a_iSetBy)
    {
        $oRealtorInformationSelector = getRealtorInformationSelector();
        $oRealtorInformationSelector->setSetBy($a_iSetBy);
        $oRealtorInformationCollection = $this->read($oRealtorInformationSelector);
        return $oRealtorInformationCollection;

    }

    /**
     * Get RealtorInformations by 'realtor_information_type_id' property. 
     *
     * @param int $a_iRealtorInformationTypeId
     * @return Collection
     */
    function getRealtorInformationsByRealtorInformationTypeId($a_iRealtorInformationTypeId)
    {
        $oRealtorInformationSelector = getRealtorInformationSelector();
        $oRealtorInformationSelector->setRealtorInformationTypeId($a_iRealtorInformationTypeId);
        $oRealtorInformationCollection = $this->read($oRealtorInformationSelector);
        return $oRealtorInformationCollection;

    }

    /**
     * Get RealtorInformations by 'value' property. 
     *
     * @param string $a_sValue
     * @return Collection
     */
    function getRealtorInformationsByValue($a_sValue)
    {
        $oRealtorInformationSelector = getRealtorInformationSelector();
        $oRealtorInformationSelector->setValue($a_sValue);
        $oRealtorInformationCollection = $this->read($oRealtorInformationSelector);
        return $oRealtorInformationCollection;

    }

    /**
     * Get RealtorInformations by 'comment' property. 
     *
     * @param string $a_sComment
     * @return Collection
     */
    function getRealtorInformationsByComment($a_sComment)
    {
        $oRealtorInformationSelector = getRealtorInformationSelector();
        $oRealtorInformationSelector->setComment($a_sComment);
        $oRealtorInformationCollection = $this->read($oRealtorInformationSelector);
        return $oRealtorInformationCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'realtor_information', 'RealtorInformation', new SelectionFactory_RealtorInformation(), new DomainFactory_RealtorInformationFactory(), new UpdateFactory_RealtorInformation(), array(
            array('realtor_information_type', array('linked_object', 'realtor_information_type_id', 'setRealtorInformationType')), // gets product with product id
        ));
    }




}
