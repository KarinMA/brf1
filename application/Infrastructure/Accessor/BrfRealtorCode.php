<?php

/**
 * Database accessor class for BrfRealtorCode. 
 *
 * @see Accessor 
 * @see BrfRealtorCode
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfRealtorCode extends Accessor
{


    /**
     * Get BrfRealtorCodes by 'realtor_user_id' property. 
     *
     * @param int $a_iRealtorUserId
     * @return Collection
     */
    function getBrfRealtorCodesByRealtorUserId($a_iRealtorUserId)
    {
        $oBrfRealtorCodeSelector = getBrfRealtorCodeSelector();
        $oBrfRealtorCodeSelector->setRealtorUserId($a_iRealtorUserId);
        $oBrfRealtorCodeCollection = $this->read($oBrfRealtorCodeSelector);
        return $oBrfRealtorCodeCollection;

    }

    /**
     * Get BrfRealtorCodes by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfRealtorCodesByBrfId($a_iBrfId)
    {
        $oBrfRealtorCodeSelector = getBrfRealtorCodeSelector();
        $oBrfRealtorCodeSelector->setBrfId($a_iBrfId);
        $oBrfRealtorCodeCollection = $this->read($oBrfRealtorCodeSelector);
        return $oBrfRealtorCodeCollection;

    }

    /**
     * Get BrfRealtorCodes by 'realtor_code' property. 
     *
     * @param string $a_sRealtorCode
     * @return Collection
     */
    function getBrfRealtorCodesByRealtorCode($a_sRealtorCode)
    {
        $oBrfRealtorCodeSelector = getBrfRealtorCodeSelector();
        $oBrfRealtorCodeSelector->setRealtorCode($a_sRealtorCode);
        $oBrfRealtorCodeCollection = $this->read($oBrfRealtorCodeSelector);
        return $oBrfRealtorCodeCollection;

    }

    /**
     * Get BrfRealtorCodes by 'created_on' property. 
     *
     * @param string $a_sCreatedOn
     * @return Collection
     */
    function getBrfRealtorCodesByCreatedOn($a_sCreatedOn)
    {
        $oBrfRealtorCodeSelector = getBrfRealtorCodeSelector();
        $oBrfRealtorCodeSelector->setCreatedOn($a_sCreatedOn);
        $oBrfRealtorCodeCollection = $this->read($oBrfRealtorCodeSelector);
        return $oBrfRealtorCodeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_realtor_code', 'BrfRealtorCode', new SelectionFactory_BrfRealtorCode(), new DomainFactory_BrfRealtorCodeFactory(), new UpdateFactory_BrfRealtorCode(), array(
            array('brf', array('linked_object', 'brf_id', 'setBrf')), // gets product with product id
            array('user', array('linked_object', 'realtor_user_id', 'setRealtorUser')), // gets product with product id
        ));
    }




}
