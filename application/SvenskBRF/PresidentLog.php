<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of PresidentLog
 *
 * @author John Jansson
 */
class SvenskBRF_PresidentLog extends SvenskBRF_Main
{
    /**
     * @return void
     */
    function archive()
    {
        $this->_oPresidentLog->setArchive(TRUE);
    }
    
    /**
     *
     * @param SvenskBRF_Brf $a_oBrf
     * @param PresidentLogType $a_oPresidentLogType
     * @param type $a_sDate
     * @param type $a_sComment
     * @return SvenskBRF_PresidentLog
     */
    public static function save(SvenskBRF_Brf $a_oBrf, PresidentLogCategory $a_oPresidentLogCategory, $a_sDate, $a_sLogName, $a_sHeader, $a_sComment = NULL)
    {
        if (strlen($a_sDate) == 10) {
            $a_sDate .= ' 00:00:00';
        } elseif (!$a_sDate) {
            $a_sDate = date('Y-m-d H:i:s');
        }
        $oPresidentLog = PresidentLog::create($a_oBrf->getId(), getUser()->getId(), NULL, $a_sComment ? $a_sComment : NULL, $a_sDate, $a_oPresidentLogCategory->getId(), $a_sLogName ? $a_sLogName : NULL, $a_sHeader ? $a_sHeader : NULL, TRUE);
        $oPresidentLog->setPresidentLogCategory($a_oPresidentLogCategory);
        return self::load($oPresidentLog);
    }
    
    function attachDocument($a_aFileData) 
    {
        if (SvenskBRF_Document::saveDocument(SvenskBRF_Brf::loadById($this->_oPresidentLog->getBrfId()), $a_aFileData, array(SvenskBRF_Document::TYPE_PRESIDENT_LOG, self::getDirectoryNameForLogCategory($this->_oPresidentLog->getPresidentLogCategory())), FALSE, $this->_oPresidentLog->getLogName(), NULL, FALSE, TRUE, TRUE)) {
            $this->_oPresidentLog->setDocumentId(mysql_insert_id($GLOBALS['rDatabaseConnection']));
            $this->_oPresidentLog->setDocument(getDocumentAccessor()->getById($this->_oPresidentLog->getDocumentId()));
        }
    }
    
    public static function getDirectoryNameForLogCategory(PresidentLogCategory $a_oPresidentLogCategory) 
    {
        return strtolower(switchCharacters($a_oPresidentLogCategory->getCategoryName(), TRUE));
    }
    
    /**
     *
     * @param SvenkBRF_Brf $a_oBrf
     * @param type $a_iLogCount
     * @return SvenskBRF_PresidentLog_Collection 
     */
    public static function getPreviousPresidentLogs(SvenskBRF_Brf $a_oBrf, $a_iLogCount = 3)
    {
        self::$_oPresidentLogSelector->setOrderBy('id DESC');
        self::$_oPresidentLogSelector->limit($a_iLogCount);
        self::$_oPresidentLogSelector->setBrfId($a_oBrf->getId());
        return new SvenskBRF_PresidentLog_Collection(self::$_oPresidentLogAccessor->read(self::$_oPresidentLogSelector));
    }
    
    public static function removeProject(SvenskBRF_Brf $a_oBrf, $a_iProjectId)
    {
        self::$_oPresidentLogCategorySelector->setId($a_iProjectId);
        self::$_oPresidentLogCategorySelector->setBrfId($a_oBrf->getId());
        $oCategory = self::$_oPresidentLogCategoryAccessor->readOne(self::$_oPresidentLogCategorySelector);
        if ($oCategory) {
            
            // remove corresponding documents
            $oLogs = SvenskBRF_PresidentLog::getPresidentLogs($a_oBrf, $oCategory);
            foreach ($oLogs as $oLog) {
                if (($oDocument = $oLog->getDocument())) {
                    $oDocument->delete();
                }
            }
            
            if (rmdir("./../files/brfs/" . $a_oBrf->getUrl() . '/documents/styrelselogg/' . self::getDirectoryNameForLogCategory($oCategory))) {
                $oCategory->delete();
            }
        }
    }
   
    /**
     *
     * @return SvenskBRF_Document
     */
    public function getDocument()
    {
        $oDocument = $this->_oPresidentLog->getDocument();
        if ($oDocument) {
            return SvenskBRF_Document::load($oDocument);
        } else {
            return NULL;
        }
    }
    
