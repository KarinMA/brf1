<?php

/**
 * Domain object class for PresidentLogComment. 
 *
 * @see DomainObject
 * @package JJ_OrderSystem
 * @subpackage Domain
 */
class PresidentLogComment extends DomainObject 
{
    /**
     * PresidentLogComment's 'president_log_id' property. 
     *
     * @var int
     */
    private $_iPresidentLogId;

    /**
     * PresidentLogComment's 'by_user_id' property. 
     *
     * @var int
     */
    private $_iByUserId;

    /**
     * PresidentLogComment's 'timestamp' property. 
     *
     * @var string
     */
    private $_sTimestamp;

    /**
     * PresidentLogComment's 'comment' property. 
     *
     * @var string
     */
    private $_sComment;

    /**
     * Get PresidentLogComment's 'president_log_id' property. 
     *
     * @return int
     */
    function getPresidentLogId()
    {
        return (int) $this->_iPresidentLogId;
    }

    /**
     * Set PresidentLogComment's 'president_log_id' property. 
     *
     * @param int $a_iPresidentLogId
     * @return void
     */
    function setPresidentLogId($a_iPresidentLogId)
    {
        if (!is_null($this->_iPresidentLogId) && $this->_iPresidentLogId !== (int) $a_iPresidentLogId) {
            $this->_markModified();
        }
        $this->_iPresidentLogId = (int) $a_iPresidentLogId;
    }

    /**
     * The PresidentLog.
     * 
     * @var PresidentLog
     */
    private $_oPresidentLog;

    /**
     * Get the PresidentLog.
     * 
     * @return PresidentLog
     */
    function getPresidentLog()
    {
        return $this->_oPresidentLog;
    }

    /**
     * Set the PresidentLog.
     * 
     * @param PresidentLog $a_oPresidentLog
     * 
     * @return void
     */
    function setPresidentLog($a_oPresidentLog)
    {
        $this->_iPresidentLogId = $a_oPresidentLog->getId();
        $this->_oPresidentLog = $a_oPresidentLog;
    }

    /**
     * Get PresidentLogComment's 'by_user_id' property. 
     *
     * @return int
     */
    function getByUserId()
    {
        return (int) $this->_iByUserId;
    }

    /**
     * Set PresidentLogComment's 'by_user_id' property. 
     *
     * @param int $a_iByUserId
     * @return void
     */
    function setByUserId($a_iByUserId)
    {
        if (!is_null($this->_iByUserId) && $this->_iByUserId !== (int) $a_iByUserId) {
            $this->_markModified();
        }
        $this->_iByUserId = (int) $a_iByUserId;
    }

    /**
     * The ByUser.
     * 
     * @var ByUser
     */
    private $_oByUser;

    /**
     * Get the ByUser.
     * 
     * @return ByUser
     */
    function getByUser()
    {
        return $this->_oByUser;
    }

    /**
     * Set the ByUser.
     * 
     * @param ByUser $a_oByUser
     * 
     * @return void
     */
    function setByUser($a_oByUser)
    {
        $this->_iByUserId = $a_oByUser->getId();
        $this->_oByUser = $a_oByUser;
    }

    /**
     * Get PresidentLogComment's 'timestamp' property. 
     *
     * @return string
     */
    function getTimestamp()
    {
        return strlen($this->_sTimestamp) ? (string) $this->_sTimestamp : NULL;
    }

    /**
     * Set PresidentLogComment's 'timestamp' property. 
     *
     * @param string $a_sTimestamp
     * @return void
     */
    function setTimestamp($a_sTimestamp)
    {
        if (!is_null($this->_sTimestamp) && $this->_sTimestamp !== (string) $a_sTimestamp) {
            $this->_markModified();
        }
        $this->_sTimestamp = (string) $a_sTimestamp;
    }

    /**
     * Get PresidentLogComment's 'comment' property. 
     *
     * @return string
     */
    function getComment()
    {
        return (string) $this->_sComment;
    }

    /**
     * Set PresidentLogComment's 'comment' property. 
     *
     * @param string $a_sComment
     * @return void
     */
    function setComment($a_sComment)
    {
        if (!is_null($this->_sComment) && $this->_sComment !== (string) $a_sComment) {
            $this->_markModified();
        }
        $this->_sComment = (string) $a_sComment;
    }



    public static function create($a_iPresidentLogId, $a_iByUserId, $a_sTimestamp, $a_sComment, $a_bInstantCreation = FALSE)
    {
        $oMethod = new ReflectionMethod(__METHOD__);
        $aData = array();
        foreach ($oMethod->getParameters() as $oMethodParameter) {
            if (!$oMethodParameter->isDefaultValueAvailable()) {
                $aData[substr($oMethodParameter->name, 3)] = ${$oMethodParameter->name};
            }
        }
        $oObject = ObjectFactoryRepository::getInstance()->getObjectFactory('president_log_comment')->createDomainObject($aData);
        if ($a_bInstantCreation) {
            AccessorRepository::getInstance()->getAccessor('president_log_comment')->write($oObject);
        }
        return $oObject;
    }

}
