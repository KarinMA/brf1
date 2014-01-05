<style type="text/css">
    /*#kol3 {
        float: left;
        margin: 100px 0 0 20px;
        width: 150px;
    }

    #kol4{
        float: right;
        margin: 100px 40px 0 0;
        width: 300px;
    }*/
</style>
<?php
$oBrfUser = SvenskBRF_User::loadByLinkName($_REQUEST['subview'], $oBrf);
function getMemberInfo($a_sInfo) 
{
    return $a_sInfo ? $a_sInfo : '<span class="uppgift_saknas"> Uppgift saknas</span>';
}
?>
<?php if (!$oBrfUser->hasPicture()): ?>
<!--<div id="bild_medlem2">-->
    <img src="<?php echo BASE_DIR; ?>media/inloggad/img/fantombild.png" width="131" height="171" alt="Bild saknas" style="float: right; margin-right: 25px;"/>
    <!--<span class="uppgifter_saknas" style="float: right; margin-right: 25px;">Bild saknas</span>-->
<!--</div>-->
<!--<span class="uppgift_saknas1"> Bild saknas</span>-->
<?php else: ?>
<!--<div id="bild_medlem2">-->
    <img src="<?php echo $oBrfUser->getImageData(); ?>"  alt="foto" style="height: auto; width: auto; max-width: 131px; max-height: 171px; float: right; margin-right: 25px;"/>
<!--</div>-->
<?php endif; ?>
<div class="knapp bla_knapp2">Medlem</div>
<div style="margin-left:10px; width:250px; margin-top: 35px;">
    <h3 style="margin-left:15px; font-size: 1.6em;"><?php echo $oBrfUser->getName(); ?></h3>
    <!--<p style="margin-top:-10px;">Port: <b>A</b></p>-->
    <?php if (($oUserTitle = $oBrfUser->getUserTitle())): ?>
    <p style="margin-top:-10px;"><i><?php echo $oUserTitle->getTitleName(); ?></i></p>
    <?php endif; ?>
    <?php if ($oBrf->getBrfAddresses()->size()): ?>
    <p style="margin-top:-10px; font-size: 1.3em;">Adress: <b><?php echo $oBrf->formatBrfAddress(getUser()->getAddress(), TRUE); ?></b></p>
    <?php endif; ?>
    <p style="margin-top:-10px; font-size: 1.3em;">Våning: <b><?php echo getMemberInfo($oBrfUser->getFloor()); ?></b></p>
    <p style="margin-top:-10px; font-size: 1.3em;">Lägenhetsnummer: <b><?php echo getMemberInfo($oBrfUser->getApartmentNumber()); ?></b></p>
    <p style="margin-top:-10px; font-size: 1.3em;">Bor med: <b>
        <!--<a style="color:#000; text-decoration:underline;" href="">-->
        <?php echo getMemberInfo($oBrfUser->getLivesWith()); ?>
        <!--</a>-->
    </b></p>
</div>
<div style="background:#F3F2EC; width:485px; min-height:220px; padding:10px; margin:15px;">
    
    <div style="float:left; width:240px; position: relative;"> 
        <h3 style="margin-left:15px;">Kontakt</h3>
        <?php if (!$oBrfUser->getHidePhone()): ?><p style="margin-top:-10px;">Telefon: <?php echo $oBrfUser->getCellphone(); ?></p><?php endif; ?>
        <p style="margin-bottom: -10px;">
            
            <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/meddelanden/skicka"> 
                <input type="hidden" name="_uid" value="<?php echo $oBrfUser->getId(); ?>"/>
                <?php if ($oBrfUser->getId() != getUser()->getId()): ?>
                <div class="knapp bla_knapp1" style="bottom: -140px; position: absolute; margin-left: -10px; height: 50px; cursor:pointer;" onclick="$(this).parent().submit();">Skicka meddelande</div>
                <?php else: ?>
                <a href="<?php echo BASE_DIR . $oBrf->getUrl() . '/medlem'; ?>" style="bottom: -140px; position: absolute; margin-left: 15px; font-size: 15px; ">
                    Inställningar
                </a>
                <?php endif; ?>
            </form>
        </form>

        </p>
    </div>
    <div style="float:right; width: 240px;"> 
        <h3 style="margin-left:15px;">Om mig</h3>
        <p style="margin-top:-10px; line-height:13px;">
            Ålder: <?php echo getMemberInfo($oBrfUser->getAge()); ?>
        </p>
        <h3 style="margin-left:15px;">Intressen</h3>
        <p style="margin-top:-10px; line-height:13px;"><?php echo getMemberInfo(nl2br($oBrfUser->getPresentation())); ?></p>
        <!-- line-height: 13px; -->
        
    </div>