    /**
     *
     * @param SvenskBRF_Brf $a_oBrf
     * @param type $a_sIdentifier
     * @param type $a_bCreateNew 
     * @return PresidentLogCategory
     */
    public static function getLogCategory(SvenskBRF_Brf $a_oBrf, $a_sIdentifier, $a_bCreateNew, $a_sDescription = NULL)
    {
        if (!$a_bCreateNew) {
            return self::$_oPresidentLogCategoryAccessor->getById((int) $a_sIdentifier);
        } else {
            self::$_oPresidentLogCategorySelector->setBrfId($a_oBrf->getId());
            self::$_oPresidentLogCategorySelector->setCategoryName($a_sIdentifier);
            $oLogCategory = self::$_oPresidentLogCategoryAccessor->readOne(self::$_oPresidentLogCategorySelector);
            if (!$oLogCategory) {
                $oLogCategory = PresidentLogCategory::create($a_oBrf->getId(), $a_sIdentifier, $a_sDescription, FALSE, TRUE);
                // create a directory for the document
                $sDirPath = "./../files/brfs/" . $a_oBrf->getUrl(). '/documents/styrelselogg/' . self::getDirectoryNameForLogCategory($oLogCategory);
                mkdir($sDirPath);
            }
            return $oLogCategory;
        }
    }
    
    /**
     * 
     * @return SvenskBRF_PresidentLog_Collection
     */
    public static function getPresidentLogs(SvenskBRF_Brf $a_oBrf, PresidentLogCategory $a_oCategory = NULL)
    {
        self::$_oPresidentLogSelector->setBrfId($a_oBrf->getId());
        if ($a_oCategory) {
            self::$_oPresidentLogSelector->setPresidentLogCategoryId($a_oCategory->getId());
        }
        $oInformation = self::$_oPresidentLogAccessor->read(self::$_oPresidentLogSelector);
        return new SvenskBRF_PresidentLog_Collection($oInformation);
    }
    
    /**
     * Get a BRF's categories.
     *
     * @return Collection
     */
    public static function getPresidentLogCategories(SvenskBRF_Brf $a_oBrf, $a_bArchived = FALSE)
    {
        self::$_oPresidentLogCategorySelector->setArchive($a_bArchived);
        self::$_oPresidentLogCategorySelector->setBrfId($a_oBrf->getId());
        return self::$_oPresidentLogCategoryAccessor->read(self::$_oPresidentLogCategorySelector);
    }
    
    /**
     *
     * @var PresidentLog
     */
    private $_oPresidentLog;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oPresidentLog, $a_sMethod), $a_aArguments);
    }
    
    /**
     *
     *
     * @param PresidentLog $a_oPresidentLog
     * @return SvenskBRF_PresidentLog
     */
    public static function load(PresidentLog $a_oPresidentLog)
    {
        return new self($a_oPresidentLog);
    }
    
    function saveComment($a_sCommentText)
    {
        $oComment = PresidentLogComment::create($this->_oPresidentLog->getId(), getUser()->getId(), date('Y-m-d H:i:s'), $a_sCommentText, TRUE);
        $this->_oPresidentLog->getPresidentLogCommentCollection()->addObject($oComment);
    }
    
    /**
     * 
     * @return Collection
     */
    function getPresidentLogCommentCollection()
    {
        $aComments = array();
        foreach ($this->_oPresidentLog->getPresidentLogCommentCollection() as $oPLogComment) {
            $aComments[] = $oPLogComment;
        }
        $oCollection = new Collection;
        foreach (($aComments) as $oComment) {
            $oCollection->addObject($oComment);
        }
        return $oCollection;
    }
    
    /**
     *
     * @param type $a_iId
     * @return SvenskBRF_PresidentLog
     */
    public static function loadById($a_iId)
    {
        if ($a_iId) {
            $oPLog = self::$_oPresidentLogAccessor->getById($a_iId);
            return $oPLog ? self::load($oPLog) : NULL;
        } else {
            return NULL;
        }
    }
    
    private function __construct(PresidentLog $a_oPresidentLog)
    {
        $this->_oPresidentLog = $a_oPresidentLog;
    }
    
    
    public function isDocument()
    {
        return $this->_oPresidentLog->getLogName() !== NULL && $this->_oPresidentLog->getDocument();
    }
    
    public static function deleteLog(SvenskBRF_Brf $a_oBrf, $a_iLogId)
    {
        $oPresidentLog = self::$_oPresidentLogAccessor->getById($a_iLogId);
        if ($oPresidentLog->getBrfId() == $a_oBrf->getId()) {
            $oPresidentLog = self::load($oPresidentLog);
            if ($oPresidentLog->isDocument()) {
                $oPresidentLog->getDocument()->delete();
            }
            $oPresidentLog->delete();
        }
    }

}

?>
