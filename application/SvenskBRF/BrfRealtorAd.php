<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BrfRealtorAd
 *
 * @author John Jansson
 */
class SvenskBRF_BrfRealtorAd extends SvenskBRF_HasPicture 
{
    /**
     * @var BrfRealtorAd
     */
    private $_oBrfRealtorAd;
    
    /**
     * @param int $a_iBrfRealtorAdId
     * @return SvenskBRF_BrfRealtorAd
     */
    public static function loadById($a_iBrfRealtorAdId)
    {
        return self::load(self::$_oBrfRealtorAdAccessor->getById($a_iBrfRealtorAdId));
    }
    
    /**
     * @param BrfRealtorAd $a_oBrfRealtorAd
     * @return SvenskBRF_BrfRealtorAd
     */
    public static function load(BrfRealtorAd $a_oBrfRealtorAd)
    {
        return new self($a_oBrfRealtorAd);
    }

    /**
     * @param BrfRealtorAd $a_oBrfPicture
     * @return SvenskBRF_BrfRealtorAd
     */
    private function __construct(BrfRealtorAd $a_oBrfRealtorAd)
    {
        $this->_oBrfRealtorAd = $a_oBrfRealtorAd;
    }
    
    /**
     * 
     * @return BrfRealtorAd
     */
    public function getDomainObject()
    {
        return $this->_oBrfRealtorAd;
    }
    
    /**
     * @return string
     */
    protected function _getImagePath() 
    {
        $oBrf = SvenskBRF_Brf::loadById($this->_oBrfRealtorAd->getBrfId());
        return SvenskBRF_Document::FILE_BASE_PATH . $oBrf->getUrl() . '/pictures/ad/' . $this->_oBrfRealtorAd->getId();
    }
    
    /**
     * @return Collection
     */
    public function getBrfRealtorAdTimeCollection($a_bTimeSensitive = FALSE)
    {
        $oCollection = new Collection;
        foreach ($this->_oBrfRealtorAd->getBrfRealtorAdTimeCollection() as $oBrfRealtorAdTime) {
            if (!$a_bTimeSensitive || date('Y-m-d H:i:s') < $oBrfRealtorAdTime->getStartTime()) {
                $oCollection->addObject($oBrfRealtorAdTime);
            }
        }
        return $oCollection;
    }
    
    /**
     * @return string
     */
    protected function _getPictureName() 
    {
        return "ad" . $this->_oBrfRealtorAd->getId() . '.' . $this->_oBrfRealtorAd->getImageType();
    }
    
    /**
     * @return bool
     */
    function hasPicture() 
    {
        return $this->_oBrfRealtorAd->getHasPicture();
    }
    
    /**
     * @param string $a_sMethod
     * @param array $a_aArgs
     * @return mixed
     */
    function __call($a_sMethod, array $a_aArgs = array()) 
    {
        if (method_exists($this->_oBrfRealtorAd, $a_sMethod)) {
            return call_user_func_array(array($this->_oBrfRealtorAd, $a_sMethod), $a_aArgs);
        } else {
            return NULL;
        }
    }
}

?>
