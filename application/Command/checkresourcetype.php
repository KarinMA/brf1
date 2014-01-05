<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of checkresourcetype
 *
 * @author John Jansson
 */
class Command_checkresourcetype extends Command 
{
    protected function _executeCommand() 
    {
        $oRTs = getResourceTypeAccessor()->getResourceTypesByTypeName($this->_aRequest['resourceType']);
        return array( 'wholeDay' => $oRTs->current()->getWholeDay() );
    }
}

?>
