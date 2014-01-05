<?php

/**
 * Database accessor class for BrfPicture. 
 *
 * @see Accessor 
 * @see BrfPicture
 * @package JJIT_OrderSystem
 * @subpackage Database_Accessor
 */
class Accessor_BrfPicture extends Accessor
{


    /**
     * Get BrfPictures by 'brf_id' property. 
     *
     * @param int $a_iBrfId
     * @return Collection
     */
    function getBrfPicturesByBrfId($a_iBrfId)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setBrfId($a_iBrfId);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Get BrfPictures by 'front' property. 
     *
     * @param bool $a_bFront
     * @return Collection
     */
    function getBrfPicturesByFront($a_bFront)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setFront($a_bFront);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Get BrfPictures by 'title' property. 
     *
     * @param string $a_sTitle
     * @return Collection
     */
    function getBrfPicturesByTitle($a_sTitle)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setTitle($a_sTitle);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Get BrfPictures by 'description' property. 
     *
     * @param string $a_sDescription
     * @return Collection
     */
    function getBrfPicturesByDescription($a_sDescription)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setDescription($a_sDescription);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Get BrfPictures by 'has_picture' property. 
     *
     * @param bool $a_bHasPicture
     * @return Collection
     */
    function getBrfPicturesByHasPicture($a_bHasPicture)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setHasPicture($a_bHasPicture);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Get BrfPictures by 'image_type' property. 
     *
     * @param string $a_sImageType
     * @return Collection
     */
    function getBrfPicturesByImageType($a_sImageType)
    {
        $oBrfPictureSelector = getBrfPictureSelector();
        $oBrfPictureSelector->setImageType($a_sImageType);
        $oBrfPictureCollection = $this->read($oBrfPictureSelector);
        return $oBrfPictureCollection;

    }

    /**
     * Initialize's this accessor's domain object assembler.
     * 
     * @return DomainObjectAssembler
     */
    protected function _initializeDomainObjectAssembler()
    {
        return new DomainObjectAssembler(self::$_rDatabaseConnection, 'brf_picture', 'BrfPicture', new SelectionFactory_BrfPicture(), new DomainFactory_BrfPictureFactory(), new UpdateFactory_BrfPicture(), array(
            array('brf', array('linked_object', 'brf_id', 'setBrf')), // gets product with product id
        ));
    }




}
