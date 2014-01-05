<?php

/**
 * Selector class for NoticeAttachment. 
 *
 * @see NoticeAttachment
 * @see Selector
 * @package JJ_OrderSystem
 * @subpackage Selector
 */
class Selector_NoticeAttachmentSelector extends Selector 
{


    /**
     * NoticeAttachment selector's 'notice_id' property. 
     *
     * @var int
     */
    private $_iNoticeId;

    /**
     * NoticeAttachment selector's 'attachment_file' property. 
     *
     * @var string
     */
    private $_sAttachmentFile;

    /**
     * NoticeAttachment selector's 'attachment_file_type' property. 
     *
     * @var string
     */
    private $_sAttachmentFileType;

    /**
     * NoticeAttachment selector's 'attachment_file_name' property. 
     *
     * @var string
     */
    private $_sAttachmentFileName;
    /**
     * Get NoticeAttachment selector's 'notice_id' property. 
     *
     * @return int
     */
    function getNoticeId()
    {
        return (int) $this->_iNoticeId;
    }

    /**
     * Set NoticeAttachment selector's 'notice_id' property. 
     *
     * @param int $a_iNoticeId
     * @return void
     */
    function setNoticeId($a_iNoticeId)
    {
        $this->_iNoticeId = (int) $a_iNoticeId;
        $this->setSearchParameter('notice_id', $this->_iNoticeId);
    }

    /**
     * Get NoticeAttachment selector's 'attachment_file' property. 
     *
     * @return string
     */
    function getAttachmentFile()
    {
        return (string) $this->_sAttachmentFile;
    }

    /**
     * Set NoticeAttachment selector's 'attachment_file' property. 
     *
     * @param string $a_sAttachmentFile
     * @return void
     */
    function setAttachmentFile($a_sAttachmentFile)
    {
        $this->_sAttachmentFile = (string) $a_sAttachmentFile;
        $this->setSearchParameter('attachment_file', $this->_sAttachmentFile);
    }

    /**
     * Get NoticeAttachment selector's 'attachment_file_type' property. 
     *
     * @return string
     */
    function getAttachmentFileType()
    {
        return (string) $this->_sAttachmentFileType;
    }

    /**
     * Set NoticeAttachment selector's 'attachment_file_type' property. 
     *
     * @param string $a_sAttachmentFileType
     * @return void
     */
    function setAttachmentFileType($a_sAttachmentFileType)
    {
        $this->_sAttachmentFileType = (string) $a_sAttachmentFileType;
        $this->setSearchParameter('attachment_file_type', $this->_sAttachmentFileType);
    }

    /**
     * Get NoticeAttachment selector's 'attachment_file_name' property. 
     *
     * @return string
     */
    function getAttachmentFileName()
    {
        return (string) $this->_sAttachmentFileName;
    }

    /**
     * Set NoticeAttachment selector's 'attachment_file_name' property. 
     *
     * @param string $a_sAttachmentFileName
     * @return void
     */
    function setAttachmentFileName($a_sAttachmentFileName)
    {
        $this->_sAttachmentFileName = (string) $a_sAttachmentFileName;
        $this->setSearchParameter('attachment_file_name', $this->_sAttachmentFileName);
    }

}
