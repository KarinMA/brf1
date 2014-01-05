<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SvenskBRF_HasPicture
 *
 * @author John Jansson
 */
abstract class SvenskBRF_HasPicture extends SvenskBRF_Main implements SvenskBRF_HasPictureInterface 
{
    /**
     *
     * @return string
     */
    public function getImageData() 
    {
        $sImageUrl = $this->_getImagePath() . '.' . $this->getImageType();
        $sBase64 = base64_encode(file_get_contents($sImageUrl)); 
        return 'data:image/' . str_replace(' ', '', switchCharacters($this->_getPictureName())) . '.'.$this->getImageType() . ';base64,' . $sBase64;
    }
    
    function removePicture()
    {
        @unlink($this->_getImagePath() . '.' . $this->getImageType());
        $this->setHasPicture(FALSE);
        $this->setImageType(NULL);
    }
    
    /**
     *
     * @param array $a_aPictureData
     * @return boolean 
     */
    function savePicture(array $a_aPictureData)
    {
        if (!$a_aPictureData) {
            return FALSE;
        }
        if ($a_aPictureData['error'] == UPLOAD_ERR_OK && in_array($a_aPictureData['type'], array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
            if (preg_match("/image\/([a-z]{3})/", str_replace("image/jpeg", "image/jpg", $a_aPictureData['type']), $aMatches) && count($aMatches) == 2) {
                $sPicturePath = $this->_getImagePath() . '.' . $aMatches[1];
                if (move_uploaded_file(@$a_aPictureData['tmp_name'], $sPicturePath) || copy($a_aPictureData['tmp_name'], $sPicturePath)) {
                    $this->setHasPicture(TRUE);
                    $this->setImageType($aMatches[1]);
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
    
    /**
     *
     * 
     * @param string $a_sPath 
     * @param array $a_aPictureData
     * @return string
     */
    public static function getImageDataFromFile($a_sPath) 
    {
        if ($a_sPath) {
            $sBase64 = base64_encode(file_get_contents($a_sPath)); 
            $iDotPos = strrpos($a_sPath, ".");
            $sExtension = "";
            if ($iDotPos) {
                $sExtension = substr($a_sPath, $iDotPos + 1);
                $sExtension = strtolower($sExtension);
            }
            return 'data:image/' . 'picture'.rand(1,1000) . '.'. $sExtension . ';base64,' . $sBase64;
        }
        return NULL;
    }
    
 
    
    /**
     *
     * @return string 
     */
    protected abstract function _getImagePath();
    
    /**
     *
     * @return string 
     */
    protected abstract function _getPictureName();
}

?>
