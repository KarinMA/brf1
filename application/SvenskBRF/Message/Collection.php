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
class SvenskBRF_Message_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_Message 
     */
    public function current() {
        return SvenskBRF_Message::load($this->_oObjects->current());
    }
}

?>
