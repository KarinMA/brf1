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
abstract class SvenskBRF_Collection implements Iterator
{
    /**
     *
     * @var Collection
     */
    protected $_oObjects = NULL;
    
    
    function valid()
    {
        return $this->_oObjects->valid();
    }
    
    public function key()
    {
        return $this->_oObjects->key();
    }
            
    
    public function rewind()
    {
        $this->_oObjects->rewind();
    }
    
    public function next()
    {
        $this->_oObjects->next();
    }
    
    /**
     *
     * @param Collection $a_oObjects 
     * @return SvenskBRF_Collection
     */
    public function __construct(Collection $a_oObjects = NULL) 
    {
        $this->_oObjects = $a_oObjects;
    }
    
    /**
     *
     * @return int
     */
    public function size()
    {
        return $this->_oObjects->size();
    }
}

?>
