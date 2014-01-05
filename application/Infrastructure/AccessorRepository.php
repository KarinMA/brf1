<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AccessorRepository
{
    /**
     * Accessor storage.
     *
     * @var array
     */
    private $_aAccessors;
    
    /**
     *
     * @var AccessorRepository
     */
    private static $_oInstance;
    
    private function __construct() 
    {
        $this->_aAccessors = array();
    }
    
    /**
     *
     * @return AccessorRepository
     */
    public static function getInstance()
    {
        if (!isset(self::$_oInstance)) {
            self::$_oInstance = new AccessorRepository();
        }
        return self::$_oInstance;
    }
    
    public function hasAccessor($a_sAccessor)
    {
        return array_key_exists($a_sAccessor, $this->_aAccessors) && is_object($this->_aAccessors[$a_sAccessor]);
    }
    
    /**
     *
     * @param string $a_sAccessor
     * @return Acccessor
     */
    public function getAccessor($a_sAccessor)
    {
        if (!$this->hasAccessor($a_sAccessor)) {
            // create accessor
            $sClassName = 'Accessor_' . ucfirst(preg_replace("/_([a-z])/e", 'strtoupper("\\1")', $a_sAccessor));
            $this->setAccessor($a_sAccessor, new $sClassName());
        }
        return $this->_aAccessors[$a_sAccessor];
    }
    
    protected function setAccessor($a_sAccessor, Accessor $a_oAccessor, $a_bReturn = FALSE)
    {
        $this->_aAccessors[$a_sAccessor] = $a_oAccessor;
        if ($a_bReturn) {
            return $this->getAccessor($a_sAccessor);
        }
    }
}


?>
