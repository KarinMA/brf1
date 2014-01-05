<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('planeradombyggnad');
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); ?></strong> <?php echo array_key_exists('planeradombyggnad', $aRealtorInfo) ? ($aRealtorInfo['planeradombyggnad']->getValue() ? 'Ja' : 'Nej') : _realtorInfoMissing(); ?></p>
<?php if (array_key_exists('planeradombyggnad', $aRealtorInfo) && $aRealtorInfo['planeradombyggnad']->getValue() && $aRealtorInfo['planeradombyggnad']->getComment() ): ?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getCommentPublic(); ?></strong> <?php echo $aRealtorInfo['planeradombyggnad']->getComment(); ?></p>
<?php endif; ?>
<?php foreach (array('amortering' => ', enligt följande: ', 'ekonomi' => ', följande: ') as $sInfoTypeKey => $sYesLabel): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); ?></strong> <?php echo array_key_exists($sInfoTypeKey, $aRealtorInfo) ? ($aRealtorInfo[$sInfoTypeKey]->getValue() ? 'Ja' : 'Nej') : _realtorInfoMissing(); ?>
<?php if (array_key_exists($sInfoTypeKey, $aRealtorInfo) && $aRealtorInfo[$sInfoTypeKey]->getValue() && $aRealtorInfo[$sInfoTypeKey]->getComment() ): ?>
<?php echo $sYesLabel . $aRealtorInfo[$sInfoTypeKey]->getComment(); ?>
<?php endif; ?>
</p>
<?php endforeach; ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName('pantoverlatelse');
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeName(); ?></strong> <?php echo array_key_exists('pantoverlatelse', $aRealtorInfo) ? $aRealtorInfo['pantoverlatelse']->getValue() : _realtorInfoMissing(); ?></p>
<?php foreach (array('overlatelseavgift', 'pantavgift') as $sInfoTypeKey): ?>
<?php
    $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey);
?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeName(); ?></strong> <?php echo array_key_exists($sInfoTypeKey, $aRealtorInfo) ? ($aRealtorInfo[$sInfoTypeKey]->getValue() ? 'Ja' : 'Nej') : _realtorInfoMissing(); ?>
<?php if (array_key_exists($sInfoTypeKey, $aRealtorInfo) && $aRealtorInfo[$sInfoTypeKey]->getValue() && $aRealtorInfo[$sInfoTypeKey]->getComment() ): ?>
<?php echo ", " . $aRealtorInfo[$sInfoTypeKey]->getComment(); ?>
<?php if (!preg_match("/kr/", $aRealtorInfo[$sInfoTypeKey]->getComment())): ?>
<?php echo ' kr'; ?>
<?php endif; ?>
<?php endif; ?>
</p>
<?php endforeach; ?>
<?php
    $bEkonomiskForvaltare = array_key_exists('ekonomiskforvaltare', $aRealtorInfo);
    $oInfoTypeForvaltare = SvenskBRF_RealtorInformation::getTypeByKeyName('ekonomiskforvaltare');
    if (!$bEkonomiskForvaltare):
?>
<p class="content_center_margin"><strong><?php echo $oInfoTypeForvaltare->getTypeNamePublic(); ?></strong> <?php echo _realtorInfoMissing(); ?></p>
<?php else: ?>
<p class="content_center_margin"><strong><?php echo $oInfoTypeForvaltare->getTypeNamePublic(); ?></strong> <br /><?php echo nl2br($aRealtorInfo['ekonomiskforvaltare']->getValue()); ?></p>
<?php endif; ?>
<?php
    $bKontaktPerson = array_key_exists('kontaktperson', $aRealtorInfo);
    $oInfoTypeKontaktPerson = SvenskBRF_RealtorInformation::getTypeByKeyName('kontaktperson');
    if (!$bKontaktPerson):
?>
<p class="content_center_margin"><strong><?php echo $oInfoTypeKontaktPerson->getTypeName(); ?></strong> <?php echo _realtorInfoMissing(); ?></p>
<?php else: ?>
<p class="content_center_margin"><strong><?php echo $oInfoTypeKontaktPerson->getTypeName(); ?></strong> <?php echo $aRealtorInfo['kontaktperson']->getValue(); ?></p>
<?php endif; ?>
<?php foreach (array('kontakttelefon', 'kontaktfax') as $sInfoTypeKey): ?>
<?php if ($bKontaktPerson): ?>
<?php $oInfoType = SvenskBRF_RealtorInformation::getTypeByKeyName($sInfoTypeKey); ?>
<p class="content_center_margin"><strong><?php echo $oInfoType->getTypeNamePublic(); ?></strong> <?php echo (array_key_exists($sInfoTypeKey, $aRealtorInfo) && $aRealtorInfo[$sInfoTypeKey]->getValue()) ? $aRealtorInfo[$sInfoTypeKey]->getValue() : _realtorInfoMissing(); ?></p>
<?php endif; ?>
<?php endforeach; ?>
