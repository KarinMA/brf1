<?php

/**
 * 
 * @author John
 *
 */
abstract class DomainFactory implements ObjectFactoryI
{
    abstract function createDomainObject(array $a_aRow = array());

    /**
     * Initialize a row that's used to create a domain object.
     *
     * @return array
     */
    private function _initRow(array & $a_r_aRow)
    {
        if (array_key_exists(0, $a_r_aRow)) {
            $a_r_aRow = current($a_r_aRow);
        }
        $iInitParam = array_key_exists('id', $a_r_aRow) ? $a_r_aRow['id'] : null;
        return $iInitParam;
    }

    protected function _createObject(array $a_r_aRow) 
    {
        $sClass = str_replace(array('DomainFactory_', 'Factory'), array('',''), get_called_class());
        if (array_key_exists('Id', $a_r_aRow) && $a_r_aRow['Id']) {
            $a_r_aRow['id'] = $a_r_aRow['Id'];
        }
        if (array_key_exists('id', $a_r_aRow)) {
            $oDomainObject = DomainWatcher::exists($sClass, $a_r_aRow['id']);
            if (isset($oDomainObject) && get_class($oDomainObject) === $sClass && $oDomainObject->getId() == $a_r_aRow['id']) {
                return $oDomainObject;
            }
        }
        $oDomainObject = new $sClass($this->_initRow($a_r_aRow));
        foreach ($a_r_aRow as $sKey => $sValue) {
            if (method_exists($oDomainObject, "set$sKey")) {
                call_user_func_array(array($oDomainObject, "set$sKey"), array(($sValue)));
            } else {
                $sMethodName = 'set'.$this->_getFieldName($sKey);
                if (method_exists($oDomainObject, $sMethodName)) {
                   $oDomainObject->$sMethodName(($sValue));
                }
            }
        }
        return $oDomainObject;
    }

    private function _getFieldName($a_sColumn)
    {
        return ucfirst(preg_replace("/_([a-z])/e", 'strtoupper("\\1")', $a_sColumn));
    }
}