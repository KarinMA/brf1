<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of Message
 *
 * @author John Jansson
 */
class SvenskBRF_ExternalPartner extends SvenskBRF_HasPicture
{
    /**
     *
     * @var int 
     */
    const PARTNER_TYPE_REALTOR = 1;
    
    /**
     *
     * @var ExternalPartner
     */
    private $_oExternalPartner;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oExternalPartner, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     *
     * @param Message $a_oExternalPartner
     * @return SvenskBRF_ExternalPartner
     */
    public static function load(ExternalPartner $a_oExternalPartner)
    {
        return new self($a_oExternalPartner);
    }
    
    private function __construct(ExternalPartner $a_oExternalPartner)
    {
        $this->_oExternalPartner = $a_oExternalPartner;
    }
    
    public function getPartnerTypeName()
    {
        return $this->_oExternalPartner->getExternalPartnerType()->getTypeName();
    }
    
    public function _getImagePath() 
    {
        $sImageUrl = './../files/externalpartnerpictures/' . $this->_oExternalPartner->getId();
        return $sImageUrl;
    }
    
    public function hasPicture() 
    {
        return $this->_oExternalPartner->getHasPicture();
    }
    
    protected function _getPictureName()
    {
        return $this->_oExternalPartner->getPartnerName();
    }
  
    /**
     * 
     * @return SvenskBRF_ExternalPartner_Collection
     */
    public static function getRealtors()
    {
        return new SvenskBRF_ExternalPartner_Collection(self::$_oExternalPartnerAccessor->getExternalPartnersByExternalPartnerTypeId(self::PARTNER_TYPE_REALTOR));
    }
  
}

?>
