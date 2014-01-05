<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of BrfPicture
 *
 * @author John Jansson
 */
class SvenskBRF_BrfPicture extends SvenskBRF_HasPicture
{
    /**
     *
     * @var BrfPicture
     */
    private $_oBrfPicture;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oBrfPicture, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     *
     * @param BrfPicture $a_oBrfPicture
     * @return SvenskBRF_BrfPicture
     */
    public static function load(BrfPicture $a_oBrfPicture)
    {
        return new self($a_oBrfPicture);
    }
    
    /**
     *
     *
     * @param int $a_iBrfPictureId
     * @return SvenskBRF_BrfPicture
     */
    public static function loadById($a_iBrfPictureId)
    {
        return self::load(self::$_oBrfPictureAccessor->getById($a_iBrfPictureId));
    }
    
    private function __construct(BrfPicture $a_oBrfPicture)
    {
        $this->_oBrfPicture = $a_oBrfPicture;
    }
    
    public function hasPicture()
    {
        return $this->_oBrfPicture->getHasPicture();
    }
   
    protected function _getPictureName()
    {
        return $this->_oBrfPicture->getTitle();
    }
    
    protected function _getImagePath()
    {
        return './../files/brfs/' . $this->_oBrfPicture->getBrf()->getUrl() . '/pictures/brf/' . $this->_oBrfPicture->getId();
    }

    public function getPicturePath()
    {
        return $this->_getImagePath() . '.' . $this->_oBrfPicture->getImageType();
    }
    
    /**
     * Deletes a BRF picture.
     *
     * @return void 
     */
    function delete()
    {
        $sFilePath = './../files/brfs/' . $this->_oBrfPicture->getBrf()->getUrl() . '/pictures/brf/' . $this->_oBrfPicture->getId();
        if ($sFilePath) {
            @unlink($sFilePath);
        }
        $this->_oBrfPicture->delete();
    }
}

?>
