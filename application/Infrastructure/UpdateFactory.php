<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 */
abstract class UpdateFactory
{
    /**
     * 
     * @param DomainObject $a_DomainOBhject
     * @return array
     */
    public abstract function newUpdate(DomainObject $a_oDomainObject);
}

?>
