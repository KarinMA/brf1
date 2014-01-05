<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectionFactory
 *
 * @author John Jansson
 */
abstract class SelectionFactory 
{
    /**
     *
     * @param Selector $a_oSelector
     * @return type 
     */
    public final function newSelection(Selector $a_oSelector)
    {
        return $this->_issueSelection($a_oSelector);
    }
    
    protected function _newSelection(Selector $a_oSelector) {
        $sSelection = "";
        foreach ($a_oSelector->fetchSearchParameters() as $oSearchParameter) {
            if ($oSearchParameter->getParameterName()) {
                $sSelection .= " AND $oSearchParameter";
            }
        }
        
        $sSelection .= $a_oSelector->getOrderBy();
        
        if (($iLimit = $a_oSelector->limit()))  {
            $sSelection .= " LIMIT $iLimit";
        }
        
        return $sSelection;
    }
    
    /**
     *
     * @param Selector $a_oSelector 
     * @return string
     */
    protected abstract function _issueSelection(Selector $a_oSelector);
}

?>
