<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author John Jansson
 */
class SvenskBRF_BrfPicture_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_BrfPicture
     */
    public function current() {
        return SvenskBRF_BrfPicture::load($this->_oObjects->current());
    }
}

?>
