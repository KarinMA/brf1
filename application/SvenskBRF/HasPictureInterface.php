<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HasPictureInterface
 *
 * @author John Jansson
 */
interface SvenskBRF_HasPictureInterface 
{
    /**
     * 
     * @return string
     */
    public function getImageData();

    /**
     *
     * @return bool 
     */
    public function hasPicture();
    
    /**
     * 
     * @return void 
     */
    public function removePicture();
    
    /**
     *
     * @param array $a_aPictureData 
     */
    public function savePicture(array $a_aPictureData);
}

?>
