<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of RealtorInformation
 *
 * @author John Jansson
 */
class SvenskBRF_RealtorInformation extends SvenskBRF_Main
{
    /**
     * Fastigheten.
     * 
     * @var string
     */
    const REALTOR_CATEGORY_TYPE_PROPERTY = 1;
    
    /**
     *
     * @param type $a_sKey 
     * @return RealtorInformationType 
     */
    public static function getTypeByKeyName($a_sKey)
    {
        return self::$_oRealtorInformationTypeAccessor->getRealtorInformationTypeByTypeKey($a_sKey);
    }
    
    /**
     *
     * 
     * @param RealtorInformationCategory $a_oCategory 
     * @return bool
     */
    public static function hasAnyCategoryData(SvenskBRF_Brf $a_oBrf, RealtorInformationCategory $a_oCategory)
    {
        $oRealtorInformationTypes = self::$_oRealtorInformationTypeAccessor->getRealtorInformationTypesByRealtorInformationCategoryId($a_oCategory->getId());
        if ($oRealtorInformationTypes->size()) {
            self::$_oRealtorInformationSelector->setSearchParameter('realtor_information_type_id', $oRealtorInformationTypes->getKeys(), Selector::CONDITION_IN);
            self::$_oRealtorInformationSelector->setSearchParameter('brf_id', $a_oBrf->getId());
            $oRealtorInfoCollection = self::$_oRealtorInformationAccessor->read(self::$_oRealtorInformationSelector);
            return $oRealtorInfoCollection->size() > 0;
        } else {
            return FALSE;
        }
    }
    
    public static function getCategoryNameByCategoryKey($a_sKey)
    {
        $oRICategory = self::$_oRealtorInformationCategoryAccessor->getRealtorInformationCategoryByCategoryKey($a_sKey);
        return $oRICategory ? $oRICategory->getCategoryName() : '';
    }
    
    public static function save(SvenskBRF_Brf $a_oBrf, RealtorInformationType $a_oInformationType, $a_sValue, $a_sComment = NULL)
    {
        // save history...?
        self::$_oRealtorInformationHistorySelector->limit(1);
        self::$_oRealtorInformationHistorySelector->setOrderBy('saved_on DESC');
        self::$_oRealtorInformationHistorySelector->setBrfId($a_oBrf->getId());
        self::$_oRealtorInformationHistorySelector->setRealtorInformationTypeId($a_oInformationType->getId());
        $oRealtorInfoHistory = self::$_oRealtorInformationHistoryAccessor->readOne(self::$_oRealtorInformationHistorySelector);
        if (!$oRealtorInfoHistory || $oRealtorInfoHistory->getValue() != $a_sValue || $a_sComment != $oRealtorInfoHistory->getComment()) {
            RealtorInformationHistory::create($a_oBrf->getId(), getUser()->getId(), $a_oInformationType->getId(), $a_sValue, $a_sComment ? $a_sComment : NULL, date('Y-m-d H:i:s'));
            if (!$oRealtorInfoHistory) {
                RealtorInformation::create($a_oBrf->getId(), getUser()->getId(), $a_oInformationType->getId(), $a_sValue, $a_sComment ? $a_sComment : NULL);
            } else {
                self::$_oRealtorInformationSelector->limit(1);
                self::$_oRealtorInformationSelector->setBrfId($a_oBrf->getId());
                self::$_oRealtorInformationSelector->setRealtorInformationTypeId($a_oInformationType->getId());
                $oRealtorInfo = self::$_oRealtorInformationAccessor->readOne(self::$_oRealtorInformationSelector);
                $oRealtorInfo->setSetBy(getUser()->getId());
                $oRealtorInfo->setValue($a_sValue);
                $oRealtorInfo->setComment($a_sComment ? $a_sComment : NULL);
            }
        }
    }
    
    /**
     * 
     * @return array
     */
    public static function getRealtorInformationWithKeys(SvenskBRF_Brf $a_oBrf)
    {
        $oInformation = self::$_oRealtorInformationAccessor->getRealtorInformationsByBrfId($a_oBrf->getId());
        $aInformationArray = array();
        foreach ($oInformation as $oInfo) {
            $aInformationArray[$oInfo->getRealtorInformationType()->getTypeKey()] = $oInfo;
        }
        return $aInformationArray;
    }
    
    /**
     *
     * @return array
     */
    public static function getCategoryKeys()
    {
        $aCategories = array();
        foreach (self::$_oRealtorInformationCategoryAccessor->getAll() as $oCategory) {
            $aCategories[] = $oCategory->getCategoryKey();
        }
        return $aCategories;
    }
    
    /**
     *
     * @return Collection 
     */
    public static function getCategories()
    {
        return self::$_oRealtorInformationCategoryAccessor->getAll();
    }
    
    /**
     *
     * @var RealtorInformation
     */
    private $_oRealtorInformation;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oRealtorInformation, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     *
     * @param RealtorInformation $a_oRealtorInformation
     * @return SvenskBRF_RealtorInformation
     */
    public static function load(RealtorInformation $a_oRealtorInformation)
    {
        return new self($a_oRealtorInformation);
    }
    
    private function __construct(RealtorInformation $a_oRealtorInformation)
    {
        $this->_oRealtorInformation = $a_oRealtorInformation;
    }
    
}

?>
