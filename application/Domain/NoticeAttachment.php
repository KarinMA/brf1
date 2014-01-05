<?php

/**
 * Domain object class for NoticeAttachment. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class NoticeAttachment extends DomainObject 
{
    /**
     * NoticeAttachment's 'notice_id' property. 
     *
     * @var int
     */
    private $_iNoticeId;

    /**
     * NoticeAttachment's 'attachment_file' property. 
     *
     * @var string
     */
    private $_sAttachmentFile;

    /**
     * NoticeAttachment's 'attachment_file_type' property. 
     *
     * @var string
     */
    private $_sAttachmentFileType;

    /**
     * NoticeAttachment's 'attachment_file_name' property. 
     *
     * @var string
     */
    private $_sAttachmentFileName;

    /**
     * Get NoticeAttachment's 'notice_id' property. 
     *
     * @return int
     */
    function getNoticeId()
    {
        return (int) $this->_iNoticeId;
    }

    /**
     * Set NoticeAttachment's 'notice_id' property. 
     *
     * @param int $a_iNoticeId
     * @return void
     */
    function setNoticeId($a_iNoticeId)
    {
        if (!is_null($this->_iNoticeId) && $this->_iNoticeId !== (int) $a_iNoticeId) {
            $this->_markModified();
        }
        $this->_iNoticeId = (int) $a_iNoticeId;
    }

    /**
     * The Notice.
     * 
     * @var Notice
     */
    private $_oNotice;

    /**
     * Get the Notice.
     * 
     * @return Notice
     */
    function getNotice()
    {
        return $this->_oNotice;
    }

    /**
     * Set the Notice.
     * 
     * @param Notice $a_oNotice
     * 
     * @return void
     */
    function setNotice($a_oNotice)
    {
        $this->_iNoticeId = $a_oNotice->getId();
        $this->_oNotice = $a_oNotice;
    }

    /**
     * Get NoticeAttachment's 'attachment_file' property. 
     *
     * @return string
     */
    function getAttachmentFile()
    {
        return (string) $this->_sAttachmentFile;
    }

    /**
     * Set NoticeAttachment's 'attachment_file' property. 
     *
     * @param string $a_sAttachmentFile
     * @return void
     */
    function setAttachmentFile($a_sAttachmentFile)
    {
        if (!is_null($this->_sAttachmentFile) && $this->_sAttachmentFile !== (string) $a_sAttachmentFile) {
            $this->_markModified();
        }
        $this->_sAttachmentFile = (string) $a_sAttachmentFile;
    }

    /**
     * Get NoticeAttachment's 'attachment_file_type' property. 
     *
     * @return string
     */
    function getAttachmentFileType()
    {
        return (string) $this->_sAttachmentFileType;
    }

    /**
     * Set NoticeAttachment's 'attachment_file_type' property. 
     *
     * @param string $a_sAttachmentFileType
     * @return void
     */
    function setAttachmentFileType($a_sAttachmentFileType)
    {
        if (!is_null($this->_sAttachmentFileType) && $this->_sAttachmentFileType !== (string) $a_sAttachmentFileType) {
            $this->_markModified();
        }
        $this->_sAttachmentFileType = (string) $a_sAttachmentFileType;
    }

    /**
     * Get NoticeAttachment's 'attachment_file_name' property. 
     *
     * @return string
     */
    function getAttachmentFileName()
    {
        return (string) $this->_sAttachmentFileName;
    }

    /**
     * Set NoticeAttachment's 'attachment_file_name' property. 
     *
     * @param string $a_sAttachmentFileName
     * @return void
     */
    function setAttachmentFileName($a_sAttachmentFileName)
    {
        if (!is_null($this->_sAttachmentFileName) && $this->_sAttachmentFileName !== (string) $a_sAttachmentFileName) {
            $this->_markModified();
        }
        $this->_sAttachmentFileName = (string) $a_sAttachmentFileName;
    }



    public static function create($a_iNoticeId, $a_sAttachmentFile, $a_sAttachmentFileType, $a_sAttachmentFileName, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_attachment')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('notice_attachment')->write($oObject);
        }
        return $oObject;
    }

}
