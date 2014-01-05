<?php

class SelectionFactory_ResourceType extends SelectionFactory
{
    function _issueSelection(Selector $a_oSelector)
    {
        return parent::_newSelection($a_oSelector);
    }
}