</div>


<?php /*
<img id="bla_skylt" class="medlem" src="<?php echo BASE_DIR; ?>media/inloggad/img/bla-skyltar_brf/medlem.png" width="210" height="36" alt="medlemsidor" /> 
<?php if ($oBrfUser->getId() == getUser()->getId()): ?><a href="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/medlem" style="margin-left: 200px; font-size: 14px;">Inställningar</a><?php endif; ?>
<div style="margin-top: -20px;">
    <div id="kol1">
        <?php if (!$oBrfUser->hasPicture()): ?>
        <div id="bild_medlem2">
            <img src="<?php echo BASE_DIR; ?>media/inloggad/img/fantombild.png" width="123" height="170" alt="Bild saknas"/>
        </div>
        <span class="uppgift_saknas1"> Bild saknas</span>
        <?php else: ?>
        <div id="bild_medlem2">
            <img src="<?php echo $oBrfUser->getImageData(); ?>" width="123" height="170" alt="foto" style="height:auto; width:auto; max-width:123px; max-height:170px;"/>
        </div>
        <?php endif; ?>
        <p></p>
        <?php $aNameParts = explode(" ", $oBrfUser->getName(), 2); ?>
        <p class="rubrik_medlem">
            <span class="rubrik_bold">Förnamn:</span>
            <?php echo $aNameParts[0]; ?>
        </p>
        <p class="rubrik_medlem">
            <span class="rubrik_bold">Efternamn:</span>
            <?php echo $aNameParts[1]; ?>
        </p>
    </div>
    <div id="kol6">
        <?php if ($oBrfUser->getUserTitle()): ?>
        <p class="rubrik_medlem"><span class="rubrik_bold">Titel:</span> <?php echo getMemberInfo($oBrfUser->getUserTitle()->getTitleName()); ?></p>
        <?php endif; ?>
        <p class="rubrik_medlem"><span class="rubrik_bold">Ålder:</span> <?php echo getMemberInfo($oBrfUser->getAge()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Telefon: </span><?php echo getMemberInfo($oBrfUser->getCellphone()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Lägenhetsnummer:</span> <?php echo getMemberInfo($oBrfUser->getApartmentNumber()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Föreningens eget lägenhetsnummer:</span> <?php echo getMemberInfo($oBrfUser->getApartmentNumber2()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Våningsplan:</span> <?php echo getMemberInfo($oBrfUser->getFloor()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Bor med:</span> <?php echo getMemberInfo($oBrfUser->getLivesWith()); ?></p>
        <p class="rubrik_medlem"><span class="rubrik_bold">Intressen:</span> <?php echo nl2br(getMemberInfo($oBrfUser->getPresentation())); ?></p>
        <?php if ($oBrfUser->getId() != getUser()->getId()): ?>
        <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/meddelanden/skicka"> 
            <input type="hidden" name="_uid" value="<?php echo $oBrfUser->getId(); ?>"/>
            <input type="image" alt="skicka meddelande" src="<?php echo BASE_DIR; ?>media/inloggad/img/skicka_meddelande.png" style="border:none; margin-top:40px; float:right; height: 39px; width: 191px;" onclick="return true;"/>
        </form>
        <?php endif; ?>
    </div>
</div>*/ ?>
<script type="text/javascript">
    $("a.nav:contains('Medlemmar')").css('font-style', 'oblique');
</script>

