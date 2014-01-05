

<?php
    $oInfo = array_key_exists('kabeltv',$aRealtorInfo) ? $aRealtorInfo['kabeltv'] : NULL;
?>
<p class="content_center_margin"><strong>Kabel-TV:</strong> <?php 
    if (!$oInfo) {
        echo _realtorInfoMissing();
    } else {
        $oInfoCost = array_key_exists('kabeltvdebitering',$aRealtorInfo) ? $aRealtorInfo['kabeltvdebitering'] : NULL;
        $oInfoUtbud = array_key_exists('tvgrundutbud',$aRealtorInfo) ? $aRealtorInfo['tvgrundutbud'] : NULL;
        if ($oInfoCost && $oInfoCost->getValue()) {
            echo 'Debiteras ' . $oInfoCost->getComment() . ' kr/mån.';
        } else if ($oInfoUtbud && $oInfoUtbud->getValue()) {
            echo "Endast grundutbud ingår.";
        } else if ($oInfo->getValue()) {
            echo 'Ja, ingår i avgiften';
        } else {
            echo 'Nej';
        }
    }
?></p>

<?php
    $oInfo = array_key_exists('bredband',$aRealtorInfo) ? $aRealtorInfo['bredband'] : NULL;
?>
<p class="content_center_margin"><strong>Bredband:</strong> <?php 
    if (!$oInfo) {
        echo _realtorInfoMissing();
    } else {
        $oInfoSupplier = array_key_exists('bredbandsleverantor',$aRealtorInfo) ? $aRealtorInfo['bredbandsleverantor'] : NULL;
        $oInfoSpeed = array_key_exists('bredbandshastighet',$aRealtorInfo) ? $aRealtorInfo['bredbandshastighet'] : NULL;
        $oInfoCost = array_key_exists('bredbandskostnad',$aRealtorInfo) ? $aRealtorInfo['bredbandskostnad'] : NULL;
        if ($oInfo->getValue()) {
            echo 'Ja';
            if ($oInfoSupplier && $oInfoSupplier->getValue() && ($sSupplierComment = $oInfoSupplier->getComment())) {
                echo ", levereras av " . $sSupplierComment;
            }
            if ($oInfoSpeed && $oInfoSpeed->getValue() && ($sSpeedComment = $oInfoSpeed->getComment())) {
                echo ", hastighet " . $sSpeedComment;
            }
            if ($oInfoCost && $oInfoCost->getValue() && ($sCostComment = $oInfoCost->getComment())) {
                echo ", debiteras " . $sCostComment . ' kr/mån.';
            }
        } else {
            echo 'Nej';
        }
    }
?></p>
