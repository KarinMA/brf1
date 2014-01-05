<?php

/**
 * Database accessor class for RealtorInformationType. 
 *
 * @see Accessor 
 * @see RealtorInformationType
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_RealtorInformationType extends Accessor
{


    /**
     * Get RealtorInformationTypes by 'realtor_information_category_id' property. 
     *
     * @param int $a_iRealtorInformationCategoryId
     * @return Collection
     */
    function getRealtorInformationTypesByRealtorInformationCategoryId($a_iRealtorInformationCategoryId)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setRealtorInformationCategoryId($a_iRealtorInformationCategoryId);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationType by 'type_key' property. 
     *
     * @param string $a_sTypeKey
     * @return Collection
     */
    function getRealtorInformationTypeByTypeKey($a_sTypeKey)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setTypeKey($a_sTypeKey);
        return $this->readOne($oRealtorInformationTypeSelector);

    }

    /**
     * Get RealtorInformationTypes by 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return Collection
     */
    function getRealtorInformationTypesByTypeName($a_sTypeName)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setTypeName($a_sTypeName);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationTypes by 'type_name_public' property. 
     *
     * @param string $a_sTypeNamePublic
     * @return Collection
     */
    function getRealtorInformationTypesByTypeNamePublic($a_sTypeNamePublic)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setTypeNamePublic($a_sTypeNamePublic);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationTypes by 'comment_public' property. 
     *
     * @param string $a_sCommentPublic
     * @return Collection
     */
    function getRealtorInformationTypesByCommentPublic($a_sCommentPublic)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setCommentPublic($a_sCommentPublic);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationTypes by 'required' property. 
     *
     * @param bool $a_bRequired
     * @return Collection
     */
    function getRealtorInformationTypesByRequired($a_bRequired)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setRequired($a_bRequired);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationTypes by 'comment_required_yes' property. 
     *
     * @param bool $a_bCommentRequiredYes
     * @return Collection
     */
    function getRealtorInformationTypesByCommentRequiredYes($a_bCommentRequiredYes)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setCommentRequiredYes($a_bCommentRequiredYes);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Get RealtorInformationTypes by 'comment_required_no' property. 
     *
     * @param bool $a_bCommentRequiredNo
     * @return Collection
     */
    function getRealtorInformationTypesByCommentRequiredNo($a_bCommentRequiredNo)
    {
        $oRealtorInformationTypeSelector = getRealtorInformationTypeSelector();
        $oRealtorInformationTypeSelector->setCommentRequiredNo($a_bCommentRequiredNo);
        $oRealtorInformationTypeCollection = $this->read($oRealtorInformationTypeSelector);
        return $oRealtorInformationTypeCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'realtor_information_type', 'RealtorInformationType', new SelectionFactory_RealtorInformationType(), new DomainFactory_RealtorInformationTypeFactory(), new UpdateFactory_RealtorInformationType(), array(
            array('realtor_information_category', array('linked_object', 'realtor_information_category_id', 'setRealtorInformationCategory')), // gets product with product id
        ));
    }




}
