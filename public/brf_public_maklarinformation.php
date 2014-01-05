<style type="text/css">
    .content_center { margin:15px;}
    .content_center_margin { margin-bottom: 10px;}
</style>
<?php
$aRealtorInfo = SvenskBRF_RealtorInformation::getRealtorInformationWithKeys($oBrf);
if (file_exists('./brf_public_maklarinformation_' . @$_REQUEST['subview'] . '.php')): 
?>

<h4 style="margin-bottom: 50px;"><?php echo SvenskBRF_RealtorInformation::getCategoryNameByCategoryKey($_REQUEST['subview']); ?></h4>
<div id="content_center">
    <?php include './brf_public_maklarinformation_' . @$_REQUEST['subview'] . '.php'; ?>
</div>
<?php else: ?>
<h4 style="margin-bottom: 15px; font-size: 34px;">Mäklarinformation
    <a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/maklarinfo_utskrift">
        <img src="<?php echo BASE_DIR; ?>media/brf/skrivare.png" style="margin-left: 120px;" width="30" height="30" alt="Skriv ut"/>
    </a>
</h4>

<div id="content_center">
    <?php foreach (SvenskBRF_RealtorInformation::getCategoryKeys() as $sCategoryKey): ?>
    <h4 style="margin-bottom: 15px; font-size: 24px;"><?php echo SvenskBRF_RealtorInformation::getCategoryNameByCategoryKey($sCategoryKey); ?></h4>
    <?php include './brf_public_maklarinformation_' . $sCategoryKey . '.php'; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php include './brf_public_icons.php'; ?>
