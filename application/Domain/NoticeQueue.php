<?php

/**
 * Domain object class for NoticeQueue. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class NoticeQueue extends DomainObject 
{
    /**
     * NoticeQueue's 'notice_id' property. 
     *
     * @var int
     */
    private $_iNoticeId;

    /**
     * NoticeQueue's 'status' property. 
     *
     * @var string
     */
    private $_sStatus;

    /**
     * NoticeQueue's 'error_message' property. 
     *
     * @var string
     */
    private $_sErrorMessage;

    /**
     * NoticeQueue's 'error_code' property. 
     *
     * @var int
     */
    private $_iErrorCode;

    /**
     * NoticeQueue's 'queued_on' property. 
     *
     * @var string
     */
    private $_sQueuedOn;

    /**
     * NoticeQueue's 'send_on' property. 
     *
     * @var string
     */
    private $_sSendOn;

    /**
     * Get NoticeQueue's 'notice_id' property. 
     *
     * @return int
     */
    function getNoticeId()
    {
        return (int) $this->_iNoticeId;
    }

    /**
     * Set NoticeQueue's 'notice_id' property. 
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
     * Get NoticeQueue's 'status' property. 
     *
     * @return string
     */
    function getStatus()
    {
        return (string) $this->_sStatus;
    }

    /**
     * Set NoticeQueue's 'status' property. 
     *
     * @param string $a_sStatus
     * @return void
     */
    function setStatus($a_sStatus)
    {
        if (!is_null($this->_sStatus) && $this->_sStatus !== (string) $a_sStatus) {
            $this->_markModified();
        }
        $this->_sStatus = (string) $a_sStatus;
    }

    /**
     * Get NoticeQueue's 'error_message' property. 
     *
     * @return string|null
     */
    function getErrorMessage()
    {
        return is_null($this->_sErrorMessage) ? NULL : (string) $this->_sErrorMessage;
    }

    /**
     * Set NoticeQueue's 'error_message' property. 
     *
     * @param string|null $a_sErrorMessage
     * @return void
     */
    function setErrorMessage($a_sErrorMessage)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_sErrorMessage) ? NULL : ((string) $a_sErrorMessage);
            if ($mCompareValue !== $this->_sErrorMessage) {
                $this->_markModified();
            }
        }
        $this->_sErrorMessage = is_null($a_sErrorMessage) ? NULL : (string) $a_sErrorMessage;
    }

    /**
     * Get NoticeQueue's 'error_code' property. 
     *
     * @return int|null
     */
    function getErrorCode()
    {
        return is_null($this->_iErrorCode) ? NULL : (int) $this->_iErrorCode;
    }

    /**
     * Set NoticeQueue's 'error_code' property. 
     *
     * @param int|null $a_iErrorCode
     * @return void
     */
    function setErrorCode($a_iErrorCode)
    {
        if (DomainWatcher::exists(get_class($this), $this->getId())) {
            $mCompareValue = is_null($a_iErrorCode) ? NULL : ((int) $a_iErrorCode);
            if ($mCompareValue !== $this->_iErrorCode) {
                $this->_markModified();
            }
        }
        $this->_iErrorCode = is_null($a_iErrorCode) ? NULL : (int) $a_iErrorCode;
    }

    /**
     * Get NoticeQueue's 'queued_on' property. 
     *
     * @return string
     */
    function getQueuedOn()
    {
        return strlen($this->_sQueuedOn) ? (string) $this->_sQueuedOn : NULL;
    }

    /**
     * Set NoticeQueue's 'queued_on' property. 
     *
     * @param string $a_sQueuedOn
     * @return void
     */
    function setQueuedOn($a_sQueuedOn)
    {
        if (!is_null($this->_sQueuedOn) && $this->_sQueuedOn !== (string) $a_sQueuedOn) {
            $this->_markModified();
        }
        $this->_sQueuedOn = (string) $a_sQueuedOn;
    }

    /**
     * Get NoticeQueue's 'send_on' property. 
     *
     * @return string
     */
    function getSendOn()
    {
        return strlen($this->_sSendOn) ? (string) $this->_sSendOn : NULL;
    }

    /**
     * Set NoticeQueue's 'send_on' property. 
     *
     * @param string $a_sSendOn
     * @return void
     */
    function setSendOn($a_sSendOn)
    {
        if (!is_null($this->_sSendOn) && $this->_sSendOn !== (string) $a_sSendOn) {
            $this->_markModified();
        }
        $this->_sSendOn = (string) $a_sSendOn;
    }



    public static function create($a_iNoticeId, $a_sStatus, $a_sErrorMessage, $a_iErrorCode, $a_sQueuedOn, $a_sSendOn, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('notice_queue')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('notice_queue')->write($oObject);
        }
        return $oObject;
    }

}
