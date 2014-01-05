<?php

/**
 * 
 * @author John
 *
 */
abstract class MappingFactory
{
	/**
	 * 
	 * @param array $a_aData
	 * @return unknown_type
	 */
	abstract function getCollection(array $a_aData);
	
	/**
	 * 
	 * 
	 * @return DomainFactory
	 */
	abstract function getDomainFactory();
	
	/**
	 * Return a selector for orders.
	 * 
	 * @return Selector
	 */
	abstract function getSelector($a_sTableName);
}