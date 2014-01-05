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
class SvenskBRF_ExternalPartner_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_ExternalPartner
     */
    public function current() {
        return SvenskBRF_ExternalPartner::load($this->_oObjects->current());
    }
}

?>
