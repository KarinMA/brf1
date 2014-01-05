<?php

/**
 * Database accessor class for WebformActivation. 
 *
 * @see Accessor 
 * @see WebformActivation
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_WebformActivation extends Accessor
{


    /**
     * Get WebformActivations by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getWebformActivationsByBrfId($a_iBrfId)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setBrfId($a_iBrfId);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'name' property. 
     *
     * @param string $a_sName
     * @return Collection
     */
    function getWebformActivationsByName($a_sName)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setName($a_sName);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'email' property. 
     *
     * @param string $a_sEmail
     * @return Collection
     */
    function getWebformActivationsByEmail($a_sEmail)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setEmail($a_sEmail);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'phone' property. 
     *
     * @param string $a_sPhone
     * @return Collection
     */
    function getWebformActivationsByPhone($a_sPhone)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setPhone($a_sPhone);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'role' property. 
     *
     * @param string $a_sRole
     * @return Collection
     */
    function getWebformActivationsByRole($a_sRole)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setRole($a_sRole);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'instructions_sent' property. 
     *
     * @param bool $a_bInstructionsSent
     * @return Collection
     */
    function getWebformActivationsByInstructionsSent($a_bInstructionsSent)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setInstructionsSent($a_bInstructionsSent);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Get WebformActivations by 'sent_on' property. 
     *
     * @param string $a_sSentOn
     * @return Collection
     */
    function getWebformActivationsBySentOn($a_sSentOn)
    {
        $oWebformActivationSelector = getWebformActivationSelector();
        $oWebformActivationSelector->setSentOn($a_sSentOn);
        $oWebformActivationCollection = $this->read($oWebformActivationSelector);
        return $oWebformActivationCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'webform_activation', 'WebformActivation', new SelectionFactory_WebformActivation(), new DomainFactory_WebformActivationFactory(), new UpdateFactory_WebformActivation(), array(
            array('brf', array('linked_object', 'brf_id', 'setBrf')), // gets product with product id
        ));
    }




}
