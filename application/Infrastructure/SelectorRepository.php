<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SelectorRepository
{
    /**
     * Selector storage.
     *
     * @var array
     */     
    private $_aSelectors;
    
    /**
     *
     * @var SelectorRepository
     */
    private static $_oInstance;
    
    private function __construct() 
    {
        $this->_aSelectors = array();
    }
    
    /**
     *
     * @return SelectorRepository
     */
    public static function getInstance()
    {
        if (!isset(self::$_oInstance)) {
            self::$_oInstance = new SelectorRepository();
        }
        return self::$_oInstance;
    }
    
    public function hasSelector($a_sSelector)
    {
        return array_key_exists($a_sSelector, $this->_aSelectors) && is_object($this->_aSelectors[$a_sSelector]);
    }
    
    public function getSelector($a_sSelector)
    {
        return 
            $this->hasSelector($a_sSelector) ? 
            $this->_aSelectors[$a_sSelector] 
            : NULL
        ;
    }
    
    public function setSelector($a_sSelector, Selector $a_oSelector)
    {
        $this->_aSelectors[$a_sSelector] = $a_oSelector;
    }
}


?>
