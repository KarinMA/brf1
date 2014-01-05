<?php

/**
 * Selector class for NoticeType. 
 *
 * @see NoticeType
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_NoticeTypeSelector extends Selector 
{


    /**
     * NoticeType selector's 'notice_type' property. 
     *
     * @var string
     */
    private $_sNoticeType;
    /**
     * Get NoticeType selector's 'notice_type' property. 
     *
     * @return string
     */
    function getNoticeType()
    {
        return (string) $this->_sNoticeType;
    }

    /**
     * Set NoticeType selector's 'notice_type' property. 
     *
     * @param string $a_sNoticeType selector
     * @return void
     */
    function setNoticeType($a_sNoticeType)
    {
        $this->_sNoticeType = (string) $a_sNoticeType;
        $this->setSearchParameter('notice_type', $this->_sNoticeType);
    }

}
