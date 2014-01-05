<?php
$oBrf = SvenskBRF_Brf::loadByUrl(LOAD_URL);
$oLoggedInUser = getUser();
?>
<?php if ($oLoggedInUser->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
<?php $bAd = FALSE; ?>
<?php if (FALSE || ($oRealtorUser = $oBrf->getRealtorUser()) && ($oAdCollection = $oBrf->getRealtorUser()->getAdvertisements($oBrf)) && $oAdCollection->size()): ?>
        <?php $bAd = TRUE; $oAd = $oAdCollection->current(); ?>
        <?php include './brf_realtor_ad.php'; ?>
    <?php else: ?>
<div class="marknadskollen">
    <?php include './brf_di_news.php'; ?>
    <h6><a href="http://www.di.se/compricersidor/bolan/" target="_blank" style="color:#000;">LÄGSTA BOLÅNERÄNTAN &gt;</a></h6>
    <?php include './brf_mortgage_rate_table.php'; ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if ($oLoggedInUser->getUserType() == SvenskBRF_User::USER_TYPE_MEMBER): ?>
<div id="maklarinfo_vanster">
        <?php if (FALSE || $oBrf->getRealtorUser()): ?>
    <h4 style="font-size: 2.4em; margin-left: 25px; padding-bottom: 30px; margin-bottom: 3px; font-weight: 100;">Föreningens Mäklare</h4>
    <img class="foto" src="<?php echo $oBrf->getRealtorUser()->getImageData(); ?>" width="70" height="105" />
    <img id="logga_maklare" src="<?php echo $oBrf->getRealtorUser()->getExternalPartner()->getImageData(); ?>" style="height: auto; width: 100%; max-width: 140px; max-height: 37px;"/> 
    <p class="maklare_uppgifter">
        <strong><?php echo $oBrf->getRealtorUser()->getName(); ?></strong>
        <br />
        Kontakta mig om du har frågor om bostadsmarknaden eller vill ha en kostnadsfri värdering. <br/><br/>
        <a href="<?php echo BASE_DIR; ?><?php echo $oBrf->getUrl(); ?>/maklare" class="userLink">Läs mer &gt;</a>
    </p>

    <p class="maklare_uppgifter">
        Tel: <?php echo $oBrf->getRealtorUser()->getCellphone(); ?>
        <br />
        Mail: <a href="mailto:<?php echo $oBrf->getRealtorUser()->getEmail(); ?>"><?php echo $oBrf->getRealtorUser()->getEmail(); ?></a>
    </p>
        <?php else: ?>
    <img class="foto" src="<?php echo BASE_DIR; ?>media/brf/fantombild.png" width="70" height="105" />
    <img id="logga_maklare" src="<?php echo BASE_DIR; ?>media/brf/plats_for_logga.png" width="130" height="37" /> 
    <p class="maklare_uppgifter">
        <strong>Er förening har ännu ingen mäklare ansluten till er via Svensk Brf</strong>
        <br />
        <br />

    </p>

    <p class="maklare_uppgifter">
    </p>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php if (isset($bAd) && $bAd): ?>
<style type="text/css">
    .marknadskollen {
        background: none repeat scroll 0 0 #E1BBB6;
        float: right;
        height: 280px;
        margin: 0 10px 10px 0;
        width: 505px;
    }

    #di_tabell {
        background: none repeat scroll 0 0 #F7EAE4;
        height: 150px;
        margin-left: 7px;
        margin-top: -10px;
       width: 480px;
    }
    .tickercontainer .mask {
        left: -230px;
    }
</style>
<img class="linje" width="510" height="12" alt="Linje" src="<?php echo BASE_DIR; ?>media/brf/linje.png"/>
<div class="marknadskollen">
    <?php include './brf_di_news.php'; ?>
    <h6 style="margin-top:0px;"><a href="http://www.di.se/compricersidor/bolan/" target="_blank">LÄGSTA BOLÅNERÄNTAN &gt;></a></h6>
    <?php include './brf_mortgage_rate_table_big.php'; ?>
</div>
<?php endif; ?>