<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ObjectFactoryRepository
{
    /**
     * Factory storage.
     *
     * @var array
     */
    private $_aObjectFactories;
    
    /**
     *
     * @var ObjectFactoryRepository
     */
    private static $_oInstance;
    
    private function __construct() 
    {
        $this->_aObjectFactories = array();
    }
    
    /**
     *
     * @return ObjectFactoryRepository
     */
    public static function getInstance()
    {
        if (!isset(self::$_oInstance)) {
            self::$_oInstance = new ObjectFactoryRepository();
        }
        return self::$_oInstance;
    }
    
    public function hasObjectFactory($a_sObjectFactory)
    {
        return array_key_exists($a_sObjectFactory, $this->_aObjectFactories) && is_object($this->_aObjectFactories[$a_sObjectFactory]);
    }
    /**
     *
     * @param type $a_sObjectFactory
     * @return DomainFactory
     */
    public function getObjectFactory($a_sObjectFactory)
    {
        return 
            $this->hasObjectFactory($a_sObjectFactory) ? 
            $this->_aObjectFactories[$a_sObjectFactory] 
            : NULL
        ;
    }
    
    public function setObjectFactory($a_sObjectFactory, ObjectFactoryI $a_oObjectFactory)
    {
        $this->_aObjectFactories[$a_sObjectFactory] = $a_oObjectFactory;
    }
}


?>
