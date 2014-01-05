<?php foreach (array('byggar', 'lagenheter', 'ombyggnadsar', 'hyresgaster', 'adress', 'inkopsar', 'lokaler') as $sInfoTypeKey): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInfo) ? $aRealtorInfo[$sInfoTypeKey] : NULL;
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); if (!$oInfoType->getTypeNamePublic()) echo $oInfoType->getTypeName(); ?></strong> <?php echo $oInfo ? $oInfo->getValue() : _realtorInfoMissing(); ?></p>
<?php endforeach; ?>

<?php foreach (array('privatbrf', 'gemensamtagande', 'overnattning', 'kapital', 'juridiskperson') as $sInfoTypeKey): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInfo) ? $aRealtorInfo[$sInfoTypeKey] : NULL;
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); if (!$oInfoType->getTypeNamePublic()) echo $oInfoType->getTypeName(); ?></strong> <?php 
    if (!$oInfo) {
        echo _realtorInfoMissing(); 
    } else {
        echo $oInfo->getValue() ? 'Ja' : 'Nej';
        if (($sComment = $oInfo->getComment())) {
            echo ", " . lcfirst($sComment);
        }
    }
?></p>
<?php endforeach; ?>

<?php foreach (array('tvattstuga', 'torkrum', 'foreningslokal', 'uteplats', 'bastu', 'terrass', 'cykelforrad', 'festlokal', 'barnvagnsrum', 'lokaler_annat') as $sInfoTypeKey): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
    $oInfo = array_key_exists($sInfoTypeKey, $aRealtorInfo) ? $aRealtorInfo[$sInfoTypeKey] : NULL;
    if ($oInfo && $oInfo->getValue()): 
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeName(); ?>:</strong> <?php 
    if (!$oInfo) {
        echo _realtorInfoMissing(); 
    } else {
        echo $oInfo->getValue() ? 'Ja' : 'Nej';
        if (($sComment = $oInfo->getComment())) {
            echo ", " . lcfirst($sComment);
        }
    }
?></p>
<?php endif; ?>
<?php endforeach; ?>
