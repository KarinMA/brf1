<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of removepicture
 *
 * @author John Jansson
 */
class Command_removepicture extends Command {
    //put your code here
    protected function _executeCommand()
    {
        $oBrfPicture = SvenskBRF_BrfPicture::load(getBrfPictureAccessor()->getById($this->_aRequest['id']));
        if ($oBrfPicture) {
            $oBrfPicture->delete();
        } else {
            throw new CommandException("picture not found");
        }
    }
}

?>
