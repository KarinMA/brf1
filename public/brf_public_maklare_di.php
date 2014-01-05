<?php
    $bPublicBrfPage = TRUE;
    $oBrf = SvenskBRF_Brf::loadByUrl(LOAD_URL);
    $bAd = FALSE;
    $oRealtorUser = NULL;
    if (($oRealtorUser = $oBrf->getRealtorUser()) && ($oAdCollection = $oRealtorUser->getAdvertisements($oBrf)) && $oAdCollection->size()):
?>
<?php $bAd = TRUE; $oAd = $oAdCollection->current(); ?>
<?php include './brf_realtor_ad.php'; ?>
<?php else: ?>
<style type="text/css">
    .marknadskollen {
        width: 237px;
        height: 325px;
    }
    #di_tabell {
        width: 223px;

    }
</style>
<div class="marknadskollen">
    <?php include './brf_di_news.php'; ?>
    <h3 style="margin-top:0px;"><a href="http://www.di.se/compricersidor/bolan/" target="_blank">LÄGSTA BOLÅNERÄNTAN &gt;></a></h3>
    <?php include './brf_mortgage_rate_table.php'; ?>
</div>
<?php endif; ?>
<?php
?>
<div id="maklarinfo_vanster">

<?php if ($oRealtorUser): ?>
    <h4 style="font-size: 2.0em; margin-top: -1px; margin-left: 25px; padding-bottom: 30px; margin-bottom: 3px; font-weight: 100;">Föreningens Mäklare</h4>
    <img class="foto" src="<?php echo $oRealtorUser->getImageData(); ?>" style="height: auto; width: auto; max-height: 105px; max-width: 70px;"/>
    <img id="logga_maklare" src="<?php echo $oRealtorUser->getExternalPartner()->getImageData(); ?>" style="height: auto; width: 100%; max-width: 140px; max-height: 37px;"/> 

    <p class="maklare_uppgifter"><strong><?php echo $oRealtorUser->getName(); ?></strong><br />
        Kontakta mig om du har frågor om bostadsmarknaden eller vill ha en kostnadsfri värdering. <br/><br/></p>

    <p class="maklare_uppgifter">
        Tel: <?php echo $oRealtorUser->getCellphone(); ?><br/>
        Mail: <a href="mailto:<?php echo $oRealtorUser->getEmail(); ?>"><?php echo $oRealtorUser->getEmail(); ?></a>
    </p> 
<?php else: ?>
    <img class="foto" alt="foto" src="<?php echo BASE_DIR; ?>media/brf/fantombild.png" width="70" height="105" />
    <img id="logga_maklare" src="<?php echo BASE_DIR; ?>media/brf/plats_for_logga.png" width="130" height="37" /> 


    <p class="maklare_uppgifter"><strong>Vill du som fastighetsmäklare synas här?</strong>
        <br /><br />
        Arbetar du som fastighetsmäklare och ska sälja eller har sålt en lägenhet i denna förening? Vill du bli föreningsmäklare? Som exklusiv mäklare i föreningen får du tillgång till en egen profil på föreningens sida där du kan skriva om dig själv och vad du kan erbjuda! 
        <br /><br />
        Allt du behöver göra är att maila oss på <a href="mailto:maklare@svenskbrf.se">maklare@svenskbrf.se</a>
        <br />
        <br />
        <a href="<?php echo BASE_DIR; ?>for_maklare">Läs mer &gt;</a>
    </p>

    <p class="maklare_uppgifter">
    </p> 
<?php endif; ?>
<?php if (TRUE && $oRealtorUser): ?>
    <div style="border: 1px solid #ddd; width:220px; height:30px; background: #F6A828;/*#C90*/; margin-left:25px; margin-top:10px; margin-bottom: 10px; padding-left:10px; padding-top:5px; font-size:16px; color:#FFF;  border-radius: 3px; text-align: center;"><a href="" style="color:#FFF;" id="interested">INTRESSEANMÄLAN</a></div>
    <p class="maklare_uppgifter">Är du intresserad av kommande försäljningar i denna förening. Klicka på intresseanmälan ovan.</p>
<?php endif; ?>
</div>
<div class="marginal_bottom"></div>
<?php if ($bAd): ?>
<img class="linje" width="510" height="12" alt="Linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png"/>
<div class="marknadskollen">
    <?php include './brf_di_news.php'; ?>
    <h3 style="margin-top:0px;"><a href="http://www.di.se/compricersidor/bolan/" target="_blank">LÄGSTA BOLÅNERÄNTAN &gt;></a></h3>
    <?php include './brf_mortgage_rate_table_big.php'; ?>
</div>
<?php endif; ?>
