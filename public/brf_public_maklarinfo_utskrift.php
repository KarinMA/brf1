<?php include 'setup.php'; ?>
<?php
    $oBrf = SvenskBRF_Brf::loadByUrl($_REQUEST['brf']);
    if ($oBrf): 
        $aRealtorInfo = SvenskBRF_RealtorInformation::getRealtorInformationWithKeys($oBrf);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
    "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $oBrf->getName(); ?> | SvenskBrf.se</title>
        <link href="<?php echo BASE_DIR; ?>media/css/css.startsida.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_DIR; ?>media/css/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet"/>
        <style type="text/css">
            .uppgift_saknas {
                color:#999;
                font-style:italic; 
            }    
        </style>
        <style type="text/css">
            .content_center { margin:15px;}
            .content_center_margin { margin-bottom: 10px;}
        </style>
    </head>
    <body onload="window.print();">
        <div class="content_center">
            <h4 style="margin-bottom: 15px; font-size: 34px;">Mäklarinformation, <?php echo $oBrf->getName(); ?></h4>
        </div>
        <div class="content_center">
            <p><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation'; ?>">&lt;&lt; Tillbaka</a></p>
        </div>
        <div class="content_center">
        <?php foreach (SvenskBRF_RealtorInformation::getCategoryKeys() as $sCategoryKey): ?>
            <h4 style="margin-bottom: 15px; font-size: 24px;"><?php echo SvenskBRF_RealtorInformation::getCategoryNameByCategoryKey($sCategoryKey); ?></h4>
        <?php include './brf_public_maklarinformation_' . $sCategoryKey . '.php'; ?>
        <?php endforeach; ?>
        <br />
        <br />
        <p><a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/maklarinformation'; ?>">&lt;&lt; Tillbaka</a></p>
        </div>
    </body>
</html>
<?php endif; ?>
<?php include 'unsetup.php'; ?>