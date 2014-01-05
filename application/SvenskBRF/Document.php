<?php

/**
 * Use this class instead of the functions I've used.
 * 
 */

/**
 * Description of Document
 *
 * @author John Jansson
 */
class SvenskBRF_Document extends SvenskBRF_File
{
    const TYPE_OTHER = 'ovrigt';
    const TYPE_PRESIDENT_LOG = 'styrelselogg';
    
    /**
     *
     * @var Document
     */
    private $_oDocument;
    
    /**
     * Callback to the domain object.
     *
     * @param type $a_sMethod
     * @param type $a_aArguments
     * @return type 
     */
    public function __call($a_sMethod, $a_aArguments = array()) 
    {
        return call_user_func_array(array($this->_oDocument, $a_sMethod), $a_aArguments);
    }
    
    public static function getTemplateNames()
    {
        return array(
            'template_maklarunderlag.pdf',
            'template_anslagstavla.pdf',
            'for_maklare.pdf',
            'prislista.pdf',
            'Komma_igang_guide.pdf',
        );
    }
    
    /**
     * 
     * @param SvenskBRF_Brf $a_oBrf
     * return array
     */
    public static function getDocumentArchiveTypes(SvenskBRF_Brf $a_oBrf)
    {
        self::$_oDocumentSelector->setBrfId($a_oBrf->getId());
        self::$_oDocumentSelector->setIsBoard(TRUE);
        self::$_oDocumentSelector->setSearchParameter('document_type_id', array(9), Selector::CONDITION_IN);
        self::$_oDocumentSelector->setIsPresident(FALSE);
        $aNames = array();
        foreach ((new SvenskBRF_Document_Collection(self::$_oDocumentAccessor->read(self::$_oDocumentSelector))) as $oDocument) {
            $aNames[] = substr($oDocument->getFilename(), 0, strpos($oDocument->getFilename(), '_') - 1);
        }
        return $aNames;
    }

    public function getIconImageType()
    {
        return $this->getFileType() === 'pdf' ? 'jpg' : 'png';
    }
    
