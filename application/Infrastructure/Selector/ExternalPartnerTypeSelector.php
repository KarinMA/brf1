<?php

/**
 * Selector class for ExternalPartnerType. 
 *
 * @see ExternalPartnerType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_ExternalPartnerTypeSelector extends Selector 
{


    /**
     * ExternalPartnerType selector's 'type_name' property. 
     *
     * @var string
     */
    private $_sTypeName;
    /**
     * Get ExternalPartnerType selector's 'type_name' property. 
     *
     * @return string
     */
    function getTypeName()
    {
        return (string) $this->_sTypeName;
    }

    /**
     * Set ExternalPartnerType selector's 'type_name' property. 
     *
     * @param string $a_sTypeName
     * @return void
     */
    function setTypeName($a_sTypeName)
    {
        $this->_sTypeName = (string) $a_sTypeName;
        $this->setSearchParameter('type_name', $this->_sTypeName);
    }

}
