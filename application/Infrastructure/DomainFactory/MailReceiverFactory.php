<?php

/**
 * Object factory class for MailReceiver. 
 *
 * @see MailReceiver
 * @see DomainFactory
 * @package JJ_OrderSystem
 * @subpackage ObjectFactory
 */
class DomainFactory_MailReceiverFactory extends DomainFactory
{
    /**
     * Creates MailReceiver instance. 
     *
     * @param array $a_aRow 
     * @return MailReceiver
     */
    function createDomainObject(array $a_aRow = array())
    {
        return $this->_createObject($a_aRow);
    }
}
