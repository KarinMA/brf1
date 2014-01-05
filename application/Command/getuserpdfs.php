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
class Command_getuserpdfs extends Command_download 
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
        // generate a PDF file and return its path
        $sPdfPath = (SvenskBRF_Document::FILE_BASE_PATH . $this->_oBrf->getUrl() . '/documents/administration/' . $this->getFilename());
        if (TRUE || !file_exists($sPdfPath)) {
            @$oPdf = new FPDI();
            @$oPdf->setSourceFile("./../files/templates/brf.pdf");
            
            $oUserSelector = getUserSelector();
            $oUserSelector->setBrfId($this->_oBrf->getId());
            $oUserSelector->setUserType(SvenskBRF_User::USER_TYPE_MEMBER);
            $oUserSelector->setIsRegistered(FALSE);
            $oUsers = getUserAccessor()->read($oUserSelector);
            $iCount = $oUsers->size();
            for ($iCounter = 1; $iCounter <= $iCount; $iCounter++) {

                $oPdf->AddPage();
                @$oTplIdx = $oPdf->importPage(1);  
                @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  

                // use the imported page and place it at point 10,10 with a width of 200 mm   (This is    the image of the included pdf)

                // now write some text above the imported page
                $oPdf->SetTextColor(0,0,0);
                $oPdf->SetFont('Arial','B',11);  
                $iX = 72;
                $iY = 226;
                $oPdf->SetXY($iX, $iY);  
                $oPdf->Write(0, $oUsers->current()->getUsername());
                $iY += 4.3;
                $iX -= 12;
                $oPdf->SetXY($iX, $iY);  
                $oPdf->Write(0, $oUsers->current()->getPassword());

                // write URL
                $iY -= 31.2;
                $iX -= 7;
                $oPdf->SetXY($iX, $iY);  
                $oPdf->Write(0, $this->_oBrf->getUrl());

                /*
                $oPdf->AddPage();
                @$oTplIdx = $oPdf->importPage(2);  
                @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  
                $oPdf->AddPage();
                @$oTplIdx = $oPdf->importPage(3);  
                @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  
                $oPdf->AddPage();
                */

                $oUsers->next();
            }

            @$oPdf->Output($sPdfPath, 'F');
        }

        // queue a mail?
        
        // save the document for future use
        return $sPdfPath; 
    }
    
    public function getDownloadDataType()
    {
        return 'pdf';
    }
    
    /**
     *@
     * @return string
     * 
     */
    public function getFilename()
    {
        return (SvenskBRF_Document::getToMembersStartDocumentName($this->_oBrf));
    }
}

?>
