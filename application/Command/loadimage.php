<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadimage
 *
 * @author John Jansson
 */
class Command_loadimage extends Command
{
    protected function _executeCommand() 
    {
        $oBrfPicture = SvenskBRF_BrfPicture::loadById(preg_replace("/[^0-9]/", "", $this->_aRequest['imageId']));
        return array('imageData' => $oBrfPicture->getImageData());
    }
}

?>
