<?php
include 'setup.php';
$startTime = time();
var_dump(SvenskBRF_Web::getSiteSettingValue(SvenskBRF_Web::SITE_SETTING_ID_3_MONTH_BANK), time()-$startTime);
var_dump(SvenskBRF_Web::getSiteSettingValue(SvenskBRF_Web::SITE_SETTING_ID_3_MONTH), time()-$startTime);
var_dump(SvenskBRF_Web::getSiteSettingValue(SvenskBRF_Web::SITE_SETTING_ID_1_YEAR_BANK), time()-$startTime);
var_dump(SvenskBRF_Web::getSiteSettingValue(SvenskBRF_Web::SITE_SETTING_ID_1_YEAR), time()-$startTime);

include 'unsetup.php';
exit;
?>


<img src="data:image/jpeg;base64,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"/>
<?php


exit;
include 'setup.php';
$sPdfPath = '../files/templates/Guide.pdf';
@$oPdf = new FPDI();
@$oPdf->setSourceFile("./../files/templates/brf.pdf");
            

                // use the imported page and place it at point 10,10 with a width of 200 mm   (This is    the image of the included pdf)
        
                $oPdf->AddPage();
                @$oTplIdx = $oPdf->importPage(2);  
                @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  
                $oPdf->AddPage();
                @$oTplIdx = $oPdf->importPage(3);  
                @$oPdf->useTemplate($oTplIdx, 10, 10, 200);  
                

            @$oPdf->Output($sPdfPath, 'F');
        

include 'unsetup.php';
?>
