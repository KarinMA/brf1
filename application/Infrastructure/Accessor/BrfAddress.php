<?php

/**
 * Database accessor class for BrfAddress. 
 *
 * @see Accessor 
 * @see BrfAddress
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfAddress extends Accessor
{


    /**
     * Get BrfAddresss by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfAddresssByBrfId($a_iBrfId)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setBrfId($a_iBrfId);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'address' property. 
     *
     * @param string $a_sAddress
     * @return Collection
     */
    function getBrfAddresssByAddress($a_sAddress)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setAddress($a_sAddress);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'street_number' property. 
     *
     * @param string $a_sStreetNumber
     * @return Collection
     */
    function getBrfAddresssByStreetNumber($a_sStreetNumber)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setStreetNumber($a_sStreetNumber);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'street_number2' property. 
     *
     * @param string $a_sStreetNumber2
     * @return Collection
     */
    function getBrfAddresssByStreetNumber2($a_sStreetNumber2)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setStreetNumber2($a_sStreetNumber2);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'zip' property. 
     *
     * @param int $a_iZip
     * @return Collection
     */
    function getBrfAddresssByZip($a_iZip)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setZip($a_iZip);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'postal_address' property. 
     *
     * @param string $a_sPostalAddress
     * @return Collection
     */
    function getBrfAddresssByPostalAddress($a_sPostalAddress)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setPostalAddress($a_sPostalAddress);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'even_numbers' property. 
     *
     * @param bool $a_bEvenNumbers
     * @return Collection
     */
    function getBrfAddresssByEvenNumbers($a_bEvenNumbers)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setEvenNumbers($a_bEvenNumbers);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Get BrfAddresss by 'odd_numbers' property. 
     *
     * @param bool $a_bOddNumbers
     * @return Collection
     */
    function getBrfAddresssByOddNumbers($a_bOddNumbers)
    {
        $oBrfAddressSelector = getBrfAddressSelector();
        $oBrfAddressSelector->setOddNumbers($a_bOddNumbers);
        $oBrfAddressCollection = $this->read($oBrfAddressSelector);
        return $oBrfAddressCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_address', 'BrfAddress', new SelectionFactory_BrfAddress(), new DomainFactory_BrfAddressFactory(), new UpdateFactory_BrfAddress(), array(
            //array(new Accessor_Product(), array('linked_object', 'product_id', 'setProduct')), // gets product with product id
            //array(new Accessor_State(), array('linked_object', 'state_id', 'setState')), // gets product with product id
            //array(new Accessor_OrderRow(), array('dependent_objects', 'order_id', 'getOrderId')), // gets order rows by order id
            //array(new Accessor_Order(), array('dependent_objects', 'customer_id', 'getCustomerId')), // gets orders customer id
            //array(new Accessor_ProductPackageVersionDefinition(), array('dependent_objects', 'product_package_version_id', 'getProductPackageVersionId')), // gets orders customer id
        ));
    }




}
