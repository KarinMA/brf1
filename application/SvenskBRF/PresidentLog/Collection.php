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
class SvenskBRF_PresidentLog_Collection extends SvenskBRF_Collection {
    /**
     *
     * @return SvenskBRF_PresidentLog
     */
    public function current() {
        return SvenskBRF_PresidentLog::load($this->_oObjects->current());
    }
}

?>
