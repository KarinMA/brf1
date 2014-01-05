<?php
    $sAdLink = trim($oAd->getRealtorAdLink());
    if (strpos($sAdLink, "http") !== 0) {
        $sAdLink = "http://" . $sAdLink;
    }
    
    $oZC = new Zend_Currency('SE');
    $oZC->setFormat(array(
       'precision' => 0, 
    ));
            
?>
<?php

if (!isset($bPublicBrfPage)) {
    echo "";
} else {
    echo "";
}

?>
<a href="<?php echo $sAdLink; ?>">
    <div id="till_salu" style="height: <?php if (!isset($bPublicBrfPage)): ?>313<?php else: ?>313<?php endif; ?>px;">
        <div class="bla_knapp">Till salu</div>
        <div class="annons">
            <?php if (!$oAd->hasPicture()): ?>
            <img 
                alt="Till salu" 
                src="<?php echo BASE_DIR; ?>media/brf/till_salu.png"
                style="max-height: 153px; max-width: 230px; height: auto; width: auto;"
            />
            <?php else: ?>
            <img 
                alt="Till salu" 
                src="<?php echo $oAd->getImageData(); ?>"
                style="max-height: 153px; max-width: 230px; height: auto; width: auto;"
            />
            <?php endif; ?>
        </div>
        <div class="annons_info">
            <!--<i><span style="color:#C00;">Visas:</span> Mån 2013-10-25 kl 13:00 till 13:30</i>
            <br />-->
            <div style="margin-top:3px; line-height: 18px;">
            <?php echo $oAd->getAddress(); ?>, <?php echo $oAd->getStairs(); ?><?php if (is_numeric($oAd->getStairs())): ?> tr<?php endif; ?><span class="annons_right"><?php echo str_replace(".", ",", $oAd->getRooms()); ?> rok</span>
            <br />Avgift: <?php $oZC->setValue($oAd->getFee()); try { echo $oZC . '/mån'; } catch (Zend_Currency_Exception $oZCE) { echo ''; } ?> 
            <span class="annons_right"><?php echo $oAd->getSquareMeters(); ?> kvm</span>
            <br />Pris: <?php $oZC->setValue($oAd->getPrice()); try { echo $oZC; } catch (Zend_Currency_Exception $oZCE) { echo ''; } ?> <?php if (($sPriceType = $oAd->getPriceType())): ?> (<?php echo $sPriceType; ?>)<?php endif; ?>
            <?php if (($sPresentationTime = $oAd->getAlternateTime())): ?>
            <br />
            <i><span style="color:#C00;"><?php echo $sPresentationTime; ?></span></i>
            <?php else: ?>
            
            <div style="line-height: 12px;">
                <br />
            <?php foreach ($oAd->getBrfRealtorAdTimeCollection(TRUE) as $oTime): ?>
            
            <i><span style="color:#C00;">Visas:</span> <?php echo getShortDay(date('w', strtotime($oTime->getStartTime()))); ?> <?php echo substr($oTime->getStartTime(), 0, 10); ?> kl <?php echo str_replace(":", "", substr($oTime->getStartTime(), 11, 5)); ?> till <?php echo str_replace(":", "", date('H:i', strtotime('+' . $oTime->getDurationMinutes() . ' minute', strtotime($oTime->getStartTime())))); ?></i>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
            </div>

        </div>
    </div>
</a>