<?php

class SelectionFactory_PasswordReset extends SelectionFactory
{
    function _issueSelection(Selector $a_oSelector)
    {
        return parent::_newSelection($a_oSelector);
    }
}

