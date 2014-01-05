<?php

class SelectionFactory_Notice extends SelectionFactory
{
    function _issueSelection(Selector $a_oSelector)
    {
        return parent::_newSelection($a_oSelector);
    }
}

