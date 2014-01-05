<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of getuserpdfs
 *
 * @author John Jansson
 */
class Command_getuserpdfsmultiple extends Command_download 
{
    /**
     *
     * @var SvenskBRF_Brf
     */
    private $_oBrf;
    
    function __construct(array $a_aRequest = array())
    {
        parent::__construct($a_aRequest);
        $this->_oBrf = SvenskBRF_Brf::load(getBrfAccessor()->getById($this->_aRequest['brfId']));
    }
    
    /**
     * 
     */
    protected function _getFilePath()
    {
        // create main document if it doesn't exist
        if (!file_exists(SvenskBRF_Document::FILE_BASE_PATH . $this->_oBrf->getUrl() . '/documents/administration/' . SvenskBRF_Document::getToMembersStartDocumentName($this->_oBrf))) {
            $oCreateFileCommand = new Command_getuserpdfs(array('brfId' => $this->_oBrf->getId()));
            $aDataReturned = array();
            $oCreateFileCommand->execute($aDataReturned);
        }
        
        $aFiles = array();
        $iPdfName = 1;
        
        for ($iCounter = 1; $iCounter <= $this->_oBrf->getApartments() * 1; $iCounter += 1) {
            @$oPdf = new FPDI();
            $sDocName = SvenskBRF_Document::getToMembersStartDocumentName($this->_oBrf);
            $sFilePath = "./../files/brfs/" . $this->_oBrf->getUrl() .  "/documents/administration/" . $sDocName;
            $oPdf->setSourceFile($sFilePath);
            $oPdf->addPage();
            $oTplIdx = $oPdf->importPage($iCounter);  
            
            // use the imported page and place it at point 10,10 with a width of 200 mm   (This is    the image of the included pdf)
            $oPdf->useTemplate($oTplIdx, 10, 10, 200);  
            
            /*$oPdf->AddPage();
            $oTplIdx = $oPdf->importPage($iCounter + 1);  
            $oPdf->useTemplate($oTplIdx, 10, 10, 200);  
            $oPdf->AddPage();
            $oTplIdx = $oPdf->importPage($iCounter + 2);  
            $oPdf->useTemplate($oTplIdx, 10, 10, 200);  
            */
            $sPdfPath = TMP_DIR."$iPdfName.pdf"; 
            $oPdf->Output($sPdfPath, 'F');
            $aFiles[] = $sPdfPath;
            $iPdfName++;
        }
        
        $sZipPath = TMP_DIR . $this->getFilename();
        $bZipResult = $this->create_zip($aFiles, $sZipPath, TRUE);
        return $sZipPath;
    }
    
    public function getDownloadDataType()
    {
        return 'zip';
    }
    
    /**
     *@
     * @return string
     * 
     */
    public function getFilename()
    {
        return str_replace('.pdf','.zip', (SvenskBRF_Document::getToMembersStartDocumentName($this->_oBrf)));
    }
    
    /* creates a compressed zip file */
    private function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
                //$zip->addEmptyDir("dokument");
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,"" . str_replace(TMP_DIR, "", $file));
                        
		}
		//debug
		$s = 'The zip archive contains '.$zip->numFiles.' files with a status of '.$zip->status;
		
                
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
    }
}

?>
