<img width="210" height="36" alt="dokument" src="<?php echo BASE_DIR; ?>media/inloggad/img/maklare.png" id="bla_skylt">
<img src="<?php echo $oBrf->getRealtorUser()->getExternalPartner()->getImageData(); ?>" class="maklar_logga"  style="height: auto; width: auto; max-height: 43px; max-width: 150px; border: none; float: right; margin-right: 20px; margin-top: 20px;"/>
<div id="content_maklare">
    <div id="kol1_maklare">
        <!--src11="<?php echo BASE_DIR; ?>media/inloggad/img/stor_bild.jpg"-->
        <img style="max-height: 236px; max-width: 157px; height: auto; width: auto; "id="portratt" src="<?php echo $oBrf->getRealtorUser()->getImageData(); ?>"/>
        <p class="maklar_sidan">
            <strong><?php echo $oBrf->getRealtorUser()->getName(); ?></strong>
            <br />
            Tel: <?php echo $oBrf->getRealtorUser()->getCellphone(); ?><br />
            Mail: <?php echo $oBrf->getRealtorUser()->getEmail(); ?>
        </p> 

    </div>

    <div id="kol2_maklare" style="margin-top: -60px;">
        <p>&nbsp;</p>
        <?php if (($oRealtorLog = $oBrf->getLatestRealtorMessage())): ?>
        <h3><?php echo $oRealtorLog->getHeader(); ?></h3>
        <?php echo nl2br($oRealtorLog->getRealtorMessage()); ?>
        <p>&nbsp;</p>
        <?php else: ?>
        <h3><?php echo $oBrf->getRealtorUser()->getName(); ?></h3>
        <?php endif; ?>
        <?php echo nl2br($oBrf->getRealtorUser()->getPresentation()); ?>
        <?php $aRealtorBrfs = array(); ?>
        <?php if (count(($aBrfs = $oBrf->getRealtorUser()->getRealtorBrfs()))): ?>
        <?php 
            foreach ($aBrfs as $oRealtorBrf) {
                
                if ($oBrf->getBrfViewSetting($oRealtorBrf->getId())) {
                    $aRealtorBrfs[] = $oRealtorBrf;
                }

            }
        ?>
        <?php endif; ?>
        <form method="post" action="<?php echo BASE_DIR . $oBrf->getUrl(); ?>/meddelanden/skicka"> 
            <input type="hidden" name="_uid" value="<?php echo $oBrf->getRealtorUser()->getId(); ?>"/>
            <input type="image" alt="skicka meddelande" src="<?php echo BASE_DIR; ?>media/inloggad/img/skicka_meddelande.png" style="border:none; margin-top:40px; float:right; height: 39px; width: 191px;" onclick="return true;"/>
        </form>
    </div>
    <?php if (count($aRealtorBrfs)): ?>
    <div id="kol3" style="width:519px; clear:both; margin-left:20px; margin-right:20px; padding-top:20px;">
        <p style="margin-left: 1px; font-size: 2.0em; padding-bottom: 5px; margin-bottom: 3px; font-weight: 100; border-bottom: 1px solid #000;">Föreningar jag ansvarar för</p>
        <p style="margin-left: 1px;">Klicka på en förening nedan för att gå till föreningens hemsida.</p>
        <div style="width: 220px; float:left; margin-left:0px;">
            <?php foreach ($aRealtorBrfs as $iBrfIndex => $oRealtorBrf): if ($iBrfIndex % 2 == 0): ?>
            <a href="<?php echo BASE_DIR . $oRealtorBrf->getUrl(); ?>" target="_blank"><?php echo $oRealtorBrf->getName(); ?></a>
            <br />
            <?php endif; endforeach; ?>
        </div>
        <div style="width: 220px; float:right;">
            <?php foreach ($aRealtorBrfs as $iBrfIndex => $oRealtorBrf): if ($iBrfIndex % 2 == 1): ?>
            <a href="<?php echo BASE_DIR . $oRealtorBrf->getUrl(); ?>" target="_blank"><?php echo $oRealtorBrf->getName(); ?></a>
            <br />
            <?php endif; endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>