    /**
     *
     * @param Resource $a_oResource 
     * @return void
     */
    public static function generateDocumentForResource(Resource $a_oResource, $a_aDays = array())
    {
        // specific pdf depending on resource type?
        $oBrf = SvenskBRF_Brf::loadById($a_oResource->getBrfId());
        @$oPdf = new FPDI();
        $oPdf->setSourceFile("./../files/templates/lokal1.pdf");
        $oPdf->AddPage();
        @$oTplIdx = $oPdf->importPage(1);  
        @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  

        // use the imported page and place it at point 10,10 with a width of 200 mm   (This is    the image of the included pdf)

        // now write some text above the imported page
        $oPdf->SetTextColor(0,0,0);
        
        // header
        $oPdf->SetFont('Arial','B',28); 
        $iX = 37;
        $iY = 49;
        $oPdf->SetXY($iX, $iY);  
        $oPdf->Write(0, utf8_decode($a_oResource->getName()));
        
        
        $oPdf->SetFont('Arial','',11); 
        $iX = 37;
        $iY = 120;
        $oPdf->SetXY($iX, $iY);  
        $oPdf->Write(0, utf8_decode($a_oResource->getName()));
        
        $iX = 73;
        $iY = 175.8;
        $oPdf->SetXY($iX, $iY);  
        
        $aDays = array();
        if (is_array($a_aDays) && !count($a_aDays)) {
            $oDays = self::$_oResourceDayAccessor->getResourceDaysByResourceId($a_oResource->getId());
            foreach ($oDays as $oDay) {
                $aDays[] = $oDay->getDay();
            }
        } else {
            if (is_array($a_aDays)) {
                $aDays = $a_aDays;
            }
        }
        
        sort($aDays);
        if (count($aDays) && $aDays[0] == 0) {
            // sunday
            array_shift($aDays);
            $aDays[] = 0;
        }
        
        $bSequence = count($aDays) > 0;
        for ($iDayIndex = 0; $bSequence && $iDayIndex < count($aDays); $iDayIndex++) {
            if (array_key_exists($iDayIndex - 1, $aDays)) {
                if ($aDays[$iDayIndex - 1] != $aDays[$iDayIndex] - 1) {
                    if ($aDays[$iDayIndex] != 0 || $aDays[$iDayIndex -1] != 6) {
                        $bSequence = FALSE;
                    }
                }
            }
        }
        $sDays = "";
        if (count($aDays)) {
            $sDays = utf8_decode(getDay($aDays[0], FALSE));
            if ($bSequence) {
                $sDays .= "-" . utf8_decode(getDay($aDays[count($aDays) - 1], FALSE));
            } else{
                for ($iDayIndex = 1; $iDayIndex < count($aDays); $iDayIndex++) {
                    $sDays .= ", " . utf8_decode(getDay($aDays[$iDayIndex], FALSE));
                }
            }
        }
        
        $oPdf->Write(0, $sDays);
        
        
        
        
        $iY = 184.5;
        $iX = 51;
        $oPdf->SetXY($iX, $iY);  
        $oPdf->Write(0, getHour($a_oResource->getOpenHour()) . ':00');

        // write URL
        $iY = 193.2;
        $iX = 48.9;
        $oPdf->SetXY($iX, $iY);  
        $oPdf->Write(0, getHour($a_oResource->getCloseHour()) . ':00');
        
        $iY = 201.9 + 5;
        $iX = 37;
        
        $aIntervals = array();
        $iIntervalCounter = 0;
        $iIntervalIndex = 0;
        for ($iOpenHour = $a_oResource->getOpenHour(); $iOpenHour < $a_oResource->getCloseHour(); $iOpenHour += $a_oResource->getInterval()) {
            $iIntervalCounter++;
            if ($iIntervalCounter == 8) {
                $iIntervalIndex++;
                $iIntervalCounter = 1;
            } 
            @$aIntervals[$iIntervalIndex][] = getHour($iOpenHour).':00-'.getHour($iOpenHour+$a_oResource->getInterval()).':00'; 
        }
        
        foreach ($aIntervals as $aInterval) {
            $oPdf->SetXY($iX, $iY);  
            $sIntervals = implode(", ", $aInterval);
            $oPdf->write(0, $sIntervals);
            $iY += 4;
        }
        
        
        
        
        
        
        $sPdfPath = "./../files/brfs/" . $oBrf->getUrl() . "/documents/lokaler/" . str_replace("/", "_", $a_oResource->getName()) . '.pdf';
        $oPdf->Output($sPdfPath, 'F');
        
    }
    
    /**
     *
     *
     * @param Document $a_oDocument
     * @return SvenskBRF_Document
     */
    public static function load(Document $a_oDocument)
    {
        return new self($a_oDocument);
    }
    
    private function __construct(Document $a_oDocument)
    {
        $this->_oDocument = $a_oDocument;
    }
    
    /**
     *
     * @return string 
     */
    function getFilePath() 
    {
        $sPath = self::FILE_BASE_PATH;
        $sPath .= $this->_oDocument->getBrf()->getUrl() . "/";
        $sPath .= "documents/";
        
        // is it a president document?
        if ($this->_oDocument->getIsPresident()) {
            $oPresidentLogs = self::$_oPresidentLogAccessor->getPresidentLogsByDocumentId($this->_oDocument->getId());
            if ($oPresidentLogs->size()) {
                $sPath .= self::TYPE_PRESIDENT_LOG . '/';
                $oPresidentLogCategory = $oPresidentLogs->current()->getPresidentLogCategory();
                $sPath .= SvenskBRF_PresidentLog::getDirectoryNameForLogCategory($oPresidentLogCategory) . '/';
            } else {
                return NULL;
            }
        } else {
            $sPath .= $this->_oDocument->getDocumentType()->getDirectoryName() . '/';
        }
        $sPath .= $this->_oDocument->getFilename() . "." . $this->_oDocument->getFileType();
        return file_exists($sPath) ? $sPath : NULL;
    }
    
