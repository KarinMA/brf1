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
class SvenskBRF_User_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_User 
     */
    public function current() {
        return SvenskBRF_User::load($this->_oObjects->current());
    }
}

?>
