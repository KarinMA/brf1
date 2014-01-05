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
class SvenskBRF_BrfRealtorAd_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_BrfRealtorAd
     */
    public function current() {
        return SvenskBRF_BrfRealtorAd::load($this->_oObjects->current());
    }
}

?>