    /**
     * 
     * @param DocumentType $a_oDocumentType
     */
    function setDocumentType(DocumentType $a_oDocumentType) 
    {
        if ($a_oDocumentType) {
            $this->setDocumentTypeId($a_oDocumentType->getId());
            $this->_oDocument->setDocumentType($a_oDocumentType);
        }
    }
    
    /**
     * 
     * @param type $a_iDocumentTypeId
     */
    public function setDocumentTypeId($a_iDocumentTypeId)
    {
        $oNewDocumentType = self::$_oDocumentTypeAccessor->getById($a_iDocumentTypeId);
        $oBrf = SvenskBRF_Brf::loadById($this->_oDocument->getBrfId());
        if (!$this->_oDocument->getDocumentType()) {
            $this->_oDocument->setDocumentType(self::$_oDocumentTypeAccessor->getById($this->_oDocument->getDocumentTypeId()));
        }
        $sOldPath = self::FILE_BASE_PATH . $oBrf->getUrl() . '/documents/' . $this->_oDocument->getDocumentType()->getDirectoryName() . '/' . $this->_oDocument->getFilename() . '.' . $this->_oDocument->getFileType();
        $sNewPath = self::FILE_BASE_PATH . $oBrf->getUrl() . '/documents/' . $oNewDocumentType->getDirectoryName() . '/' . $this->_oDocument->getFilename() . '.' . $this->_oDocument->getFileType();
        if (copy($sOldPath, $sNewPath)) {
            unlink($sOldPath);
            $this->_oDocument->setDocumentTypeId($a_iDocumentTypeId);
        }
        
    }
    
    /**
     *
     * @param SvenskBRF_Brf $a_oBrf 
     * @return string
     */
    public static function getToMembersStartDocumentName(SvenskBRF_Brf $a_oBrf)
    {
        return str_replace(" ", "_", (($a_oBrf->getName())) . ' till medlemmar.pdf');
    }
    
    /**
     *
     * 
     * @param string $a_sDirectoryName
     * @return DocumentType
     */
    public static function getDocumentTypeByDirectoryName($a_sDirectoryName, $a_bIsArchive = FALSE)
    {
        self::$_oDocumentTypeSelector->setDirectoryName($a_sDirectoryName);
        self::$_oDocumentTypeSelector->setIsArchive($a_bIsArchive);
        $oDocumentTypes = self::$_oDocumentTypeAccessor->read(self::$_oDocumentTypeSelector);
        if ($oDocumentTypes->size()) {
            return $oDocumentTypes->current();
        } else {
            return NULL;
        }
    }
    
    public static function loadById($a_iDocumentId)
    {
        return self::load(self::$_oDocumentAccessor->getById($a_iDocumentId));
    }

    
    public function setFilename($a_sFilename) 
    {
        if ($a_sFilename != $this->_oDocument->getFilename()) {
            $sFilename = self::_getFilename(SvenskBRF_Brf::load($this->_oDocument->getBrf()), $a_sFilename, $this->_oDocument->getFileType(), $this->_oDocument->getDocumentType()->getDirectoryName());
            $oBrf = SvenskBRF_Brf::loadById($this->_oDocument->getBrfId());
            copy($this->getFilePath(), self::FILE_BASE_PATH . $oBrf->getUrl() . '/documents/' . $this->_oDocument->getDocumentType()->getDirectoryName() .'/'. $sFilename . '.' . $this->_oDocument->getFileType() );
            unlink($this->getFilePath());
            $this->_oDocument->setFilename($sFilename);
        }
    }
    
    /**
     * Renames document if other documents already exist.
     *
     * @param string $a_sFilename 
     */
    private static function _getFilename(SvenskBRF_Brf $a_oBrf, $a_sFilename, $a_sFileType, $a_sDirectory)
    {
        $sFilename = $a_sFilename;
        $iCounter = 1;
        $sAdd = "-$iCounter";
        while (file_exists(self::FILE_BASE_PATH . $a_oBrf->getUrl() . '/documents/' . $a_sDirectory . '/' . $sFilename . '.' . $a_sFileType)) {
            $sFilename = $a_sFilename . $sAdd;
            $iCounter++;
            $sAdd = "-$iCounter";
        }
        return $sFilename;
    }
    
    /**
     * @return void
     */
    function archive()
    {
        if (!$this->_oDocument->getIsBoard() || $this->_oDocument->getDocumentTypeId() != 9) {
            $sOldPath = $this->getFilePath();
            if ($sOldPath) {
                $oPreviousDocumentType = $this->_oDocument->getDocumentType();
                $this->_oDocument->setIsBoard(TRUE);
                $this->_oDocument->setDocumentTypeId(9);
                $oDocumentType = self::$_oDocumentTypeAccessor->getById(9);
                $this->_oDocument->setDocumentType($oDocumentType);
                $oBrf = SvenskBRF_Brf::loadById($this->_oDocument->getBrfId());
                $sNewFilename = $oPreviousDocumentType->getDocumentTypeName() . ' _ ' . $this->_oDocument->getFilename();
                $sNewPath = self::FILE_BASE_PATH . $oBrf->getUrl() . '/documents/arkiv/' . $sNewFilename . '.' . $this->_oDocument->getFileType();
                if (copy($sOldPath, $sNewPath)) {
                    unlink($sOldPath);
                }
                $this->_oDocument->setFilename($sNewFilename);
            }
        }
    }
    
    /**
     * Only PDF's right now.
     *
     * @param SvenskBRF_Brf $a_oBrf
     * @param type $a_aFileData
     * @param type $a_sDocumentTypeName
     * @param type $a_sName
     * @param type $a_iYear
     * @return boolean 
     */
    public static function saveDocument(SvenskBRF_Brf $a_oBrf, $a_aFileData, $a_mDocumentTypeName, $a_bPublic = FALSE, $a_sName = '', $a_iYear = 0, $a_bIsBoard = FALSE, $a_bIsPresident = FALSE)
    {
        $oDocumentType = is_array($a_mDocumentTypeName) && $a_mDocumentTypeName[0] == self::TYPE_PRESIDENT_LOG ? 
            self::$_oDocumentTypeAccessor->getDocumentTypesByDirectoryName(self::TYPE_OTHER)->current(): 
            self::$_oDocumentTypeAccessor->getDocumentTypesByDirectoryName($a_mDocumentTypeName)->current()
        ;
        
        $sDocumentName = $a_sName ? $a_sName : $oDocumentType->getDocumentTypeName();
        if ($a_iYear) {
            $sDocumentName .= " $a_iYear";
        }
        
        
        $sFileType = @substr($a_aFileData['name'], strrpos($a_aFileData['name'], '.') + 1);
        $sDocumentName = self::_getFilename($a_oBrf, $sDocumentName, $sFileType, $oDocumentType->getDirectoryName());
        if ($sFileType && strlen($sFileType) >= 3 && strlen($sFileType) <= 4 && @$a_aFileData['error'] === UPLOAD_ERR_OK && in_array($a_aFileData['type'], array(
            'application/pdf', // pdf
            'application/vnd.ms-excel', // excel 203
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // excel 2007+
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // word 2007+
            'application/msword' // word 2003
        ))) {
            if (move_uploaded_file(
                    $a_aFileData['tmp_name'], 
                    self::FILE_BASE_PATH . $a_oBrf->getUrl() . '/documents/' . (!is_array($a_mDocumentTypeName) ? $a_mDocumentTypeName  : implode("/", $a_mDocumentTypeName)). '/' .
                    "$sDocumentName.$sFileType"
            )) {
                // create db entry
                $oDocument = Document::create($a_oBrf->getId(), NULL, $oDocumentType->getId(), $sDocumentName, $a_iYear ? $a_iYear : NULL, $a_bPublic, $sFileType, $a_bIsBoard, $a_bIsPresident, TRUE);
                $oDocument->setDocumentType($oDocumentType);
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function getFilename($a_bCutName = FALSE)
    {
        $sFilename = $this->_oDocument->getFilename();
        if ($this->_oDocument->getIsBoard() && $a_bCutName) {
            $sFilename = substr($sFilename, strpos($sFilename, "_") + 2);
        }
        return $sFilename;
    }
    
    function delete()
    {
        @unlink($this->getFilePath());
        $this->_oDocument->delete();
    }
}

?>
